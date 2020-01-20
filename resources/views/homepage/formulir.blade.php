@extends('homepage.index')
@section('header')
<title>Bandito Go Green</title>

@endsection
@section('contents')
<div id="heading-breadcrumbs">
    <div class="container">
        <div class="row d-flex align-items-center flex-wrap">
            <div class="col-md-7">
                <h1 class="h2">Checkout</h1>
            </div>
        </div>
    </div>
</div>
<div id="content">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="box">
                    <h2 class="text-uppercase">Formulir - address</h2>
                    <hr>
                    <form method="POST" action="{{ url('checkout') }}">
                        {{ csrf_field() }}
                        <input type="text" value="{{$code}}" hidden name="code">

                        <div class="form-group">
                            <label for="formGroupExampleInput">Member</label>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputEmail4">Name</label>
                                    <input type="email" class="form-control" id="inputEmail4" readonly value="{{Auth::user()->name}}">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="inputPassword4">Email</label>
                                    <input type="text" class="form-control" id="inputPassword4" readonly value="{{Auth::user()->email}}">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="formGroupExampleInput">Penerima</label>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputEmail4">Name</label>
                                    <input type="text" class="form-control" id="inputEmail4" placeholder="Name" required name="name">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="inputPassword4">Phone</label>
                                    <input type="text" class="form-control" id="inputPassword4" placeholder="Phone" required maxlength="15" name="phone">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputEmail4">Address</label>
                                    <input type="text" class="form-control" id="inputEmail4" placeholder="Address" required name="address">
                                </div>
                                <div class="form-group col-md-6">
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="inputEmail4">City</label>
                                            <select class="custom-select mr-sm-2" id="inlineFormCustomSelect" required name="city">
                                                <option selected value="">--Pilih--</option>
                                                @foreach($citys as $city)
                                                    <option value="{{$city->id}}">{{$city->name}}</option>

                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="inputPassword4">ZIP</label>
                                            <input type="text" class="form-control" id="inputPassword4" placeholder="ZIP" required maxlength="10" name="zip">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="inputEmail4">Pengiriman</label>
                                            <select class="custom-select mr-sm-2" id="inlineFormCustomSelect" required name="ekspedisi">
                                                <option selected value="">--Pilih--</option>
                                                <option value="ambil">Ambil Sendiri</option>
                                                <option value="kirim">Kirim</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="inputEmail4">Pembayaran</label>
                                            <select class="custom-select mr-sm-2" id="pembayaran" required name="pembayaran" onchange="changeFunc();">
                                                <option selected value="">--Pilih--</option>
                                                <option value="cod">Cash on Delivery (COD)</option>
                                                <option value="cbd">Cash Before Delivery (CBD)</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                            <h4 id="rekening" class="text-center">Transfer ke rekening a/n Bandito Go Green 28921812112</h4>
                        <div class="form-group">
                            <div class="">
                                <input type="submit" class="btn btn-primary" value="next">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    document.getElementById("rekening").style.display = "none";
    function changeFunc() {
        var selectBox = document.getElementById("pembayaran");
        var selectedValue = selectBox.options[selectBox.selectedIndex].value;
        if (selectedValue == 'cbd'){
            document.getElementById("rekening").style.display = "block";
        }else{
            document.getElementById("rekening").style.display = "none";
        }
    }
</script>
@endsection

@section('footer')

@endsection
@show
