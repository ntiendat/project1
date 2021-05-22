<?php

namespace App\Models;

use App\Models\Product;
class Cart
{
	public $items = null;
	public $totalQty = 0;
	public $totalPrice = 0;
	public $product_id = 0;
	public $coupon = null;
	

	public function __construct($oldCart){
		if($oldCart){
			$this->items = $oldCart->items;
			$this->totalQty = $oldCart->totalQty;
			$this->totalPrice = $oldCart->totalPrice;
			$this->coupon = $oldCart->coupon;
		}
	}

	public function add($item, $id){
	  $giohang = ['qty'=>0, 'unit_price' => $item->price_or_promotion_price,'product_id'=>$item->id, 'price' => $item->price, 'promotion_price' => $item->promotion_price, 'item' => $item];
	  if($this->items){
	   if(array_key_exists($id, $this->items)){
	    $giohang = $this->items[$id];
	   }
	  }
	  $giohang['qty']++;
	  if($item->promotion_price == 0) {
	   $item->price_or_promotion_price = $item->price;
	  } else {
	   $item->price_or_promotion_price = $item->promotion_price;
	  }
	  $giohang['unit_price'] = $item->price_or_promotion_price * $giohang['qty'];
	  $this->items[$id] = $giohang;
	  $this->totalQty++;
	  if($item->promotion_price == 0) {
	   $this->totalPrice +=  $item->price;
	  }else {
	   $this->totalPrice +=  $item->promotion_price;
	  }
	}
	public function add_detail($item, $id,$quantity){
	  $giohang = ['qty'=>0, 'unit_price' => $item->price_or_promotion_price,'product_id'=>$item->id, 'price' => $item->price, 'promotion_price' => $item->promotion_price, 'item' => $item];
	  if($this->items){
	   if(array_key_exists($id, $this->items)){
	    $giohang = $this->items[$id];
	   }
	  }
	  $giohang['qty'] += $quantity;

	  if($item->promotion_price == 0) {
	   $item->price_or_promotion_price = $item->price;
	  } else {
	   $item->price_or_promotion_price = $item->promotion_price;
	  }

	  $giohang['unit_price'] = $item->price_or_promotion_price * $quantity;
	  $this->items[$id] = $giohang;
	  $this->totalQty += $giohang['qty'];

	  $this->totalPrice += $giohang['unit_price'];
	}
	public function updateItem($item,$id,$quantity) {
		
		if($this->items[$id]['promotion_price'] == 0) {
				$this->items[$id]['unit_price'] = $this->items[$id]['price'];
	  	}else {
	   		$this->items[$id]['unit_price'] = $this->items[$id]['promotion_price'];
	  	}

		$oldTotalPrice =  $this->items[$id]['unit_price']*$this->items[$id]['qty'];

		$this->items[$id]['qty'] = $quantity; 
		$this->items[$id]['unit_price'] = $quantity * $this->items[$id]['unit_price'];

		$totalQty = 0;
		foreach ($this->items as $key => $value) {
			# code...
			$totalQty = $totalQty + $value['qty'];
		}
		$this->totalQty = $totalQty;
		$this->totalPrice += $this->items[$id]['unit_price'] - $oldTotalPrice;
	}

	//xóa 1
	public function reduceByOne($id){
		$this->items[$id]['qty']--;
		$this->items[$id]['unit_price'] -= $this->items[$id]['item']['unit_price'];
		$this->totalQty--;
		$this->totalPrice -= $this->items[$id]['item']['unit_price'];
		if($this->items[$id]['qty']<=0){
			unset($this->items[$id]);
		}
	}
	//xóa nhiều
	public function removeItem($id){
		$this->totalQty -= $this->items[$id]['qty'];
		$this->totalPrice -= $this->items[$id]['unit_price'];
		unset($this->items[$id]);
	}
}