## **Laravel School Management System** 

**LAVSMS** is developed for educational institutions like schools and colleges built on Laravel 8

**SCREENSHOTS** 

**Dashboard**
<img src="https://i.ibb.co/D4T0z6T/dashboard.png" alt="dashboard" border="0">

**Login**
<img src="https://i.ibb.co/Rh1Bfwk/login.png" alt="login" border="0">

**Student Marksheet**
<img src="https://i.ibb.co/GCgv5ZR/marksheet.png" alt="marksheet" border="0">

**System Settings**
<img src="https://i.ibb.co/Kmrhw69/system-settings.png" alt="system-settings" border="0">

**Print Marksheet**
<div style="clear: both"> </div>
<img src="https://i.ibb.co/5c1GHCj/capture-20210530-115521-crop.png" alt="print-marksheet">

**Print Tabulation Sheet & Marksheet**
<img src="https://i.ibb.co/QmscPfn/capture-20210530-115802.png" alt="tabulation-sheet" border="0">

<hr />  

## User Account Types

There are 7 types of user accounts with different roles and permissions:
 
1. **Super Admin** - Has complete system control
2. **Admin** - School-level administrator
3. **Teacher** - Manages classes and grades
4. **Student** - Access to personal academic information
5. **Parent** - Views child's academic progress
6. **Librarian** - Manages library resources
7. **Accountant** - Handles financial matters

## Detailed Module Descriptions

### 1. Academic Management
- **Class Management**
  - Create and manage class sections
  - Assign teachers to classes
  - Set class capacity and schedules
  - Track class attendance

- **Subject Management**
  - Create and update subjects
  - Assign teachers to subjects
  - Set subject requirements
  - Manage subject materials

- **Examination System**
  - Create exam schedules
  - Record and manage grades
  - Generate report cards
  - Print marksheets and tabulation sheets
  - Track student performance

### 2. Student Management
- **Student Records**
  - Maintain comprehensive student profiles
  - Track academic progress
  - Manage attendance records
  - Handle admissions and transfers

- **Student Promotion**
  - Promote students to next class
  - Generate promotion lists
  - Track academic history
  - Handle class transfers

### 3. Staff Management
- **Teacher Management**
  - Maintain teacher profiles
  - Track teaching assignments
  - Manage teacher attendance
  - Handle leave requests

- **Staff Records**
  - Manage staff information
  - Track staff attendance
  - Process leave applications
  - Handle staff evaluations

### 4. Financial Management
- **Fee Management**
  - Set up fee structures
  - Generate fee invoices
  - Track payments
  - Handle fee defaulters

- **Expense Tracking**
  - Record school expenses
  - Generate expense reports
  - Manage budgets
  - Track financial transactions

### 5. Library Management
- **Book Management**
  - Catalog books and resources
  - Track book circulation
  - Manage book returns
  - Handle book reservations

- **Library Operations**
  - Issue books to students
  - Track due dates
  - Generate overdue notices
  - Maintain library inventory

### 6. Transportation
- **Vehicle Management**
  - Manage school vehicles
  - Track vehicle maintenance
  - Schedule vehicle usage
  - Monitor fuel consumption

- **Route Management**
  - Create transport routes
  - Assign vehicles to routes
  - Track student transport
  - Monitor bus attendance

### 7. School Information Center
- **Visiting Schedule**
  - Manage school visiting hours
  - Track visitor appointments
  - Handle parent meetings
  - Record visitor information

- **Feeding Timetable**
  - Create meal schedules
  - Plan school menus
  - Track dietary requirements
  - Monitor food service

### 8. Additional Features
- **Notice Board**
  - Post school announcements
  - Share important updates
  - Manage event calendar
  - Send notifications

- **Reports Generation**
  - Generate academic reports
  - Create financial statements
  - Produce attendance reports
  - Export system data

- **System Settings**
  - Configure school details
  - Manage user permissions
  - Set academic calendar
  - Customize system options

## Technical Requirements 

Check Laravel 8 Requirements https://laravel.com/docs/8.x

## Installation
- Install dependencies (composer install)
- Set Database Credentials & App Settings in dotenv file (.env)
- Migrate Database (php artisan migrate)
- Database seed (php artisan db:seed)

## Login Credentials
After seeding, use the following demo accounts to log in:

| Account Type  | Name           | Username   | Email                      | Password |
| ------------- | -------------- | ---------- | -------------------------- | -------- |
| Super Admin   | Super Admin    | cj         | cj@cj.com                  | cj       |
| Admin         | Demo Admin     | admin      | admin@demo.school.com      | demo123  |
| Teacher       | Demo Teacher   | teacher    | teacher@demo.school.com    | demo123  |
| Parent        | Demo Parent    | parent     | parent@demo.school.com     | demo123  |
| Accountant    | Demo Accountant| accountant | accountant@demo.school.com | demo123  |
| Student       | Demo Student   | student    | student@demo.school.com    | demo123  |

> **Note:** All demo users except Super Admin use the password `demo123`. The Super Admin uses the password `cj`.

## User Role Functions

### Super Admin
- Complete system control
- Delete any record
- Create any user account
- Manage multiple schools
- Configure system settings

### Administrators (Super Admin & Admin)
- Manage students class/sections
- View marksheet of students
- Create, Edit and manage all user accounts & profiles
- Create, Edit and manage Exams & Grades
- Create, Edit and manage Subjects
- Manage noticeboard of school
- Notices are visible in calendar in dashboard
- Edit system settings
- Manage Payments & fees

### Accountant
- Manage Payments & fees
- Print Payment Receipts
- Track expenses
- Generate financial reports

### Librarian
- Manage Books in the Library
- Track book circulation
- Handle student book requests
- Maintain library inventory

### Teacher
- Manage Own Class/Section
- Manage Exam Records for own Subjects
- Manage Timetable if Assigned as Class Teacher
- Manage own profile
- Upload Study Materials
- Track student attendance
- Record grades and marks

### Student
- View teacher profile
- View own class subjects
- View own marks and class timetable
- View Payments
- View library and book status
- View noticeboard and school events in calendar
- Manage own profile
- Track attendance

### Parent
- View teacher profile
- View own child's marksheet (Download/Print PDF)
- View own child's Timetable
- View own child's payments
- View noticeboard and school events in calendar
- Manage own profile
- Track child's attendance

## Contributing

Your Contributions & suggestions are welcomed. Please use Pull Request

## Security Vulnerabilities

If you discover a security vulnerability within LAV_SMS, please send an e-mail to CJ Inspired via cjay.pub@gmail.com. All security vulnerabilities will be promptly addressed.

## Work in Progress
Some sections of this project are in the work-in-progress stage and would be updated soon. These include:

- The Noticeboard/Calendar in the Dashboard Area
- Librarian/Accountant user pages
- Library Resources/Study Materials Upload for Students

## Contact
**CJ INSPIRED**
- Phone : +250785530789
