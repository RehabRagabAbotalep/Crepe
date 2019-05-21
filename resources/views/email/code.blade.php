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
                    	<form action="{{route('postCode')}}" method="POST">
                    		{{ csrf_field() }}
                    		<div class="form-group">
	                            <label for="formGroupExampleInput">Activation Code</label>
	                            <input type="text" class="form-control" name="code" required="required" placeholder="Code">
                          	</div>
                          	<div class="form-group row">
                            	<div class="col-sm-10">
                              		<button type="submit" class="login">Save</button>
                              	</div>
                            </div>
                    	</form>
                    </div>
                </div>
            </div>
        </div>
	</div>
@endsection