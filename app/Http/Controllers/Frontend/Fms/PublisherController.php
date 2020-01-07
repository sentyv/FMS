<?php

namespace App\Http\Controllers\Frontend\Fms;
// use Validator;
use DataTables;
use App\Models\Fms\Publisher;
use Illuminate\Http\Request;
use App\Http\Requests\Frontend\Fms\ViewRequest;
use App\Http\Requests\Frontend\Fms\StorePublisherRequest;
use App\Http\Requests\Frontend\Fms\UpdatePublisherRequest;
use App\Repositories\Frontend\Fms\PublisherRepository;
use App\Http\Controllers\Controller;

class PublisherController extends Controller
{
    const Ref='Publisher';

    private $publishers;
    public function __construct(PublisherRepository $publishers)
    {
        $this->publishers=$publishers;

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function index()
    // {
    //     return view('frontend.fms.publisher.index');
    // }

    public function index(Request $request)
    {
   
        if ($request->ajax()) {
            $data = Publisher::latest()->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){

                        $btn = '<a href="' . route('frontend.fms.publisher.edit', $row->id) .'" data-original-title="Edit" class="edit btn btn-primary btn-sm editProduct">Edit</a>';
   
                           // $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteProduct">Delete</a>';
    
                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
    // dd($request);
        return view('frontend.fms.publisher.index',compact('publishers'));
    }

     public function getDataTables(ViewRequest $request)
     {
         $search = $request->get('search', '') ;
         if (is_array($search)) {
             $search = $search['value'];
         }
         $query = $this->publishers->getForDataTable($search);
         $datatables = DataTables::make($query)->make(true);
         return $datatables;
     }

    public function create()
    {
        return view('frontend.fms.publisher.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePublisherRequest $request)
    {
        $data=$request->all();
        $this->publishers->create($data);
        return redirect()
            ->route('frontend.fms.publisher.index')
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
        $item=$this->publishers->getById($id);
        return view('frontend.fms.publisher.show')
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
        $item=$this->publishers->getById($id);
        return view('frontend.fms.publisher.edit')
            ->withItem($item);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateLeaveTypeRequest $request
     * @param $id
     * @return mixed
     */
    public function update(UpdatePublisherRequest $request, $id)
    {
        $item=$this->publishers->getById($id);
        $this->publishers->update($item,$request->all());
        return redirect()
            ->route('frontend.fms.publisher.index')
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
        $item=$this->publishers->deleteById($id);
        return redirect()
            ->route('frontend.fms.publisher.index')
            ->withFlashSuccess(static::Ref . ' removed');
    }
}
