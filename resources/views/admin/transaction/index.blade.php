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
                    <h1 class="h2">Transaction</h1>
                </div>
            </div>
        </div>
    </div>
    <div id="content">
        <div class="container">
            <div class="row bar mb-0">
                <div id="customer-orders" class="col">
                    <div class="box mt-0 mb-lg-0">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th width="30px">No</th>
                                    <th>Code</th>
                                    <th>Name</th>
                                    <th>Total</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php
                                    $no = 1;
                                @endphp
                                @foreach($transactions as $transaction)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{$transaction->code}}</td>
                                        <td>{{$transaction->name}}</td>
                                        <td>Rp.{{number_format($transaction->total)}}</td>

                                        <td>
                                            <a href="{{url('/transaction/admin/approved/'.$transaction->code)}}" class="btn btn-template-outlined btn-sm">Approved</a>
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
