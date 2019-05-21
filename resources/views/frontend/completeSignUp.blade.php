@extends('layout.master2')
@section('content')
	<div class="container">
		<h1>Please Complete Your Registeration</h1>
		<div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
						<form action="{{route('register.complete',['id'=>Auth::user()->id])}}" method="POST">
				            @foreach($errors->all() as $error)
				           	<div class="alert alert-danger">{{ $error }}</div>
				            @endforeach
				            @if (session('status'))
	                          <div class="alert alert-success">
	                              {{ session('status') }}
	                          </div>
                        	@endif
				                    
				           	{{ csrf_field() }}

				            <div class="form-group">
					            <label for="formGroupExampleInput">Enter Your Phone Number</label>
					           	<input type="text" class="form-control" name="phoneNumber" required="required" placeholder="Phone">
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