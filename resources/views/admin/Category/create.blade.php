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

                    <h2>Create New Category</h2>
                    @foreach($errors->all() as $error)
                        <div class="alert alert-danger">
                        {{ $error }}</div>
                    @endforeach
                    <form action="{{route('category.store')}}" method="POST">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label for="formGroupExampleInput">Name</label>
                            <input type="text" class="form-control" name="name_en" required="required" placeholder="Name">
                        </div>
                        <div class="form-group">
                            <label for="formGroupExampleInput">الاسم بالعربى</label>
                            <input type="text" class="form-control" name="name_ar" required="required" placeholder="الاسم بالعربى">
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-10">
                              <input type="submit" value="Create">
                            </div>
                        </div>
                    </form>
                            
                </div>
            </div>
        </div>
    </div>
</div>
@endsection