@extends('layouts.login_master')

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
                    <i class="fas fa-binoculars fa-3x mb-3"></i>
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
                    <i class="fas fa-bullseye fa-3x mb-3"></i>
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
                    <i class="fas fa-hand-holding-heart fa-3x mb-3"></i>
                    <h2 class="card-title">Our Value</h2>
                </div>
                <div class="card-body">
                    <p class="card-text">With SCHOOL CONNECT, no longer with struggling from knowing a very fit school where
                        your child would go, where the option that a student wishes to pursue, making sure that you send
                        your child to a school with a living condition that is known by the parents.</p>
                    <p class="card-text">SCHOOL CONNECT is a platform registered under government of law by Rwanda
                        Development Board. Our main aim is to easier ways of getting schools related information.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    /* Card styling */
    .card {
        border: none;
        transition: transform 0.3s ease;
        margin-bottom: 2rem;
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

    /* Carousel styling */
    #photoCarousel {
        max-height: 300px;
        overflow: hidden;
    }

    #photoCarousel .carousel-item img {
        height: 400px;
        object-fit: cover;
    }

    .carousel-caption {
        background: rgba(0, 0, 0, 0.5);
        padding: 10px;
        border-radius: 5px;
    }

    .bg-info {
        background-color: #002C5C !important;
    }
</style>
@endsection
