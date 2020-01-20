@extends('homepage.index')
@section('header')
    <title>Bandito Go Green</title>

@endsection
@section('contents')
    <div id="heading-breadcrumbs">
        <div class="container">
            <div class="row d-flex align-items-center flex-wrap">
                <div class="col-md-7">
                    <h1 class="h2">Shopping Cart</h1>
                </div>
                <div class="col-md-5">
                    <ul class="breadcrumb d-flex justify-content-end">
                        <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                        <li class="breadcrumb-item active">Shopping Cart</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div id="content">
        <div class="container">
            <div class="row bar">
                <div class="col-lg-12">
                    <p class="text-muted lead">You currently have {{ $transaction->count() }} item(s) in your cart.</p>
                </div>
                <div id="basket" class="col">
                    <div class="box mt-0 pb-0 no-horizontal-padding">
                        <form action="{{ url('cart/update') }}" method="POST">
                            {{ @csrf_field() }}
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>Product</th>
                                        <th>Quantity</th>
                                        <th>Unit price</th>
                                        <th colspan="2">Total</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php $total = 0; $code = ""; ?>
                                    @foreach($transaction as $row)
                                        <?php $total += $row->subtotal; ?>
                                        <?php $code = $row->code; ?>
                                        <tr>
                                            <td>
                                                <a href="{{url('product/detail/'.$row->productId)}}">{{$row->productName}}</a>
                                            </td>
                                            <td>
                                                <input type="hidden" name="rowid" value="{{ $row->productId }}">
                                                {{$row->transactionQty}}
                                            </td>
                                            <td>Rp.{{number_format($row->productPrice)}}</td>
                                            <td>Rp.{{number_format($row->subtotal)}}</td>
                                            <td>
                                                <a href="{{ url('cart/delete/'.$row->transactionId) }}"><i
                                                        class="fa fa-trash-o"></i>
                                                </a>
                                            </td>
                                        </tr>
                            @endforeach

                        </form>
                        <tfoot>
                        <tr>
                            <th colspan="3">Total</th>
                            <th colspan="2">Rp.{{number_format($total)}}</th>
                        </tr>
                        </tfoot>
                        </table>
                    </div>
                    <div class="box-footer d-flex justify-content-between align-items-center">
                        <div class="left-col"><a href="{{url('product')}}" class="btn btn-secondary mt-0"><i
                                    class="fa fa-chevron-left"></i> Continue shopping</a></div>
                        <div class="right-col">
                            @if( $transaction->count()>0)
                                <a href="{{ url('cart/formulir/'.$code) }}" class="btn btn-template-outlined">Proceed to
                                    checkout
                                    <i class="fa fa-chevron-right"></i></a>
                            @else
                                <a href="{{ url('cart/formulir') }}" class="btn btn-template-outlined disabled">Proceed
                                    to checkout
                                    <i class="fa fa-chevron-right"></i></a>
                            @endif
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer')

@endsection
@show
