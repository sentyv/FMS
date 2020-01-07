<?php

namespace App\Http\Controllers\Frontend\Fms;
// use Validator;
use DataTables;
use App\Models\Fms\Reference;
use Illuminate\Http\Request;
use App\Http\Requests\Frontend\Fms\ViewRequest;
use App\Http\Requests\Frontend\Fms\StoreReferenceRequest;
use App\Http\Requests\Frontend\Fms\UpdateReferenceRequest;
use App\Repositories\Frontend\Fms\ReferenceRepository;
use App\Http\Controllers\Controller;

class ReferenceController extends Controller
{
    const Ref='File reference';

    private $references;
    public function __construct(ReferenceRepository $references)
    {
        $this->references=$references;

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function index(Request $request)
     {
    
         if ($request->ajax()) {
             $data = Reference::latest()->get();
             return Datatables::of($data)
                     ->addIndexColumn()
                     ->addColumn('action', function($row){

                            $btn = '<a href="' . route('frontend.fms.reference.edit', $row->id) .'" data-original-title="Edit" class="edit btn btn-primary btn-sm editProduct">Edit</a>';
    
                            // $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteProduct">Delete</a>';
     
                             return $btn;
                     })
                     ->rawColumns(['action'])
                     ->make(true);
         }
       
         return view('frontend.fms.reference.index',compact('references'));
     }


     public function getDataTables(ViewRequest $request)
     {
         $search = $request->get('search', '') ;
         if (is_array($search)) {
             $search = $search['value'];
         }
         $query = $this->references->getForDataTable($search);
         $datatables = DataTables::make($query)->make(true);
         return $datatables;
     }

    public function create()
    {
        return view('frontend.fms.reference.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreReferenceRequest $request)
    {
        $data=$request->all();
        $this->references->create($data);
        return redirect()
            ->route('frontend.fms.reference.index')
            ->withFlashSuccess(static::Ref . ' created');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(ViewRequest $request, $id)
    {
        $item=$this->references->getById($id);
        return view('frontend.fms.reference.show')
            ->withItem($item);;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item=$this->references->getById($id);
        return view('frontend.fms.reference.edit')
            ->withItem($item);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateLeaveTypeRequest $request
     * @param $id
     * @return mixed
     */
    public function update(UpdateReferenceRequest $request, $id)
    {
        $item=$this->references->getById($id);
        $this->references->update($item,$request->all());
        return redirect()
            ->route('frontend.fms.reference.index')
            ->withFlashSuccess(static::Ref . ' updated');
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
        $item=$this->references->deleteById($id);
        return redirect()
            ->route('frontend.fms.reference.index')
            ->withFlashSuccess(static::Ref . ' removed');
    }

    public function typeaheadJson(ViewRequest $request, $search)
    {
        return $this->references->findTypeahead($search, 10);
    }

    public function result(Request  $request)
    {
        $result=Reference::where('reference_code', 'LIKE', "%{$request->input('query')}%")->get();
        return response()->json($result);
    }
}
