<?php


//Auth::routes();

use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\BusAttendanceController;
use App\Http\Controllers\ChildApplicationController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LeaveController;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\PastPaperController;
use App\Http\Controllers\PayrollController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ResourceController;
use App\Http\Controllers\RoutingController;
use App\Http\Controllers\SchoolController;
use App\Http\Controllers\SchoolImportController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\StudentRoutingController;
use App\Http\Controllers\StudentTransportController;
use App\Http\Controllers\SuperAdmin\SettingController;
use App\Http\Controllers\SupportTeam\StudentRecordController;
use App\Http\Controllers\VehicleController;



//Route::get('/test', 'TestController@index')->name('test');
Route::get('/privacy-policy', [HomeController::class, 'privacy_policy'])->name('privacy_policy');
Route::get('/terms-of-use', [HomeController::class, 'terms_of_use'])->name('terms_of_use');


Route::group(['middleware' => 'auth'], function () {
    Route::get('/home', [HomeController::class, 'dashboard'])->name('home');
    Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('dashboard');


    Route::group(['prefix' => 'my_account'], function() {
        Route::get('/', 'MyAccountController@edit_profile')->name('my_account');
        Route::put('/', 'MyAccountController@update_profile')->name('my_account.update');
        Route::put('/change_password', 'MyAccountController@change_pass')->name('my_account.change_pass');
    });

    /*************** Support Team *****************/
    Route::group(['namespace' => 'SupportTeam',], function(){

        /*************** Students *****************/
        Route::group(['prefix' => 'students'], function(){
            Route::get('reset_pass/{st_id}', 'StudentRecordController@reset_pass')->name('st.reset_pass');
            Route::get('graduated', 'StudentRecordController@graduated')->name('students.graduated');
            Route::put('not_graduated/{id}', 'StudentRecordController@not_graduated')->name('st.not_graduated');
            Route::get('list/{class_id}', 'StudentRecordController@listByClass')->name('students.list')->middleware('teamSAT');

            /* Promotions */
            Route::post('promote_selector', 'PromotionController@selector')->name('students.promote_selector');
            Route::get('promotion/manage', 'PromotionController@manage')->name('students.promotion_manage');
            Route::delete('promotion/reset/{pid}', 'PromotionController@reset')->name('students.promotion_reset');
            Route::delete('promotion/reset_all', 'PromotionController@reset_all')->name('students.promotion_reset_all');
            Route::get('promotion/{fc?}/{fs?}/{tc?}/{ts?}', 'PromotionController@promotion')->name('students.promotion');
            Route::post('promote/{fc}/{fs}/{tc}/{ts}', 'PromotionController@promote')->name('students.promote');

        });

        /*************** Users *****************/
        Route::group(['prefix' => 'users'], function(){
            Route::get('reset_pass/{id}', 'UserController@reset_pass')->name('users.reset_pass');
        });

        /*************** TimeTables *****************/
        Route::group(['prefix' => 'timetables'], function(){
            Route::get('/', 'TimeTableController@index')->name('tt.index');

            Route::group(['middleware' => 'teamSA'], function() {
                Route::post('/', 'TimeTableController@store')->name('tt.store');
                Route::put('/{tt}', 'TimeTableController@update')->name('tt.update');
                Route::delete('/{tt}', 'TimeTableController@delete')->name('tt.delete');
            });

            /*************** TimeTable Records *****************/
            Route::group(['prefix' => 'records'], function(){

                Route::group(['middleware' => 'teamSA'], function(){
                    Route::get('manage/{ttr}', 'TimeTableController@manage')->name('ttr.manage');
                    Route::post('/', 'TimeTableController@store_record')->name('ttr.store');
                    Route::get('edit/{ttr}', 'TimeTableController@edit_record')->name('ttr.edit');
                    Route::put('/{ttr}', 'TimeTableController@update_record')->name('ttr.update');
                });

                Route::get('show/{ttr}', 'TimeTableController@show_record')->name('ttr.show');
                Route::get('print/{ttr}', 'TimeTableController@print_record')->name('ttr.print');
                Route::delete('/{ttr}', 'TimeTableController@delete_record')->name('ttr.destroy');

            });

            /*************** Time Slots *****************/
            Route::group(['prefix' => 'time_slots', 'middleware' => 'teamSA'], function(){
                Route::post('/', 'TimeTableController@store_time_slot')->name('ts.store');
                Route::post('/use/{ttr}', 'TimeTableController@use_time_slot')->name('ts.use');
                Route::get('edit/{ts}', 'TimeTableController@edit_time_slot')->name('ts.edit');
                Route::delete('/{ts}', 'TimeTableController@delete_time_slot')->name('ts.destroy');
                Route::put('/{ts}', 'TimeTableController@update_time_slot')->name('ts.update');
            });

        });

        /*************** Payments *****************/
        Route::group(['prefix' => 'payments'], function(){

            Route::get('manage/{class_id?}', 'PaymentController@manage')->name('payments.manage');
            Route::get('invoice/{id}/{year?}', 'PaymentController@invoice')->name('payments.invoice');
            Route::get('receipts/{id}', 'PaymentController@receipts')->name('payments.receipts');
            Route::get('pdf_receipts/{id}', 'PaymentController@pdf_receipts')->name('payments.pdf_receipts');
            Route::post('select_year', 'PaymentController@select_year')->name('payments.select_year');
            Route::post('select_class', 'PaymentController@select_class')->name('payments.select_class');
            Route::delete('reset_record/{id}', 'PaymentController@reset_record')->name('payments.reset_record');
            Route::post('pay_now/{id}', 'PaymentController@pay_now')->name('payments.pay_now');
        });

        /*************** Pins *****************/
        Route::group(['prefix' => 'pins'], function(){
            Route::get('create', 'PinController@create')->name('pins.create');
            Route::get('/', 'PinController@index')->name('pins.index');
            Route::post('/', 'PinController@store')->name('pins.store');
            Route::get('enter/{id}', 'PinController@enter_pin')->name('pins.enter');
            Route::post('verify/{id}', 'PinController@verify')->name('pins.verify');
            Route::delete('/', 'PinController@destroy')->name('pins.destroy');
        });

        /*************** Marks *****************/
        Route::group(['prefix' => 'marks'], function(){

           // FOR teamSA
            Route::group(['middleware' => 'teamSA'], function(){
                Route::get('batch_fix', 'MarkController@batch_fix')->name('marks.batch_fix');
                Route::put('batch_update', 'MarkController@batch_update')->name('marks.batch_update');
                Route::get('tabulation/{exam?}/{class?}/{sec_id?}', 'MarkController@tabulation')->name('marks.tabulation');
                Route::post('tabulation', 'MarkController@tabulation_select')->name('marks.tabulation_select');
                Route::get('tabulation/print/{exam}/{class}/{sec_id}', 'MarkController@print_tabulation')->name('marks.print_tabulation');
            });

            // FOR teamSAT
            Route::group(['middleware' => 'teamSAT'], function(){
                Route::get('/', 'MarkController@index')->name('marks.index');
                Route::get('manage/{exam}/{class}/{section}/{subject}', 'MarkController@manage')->name('marks.manage');
                Route::put('update/{exam}/{class}/{section}/{subject}', 'MarkController@update')->name('marks.update');
                Route::put('comment_update/{exr_id}', 'MarkController@comment_update')->name('marks.comment_update');
                Route::put('skills_update/{skill}/{exr_id}', 'MarkController@skills_update')->name('marks.skills_update');
                Route::post('selector', 'MarkController@selector')->name('marks.selector');
                Route::get('bulk/{class?}/{section?}', 'MarkController@bulk')->name('marks.bulk');
                Route::post('bulk', 'MarkController@bulk_select')->name('marks.bulk_select');
            });

            Route::get('select_year/{id}', 'MarkController@year_selector')->name('marks.year_selector');
            Route::post('select_year/{id}', 'MarkController@year_selected')->name('marks.year_select');
            Route::get('show/{id}/{year}', 'MarkController@show')->name('marks.show');
            Route::get('print/{id}/{exam_id}/{year}', 'MarkController@print_view')->name('marks.print');

        });

        Route::resource('students', 'StudentRecordController');

        Route::post('/admit', [StudentController::class, 'registerStudent'])->name('admit.student');
        
        Route::resource('users', 'UserController');
        Route::resource('classes', 'MyClassController');
        Route::resource('sections', 'SectionController');
        Route::resource('subjects', 'SubjectController');
        Route::resource('grades', 'GradeController');
        Route::resource('exams', 'ExamController');
        Route::resource('dorms', 'DormController');
        Route::resource('payments', 'PaymentController');

    });

    /************************ AJAX ****************************/
    Route::group(['prefix' => 'ajax'], function() {
        Route::get('get_lga/{state_id}', 'AjaxController@get_lga')->name('get_lga');
        Route::get('get_class_sections/{class_id}', 'AjaxController@get_class_sections')->name('get_class_sections');
        Route::get('get_class_subjects/{class_id}', 'AjaxController@get_class_subjects')->name('get_class_subjects');
    });

});

/************************ SUPER ADMIN ****************************/
Route::group(['namespace' => 'SuperAdmin','middleware' => 'super_admin', 'prefix' => 'super_admin'], function(){

    Route::get('/settings', 'SettingController@index')->name('settings');
    Route::put('/settings', 'SettingController@update')->name('settings.update');

});



Route::get('/test', [SettingController::class, 'test'])->name('settings.test'); // For the main page
Route::post('/settings/assign', [SettingController::class, 'assignSetting'])->name('super_admin.assign_setting'); // For assigning settings
Route::get('/settings/{id}/edit', [SettingController::class, 'edit'])->name('settings.edit'); // For editing a setting
Route::delete('/settings/{id}', [SettingController::class, 'destroy'])->name('settings.destroy'); // For deleting a setting


Route::get('/school', [SchoolController::class, 'index'])->name('school.index'); // For the main page
Route::post('/school/store', [SchoolController::class, 'store'])->name('school.store'); // For the main page
Route::get('/school/edit', [SchoolController::class, 'edit'])->name('school.edit'); // For the main page
Route::get('/school/{id}', [SchoolController::class, 'update'])->name('school.update'); // For the main page
Route::delete('/school{id}', [SchoolController::class, 'destroy'])->name('school.destroy'); // For the main page






// Route::get('/settings', [SettingController::class, 'index'])->name('settings.index'); // For the main page
// Route::post('/settings/assign', [SettingController::class, 'assignSetting'])->name('super_admin.assign_setting'); // For assigning settings
// Route::get('/settings/{id}/edit', [SettingController::class, 'edit'])->name('settings.edit'); // For editing a setting
// Route::delete('/settings/{id}', [SettingController::class, 'destroy'])->name('settings.destroy'); // For deleting a setting









/************************ PARENT ****************************/
Route::group(['namespace' => 'MyParent','middleware' => 'my_parent',], function(){

    Route::get('/my_children', 'MyController@children')->name('my_children');

});



Route::get('/locations',[StudentRecordController::class, 'create']);
Route::get('/locations/districts',[StudentRecordController::class,'fetchDistricts']);
Route::get('/locations/sectors',[StudentRecordController::class,'fetchSectors']);
Route::get('/locations/cells',[StudentRecordController::class,'fetchCells']);
Route::get('/locations/villages',[StudentRecordController::class,'fetchVillages']);



Route::get('/attendance/{sectionId?}', [AttendanceController::class, 'index'])->name('attendance.index');
Route::post('/attendance', [AttendanceController::class, 'store'])->name('attendance.store');


 // Route for updating the permission status (approve/reject)
Route::put('/permissions/{permission}', [PermissionController::class, 'updatePermissionStatus'])->name('permissions.update');

// Route for showing permissions (index page)
Route::get('/permissions', [PermissionController::class, 'index'])->name('permissions.index');

// Route for requesting permission
Route::post('/permissions/{student_id}', [PermissionController::class, 'requestPermission'])->name('permissions.request');

Route::get('/parent/permissions', [PermissionController::class, 'childPermissions'])->name('parent.permissions');



Route::get('books', [BookController::class, 'index'])->name('books.index');
Route::get('books/search', [BookController::class, 'search'])->name('books.search');

Route::get('loans', [LoanController::class, 'index'])->name('loans.index');;;
Route::post('loans/borrow', [LoanController::class, 'borrow'])->name('loans.borrow');
Route::post('loans/{id}/return', [LoanController::class, 'return']);

Route::get('resources', [ResourceController::class, 'index'])->name('ressource.index');
Route::post('resources/upload', [ResourceController::class, 'upload'])->name('ressource.upload');

Route::get('past-papers', [PastPaperController::class, 'index'])->name('past_papers.index');

Route::resource('past_papers', 'PastPaperController');

// // Display a list of all books
// Route::get('/books', [BookController::class, 'index'])->name('books.index');

// // Show the form to create a new book
// Route::get('/books/create', [BookController::class, 'create'])->name('books.create');

// // Show the form to edit an existing book
// Route::get('books/edit/{id}', [BookController::class, 'editBook'])->name('books.edit');

// // Store a new book in the database
// Route::post('/books', [BookController::class, 'store'])->name('books.store');

// // Update the details of an existing book
// Route::put('/books/{id}', [BookController::class, 'update'])->name('books.update');

// // Delete a book from the inventory
// Route::delete('books/{id}', [BookController::class, 'destroy'])->name('books.destroy');


Route::resource('books', 'BookController');

Route::middleware(['auth'])->group(function () {
    Route::resource('expenses', 'ExpenseController');
    Route::put('expenses/{expense}/approve', [ExpenseController::class, 'approve'])->name('expenses.approve');
    Route::put('expenses/{expense}/reject', [ExpenseController::class, 'reject'])->name('expenses.reject');
});

// Route::put('expenses/approve/{id}', 'ExpenseController@approve')->name('expenses.approve');
// Route::put('expenses/reject/{id}', 'ExpenseController@reject')->name('expenses.reject');

// Route::put('/approve/{id}', [ExpenseController::class, 'approve'])->name('expenses.approve');
// Route::put('/reject/{id}', [ExpenseController::class, 'reject'])->name('expenses.reject');



Route::get('/leaves', [LeaveController::class, 'index'])->name('leaves.index');
Route::post('/leaves', [LeaveController::class, 'store'])->name('leaves.store');
Route::put('/leaves/{leave}/approve', [LeaveController::class, 'approve'])->name('leaves.approve');
Route::put('/leaves/{leave}/reject', [LeaveController::class, 'reject'])->name('leaves.reject');


Route::get('/payrolls', [PayrollController::class, 'index'])->name('payrolls.index');
Route::post('/payrolls', [PayrollController::class, 'store'])->name('payrolls.store');
Route::delete('/payrolls/{id}', [PayrollController::class, 'delete'])->name('payrolls.delete');


Route::prefix('vehicles')->group(function () {
    Route::get('/', [VehicleController::class, 'index'])->name('vehicles.index'); // List all vehicles
    Route::get('/create', [VehicleController::class, 'create'])->name('vehicles.create'); // Show form to add a new vehicle
    Route::post('/', [VehicleController::class, 'store'])->name('vehicles.store'); // Store new vehicle
    Route::get('/{id}/edit', [VehicleController::class, 'edit'])->name('vehicles.edit'); // Show form to edit a vehicle
    Route::put('/{id}', [VehicleController::class, 'update'])->name('vehicles.update'); // Update vehicle details
    Route::delete('/{id}', [VehicleController::class, 'destroy'])->name('vehicles.destroy'); // Delete a vehicle
});
// Student  Routing

    Route::get('/', [RoutingController::class, 'index'])->name('routes.index'); // View routes
    Route::get('/create', [RoutingController::class, 'create'])->name('routes.create'); // Add a route
    Route::post('/', [RoutingController::class, 'store'])->name('routes.store'); // Save a new route
    Route::get('/{id}/edit', [RoutingController::class, 'edit'])->name('routes.edit'); // Edit a route
    Route::put('/{id}', [RoutingController::class, 'update'])->name('routes.update'); // Update route
    Route::delete('/{id}', [RoutingController::class, 'destroy'])->name('routes.destroy'); // Delete a route

    Route::resource('student_transports', 'StudentTransportController');

Route::resource('bus_attendance', 'BusAttendanceController');

Route::get('/', [LoginController::class, 'showLoginForm']);

// routes/web.php

Route::get('/single/{school}', [SchoolController::class, 'show'])->name('school.show');
Route::get('/districts/{province}/{district}', [SchoolController::class, 'showByDistrict'])->name('districts.show');
Route::get('schools/import', [SchoolImportController::class, 'showImportForm'])->name('school.import.form');
Route::post('schools/import', [SchoolImportController::class, 'import'])->name('school.import');


Route::get('/get-districts/{province}', function ($province) {
    $districts = DB::table('schools')
        ->select('district')
        ->where('province', $province)
        ->distinct()
        ->get();

    return response()->json(['districts' => $districts->pluck('district')]);
});

Route::get('/get-schools/{province}/{district}', function ($province, $district) {
    $schools = DB::table('schools')
        ->where('province', $province)
        ->where('district', $district)
        ->get();

    return response()->json(['schools' => $schools]);
});


Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');



Route::get('/reset-password', [LoginController::class, 'login'])->name('password.request');

    Route::resource('student_transports', 'StudentTransportController');


Route::resource('bus_attendance', 'BusAttendanceController');

Route::resource('routes', 'RoutingController');


Route::resource('child-applications', 'ChildApplicationController');







// // Safety Management
// Route::prefix('safety')->group(function () {
//     Route::get('/', [SafetyController::class, 'index'])->name('safety.index'); // View safety records
//     Route::post('/', [SafetyController::class, 'store'])->name('safety.store'); // Add safety report
//     Route::get('/{id}', [SafetyController::class, 'show'])->name('safety.show'); // View detailed safety report
// });

// // Route Optimization
// Route::prefix('optimization')->group(function () {
//     Route::get('/', [RouteOptimizationController::class, 'index'])->name('optimization.index'); // View optimized routes
//     Route::post('/process', [RouteOptimizationController::class, 'process'])->name('optimization.process'); // Process optimization
// });


// //Vehicle Tracking Management
// Route::prefix('tracking')->group(function () {
//     Route::get('/', [VehicleTrackingController::class, 'index'])->name('tracking.index'); // View tracked vehicles
//     Route::post('/update', [VehicleTrackingController::class, 'update'])->name('tracking.update'); // Update tracking data
// });









