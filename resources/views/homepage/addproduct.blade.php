@extends('homepage.index')
@section('header')
<title>Bandito Go Green</title>

@endsection
@section('slide')

@endsection
@section('contents')
<div id="heading-breadcrumbs">
    <div class="container">
        <div class="row d-flex align-items-center flex-wrap">
            <div class="col-md-7">
                <h1 class="h2">Add Product</h1>
            </div>
            <div class="col-md-5">
                <ul class="breadcrumb d-flex justify-content-end">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item active">Add Product</li>
                </ul>
            </div>
        </div>
    </div>
</div>
<div id="content">
    <div class="container">
        <div class="row bar mb-0">
            <div id="customer-orders" class="col">
                <p class="text-muted lead">Menambahkan Product</p>
                <div class="box mt-0 mb-lg-0">
                    <div class="table-responsive">
                        <form role="form" action="{{ url('addproduct') }}" method="POST" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Name</label>
                                    <input type="text" class="form-control" placeholder="Enter Product" name="name" required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Description</label>
                                    <textarea name="description" class="form-control" required placeholder="Enter your description"></textarea>

                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Stock</label>
                                    <input type="number" class="form-control" placeholder="Enter your Stock" name="stock" required min="0">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Price (Rupiah)</label>
                                    <input type="number" class="form-control" placeholder="Enter your Price" name="price" required min="0">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Weight (Kg)</label>
                                    <input type="number" class="form-control" placeholder="Enter your Weight" name="weight" required min="1">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Category</label>
                                    <select class="form-control" name="category_id">
                                        <option value="">Select</option>
                                        @foreach($category as $categorys)
                                        <option value="{{ $categorys->id }}">{{ $categorys->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Photo</label>
                                    <input type="file" class="form-control" placeholder="Enter Icon Font Awesome" name="file">
                                </div>
                            </div>
                            <!-- /.box-body -->
                            <div class="box-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('footer')
@endsection
@show
