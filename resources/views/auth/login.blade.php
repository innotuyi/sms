{{-- @extends('layouts.login_master')

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

    @endsection --}}


@extends('layouts.login_master')

@section('content')
<style>
    /* Full-page login background styling */
    .login-cover {
        background: linear-gradient(135deg, #1B3A57, #243B55);
        height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        font-family: 'Poppins', sans-serif;
    }

    /* Card container styling */
    .login-form .card {
        background: rgba(36, 59, 85, 0.95); /* Slightly transparent */
        border-radius: 15px;
        box-shadow: 0 8px 30px rgba(0, 0, 0, 0.4);
        color: #fff;
        width: 100%;
        max-width: 400px;
    }

    .login-form .card .card-body {
        padding: 2rem;
    }

    /* Input field styling */
    .login-form .form-control {
        background-color: #2E4C6D;
        color: #fff;
        border: 1px solid #3B5B78;
        border-radius: 8px;
        padding: 0.75rem;
        font-size: 14px;
    }

    .login-form .form-control::placeholder {
        color: #A9CCE3;
        font-size: 14px;
    }

    .login-form .form-control:focus {
        background-color: #2E4C6D;
        border-color: #AEDFF7;
        color: #fff;
        outline: none;
        box-shadow: 0 0 5px rgba(0, 115, 230, 0.5);
    }

    /* Button styling */
    .login-form .btn-primary {
        background: linear-gradient(135deg, #0073E6, #005BB5);
        border: none;
        border-radius: 8px;
        padding: 0.75rem;
        font-size: 16px;
        font-weight: bold;
        text-transform: uppercase;
        transition: background 0.3s ease-in-out, transform 0.2s ease;
    }

    .login-form .btn-primary:hover {
        background: linear-gradient(135deg, #005BB5, #003D80);
        transform: translateY(-2px);
    }

    /* Muted text and links */
    .login-form .text-muted {
        color: #A9CCE3 !important;
    }

    .login-form a {
        color: #AEDFF7;
        font-weight: 500;
        text-decoration: none;
    }

    .login-form a:hover {
        color: #FFF;
        text-decoration: underline;
    }

    /* Error styling */
    .alert-danger {
        background: #5C2B2B;
        color: #FFAAAA;
        border: 1px solid #FF7373;
        border-radius: 5px;
        padding: 0.75rem;
    }

    .alert-danger .close {
        color: #FFAAAA;
        font-size: 16px;
    }

    /* Icon styling */
    .icon-people {
        font-size: 50px;
        color: #FFC107;
        margin-bottom: 1rem;
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .login-form .card {
            margin: 1rem;
        }
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
                        <div class="text-center mb-4">
                            <i class="icon-people"></i>
                            <h5 class="mb-0 font-weight-bold">Welcome Back!</h5>
                            <p class="text-muted">Login to continue</p>
                        </div>

                        <!-- Error Display -->
                        @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert">
                                <span>&times;</span>
                            </button>
                            <span class="font-weight-semibold">Oops!</span> {{ implode('<br>', $errors->all()) }}
                        </div>
                        @endif

                        <!-- Login ID or Email -->
                        <div class="form-group">
                            <input type="text" class="form-control" name="identity" value="{{ old('identity') }}" placeholder="Login ID or Email">
                        </div>

                        <!-- Password -->
                        <div class="form-group">
                            <input required name="password" type="password" class="form-control" placeholder="Password">
                        </div>

                        <!-- Remember Me -->
                        <div class="form-group d-flex align-items-center justify-content-between">
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="checkbox" name="remember" class="form-input-styled" {{ old('remember') ? 'checked' : '' }}>
                                    Remember Me
                                </label>
                            </div>
                            <a href="{{ route('password.request') }}">Forgot Password?</a>
                        </div>

                        <!-- Submit Button -->
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


