<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="all,follow">
    <!-- Bootstrap CSS-->
    <link rel="stylesheet" href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}">
    <!-- Font Awesome CSS-->
    <link rel="stylesheet" href="{{ asset('assets/vendor/font-awesome/css/font-awesome.min.css') }}">
    <!-- Google fonts - Roboto-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,700">
    <!-- Bootstrap Select-->
    <link rel="stylesheet" href="{{ asset('assets/vendor/bootstrap-select/css/bootstrap-select.min.css') }}">
    <!-- owl carousel-->
    <link rel="stylesheet" href="{{ asset('assets/vendor/owl.carousel/assets/owl.carousel.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/owl.carousel/assets/owl.theme.default.css') }}">
    <!-- theme stylesheet-->
    <link rel="stylesheet" href="{{ asset('assets/css/style.default.css') }}" id="theme-stylesheet">
    <!-- Custom stylesheet - for your changes-->
    <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}">
    <!-- Favicon and apple touch icons-->
    <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
    <link rel="apple-touch-icon" href="img/apple-touch-icon.png">
    <link rel="apple-touch-icon" sizes="57x57" href="img/apple-touch-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="72x72" href="img/apple-touch-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="img/apple-touch-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="img/apple-touch-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="img/apple-touch-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="img/apple-touch-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="img/apple-touch-icon-152x152.png">
@yield('header')
<!-- Tweaks for older IEs-->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
</head>

<body>
@include('sweet::alert')
<div id="all">
    <!-- Top bar-->
    <div class="top-bar">
        <div class="container">
            <div class="row d-flex align-items-center">
                <div class="col-md-12">
                    <div class="d-flex justify-content-md-end justify-content-between">
                        @if(!Auth::user())
                            <div class="login"><a href="#" data-toggle="modal" data-target="#login-modal"
                                                  class="login-btn"><i
                                        class="fa fa-sign-in"></i><span
                                        class="d-none d-md-inline-block">Sign In</span></a><a
                                    href="{{ url('auth/register') }}" class="signup-btn"><i class="fa fa-user"></i><span
                                        class="d-none d-md-inline-block">Register</span></a></div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Top bar end-->
    <!-- Login ke dalam aplikasi-->
    <div id="login-modal" tabindex="-1" role="dialog" aria-labelledby="login-modalLabel" aria-hidden="true"
         class="modal fade">
        <div role="document" class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 id="login-modalLabel" class="modal-title"> Login</h4>
                    <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span
                            aria-hidden="true"></span></button>
                </div>
                <div class="modal-body">
                    <form action="{{ url('auth/login') }}" method="POST">
                        {{ @csrf_field() }}
                        <div class="form-group">
                            <input id="email_modal" type="text" placeholder="email" class="form-control" name="email">
                        </div>
                        <div class="form-group">
                            <input id="password_modal" type="password" placeholder="password" class="form-control"
                                   name="password">
                        </div>
                        <p class="text-center">
                            <button class="btn btn-template-outlined"><a href="{{ url('auth/login') }}"></a><i
                                    class="fa fa-sign-in"></i>Log in
                            </button>
                        </p>
                    </form>
                    <p class="text-center text-muted"></p>
                    <p class="text-center text-muted"><a
                            href="{{ url('auth/register') }}"><strong>Register</strong></a></p>
                </div>
            </div>
        </div>
    </div>
    <!-- Login modal end-->
    <!-- Navbar Start-->
    <header class="nav-holder make-sticky">
        <div id="navbar" role="navigation" class="navbar navbar-expand-lg">
            <div class="container"><a href="/" class="navbar-brand home">Bandito Go - Green</a>
                <button type="button" data-toggle="collapse" data-target="#navigation"
                        class="navbar-toggler btn-template-outlined"><span class="sr-only">Toggle navigation</span><i
                        class="fa fa-align-justify"></i></button>
                <div id="navigation" class="navbar-collapse collapse">
                    <ul class="nav navbar-nav ml-auto">
                        <li class="nav-item {{ Request::is('/') ? 'active' : '' }}"><a href="/">Home</a></li>

                        @if(Auth::user() == null)
                            <li class="nav-item dropdown menu-large {{ Request::is('product') ? 'active' : '' }}"><a
                                    href="{{ url('product') }}">Product</a></li>
                        @elseif(Auth::user()->role == "seller")
                            <li class="nav-item dropdown">
                                <a href="javascript: void(0)" data-toggle="dropdown" class="dropdown-toggle">Jual Sampah<b
                                        class="caret"></b></a>
                                <ul class="dropdown-menu">
                                    <li class="dropdown-item"><a href="{{ url('product') }}" class="nav-link">My
                                            Product</a>
                                    </li>
                                    <li class="dropdown-item"><a href="{{ url('addproduct') }}" class="nav-link">Add
                                            Product</a>
                                    </li>
                                </ul>
                            </li>
                        @endif
                    <!-- ========== FULL WIDTH MEGAMENU ==================-->

                        @if(Auth::user() ==  null)
                            <li class="nav-item dropdown menu-large"><a href="{{url('')}}" data-toggle="dropdown"
                                                                        data-hover="dropdown" data-delay="200"
                                                                        class="dropdown-toggle">Category <b
                                        class="caret"></b></a>
                                <ul class="dropdown-menu megamenu">
                                    <li>
                                        <div class="row">
                                            @foreach($category as $cat)
                                                <div class="col-md-6 col-lg-3">
                                                    <ul class="list-unstyled mb-3">
                                                        <li class="nav-item">
                                                            <a href="{{url('product/'.$cat->id)}}"
                                                               class="nav-link">{{ $cat->name }}</a></li>
                                                    </ul>
                                                </div>
                                            @endforeach
                                        </div>
                                    </li>
                                </ul>
                            </li>

                        @else
                            @if(Auth::user()->role == "admin")
                                <li class="nav-item dropdown menu-large {{ Request::is('city/admin') ? 'active' : '' }}">
                                    <a
                                        href="{{ url('city/admin') }}" data-hover="dropdown"
                                        data-delay="200">Manage City</a></li>
                                <li class="nav-item dropdown menu-large {{ Request::is('transaction/admin') ? 'active' : '' }}">
                                    <a
                                        href="{{ url('transaction/admin') }}" data-hover="dropdown"
                                        data-delay="200">Manage Transaction</a></li>
                                <li class="nav-item dropdown menu-large {{ Request::is('category/admin') ? 'active' : '' }}">
                                    <a
                                        href="{{ url('/category/admin') }}" data-hover="dropdown"
                                        data-delay="200">Manage Category</a></li>
                            @else
                                <li class="nav-item dropdown menu-large"><a href="" data-toggle="dropdown"
                                                                            data-hover="dropdown" data-delay="200"
                                                                            class="dropdown-toggle">Category <b
                                            class="caret"></b></a>
                                    <ul class="dropdown-menu megamenu">
                                        <li>
                                            <div class="row">
                                                @foreach($category as $cat)
                                                    <div class="col-md-6 col-lg-3">
                                                        <ul class="list-unstyled mb-3">
                                                            <li class="nav-item">
                                                                <a href="{{url('product/'.$cat->id)}}"
                                                                   class="nav-link">{{ $cat->name }}</a></li>
                                                        </ul>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </li>
                                    </ul>
                                </li>
                            @endif

                        @endif

                        @if(Auth::user())
                            @if(Auth::user()->role =='admin')
                                <li class="nav-item dropdown menu-large {{ Request::is('seller') ? 'active' : '' }}"><a
                                        href="{{ url('seller') }}" data-hover="dropdown"
                                        data-delay="200">Show User </a></li>
                            @else
                                <li class="nav-item dropdown menu-large {{ Request::is('seller') ? 'active' : '' }}"><a
                                        href="{{ url('seller') }}" data-hover="dropdown"
                                        data-delay="200">Show Seller </a></li>
                            @endif
                        @else
                            <li class="nav-item dropdown menu-large {{ Request::is('seller') ? 'active' : '' }}"><a
                                    href="{{ url('seller') }}" data-hover="dropdown"
                                    data-delay="200">Show Seller </a></li>
                        @endif
                        @if(Auth::user())
                            <li class="nav-item dropdown">
                                <a href="javascript: void(0)" data-toggle="dropdown" class="dropdown-toggle">My Account<b
                                        class="caret"></b></a>
                                <ul class="dropdown-menu">
                                    <li class="dropdown-item"><a href="{{url('myprofil')}}" class="nav-link">Edit Profile</a></li>
                                    @if(Auth::user()->role == 'buyer')
                                        <li class="dropdown-item"><a href="{{ url('keranjang') }}" class="nav-link">My
                                                Cart</a></li>
                                        <li class="dropdown-item"><a href="{{ url('cart/myorder') }}" class="nav-link">My
                                                Order</a></li>
                                        <li class="dropdown-item"><a href="{{ url('/history') }}" class="nav-link">History
                                                Transaction</a></li>
                                    @elseif(Auth::user()->role == 'seller')
                                        <li class="dropdown-item"><a href="{{ url('/history') }}" class="nav-link">History
                                                Transaction</a></li>
                                    @endif
                                    <li class="dropdown-item"><a href="{{ url('auth/logout') }}"
                                                                 class="nav-link">Logout</a></li>
                                </ul>
                            </li>
                    @endif
                    {{--<li class=" nav-item dropdown"><a style="color: #3aa18c " href="javascript: void(0)"
                                                      data-toggle="dropdown" class="dropdown-toggle"><img
                                class=" rounded-circle" width="15px"
                                src="{{ url(Auth::user()->photo) }}"> {{(Auth::user()->name) }} <b
                                class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li class="dropdown-item"><a href="{{ url('myprofil')}}" class="nav-link">My
                                    Account</a></li>
                            <li class="dropdown-item"><a href="{{ url('cart/myorder') }}" class="nav-link">My
                                    Order</a></li>
                            @if(Auth::user()->role == "supplier")
                                <li class="dropdown-item"><a href="{{ url('myproduct') }}" class="nav-link">My
                                        Product</a></li>
                            @endifw
                            <li class="dropdown-item"><a href="{{ url('logout') }}" class="nav-link">Logout</a>
                            </li>
                        </ul>
                    </li>
--}}

                 
                        <!-- ========== Contact dropdown ==================-->
                        <!-- ========== Contact dropdown end ==================-->
                    </ul>
                </div>
                <div id="search" class="collapse clearfix">
                    <form role="search" class="navbar-form">
                        <div class="input-group">
                            <input type="text" placeholder="Search" class="form-control"><span class="input-group-btn">
                                    <button type="submit" class="btn btn-template-main"><i
                                            class="fa fa-search"></i></button></span>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </header>
@yield('slide')
<!-- Navbar End-->
@yield('contents')

<!-- FOOTER -->
    <footer class="main-footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <h4 class="h6">About Us</h4>
                    <p>Bandito Go Green adalah aplikasi yang mewadahi penjualan sampah plastik berbasis website</p>
                </div>
                <div class="col-lg-4">
                    <h4 class="h6">Contact</h4>
                    <p class="text-uppercase">
                        <strong>Bandito Go Green</strong><br>
                        081905943536 <br>Jakarta <br><strong>Indonesia</strong></p>
                </div>

            </div>
        </div>
        <div class="copyrights">
            <div class="container">
                <div class="row">
                    <div class="col-md-4 text-center-md">
                        <p>&copy; 2019-2020 Bandito Go Green</p>
                    </div>
                    <div class="col-md-8 text-right text-center-md">
                        <p>Copyright By @Charles
                                Tambunan </a></p>
                        <!-- Please do not remove the backlink to us unless you support further theme's development at https://bootstrapious.com/donate. It is part of the license conditions. Thank you for understanding :)-->
                    </div>
                </div>
            </div>
        </div>
    </footer>
</div>
<!-- Javascript files-->
<script src="{{ asset('assets/vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('assets/vendor/popper.js/umd/popper.min.js') }}"></script>
<script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/vendor/jquery.cookie/jquery.cookie.js') }}"></script>
<script src="{{ asset('assets/vendor/waypoints/lib/jquery.waypoints.min.js') }}"></script>
<script src="{{ asset('assets/vendor/jquery.counterup/jquery.counterup.min.js') }}"></script>
<script src="{{ asset('assets/vendor/owl.carousel/owl.carousel.min.js') }}"></script>
<script src="{{ asset('assets/vendor/owl.carousel2.thumbs/owl.carousel2.thumbs.min.js') }}"></script>
<script src="{{ asset('assets/js/jquery.parallax-1.1.3.js') }}"></script>
<script src="{{ asset('assets/vendor/bootstrap-select/js/bootstrap-select.min.js') }}"></script>
<script src="{{ asset('assets/vendor/jquery.scrollto/jquery.scrollTo.min.js') }}"></script>
<script src="{{ asset('assets/js/front.js') }}"></script>
@yield('footer')
</body>

</html>
