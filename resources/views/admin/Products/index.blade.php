@extends('admin.layout')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-20">
            <div class="card">
            	<div class="card-body">
            		
            		@if( $products->isEmpty() )
						<p>No Products</p>
					@else
						@if(session('status'))
							<div class="alert alert-success">
								{{session('status')}}
							</div>
						@endif
						<h1>All Products</h1>
						<strong>Total::</strong>{{count($products)}}
						<table class="table table-bordered table-hover table-sm">
							<thead>
								<tr>
									<th scope="col">ID</th>
									<th scope="col">Name</th>
									<th scope="col">ِArabicName</th>
									<th scope="col">Description</th>
									<th scope="col">ArabicDescription</th>
									<th scope="col">Price</th>
									<th scope="col">Discount</th>
									<th scope="col">Price-after-discount</th>
									<th scope="col">Image</th>
									<th scope="col">Category</th>
									<th scope="col">Edit</th>
									<th scope="col">Delete</th>
								</tr>
							</thead>
							<tbody>
								@foreach($products as $product)
									<tr>
										<td>{{$product->id}}</td>
										<td>{{$product->name_en}}</td>
										<td>{{$product->name_ar}}</td>
										<td>{{$product->description_en}}</td>
										<td>{{$product->description_ar}}</td>
										<td>{{$product->price}} LE</td>
										<td>
											@if($product->discount)
												{{$product->discount}}%
											
											@else
												<p>No Discount</p>
											@endif
										</td>
										<td>{{$product->totalPrice}} LE</td>
										<td><img src="images/{{$product->image}}" width="50px" height="50px"></td>

										<td>{{$product->category->name_en}}</td>
										<td><a href="{{route('product.edit',['id'=>$product->id])}}">Edit</a></td>
										<td><a href="{{route('product.delete',['id'=>$product->id])}}">Delete</a></td>

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