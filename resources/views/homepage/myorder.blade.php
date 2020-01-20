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
                <h1 class="h2">My Orders</h1>
            </div>
            <div class="col-md-5">
                <ul class="breadcrumb d-flex justify-content-end">
                    <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                    <li class="breadcrumb-item active">My Orders</li>
                </ul>
            </div>
        </div>
    </div>
</div>
<div id="content">
    <div class="container">
        <div class="row bar mb-0">
            <div id="customer-orders" class="col">
                <p class="text-muted lead">Apabila ada pertanyaan silahkan hubungin admin</p>
                <div class="box mt-0 mb-lg-0">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th width="30px">No</th>
                                    <th>Code</th>
                                    <th>Member</th>
                                    <th>Metode Pengiriman</th>
                                    <th>Status</th>
                                    <th>Menu</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $no = 1;
                                @endphp
                                @foreach($transaction as $transactions)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{$transactions->code}}</td>
                                    <td>{{ $transactions->username }}</td>
                                    <td>{{ $transactions->ekspedisi }}</td>
                                    <td>
                                        @if($transactions->status == 0)
                                        <a href="#" class="badge badge-danger">Belum</a>
                                        @else
                                        <a href="#" class="badge badge-success">Sudah</a>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ url('cart/detail/'.$transactions->code) }}" class="btn btn-template-outlined btn-sm">Detail</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
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
