<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GroupTag extends Model
{
    protected $table = 'group_tag';
    public function tag(){
    	return $this->hasMany('App\Models\Tag','group_tag_id','id');
    }
    // public function Media(){
    // 	return $this->hasOne('App\Models\Media','id','product_media_id');
    // }
   
    // public function TypeProduct(){
    //     return $this->hasManyThrough('App\TypeProduct','App\Product','id_product','id_type','id');
    // }
}