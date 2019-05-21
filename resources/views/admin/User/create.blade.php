@extends('admin.layout')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <h2>Create New User</h2>
                    @foreach($errors->all() as $error)
                           <div class="alert alert-danger">{{ $error }}</div>
                        @endforeach
                    <form action="{{route('user.store')}}" method="post">
                         {{ csrf_field() }}

                            <div class="form-group">
                            <label for="formGroupExampleInput">Name</label>
                            <input type="text" class="form-control" name="name" required="required" placeholder="Name">
                          </div>
                            <div class="form-group">
                            <label for="formGroupExampleInput">E-mail</label>
                            <input type="email" class="form-control" name="email" required="required" placeholder="Email">
                          </div>
                            <div class="form-group">
                            <label for="formGroupExampleInput">Password</label>
                            <input type="password" class="form-control" name="password" required="required" placeholder="Password">
                          </div>
                           <div class="form-group">
                            <label for="formGroupExampleInput">Confirm Password</label>
                            <input type="password" class="form-control" name="password_confirmation" required="required"placeholder="Confirm Password">
                          </div>
                          <div class="form-group">
                            <label for="formGroupExampleInput">Phone Number</label>
                            <input type="number" class="form-control" name="phoneNumber" required="required" placeholder="Phone">
                          </div>
                          <div class="form-group row">
                            <div class="col-sm-10">
                              <button type="submit" class="login">Create An Account</button>
                            </div>
                          </div>
                        </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection