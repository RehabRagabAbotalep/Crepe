<?php

namespace App\Http\Controllers;

use App\Mail\sendVerification;
use App\User;
use Illuminate\Http\Request;
use Mail;
use Hash;

class ForgetPasswordController extends Controller
{
    public function forgetPassword(Request $request){
    	$request->validate([
    		'email' =>'required|email'
    	]);
    	$user = new User;
    	$user->email = $request->email;

    	$email = $request->email;
    	$thisUser = User::where(['email'=>$email])->first();
    	//dd($thisUser);
      	$this->sendCode($thisUser);
      	return redirect('send');
      	return $user;


    }

    public function sendCode($thisUser){
    	Mail::to($thisUser['email'])->send(new sendVerification($thisUser));
    }
    //sendCodeDone
    public function sendCodeDone($email,$code){
    	$user = User::where(['email'=>$email,'code'=>$code])
    	->first();
    	if($user){
    		return redirect('code');
    	}else{
    		return 'Not Found';
    	}
    }
    //Activation Code
    public function postCode(Request $request){
    	$code = $request->code;

    	$user = User::where(['code'=>$code])->first();
    	if($user){
    		return redirect('reset')->with('status','Correct Code');
    	}
    	else{
    		return back()->with('status','Error Code Check Your Inbox again');
    	}

    }
    //Reset Password
    public function resetPass(Request $request){

    	$request->validate([
    		'email'      =>'email|required',
    		'password'   =>'required|min:8|confirmed',
    		'password_confirmation' =>'required',
    	]);
    	$email = $request->email;
    	$password = hash::make($request->password);
    	$user = User::where(['email'=>$email])->first();
    	if($user){

    		User::where(['email'=>$email])->update(['password'=>$password]);
    		return redirect('signIn')->with('status','Your Password has been Changed');
    	}else{
    		return redirect()->back()
        	->withInput()
        	->withErrors([
            'Error' => 'Your Email is Incorrect Please try again.',
        ]);
    	}


    }

}
