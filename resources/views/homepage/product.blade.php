@extends('homepage.index')
@section('header')
<title>Bandito Go Green V2</title>

@endsection
@section('contents')

<div id="heading-breadcrumbs">
    <div class="container">
        <div class="row d-flex align-items-center flex-wrap">
            <div class="col-md-7">
                <h1 class="h2">Sampah Plastik</h1>
            </div>
            <div class="col-md-5">
                <ul class="breadcrumb d-flex justify-content-end">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item active">Produk Sampah Plastik</li>
                </ul>
            </div>
        </div>
    </div>
</div>

<div id="content">
    <div class="container">
        <div class="row bar">
            <div class="col-md-12">
                <p class="text-muted lead text-center">Jual Beli Sampah Plastik</p>
                <div class="products-big">
                    <div class="row products">


                        @foreach($products as $product)


                        <div class="col-lg-3 col-md-4">
                            <div class="product">
                                <div class="image">
                                    <a href="{{ url('product/detail/'.$product->id) }}"><img src="{{ url($product->photo) }}" alt="" class="img-fluid image1"></a></div>
                                <div class="text">
                                    <h3 class="h5"><a href="{{ url('product/detail/'.$product->id) }}">
                                            {{ $product->name }}
                                        </a></h3>
                                    <p class="price">Rp. {{number_format($product->price) }}</p>
                                </div>
                            </div>
                        </div>

                        @endforeach
                    </div>
                </div>
                <div class="pages">
                    <div class=".col-md-12">
                        <center>
                            {{ $products->links() }}
                        </center>
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
