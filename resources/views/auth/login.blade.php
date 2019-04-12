@extends('layouts.guest')
@section('title', 'Login')

@section('content')
<div class="row">
    <div class="col-sm-12">

        <div class="wrapper-page">

            <div class="account-pages">
                <div class="account-box">
                    <div class="account-logo-box">
                        <h2 class="text-uppercase text-center">
                            <a href="index.html" class="text-success">
                                <span><img src="assets/images/logo_dark.png" alt="" height="30"></span>
                            </a>
                        </h2>
                    </div>
                    <div class="account-content">
                        <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                        {{ csrf_field() }}
                            <div class="form-group m-b-20 {{ $errors->has('username') ? ' has-error' : '' }}">
                                <div class="col-xs-12">
                                    <label for="username">Username</label>
                                    <input class="form-control" type="text" id="username" name="username" required placeholder="Username">
                                    @if ($errors->has('username'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('username') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group m-b-20">
                                <div class="col-xs-12 {{ $errors->has('username') ? ' has-error' : '' }}">
                                    <a href="{{ route('password.request') }}" class="text-muted pull-right"><small>Forgot your password?</small></a>
                                    <label for="password">Password</label>
                                    <input class="form-control" type="password" name="password" required id="password" placeholder="Enter your password">
                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group m-b-20">
                                <div class="col-xs-12">

                                    <div class="checkbox checkbox-success">
                                        <input id="remember" type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                                        <label for="remember">
                                            Remember me
                                        </label>
                                    </div>

                                </div>
                            </div>

                            <div class="form-group text-center m-t-10">
                                <div class="col-xs-12">
                                    <button class="btn btn-md btn-block btn-primary waves-effect waves-light" type="submit">Sign In</button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
            <!-- end card-box-->


        </div>
        <!-- end wrapper -->

    </div>
</div>
@endsection
