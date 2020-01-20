@extends('homepage.index')
@section('header')
<title>Bandito Go Green V2</title>

@endsection
@section('slide')

@include('homepage.layout.slider')

@endsection
@section('contents')

<div id="heading-breadcrumbs">
    <div class="container">
        <div class="row d-flex align-items-center flex-wrap">
            <div class="col-md-7">
                <h1 class="h2">{{$name}}</h1>
            </div>
            <div class="col-md-5">
                <ul class="breadcrumb d-flex justify-content-end">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item active">{{$name}}</li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!--Menampilkan Subkategori di halaman produk-->
<div id="content">
    <div class="container">
        <div class="row bar">
            <div class="col-md-9">
                <p class="text-muted lead"></p>
                <div class="row products products-big">
                    @if(count($products)> 0)
                    @foreach($products as $product)
                    <div class="col-lg-4 col-md-6">
                        <div class="product">
                            <div class="image"><a href="shop-detail.html"><img src="{{ url($product->photo) }}" class="img-fluid image1"></a></div>
                            <div class="text">
                                <h3 class="h5"><a href="shop-detail.html"> {{ $product->name }}</a></h3>
                                <p class="price">Rp. {{number_format($product->price) }}</p>
                            </div>
                        </div>
                        @endforeach
                        @else
                        <h4>Sampah Plastik Tidak Tersedia</h4>
                        @endif
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