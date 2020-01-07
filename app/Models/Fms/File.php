<?php

namespace App\Models\Fms;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    protected $table = 'Files';
    
        protected $fillable = [
              'file_subject_title'
              ,'file_author_name'
              ,'file_published_date'
              ,'file_received_date'
              ,'file_name'
            //   ,'status'
              ,'file_reference_id'
              ,'file_publisher_id'
        ];
    
        protected $dates = [ 'file_published_date', 'file_received_date' ];
    
        public function publisher(){
            return $this->hasOne(Publisher::Class);
        }
    
        public function reference(){
            return $this->hasOne(Reference::Class, 'id', 'file_reference_id');
        }
        public function movements(){
            return $this->hasMany(FileMovement::Class, 'file_id','id');
        }
        public function currentLocation(){
          return $this->hasOne(FileMovement::Class, 'id','current_movement_id');
        }
}
