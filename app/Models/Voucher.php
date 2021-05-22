<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Voucher extends Model
{
    protected $table = 'voucher';
    protected $fillable=[
    	'code','name','description','max_uses_user','used_user','discount_amount','starts_at','expires_at','type'
    ];
}
