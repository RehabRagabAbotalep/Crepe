@extends('admin.layout')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
            	<div class="card-body">
            		@if( $categories->isEmpty() )
            			<h1>No Categorise</h1>
            		@else
            		<h1>All Categories</h1>
            		<p>Total:{{count($categories)}}</p>
            		
            		@if(session('status'))
            			<div class="alert alert-danger">{{session('status')}}</div>
            		@endif
            		<table class="table table-bordered">
	            		<thead>
	            			<tr>
	            				<th>ID</th>
	            				<th>Name</th>
                                <th>ِArabicName</th>
	            				<th>Edit</th>
	            				<th>Delete</th>
	            			</tr>
	            		</thead>
	            		<tbody>
	            			@foreach($categories as $category)
	            				<tr>
	            					<td>{{$category->id}}</td>
	            					<td>{{$category->name_en}}</td>
                                    <td>{{$category->name_ar}}</td>
	            					<td><a href="{{route('category.edit',['id'=>$category->id])}}">Edit</a></td>
	            					<td><a href="{{route('category.delete',['id'=>$category->id])}}">Delete</a></td>
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