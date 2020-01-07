<?php
namespace App\Repositories\Frontend\Fms;

use App\Repositories\BaseRepository;
use App\Models\Fms\File;
use DB;

class FileRepository extends BaseRepository
{
  public function __construct(File $model)
  {
    $this->model = $model;
  }

  public function create(array $input)
  {
    $data=[];
    $data['file_subject_title']=$input['file_subject_title'];
    $data['file_author_name']=$input['file_author_name'];
    $data['file_published_date']=$input['file_published_date'];
    $data['file_received_date']=$input['file_received_date'];
    // $data['file_name']=$input['file_name'];
    // $data['status']=(isset($input['status']) && filter_var($input['status'], FILTER_VALIDATE_BOOLEAN));
    $data['file_reference_id']=$input['file_reference_id'];
    $data['file_publisher_id']=$input['file_publisher_id'];
    $item=$this->model::create($data);
    $item->save();
  }

  public function update(File $model, array $input)
  {
    $data=[];
    $data['file_subject_title']=$input['file_subject_title'];
    $data['file_author_name']=$input['file_author_name'];
    $data['file_published_date']=$input['file_published_date'];
    $data['file_received_date']=$input['file_received_date'];
    // $data['file_name']=$input['file_name'];
    // $data['status']=(isset($input['status']) && filter_var($input['status'], FILTER_VALIDATE_BOOLEAN));
    $data['file_reference_id']=$input['file_reference_id'];
    $data['file_publisher_id']=$input['file_publisher_id'];
    return $model->update($data);

  }

  public function getForDataTable($search = '', $order_by = '', $sort = 'asc', $trashed = false)
  {
    $query = $this->model->query()
      ->leftJoin('fms.file_movements', 'file_movements.id', '=', 'current_movement_id')
      ->leftjoin('app.users', 'file_movements.user_id', '=', 'users.id')
      ->select([ 'files.id', 'file_subject_title', 'file_author_name', 'file_published_date', 'file_received_date', 'current_movement_id as movement_id', DB::raw("concat(first_name, ' ',last_name) as name")]);

    if (!empty($search)) {
      $query->whereLike(['file_subject_title','file_author_name','first_name','last_name'],$search);
    }

    if ($trashed == "true") {
      return $query->onlyTrashed();
    }
    return $query ;
  }

  /**
   * Create $key => $value array for all available items.
   *
   * @param string $column
   * @param string $key
   * @return mixed
   */
  public function pluck($column = 'file_subject_title', $key = 'id')
  {
    return $this->model->query()
      ->orderBy($column)
      ->pluck($column, $key);
  }
}
