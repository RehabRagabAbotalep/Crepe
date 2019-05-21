<?php

namespace App\Http\Controllers;

use App\Address;
use App\User;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    public function create(){
    	return view('User.addAddress');
    }

    public function store(Request $request){
    	$user_id = auth()->user()->id;
    	$user_address = Address::where('user_id',$user_id);
    	//dd(count($user_address));
    	if(count($user_address)<=3){
    		$request->validate([
    		'street_name'=>'required|min:4',
    		'building_number'=>'required',
    		'floor_number'=>'required',
    	]);
    	//dd($request->all());
    	$address = new Address;
    	$address->street_name = $request->street_name;
    	$address->building_number = $request->building_number;
    	$address->floor_number = $request->floor_number;
    	$address->special_sign = $request->special_sign;
    	$address->address_description = $request->address_description;
    	$address->user_id = $user_id;
    	$address->save();
    	//dd($address);
    	return back()->with('status','Added Sucessfuly');

    	}
    	else{
    		return back()->with('status','Cant add more than Three Address');
    	}
    	
    	

    }
}
