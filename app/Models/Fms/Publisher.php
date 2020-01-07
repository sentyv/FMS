<?php

namespace App\Models\Fms;

use Illuminate\Database\Eloquent\Model;

class Publisher extends Model
{
    protected $table = 'publishers';
    
      protected $fillable = [ 'publisher_name', 'publisher_full_name' ];
    
      protected $dates = [ 'created_at', 'updated_at', 'deleted_at', 'occurred_at' ];
    
      public function file(){
        $this->belongsTo(File::Class);
      }
}
