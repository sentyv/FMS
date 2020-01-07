<?php

namespace App\Http\Controllers\Frontend\Fms;
// use Validator;
use Carbon\Carbon;
use DataTables;
use App\Models\Fms\File;
use App\Models\Fms\Movement;
use Illuminate\Http\Request;
use App\Http\Requests\Frontend\Fms\ViewRequest;
use App\Http\Requests\Frontend\Fms\StoreMovementRequest;
use App\Http\Requests\Frontend\Fms\UpdateMovementRequest;
use App\Repositories\Frontend\Fms\MovementRepository;
use App\Repositories\Frontend\Fms\FileRepository;
use App\Http\Controllers\Controller;

class MovementController extends Controller
{
  private $files;
  private $movements;

  public function __construct(FileRepository $files, MovementRepository $movements)
  {
    $this->files=$files;
    $this->movements=$movements;


  }

  /**
   * @param ViewRequest $request
   * @return mixed
   * @throws \Exception
   */
  //
  public function create(int $file)
  {
    $file = $this->files->getById($file);
    return view('frontend.fms.file.movement.create')
      ->with('file',$file);
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(StoreFileMovementRequest $request, int $file)
  {
    $file = $this->files->getById($file);
    $data = $request->all();
    $this->movement->save($data);
    return redirect()
      ->route('frontend.fms.file.view', $file)
      ->withFlashSuccess('File Issued');
  }

   /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // 

  public function delete(DeleteFileMovementRequest $request, int $file)
  {
    $file = $this->files->getById($file);
    $this->movement->returnFileFromIssue();
    return redirect()
      ->route('frontend.fms.file.view', $file)
      ->withFlashSuccess('File Returned');
  }

}
