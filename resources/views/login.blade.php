@extends('layouts.login_master')

@section('content')
<style>
    .login-cover {
        background-color: #1B3A57; /* Dark Blue */
        height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .login-form .card {
        background-color: #243B55; /* Slightly darker shade for contrast */
        border-radius: 10px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        color: white;
    }

    .login-form .card .card-body {
        padding: 2rem;
    }

    .login-form .form-control {
        background-color: #2E4C6D;
        color: white;
        border: 1px solid #3B5B78;
        border-radius: 5px;
    }

    .login-form .form-control::placeholder {
        color: #AEC6E9;
    }

    .login-form .form-control:focus {
        background-color: #2E4C6D;
        border-color: #AEDFF7;
        color: white;
    }

    .login-form .btn-primary {
        background-color: #0073E6;
        border: none;
    }

    .login-form .btn-primary:hover {
        background-color: #005BB5;
    }

    .login-form .text-muted {
        color: #AEC6E9 !important;
    }

    .login-form a {
        color: #AEDFF7;
    }

    .login-form a:hover {
        color: #FFF;
    }

    .alert-danger {
        background-color: #5C2B2B;
        color: #FFAAAA;
        border-color: #FF7373;
    }

    .alert-danger .close {
        color: #FFAAAA;
    }
</style>

<div class="page-content login-cover">
    <!-- Main content -->
    <div class="content-wrapper">
        <!-- Content area -->
        <div class="content d-flex justify-content-center align-items-center">
            <!-- Login card -->
            <form class="login-form" method="post" action="{{ route('login') }}">
                @csrf
                <div class="card mb-0">
                    <div class="card-body">
                        <div class="text-center mb-3">
                            <i class="icon-people icon-2x text-warning-400 border-warning-400 border-3 rounded-round p-3 mb-3 mt-1"></i>
                            <h5 class="mb-0">Login to your account</h5>
                            <span class="d-block text-muted">Your credentials</span>
                        </div>

                        @if ($errors->any())
                        <div class="alert alert-danger alert-styled-left alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert">
                                <span>&times;</span>
                            </button>
                            <span class="font-weight-semibold">Oops!</span> {{ implode('<br>', $errors->all()) }}
                        </div>
                        @endif

                        <div class="form-group">
                            <input type="text" class="form-control" name="identity" value="{{ old('identity') }}" placeholder="Login ID or Email">
                        </div>

                        <div class="form-group">
                            <input required name="password" type="password" class="form-control" placeholder="{{ __('Password') }}">
                        </div>

                        <div class="form-group d-flex align-items-center">
                            <div class="form-check mb-0">
                                <label class="form-check-label">
                                    <input type="checkbox" name="remember" class="form-input-styled" {{ old('remember') ? 'checked' : '' }} data-fouc>
                                    Remember
                                </label>
                            </div>
                            <a href="{{ route('password.request') }}" class="ml-auto">Forgot password?</a>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-block">
                                Sign in <i class="icon-circle-right2 ml-2"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

    @endsection