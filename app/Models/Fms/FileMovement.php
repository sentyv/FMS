<?php

namespace App\Models\Fms;

use Illuminate\Database\Eloquent\Model;

class FileMovement extends Model
{
    protected $table = 'file_movements';
    
      protected $fillable = [ 'file_id', 'movement_start_date','movement_return_date' ];
    
      protected $dates = [ 'movement_start_date', 'movement_return_date' ];
    
      public function file() {
        return $this->belongsTo(File::Class);
      }
    
      public function user() {
        return $this->belongsTo(User::Class);
      }
    
}
