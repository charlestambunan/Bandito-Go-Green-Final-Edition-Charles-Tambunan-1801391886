@extends('homepage.index')
@section('header')
<title>Bandito Go - Green</title>

@endsection
@section('slide')

@endsection
@section('contents')
<div id="heading-breadcrumbs">
    <div class="container">
        <div class="row d-flex align-items-center flex-wrap">
            <div class="col-md-7">
                <h1 class="h2">Edit Profile</h1>
            </div>
            <div class="col-md-5">
                <ul class="breadcrumb d-flex justify-content-end">
                    <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                    <li class="breadcrumb-item active">Edit Profile</li>
                </ul>
            </div>
        </div>
    </div>
</div>
<div id="content">
    <div class="container">
        <div class="row bar">
            <div class="col" id="customer-orders">
                <form class="form-horizontal" method="POST" action="{{ url('updateprofil') }}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <input type="hidden" name="id" value="{{ $user->id }}">
                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                        <label for="name" class="col-md-4 control-label">Name</label>

                        <div class="col-md-12">
                            <input id="name" type="text" class="form-control" name="name" value="{{ $user->name }}" required autofocus>

                            @if ($errors->has('name'))
                            <span class="help-block">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                        <label for="name" class="col-md-4 control-label">Username</label>

                        <div class="col-md-12">
                            <input id="name" type="text" class="form-control" name="username" value="{{ $user->username }}" required autofocus>

                            @if ($errors->has('username'))
                            <span class="help-block">
                                <strong>{{ $errors->first('username') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                        <label for="name" class="col-md-4 control-label">Phone</label>

                        <div class="col-md-12">
                            <input id="name" type="number" class="form-control" name="phone" value="{{ $user->phone }}" required autofocus>

                            @if ($errors->has('phone'))
                            <span class="help-block">
                                <strong>{{ $errors->first('phone') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
                        <label for="name" class="col-md-4 control-label">Address</label>

                        <div class="col-md-12">
                            <textarea class="form-control" name="address" required autofocus>{{ $user->address }}</textarea>

                            @if ($errors->has('address'))
                            <span class="help-block">
                                <strong>{{ $errors->first('address') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('gender') ? ' has-error' : '' }}">
                        <label for="name" class="col-md-4 control-label">Gender</label>

                        <div class="col-md-12">
                            <select name="gender" class="form-control">
                                @if($user->gender == "L")
                                <option value="L" selected="selected">Laki-laki</option>
                                <option value="P">Perempuan</option>
                                @else
                                <option value="L">Laki-laki</option>
                                <option value="P" selected="selected">Perempuan</option>
                                @endif
                            </select>

                            @if ($errors->has('gender'))
                            <span class="help-block">
                                <strong>{{ $errors->first('gender') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('birthday') ? ' has-error' : '' }}">
                        <label for="name" class="col-md-4 control-label">Birth day</label>

                        <div class="col-md-12">
                            <input id="name" type="date" class="form-control" name="birthday" value="{{ $user->birthday }}" required autofocus>

                            @if ($errors->has('birthday'))
                            <span class="help-block">
                                <strong>{{ $errors->first('birthday') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                        <div class="col-md-12">
                            <input id="email" type="email" class="form-control" name="email" value="{{ $user->email }}" required>

                            @if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                        <label for="password" class="col-md-4 control-label">Password</label>

                        <div class="col-md-12">
                            <input id="password" type="password" class="form-control" name="password" required>

                            @if ($errors->has('password'))
                            <span class="help-block">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

                        <div class="col-md-12">
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('role') ? ' has-error' : '' }}">
                        <label for="name" class="col-md-4 control-label">Role</label>
                        <div class="col-md-12">
                            <input type="text" value="{{ $user->role }}" name="role" class="form-control" readonly>
                        </div>
                        <div class="col-md-12">
                            @if ($errors->has('role'))
                            <span class="help-block">
                                <strong>{{ $errors->first('role') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="password-confirm" class="col-md-4 control-label">Photo</label>
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-6">
                                    <input type="file" class="form-control" name="file">
                                </div>
                                <div class="col-md-6">
                                    <img src="{{ url($user->photo) }}" width="150px">
                                    <input type="hidden" name="tmp_image" value="{{ $user->photo }}">

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12 col-md-offset-4">
                            <button type="submit" class="btn btn-primary">
                                Update
                            </button>
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
