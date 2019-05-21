<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $fillable = [
    	'street_name','building_number','floor_number',
    	'special_sign','address_description','user_id'
    ];
    public function user(){
    	return $this->belongsTo(User::class);
    }
}
