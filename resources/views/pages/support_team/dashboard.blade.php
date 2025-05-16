@extends('layouts.master')
@section('page_title', 'My Dashboard')
@section('content')

    @if(Qs::userIsTeamSA())
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

       {{-- Universities Section for Admin --}}
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

       {{-- Quick Access Card for Admin --}}
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
    @endif

    {{-- Universities List Section for All Users --}}
    <div class="card">
        <div class="card-header header-elements-inline">
            <h5 class="card-title">Universities in Rwanda</h5>
            <div class="header-elements">
                <div class="list-icons">
                    <div class="form-group">
                        <select class="form-control" id="university-filter">
                            <option value="">All Universities</option>
                            <option value="PUBLIC">Public Universities</option>
                            <option value="PRIVATE">Private Universities</option>
                            <option value="Accredited">Accredited Universities</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <div class="card-body">
            <div class="row">
                @foreach($universities as $university)
                <div class="col-xl-4 col-sm-6 university-item" 
                     data-type="{{ $university->type }}" 
                     data-accreditation="{{ $university->accreditation_status }}">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-start mb-3">
                                <div class="mr-3">
                                    <i class="icon-graduation icon-2x text-success-400"></i>
                                </div>
                                <div class="flex-fill">
                                    <h5 class="mb-1">{{ $university->name }}</h5>
                                    <span class="badge badge-{{ $university->type == 'PUBLIC' ? 'primary' : 'info' }}">
                                        {{ $university->type }}
                                    </span>
                                    @if($university->accreditation_status == 'Accredited')
                                        <span class="badge badge-success ml-2">Accredited</span>
                                    @endif
                                </div>
                            </div>
                            <p class="mb-1"><i class="icon-location3 mr-2"></i>{{ $university->address }}, {{ $university->district }}</p>
                            @if($university->website)
                                <p class="mb-1"><i class="icon-earth mr-2"></i><a href="{{ $university->website }}" target="_blank">Visit Website</a></p>
                            @endif
                            <p class="mb-0"><i class="icon-phone mr-2"></i>{{ $university->phone_number ?? 'N/A' }}</p>
                        </div>
                        <div class="card-footer bg-light d-flex justify-content-between align-items-center">
                            <span class="text-muted">Established: {{ $university->established_year ?? 'N/A' }}</span>
                            <a href="{{ route('universities.show', $university->id) }}" class="btn btn-outline-primary btn-sm">
                                View Details
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

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
