@extends('layouts.auth')


@section('content')
<div class="login-box">
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    @include('shared.messages')

    <div class="login-box-body">
        <p class="login-box-msg">Reset Password</p>
        <form action="{{ url('/password/email') }}" method="post">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="form-group has-feedback">
                <input type="email" class="form-control" placeholder="Email" name="email" value="{{ old('email') }}"/>
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            </div>

            <div class="row">
                <div class="col-xs-2">
                </div><!-- /.col -->
                <div class="col-xs-8">
                    <button type="submit" class="btn btn-primary btn-block btn-flat">Send Password Reset Link</button>
                </div><!-- /.col -->
                <div class="col-xs-2">
                </div><!-- /.col -->
            </div>
        </form>

        <a href="{{ url('/login') }}">Log in</a><br>
        <a href="{{ url('/register') }}" class="text-center">Register a new membership</a>

    </div><!-- /.login-box-body -->

</div><!-- /.login-box -->
@endsection
