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
        background: #002C5C(36, 59, 85, 0.95);
        /* Slightly transparent */
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

<div class="modal" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="loginModalLabel">Login</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
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
                                    <span class="font-weight-semibold">Oops!</span>
                                    {{ implode('<br>', $errors->all()) }}
                                </div>
                            @endif

                            <!-- Login ID or Email -->
                            <div class="form-group">
                                <input type="text" class="form-control" name="identity" value="{{ old('identity') }}"
                                    placeholder="Login ID or Email">
                            </div>

                            <!-- Password -->
                            <div class="form-group">
                                <input required name="password" type="password" class="form-control"
                                    placeholder="Password">
                            </div>

                            <!-- Remember Me -->
                            <div class="form-group d-flex align-items-center justify-content-between">
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="checkbox" name="remember" class="form-input-styled"
                                            {{ old('remember') ? 'checked' : '' }}>
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
</div>

@extends('layouts.login_master')

<style>
    <style>
        #photoCarousel {
        max-height: 300px; /* Adjust height as needed */
        overflow: hidden;
    }

    #photoCarousel .carousel-item img {
        height: 400px; /* Match the container height */
        object-fit: cover; /* Crop images to fit without distortion */
    }

    .carousel-caption {
        background: rgba(0, 0, 0, 0.5); /* Semi-transparent background */
        padding: 10px;
        border-radius: 5px;
    }
    
    
    .card {
        border: none;
        transition: transform 0.3s ease;
    }

    .card:hover {
        transform: translateY(-10px);
    }

    .card-header {
        border-radius: 0.5rem 0.5rem 0 0;
    }

    .card-footer {
        border-radius: 0 0 0.5rem 0.5rem;
    }

    .bg-info {

        background-color: #002C5C !important
    }
</style>
</style>

@section('content')


<div class="container">
    <div id="photoCarousel" class="carousel slide mb-5" data-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="{{ asset('global_assets/basketball_playground.jpg') }}" class="d-block w-100" alt="Slide 1">
                <div class="carousel-caption d-none d-md-block">
                    <h5>Basketball Playground</h5>
                    <p>Experience the best basketball courts for students.</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="{{ asset('global_assets/football_playground.jpg') }}" class="d-block w-100" alt="Slide 2">
                <div class="carousel-caption d-none d-md-block">
                    <h5>Football Playground</h5>
                    <p>Where champions are made on the field.</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="{{ asset('global_assets/volleyball_playground.jpg') }}" class="d-block w-100" alt="Slide 3">
                <div class="carousel-caption d-none d-md-block">
                    <h5>Volleyball Playground</h5>
                    <p>Perfect for thrilling volleyball matches.</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="{{ asset('global_assets/basketball_playground.jpg') }}" class="d-block w-100" alt="Slide 4">
                <div class="carousel-caption d-none d-md-block">
                    <h5>Outdoor Basketball Court</h5>
                    <p>Enjoy basketball in an open and scenic environment.</p>
                </div>
            </div>
        </div>
        <a class="carousel-control-prev" href="#photoCarousel" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#photoCarousel" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
</div>


    <div class="container py-5">
        <div class="row">
            <!-- Vision Card -->
            <div class="col-md-4 mb-4">
                <div class="card shadow-lg h-100">
                    <div class="card-header bg-primary text-white text-center py-4">
                        <i class="fas fa-binoculars fa-3x mb-3"></i> <!-- Icon for Vision -->
                        <h2 class="card-title">Our Vision</h2>
                    </div>
                    <div class="card-body">
                        <p class="card-text">This platform provides comprehensive orientation on various educational
                            institutions worldwide, emphasizing their unique focuses and geographical advantages. Users can
                            explore detailed profiles of schools, including their academic strengths, extracurricular
                            offerings, and facilities.</p>
                    </div>

                </div>
            </div>

            <!-- Mission Card -->
            <div class="col-md-4 mb-4">
                <div class="card shadow-lg h-100">
                    <div class="card-header bg-success text-white text-center py-4">
                        <i class="fas fa-bullseye fa-3x mb-3"></i> <!-- Icon for Mission -->
                        <h2 class="card-title">Our Mission</h2>
                    </div>
                    <div class="card-body">
                        <p class="card-text">Imagine a website dedicated to guiding students through the maze of school
                            options based on location and specialization. Our platform offers concise profiles of schools
                            worldwide, spotlighting their unique academic strengths and extracurricular offerings.</p>
                    </div>
                </div>
            </div>

            <!-- Value Card -->
            <div class="col-md-4 mb-4">
                <div class="card shadow-lg h-100">
                    <div class="card-header bg-info text-white text-center py-4">
                        <i class="fas fa-hand-holding-heart fa-3x mb-3"></i> <!-- Icon for Value -->
                        <h2 class="card-title">Our Value</h2>
                    </div>
                    <div class="card-body">
                        <p class="card-text">With Rangishuri, no longer with struggling from knowing a very fit school where
                            your child would go, where the option that a student wishes to pursue, making sure that you send
                            your child to a school with a living condition that is known by the parents.</p>
                        <p class="card-text">Rangishuri is a platform registered under government of law by Rwanda
                            Development Board. Our main aim is to easier ways of getting schools related information.</p>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
