<div class="sidebar sidebar-dark sidebar-main sidebar-expand-md">

    <!-- Sidebar mobile toggler -->
    <div class="sidebar-mobile-toggler text-center">
        <a href="#" class="sidebar-mobile-main-toggle">
            <i class="icon-arrow-left8"></i>
        </a>
        Navigation
        <a href="#" class="sidebar-mobile-expand">
            <i class="icon-screen-full"></i>
            <i class="icon-screen-normal"></i>
        </a>
    </div>
    <!-- /sidebar mobile toggler -->

    <!-- Sidebar content -->
    <div class="sidebar-content">

        <!-- User menu -->
        <div class="sidebar-user">
            <div class="card-body">
                <div class="media">
                    <div class="mr-3">
                        @auth
                            <a href="{{ route('my_account') }}">
                                <img src="{{ Auth::user()->photo ?? asset('global_assets/images/placeholders/placeholder.jpg') }}" 
                                    width="38" height="38" class="rounded-circle" alt="photo">
                            </a>
                        @else
                            <a href="{{ route('login') }}">
                                <img src="{{ asset('global_assets/images/placeholders/placeholder.jpg') }}" 
                                    width="38" height="38" class="rounded-circle" alt="photo">
                            </a>
                        @endauth
                    </div>

                    <div class="media-body">
                        @auth
                            <div class="media-title font-weight-semibold">{{ Auth::user()->name ?? 'User' }}</div>
                            <div class="font-size-xs opacity-50">
                                <i class="icon-user font-size-sm"></i>
                                &nbsp;{{ ucwords(str_replace('_', ' ', Auth::user()->user_type ?? 'guest')) }}
                            </div>
                        @else
                            <div class="media-title font-weight-semibold">Guest</div>
                            <div class="font-size-xs opacity-50">
                                <i class="icon-user font-size-sm"></i>
                                &nbsp;Guest User
                            </div>
                        @endauth
                    </div>

                    <div class="ml-3 align-self-center">
                        @auth
                            <a href="{{ route('my_account') }}" class="text-white"><i class="icon-cog3"></i></a>
                        @else
                            <a href="{{ route('login') }}" class="text-white"><i class="icon-login"></i></a>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
        <!-- /user menu -->

        <!-- Main navigation -->
        <div class="card card-sidebar-mobile">
            <ul class="nav nav-sidebar" data-nav-type="accordion">

                <!-- Main -->
                <li class="nav-item">
                    <a href="{{ route('dashboard') }}" class="nav-link {{ Route::is('dashboard') ? 'active' : '' }}">
                        <i class="icon-home4"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                @auth
                    {{-- School Info Center - Visible to school admins --}}
                    @if (Qs::userIsAdmin())
                        <li class="nav-item nav-item-submenu {{ in_array(Route::currentRouteName(), ['school.show']) ? 'nav-item-expanded nav-item-open' : '' }}">
                            <a href="#" class="nav-link">
                                <i class="icon-info22"></i>
                                <span>School Info Center</span>
                            </a>
                            <ul class="nav nav-group-sub" data-submenu-title="School Information">
                                <li class="nav-item">
                                    <a href="{{ route('school.show', auth()->user()->school_id) }}#visitingScheduleModal" class="nav-link">
                                        <i class="fas fa-calendar-alt"></i> Visiting Schedule
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('school.show', auth()->user()->school_id) }}#feedingTimetableModal" class="nav-link">
                                        <i class="fas fa-utensils"></i> Feeding Timetable
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('school.show', auth()->user()->school_id) }}#sackedStudentsModal" class="nav-link">
                                        <i class="fas fa-user-times"></i> Sacked Students
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('school.show', auth()->user()->school_id) }}#legendsModal" class="nav-link">
                                        <i class="fas fa-star"></i> Legends & Alumni
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('school.show', auth()->user()->school_id) }}#studentsClubsModal" class="nav-link">
                                        <i class="fas fa-users"></i> Students Clubs
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('school.show', auth()->user()->school_id) }}#bestPerformersModal" class="nav-link">
                                        <i class="fas fa-trophy"></i> Annual Best Performers
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('school.show', auth()->user()->school_id) }}#studiesFacilitiesModal" class="nav-link">
                                        <i class="fas fa-book-reader"></i> Studies Facilities
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('school.show', auth()->user()->school_id) }}#livingRoomsModal" class="nav-link">
                                        <i class="fas fa-bed"></i> Living Rooms
                                    </a>
                                </li>
                            </ul>
                        </li>
                    @endif

                    {{-- Only show admin features to admin and school_admin --}}
                    @if (Qs::userIsAdmin() || Qs::userIsSuperAdmin())
                        {{-- Academics, Administrative, Manage Users, Students, Classes, Universities, Dorms, Sections, Subjects, Exams, Attendance, Library, Resources, Past Papers, Expenses, Leave, Payroll, Transport, Settings --}}
                        {{-- (Keep all existing admin features here) --}}
                        {{-- Academics --}}
                        @if (Qs::userIsAcademic())
                            <li class="nav-item nav-item-submenu {{ in_array(Route::currentRouteName(), ['tt.index', 'ttr.edit', 'ttr.show', 'ttr.manage']) ? 'nav-item-expanded nav-item-open' : '' }} ">
                                <a href="#" class="nav-link"><i class="icon-graduation2"></i> <span>Academics</span></a>

                                <ul class="nav nav-group-sub" data-submenu-title="Manage Academics">
                                    {{-- Timetables --}}
                                    <li class="nav-item">
                                        <a href="{{ route('tt.index') }}" class="nav-link {{ in_array(Route::currentRouteName(), ['tt.index']) ? 'active' : '' }}">
                                            Timetables
                                        </a>
                                    </li>

                                    {{-- School Management --}}
                                    @if(auth()->user()->isSuperAdmin())
                                        <li class="nav-item nav-item-submenu {{ in_array(Route::currentRouteName(), ['schools.index', 'schools.create', 'schools.edit']) ? 'nav-item-expanded' : '' }}">
                                            <a href="#" class="nav-link {{ in_array(Route::currentRouteName(), ['schools.index', 'schools.create', 'schools.edit']) ? 'active' : '' }}">
                                                School Management
                                            </a>
                                            <ul class="nav nav-group-sub">
                                                <li class="nav-item">
                                                    <a href="{{ route('schools.index') }}" class="nav-link {{ Route::is('schools.index') ? 'active' : '' }}">All Schools</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a href="{{ route('schools.create') }}" class="nav-link {{ Route::is('schools.create') ? 'active' : '' }}">Add New School</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a href="{{ route('school.import.form') }}" class="nav-link {{ Route::is('school.import.form') ? 'active' : '' }}">Import Schools</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a href="{{ route('super_admin.schools.admins') }}" class="nav-link {{ Route::is('super_admin.schools.admins') ? 'active' : '' }}">School Admins</a>
                                                </li>
                                            </ul>
                                        </li>
                                    @else
                                        <li class="nav-item">
                                            <a href="{{ route('school.show', auth()->user()->school_id) }}" class="nav-link">School Profile</a>
                                        </li>
                                    @endif

                                    {{-- Applications --}}
                                    <li class="nav-item">
                                        <a href="{{ route('child-applications.index') }}" class="nav-link">Applications</a>
                                    </li>
                                </ul>
                            </li>
                        @endif

                        {{-- Administrative --}}
                        @if (Qs::userIsAdministrative())
                            <li class="nav-item nav-item-submenu {{ in_array(Route::currentRouteName(), ['payments.index', 'payments.create', 'payments.invoice', 'payments.receipts', 'payments.edit', 'payments.manage', 'payments.show']) ? 'nav-item-expanded nav-item-open' : '' }} ">
                                <a href="#" class="nav-link"><i class="icon-office"></i> <span>Administrative</span></a>

                                <ul class="nav nav-group-sub" data-submenu-title="Administrative">
                                    {{-- Payments --}}
                                    @if (Qs::userIsTeamAccount())
                                        <li class="nav-item nav-item-submenu {{ in_array(Route::currentRouteName(), ['payments.index', 'payments.create', 'payments.edit', 'payments.manage', 'payments.show', 'payments.invoice']) ? 'nav-item-expanded' : '' }}">
                                            <a href="#" class="nav-link {{ in_array(Route::currentRouteName(), ['payments.index', 'payments.edit', 'payments.create', 'payments.manage', 'payments.show', 'payments.invoice']) ? 'active' : '' }}">Payments</a>
                                            <ul class="nav nav-group-sub">
                                                <li class="nav-item">
                                                    <a href="{{ route('payments.create') }}" class="nav-link {{ Route::is('payments.create') ? 'active' : '' }}">Create Payment</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a href="{{ route('payments.index') }}" class="nav-link {{ in_array(Route::currentRouteName(), ['payments.index', 'payments.edit', 'payments.show']) ? 'active' : '' }}">Manage Payments</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a href="{{ route('payments.manage') }}" class="nav-link {{ in_array(Route::currentRouteName(), ['payments.manage', 'payments.invoice', 'payments.receipts']) ? 'active' : '' }}">Student Payments</a>
                                                </li>
                                            </ul>
                                        </li>
                                    @endif
                                </ul>
                            </li>
                        @endif

                        @if (Qs::userIsAdmin() || Qs::userIsSuperAdmin())
                            {{-- Manage Users --}}
                            <li class="nav-item">
                                <a href="{{ route('users.index') }}" class="nav-link {{ in_array(Route::currentRouteName(), ['users.index', 'users.show', 'users.edit']) ? 'active' : '' }}">
                                    <i class="icon-users4"></i> <span>Users</span>
                                </a>
                            </li>
                        @endif

                        @if (Qs::userIsTeamSAT())
                            {{-- Manage Students --}}
                            <li class="nav-item nav-item-submenu {{ in_array(Route::currentRouteName(), ['students.create', 'students.list', 'students.edit', 'students.show', 'students.promotion', 'students.promotion_manage', 'students.graduated']) ? 'nav-item-expanded nav-item-open' : '' }} ">
                                <a href="#" class="nav-link {{ in_array(Route::currentRouteName(), ['students.create', 'students.list', 'students.edit', 'students.show', 'students.promotion', 'students.promotion_manage', 'students.graduated']) ? 'active' : '' }}">
                                    <i class="icon-users"></i> <span>Students</span>
                                </a>
                                <ul class="nav nav-group-sub">
                                    <li class="nav-item">
                                        <a href="{{ route('students.create') }}" class="nav-link {{ in_array(Route::currentRouteName(), ['students.create']) ? 'active' : '' }}">
                                            <i class="icon-user-plus"></i> <span>Add New Student</span>
                                        </a>
                                    </li>
                                    <li class="nav-item nav-item-submenu">
                                        <a href="#" class="nav-link"><i class="icon-users"></i> <span>All Students</span></a>
                                        <ul class="nav nav-group-sub">
                                            @foreach (\App\Models\MyClass::orderBy('name')->get() as $c)
                                                <li class="nav-item">
                                                    <a href="{{ route('students.list', $c->id) }}" class="nav-link">{{ $c->name }}</a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('students.promotion') }}" class="nav-link {{ in_array(Route::currentRouteName(), ['students.promotion', 'students.promotion_manage']) ? 'active' : '' }}">
                                            <i class="icon-graduation"></i> <span>Promotion</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('students.graduated') }}" class="nav-link {{ in_array(Route::currentRouteName(), ['students.graduated']) ? 'active' : '' }}">
                                            <i class="icon-graduation"></i> <span>Graduated Students</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            {{-- Manage Classes --}}
                            <li class="nav-item">
                                <a href="{{ route('classes.index') }}" class="nav-link {{ in_array(Route::currentRouteName(), ['classes.index', 'classes.edit']) ? 'active' : '' }}">
                                    <i class="icon-windows2"></i> <span>Classes</span>
                                </a>
                            </li>

                            {{-- Manage Universities --}}
                            <li class="nav-item">
                                <a href="{{ route('universities.index') }}" class="nav-link {{ in_array(Route::currentRouteName(), ['universities.index', 'universities.create', 'universities.edit', 'universities.show']) ? 'active' : '' }}">
                                    <i class="icon-graduation"></i> <span>Universities</span>
                                </a>
                            </li>

                            {{-- Manage Dorms --}}
                            <li class="nav-item">
                                <a href="{{ route('dorms.index') }}" class="nav-link {{ in_array(Route::currentRouteName(), ['dorms.index', 'dorms.edit']) ? 'active' : '' }}">
                                    <i class="icon-home9"></i> <span>Dormitories</span>
                                </a>
                            </li>

                            {{-- Manage Sections --}}
                            <li class="nav-item">
                                <a href="{{ route('sections.index') }}" class="nav-link {{ in_array(Route::currentRouteName(), ['sections.index', 'sections.edit']) ? 'active' : '' }}">
                                    <i class="icon-fence"></i> <span>Sections</span>
                                </a>
                            </li>

                            {{-- Manage Subjects --}}
                            <li class="nav-item">
                                <a href="{{ route('subjects.index') }}" class="nav-link {{ in_array(Route::currentRouteName(), ['subjects.index', 'subjects.edit']) ? 'active' : '' }}">
                                    <i class="icon-pin"></i> <span>Subjects</span>
                                </a>
                            </li>

                            {{-- Manage Exams --}}
                            <li class="nav-item">
                                <a href="{{ route('exams.index') }}" class="nav-link {{ in_array(Route::currentRouteName(), ['exams.index', 'exams.edit']) ? 'active' : '' }}">
                                    <i class="icon-file-text2"></i> <span>Exams</span>
                                </a>
                            </li>
                        @endif

                        {{-- Attendance --}}
                        @if (Qs::userIsTeamSAT())
                            <li class="nav-item">
                                <a href="{{ route('attendance.index') }}" class="nav-link">
                                    <i class="icon-calendar"></i> <span>Attendance</span>
                                </a>
                            </li>
                        @endif

                        {{-- Library --}}
                        @if (Qs::userIsTeamSAT())
                            <li class="nav-item nav-item-submenu">
                                <a href="#" class="nav-link"><i class="icon-books"></i> <span>Library</span></a>
                                <ul class="nav nav-group-sub" data-submenu-title="Library Management">
                                    <li class="nav-item">
                                        <a href="{{ route('books.index') }}" class="nav-link">Books</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('loans.index') }}" class="nav-link">Borrow Book</a>
                                    </li>
                                </ul>
                            </li>
                        @endif

                        {{-- Resources --}}
                        @if (Qs::userIsTeamSAT())
                            <li class="nav-item nav-item-submenu">
                                <a href="#" class="nav-link"><i class="icon-folder"></i> <span>Resources</span></a>
                                <ul class="nav nav-group-sub" data-submenu-title="Resource Management">
                                    <li class="nav-item">
                                        <a href="{{ route('ressource.index') }}" class="nav-link">Resources</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('ressource.upload') }}" class="nav-link">Upload Resource</a>
                                    </li>
                                </ul>
                            </li>
                        @endif

                        {{-- Past Papers --}}
                        @if (Qs::userIsTeamSAT())
                            <li class="nav-item">
                                <a href="{{ route('past_papers.index') }}" class="nav-link">
                                    <i class="icon-file-text"></i> <span>Past Papers</span>
                                </a>
                            </li>
                        @endif

                        {{-- Expenses --}}
                        @if (Qs::userIsTeamSAT())
                            <li class="nav-item">
                                <a href="{{ route('expenses.index') }}" class="nav-link">
                                    <i class="icon-cash3"></i> <span>Expenses</span>
                                </a>
                            </li>
                        @endif

                        {{-- Leave Management --}}
                        @if (Qs::userIsTeamSAT())
                            <li class="nav-item">
                                <a href="{{ route('leaves.index') }}" class="nav-link">
                                    <i class="icon-calendar52"></i> <span>Leave</span>
                                </a>
                            </li>
                        @endif

                        {{-- Payroll --}}
                        @if (Qs::userIsTeamSAT())
                            <li class="nav-item">
                                <a href="{{ route('payrolls.index') }}" class="nav-link">
                                    <i class="icon-cash"></i> <span>Payroll</span>
                                </a>
                            </li>
                        @endif

                        {{-- Transport --}}
                        @if (Qs::userIsTeamSAT())
                            <li class="nav-item nav-item-submenu">
                                <a href="#" class="nav-link"><i class="icon-truck"></i> <span>Transport</span></a>
                                <ul class="nav nav-group-sub" data-submenu-title="Transport Management">
                                    <li class="nav-item">
                                        <a href="{{ route('vehicles.index') }}" class="nav-link">Vehicles</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('routes.index') }}" class="nav-link">Routes</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('student_transports.index') }}" class="nav-link">Students</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('bus_attendance.index') }}" class="nav-link">Bus Attendance</a>
                                    </li>
                                </ul>
                            </li>
                        @endif

                        @include('pages.' . Qs::getUserType() . '.menu')
                        
                        {{-- My Account --}}
                        <li class="nav-item">
                            <a href="{{ route('my_account') }}" class="nav-link {{ in_array(Route::currentRouteName(), ['my_account']) ? 'active' : '' }}">
                                <i class="icon-user"></i> <span>My Account</span>
                            </a>
                        </li>

                        @if(Auth::user()->user_type == 'super_admin')
                            <li class="nav-item">
                                <a href="{{ route('schools.index') }}" class="nav-link {{ in_array(Route::currentRouteName(), ['schools.index', 'schools.create', 'schools.edit']) ? 'active' : '' }}">
                                    <i class="icon-school"></i>
                                    <span>Schools Management</span>
                                </a>
                            </li>
                        @endif

                        @if (Qs::userIsAdmin() || Qs::userIsSuperAdmin())
                            <li class="nav-item mt-3">
                                <a href="{{ route('settings') }}" class="nav-link {{ Route::is('settings') ? 'active' : '' }}">
                                    <i class="icon-cog3"></i> <span>Settings</span>
                                </a>
                            </li>
                        @endif

                        @if (Qs::userIsAdmin() || Qs::userIsSuperAdmin())
                            <li class="nav-item mt-3">
                                <a href="{{ url('support_team/documentation') }}" class="nav-link">
                                    <i class="icon-book"></i> <span>User Guide</span>
                                </a>
                            </li>
                        @endif
                    @elseif (Qs::userIsTeacher())
                        {{-- TEACHER MENU --}}
                        <li class="nav-item">
                            <a href="{{ route('dashboard') }}" class="nav-link {{ Route::is('dashboard') ? 'active' : '' }}">
                                <i class="icon-home4"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('tt.index') }}" class="nav-link {{ Route::is('tt.index') ? 'active' : '' }}">
                                <i class="icon-calendar"></i>
                                <span>My Timetable</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('subjects.index') }}" class="nav-link {{ Route::is('subjects.index') ? 'active' : '' }}">
                                <i class="icon-pin"></i>
                                <span>My Subjects</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('marks.index') }}" class="nav-link {{ Route::is('marks.index') ? 'active' : '' }}">
                                <i class="icon-file-text2"></i>
                                <span>Marks</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('attendance.index') }}" class="nav-link {{ Route::is('attendance.index') ? 'active' : '' }}">
                                <i class="icon-calendar"></i>
                                <span>Attendance</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('my_account') }}" class="nav-link {{ Route::is('my_account') ? 'active' : '' }}">
                                <i class="icon-user"></i>
                                <span>My Account</span>
                            </a>
                        </li>
                    @else
                        {{-- Other user types (parent, accountant, etc.) keep their menus as is --}}
                        @include('pages.' . Qs::getUserType() . '.menu')
                        <li class="nav-item">
                            <a href="{{ route('my_account') }}" class="nav-link {{ Route::is('my_account') ? 'active' : '' }}">
                                <i class="icon-user"></i>
                                <span>My Account</span>
                            </a>
                        </li>
                    @endif
                @else
                    <li class="nav-item">
                        <a href="{{ route('login') }}" class="nav-link">
                            <i class="icon-lock"></i> <span>Login</span>
                        </a>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</div>
