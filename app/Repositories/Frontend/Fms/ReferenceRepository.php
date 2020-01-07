<?php
namespace App\Repositories\Frontend\Fms;

use Auth;
use App\Exceptions\GeneralException;
use App\Repositories\BaseRepository;
use App\Models\Fms\Reference;

class ReferenceRepository extends BaseRepository
{
  public function __construct(Reference $model)
  {
    $this->model = $model;
  }

  public function create(array $input)
  {
    $data=[];
    $data['reference_code']=$input['reference_code'];
    $data['folder_name']=$input['folder_name'];
    $item=$this->model::create($data);
    $item->save();
  }

  public function update(Reference $model, array $input)
  {
    $data=[];
    $data['reference_code']=$input['reference_code'];
    $data['folder_name']=$input['folder_name'];
    return $model->update($data);

  }

  public function getForDataTable($search = '', $order_by = '', $sort = 'asc', $trashed = false)
  {
    // $user = Auth::user();
    $query = $this->model->query()
      ->select(['id', 'reference_code', 'folder_name']);
    if (!empty($search)) {
      $query->whereLike(['id','reference_code','folder_name'],$search );
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
  public function pluck($column = 'reference_code', $key = 'id')
  {
    return $this->model->query()
      ->orderBy($column)
      ->pluck($column, $key);
  }

  public function findTypeahead($search, int $limit = 10)
  {
    // $user = Auth::user();
    // if (! $user->can('fms.view'))
    // {
    //   throw new GeneralException(__('auth.general_error'));
    // }

    $query = $this->model->query()
      ->select([\DB::raw("concat(reference_code,' ',folder_name) as name"), 'id']);

    if (! empty($search))
    {
      $query->whereLike(['reference_code', 'folder_name'], $search);
    }

    $query->orderBy('folder_name');
    if ($limit > 0)
    {
      $query->take($limit);
    }
    return $query->get();
  }
}
