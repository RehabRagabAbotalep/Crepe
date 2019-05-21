<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Http\Resources\User\UserCollection;
use App\Http\Resources\User\UserResource;
use App\User;
use Hash;
use Auth;
use Validator;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Notifications\SignupActivate;

class UserController extends Controller
{	public $successStatus = 200;

	public function __construct(){
		$this->middleware('auth:api')->except('index','show','signup','login','signupActivate');
	}

    public function index(){
    	return UserCollection::collection(User::all());
    }

    public function show(User $user){
    	return new UserResource($user);
    }

    public function store(UserRequest $request){
    	$user = new User;
      $user -> name = $request -> name;
      $user -> email = $request -> email;
      $user -> password =hash::make($request->password);
      $user -> phoneNumber = $request -> phoneNumber;
      $user -> code = rand( 1000,9999 );
      $user -> status = 1;
      $user -> save();
      return response([
       		'data' =>new UserResource($user)
       	],Response::HTTP_CREATED);

    }

    public function update(Request $request,User $user){
    	$user->update($request->all());
        return response([
            "data"=>new UserResource($user)
        ],Response::HTTP_OK);
    }

   public function destroy(User $user)
    {
        $user->delete();
        return response(null,Response::HTTP_NO_CONTENT);
    }

    //User Register Using anthor way
    public function signup(Request $request){
    	$validator = Validator::make($request->all(),[
    	      'name' =>'required|string|min:3|max:20',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8|confirmed',
            'password_confirmation' =>'required',
            'phoneNumber' => 'required|unique:users|min:11',
    	]);
    	if($validator->fails()){
    		return response()->json(['error'=>$validator
    			->errors()],401); 
    	}
    	$input = $request->all();
    	$input['password'] = bcrypt($input['password']);
    	$input['code'] = rand( 1000,9999 );
    	$input['status'] = 0;
    	$input['activation_token'] = str_random(60);
    	$user = User::create($input);
    	$user->notify(new SignupActivate($user));
        return response()->json([
            'message' => 'Successfully created user!'
        ], 201);
    }

    public function signupActivate($token){

	    $user = User::where('activation_token', $token)->first();
	    if (!$user) {
	        return response()->json([
	            'message' => 'This activation token is invalid.'
	        ], 404);
	    }
	    $user->status = 1;
	    $user->activation_token = '';
	    $user->save();
	    return $user;
	}
		
    //User Login
    public function login(Request $request){
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

      if (Auth::attempt($request->only
      	($login_type, 'password'))) {
      		$user = Auth::user();
      		$success['token'] = $user->createToken('MyToken')
      		->accessToken;
      		return response()->json(['success'=>$success],
      			$this->successStatus);
    	}else{
    		return response()->json(['error'=>'Unauthorised'], 401);
    	}
}
}
