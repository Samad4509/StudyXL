<?php

use App\Models\Application;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Agent\AgentController;

use App\Http\Controllers\Admin\IntakeController;

use App\Http\Controllers\Filters\AllfiltersItem;
use App\Http\Controllers\Auth\PasswordController;
// use App\Http\Controllers\Agent\AuthenticatedSessionController;
use App\Http\Controllers\Admin\ProgramTagController;
use App\Http\Controllers\Admin\UniversityController;
use App\Http\Controllers\Auth\NewPasswordController;

use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\Student\StudentApplication;
use App\Http\Controllers\Admin\DestinationController;
use App\Http\Controllers\Admin\IntakeMonthController;
use App\Http\Controllers\Agent\ApplicationController;
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
    Route::post('/student/applications', [StudentApplication::class, 'application']);

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
    Route::get('my-applications', [ApplicationController::class, 'getMyApplications']);




});


//samad2
// samad
// Admin API
// Admin login and public actions
// Route::prefix('admin')->group(function () {
//     Route::post('/login', [AdminController::class, 'login_submit'])->name('admin.login');
//     Route::post('/forget_password', [AdminController::class, 'forget_password_submit'])->name('admin.forget_password');
//     Route::post('/reset_password_submit',[AdminController::class,'reset_password_submit'])->name('admin.reset_password_submit');
//     Route::get('/all-user',[AdminController::class,'alluser'])->name('admin.all.user');
//     Route::get('/approve-agent/{id}', [AdminController::class, 'approveAgent'])->name('admin.approve.agent');
//     Route::get('activate-agent/{id}', [AdminController::class, 'activateAgent'])->name('admin.activate.agent');
//     Route::get('/deactivate-agent/{id}', [AdminController::class, 'deactivateAgent'])->name('admin.deactivate.agent');
// });

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
    Route::get('notifications/{id}', [AdminNotificationController::class, 'show']);

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
// ✅ Protected admin routes with Sanctum middleware & admin_token guard
Route::middleware('auth:sanctum')->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::post('/logout', [AdminController::class, 'logout'])->name('admin.logout');

    // University create route
    // Route::get('/university/edit', [UniversityController::class, 'edit']);
    Route::get('/university-destination ', [UniversityController::class, 'universitydestination'])->name('university.destination');
    Route::get('/alluniversities ', [UniversityController::class, 'alluniversitie'])->name('university.alluniversities');
    Route::post('/universities/create/{destination_id}', [UniversityController::class, 'store'])->name('university.store');       // create
    Route::get('/universities/edit/{id}', [UniversityController::class, 'edit'])->name('university.edit');    // single
    Route::post('/universities/update/{id}/{destination_id}', [UniversityController::class, 'update'])->name('university.update');  // update
    Route::delete('/universities/{id}', [UniversityController::class, 'destroy'])->name('university.destroy'); // delete



    //    Route::get('/university-destination', [UniversityController::class, 'universitydestination'])->name('university.destination');
    //     Route::post('/universities/create', [UniversityController::class, 'store'])->name('university.store');
    //     Route::get('/universities/edit/{id}', [UniversityController::class, 'edit'])->name('university.edit');
    //     Route::post('/universities/update/{id}', [UniversityController::class, 'update'])->name('university.update');
    //     Route::delete('/universities/{id}', [UniversityController::class, 'destroy'])->name('university.destroy');

    // single
    // Get single university by ID

    // single
    // Destination
    Route::resource('destinations', DestinationController::class);


    Route::post('/university-programs/{university_id}/{program_level_id}/{field_of_studies_id}/{intake_id}/{intake_month_id}/{program_tag_id}/store', [UniversityProgramController::class, 'store'])->name('admin.university-programs.store');
    // In routes/api.php
    Route::get('/university-programs/{id}/edit', [UniversityProgramController::class, 'edit']);
    Route::put('/universities/{id}/{university_id}/{program_level_id}/{field_of_studies_id}/{intake_id}/{intake_month_id}/{program_tag_id}/update', [UniversityProgramController::class, 'update']);
    // Route::put('/universities/{university_id}/programs/{id}/update', [UniversityProgramController::class, 'update']);
    Route::delete('/universities/{university_id}/programs/{id}', [UniversityProgramController::class, 'destroy']);




    //Filters Items Program Lavel
    Route::post('/program/level/store', [AllfiltersItem::class, 'Programlevel'])->name('program.lavel');
    Route::get('/program/level/{id}/edit', [AllfiltersItem::class, 'Programleveledit'])->name('programlavel.edit');
    Route::put('/program/level/{id}/update', [AllfiltersItem::class, 'Programlevelupdate'])->name('programlavel.update');
    Route::delete('program/level/{id}/delete', [AllfiltersItem::class, 'Programleveldestroy'])->name('programlavel.destroy');
    Route::get('all/program/level', [AllfiltersItem::class, 'AllProgramlevel'])->name('allprogram.lavel');

    //Filters Items Field Of Study
    Route::post('field/of/study/store', [AllfiltersItem::class, 'FieldOfstudy'])->name('field.study');
    Route::get('field/of/study/{id}/edit', [AllfiltersItem::class, 'FieldOfstudyedit'])->name('field.edit');
    Route::put('field/of/study/{id}/update', [AllfiltersItem::class, 'FieldOfstudyupdate'])->name('field.update');
    Route::delete('field/of/study/{id}/delete', [AllfiltersItem::class, 'FieldOfstudydelete'])->name('field.delete');
    Route::get('all/field/of/study/', [AllfiltersItem::class, 'AllFieldOfstudy'])->name('field.all');


    //Filters Items Field Of Study Of Subject
    Route::post('field/of/study/{fieldId}/subject/create', [AllfiltersItem::class, 'createSubject'])->name('create.subject');
    Route::get('subject/{id}/edit', [AllfiltersItem::class, 'editSubject'])->name('edit.subject');
    Route::put('subject/{id}/update', [AllfiltersItem::class, 'updateSubject'])->name('update.subject');
    Route::delete('subject/{id}', [AllfiltersItem::class, 'deleteSubject'])->name('delete.subject');

    //Filter
    Route::get('field/of/study/{fieldId}/subjects', [AllfiltersItem::class, 'getSubjectsByField'])->name('subject.byfield');
    Route::get('allsubjects', [AllfiltersItem::class, 'allsubjects'])->name('subject.allsubjects');

    //  Intakes Month 
    Route::resource('intakes', IntakeController::class);
    Route::get('intake/all/month/', [IntakeMonthController::class, 'AllIntakesMonth'])->name('intake.all.month');
    Route::post('intake/month/create/{intakeid}', [IntakeMonthController::class, 'CreateIntakeMonth'])->name('intakemonth.create');
    Route::get('intake/month/{id}', [IntakeMonthController::class, 'EditIntakeMonth'])->name('intakeedit.month');
    Route::put('intake/month/{id}', [IntakeMonthController::class, 'UpdateIntakeMonth'])->name('intakeupdate.month');
    Route::delete('intake/month/{id}', [IntakeMonthController::class, 'DeleteIntakeMonth'])->name('intakedelete.month');

    //  Program tag
    Route::resource('programtag', ProgramTagController::class);

    Route::get('all/student/profile/', [AdminController::class, 'allstudent']);



    //Applications
    // Route::get('applications', [AdminController::class, 'application']);
      Route::get('agent-applications', [AdminController::class, 'agentApplications']);

     // Student Applications
      Route::get('student-applications', [AdminController::class, 'studentApplications']);
      Route::get('admin/all/agent-student', [AdminController::class, 'allagentstudent']);

  

    
});
