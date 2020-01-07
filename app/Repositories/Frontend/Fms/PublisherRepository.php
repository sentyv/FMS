<?php
namespace App\Repositories\Frontend\Fms;

use App\Repositories\BaseRepository;
use App\Models\Fms\Publisher;

class PublisherRepository extends BaseRepository
{
  public function __construct(Publisher $model)
  {
    $this->model = $model;
  }

  public function create(array $input)
  {
    $data=[];
    $data['publisher_name']=$input['publisher_name'];
    $data['publisher_full_name']=$input['publisher_full_name'];
    $item=$this->model::create($data);
    $item->save();
  }

  public function update(Publisher $model, array $input)
  {
    $data=[];
    $data['publisher_name']=$input['publisher_name'];
    $data['publisher_full_name']=$input['publisher_full_name'];
    return $model->update($data);

  }

  public function getForDataTable($search = '', $order_by = '', $sort = 'asc', $trashed = false)
  {
    // $user = Auth::user();
    $query = $this->model->query()
      ->select(['id', 'publisher_name', 'publisher_full_name']);
    if (!empty($search)) {
      $query->whereLike(['publisher_name'],$search )
        ->whereLike(['publisher_full_name'],$search );
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
  public function pluck($column = 'publisher_name', $key = 'id')
  {
    return $this->model->query()
      ->orderBy($column)
      ->pluck($column, $key);
  }
}
