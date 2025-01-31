@extends('layouts.master')
@section('page_title', 'Admit Student')
@section('content')
    <div class="card">
        <div class="card-header bg-white header-elements-inline">
            <h6 class="card-title">Please fill The form Below To Admit A New Student</h6>

            {{-- {!! Qs::getPanelOptions() !!} --}}
        </div>

        <form id="ajax-reg" method="post" enctype="multipart/form-data"   action="{{ route('admit.student') }}" data-fouc>
            @csrf
            <fieldset>
                <!-- Collapse Toggle Button -->
                <button class="btn btn-primary ml-2 mt-2 mb-3" type="button" data-toggle="collapse"
                    data-target="#personalDataForm" aria-expanded="false" aria-controls="personalDataForm">
                    <i class="fa fa-chevron-down"></i>Complete Personal Data
                </button>

                <!-- Start Card (with collapse functionality) -->
                <div class="collapse" id="personalDataForm">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title mb-4">Personal Information</h5>
                            <!-- Full Name and Address -->
                            <div class="row">
                                <div class="col-md-3 mb-2">
                                    <div class="form-group">
                                        <label for="school_id">School: <span class="text-danger">*</span></label>
                                        <select name="school_id" id="school_id" class="form-control" required>
                                            <option value="">-- Select School --</option>
                                            @foreach ($schools as $school)
                                                <option value="{{ $school->id }}"
                                                    {{ old('school_id') == $school->id ? 'selected' : '' }}>
                                                    {{ $school->school_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3 mb-2">
                                    <div class="form-group">
                                        <label for="name">Full Name: <span class="text-danger">*</span></label>
                                        <input id="name" value="{{ old('name') }}" type="text" name="name"
                                            placeholder="Full Name" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-md-3 mb-2">
                                    <div class="form-group">
                                        <label for="address">Address: <span class="text-danger">*</span></label>
                                        <input id="address" value="{{ old('address') }}" class="form-control"
                                            placeholder="Address" name="address" type="text" required>
                                    </div>
                                </div>
                                <div class="col-md-3 mb-2">
                                    <div class="form-group">
                                        <label for="email">Email Address:</label>
                                        <input id="email" type="email" value="{{ old('email') }}" name="email"
                                            class="form-control" placeholder="Email Address">
                                    </div>
                                </div>
                            </div>

                            <!-- Contact Information -->
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="phone">Phone:</label>
                                        <input id="phone" value="{{ old('phone') }}" type="text" name="phone"
                                            class="form-control" placeholder="Phone Number">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="phone2">Telephone:</label>
                                        <input id="phone2" value="{{ old('phone2') }}" type="text" name="phone2"
                                            class="form-control" placeholder="Telephone Number">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="dob">Date of Birth:</label>
                                        <input id="dob" name="dob" value="{{ old('dob') }}" type="text"
                                            class="form-control date-pick" placeholder="Select Date...">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="gender">Gender: <span class="text-danger">*</span></label>
                                        <select class="select form-control" id="gender" name="gender" required data-fouc
                                            data-placeholder="Choose..">
                                            <option value=""></option>
                                            <option {{ old('gender') == 'Male' ? 'selected' : '' }} value="Male">Male
                                            </option>
                                            <option {{ old('gender') == 'Female' ? 'selected' : '' }} value="Female">Female
                                            </option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <!-- Birth Date and Location -->
                            <div class="row">

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="province">Province:</label>
                                        <select id="province" name="province" class="form-control" required>
                                            <option value="">Select Province</option>
                                            @foreach ($provinces as $province)
                                                <option value="{{ $province }}">{{ $province }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="district">District:</label>
                                        <select id="district" name="district" class="form-control" disabled>
                                            <option value="">Select District</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="sector">Sector:</label>
                                        <select id="sector" name="sector" class="form-control" disabled>
                                            <option value="">Select Sector</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="cell">Cell:</label>
                                        <select id="cell" name="cell" class="form-control" disabled>
                                            <option value="">Select Cell</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <!-- Address Details -->
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="village">Village:</label>
                                        <select id="village" name="village" class="form-control" disabled>
                                            <option value="">Select Village</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="photo">Upload Passport Photo:</label>
                                        <input value="{{ old('photo') }}" accept="image/*" type="file"
                                            name="photo" class="form-input-styled" data-fouc>
                                        <span class="form-text text-muted">Accepted Images: jpeg, png. Max file size
                                            2Mb</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

            </fieldset>


            <fieldset>
                <!-- Collapse Toggle Button -->
                <button class="btn btn-primary ml-2 mb-3" type="button" data-toggle="collapse"
                    data-target="#studentForm" aria-expanded="false" aria-controls="studentForm">
                    <i class="fa fa-chevron-down"></i>Complete Student Data
                </button>

                <!-- Start Card (with collapse functionality) -->
                <div class="collapse" id="studentForm">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title mb-4">Student Information</h5>
                            <div class="row">
                                <!-- Class Field -->
                                <div class="col-md-3 mb-2">
                                    <div class="form-group">
                                        <label for="my_class_id">Class: <span class="text-danger">*</span></label>
                                        <select onchange="getClassSections(this.value)" data-placeholder="Choose..."
                                            required name="my_class_id" id="my_class_id"
                                            class="select-search form-control">
                                            <option value=""></option>
                                            @foreach ($my_classes as $c)
                                                <option {{ old('my_class_id') == $c->id ? 'selected' : '' }}
                                                    value="{{ $c->id }}">{{ $c->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <!-- Section Field -->
                                <div class="col-md-3 mb-2">
                                    <div class="form-group">
                                        <label for="section_id">Section: <span class="text-danger">*</span></label>
                                        <select data-placeholder="Select Class First" required name="section_id"
                                            id="section_id" class="select-search form-control">
                                            <option {{ old('section_id') ? 'selected' : '' }}
                                                value="{{ old('section_id') }}">{{ old('section_id') ? 'Selected' : '' }}
                                            </option>
                                        </select>
                                    </div>
                                </div>

                                <!-- Parent Field -->
                                <div class="col-md-3 mb-2">
                                    <div class="form-group">
                                        <label for="my_parent_id">Parent:</label>
                                        <select data-placeholder="Choose..." name="my_parent_id" id="my_parent_id"
                                            class="select-search form-control">
                                            <option value=""></option>
                                            @foreach ($parents as $p)
                                                <option {{ old('my_parent_id') == Qs::hash($p->id) ? 'selected' : '' }}
                                                    value="{{ Qs::hash($p->id) }}">{{ $p->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <!-- Year Admitted Field -->
                                <div class="col-md-3 mb-2">
                                    <div class="form-group">
                                        <label for="year_admitted">Year Admitted: <span
                                                class="text-danger">*</span></label>
                                        <select data-placeholder="Choose..." required name="year_admitted"
                                            id="year_admitted" class="select-search form-control">
                                            <option value=""></option>
                                            @for ($y = date('Y', strtotime('- 10 years')); $y <= date('Y'); $y++)
                                                <option {{ old('year_admitted') == $y ? 'selected' : '' }}
                                                    value="{{ $y }}">
                                                    {{ $y }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <!-- Dormitory Field -->
                                <div class="col-md-3 mb-2">
                                    <label for="dorm_id">Dormitory:</label>
                                    <select data-placeholder="Choose..." name="dorm_id" id="dorm_id"
                                        class="select-search form-control">
                                        <option value=""></option>
                                        @foreach ($dorms as $d)
                                            <option {{ old('dorm_id') == $d->id ? 'selected' : '' }}
                                                value="{{ $d->id }}">
                                                {{ $d->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Dormitory Room No -->
                                <div class="col-md-3 mb-2">
                                    <div class="form-group">
                                        <label>Dormitory Room No:</label>
                                        <input type="text" name="dorm_room_no" placeholder="Dormitory Room No"
                                            class="form-control" value="{{ old('dorm_room_no') }}">
                                    </div>
                                </div>

                                <!-- Sport House -->
                                <div class="col-md-3 mb-2">
                                    <div class="form-group">
                                        <label>Sport House:</label>
                                        <input type="text" name="house" placeholder="Sport House"
                                            class="form-control" value="{{ old('house') }}">
                                    </div>
                                </div>

                                 <!-- Sport House -->
                                 <div class="col-md-3 mb-2">
                                    <div class="form-group">
                                        <label>Destination:</label>
                                        <input type="text" name="destination" placeholder="Destination"
                                            class="form-control" value="{{ old('destination') }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </fieldset>
            <fieldset>
                <!-- Collapse Toggle Button -->
                <button class="btn btn-primary ml-2 mb-3" type="button" data-toggle="collapse"
                    data-target="#studentRequirements" aria-expanded="false" aria-controls="studentForm">
                    <i class="fa fa-chevron-down"></i>Complete Student Requirements
                </button>
                <div class="collapse" id="studentRequirements">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title mb-4">Student Requirements</h5>
                            <div class="row">
                                <!-- Student Number or Code -->
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="student_number">Student Number/Code: <span
                                                class="text-danger">*</span></label>
                                        <input type="text" name="student_number" id="student_number" required
                                            placeholder="Enter Student Number/Code" class="form-control"
                                            value="{{ old('student_number') }}">
                                    </div>
                                </div>

                                   <!-- Departure Time -->
                                   <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="departure_time">Home departure/Date-time:</label>
                                        <input type="datetime-local" name="departure_time" id="departure_time"
                                            class="form-control" value="{{ old('departure_time') }}">
                                    </div>
                                </div>

                                <!-- Arrival Date and Time -->
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="arrival_time">Arrival Date and Time: <span
                                                class="text-danger">*</span></label>
                                        <input type="datetime-local" name="arrival_time" id="arrival_time" required
                                            class="form-control" value="{{ old('arrival_time') }}">
                                    </div>
                                </div>
                                <!-- Brought By -->
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="brought_by">Brought By: <span class="text-danger">*</span></label>
                                        <select name="brought_by" id="brought_by" required
                                            class="form-control select-search">
                                            <option value="">Choose...</option>
                                            <option value="father" {{ old('brought_by') == 'father' ? 'selected' : '' }}>
                                                Father
                                            </option>
                                            <option value="mother" {{ old('brought_by') == 'mother' ? 'selected' : '' }}>
                                                Mother
                                            </option>
                                            <option value="myself" {{ old('brought_by') == 'myself' ? 'selected' : '' }}>
                                                Myself
                                            </option>
                                            <option value="other" {{ old('brought_by') == 'other' ? 'selected' : '' }}>
                                                Other
                                            </option>
                                        </select>
                                    </div>
                                </div>

                                <!-- Other Kind of Insurance -->
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="other_insurance">Specify any sickness:</label>
                                        <input type="text" name="sickness" id="other_insurance" class="form-control"
                                            placeholder="Enter Other Insurance" value="{{ old('other_insurance') }}">
                                    </div>
                                </div>

                                <!-- Health Insurance -->
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="insurance">Health Insurance: <span
                                                class="text-danger">*</span></label>
                                        <select name="insurance" id="insurance" required
                                            class="form-control select-search"
                                            onchange="toggleInsuranceDetails(this.value)">
                                            <option value="">Choose...</option>
                                            <option value="RAMA" {{ old('insurance') == 'RAMA' ? 'selected' : '' }}>RAMA
                                            </option>
                                            <option value="MITUELLE"
                                                {{ old('insurance') == 'MITUELLE' ? 'selected' : '' }}>
                                                MITUELLE
                                            </option>
                                            <option value="none" {{ old('insurance') == 'none' ? 'selected' : '' }}>No
                                                Health
                                                Insurance</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="special_insurance">Special Kind of Insurance:</label>
                                        <input type="text" name="special_insurance" id="special_insurance"
                                            class="form-control" placeholder="Enter Special Insurance"
                                            value="{{ old('special_insurance') }}">
                                    </div>
                                </div>

                                <!-- School Fees Status -->
                                <div class="col-md-3">
                                    <label for="fees_status">School Fees Status: <span
                                            class="text-danger">*</span></label>
                                    <select name="fees_status" id="fees_status" required
                                        class="form-control select-search" onchange="toggleFeesDetails(this.value)">
                                        <option value="">Choose...</option>
                                        <option value="full" {{ old('fees_status') == 'full' ? 'selected' : '' }}>Paid
                                            in Full
                                        </option>
                                        <option value="half" {{ old('fees_status') == 'half' ? 'selected' : '' }}>Paid
                                            in Half
                                        </option>
                                    </select>
                                </div>
                            </div>

                            <!-- School Fees -->
                            <div class="row">
                                <!-- Fees Details -->
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="fees_paid">Amount Paid:</label>
                                        <input type="number" name="fees_paid" id="fees_paid" placeholder="Amount Paid"
                                            class="form-control" value="{{ old('fees_paid') }}">
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="remaining_fees">Remaining Amount:</label>
                                        <input type="number" name="remaining_fees" id="remaining_fees"
                                            placeholder="Remaining Amount" class="form-control"
                                            value="{{ old('remaining_fees') }}">
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="balance_date">Date to Pay Balance:</label>
                                        <input type="date" name="balance_date" id="balance_date" class="form-control"
                                            value="{{ old('balance_date') }}">
                                    </div>
                                </div>

                                <!-- Specify Other Organization Paying Fees -->
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="other_organization">Other Organization Paying Fees:</label>
                                        <input type="text" name="other_organization" id="other_organization"
                                            class="form-control" placeholder="Specify Other Organization"
                                            value="{{ old('other_organization') }}">
                                    </div>
                                </div>
                            </div>

                            <!-- Pocket Money -->
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="pocket_money">Pocket Money to Keep with Administration:</label>
                                        <input type="number" name="pocket_money" id="pocket_money"
                                            placeholder="Specify Amount" class="form-control"
                                            value="{{ old('pocket_money') }}">
                                    </div>
                                </div>

                                <!-- Go Home -->
                                <!-- Pocket Money to Go Home -->
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="pocket_money_to_go_home">Has Pocket Money to Go Home:</label>
                                        <select name="pocket_money_to_go_home" id="pocket_money_to_go_home"
                                            class="form-control select-search" onchange="togglePocketMoneyAmount()">
                                            <option value="">Choose...</option>
                                            <option value="yes"
                                                {{ old('pocket_money_to_go_home') == 'yes' ? 'selected' : '' }}>Yes
                                            </option>
                                            <option value="no"
                                                {{ old('pocket_money_to_go_home') == 'no' ? 'selected' : '' }}>
                                                No
                                            </option>
                                        </select>
                                    </div>
                                </div>

                                <!-- Pocket Money Amount (Appears only if Yes is selected) -->
                                <div class="col-md-3" id="pocket_money_amount_field" style="display: none;">
                                    <div class="form-group">
                                        <label for="pocket_money_amount">Amount of Pocket Money:</label>
                                        <input type="number" name="pocket_money_amount" id="pocket_money_amount"
                                            placeholder="Amount" class="form-control"
                                            value="{{ old('pocket_money_amount') }}">
                                    </div>
                                </div>

                                <!-- Hygiene Materials -->
                                <div class="col-md-3">
                                    <label for="hygiene_materials_complete">Hygiene Materials Submitted:</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="hygiene_materials_complete"
                                            value="1" id="hygiene_materials_complete"
                                            {{ old('hygiene_materials_complete') ? 'checked' : '' }}>
                                        <label class="form-check-label" for="hygiene_materials_complete">
                                            I confirm that all required hygiene materials (Soap, Toothpaste, Towels, etc.)
                                            have been
                                            submitted.
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </fieldset>
            <!-- Submit Button -->
            <div class="col-md-4">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>

        </form>
    </div>
    </div>
@endsection
