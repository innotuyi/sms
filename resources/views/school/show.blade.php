@extends('layouts.login_master')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center">
                    <h1>{{ $school->school_name }}</h1>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <ul class="list-group">
                                <li class="list-group-item"><strong>Address:</strong> {{ $school->address }}</li>
                                <li class="list-group-item"><strong>Phone:</strong> {{ $school->phone_number }}</li>
                                <li class="list-group-item"><strong>Email:</strong> {{ $school->email }}</li>
                                <li class="list-group-item"><strong>Principal:</strong> {{ $school->principal_name }}</li>
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <ul class="list-group">
                                <li class="list-group-item"><strong>Province:</strong> {{ $school->province }}</li>
                                <li class="list-group-item"><strong>District:</strong> {{ $school->district }}</li>
                                <li class="list-group-item"><strong>Established Year:</strong> {{ $school->established_year }}</li>
                                <li class="list-group-item"><strong>School Type:</strong> {{ $school->school_type }}</li>
                            </ul>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4>School Information</h4>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="card text-center" data-toggle="modal" data-target="#optionAvailableModal">
                                                <div class="card-body">
                                                    <h5 class="card-title">Option Available</h5>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="card text-center" data-toggle="modal" data-target="#studiesFacilitiesModal">
                                                <div class="card-body">
                                                    <h5 class="card-title">Studies Facilities</h5>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="card text-center" data-toggle="modal" data-target="#livingRoomsModal">
                                                <div class="card-body">
                                                    <h5 class="card-title">Living Rooms</h5>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-12 text-center">
                            <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#placementRequestModal">Request for Placement</a> 
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="optionAvailableModal" tabindex="-1" role="dialog" aria-labelledby="optionAvailableModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="optionAvailableModalLabel">Option Available</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Option</th>
                            <th>Requirements</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Physics-Chemistry-Mathematics</td>
                            <td>
                                <ul>
                                    <li>Good grades in Physics and Mathematics</li>
                                </ul>
                            </tr>
                        </tr>
                        <tr>
                            <td>Mathematics-Chemistry-Biology</td>
                            <td>
                                <ul>
                                    <li>Good grades in Mathematics and Biology</li>
                                </ul>
                            </tr>
                        </tr>
                        <tr>
                            <td>Mathematics-Physics-Geography</td>
                            <td>
                                <ul>
                                    <li>Good grades in Mathematics and Geography</li>
                                </ul>
                            </tr>
                        </tr>
                        <tr>
                            <td>Physics-Chemistry-Biology</td>
                            <td>
                                <ul>
                                    <li>Good grades in Physics and Biology</li>
                                </ul>
                            </tr>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="studiesFacilitiesModal" tabindex="-1" role="dialog" aria-labelledby="studiesFacilitiesModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="studiesFacilitiesModalLabel">Studies Facilities</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="livingRoomsModal" tabindex="-1" role="dialog" aria-labelledby="livingRoomsModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="livingRoomsModalLabel">Living Rooms</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="placementRequestModal" tabindex="-1" role="dialog" aria-labelledby="placementRequestModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="placementRequestModalLabel">Placement Request</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('child-applications.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="childFullName">Child Full Name:</label>
                                <input type="text" class="form-control" id="childFullName" name="child_full_name" placeholder="Enter Child's Full Name" required>
                            </div>
                            <div class="form-group">
                                <label for="category">Category:</label>
                                <select class="form-control" id="category" name="category" required>
                                    <option value="">Select Category</option>
                                    <option value="ordinary">Ordinary Level</option>
                                    <option value="advanced">Advanced Level</option>
                                </select>
                            </div>
                            <div class="form-group" id="optionContainer"> 
                                <label for="option">Select Option:</label>
                                <select class="form-control" id="option" name="option">
                                    <option value="">Select Option</option>
                                    <option value="physics-chemistry-mathematics">Physics-Chemistry-Mathematics</option>
                                    <option value="mathematics-chemistry-biology">Mathematics-Chemistry-Biology</option>
                                    <option value="mathematics-physics-geography">Mathematics-Physics-Geography</option>
                                    <option value="physics-chemistry-biology">Physics-Chemistry-Biology</option> 
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="marksPercent">Marks Percentage:</label>
                                <input type="number" class="form-control" id="marksPercent" name="marks_percentage" placeholder="Enter Marks Percentage" required>
                            </div>
                            <div class="form-group">
                                <label for="marksAttachment">Proof:</label>
                                <input type="file" class="form-control-file" id="marksAttachment" name="marks_attachment" required>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="parentFullName">Parent Full Name:</label>
                                <input type="text" class="form-control" id="parentFullName" name="parent_full_name" placeholder="Enter Parent's Full Name" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="parentEmail">Parent Email:</label>
                                <input type="email" class="form-control" id="parentEmail" name="parent_email" placeholder="Enter Parent's Email" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="parentPhone">Parent Phone Number:</label>
                        <input type="tel" class="form-control" id="parentPhone" name="parent_phone" placeholder="Enter Parent's Phone Number" required>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit Request</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>




<script>
    // Show/hide option selection based on category
    <span class="math-inline">\('\#category'\)\.on\('change', function\(\) \{
if \(</span>(this).val() === 'ordinary') {
            $('#optionContainer').show();
        } else {
            $('#optionContainer').hide();
        }
    });
</script>

@endsection

