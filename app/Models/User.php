<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'users';
	protected $guarded = [];        //tất cả fea đều được phép insert

    public function Media()
    {
        return $this->belongsTo('App\Models\Media','avatar','id');
    }
}
