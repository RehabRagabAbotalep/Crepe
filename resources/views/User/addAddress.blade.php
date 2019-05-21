@extends('layout.master2')
@section('content')
	<div class="container">
		<h1>Please Add Your Address</h1>
		<div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-body">
                    	@if(session('status'))
                    		<div class="alert alert-success">
                    		{{session('status')}}
                    	</div>
                    	@foreach($errors as $error)
                    		<div class="alert alert-danger">
                    			{{$error->all()}}
                    		</div>
                    	@endforeach
                    	@endif
                    	<form action="{{route('address.store')}}" method="post">
                    		{{ csrf_field() }}
                    		<div class="form-group">
					            <label for="formGroupExampleInput">Street-Name</label>
					           	<input type="text" class="form-control" name="street_name" required="required">
				            </div>
				            <div class="form-group">
					            <label for="formGroupExampleInput">Building-Number</label>
					           	<input type="number" class="form-control" name="building_number" required="required">
				            </div>
				            <div class="form-group">
					            <label for="formGroupExampleInput">Floor-Number</label>
					           	<input type="number" class="form-control" name="floor_number" required="required">
				            </div>
				            <div class="form-group">
					            <label for="formGroupExampleInput">Special-Sign</label>
					           	<input type="text" class="form-control" name="special_sign">
				            </div>
				            <div class="form-group">
                            <label for="formGroupExampleInput">Description</label>
                            <textarea class="form-control" rows="5" name="address_description"></textarea>
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