<?php

use App\Models\Application;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\TaskController;
use App\Http\Controllers\Admin\AdminController;

use App\Http\Controllers\Admin\CacheController;

use App\Http\Controllers\Agent\AgentController;
use App\Http\Controllers\Admin\IntakeController;
// use App\Http\Controllers\Agent\AuthenticatedSessionController;
use App\Http\Controllers\Filters\AllfiltersItem;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Admin\AdminUserController;

use App\Http\Controllers\Admin\ProgramTagController;
use App\Http\Controllers\Admin\UniversityController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\Student\StudentApplication;
use App\Http\Controllers\Admin\DestinationController;
use App\Http\Controllers\Admin\IntakeMonthController;
use App\Http\Controllers\Admin\TransactionController;
use App\Http\Controllers\Agent\ApplicationController;
use App\Http\Controllers\Agent\AgentEmployeController;
use App\Http\Controllers\Agent\AgentStudentController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Student\StudentProfileController;
use App\Http\Controllers\Admin\AdminNotificationController;
use App\Http\Controllers\Admin\UniversityProgramController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;

//  Route::post('/university', [UniversityController::class, 'store']);

// Student  ApI

Route::middleware('guest')->group(function () {
    // Register
    Route::post('register', [RegisteredUserController::class, 'store']);

    // Login
    Route::post('login', [AuthenticatedSessionController::class, 'store']);

    // Forgot Password
    Route::post('forgot-password', [PasswordResetLinkController::class, 'store']);

    // Reset Password
    Route::post('reset-password', [NewPasswordController::class, 'store']);
});


Route::middleware('auth:sanctum')->group(function () {
    // Logout
    Route::post('logout', [AuthenticatedSessionController::class, 'destroy']);

    // Email Verification
    Route::get('verify-email', [EmailVerificationPromptController::class, '__invoke']);
    Route::get('verify-email/{id}/{hash}', [VerifyEmailController::class, '__invoke'])
        ->middleware(['signed', 'throttle:6,1'])
        ->name('verification.verify');
    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
        ->middleware('throttle:6,1')
        ->name('verification.send');

    // Confirm Password
    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

    // Update Password
    Route::put('password', [PasswordController::class, 'update'])->name('password.update');
    Route::get('/student/profile/edit', [StudentProfileController::class, 'edit']);
    Route::post('/student/profile/update', [StudentProfileController::class, 'update']);
    // std application
    Route::post('/student/applications', [StudentApplication::class, 'application']);
    Route::get('/student/my-applications', [StudentApplication::class, 'myApplications']);
    
    Route::get('/student/application/{id}', [StudentApplication::class, 'show']);

    


});

//Agent API
Route::middleware(['agent', 'agent.approved'])->prefix('agent')->group(function () {
    Route::get('dashboard', [AgentController::class, 'dashboard'])->name('agent.dashboard');
    Route::get('logout', [AgentController::class, 'logout'])->name('agent.logout');
});


// Route::prefix('agents')->group(function () {
//     Route::post('/login', [App\Http\Controllers\Agent\AuthenticatedSessionController::class, 'store']);
//     Route::post('/register', [AgentController::class, 'store']);
// });

// Route::middleware('guest:agent')->group(function () {

//     Route::post('/agent/forget_password_submit',[AgentController::class,'forget_password_submit'])->name('agent.forget_password_submit');
//     Route::get('/agent/reset_password/{token}/{email}', [AgentController::class, 'reset_password'])->name('agent.reset_password');
//     Route::post('/agent/reset_password_submit',[AgentController::class,'reset_password_submit'])->name('agent.reset_password_submit');

//LAST UPDATE 2025


// });
// Route::middleware('guest:agent')->group(function () {
//     Route::post('/agents/register', [AgentController::class, 'store']);
//     Route::post('agent/login', [App\Http\Controllers\Agent\AuthenticatedSessionController::class, 'store']);
//     Route::get('/agent/reset_password/{token}/{email}', [AgentController::class, 'reset_password'])->name('agent.reset_password');
//     Route::post('agent/forget_password_submit', [AgentController::class, 'forget_password_submit']);
//     Route::post('agent/reset_password_submit', [AgentController::class, 'reset_password_submit']);

//     Route::get('/agent/profile', [AgentController::class, 'profile'])->name('agent.profile');

//     Route::get('all/agent-student', [AgentStudentController::class, 'index'])->name('agent.student.all');
//     Route::post('agent-student/register', [AgentStudentController::class, 'store'])->name('agent.student.create');
//     Route::get('agent-student/edit/{id}', [AgentStudentController::class, 'edit'])->name('agent.student.edit');
//     Route::post('agent-student/update/{id}', [AgentStudentController::class, 'update'])->name('agent.student.update');
//     Route::delete('agent-student/delete/{id}', [AgentStudentController::class, 'destroy'])->name('agent.student.delete');
//     //Applications
//      Route::get('student/info/{student_id}', [ApplicationController::class, 'StudentInfo'])
//         ->name('student.info');

//     // Route::post('create/applications/{student_id}/{program_id}', 
//     //     [ApplicationController::class, 'createApplications']
//     // )->name('create.application');
// });

Route::prefix('agent')->middleware('guest:agent')->group(function () {
    Route::post('register', [AgentController::class, 'store']);
    Route::post('login', [App\Http\Controllers\Agent\AuthenticatedSessionController::class, 'store']);

     Route::post('employee/create', [AgentEmployeController::class, 'createEmployee']);
    Route::get('employees', [AgentEmployeController::class, 'allEmployees']);

    // Employee login (different model)
    Route::post('employee/login', [AgentEmployeController::class, 'login']);

    Route::get('reset_password/{token}/{email}', [AgentController::class, 'reset_password'])->name('agent.reset_password');
    Route::post('forget_password_submit', [AgentController::class, 'forget_password_submit']);
    Route::post('reset_password_submit', [AgentController::class, 'reset_password_submit']);

    Route::get('profile', [AgentController::class, 'profile'])->name('agent.profile');

    Route::get('all/agent-student', [AgentStudentController::class, 'index'])->name('agent.student.all');
    Route::post('agent-student/register', [AgentStudentController::class, 'store'])->name('agent.student.create');
    Route::get('agentByreg', [AgentStudentController::class, 'agentByreg'])->name('agentbyreg');
    Route::get('agent-student/edit/{id}', [AgentStudentController::class, 'edit'])->name('agent.student.edit');
    Route::post('agent-student/update/{id}', [AgentStudentController::class, 'update'])->name('agent.student.update');
    Route::delete('agent-student/delete/{id}', [AgentStudentController::class, 'destroy'])->name('agent.student.delete');

    // Application
    Route::get('student/info/{student_id}/{program_id}', [ApplicationController::class, 'StudentInfo'])->name('student.info');
    Route::post('my-applications', [ApplicationController::class, 'myApplications']);


    Route::get('applications/{id}', [ApplicationController::class, 'edit']);      // Edit (get single)
    Route::put('applications/{id}', [ApplicationController::class, 'update']);    // Update
    Route::delete('applications/{id}', [ApplicationController::class, 'destroy']); // Delete
    Route::get('my-applications', [ApplicationController::class, 'getMyApplications']);//all aplication
    Route::get('applications/{id}/detail', [ApplicationController::class, 'applicationDetail']);
    Route::post('/applications/{id}', [ApplicationController::class, 'applicationUpdate']);

    // Task
    Route::get('tasks', [TaskController::class, 'agentTasks']);
    Route::post('tasks/{task}/update', [TaskController::class, 'agentUpdateTask']);

    // Commitions
     Route::get('transactions', [TransactionController::class, 'myTransactions']);




});

Route::prefix('admin')->group(function () {
    Route::post('/login', [AdminController::class, 'login_submit'])->name('admin.login');
    Route::post('/forget_password', [AdminController::class, 'forget_password_submit'])->name('admin.forget_password');
    Route::post('/reset_password_submit', [AdminController::class, 'reset_password_submit'])->name('admin.reset_password_submit');
    Route::get('/approve-agent/{id}', [AdminController::class, 'approveAgent'])->name('admin.approve.agent');
    Route::get('activate-agent/{id}', [AdminController::class, 'activateAgent'])->name('admin.activate.agent');
    Route::get('/deactivate-agent/{id}', [AdminController::class, 'deactivateAgent'])->name('admin.deactivate.agent');
    Route::get('/all-user', [AdminController::class, 'alluser'])->name('admin.all.user');
    Route::get('all/students', [AdminController::class, 'index']);
    Route::get('students/detail/{id}', [AdminController::class, 'detail']);
    Route::get('/alluniversities', [UniversityController::class, 'alluniversitie'])->name('university.alluniversities');
    // Route::get('/universities/destination', [UniversityController::class, 'destination'])->name('university.destinations'); 
    // check
    Route::get('notification/{id}/application', [AdminNotificationController::class, 'getApplicationFromNotification']);

    Route::get('notifications', [AdminNotificationController::class, 'index']);
    Route::get('notifications/unread', [AdminNotificationController::class, 'unread']);
    // routes/api.php
    Route::get('/notifications/latest', [AdminNotificationController::class, 'latest']);

    //update

    // New mark as read routes notifications
    Route::post('notifications/{id}/mark-read', [AdminNotificationController::class, 'markAsRead']);
    Route::post('notifications/mark-all-read', [AdminNotificationController::class, 'markAllAsRead']);

    // Admin User
    Route::post('/admin-user/login', [AdminUserController::class, 'login']);
    // Protected: Sub-User create
    Route::middleware('auth:sanctum')->post('/admin-user', [AdminUserController::class, 'createSubUser']);

});

Route::get('/search-universities', [AllfiltersItem::class, 'search']);
Route::post('/programs/filter', [AllfiltersItem::class, 'allFilters'])
    ->name('programs.filter');
//Destination Filter Sections
Route::get('/all/destination/filter', [AllfiltersItem::class, 'alldestinationfilter'])->name('alldestinationfilter');
Route::get('/destinations/{destination_id}/universities', [AllfiltersItem::class, 'destinationfilter'])->name('destinations.universities');

//University Filter Section
Route::get('/all/university/filter', [AllfiltersItem::class, 'alluniversityfilter'])->name('alluniversityfilter');
Route::get('/university/{university_id}/programs', [AllfiltersItem::class, 'programsfilter'])->name('programs.universities');

//Program Lavel Filter
Route::get('/all/program/level/filter', [AllfiltersItem::class, 'allprogramlevelfilter'])->name('allprogramlevelfilter');
Route::get('program/level/{program_level_id}/filter', [AllfiltersItem::class, 'programlevelfilter'])->name('programlevelfilter');

//Study Field Filter
Route::get('/all/study/field/filter', [AllfiltersItem::class, 'allstudyfieldfilter'])->name('allstudyfieldfilter');
Route::get('study/field/{field_of_study_id}/filter', [AllfiltersItem::class, 'studyfieldfilter'])->name('studyfieldfilter');

// All Intakes Filter
Route::get('/all/intakes/filter', [AllfiltersItem::class, 'allintakesfilter'])->name('all.intakes.filter');
Route::get('intakes/{intake_id}/filter', [AllfiltersItem::class, 'intakesfilter'])->name('intakes.filter');
Route::get('/all/intake/month/filter', [AllfiltersItem::class, 'allintakemonthfilter'])->name('all.intake.month.filter');
Route::get('intake/{month_id}/filter', [AllfiltersItem::class, 'intakemonthfilter'])->name('intake.month.filter');

//Program Tag Filter
Route::get('/all/program/tag/filter', [AllfiltersItem::class, 'allprogramtagfilter'])->name('all.program.tag.filter');
Route::get('/program/{program_tag_id}/filter', [AllfiltersItem::class, 'programtagfilter'])->name('program.tag.filter');

//agent student profile filter
// routes/api.php
Route::post('/agent-student/matched-programs', [AllfiltersItem::class, 'matchPrograms']);



// Public admin login route
// Route::post('/admin/login', [AdminController::class, 'login_submit'])->name('admin.api.login');
//University Program get 
Route::get('/university-programs', [UniversityProgramController::class, 'index'])->name('admin.university-programs.index');
Route::get('/universities/details/{id}', [UniversityController::class, 'universitydetails'])->name('university.details'); // delete
Route::get('/university-programs/details/{id}', [UniversityProgramController::class, 'programdetails'])->name('university.programs.details');
Route::get('/university/{university_id}/programs',[UniversityProgramController::class, 'getByUniversity']);
Route::get('/university/{program_id}/related',[UniversityProgramController::class, 'showWithRelated']);
Route::get('/cache-clear', [CacheController::class, 'clear']);


// ✅ Protected admin routes with Sanctum middleware & admin_token guard
// Route::middleware('auth:sanctum')->prefix('admin')->group(function () {
//     Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
//     Route::post('/logout', [AdminController::class, 'logout'])->name('admin.logout');

//     // University create route
//     // Route::get('/university/edit', [UniversityController::class, 'edit']);
//     Route::get('/university-destination ', [UniversityController::class, 'universitydestination'])->name('university.destination');
//     Route::get('/alluniversities ', [UniversityController::class, 'alluniversitie'])->name('university.alluniversities');
//     Route::post('/universities/create/{destination_id}', [UniversityController::class, 'store'])->name('university.store')->middleware('permission:university.create');       // create
//     Route::get('/universities/edit/{id}', [UniversityController::class, 'edit'])->name('university.edit')->middleware('permission:university.edit');    // single
//     Route::post('/universities/update/{id}/{destination_id}', [UniversityController::class, 'update'])->name('university.update')->middleware('permission:university.update');  // update
//     Route::delete('/universities/{id}', [UniversityController::class, 'destroy'])->name('university.destroy')->middleware('permission:university.delete'); // delete


//     // single
//     // Destination
//     Route::resource('destinations', DestinationController::class);
//     Route::post('/university-programs/{university_id}/{program_level_id}/{field_of_studies_id}/{intake_id}/{intake_month_id}/{program_tag_id}/store', [UniversityProgramController::class, 'store'])->name('admin.university-programs.store');
//     // In routes/api.php
//     Route::get('/university-programs/{id}/edit', [UniversityProgramController::class, 'edit']);
//     Route::put('/universities/{id}/{university_id}/{program_level_id}/{field_of_studies_id}/{intake_id}/{intake_month_id}/{program_tag_id}/update', [UniversityProgramController::class, 'update']);
//     // Route::put('/universities/{university_id}/programs/{id}/update', [UniversityProgramController::class, 'update']);
//     Route::delete('/universities/{university_id}/programs/{id}', [UniversityProgramController::class, 'destroy']);




//     //Filters Items Program Lavel
//     Route::post('/program/level/store', [AllfiltersItem::class, 'Programlevel'])->name('program.lavel');
//     Route::get('/program/level/{id}/edit', [AllfiltersItem::class, 'Programleveledit'])->name('programlavel.edit');
//     Route::put('/program/level/{id}/update', [AllfiltersItem::class, 'Programlevelupdate'])->name('programlavel.update');
//     Route::delete('program/level/{id}/delete', [AllfiltersItem::class, 'Programleveldestroy'])->name('programlavel.destroy');
//     Route::get('all/program/level', [AllfiltersItem::class, 'AllProgramlevel'])->name('allprogram.lavel');

//     //Filters Items Field Of Study
//     Route::post('field/of/study/store', [AllfiltersItem::class, 'FieldOfstudy'])->name('field.study');
//     Route::get('field/of/study/{id}/edit', [AllfiltersItem::class, 'FieldOfstudyedit'])->name('field.edit');
//     Route::put('field/of/study/{id}/update', [AllfiltersItem::class, 'FieldOfstudyupdate'])->name('field.update');
//     Route::delete('field/of/study/{id}/delete', [AllfiltersItem::class, 'FieldOfstudydelete'])->name('field.delete');
//     Route::get('all/field/of/study/', [AllfiltersItem::class, 'AllFieldOfstudy'])->name('field.all');


//     //Filters Items Field Of Study Of Subject
//     Route::post('field/of/study/{fieldId}/subject/create', [AllfiltersItem::class, 'createSubject'])->name('create.subject');
//     Route::get('subject/{id}/edit', [AllfiltersItem::class, 'editSubject'])->name('edit.subject');
//     Route::put('subject/{id}/update', [AllfiltersItem::class, 'updateSubject'])->name('update.subject');
//     Route::delete('subject/{id}', [AllfiltersItem::class, 'deleteSubject'])->name('delete.subject');

//     //Filter
//     Route::get('field/of/study/{fieldId}/subjects', [AllfiltersItem::class, 'getSubjectsByField'])->name('subject.byfield');
//     Route::get('allsubjects', [AllfiltersItem::class, 'allsubjects'])->name('subject.allsubjects');

//     //  Intakes Month 
//     Route::resource('intakes', IntakeController::class);
//     Route::get('intake/all/month/', [IntakeMonthController::class, 'AllIntakesMonth'])->name('intake.all.month');
//     Route::post('intake/month/create/{intakeid}', [IntakeMonthController::class, 'CreateIntakeMonth'])->name('intakemonth.create');
//     Route::get('intake/month/{id}', [IntakeMonthController::class, 'EditIntakeMonth'])->name('intakeedit.month');
//     Route::put('intake/month/{id}', [IntakeMonthController::class, 'UpdateIntakeMonth'])->name('intakeupdate.month');
//     Route::delete('intake/month/{id}', [IntakeMonthController::class, 'DeleteIntakeMonth'])->name('intakedelete.month');

//     //  Program tag
//     Route::resource('programtag', ProgramTagController::class);

//     Route::get('all/student/profile/', [AdminController::class, 'allstudent']);



//     //Applications
//     // Route::get('applications', [AdminController::class, 'application']);
//       Route::get('agent-applications', [AdminController::class, 'agentApplications']);
//       Route::get('agent-applications/{id}',[AdminController::class, 'agentApplicationDetail']);
//       Route::post('/agent-applications/update/{id}', [AdminController::class, 'agentApplicationUpdate']);

//      // Student Applications
//       Route::get('student-applications', [AdminController::class, 'studentApplications']);
//     //   Route::get('admin/all/agent-student', [AdminController::class, 'allagentstudent']);

//       Route::get('student-applications/{id}',[AdminController::class, 'studentApplicationDetail']);
      
      
//     //   Task

//         Route::get('/tasks', [TaskController::class, 'index']);       // List tasks
//         Route::get('/agent/{agent_id}/all-aplication', [TaskController::class, 'agentByapplication']);       // 2 
//         Route::get('/agent/{student_id}/aplication', [TaskController::class, 'agentStudentapplication']);//3
        

//         Route::get('/program/{program_id}/applications', [TaskController::class, 'programApplications']);//4

//         Route::post('/tasks', [TaskController::class, 'store']);      //5 Create task
//         Route::get('/tasks/{task}/edit', [TaskController::class, 'edit']);
//         Route::post('/tasks/{task}/update', [TaskController::class, 'update']);
//         Route::delete('/tasks/{task}', [TaskController::class, 'destroy']); // Delete task

        

//         //Commiitions

//          Route::get('/transactions', [TransactionController::class, 'index']);
//         // Show single transaction
//         Route::get('/transactions/{id}', [TransactionController::class, 'show']);
//         // Create new transaction
//         Route::post('/transactions', [TransactionController::class, 'store']);
//         // Update a transaction
//         Route::put('/transactions/{id}', [TransactionController::class, 'update']);
//         // Delete a transaction
//         Route::delete('/transactions/{id}', [TransactionController::class, 'destroy']);





    
// });


Route::middleware('auth:sanctum')->prefix('admin')->group(function () {

    // Dashboard & Logout
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::post('/logout', [AdminController::class, 'logout'])->name('admin.logout');

    // ----------------- University -----------------
    Route::get('/university-destination', [UniversityController::class, 'universitydestination'])
        ->name('university.destination')->middleware('permission:university.view');
    Route::get('/alluniversities', [UniversityController::class, 'alluniversitie'])
        ->name('university.alluniversities')->middleware('permission:university.view');
    Route::post('/universities/create/{destination_id}', [UniversityController::class, 'store'])
        ->name('university.store')->middleware('permission:university.create');
    Route::get('/universities/edit/{id}', [UniversityController::class, 'edit'])
        ->name('university.edit')->middleware('permission:university.edit');
    Route::post('/universities/update/{id}/{destination_id}', [UniversityController::class, 'update'])
        ->name('university.update')->middleware('permission:university.update');
    Route::delete('/universities/{id}', [UniversityController::class, 'destroy'])
        ->name('university.destroy')->middleware('permission:university.delete');

    // ----------------- Destination -----------------
    Route::resource('destinations', DestinationController::class)
        ->middleware([
            'index' => 'permission:destination.view',
            'store' => 'permission:destination.create',
            'edit' => 'permission:destination.edit',
            'update' => 'permission:destination.update',
            'destroy' => 'permission:destination.delete',
            'show' => 'permission:destination.view',
        ]);

    // ----------------- University Programs -----------------
    Route::post('/university-programs/{university_id}/{program_level_id}/{field_of_studies_id}/{intake_id}/{intake_month_id}/{program_tag_id}/store', [UniversityProgramController::class, 'store'])
        ->name('admin.university-programs.store')->middleware('permission:program.create');
    Route::get('/university-programs/{id}/edit', [UniversityProgramController::class, 'edit'])
        ->middleware('permission:program.edit');
    Route::put('/universities/{id}/{university_id}/{program_level_id}/{field_of_studies_id}/{intake_id}/{intake_month_id}/{program_tag_id}/update', [UniversityProgramController::class, 'update'])
        ->middleware('permission:program.update');
    Route::delete('/universities/{university_id}/programs/{id}', [UniversityProgramController::class, 'destroy'])
        ->middleware('permission:program.delete');

    // ----------------- Program Level -----------------
    Route::post('/program/level/store', [AllfiltersItem::class, 'Programlevel'])
        ->name('program.lavel')->middleware('permission:program-level.create');
    Route::get('/program/level/{id}/edit', [AllfiltersItem::class, 'Programleveledit'])
        ->name('programlavel.edit')->middleware('permission:program-level.edit');
    Route::put('/program/level/{id}/update', [AllfiltersItem::class, 'Programlevelupdate'])
        ->name('programlavel.update')->middleware('permission:program-level.update');
    Route::delete('program/level/{id}/delete', [AllfiltersItem::class, 'Programleveldestroy'])
        ->name('programlavel.destroy')->middleware('permission:program-level.delete');
    Route::get('all/program/level', [AllfiltersItem::class, 'AllProgramlevel'])
        ->name('allprogram.lavel')->middleware('permission:program-level.view');

    // ----------------- Field of Study -----------------
    Route::post('field/of/study/store', [AllfiltersItem::class, 'FieldOfstudy'])
        ->name('field.study')->middleware('permission:field-of-study.create');
    Route::get('field/of/study/{id}/edit', [AllfiltersItem::class, 'FieldOfstudyedit'])
        ->name('field.edit')->middleware('permission:field-of-study.edit');
    Route::put('field/of/study/{id}/update', [AllfiltersItem::class, 'FieldOfstudyupdate'])
        ->name('field.update')->middleware('permission:field-of-study.update');
    Route::delete('field/of/study/{id}/delete', [AllfiltersItem::class, 'FieldOfstudydelete'])
        ->name('field.delete')->middleware('permission:field-of-study.delete');
    Route::get('all/field/of/study/', [AllfiltersItem::class, 'AllFieldOfstudy'])
        ->name('field.all')->middleware('permission:field-of-study.view');

    // ----------------- Subject -----------------
    Route::post('field/of/study/{fieldId}/subject/create', [AllfiltersItem::class, 'createSubject'])
        ->name('create.subject')->middleware('permission:subject.create');
    Route::get('subject/{id}/edit', [AllfiltersItem::class, 'editSubject'])
        ->name('edit.subject')->middleware('permission:subject.edit');
    Route::put('subject/{id}/update', [AllfiltersItem::class, 'updateSubject'])
        ->name('update.subject')->middleware('permission:subject.update');
    Route::delete('subject/{id}', [AllfiltersItem::class, 'deleteSubject'])
        ->name('delete.subject')->middleware('permission:subject.delete');
    Route::get('field/of/study/{fieldId}/subjects', [AllfiltersItem::class, 'getSubjectsByField'])
        ->name('subject.byfield')->middleware('permission:subject.view');
    Route::get('allsubjects', [AllfiltersItem::class, 'allsubjects'])
        ->name('subject.allsubjects')->middleware('permission:subject.view');

    // ----------------- Intake & Intake Month -----------------
    Route::resource('intakes', IntakeController::class)
        ->middleware([
            'index' => 'permission:intake.view',
            'store' => 'permission:intake.create',
            'edit' => 'permission:intake.edit',
            'update' => 'permission:intake.update',
            'destroy' => 'permission:intake.delete',
            'show' => 'permission:intake.view',
        ]);
    Route::get('intake/all/month/', [IntakeMonthController::class, 'AllIntakesMonth'])
        ->name('intake.all.month')->middleware('permission:intake-month.view');
    Route::post('intake/month/create/{intakeid}', [IntakeMonthController::class, 'CreateIntakeMonth'])
        ->name('intakemonth.create')->middleware('permission:intake-month.create');
    Route::get('intake/month/{id}', [IntakeMonthController::class, 'EditIntakeMonth'])
        ->name('intakeedit.month')->middleware('permission:intake-month.edit');
    Route::put('intake/month/{id}', [IntakeMonthController::class, 'UpdateIntakeMonth'])
        ->name('intakeupdate.month')->middleware('permission:intake-month.update');
    Route::delete('intake/month/{id}', [IntakeMonthController::class, 'DeleteIntakeMonth'])
        ->name('intakedelete.month')->middleware('permission:intake-month.delete');

    // ----------------- Program Tag -----------------
    Route::resource('programtag', ProgramTagController::class)
        ->middleware([
            'index' => 'permission:program-tag.view',
            'store' => 'permission:program-tag.create',
            'edit' => 'permission:program-tag.edit',
            'update' => 'permission:program-tag.update',
            'destroy' => 'permission:program-tag.delete',
            'show' => 'permission:program-tag.view',
        ]);

    // ----------------- Students & Agents -----------------
    Route::get('all/student/profile/', [AdminController::class, 'allstudent'])
        ->middleware('permission:student.view');
    Route::get('agent-applications', [AdminController::class, 'agentApplications'])
        ->middleware('permission:agent.view');
    Route::get('agent-applications/{id}', [AdminController::class, 'agentApplicationDetail'])
        ->middleware('permission:agent.view');
    Route::post('/agent-applications/update/{id}', [AdminController::class, 'agentApplicationUpdate'])
        ->middleware('permission:agent.update');
    Route::get('student-applications', [AdminController::class, 'studentApplications'])
        ->middleware('permission:student.view');
    Route::get('student-applications/{id}', [AdminController::class, 'studentApplicationDetail'])
        ->middleware('permission:student.view');

    // ----------------- Task -----------------
    Route::get('/tasks', [TaskController::class, 'index'])->middleware('permission:task.view');
    Route::get('/agent/{agent_id}/all-aplication', [TaskController::class, 'agentByapplication'])->middleware('permission:task.view.agent');
    Route::get('/agent/{student_id}/aplication', [TaskController::class, 'agentStudentapplication'])->middleware('permission:task.view.student');
    Route::get('/program/{program_id}/applications', [TaskController::class, 'programApplications'])->middleware('permission:task.view');
    Route::post('/tasks', [TaskController::class, 'store'])->middleware('permission:task.create');
    Route::get('/tasks/{task}/edit', [TaskController::class, 'edit'])->middleware('permission:task.edit');
    Route::post('/tasks/{task}/update', [TaskController::class, 'update'])->middleware('permission:task.update');
    Route::delete('/tasks/{task}', [TaskController::class, 'destroy'])->middleware('permission:task.delete');

    // ----------------- Transactions -----------------
    Route::get('/transactions', [TransactionController::class, 'index'])->middleware('permission:transaction.view');
    Route::get('/transactions/{id}', [TransactionController::class, 'show'])->middleware('permission:transaction.view');
    Route::post('/transactions', [TransactionController::class, 'store'])->middleware('permission:transaction.create');
    Route::put('/transactions/{id}', [TransactionController::class, 'update'])->middleware('permission:transaction.update');
    Route::delete('/transactions/{id}', [TransactionController::class, 'destroy'])->middleware('permission:transaction.delete');

});
