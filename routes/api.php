<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Agent\AgentController;
use App\Http\Controllers\Admin\IntakeController;

use App\Http\Controllers\Filters\AllfiltersItem;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Admin\ProgramTagController;
use App\Http\Controllers\Admin\UniversityController;
// use App\Http\Controllers\Agent\AuthenticatedSessionController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\Admin\DestinationController;
use App\Http\Controllers\Admin\IntakeMonthController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Student\StudentProfileController;
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
    Route::post('/student/profile/update', [StudentProfileController::class, 'update']);


});

//Agent API
Route::middleware(['agent', 'agent.approved'])->prefix('agent')->group(function () {
    Route::get('dashboard', [AgentController::class,'dashboard'])->name('agent.dashboard');
    Route::get('logout', [AgentController::class,'logout'])->name('agent.logout');
});
Route::middleware('guest:agent')->group(function () {
    Route::post('agent/register', [AgentController::class, 'store']);
    Route::post('agent/login', [App\Http\Controllers\Agent\AuthenticatedSessionController::class, 'store']);
    Route::post('/agent/forget_password_submit',[AgentController::class,'forget_password_submit'])->name('agent.forget_password_submit');
    Route::get('/agent/reset_password/{token}/{email}', [AgentController::class, 'reset_password'])->name('agent.reset_password');
    Route::post('/agent/reset_password_submit',[AgentController::class,'reset_password_submit'])->name('agent.reset_password_submit');

     

});

// Admin API
// Admin login and public actions
Route::prefix('admin')->group(function () {
    Route::post('/login', [AdminController::class, 'login_submit'])->name('admin.login');
    Route::post('/forget_password', [AdminController::class, 'forget_password_submit'])->name('admin.forget_password');
    Route::post('/reset_password_submit',[AdminController::class,'reset_password_submit'])->name('admin.reset_password_submit');
    Route::get('/approve-agent/{id}', [AdminController::class, 'approveAgent'])->name('admin.approve.agent');
    Route::get('activate-agent/{id}', [AdminController::class, 'activateAgent'])->name('admin.activate.agent');
    Route::get('/deactivate-agent/{id}', [AdminController::class, 'deactivateAgent'])->name('admin.deactivate.agent');
});



// Public admin login route
Route::post('/admin/login', [AdminController::class, 'login_submit'])->name('admin.api.login');

// ✅ Protected admin routes with Sanctum middleware & admin_token guard
Route::middleware('auth:sanctum')->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::post('/logout', [AdminController::class, 'logout'])->name('admin.logout');

    // University create route
    // Route::get('/university/edit', [UniversityController::class, 'edit']);
    
    Route::post('/universities', [UniversityController::class, 'store'])->name('university.store');       // create
    Route::get('/universities/{id}', [UniversityController::class, 'edit'])->name('university.edit');    // single
    Route::post('/universities/{id}', [UniversityController::class, 'update'])->name('university.update');  // update
    Route::delete('/universities/{id}', [UniversityController::class, 'destroy'])->name('university.destroy'); // delete

    // Destination
    Route::resource('destinations', DestinationController::class);

    
    Route::post('/university-programs', [UniversityProgramController::class, 'store'])->name('admin.university-programs.store');

    //Filters Items Program Lavel
    Route::post('/program/level', [AllfiltersItem::class, 'Programlevel'])->name('program.lavel');
    Route::get('/program/level/{id}', [AllfiltersItem::class, 'Programleveledit'])->name('programlavel.edit');
    Route::put('/program/level/{id}', [AllfiltersItem::class, 'Programlevelupdate'])->name('programlavel.update');
    Route::delete('program/level/{id}', [AllfiltersItem::class, 'Programleveldestroy'])->name('programlavel.destroy');
    Route::get('all/program/level', [AllfiltersItem::class, 'AllProgramlevel'])->name('allprogram.lavel');

    //Filters Items Field Of Study
     Route::post('field/of/study', [AllfiltersItem::class, 'FieldOfstudy'])->name('field.study');
     Route::get('field/of/study/{id}', [AllfiltersItem::class, 'FieldOfstudyedit'])->name('field.edit');
     Route::put('field/of/study/{id}', [AllfiltersItem::class, 'FieldOfstudyupdate'])->name('field.update');
     Route::delete('field/of/study/{id}', [AllfiltersItem::class, 'FieldOfstudydelete'])->name('field.delete');
     Route::get('all/field/of/study/', [AllfiltersItem::class, 'AllFieldOfstudy'])->name('field.all');
     

     //Filters Items Field Of Study Of Subject
     Route::post('field/of/study/{fieldId}/subject', [AllfiltersItem::class, 'createSubject'])->name('create.subject');
     Route::get('field/of/study/{fieldId}/subjects', [AllfiltersItem::class, 'getSubjectsByField'])->name('subject.byfield');
     Route::get('subject/{id}', [AllfiltersItem::class, 'editSubject'])->name('edit.subject');
     Route::put('subject/{id}', [AllfiltersItem::class, 'updateSubject'])->name('update.subject');
     Route::delete('subject/{id}', [AllfiltersItem::class, 'deleteSubject'])->name('delete.subject');

     //  Intakes Month 
     Route::resource('intakes', IntakeController::class);
     Route::get('intake/all/month/', [IntakeMonthController::class, 'AllIntakesMonth'])->name('intake.all.month');
     Route::post('intake/month/create/{intakeid}', [IntakeMonthController::class, 'CreateIntakeMonth'])->name('intakemonth.create');
     Route::get('intake/month/{id}', [IntakeMonthController::class, 'EditIntakeMonth'])->name('intakeedit.month');
     Route::put('intake/month/{id}', [IntakeMonthController::class, 'UpdateIntakeMonth'])->name('intakeupdate.month');
     Route::delete('intake/month/{id}', [IntakeMonthController::class, 'DeleteIntakeMonth'])->name('intakedelete.month');

     //  Program tag
     Route::resource('programtag', ProgramTagController::class);

     








 
});






