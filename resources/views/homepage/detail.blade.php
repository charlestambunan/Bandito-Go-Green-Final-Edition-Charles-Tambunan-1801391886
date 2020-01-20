@extends('homepage.index')
@section('header')
    <title>Bandito Go Green V2</title>

@endsection
@section('contents')

    <div id="heading-breadcrumbs">
        <div class="container">
            <div class="row d-flex align-items-center flex-wrap">
                <div class="col-md-7">
                    <h1 class="h2">{{ $products->name }}</h1>
                </div>
                <div class="col-md-5">
                    <ul class="breadcrumb d-flex justify-content-end">
                        <li class="breadcrumb-item"><a href="/">Home</a></li>
                        <li class="breadcrumb-item active">Detail</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div id="content">
        <div class="container">
            <div class="row bar">
                <div class="col-md-9">
                    <div id="productMain" class="row">
                        <div class="col-sm-6">
                            <div data-slider-id="1" class="owl-carousel shop-detail-carousel">
                                <div><img src=" {{ url($products->photo) }}" alt="" class="img-fluid"></div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="box">
                                <form action="{{ url('cart') }}" method="POST">
                                    {{ @csrf_field() }}
                                    <p class="price" style="margin:0px 0px;">
                                        Rp. {{ number_format($products->price)}}</p>
                                    <br>
                                    @if($products->stock <1 ) <p class="text-center">Habis</p>
                                    @else
                                        <div class="sizes">
                                            <select class="form-control-sm col-sm-4" name="qty">
                                                @for($i = 1; $i <= $products->stock; $i++)
                                                    <option value="{{$i}}">{{$i}}</option>
                                                @endfor
                                            </select>
                                            <br>
                                        </div>
                                    @endif

                                    <input type="hidden" name="productId" value="{{$products->id}}">
                                    <br><br>
                                    <p class="text-center">
                                        @if(Auth::user())
                                            @if($products->stock > 0 )
                                                @if(Auth::user()->role == 'buyer')
                                                    <button type="submit" class="btn btn-template-outlined"><i
                                                            class="fa fa-shopping-cart"></i> Add to cart
                                                    </button>
                                                @endif
                                            @else
                                                <button type="submit" class="btn btn-template-outlined" disabled><i
                                                        class="fa fa-shopping-cart"></i> Add to cart
                                                </button>
                                            @endif
                                        @else
                                            <small>Login dahulu untuk melakukan transaksi</small>
                                        @endif
                                    </p>
                                </form>
                            </div>

                        </div>
                    </div>
                    <div id="details" class="box mb-4 mt-4">
                        <h4>Penjual</h4>
                        {{ $products->user_name }}
                        <br><br>
                        <h4>Weight</h4>
                        {{ $products->weight }} KG
                        <br><br>
                        <h4>Product details</h4>
                        {!! $products->description !!}
                        <br><br>
                        <!--Menampilkan nomor telepon si Penjual-->
                        <h4>No Telepon Penjual</h4>
                        {{ $products->phone}}
                    </div>
                    <!-- <div class="row"> -->
                </div>
                <!-- </div> -->
            </div>
        </div>
    </div>


@endsection

@section('footer')

@endsection
@show
