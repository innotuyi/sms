@extends('layouts.master')

@section('page_title', 'Assign Settings to Schools')

@section('content')
<div class="card">
    <div class="card-header header-elements-inline">
        <h6 class="card-title">Assign Settings</h6>
        {!! Qs::getPanelOptions() !!}
    </div>

    <div class="card-body">
        <ul class="nav nav-tabs nav-tabs-highlight">
            <li class="nav-item"><a href="#all-settings" class="nav-link active" data-toggle="tab">Settings List</a></li>
            <li class="nav-item"><a href="#new-setting" class="nav-link" data-toggle="tab"><i class="icon-plus2"></i> Assign Setting</a></li>
        </ul>

        <div class="tab-content">
            {{-- Settings List --}}
            <div class="tab-pane fade show active" id="all-settings">
                <table class="table datatable-button-html5-columns">
                    <thead>
                        <tr>
                            <th>S/N</th>
                            <th>School Name</th>
                            <th>School Code</th>
                            <th>Type</th>
                            <th>Address</th>
                            <th>Province</th>
                            <th>District</th>
                            <th>Sector</th>
                            <th>level</th>
                            <th>Grade</th>
                            <th>Combination</th>
                            <th>Area</th>
                            <th>Established Year</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($schools as $school)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $school->school_name }}</td>
                                <td>{{ $school->school_code ?? 'N/A' }}</td>
                                <td>{{ $school->school_type }}</td>
                                <td>{{ $school->address ?? 'N/A' }}</td>
                                <td>{{ $school->province ?? 'N/A' }}</td>
                                <td>{{ $school->district ?? 'N/A' }}</td>
                                <td>{{ $school->sector ?? 'N/A' }}</td>
                                <td>{{ $school->grade ?? 'N/A' }}</td>
                                <td>{{ $school->level ?? 'N/A' }}</td>
                                <td>{{ $school->combination ?? 'N/A' }}</td>
                                <td>{{ $school->area ?? 'N/A' }}</td>
                                <td>{{ $school->established_year ?? 'N/A' }}</td>
                                <td>
                                    <form action="{{ route('school.destroy', $school->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- Assign Setting --}}
            <div class="tab-pane fade" id="new-setting">
                <div class="row">
                    <div class="col-md-12">
                        <form action="{{ route('school.store') }}" method="POST">
                            @csrf

                            <div class="row">
                                <!-- School Code -->
                                <div class="col-md-6 form-group">
                                    <label for="school_code">School Code</label>
                                    <input type="text" id="school_code" name="school_code" class="form-control" value="{{ old('school_code') }}" maxlength="10">
                                    @error('school_code')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- School Name -->
                                <div class="col-md-6 form-group">
                                    <label for="school_name">School Name</label>
                                    <input type="text" id="school_name" name="school_name" class="form-control" value="{{ old('school_name') }}" required maxlength="255">
                                    @error('school_name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row">
                                <!-- Address -->
                                <div class="col-md-6 form-group">
                                    <label for="address">Address</label>
                                    <input type="text" id="address" name="address" class="form-control" value="{{ old('address') }}" maxlength="255">
                                    @error('address')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Phone Number -->
                                <div class="col-md-6 form-group">
                                    <label for="phone_number">Phone Number</label>
                                    <input type="text" id="phone_number" name="phone_number" class="form-control" value="{{ old('phone_number') }}" maxlength="20">
                                    @error('phone_number')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row">
                                <!-- Email -->
                                <div class="col-md-6 form-group">
                                    <label for="email">Email</label>
                                    <input type="email" id="email" name="email" class="form-control" value="{{ old('email') }}" maxlength="255">
                                    @error('email')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Principal Name -->
                                <div class="col-md-6 form-group">
                                    <label for="principal_name">Principal Name</label>
                                    <input type="text" id="principal_name" name="principal_name" class="form-control" value="{{ old('principal_name') }}" maxlength="255">
                                    @error('principal_name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row">
                                <!-- Province -->
                                <div class="col-md-6 form-group">
                                    <label for="province">Province</label>
                                    <select id="province" name="province" class="form-control">
                                        <option value="">Select Province</option>
                                        <option value="Kigali City" {{ old('province') == 'Kigali City' ? 'selected' : '' }}>Kigali City</option>
                                        <option value="Southern Province" {{ old('province') == 'Southern Province' ? 'selected' : '' }}>Southern Province</option>
                                        <option value="Western Province" {{ old('province') == 'Western Province' ? 'selected' : '' }}>Western Province</option>
                                        <option value="Northern Province" {{ old('province') == 'Northern Province' ? 'selected' : '' }}>Northern Province</option>
                                        <option value="Eastern Province" {{ old('province') == 'Eastern Province' ? 'selected' : '' }}>Eastern Province</option>
                                    </select>
                                    @error('province')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- District -->
                                <div class="col-md-6 form-group">
                                    <label for="district">District</label>
                                    <select name="district" id="district" class="form-control" required>
                                        <option value="" disabled selected>Select District</option>
                                        <!-- Districts will be populated dynamically based on province selection -->
                                    </select>
                                    @error('district')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row">
                                <!-- Established Year -->
                                <div class="col-md-6 form-group">
                                    <label for="established_year">Established Year</label>
                                    <input type="text" id="established_year" name="established_year" class="form-control" value="{{ old('established_year') }}" maxlength="4">
                                    @error('established_year')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- School Type -->
                                <div class="col-md-6 form-group">
                                    <label for="school_type">School Type</label>
                                    <input type="text" id="school_type" name="school_type" class="form-control" value="{{ old('school_type') }}" maxlength="50">
                                    @error('school_type')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row">
                                <!-- Registration Number -->
                                <div class="col-md-6 form-group">
                                    <label for="registration_number">School code/NESA</label>
                                    <input type="text" id="registration_number" name="registration_number" class="form-control" value="{{ old('registration_number') }}" maxlength="100">
                                    @error('registration_number')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const provinceSelect = document.getElementById('province');
        const districtSelect = document.getElementById('district');

        const districtsByProvince = {
            "Kigali City": ["Gasabo", "Kicukiro", "Nyarugenge"],
            "Southern Province": ["Kamonyi", "Muhanga", "Ruhango", "Nyanza", "Huye", "Gisagara", "Nyamagabe", "Nyaruguru"],
            "Western Province": ["Karongi", "Rutsiro", "Rubavu", "Nyabihu", "Ngororero", "Rusizi", "Nyamasheke"],
            "Northern Province": ["Musanze", "Gakenke", "Burera", "Rulindo", "Gicumbi", "Kigombe", "Nyundo", "Nyabihu"],
            "Eastern Province": ["Kayonza", "Kirehe", "Ngoma", "Nyagatare", "Gatsibo", "Bugesera", "Rwambonazi"]
        };

        provinceSelect.addEventListener('change', function() {
            const selectedProvince = provinceSelect.value;
            const districts = districtsByProvince[selectedProvince] || [];
            districtSelect.innerHTML = "<option value='' disabled selected>Select District</option>";
            districts.forEach(district => {
                const option = document.createElement('option');
                option.value = district;
                option.textContent = district;
                districtSelect.appendChild(option);
            });
        });
    });
</script>
@endsection
