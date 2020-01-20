@extends('homepage.index')
@section('header')
    <title>Bandito Go Green</title>

@endsection
@section('contents')
    <div id="heading-breadcrumbs">
        <div class="container">
            <div class="row d-flex align-items-center flex-wrap">
                <div class="col-md-7">
                    <h1 class="h2">City - Edit</h1>
                </div>
            </div>
        </div>
    </div>
    <div id="content">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="box">
                        <form method="POST" action="{{url('/city/admin/update/')}}">
                            {{ csrf_field() }}
                            <input name="id" value="{{$city->id}}" hidden>

                            <div class="form-group">
                                <label for="name">Name</label>
                                <input id="name" type="text" class="form-control" name="name" required>
                            </div>
                            <div class="form-group">
                                <div class="">
                                    <button type="submit" class="btn btn-primary">
                                        Save
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer')

@endsection
@show
