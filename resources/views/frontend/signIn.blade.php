@extends('layout.master2')
@section('content')
<div class="container">
	<div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                      @if(session('status'))
                      <div class="alert alert-success">
                              {{ session('status') }}
                          </div>
                      @endif
                      @foreach( $errors->all() as $error )
                        <div class="alert alert-danger">
                          {{ $error }}
                        </div>
                      @endforeach
                    	<h3>LOGIN</h3>
                    <a class="facebook" href="{{route('facebook.login')}}">
                        <i class="fab fa-facebook fa-2x"></i>
                        COTINUE WITH FACEBOOK
                      </a>
                		<span>OR</span>
                    <form action="{{route('login')}}" method="post">
                      {{ csrf_field() }}
                      <div class="form-group">
                        <input type="text" class="form-control" name="email" placeholder="Email Or PhoneNumber">
                      </div>
                      <div class="form-group">
                        <input type="password" class="form-control" name="password" placeholder="Password">
                      </div>
                      <div class="form-group">
                        <input type="submit" class="login" name="submit" value="Login">
                      </div>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
	  	
				
	
@endsection