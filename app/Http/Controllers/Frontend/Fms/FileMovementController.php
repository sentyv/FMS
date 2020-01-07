<?php

namespace App\Http\Controllers\Frontend\Fms;

use App\Http\Requests\Frontend\Fms\ReturnFileMovementRequest;
use App\Http\Requests\Frontend\Fms\UpdateFileRequest;
use App\Http\Requests\Frontend\Fms\ViewRequest;
use App\Http\Requests\Frontend\Fms\StoreFileMovementRequest;
use App\Repositories\Frontend\Fms\FileMovementRepository;
use App\Repositories\Frontend\Fms\FileRepository;
use App\Http\Controllers\Controller;

class FileMovementController extends Controller
{
  private $files;
  private $movements;

  public function __construct(FileRepository $files, FileMovementRepository $movements)
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
    if (isset($file)) {
      $data = $request->all();
//      $data['file_id'] = $file->id;
      $this->movements->create($file, $data);
      return redirect()
        ->route('frontend.fms.file.show', $file)
        ->withFlashSuccess('File Issued');
    } else {
      return redirect()
        ->route('frontend.fms.file.index')
        ->withErrors(['Unable to locate File']);
    }
  }

  public function return(ReturnFileMovementRequest $request, int $file)
  {
    $file = $this->files->getById($file);
    if (isset($file)) {
      $this->movements->returnFileFromIssue($file);
      return redirect()
        ->route('frontend.fms.file.show', $file)
        ->withFlashSuccess('File Returned');
    } else {
      return redirect()
        ->route('frontend.fms.file.index')
        ->withErrors(['Unable to locate File']);
    }
  }

}
