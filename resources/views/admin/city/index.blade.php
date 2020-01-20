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
                    <h1 class="h2">Manage City</h1>
                </div>
            </div>
        </div>
    </div>
    <div id="content">
        <div class="container">
            <div class="row bar mb-0">
                <form method="POST" action="{{url('city/admin/add')}}">
                    {{ csrf_field() }}
                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                        <label for="name">Add City</label>
                        <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required placeholder="Name">
                    </div>
                    <!-- /.box-body -->

                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
            <div class="row bar mb-0">
                <div id="customer-orders" class="col">
                    <div class="box mt-0 mb-lg-0">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th width="30px">No</th>
                                    <th>Name</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php
                                    $no = 1;
                                @endphp
                                @foreach($citys as $city)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{$city->name}}</td>

                                        <td>
                                            <a href="{{url('/city/admin/detail/'.$city->id)}}" class="btn btn-template-outlined btn-sm">Edit</a>
                                            <a href="{{url('/city/admin/delete/'.$city->id)}}" class="btn btn-template-outlined btn-sm">Delete</a>
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
