<?php
namespace App\Repositories\Frontend\Fms;

use App\Models\Fms\File;
use App\Repositories\BaseRepository;
use App\Models\Fms\FileMovement;
use Carbon\Carbon;

class FileMovementRepository extends BaseRepository
{
  public function __construct(FileMovement $model)
  {
    $this->model = $model;
  }
  public function create(File $file, array $input)
  {
    if (isset($file)) {
      $data = [];
      $data['movement_start_date'] = $input['start_date'];
      $data['movement_return_date'] = $input['return_date'];
      // $data['user_id'] = $input['user'];
      $data['file_id'] = $file->id;
//      $this->closeAllExistingMovementsForFile($data['file_id']);
      if (empty($data['movement_return_date'])) {
        $this->closeAllExistingMovementsForFile($file->id);
      }
      $item = $this->model::create($data);
      if (empty($item->movement_return_date)) {
        $file->current_movement_id = $item->id;
        $file->save();
      }
    }
  }

  public function update(FileMovement $model, array $input)
  {
    $data=[];
    $data['file_id']=$input['file_id'];
    $data['movement_start_date']=$input['movement_start_date'];
    $data['movement_return_date']=$input['movement_return_date'];
    // $data['user_id']=$input['user'];
    return $model->update($data);
  }

  public function returnFileFromIssue(File $file)
  {
    if (isset($file->current_movement_id)) {
      $this->closeAllExistingMovementsForFile($file->id);
      $file->current_movement_id = null;
      $file->save();
    }
  }


  public function getForDataTable($search = '', $order_by = '', $sort = 'asc', $trashed = false)
  {
    $query = $this->model->query();
    if (!empty($search)) {
      $query->whereLike(['movement_start_date','movement_return_date'],$search);
    }
    if ($trashed == "true") {
      return $query->onlyTrashed();
    }
    return $query ;
  }

  private function closeAllExistingMovementsForFile(int $fileid): bool
  {
    if (empty($fileid))
    {
      return false;
    }
    return $this->model->query()
      ->where('file_id', '=', $fileid)
      ->whereNull('movement_return_date')
      ->update(['movement_return_date' => Carbon::now()]);

  }
}
