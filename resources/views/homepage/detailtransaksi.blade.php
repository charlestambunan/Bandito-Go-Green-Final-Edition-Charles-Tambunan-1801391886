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
                <h1 class="h2">Order # {{ $transactionPengirim->code}}</h1>
            </div>
            <div class="col-md-5">
                <ul class="breadcrumb d-flex justify-content-end">
                    <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{url('/cart/myorder')}}">My Orders</a></li>
                    <li class="breadcrumb-item active">Order # 1735</li>
                </ul>
            </div>
        </div>
    </div>
</div>
<div id="content">
    <div class="container">
        <div class="row bar">
            <div id="customer-order" class="col">
                <p>Apabila anda menggunakan metode pembayaran Cash Before Delivery atau CBD maka Anda wajib mentransfer uang ke rekening Admin atas nama Bandito Go Green 28921812112
                    <div class="box">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th class="border-top-0">Product</th>
                                        <th class="border-top-0"></th>
                                        <th class="border-top-0">Qty</th>
                                        <th class="border-top-0 text-right">Price</th>
                                        <th class="border-top-0 text-right">Sub Total</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @php
                                    $gt = 0;
                                    @endphp
                                    @foreach($transactiondetail as $td)
                                    <tr>

                                        <td><img src="{{ url($td->photo) }}" alt="Black Blouse Armani" class="img-fluid">
                                        </td>
                                        <td>{{ $td->name }}</td>
                                        <td>{{ $td->qty }}</td>
                                        <td class="text-right">Rp.{{ number_format($td->price) }}</td>
                                        <td class="text-right">Rp.{{ number_format($td->subtotal) }}</td>
                                    </tr>
                                    <?php $gt = $gt + $td->subtotal; ?>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="4" class="text-right "><b>Grand total</b></td>
                                        <td class="text-right ">Rp.{{ number_format($gt) }}</td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <div class="row addresses">
                            <div class="col-md-6 text-right">
                                <h3 class="text-uppercase">Pengirim</h3>
                                <table class="table table-borderless">
                                    <tbody>
                                        <tr>
                                            <th scope="row">Username</th>
                                            <td>{{ $transactionPengirim->name }}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Address</th>
                                            <td>{{ $transactionPengirim->address }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-md-6 text-right">
                                <h3 class="text-uppercase">Penerima</h3>
                                <table class="table table-borderless">
                                    <tbody>
                                        <tr>
                                            <th scope="row">Name</th>
                                            <td>{{ $transactionPenerima->name }}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Phone</th>
                                            <td>{{ $transactionPenerima->phone }}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Address</th>
                                            <td>{{ $transactionPenerima->address }}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">City</th>
                                            <td>{{ $transactionPenerima->city }}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Zip Code</th>
                                            <td>{{ $transactionPenerima->zip }}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Metode Pengiriman</th>
                                            @if($transactionPenerima->ekspedisi == 'ambil')
                                            <td>Ambil Sendiri</td>
                                            @else
                                            <td>Kirim</td>
                                            @endif

                                        </tr>
                                        <tr>
                                            <th scope="row">Status</th>
                                            @if($transactionPenerima->status == 0)
                                            <td><a href="#" class="badge badge-danger">Belum</a></td>
                                            @else
                                            <td><a href="#" class="badge badge-success">Sudah</a></td>
                                            @endif
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

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