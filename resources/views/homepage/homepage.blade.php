@extends('homepage.index')
@section('header')
    <title>Bandito Go Green V2</title>

@endsection
@section('slide')

    @include('homepage.layout.slider')

@endsection
@section('contents')
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
                                            @if(Auth::user() == null || Auth::user()->role =='buyer')
                                                <a href="{{ url('product/detail/'.$product->id) }}"><img
                                                        src="{{ url($product->photo) }}" alt=""
                                                        class="img-fluid image1"></a></div>
                                        @else
                                            <a href="{{ url('editproduct/'.$product->id) }}"><img
                                                    src="{{ url($product->photo) }}" alt=""
                                                    class="img-fluid image1"></a></div>

                                    @endif
                                    <div class="text">
                                        <h3 class="h5">
                                            @if(Auth::user() == null || Auth::user()->role =='buyer')

                                                <a href="{{ url('product/detail/'.$product->id) }}">
                                                    {{ $product->name }}
                                                </a>
                                            @else
                                            <a href="{{ url('editproduct/'.$product->id) }}">
                                                {{ $product->name }}
                                            </a>
                                            @endif
                                            </h3>
                                            <p class="price">Rp. {{number_format($product->price) }}</p>
                                    </div>
                                </div>
                        </div>

                        @endforeach
                    </div>
                </div>
                <div class="pages">
                    <p class="loadMore text-center"><a href="{{ url('product') }}" class="btn btn-template-outlined"><i
                                class="fa fa-chevron-down"></i> Load more</a></p>

                </div>
            </div>
        </div>
    </div>
    </div>

@endsection

@section('footer')

@endsection
@show
