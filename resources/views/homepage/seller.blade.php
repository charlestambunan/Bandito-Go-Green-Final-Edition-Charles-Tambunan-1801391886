@extends('homepage.index')
@section('header')
<title>Bandito Go Green- Penjualan Limbah Plastik</title>

@endsection
@section('slide')

@endsection
@section('contents')
<div id="heading-breadcrumbs">

</div>
<div id="content">
    <div class="container">
        <section class="bar mb-0">
            <div class="row">
                <div class="col-md-12">
                    <div class="row text-center">
                        @foreach($user as $users)
                        <div class="col-md-2 col-sm-3">
                            <div data-animate="fadeInUp" class="team-member">
                                <div class="image"><a href="{{ url('penjual/'.$users->id) }}"><img src="{{ url($users->photo) }}" alt="" class="img-fluid rounded-circle"></a></div>
                                <h3><a href="{{ url('penjual/'.$users->id) }}">{{ $users->name }}</a></h3>
                                <p class="role">{{ date('d/m/y',strtotime($users->created_at)) }}</p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
@endsection

@section('footer')

@endsection
@show
