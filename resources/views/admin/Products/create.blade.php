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

                    <h2>Add New Product</h2>
                    @foreach($errors->all() as $error)
                        <div class="alert alert-danger">
                        {{ $error }}</div>
                    @endforeach

                    <form action="{{route('product.store')}}" enctype="multipart/form-data" method="POST">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label for="formGroupExampleInput">Name</label>
                            <input type="text" class="form-control" name="name_en" required="required" placeholder="Name">
                        </div>
                        <div class="form-group">
                            <label for="formGroupExampleInput">الاسم بالعربى</label>
                            <input type="text" class="form-control" name="name_ar" required="required" placeholder="Name">
                        </div>
                        <div class="form-group">
                            <label for="formGroupExampleInput">Description</label>
                            <textarea class="form-control" rows="5" name="description_en"></textarea>
                          </div>
                          <div class="form-group">
                            <label for="formGroupExampleInput">الوصف</label>
                            <textarea class="form-control" rows="5" name="description_ar"></textarea>
                          </div>
                          <div class="form-group">
                            <label for="formGroupExampleInput">Product Price</label>
                            <input type="text" class="form-control" name="price" placeholder="Product price" required="required">
                          </div>
                          <div class="form-group">
                            <label for="formGroupExampleInput">Discount</label>
                            <input type="number" class="form-control" name="discount" placeholder="discount">
                          </div>
                          <div class="form-group">
                              <label>Category</label>
                              <select name="category_id">
                                  <option value="0">Select</option>
                                  @foreach($categories as $category)
                                    <option value="{{$category->id}}">{{$category->name_en}}</option>
                                  @endforeach
                              </select>
                          </div>
                          <div class="form-group">
                            <label for="formGroupExampleInput">Product Image</label>
                            <input type="file" name="image">
                          </div>
                        <div class="form-group row">
                            <div class="col-sm-10">
                              <input type="submit" value="Create Product">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection