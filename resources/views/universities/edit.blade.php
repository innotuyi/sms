@extends('layouts.master')
@section('page_title', 'Edit University')
@section('content')

<div class="card">
    <div class="card-header header-elements-inline">
        <h5 class="card-title">Edit University</h5>
        <div class="header-elements">
            <a href="{{ route('universities.index') }}" class="btn btn-secondary">
                <i class="icon-circle-left2"></i> Back to Universities
            </a>
        </div>
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route('universities.update', $university->id) }}">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="university_code">University Code *</label>
                        <input type="text" class="form-control @error('university_code') is-invalid @enderror" 
                               name="university_code" value="{{ old('university_code', $university->university_code) }}" required>
                        @error('university_code')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="name">University Name *</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" 
                               name="name" value="{{ old('name', $university->name) }}" required>
                        @error('name')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="type">Type *</label>
                        <select class="form-control @error('type') is-invalid @enderror" name="type" required>
                            <option value="">Select Type</option>
                            <option value="PUBLIC" {{ old('type', $university->type) == 'PUBLIC' ? 'selected' : '' }}>Public</option>
                            <option value="PRIVATE" {{ old('type', $university->type) == 'PRIVATE' ? 'selected' : '' }}>Private</option>
                        </select>
                        @error('type')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label for="province">Province</label>
                        <select class="form-control @error('province') is-invalid @enderror" name="province">
                            <option value="">Select Province</option>
                            <option value="Kigali" {{ old('province', $university->province) == 'Kigali' ? 'selected' : '' }}>Kigali</option>
                            <option value="Northern" {{ old('province', $university->province) == 'Northern' ? 'selected' : '' }}>Northern</option>
                            <option value="Southern" {{ old('province', $university->province) == 'Southern' ? 'selected' : '' }}>Southern</option>
                            <option value="Eastern" {{ old('province', $university->province) == 'Eastern' ? 'selected' : '' }}>Eastern</option>
                            <option value="Western" {{ old('province', $university->province) == 'Western' ? 'selected' : '' }}>Western</option>
                        </select>
                        @error('province')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label for="district">District *</label>
                        <input type="text" class="form-control @error('district') is-invalid @enderror" 
                               name="district" value="{{ old('district', $university->district) }}" required>
                        @error('district')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="email">Email *</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" 
                               name="email" value="{{ old('email', $university->email) }}" required>
                        @error('email')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="phone_number">Phone Number</label>
                        <input type="text" class="form-control @error('phone_number') is-invalid @enderror" 
                               name="phone_number" value="{{ old('phone_number', $university->phone_number) }}">
                        @error('phone_number')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="website">Website</label>
                        <input type="url" class="form-control @error('website') is-invalid @enderror" 
                               name="website" value="{{ old('website', $university->website) }}">
                        @error('website')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="rector_name">Rector Name</label>
                        <input type="text" class="form-control @error('rector_name') is-invalid @enderror" 
                               name="rector_name" value="{{ old('rector_name', $university->rector_name) }}">
                        @error('rector_name')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="address">Address *</label>
                        <input type="text" class="form-control @error('address') is-invalid @enderror" 
                               name="address" value="{{ old('address', $university->address) }}" required>
                        @error('address')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="established_year">Established Year</label>
                        <input type="number" class="form-control @error('established_year') is-invalid @enderror" 
                               name="established_year" value="{{ old('established_year', $university->established_year) }}" 
                               min="1900" max="{{ date('Y') }}">
                        @error('established_year')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="accreditation_status">Accreditation Status</label>
                        <select class="form-control @error('accreditation_status') is-invalid @enderror" name="accreditation_status">
                            <option value="">Select Status</option>
                            <option value="Accredited" {{ old('accreditation_status', $university->accreditation_status) == 'Accredited' ? 'selected' : '' }}>Accredited</option>
                            <option value="Provisional" {{ old('accreditation_status', $university->accreditation_status) == 'Provisional' ? 'selected' : '' }}>Provisional</option>
                            <option value="Pending" {{ old('accreditation_status', $university->accreditation_status) == 'Pending' ? 'selected' : '' }}>Pending</option>
                        </select>
                        @error('accreditation_status')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea class="form-control @error('description') is-invalid @enderror" 
                                  name="description" rows="3">{{ old('description', $university->description) }}</textarea>
                        @error('description')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="text-right">
                <button type="submit" class="btn btn-primary">Update <i class="icon-paperplane ml-2"></i></button>
            </div>
        </form>
    </div>
</div>

@endsection 