@extends('layouts.master')
@section('page_title', 'User Documentation & Guidance')
@section('content')
<div class="card">
    <div class="card-header header-elements-inline">
        <h5 class="card-title">System User Documentation & Guidance</h5>
    </div>
    <div class="card-body">
        <h4>Introduction</h4>
        <p>This guide provides step-by-step instructions for all user roles in the SCHOOL CONNECT system: <strong>Super Admin, Admin, Teacher, Parent, Accountant, Librarian, and Student</strong>. Each section explains the features available to each user and how to use them effectively.</p>

        <hr>
        <h4>System Modules Overview</h4>
        <ul>
            <li><strong>Academic Management</strong>
                <ul>
                    <li>Class Management: Create/manage classes, assign teachers, set schedules, track attendance.</li>
                    <li>Subject Management: Create/update subjects, assign teachers, manage materials.</li>
                    <li>Examination System: Schedule exams, record grades, generate report cards, print marksheets, track performance.</li>
                </ul>
            </li>
            <li><strong>Student Management</strong>
                <ul>
                    <li>Student Records: Maintain profiles, track progress, manage attendance, handle admissions/transfers.</li>
                    <li>Student Promotion: Promote students, generate lists, track history, handle transfers.</li>
                </ul>
            </li>
            <li><strong>Staff Management</strong>
                <ul>
                    <li>Teacher Management: Maintain profiles, track assignments, manage attendance, handle leave requests.</li>
                    <li>Staff Records: Manage info, track attendance, process leave, handle evaluations.</li>
                </ul>
            </li>
            <li><strong>Financial Management</strong>
                <ul>
                    <li>Fee Management: Set up structures, generate invoices, track payments, handle defaulters.</li>
                    <li>Expense Tracking: Record expenses, generate reports, manage budgets, track transactions.</li>
                </ul>
            </li>
            <li><strong>Library Management</strong>
                <ul>
                    <li>Book Management: Catalog books, track circulation, manage returns/reservations.</li>
                    <li>Library Operations: Issue books, track due dates, generate overdue notices, maintain inventory.</li>
                </ul>
            </li>
            <li><strong>Transportation</strong>
                <ul>
                    <li>Vehicle Management: Manage vehicles, track maintenance, schedule usage, monitor fuel.</li>
                    <li>Route Management: Create routes, assign vehicles, track student transport, monitor bus attendance.</li>
                </ul>
            </li>
            <li><strong>School Information Center</strong>
                <ul>
                    <li>Visiting Schedule: Manage visiting hours, track appointments, handle meetings, record info.</li>
                    <li>Feeding Timetable: Create meal schedules, plan menus, track dietary needs, monitor service.</li>
                </ul>
            </li>
            <li><strong>Additional Features</strong>
                <ul>
                    <li>Notice Board: Post announcements, share updates, manage calendar, send notifications.</li>
                    <li>Reports Generation: Academic, financial, attendance reports, export data.</li>
                    <li>System Settings: Configure details, manage permissions, set calendar, customize options.</li>
                </ul>
            </li>
        </ul>

        <hr>
        <h4>User Role Functions</h4>
        <ul>
            <li><strong>Super Admin</strong>
                <ul>
                    <li>Complete system control</li>
                    <li>Delete any record</li>
                    <li>Create any user account</li>
                    <li>Manage multiple schools</li>
                    <li>Configure system settings</li>
                </ul>
            </li>
            <li><strong>Administrators (Super Admin & Admin)</strong>
                <ul>
                    <li>Manage students class/sections</li>
                    <li>View marksheet of students</li>
                    <li>Create, edit, and manage all user accounts & profiles</li>
                    <li>Create, edit, and manage exams & grades</li>
                    <li>Create, edit, and manage subjects</li>
                    <li>Manage noticeboard of school</li>
                    <li>Edit system settings</li>
                    <li>Manage payments & fees</li>
                </ul>
            </li>
            <li><strong>Accountant</strong>
                <ul>
                    <li>Manage payments & fees</li>
                    <li>Print payment receipts</li>
                    <li>Track expenses</li>
                    <li>Generate financial reports</li>
                </ul>
            </li>
            <li><strong>Librarian</strong>
                <ul>
                    <li>Manage books in the library</li>
                    <li>Track book circulation</li>
                    <li>Handle student book requests</li>
                    <li>Maintain library inventory</li>
                </ul>
            </li>
            <li><strong>Teacher</strong>
                <ul>
                    <li>Manage own class/section</li>
                    <li>Manage exam records for own subjects</li>
                    <li>Manage timetable if assigned as class teacher</li>
                    <li>Manage own profile</li>
                    <li>Upload study materials</li>
                    <li>Track student attendance</li>
                    <li>Record grades and marks</li>
                </ul>
            </li>
            <li><strong>Student</strong>
                <ul>
                    <li>View teacher profile</li>
                    <li>View own class subjects</li>
                    <li>View own marks and class timetable</li>
                    <li>View payments</li>
                    <li>View library and book status</li>
                    <li>View noticeboard and school events in calendar</li>
                    <li>Manage own profile</li>
                    <li>Track attendance</li>
                </ul>
            </li>
            <li><strong>Parent</strong>
                <ul>
                    <li>View teacher profile</li>
                    <li>View own child's marksheet (Download/Print PDF)</li>
                    <li>View own child's timetable</li>
                    <li>View own child's payments</li>
                    <li>View noticeboard and school events in calendar</li>
                    <li>Manage own profile</li>
                    <li>Track child's attendance</li>
                </ul>
            </li>
        </ul>

        <hr>
        <h4>General Tips</h4>
        <ul>
            <li>Use the sidebar to navigate between features.</li>
            <li>Click your profile icon to access "My Account" and update your details.</li>
            <li>For help, contact your school admin or super admin.</li>
        </ul>

        <hr>
        <h4>Demo Users & Credentials</h4>
        <p>Below are the demo user accounts you can use to log in and explore the SCHOOL CONNECT system. All demo users (except Super Admin) use the password <code>demo123</code>. The Super Admin uses the password <code>cj</code>.</p>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Role</th>
                    <th>Name</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Password</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Super Admin</td>
                    <td>Super Admin</td>
                    <td>cj</td>
                    <td>cj@cj.com</td>
                    <td>cj</td>
                </tr>
                <tr>
                    <td>Admin</td>
                    <td>Demo Admin</td>
                    <td>admin</td>
                    <td>admin@demo.school.com</td>
                    <td>demo123</td>
                </tr>
                <tr>
                    <td>Teacher</td>
                    <td>Demo Teacher</td>
                    <td>teacher</td>
                    <td>teacher@demo.school.com</td>
                    <td>demo123</td>
                </tr>
                <tr>
                    <td>Parent</td>
                    <td>Demo Parent</td>
                    <td>parent</td>
                    <td>parent@demo.school.com</td>
                    <td>demo123</td>
                </tr>
                <tr>
                    <td>Accountant</td>
                    <td>Demo Accountant</td>
                    <td>accountant</td>
                    <td>accountant@demo.school.com</td>
                    <td>demo123</td>
                </tr>
                <tr>
                    <td>Student</td>
                    <td>Demo Student</td>
                    <td>student</td>
                    <td>student@demo.school.com</td>
                    <td>demo123</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection 