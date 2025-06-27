@extends('layouts.master')
@section('page_title', 'My Dashboard')
@section('content')

<p>
    Logged in as: {{ auth()->user()->name }}<br>
    User ID: {{ auth()->user()->id }}<br>
    User Email: {{ auth()->user()->email }}<br>
    User School ID: {{ auth()->user()->school_id }}
</p>

    @if(Qs::userIsTeamSA())
       <div class="alert alert-warning"><strong>Super Admin Dashboard Section</strong></div>
       {{-- Super Admin Dashboard --}}
       <div class="row">
           <div class="col-sm-6 col-xl-3">
               <div class="card card-body bg-blue-400 has-bg-image">
                   <div class="media">
                       <div class="media-body">
                           <h3 class="mb-0">{{ $users->where('user_type', 'student')->count() }}</h3>
                           <span class="text-uppercase font-size-xs font-weight-bold">Total Students</span>
                       </div>

                       <div class="ml-3 align-self-center">
                           <i class="icon-users4 icon-3x opacity-75"></i>
                       </div>
                   </div>
               </div>
           </div>

           <div class="col-sm-6 col-xl-3">
               <div class="card card-body bg-danger-400 has-bg-image">
                   <div class="media">
                       <div class="media-body">
                           <h3 class="mb-0">{{ $users->where('user_type', 'teacher')->count() }}</h3>
                           <span class="text-uppercase font-size-xs">Total Teachers</span>
                       </div>

                       <div class="ml-3 align-self-center">
                           <i class="icon-users2 icon-3x opacity-75"></i>
                       </div>
                   </div>
               </div>
           </div>

           <div class="col-sm-6 col-xl-3">
               <div class="card card-body bg-success-400 has-bg-image">
                   <div class="media">
                       <div class="mr-3 align-self-center">
                           <i class="icon-pointer icon-3x opacity-75"></i>
                       </div>

                       <div class="media-body text-right">
                           <h3 class="mb-0">{{ $users->where('user_type', 'admin')->count() }}</h3>
                           <span class="text-uppercase font-size-xs">Total Administrators</span>
                       </div>
                   </div>
               </div>
           </div>

           <div class="col-sm-6 col-xl-3">
               <div class="card card-body bg-indigo-400 has-bg-image">
                   <div class="media">
                       <div class="mr-3 align-self-center">
                           <i class="icon-user icon-3x opacity-75"></i>
                       </div>

                       <div class="media-body text-right">
                           <h3 class="mb-0">{{ $users->where('user_type', 'parent')->count() }}</h3>
                           <span class="text-uppercase font-size-xs">Total Parents</span>
                       </div>
                   </div>
               </div>
           </div>
       </div>

       {{-- Universities Section for Super Admin --}}
       <div class="row">
           <div class="col-sm-6 col-xl-3">
               <div class="card card-body bg-purple-400 has-bg-image">
                   <div class="media">
                       <div class="media-body">
                           <h3 class="mb-0">{{ \App\Models\University::count() }}</h3>
                           <span class="text-uppercase font-size-xs font-weight-bold">Total Universities</span>
                       </div>

                       <div class="ml-3 align-self-center">
                           <i class="icon-graduation icon-3x opacity-75"></i>
                       </div>
                   </div>
               </div>
           </div>

           <div class="col-sm-6 col-xl-3">
               <div class="card card-body bg-teal-400 has-bg-image">
                   <div class="media">
                       <div class="media-body">
                           <h3 class="mb-0">{{ \App\Models\University::where('type', 'PUBLIC')->count() }}</h3>
                           <span class="text-uppercase font-size-xs">Public Universities</span>
                       </div>

                       <div class="ml-3 align-self-center">
                           <i class="icon-office icon-3x opacity-75"></i>
                       </div>
                   </div>
               </div>
           </div>

           <div class="col-sm-6 col-xl-3">
               <div class="card card-body bg-pink-400 has-bg-image">
                   <div class="media">
                       <div class="media-body">
                           <h3 class="mb-0">{{ \App\Models\University::where('type', 'PRIVATE')->count() }}</h3>
                           <span class="text-uppercase font-size-xs">Private Universities</span>
                       </div>

                       <div class="ml-3 align-self-center">
                           <i class="icon-home9 icon-3x opacity-75"></i>
                       </div>
                   </div>
               </div>
           </div>

           <div class="col-sm-6 col-xl-3">
               <div class="card card-body bg-orange-400 has-bg-image">
                   <div class="media">
                       <div class="media-body">
                           <h3 class="mb-0">{{ \App\Models\University::where('accreditation_status', 'Accredited')->count() }}</h3>
                           <span class="text-uppercase font-size-xs">Accredited Universities</span>
                       </div>

                       <div class="ml-3 align-self-center">
                           <i class="icon-certificate icon-3x opacity-75"></i>
                       </div>
                   </div>
               </div>
           </div>
       </div>

       {{-- Quick Access Card for Super Admin --}}
       <div class="row">
           <div class="col-md-12">
               <div class="card">
                   <div class="card-header header-elements-inline">
                       <h5 class="card-title">Universities Quick Access</h5>
                       <div class="header-elements">
                           <a href="{{ route('universities.create') }}" class="btn btn-primary btn-sm">
                               <i class="icon-plus2 mr-2"></i> Add University
                           </a>
                       </div>
                   </div>

                   <div class="card-body">
                       <div class="row">
                           <div class="col-md-3">
                               <a href="{{ route('universities.index') }}" class="btn btn-outline-primary btn-block btn-float m-0">
                                   <i class="icon-graduation icon-2x"></i>
                                   <span>All Universities</span>
                               </a>
                           </div>
                           <div class="col-md-3">
                               <a href="{{ route('universities.index', ['type' => 'PUBLIC']) }}" class="btn btn-outline-success btn-block btn-float m-0">
                                   <i class="icon-office icon-2x"></i>
                                   <span>Public Universities</span>
                               </a>
                           </div>
                           <div class="col-md-3">
                               <a href="{{ route('universities.index', ['type' => 'PRIVATE']) }}" class="btn btn-outline-info btn-block btn-float m-0">
                                   <i class="icon-home9 icon-2x"></i>
                                   <span>Private Universities</span>
                               </a>
                           </div>
                           <div class="col-md-3">
                               <a href="{{ route('universities.index', ['accreditation_status' => 'Accredited']) }}" class="btn btn-outline-warning btn-block btn-float m-0">
                                   <i class="icon-certificate icon-2x"></i>
                                   <span>Accredited Universities</span>
                               </a>
                           </div>
                       </div>
                   </div>
               </div>
           </div>
       </div>
    @else
       <div class="alert alert-success"><strong>School Admin/Teacher Dashboard Section</strong></div>
       {{-- School Admin Dashboard --}}
       <div class="row">
           <div class="col-sm-6 col-xl-3">
               <div class="card card-body bg-blue-400 has-bg-image">
                   <div class="media">
                       <div class="media-body">
                           <h3 class="mb-0">{{ $total_students }}</h3>
                           <span class="text-uppercase font-size-xs font-weight-bold">Total Students</span>
                       </div>

                       <div class="ml-3 align-self-center">
                           <i class="icon-users4 icon-3x opacity-75"></i>
                       </div>
                   </div>
               </div>
           </div>

           <div class="col-sm-6 col-xl-3">
               <div class="card card-body bg-danger-400 has-bg-image">
                   <div class="media">
                       <div class="media-body">
                           <h3 class="mb-0">{{ $total_teachers }}</h3>
                           <span class="text-uppercase font-size-xs">Total Teachers</span>
                       </div>

                       <div class="ml-3 align-self-center">
                           <i class="icon-users2 icon-3x opacity-75"></i>
                       </div>
                   </div>
               </div>
           </div>

           <div class="col-sm-6 col-xl-3">
               <div class="card card-body bg-success-400 has-bg-image">
                   <div class="media">
                       <div class="mr-3 align-self-center">
                           <i class="icon-user-tie icon-3x opacity-75"></i>
                       </div>

                       <div class="media-body text-right">
                           <h3 class="mb-0">{{ $total_parents }}</h3>
                           <span class="text-uppercase font-size-xs">Total Parents</span>
                       </div>
                   </div>
               </div>
           </div>

           <div class="col-sm-6 col-xl-3">
               <div class="card card-body bg-indigo-400 has-bg-image">
                   <div class="media">
                       <div class="mr-3 align-self-center">
                           <i class="icon-cash3 icon-3x opacity-75"></i>
                       </div>

                       <div class="media-body text-right">
                           <h3 class="mb-0">{{ $total_accountants }}</h3>
                           <span class="text-uppercase font-size-xs">Total Accountants</span>
                       </div>
                   </div>
               </div>
           </div>
       </div>

       @if($total_students == 0 && $total_teachers == 0 && $total_parents == 0 && $total_accountants == 0)
           <div class="alert alert-info">
               <strong>Welcome!</strong> Your school is set up. Start by adding students, teachers, and other users to see them here.
           </div>
       @endif

       {{-- School Performance Metrics --}}
       <div class="row">
           <div class="col-sm-6 col-xl-3">
               <div class="card card-body bg-purple-400 has-bg-image">
                   <div class="media">
                       <div class="media-body">
                           <h3 class="mb-0">{{ $pass_rate ?? 'N/A' }}%</h3>
                           <span class="text-uppercase font-size-xs font-weight-bold">Pass Rate</span>
                       </div>

                       <div class="ml-3 align-self-center">
                           <i class="icon-stats-bars icon-3x opacity-75"></i>
                       </div>
                   </div>
               </div>
           </div>

           <div class="col-sm-6 col-xl-3">
               <div class="card card-body bg-teal-400 has-bg-image">
                   <div class="media">
                       <div class="media-body">
                           <h3 class="mb-0">{{ $ranking ?? 'N/A' }}</h3>
                           <span class="text-uppercase font-size-xs">School Ranking</span>
                       </div>

                       <div class="ml-3 align-self-center">
                           <i class="icon-trophy icon-3x opacity-75"></i>
                       </div>
                   </div>
               </div>
           </div>

           <div class="col-sm-6 col-xl-3">
               <div class="card card-body bg-pink-400 has-bg-image">
                   <div class="media">
                       <div class="media-body">
                           <h3 class="mb-0">{{ $student_capacity ?? 'N/A' }}</h3>
                           <span class="text-uppercase font-size-xs">Student Capacity</span>
                       </div>

                       <div class="ml-3 align-self-center">
                           <i class="icon-users icon-3x opacity-75"></i>
                       </div>
                   </div>
               </div>
           </div>

           <div class="col-sm-6 col-xl-3">
               <div class="card card-body bg-orange-400 has-bg-image">
                   <div class="media">
                       <div class="media-body">
                           <h3 class="mb-0">{{ $classroom_count ?? 'N/A' }}</h3>
                           <span class="text-uppercase font-size-xs">Classrooms</span>
                       </div>

                       <div class="ml-3 align-self-center">
                           <i class="icon-office icon-3x opacity-75"></i>
                       </div>
                   </div>
               </div>
           </div>
       </div>

       {{-- School Facilities --}}
       <div class="row">
           <div class="col-md-12">
               <div class="card">
                   <div class="card-header header-elements-inline">
                       <h5 class="card-title">School Facilities</h5>
                   </div>

                   <div class="card-body">
                       <div class="row">
                           <div class="col-md-4">
                               <div class="card card-body bg-light">
                                   <div class="d-flex align-items-center">
                                       <i class="icon-library icon-2x mr-3 {{ $has_library ? 'text-success' : 'text-danger' }}"></i>
                                       <div>
                                           <h6 class="mb-0">Library</h6>
                                           <span class="text-muted">{{ $has_library ? 'Available' : 'Not Available' }}</span>
                                       </div>
                                   </div>
                               </div>
                           </div>
                           <div class="col-md-4">
                               <div class="card card-body bg-light">
                                   <div class="d-flex align-items-center">
                                       <i class="icon-lab icon-2x mr-3 {{ $has_laboratory ? 'text-success' : 'text-danger' }}"></i>
                                       <div>
                                           <h6 class="mb-0">Laboratory</h6>
                                           <span class="text-muted">{{ $has_laboratory ? 'Available' : 'Not Available' }}</span>
                                       </div>
                                   </div>
                               </div>
                           </div>
                           <div class="col-md-4">
                               <div class="card card-body bg-light">
                                   <div class="d-flex align-items-center">
                                       <i class="icon-basketball icon-2x mr-3 {{ $has_sports_facility ? 'text-success' : 'text-danger' }}"></i>
                                       <div>
                                           <h6 class="mb-0">Sports Facility</h6>
                                           <span class="text-muted">{{ $has_sports_facility ? 'Available' : 'Not Available' }}</span>
                                       </div>
                                   </div>
                               </div>
                           </div>
                       </div>
                   </div>
               </div>
           </div>
       </div>
    @endif

    {{--Events Calendar Begins--}}
    <div class="card">
        <div class="card-header header-elements-inline">
            <h5 class="card-title">School Events Calendar</h5>
         {!! Qs::getPanelOptions() !!}
        </div>

        <div class="card-body">
            <div class="fullcalendar-basic"></div>
        </div>
    </div>
    {{--Events Calendar Ends--}}

    @section('page_scripts')
    <script>
        $(document).ready(function() {
            // University filter functionality
            $('#university-filter').change(function() {
                var filterValue = $(this).val();
                
                $('.university-item').each(function() {
                    var $item = $(this);
                    if (!filterValue) {
                        $item.show();
                        return;
                    }
                    
                    if (filterValue === 'Accredited') {
                        if ($item.data('accreditation') === 'Accredited') {
                            $item.show();
                        } else {
                            $item.hide();
                        }
                    } else {
                        if ($item.data('type') === filterValue) {
                            $item.show();
                        } else {
                            $item.hide();
                        }
                    }
                });
            });
        });
    </script>
    @endsection
@endsection
