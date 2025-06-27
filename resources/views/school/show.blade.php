@extends('layouts.login_master')

@section('content')
<div class="container-fluid min-vh-100 d-flex flex-column">
    @if (isset($groups[$schoolCode]))
        <!-- School Banner Header -->
        <div class="position-relative mb-4">
            <div class="bg-primary text-white py-4 rounded"
                style="background: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), url('{{ asset('global_assets/banner.jpg') }}') no-repeat center center; 
                       background-size: cover; 
                       min-height: 250px;">
                <div class="container">
                    <div class="row align-items-center h-100">
                        <div class="col-12 text-center">
                            <h1 class="display-4 font-weight-bold mb-3">{{ $groups[$schoolCode]['school_name'] }}</h1>
                            <div class="d-flex justify-content-center gap-3">
                                <span class="badge badge-light p-2">
                                    <i class="fas fa-map-marker-alt mr-1"></i> {{ $groups[$schoolCode]['province'] ?? 'N/A' }}
                                </span>
                                <span class="badge badge-light p-2">
                                    <i class="fas fa-school mr-1"></i> {{ $groups[$schoolCode]['school_status'] ?? 'N/A' }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content Container -->
        <div class="container">
            <!-- Quick Action Buttons -->
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-white">
                    <h3 class="text-primary mb-0">
                        <i class="fas fa-bolt mr-2"></i>Quick Actions
                    </h3>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-3">
                            <button class="btn btn-outline-primary btn-block h-100" data-toggle="modal" data-target="#studiesFacilitiesModal">
                                <i class="fas fa-book-reader mb-2"></i>
                                <div>Studies Facilities</div>
                            </button>
                        </div>
                        <div class="col-md-3">
                            <button class="btn btn-outline-primary btn-block h-100" data-toggle="modal" data-target="#livingRoomsModal">
                                <i class="fas fa-bed mb-2"></i>
                                <div>Living Rooms</div>
                            </button>
                        </div>
                        <div class="col-md-3">
                            <button class="btn btn-outline-primary btn-block h-100" data-toggle="modal" data-target="#examPapersModal">
                                <i class="fas fa-file-alt mb-2"></i>
                                <div>Exam Past Papers</div>
                            </button>
                        </div>
                        <div class="col-md-3">
                            <button class="btn btn-outline-primary btn-block h-100" data-toggle="modal" data-target="#studentsClubsModal">
                                <i class="fas fa-users mb-2"></i>
                                <div>Students Clubs</div>
                            </button>
                        </div>
                        <div class="col-md-3">
                            <button class="btn btn-primary btn-block h-100" data-toggle="modal" data-target="#bestPerformersModal">
                                <i class="fas fa-trophy mb-2"></i>
                                <div>Annual Best Performers</div>
                            </button>
                        </div>
                        <div class="col-md-3">
                            <button class="btn btn-primary btn-block h-100" data-toggle="modal" data-target="#placementRequestModal">
                                <i class="fas fa-graduation-cap mb-2"></i>
                                <div>Saba Umwanya w'Ishuri</div>
                            </button>
                        </div>
                        <div class="col-md-3">
                            <button class="btn btn-danger btn-block h-100" data-toggle="modal" data-target="#sackedStudentsModal">
                                <i class="fas fa-user-times mb-2"></i>
                                <div>Sacked Students</div>
                            </button>
                        </div>
                        <div class="col-md-3">
                            <button class="btn btn-dark btn-block h-100" data-toggle="modal" data-target="#legendsModal">
                                <i class="fas fa-star mb-2"></i>
                                <div>Legends & Alumni</div>
                            </button>
                        </div>
                        <div class="col-md-3">
                            <button class="btn btn-info btn-block h-100" data-toggle="modal" data-target="#visitingScheduleModal">
                                <i class="fas fa-calendar-alt mb-2"></i>
                                <div>Visiting Schedule</div>
                            </button>
                        </div>
                        <div class="col-md-3">
                            <button class="btn btn-success btn-block h-100" data-toggle="modal" data-target="#feedingTimetableModal">
                                <i class="fas fa-utensils mb-2"></i>
                                <div>Feeding Timetable</div>
                            </button>
                        </div>
                        {{-- <div class="col-md-3">
                            <a href="{{ route('school-events.index') }}" class="btn btn-warning btn-block h-100">
                                <i class="fas fa-calendar-check mb-2"></i>
                                <div>School Events</div>
                            </a>
                        </div>
                        <div class="col-md-3">
                            <a href="{{ route('school-resources.index') }}" class="btn btn-secondary btn-block h-100">
                                <i class="fas fa-box mb-2"></i>
                                <div>School Resources</div>
                            </a>
                        </div>
                        <div class="col-md-3">
                            <a href="{{ route('school-staff.index') }}" class="btn btn-info btn-block h-100">
                                <i class="fas fa-chalkboard-teacher mb-2"></i>
                                <div>School Staff</div>
                            </a>
                        </div>
                        <div class="col-md-3">
                            <a href="{{ route('school-facilities.index') }}" class="btn btn-success btn-block h-100">
                                <i class="fas fa-building mb-2"></i>
                                <div>School Facilities</div>
                            </a>
                        </div>
                        <div class="col-md-3">
                            <a href="{{ route('school-safety.index') }}" class="btn btn-danger btn-block h-100">
                                <i class="fas fa-shield-alt mb-2"></i>
                                <div>Safety & Security</div>
                            </a>
                        </div>
                        <div class="col-md-3">
                            <a href="{{ route('school-transport.index') }}" class="btn btn-primary btn-block h-100">
                                <i class="fas fa-bus mb-2"></i>
                                <div>Transport Management</div>
                            </a>
                        </div>
                        <div class="col-md-3">
                            <a href="{{ route('school-library.index') }}" class="btn btn-warning btn-block h-100">
                                <i class="fas fa-book mb-2"></i>
                                <div>Library Management</div>
                            </a>
                        </div>
                        <div class="col-md-3">
                            <a href="{{ route('school-health.index') }}" class="btn btn-info btn-block h-100">
                                <i class="fas fa-heartbeat mb-2"></i>
                                <div>Health Services</div>
                            </a>
                        </div>
                        <div class="col-md-3">
                            <a href="{{ route('school-maintenance.index') }}" class="btn btn-secondary btn-block h-100">
                                <i class="fas fa-tools mb-2"></i>
                                <div>Maintenance</div>
                            </a>
                        </div> --}}
                    </div>
                </div>
            </div>

            <!-- Available Options Section -->
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-primary text-white">
                    <h3 class="mb-0">
                        <i class="fas fa-graduation-cap mr-2"></i>Available Academic Options
                    </h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="thead-light">
                                <tr>
                                    <th class="text-center" style="width: 50%">Level</th>
                                    <th class="text-center" style="width: 50%">Combination</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (!empty($groups[$schoolCode]['options']))
                                    @foreach ($groups[$schoolCode]['options'] as $option)
                                        <tr>
                                            <td class="text-center align-middle">
                                                <span class="badge badge-primary p-2">{{ $option['level'] ?? 'N/A' }}</span>
                                            </td>
                                            <td class="text-center align-middle">
                                                <span class="badge badge-info p-2">{{ $option['combination'] ?? 'N/A' }}</span>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="2" class="text-center text-muted py-4">
                                            <i class="fas fa-info-circle mr-2"></i>No options available at the moment
                                        </td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="alert alert-danger mt-3">
            <i class="fas fa-exclamation-circle mr-2"></i>School details not found.
        </div>
    @endif

    <!-- Modals Section -->
    <div class="mt-auto">
        <div class="modal fade" id="placementRequestModal" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title">Placement Request</h5>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('child-applications.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="childFullName">Child Full Name:</label>
                                        <input type="text" class="form-control" id="childFullName" name="child_full_name"
                                            placeholder="Enter Child's Full Name" required>
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
                                            @if (!empty($groups[$schoolCode]['options']))
                                                @foreach ($groups[$schoolCode]['options'] as $option)
                                                    <option value="{{ $option['combination'] }}">{{ $option['combination'] }}
                                                    </option>
                                                @endforeach
                                            @else
                                                <option value="" disabled>No options available</option>
                                            @endif
                                        </select>
                                    </div>

                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="marksPercent">Marks Percentage:</label>
                                        <input type="number" class="form-control" id="marksPercent" name="marks_percentage"
                                            placeholder="Enter Marks Percentage" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="marksAttachment">Proof:</label>
                                        <input type="file" class="form-control-file" id="marksAttachment"
                                            name="marks_attachment" required>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="parentFullName">Parent Full Name:</label>
                                        <input type="text" class="form-control" id="parentFullName"
                                            name="parent_full_name" placeholder="Enter Parent's Full Name" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="parentEmail">Parent Email:</label>
                                        <input type="email" class="form-control" id="parentEmail" name="parent_email"
                                            placeholder="Enter Parent's Email" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="parentPhone">Parent Phone Number:</label>
                                <input type="tel" class="form-control" id="parentPhone" name="parent_phone"
                                    placeholder="Enter Parent's Phone Number" required>
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

        <!-- Studies Facilities Modal -->
        <div class="modal fade" id="studiesFacilitiesModal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title">Studies Facilities</h5>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <p>Details about the school's study facilities, including libraries, labs, and study halls.</p>

                        <!-- Playground Images Section -->
                        <div class="row text-center">
                            <div class="col-md-6 mb-3">
                                <h6>Basketball Playground</h6>
                                <img src="/global_assets/basketball_playground.jpg" class="img-fluid rounded shadow"
                                    alt="Basketball Playground">
                            </div>
                            <div class="col-md-6 mb-3">
                                <h6>Volleyball Playground</h6>
                                <img src="/global_assets/volleyball_playground.jpg" class="img-fluid rounded shadow"
                                    alt="Volleyball Playground">
                            </div>
                            <div class="col-md-6 mb-3">
                                <h6>Football Playground</h6>
                                <img src="/global_assets/football_playground.jpg" class="img-fluid rounded shadow"
                                    alt="Football Playground">
                            </div>
                            <div class="col-md-6 mb-3">
                                <h6>Handball Playground</h6>
                                <img src="/global_assets/handball_playground.jpg" class="img-fluid rounded shadow"
                                    alt="Handball Playground">
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <!-- Living Rooms Modal -->
        <div class="modal fade" id="livingRoomsModal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title">Living Rooms</h5>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <p>Information about dormitories at the school.</p>

                        <!-- Dormitory Images Section -->
                        <div class="row text-center">
                            <div class="col-md-6 mb-3">
                                <h6>Male Dormitory</h6>
                                <img src="/global_assets/male_dormitory.jpg" class="img-fluid rounded shadow"
                                    alt="Male Dormitory">
                            </div>
                            <div class="col-md-6 mb-3">
                                <h6>Female Dormitory</h6>
                                <img src="/global_assets/female_dormitory.jpg" class="img-fluid rounded shadow"
                                    alt="Female Dormitory">
                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>

        <!-- Exam Past Papers Modal -->
        <div class="modal fade" id="examPapersModal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title">Exam Past Papers</h5>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <p>Select the type of past papers you want to download:</p>

                        <!-- Selection Dropdown -->
                        <div class="form-group">
                            <label for="examType">Choose Category:</label>
                            <select class="form-control" id="examType">
                                <option value="all">All</option>
                                <option value="Ibizamini by'abalimu">Ibizamini by'abalimu</option>
                                <option value="Ibizamini bya Leta">Ibizamini bya Leta</option>
                                <option value="academic_year">Academic Year</option>
                            </select>
                        </div>

                        <!-- Past Papers List -->
                        <div id="pastPapersList">
                            <ul class="list-group">
                                <!-- Dynamically loaded past papers will appear here -->
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Students Clubs Modal -->
        <div class="modal fade" id="studentsClubsModal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title">Students Clubs</h5>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <p>Explore various student clubs and extracurricular activities available at the school.</p>

                        <!-- Clubs List -->
                        <ul class="list-group">
                            <li class="list-group-item"><strong>🎭 Modern Dance Club</strong> - Express yourself through dance
                                and choreography.</li>
                            <li class="list-group-item">
                                <strong🚑 Croix-Rouge Club</strong> - Learn first aid and participate in humanitarian
                                    activities.
                            </li>
                            <li class="list-group-item"><strong>🎤 Debate & Public Speaking Club</strong> - Enhance your
                                critical thinking and communication skills.</li>
                            <li class="list-group-item"><strong>🎨 Art & Design Club</strong> - Explore your creativity through
                                painting, drawing, and design.</li>
                            <li class="list-group-item"><strong>⚽ Sports & Fitness Club</strong> - Stay active with various
                                sports activities like football and basketball.</li>
                            <li class="list-group-item"><strong>🌱 Environmental Club</strong> - Promote sustainability and
                                environmental conservation.</li>
                            <li class="list-group-item"><strong>🎵 Music & Drama Club</strong> - Showcase your talent in
                                singing, acting, and playing instruments.</li>
                            <li class="list-group-item"><strong>💡 Science & Innovation Club</strong> - Engage in STEM projects
                                and experiments.</li>
                            <li class="list-group-item"><strong>📚 Reading & Writing Club</strong> - Improve literacy skills
                                and explore different literary works.</li>
                            <li class="list-group-item"><strong>👨‍💻 ICT & Coding Club</strong> - Learn programming, web
                                development, and digital skills.</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- Annual Best Performers Modal -->
        <div class="modal fade" id="bestPerformersModal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title">Annual Best Performers</h5>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <p>Congratulations to the top-performing students of the year!</p>

                        <!-- Best Performers Table -->
                        <table class="table table-striped">
                            <thead class="thead-dark">
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Class</th>
                                    <th>Marks (%)</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>Jean Pierre Nshimiyimana</td>
                                    <td>P6</td>
                                    <td>95%</td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>Ariane Uwamahoro</td>
                                    <td>P6</td>
                                    <td>92%</td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>Eric Mugisha</td>
                                    <td>P5</td>
                                    <td>90%</td>
                                </tr>
                                <tr>
                                    <td>4</td>
                                    <td>Sandrine Mutoni</td>
                                    <td>P5</td>
                                    <td>89%</td>
                                </tr>
                                <tr>
                                    <td>5</td>
                                    <td>Emmanuel Habimana</td>
                                    <td>P6</td>
                                    <td>87%</td>
                                </tr>
                                <tr>
                                    <td>6</td>
                                    <td>Grace Ingabire</td>
                                    <td>P4</td>
                                    <td>85%</td>
                                </tr>
                                <tr>
                                    <td>7</td>
                                    <td>Didier Maniraho</td>
                                    <td>P6</td>
                                    <td>84%</td>
                                </tr>
                                <tr>
                                    <td>8</td>
                                    <td>Josiane Uwizeye</td>
                                    <td>P5</td>
                                    <td>83%</td>
                                </tr>
                                <tr>
                                    <td>9</td>
                                    <td>Fidele Ndayisaba</td>
                                    <td>P6</td>
                                    <td>82%</td>
                                </tr>
                                <tr>
                                    <td>10</td>
                                    <td>Aimee Mukandayisenga</td>
                                    <td>P5</td>
                                    <td>81%</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sacked Students Modal -->
        <div class="modal fade" id="sackedStudentsModal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-danger text-white">
                        <h5 class="modal-title">Sacked Students</h5>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <p>The following students were dismissed from the school due to various reasons.</p>

                        <!-- Sacked Students Table -->
                        <table class="table table-bordered">
                            <thead class="thead-dark">
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Class</th>
                                    <th>Reason</th>
                                    <th>Dismissal Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>Jean Claude Ndagijimana</td>
                                    <td>S3</td>
                                    <td>Repeated misconduct</td>
                                    <td>2024-01-15</td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>Alice Mukamana</td>
                                    <td>S2</td>
                                    <td>Cheating in national exams</td>
                                    <td>2024-02-10</td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>David Uwimana</td>
                                    <td>S4</td>
                                    <td>Fighting with students</td>
                                    <td>2024-03-05</td>
                                </tr>
                                <tr>
                                    <td>4</td>
                                    <td>Esther Uwamahoro</td>
                                    <td>S1</td>
                                    <td>Vandalism of school property</td>
                                    <td>2024-04-21</td>
                                </tr>
                                <tr>
                                    <td>5</td>
                                    <td>Emmanuel Mugiraneza</td>
                                    <td>S5</td>
                                    <td>Disrespecting teachers</td>
                                    <td>2024-05-12</td>
                                </tr>
                                <tr>
                                    <td>6</td>
                                    <td>Sandrine Tuyishime</td>
                                    <td>S3</td>
                                    <td>Skipping school for weeks</td>
                                    <td>2024-06-30</td>
                                </tr>
                                <tr>
                                    <td>7</td>
                                    <td>Fidele Nshimiyimana</td>
                                    <td>S2</td>
                                    <td>Possession of illegal items</td>
                                    <td>2024-07-25</td>
                                </tr>
                                <tr>
                                    <td>8</td>
                                    <td>Aimee Uwase</td>
                                    <td>S6</td>
                                    <td>Repeated academic dishonesty</td>
                                    <td>2024-08-14</td>
                                </tr>
                                <tr>
                                    <td>9</td>
                                    <td>Patrick Iradukunda</td>
                                    <td>S4</td>
                                    <td>Bullying classmates</td>
                                    <td>2024-09-09</td>
                                </tr>
                                <tr>
                                    <td>10</td>
                                    <td>Joselyne Mukandayisenga</td>
                                    <td>S5</td>
                                    <td>Engaging in unauthorized activities</td>
                                    <td>2024-10-01</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Legends and Alumni Modal -->
        <div class="modal fade" id="legendsModal" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-dark text-white">
                        <h5 class="modal-title">Legends of the School & Best Alumni</h5>
                        <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <!-- Legends Section -->
                        <h4 class="text-primary mb-4">School Legends</h4>
                        <div class="row">
                            <!-- Legend 1 -->
                            <div class="col-md-4 mb-4">
                                <div class="card h-100 shadow-sm">
                                    <img src="{{ asset('global_assets/legend1.jpg') }}" class="card-img-top" alt="Legend 1" style="height: 200px; object-fit: cover;">
                                    <div class="card-body text-center">
                                        <h5 class="card-title">Dr. Jean Pierre Nshimiyimana</h5>
                                        <p class="card-text">Class of 1995</p>
                                        <p class="card-text">First student to score 100% in National Exams. Now a renowned surgeon at King Faisal Hospital.</p>
                                    </div>
                                </div>
                            </div>
                            <!-- Legend 2 -->
                            <div class="col-md-4 mb-4">
                                <div class="card h-100 shadow-sm">
                                    <img src="{{ asset('global_assets/legend2.jpg') }}" class="card-img-top" alt="Legend 2" style="height: 200px; object-fit: cover;">
                                    <div class="card-body text-center">
                                        <h5 class="card-title">Marie Claire Uwamahoro</h5>
                                        <p class="card-text">Class of 2000</p>
                                        <p class="card-text">Represented Rwanda in International Mathematics Olympiad. Currently a Mathematics Professor at University of Rwanda.</p>
                                    </div>
                                </div>
                            </div>
                            <!-- Legend 3 -->
                            <div class="col-md-4 mb-4">
                                <div class="card h-100 shadow-sm">
                                    <img src="{{ asset('global_assets/legend3.jpg') }}" class="card-img-top" alt="Legend 3" style="height: 200px; object-fit: cover;">
                                    <div class="card-body text-center">
                                        <h5 class="card-title">Eric Mugisha</h5>
                                        <p class="card-text">Class of 2005</p>
                                        <p class="card-text">Led the school to win National Science Competition. Now a Research Scientist at Rwanda Biomedical Center.</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Alumni Section -->
                        <h4 class="text-primary mb-4 mt-5">Notable Alumni</h4>
                        <div class="row">
                            <!-- Alumni 1 -->
                            <div class="col-md-4 mb-4">
                                <div class="card h-100 shadow-sm">
                                    <img src="{{ asset('global_assets/alumni1.jpg') }}" class="card-img-top" alt="Alumni 1" style="height: 200px; object-fit: cover;">
                                    <div class="card-body text-center">
                                        <h5 class="card-title">Sandrine Mutoni</h5>
                                        <p class="card-text">Class of 2010</p>
                                        <p class="card-text">Founder of Rwanda's first tech startup incubator. Named in Forbes 30 Under 30 Africa.</p>
                                    </div>
                                </div>
                            </div>
                            <!-- Alumni 2 -->
                            <div class="col-md-4 mb-4">
                                <div class="card h-100 shadow-sm">
                                    <img src="{{ asset('global_assets/alumni2.jpg') }}" class="card-img-top" alt="Alumni 2" style="height: 200px; object-fit: cover;">
                                    <div class="card-body text-center">
                                        <h5 class="card-title">Emmanuel Habimana</h5>
                                        <p class="card-text">Class of 2015</p>
                                        <p class="card-text">National Basketball Team Captain. Led Rwanda to first African Championship.</p>
                                    </div>
                                </div>
                            </div>
                            <!-- Alumni 3 -->
                            <div class="col-md-4 mb-4">
                                <div class="card h-100 shadow-sm">
                                    <img src="{{ asset('global_assets/alumni3.jpg') }}" class="card-img-top" alt="Alumni 3" style="height: 200px; object-fit: cover;">
                                    <div class="card-body text-center">
                                        <h5 class="card-title">Grace Ingabire</h5>
                                        <p class="card-text">Class of 2018</p>
                                        <p class="card-text">Youngest female engineer at Rwanda Energy Group. Pioneered solar energy projects in rural areas.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Visiting Schedule Modal -->
        <div class="modal fade" id="visitingScheduleModal" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-info text-white">
                        <h5 class="modal-title">Visiting Schedule</h5>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="alert alert-warning text-center font-weight-bold">
                            Visiting is only allowed on the last Sunday of each month.
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead class="thead-light">
                                    <tr>
                                        <th>Month</th>
                                        <th>Visiting Date</th>
                                        <th>Visiting Hours</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr><td>January</td><td>Sunday, January 26, 2025</td><td>10:00 AM – 4:00 PM</td></tr>
                                    <tr><td>February</td><td>Sunday, February 23, 2025</td><td>10:00 AM – 4:00 PM</td></tr>
                                    <tr><td>March</td><td>Sunday, March 30, 2025</td><td>10:00 AM – 4:00 PM</td></tr>
                                    <tr><td>April</td><td>Sunday, April 27, 2025</td><td>10:00 AM – 4:00 PM</td></tr>
                                    <!-- Add more months as needed -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Feeding Timetable Modal -->
        <div class="modal fade" id="feedingTimetableModal" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-success text-white">
                        <h5 class="modal-title">High School Feeding Timetable</h5>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead class="thead-light">
                                    <tr>
                                        <th>Day</th>
                                        <th>Morning</th>
                                        <th>Lunch</th>
                                        <th>Dinner</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr><td>Monday</td><td>Igikoma + Umugati</td><td>Rice, beans, cooked greens (e.g., spinach), banana</td><td>Ugali, beef stew, cabbage</td></tr>
                                    <tr><td>Tuesday</td><td>Ikoma</td><td>Posho (maize meal), groundnut sauce, boiled egg</td><td>Rice, chicken curry, mixed vegetables</td></tr>
                                    <tr><td>Wednesday</td><td>Icyayi</td><td>Irish potatoes, peas stew, carrot salad</td><td>Spaghetti, tomato sauce with minced meat</td></tr>
                                    <tr><td>Thursday</td><td>Irindazi nicyayi</td><td>Rice, fried fish (or egg), beans, avocado</td><td>Boiled cassava, beef stew, sukuma wiki (kale)</td></tr>
                                    <tr><td>Friday</td><td>Igikoma + Umugati</td><td>Pilau (spiced rice), vegetable sauce, fruit</td><td>Posho, beans, steamed pumpkin leaves</td></tr>
                                    <tr><td>Saturday</td><td>Igikoma + Umugati</td><td>Rice, chicken stew, green beans</td><td>Chapati, lentils, spinach</td></tr>
                                    <tr><td>Sunday</td><td>Igikoma + Umugati</td><td>Matoke (steamed green bananas), peanut sauce, cabbage</td><td>Rice, goat meat stew, coleslaw</td></tr>
                                </tbody>
                            </table>
                        </div>
                        <ul>
                            <li>Fruit servings like banana, papaya, or orange can be included 2–3 times per week.</li>
                            <li>Water or a light fruit juice should be served with meals.</li>
                            <li>Protein sources are rotated (beans, eggs, beef, chicken, lentils) for variety.</li>
                            <li>Meals are designed to be simple yet nutritious for adolescents.</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Ensure footer stays at bottom
    document.addEventListener('DOMContentLoaded', function() {
        const content = document.querySelector('.container-fluid');
        const windowHeight = window.innerHeight;
        const contentHeight = content.offsetHeight;
        
        if (contentHeight < windowHeight) {
            content.style.minHeight = windowHeight + 'px';
        }
    });
</script>
@endpush

<!-- JavaScript to Filter Past Papers -->
<script>
    document.getElementById('examType').addEventListener('change', function() {
        let selectedType = this.value;

        // Fetch filtered past papers via AJAX
        fetch(`/past-papers/filter?type=${selectedType}`)
            .then(response => response.json())
            .then(data => {
                let papersList = document.querySelector('#pastPapersList ul');
                papersList.innerHTML = '';

                if (data.length > 0) {
                    data.forEach(paper => {
                        papersList.innerHTML += `<li class="list-group-item">
                            <a href="/storage/past_papers/${paper.file_name}" target="_blank">${paper.title} - ${paper.academic_year}</a>
                        </li>`;
                    });
                } else {
                    papersList.innerHTML =
                        `<li class="list-group-item text-danger">No past papers found.</li>`;
                }
            })
            .catch(error => console.error('Error fetching past papers:', error));
    });
</script>
