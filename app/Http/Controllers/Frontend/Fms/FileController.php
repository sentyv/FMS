<?php

namespace App\Http\Controllers\Frontend\Fms;
// use Validator;
use Carbon\Carbon;
use DataTables;
use App\Models\Fms\File;
use App\Models\Fms\Reference;
use App\Models\Fms\Publisher;
use Illuminate\Http\Request;
use App\Http\Requests\Frontend\Fms\ViewRequest;
use App\Http\Requests\Frontend\Fms\StoreFileRequest;
use App\Http\Requests\Frontend\Fms\UpdateFileRequest;
use App\Repositories\Frontend\Fms\FileRepository;
use App\Repositories\Frontend\Fms\ReferenceRepository;
use App\Repositories\Frontend\Fms\PublisherRepository;
use App\Http\Controllers\Controller;


use Maatwebsite\Excel\Facades\Excel;
use App\Http\Exports\FileExport;


class FileController extends Controller
{
    private $files;
    private $publishers;
    private $references;
    public function __construct(FileRepository $files, PublisherRepository $publishers, ReferenceRepository $references)
    {
        $this->files=$files;
        $this->publishers=$publishers;
        $this->references=$references;

    }
    // public function index(Request $request)
    // {
   
    //     if ($request->ajax()) {
    //         $data = File::latest()->get();
    //         return Datatables::of($data)
    //                 ->addIndexColumn()
    //                 ->addColumn('action', function($row){

    //                     // $btn = '<a href="' . route('frontend.maprot.islands.fishers.create', $row->id) .'" data-original-title="Edit" class="edit btn btn-primary btn-sm editProduct">Add Poster</a>';
   
    //                     //    // $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteProduct">Delete</a>';
    
    //                     //     return $btn;
    //                 })
    //                 ->rawColumns(['action'])
    //                 ->make(true);
    //     }
    // // dd($request);
    //     return view('frontend.fms.file.index',compact('files'));
    // }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function index()
    // {
    //     return view('frontend.fms.file.index');
    // }
    public function index(Request $request)
    {
   
        if ($request->ajax()) {
            $data = File::leftjoin('references','references.id', '=','files.file_reference_id')
            ->leftjoin('publishers','publishers.id', '=', 'files.file_publisher_id')
            ->select('files.id','files.file_subject_title','files.file_author_name','files.file_published_date','files.file_received_date','publishers.publisher_name','references.reference_code','references.folder_name','files.current_movement_id')->orderBy('id', 'desc')->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                       
                         $btna = '<a href="' . route('frontend.fms.file.show', $row->id ) .'" data-original-title="Edit" class="edit btn btn-success btn-sm editProduct">View</a>'; 
                        
                         if($row->current_movement_id == null){
                           $btnb =   $btna.'<a href="' . route('frontend.fms.file.movement.create', $row->id ) .'" data-original-title="Edit" class="edit btn btn-danger btn-sm editProduct">Issue File</a>';
                          
                         
                               
                                // $btn = $btn.'<a href="' . route('frontend.fms.file.return', $row->id ) .'" data-original-title="Edit" class="edit btn btn-primary btn-sm editProduct">Return File</a>';
                                return $btnb;
                            }

                            else{
                                $btnc = $btna.'<a href="' . route('frontend.fms.file.return', $row->id ) .'" data-original-title="Edit" class="edit btn btn-warning btn-sm editProduct">Return File</a>';
                                
                               return $btnc;
                            }
                             
                  
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        // dd($data->current_movement_id);
      
        return view('frontend.fms.file.index',compact('files'));
    }

    /**
     * @param ViewRequest $request
     * @return mixed
     * @throws \Exception
     */
     public function getDataTables(ViewRequest $request)
     {
         $search = $request->get('search', '');
         if (is_array($search)) {
             $search = $search['value'];
         }
         $query = $this->files->getForDataTable($search);
         $datatables = DataTables::make($query)
             ->editColumn('file_published_date', function ($row) {
                 return $row->file_published_date ? with(new Carbon($row->file_published_date))->format('Y-m-d') : '';
             })
             ->editColumn('file_received_date', function ($row) {
                 return $row->file_published_date ? with(new Carbon($row->file_received_date))->format('Y-m-d') : '';
             })
             ->make(true);
         return $datatables;
     }
// all data input from a  form are caputured in $request
// extract the list of items from publisher object using a pluck methods
//list of items
    public function create(ViewRequest $request)
    {
        $publishers=$this->publishers->pluck();
        $references=$this->references->pluck();
        return view('frontend.fms.file.create')
        ->with('references',$references)
            ->with('publishers',$publishers);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $image = $request->file('file_name');
        // $new_name = rand() . '.' . $image->getClientOriginalExtension();
        // $image->move(public_path('images/fms'), $new_name);


        // dd('$new_name');

        $data = [
            'file_subject_title' => $request->get('file_subject_title'),
            'file_author_name'  => $request->get('file_author_name'),
            'file_published_date'  => $request->get('file_published_date'),
            'file_received_date'  => $request->get('file_received_date'),
            // 'file_name'  => $new_name,
            'file_reference_id'  => $request->get('file_reference_id'),
            'file_publisher_id'  => $request->get('file_publisher_id')
          ];
        $this->files->create($data);

        return redirect()
            ->route('frontend.fms.file.index')
            ->withFlashSuccess('File created');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(ViewRequest $request, $id)
    {
        $item=$this->files->getById($id);
        return view('frontend.fms.file.show')
            ->withItem($item);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item=$this->files->getById($id);
        $publishers=$this->publishers->pluck();
        return view('frontend.fms.file.edit')
            ->withPublishers($publishers)
            ->withItem($item);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateFileRequest $request
     * @param $id
     * @return mixed
     */
    public function update(UpdateFileRequest $request, $id)
    {
        $item=$this->files->getById($id);
        $this->files->update($item,$request->all());
        return redirect()
            ->route('frontend.fms.file.index')
            ->withFlashSuccess('File updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Exception
     */
    public function destroy($id)
    {
        $item=$this->files->deleteById($id);
        return redirect()
            ->route('frontend.fms.file.index')
            ->withFlashSuccess('Files removed');
    }

    // public function download($id)
    // {
    //     $file = File::where('id', $id)->firstOrFail();
    //     $pathToFile = public_path('images/fms/' . $file->file_name);
    //     return response()->download($pathToFile);
    // }

    public function download()
    {
       return Excel::download(new FileExport, 'Inward_files_mfmrd.xlsx');
    }
}
