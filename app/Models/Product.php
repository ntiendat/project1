<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'product';
    public function ProductMedia(){
    	return $this->hasMany('App\Models\ProductMedia','product_media_id','id');
    }
    public function Media(){
    	return $this->hasOne('App\Models\Media','id','product_media_id');
    }
    public function lang(){
    	return $this->hasMany('App\Models\ProductLang','product_parent_id','id');
    }
    public function lang2(){
    	return $this->hasOne('App\Models\Lang','id','lang_id');
    }
    
    // public function TypeProduct(){
    //     return $this->hasManyThrough('App\TypeProduct','App\Product','id_product','id_type','id');
    // }
}
