<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Laravel\Socialite\Facades\Socialite;
use App\User;
use Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }


    public function redirectToProvider()
    {
        return Socialite::driver('facebook')->redirect();
    }

    /**
     * Obtain the user information from facebook.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback(User $user)
    {
        $facebook = Socialite::driver('facebook')->stateless()->user();
        if(User::where('email', '=', $facebook->email)->first()){
            $checkUser = User::where('email', '=', $facebook->email)->first();
            Auth::login($user);
            return redirect('home')->with('status','Welcome You are Loged in');
           
             }
        $user ->name = $facebook->getName();
        $user ->email = $facebook->getEmail();
        $user ->phoneNumber = 'Null';
        $user ->password = bcrypt('1234');
        $user ->code = 'Null';
        $user ->status = 1;
        $user ->save();
        Auth::login($user);
        return redirect('/complete/register');

         
        

}

}
