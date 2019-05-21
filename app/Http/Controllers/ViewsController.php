<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class ViewsController extends Controller
{	//get SignUp Form
   public function signUp(){
   	return view('frontend.signUp');
   }


   //get SignIn Form
   public function signIn(){
   	return view('frontend.signIn');
   }

   //complete Register with Facebook
   public function completeRegister(){
   	return view('frontend.completeSignUp');
   }
   //index Page
   public function index(){
   	return view('layout.home');
   }

    //VerifyEmail Page
   public function verifyEmail(){
      return view('email.verify');
   }

   //forgetPassword View
   public function forgetPassword(){
      return view('email.forgetPassword');
   }
   //send Activation Code To Reset Password
   public function sendCode(){
      return view('email.sendCode');
   }
   //Enter Verification Code
   public function code(){
      return view('email.code');
   }
   //Reset Password View
   public function reset(){
      return view('email.reset');
   }

   
   
}
