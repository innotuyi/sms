<!-- filtered.blade.php -->
@extends('layouts.login_master')
<style>
    .search-container {
        background-color: #fff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }
    .form-group label {
        font-weight: bold;
        color: #1B3A57;
    }
    .btn-primary {
        background-color: #1B3A57;
        border: none;
    }
    .btn-primary:hover {
        background-color: #2D5069;
    }
</style>
@section('content')



<div class="container py-5">
    <h2 class="text-center mb-4">Filtered Schools</h2>
  
    <div class="row">
        @forelse ($myschools as $school)
            <div class="col-md-4 mb-4">
                <div class="card shadow-lg h-100">
                    <div class="card-header bg-primary text-white">
                        <h5 class="card-title">{{ $school->school_name }}</h5>
                    </div>
                    <div class="card-body">
                        <p class="card-text"><strong>Province:</strong> {{ $school->province ?? 'N/A' }}</p>
                        <p class="card-text"><strong>District:</strong> {{ $school->district ?? 'N/A' }}</p>
                        <p class="card-text"><strong>Sector:</strong> {{ $school->sector ?? 'N/A' }}</p>
                        <p class="card-text"><strong>Combination:</strong> {{ $school->combination ?? 'N/A' }}</p>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center">
                <p>No schools found matching your criteria.</p>
            </div>
        @endforelse
    </div>
</div>






@endsection