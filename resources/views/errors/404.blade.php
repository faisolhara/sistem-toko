@extends('layouts.clean')

@section('title', '404'))

@section('content')
<div class="row">
    <div class="col-sm-12 text-center">

        <div class="wrapper-page">
            <div class="account-pages">
                <div class="account-box">

                    <div class="account-logo-box">
                        <h2 class="text-uppercase text-center">
                            <a href="index.html" class="text-success">
                                <span><img src="{{ asset('assets/images/logo_dark.png') }}" alt="" height="30"></span>
                            </a>
                        </h2>
                    </div>

                    <div class="account-content">
                        <h1 class="text-error">404</h1>
                        <h2 class="text-uppercase text-danger m-t-30">Page Not Found</h2>
                        <a class="btn btn-md btn-block btn-info waves-effect waves-light m-t-20" href="{{ \URL::previous() }}"><i class="fa fa-reply"></i> Return Previous Page</a>
                        <a class="btn btn-md btn-block btn-primary waves-effect waves-light m-t-20" href="{{ url('/') }}"><i class="fa fa-home"></i> Return Home</a>
                    </div>
                </div>
            </div>

        </div>

    </div>
</div>
@endsection