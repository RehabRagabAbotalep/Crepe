<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Hash;
//use App\Http\Requests\UserUpdateRequest;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return view('admin.User.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   


        return view('admin.user.create');

       
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
        'name'  =>'required|string|min:3|max:20',
        'email' => 'required|email|unique:users',
        'password' => 'required|min:8|confirmed',
        'password_confirmation' =>'required',
        'phoneNumber' => 'required|unique:users|min:11',
       ]);

       $user = new User;
       $user -> name = $request -> name;
       $user -> email = $request -> email;
       $user -> password =hash::make($request->password);
       $user -> phoneNumber = $request -> phoneNumber;
       $user -> code = rand( 1000,9999 );
       $user -> status = 1;
       $user -> save();
       return back()->with('status','User has been Created Sucessfuly');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        return view('admin.User.edit',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {   
        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = hash::make($request->password);
        $user->phoneNumber = $request->phoneNumber;
        $user->status = $request->status ? 1 : 0 ?? 0;
        $user -> save();
        return redirect('users')->with('status','User Updated Sucessfuly');

        /*$requestArray = $request->all();
        if(isset($requestArray['password']) && $requestArray['password'!=""])
        {
            $requestArray['password']=hash::make($requestArray['password']);
        }else{
            unset($requestArray['password']);
        }

        $user->update($requestArray);
        return redirect('users')->with('status','User Updated Sucessfuly');*/
        
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $user ->delete();
        return redirect('users')->with('status','User deleted Sucessfuly');
    }
}
