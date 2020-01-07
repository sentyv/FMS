<?php

namespace App\Models\Fms;

use Illuminate\Database\Eloquent\Model;

class Reference extends Model
{
    protected $table = 'references';
    
      protected $fillable = [
        'reference_code',
        'folder_name'
      ];
    
      public function file(){
        return $this->belongsToMany(File::Class);
      }
    
      public function getDisplayName() {
        return $this->reference_code . ' ' . $this->folder_name;
      }
}