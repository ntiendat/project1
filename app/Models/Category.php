<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'category';
    public function Media(){
		return $this->hasOne('App\Models\Media','id','media_id');
    }
}