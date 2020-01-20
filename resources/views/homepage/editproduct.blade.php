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
                <h1 class="h2">Edit Product</h1>
            </div>
            <div class="col-md-5">
                <ul class="breadcrumb d-flex justify-content-end">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item active">Edit Product</li>
                </ul>
            </div>
        </div>
    </div>
</div>
<div id="content">
    <div class="container">
        <div class="row bar mb-0">
            <div id="customer-orders" class="col">
                <p class="text-muted lead">Melakukan Pembaharuan Data Produk Sampah Plastik</p>
                <div class="box mt-0 mb-lg-0">
                    <form role="form" action="{{ url('editproduct') }}" method="POST" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="box-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Name</label>
                                <input type="text" class="form-control" placeholder="Enter Product" name="name" value="{{ $product->name }}" required>
                            </div>
                            <input type="hidden" name="id" value="{{ $product->id }}" required>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Description</label>
                                <textarea name="description" class="form-control" required>{{ $product->description }}</textarea>

                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Stock </label>
                                <input type="number" class="form-control" placeholder="Enter your Stock" name="stock" value="{{ $product->stock }}" required>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Price (Rupiah)</label>
                                <input type="number" class="form-control" placeholder="Enter your Price" name="price" value="{{ $product->price }}" required>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Weight (Kg)</label>
                                <input type="number" class="form-control" placeholder="Enter your Price" name="weight" value="{{ $product->weight }}" required>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Category</label>
                                <select class="form-control" name="category_id" required>
                                    @foreach($category as $categorys)
                                    <option @if($product->category_id == $categorys->id)
                                        selected="selected"
                                        @endif
                                        value="{{ $categorys->id }}">{{ $categorys->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Photo</label>
                                <div class="row">
                                    <div class="col-md-6">
                                        <input type="file" class="form-control" name="file">
                                    </div>
                                    <div class="col-md-6">
                                        <img src="{{ url($product->photo) }}" width="150px">
                                        <input type="hidden" name="tmp_image" value="{{ $product->photo }}" required>
                                    </div>
                                </div>
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
@endsection
@show
