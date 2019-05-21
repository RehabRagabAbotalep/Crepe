@extends('admin.layout')

@section('content')
	<div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h4>Update User: {{$user->name}}</h4>
                        <form action="{{route('user.update',['id'=>$user->id])}}" method="post">
                         {{ csrf_field() }}

                            <div class="form-group">
                            <label for="formGroupExampleInput">Name</label>
                            <input type="text" class="form-control" name="name" value="{{$user->name}}">
                          </div>
                            <div class="form-group">
                            <label for="formGroupExampleInput">E-mail</label>
                            <input type="email" class="form-control" name="email" value="{{$user->email}}">
                          </div>
                            <div class="form-group">
                            <label for="formGroupExampleInput">Password</label>
                            <input type="password" class="form-control" name="password">
                          </div>
                           <div class="form-group">
                            <label for="formGroupExampleInput">Confirm Password</label>
                            <input type="password" class="form-control" name="password_confirmation">
                          </div>
                          <div class="form-group">
                            <label for="formGroupExampleInput">Phone Number</label>
                            <input type="number" class="form-control" name="phoneNumber" value="{{$user->phoneNumber}}">
                          </div>
                           <div class="form-group form-check">
                            <input type="checkbox" class="form-check-input" name="status" checked="checked">
                            <label class="form-check-label" for="exampleCheck1">Active</label>
                          </div>
                          <div class="form-group row">
                            <div class="col-sm-10">
                              <button type="submit">Update</button>
                            </div>
                          </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection