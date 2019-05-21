@extends('layout.master2')
@section('content')
	<div class="container">
		<div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                    	@if(session('status'))
                    		<div class="alert alert-success">
                    			{{session('status')}}
                    		</div> 
                    	@endif
                    	@foreach( $errors->all() as $error )
                    		<div class="alert alert-danger">
                    			{{$error}}
                    		</div>
                    	@endforeach
                    	<form action="{{route('sendCode')}}" method="post">
                    		{{ csrf_field() }}
                    		<div class="form-group">
	                            <label for="formGroupExampleInput">E-Mail Address</label>
	                            <input type="email" class="form-control" name="email" required="required" placeholder="E-Mail">
                          	</div>
                          	<div class="form-group row">
                            	<div class="col-sm-10">
                              		<button type="submit" class="login">Forget Password</button>
                              	</div>
                            </div>
                    	</form>
                    </div>
                </div>
            </div>
        </div>
	</div>
@endsection