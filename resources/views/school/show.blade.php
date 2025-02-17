@extends('layouts.login_master')

@section('content')
    <div class="container-fluid text-center p-4">
        @if (isset($groups[$schoolCode]))
            <!-- School Picture Header -->
            <!-- School Picture Header with Banner -->
            <div class="bg-primary text-white py-4 rounded"
                style="background: url('{{ asset('global_assets/banner.jpg') }}') no-repeat center center; 
                   background-size: cover; 
                   min-height: 400px; /* Adjust height as needed */
                   display: flex; 
                   justify-content: center; 
                   align-items: center;">
                <h1 class="display-4"
                    style="background: rgba(0, 0, 0, 0.5); 
                       padding: 10px; 
                       border-radius: 10px; 
                       text-align: center;">
                    {{ $groups[$schoolCode]['school_name'] }}
                </h1>
            </div>




            <!-- School Information -->
            {{-- <div class="mt-4">

                <ul class="list-unstyled">
                    <li><strong>Province:</strong> {{ $groups[$schoolCode]['province'] ?? 'N/A' }}</li>
                    <li><strong>District:</strong> {{ $groups[$schoolCode]['district'] ?? 'N/A' }}</li>
                    <li><strong>School Type:</strong> {{ $groups[$schoolCode]['school_status'] ?? 'N/A' }}</li>
                </ul>
            </div> --}}

            <!-- Buttons for Categories -->
            <div class="row mt-3">
                <div class="col-md-12">


                    <button class="btn btn-outline-primary m-1" data-toggle="modal"
                        data-target="#studiesFacilitiesModal">Studies Facilities</button>
                    <button class="btn btn-outline-primary m-1" data-toggle="modal" data-target="#livingRoomsModal">Living
                        Rooms</button>
                    {{-- <button class="btn btn-outline-primary m-1" data-toggle="modal"
                        data-target="#timetableModal">Timetable</button> --}}
                    <button class="btn btn-outline-primary m-1" data-toggle="modal" data-target="#examPapersModal">Exam Past
                        Papers</button>
                    <button class="btn btn-outline-primary m-1" data-toggle="modal"
                        data-target="#studentsClubsModal">Students Clubs</button>
                    <button class="btn btn-primary m-1" data-toggle="modal" data-target="#bestPerformersModal">Annual Best
                        Performers</button>
                    <button class="btn btn-primary m-1" data-toggle="modal" data-target="#placementRequestModal">Saba
                        Umwanya w'Ishuri</button>

                    <button class="btn btn-danger m-1" data-toggle="modal" data-target="#sackedStudentsModal">Sacked
                        Students</button>

                    <button class="btn btn-dark m-1" data-toggle="modal" data-target="#legendsModal">Legends of the School &
                        Best Alumni</button>

                </div>
            </div>

            <!-- Available Options Table -->
            <h3 class="mt-4 text-primary font-weight-bold">Available Options</h3>
            <div class="table-responsive">
                <table class="table table-striped table-hover border rounded shadow">
                    <thead class="bg-dark text-white text-center">
                        <tr>
                            <th class="p-3">Level</th>
                            <th class="p-3">Combination</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (!empty($groups[$schoolCode]['options']))
                            @foreach ($groups[$schoolCode]['options'] as $option)
                                <tr class="text-center">
                                    <td class="p-3">{{ $option['level'] ?? 'N/A' }}</td>
                                    <td class="p-3">{{ $option['combination'] ?? 'N/A' }}</td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="2" class="text-center text-muted p-4">No options available</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        @else
            <p class="text-danger mt-3">School details not found.</p>
        @endif

    </div>

    </div>



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


    <!-- Timetable Modal -->
    {{-- <div class="modal fade" id="timetableModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">Timetable</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <p>View the school timetable and class schedules.</p>
            </div>
        </div>
    </div>
</div> --}}

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
                            <option value="Ibizamini by’abalimu">Ibizamini by’abalimu</option>
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
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-dark text-white">
                    <h5 class="modal-title">Legends & Best Alumni</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <p>List of successful alumni who once studied at our school and their achievements.</p>

                    <!-- Alumni Table -->
                    <table class="table table-bordered">
                        <thead class="thead-light">
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Graduation Year</th>
                                <th>Current Profession</th>
                                <th>Notable Achievements</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Dr. Eric Ndayishimiye</td>
                                <td>2005</td>
                                <td>Neurosurgeon</td>
                                <td>Head of Neurosurgery at Kigali University Hospital</td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>Sandrine Mukamana</td>
                                <td>2010</td>
                                <td>Software Engineer</td>
                                <td>Senior Developer at Google</td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>Jean Claude Habimana</td>
                                <td>2008</td>
                                <td>Entrepreneur</td>
                                <td>Founder & CEO of AgroTech Rwanda</td>
                            </tr>
                            <tr>
                                <td>4</td>
                                <td>Ines Uwase</td>
                                <td>2012</td>
                                <td>Human Rights Lawyer</td>
                                <td>Advocate at the International Criminal Court</td>
                            </tr>
                            <tr>
                                <td>5</td>
                                <td>Patrick Mugisha</td>
                                <td>2007</td>
                                <td>Professional Footballer</td>
                                <td>Played for the Rwandan National Team & European Clubs</td>
                            </tr>
                            <tr>
                                <td>6</td>
                                <td>Josiane Uwamariya</td>
                                <td>2015</td>
                                <td>Filmmaker</td>
                                <td>Won Best Director Award at the African Film Festival</td>
                            </tr>
                            <tr>
                                <td>7</td>
                                <td>Fidele Nshimiyimana</td>
                                <td>2009</td>
                                <td>Diplomat</td>
                                <td>Rwandan Ambassador to the United Nations</td>
                            </tr>
                            <tr>
                                <td>8</td>
                                <td>Aimee Tuyisenge</td>
                                <td>2013</td>
                                <td>Scientist</td>
                                <td>Leading Researcher in Renewable Energy Solutions</td>
                            </tr>
                            <tr>
                                <td>9</td>
                                <td>David Iradukunda</td>
                                <td>2011</td>
                                <td>Journalist</td>
                                <td>Senior Reporter at BBC Africa</td>
                            </tr>
                            <tr>
                                <td>10</td>
                                <td>Claudine Mukeshimana</td>
                                <td>2014</td>
                                <td>Fashion Designer</td>
                                <td>Founded a global fashion brand with presence in Paris & Kigali</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>














@endsection


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
