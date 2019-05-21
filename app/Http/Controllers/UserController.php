<?php

namespace App\Http\Controllers;
use App\Mail\verifyEmail;
use App\User;
use Auth;
use Hash;
use Illuminate\Http\Request;
use Mail;
class UserController extends Controller
{   //Register
    public function register(Request $request){
    	$request->validate([
    		'name'       => 'required|min:3|max:20|string',
    		'email'      =>'email|required|unique:users',
    		'password'   =>'required|min:8|confirmed',
    		'password_confirmation' =>'required',
    		'phoneNumber' =>'required|unique:users|min:11'
    	]);

    	$user = new User;
    	$user -> name = $request->name;
    	$user -> email = $request->email;
    	$user -> password = hash::make($request->password);
    	$user -> phoneNumber = $request->phoneNumber;
      $user -> code = rand ( 1000 , 9999 );
    	$user ->save();
      
      $thisUser = User::findOrFail($user->id);
      $this->sendEmail($thisUser);
      return redirect('verify');
      return $user;
       
    	
   }

    //sendEmail
    public function sendEmail($thisUser){
      Mail::to($thisUser['email'])->send(new verifyEmail($thisUser));
    }

    //sendEmailDone
    public function sendEmailDone($email,$code){
      $user = User::where(['email'=>$email,'code'=>$code])->first();
      if($user){

        User::where(['email'=>$email,'code'=>$code])->update(['status'=>1]);
        return redirect('home')->with('status','Congrats Your Registeration has been Completed');

      }else{
        return back()->with('status', 'User not Found');
      }
    }

   //Enter Phone Number after Register by Facebook Account
    public function completeRegister(Request $request,$id){
   	   $request->validate([
   	   	'phoneNumber' =>'required|unique:users|min:11'
   	   ]);
   	   $id = Auth::user()->id;
   	   $user = User::find($id);
   	   //dd($user);
   	   $user -> phoneNumber = $request->phoneNumber;
   	   $user->save();
   	   Auth::login($user);
   	   return redirect('home')->with('status',' Congrats You are Loged In :)');
   }

   //Login Function
    public function login(Request $request)
    {
      $this->validate($request, [
          'login'    => 'required',
          'password' => 'required',
      ]);

      $login_type = filter_var($request->input('login'), FILTER_VALIDATE_EMAIL ) 
          ? 'email' 
          : 'phoneNumber';

      $request->merge([
          $login_type => $request->input('login')
      ]);

      if (Auth::attempt($request->only($login_type, 'password'))) {
          return redirect('home')->with('status','Welcome ' . auth::user()->name);
      }

      return redirect()->back()
          ->withInput()
          ->withErrors([
              'login' => 'Your inputs are Incorrect Please try again.',
          ]);
    } 


}
