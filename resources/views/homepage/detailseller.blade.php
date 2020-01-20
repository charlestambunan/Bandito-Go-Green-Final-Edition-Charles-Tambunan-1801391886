@extends('homepage.index')
@section('header')
    <title>Bandito Go Green V2</title>

@endsection
@section('contents')

    <div id="heading-breadcrumbs">
        <div class="container">
            <div class="row d-flex align-items-center flex-wrap">
                <div class="col-md-7">
                    <h1 class="h2">Detail User</h1>
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
                                <div><img src=" {{ url($user->photo) }}" alt="" class="img-fluid"></div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <h1>{{$user->name}}</h1>
                            <p>{{ date('d F Y',strtotime($user->created_at)) }}</p>
                            <p>Status sebagai {{$user->role}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        var tempDate = new Date({{$user->created_at}});
        document.getElementById("berganbungDate").innerHTML = "Bergabung sejak " + tempDate.getDay() + " " + getDateName(tempDate.getMonth()) + " " + tempDate.getFullYear();

        function getDateName(index) {
            var monthNames = ["January", "February", "March", "April", "May", "June",
                "July", "August", "September", "October", "November", "December"];
            return monthNames[index];
        }
    </script>


@endsection

@section('footer')

@endsection
@show
