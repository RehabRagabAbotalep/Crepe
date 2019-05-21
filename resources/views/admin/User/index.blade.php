@extends('admin.layout')

@section('content')
	<div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                    	@if(session('status'))
                    		<div class="alert alert-success">
                    			{{session('status')}}
                    		</div>
                    	@endif
                    	@if( $users->isEmpty() )
                    		<p>No Users</p>
                    	@else
                        <h3> All Users</h3>
                        <h5> Total:: {{ count($users) }}</h5>
                        <table class="table table-bordered">
                        	<thead>
                        		<tr>
                        			<th>ID</th>
                        			<th>Name</th>
                        			<th>Email</th>
                        			<th>PhoneNumber</th>
                        			<th>Status</th>
                        			<th>Edit</th>
                        			<th>Delete</th>
                        		</tr>
                        	</thead>
                        	<tbody>
                        		@foreach($users as $user)
                        			<tr>
                        				<td>{{$user->id}}</td>
                        				<td>{{$user->name}}</td>
										<td>{{$user->email}}</td>
										<td>{{$user->phoneNumber}}
										</td>
										<td>{{$user->status}}</td>
										<td><a href="{{route('user.edit',['id'=>$user->id])}}">Edit</a></td>
										<td><a href="{{route('user.delete',['id'=>$user->id])}}">Delete</a></td>
                        			</tr>
                        		@endforeach
                        	</tbody>
                        </table>
                       @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection