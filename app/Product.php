<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{	
	public $timestamps = false;
    protected $fillable = [
    	'name_en',
    	'name_ar',
    	'description_en',
    	'description_ar',
    	'discount',
    	'price',
    	'totalPrice',
    	'category_id',
    	'image'
    ];

    public function category(){
    	return $this->belongsTo(Category::class);
    }

    public function setImageAttribute($value){
        if(is_file($value)){
            if($value){
                $name = rand(0000,9999).time().'.'.$value
                ->getClientOriginalExtension();
                $value->move(public_path('uploads/'.class_basename($this)),$name);
                $this->attributes['image'] = $name;
            }

        }else{
            $this->attributes['image'] = $value;
        }
    }

        public function getTotalPrice( $price , $discount ){
        	if($discount){
        		$this->attributes['totalPrice'] = 
        		round((1-($discount/100))*$price,2);
        	}else{
        		$this->attributes['totalPrice'] = $price;
        	}
        	
        }
   

    /*public function getImageAttribute($value){
    	return $value ? asset('uploads/'.class_basename($this).'/'.$value) : "";
    }*/
}
