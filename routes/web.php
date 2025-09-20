<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Company\CompanyController;
use App\Http\Controllers\Company\TechnologyController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\User\RoleController;
use App\Http\Controllers\Lead\LeadController;
use App\Http\Controllers\Lead\LeadEditController;
use App\Http\Controllers\Lead\LeadStatusController;
use App\Http\Controllers\Lead\LeadStoreController;
use App\Http\Controllers\Lead\LeadCommentController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\User\LeadUserController;
use App\Http\Controllers\Profile\ProfileController;
use App\Http\Controllers\LeadByCompanyController;
use App\Http\Controllers\Vendor\VendorController;
use App\Http\Controllers\UserProfile\UserProfileController;
use App\Http\Controllers\CallHistoryController;
use App\Http\Controllers\Lead\LeadSearchController;
use App\Http\Controllers\ForgotPassword\ForgotPasswordController;
use App\Http\Controllers\Lead\LeadStatusBaseRecordController;
use App\Http\Controllers\EmailValidation\EmailValidationController;
use App\Http\Controllers\EmailValidation\EmailFilterController;
use App\Http\Controllers\live_interviews\InterviewController;
use App\Http\Controllers\live_interviews\InterviewControllerTest;

use App\Http\Controllers\PerformanceDashboard\PerformanceController;
use App\Http\Controllers\PerformanceDashboard\CreateTargetController;
use App\Http\Controllers\PerformanceDashboard\PerfSalesTeamLeadViewController;
use App\Http\Controllers\PerformanceDashboard\ClosedLeadsViewController;
use App\Http\Controllers\PerformanceDashboard\RunningProjectsByVendorController;
use App\Http\Controllers\AdminHr\AdminHrController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
/*
|--------------------------------------------------------------------------
| User login
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('auth.login');
});

Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::match(['post', 'get'], 'logout', [LoginController::class, 'logout'])->name('logout');

Route::post('/update-password', [UserController::class, 'updatePassword'])->name('update.password');


/*
|--------------------------------------------------------------------------
| User Forgot Password
|--------------------------------------------------------------------------
*/
Route::get('forgotpassword', [ForgotPasswordController::class, 'showLoginForm'])->name('forgotpassword');
Route::post('password-email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password-email');
Route::get('reset/{id}', [ForgotPasswordController::class, 'reset'])->name('reset');
Route::post('forgot_password_change_process',[ForgotPasswordController::class,'forgot_password_change_process'])->name('forgot_password_change_process');

/*
|--------------------------------------------------------------------------
| live-interview-scheduled
|--------------------------------------------------------------------------
*/
// Route::get('/live-interview-scheduled', [InterviewController::class, 'index'])->name('live.interview.scheduled');
// Route::get('/live-interview-scheduled-testing', [InterviewControllerTest::class, 'index'])->name('live-interview-scheduled-testing');


// Protected route
Route::middleware(['protect.simple'])->group(function () {
    Route::get('/live-interview-scheduled', [InterviewController::class, 'index'])
        ->name('live.interview.scheduled');
});

// Password check
Route::post('/check-simple-password', function (\Illuminate\Http\Request $request) {
    $correctPassword = "Bt123@#"; //  password is 

    if ($request->password === $correctPassword) {
        //  Grant session access
        session(['simple_password_granted' => true]);

        //  Set trusted browser cookie (30 days)
        return redirect()->intended('/live-interview-scheduled')
            ->cookie('trusted_browser', 'yes', 60*24*30); // 30 days
    }

    return back()->withErrors(['password' => 'Wrong password!']);
})->name('simple.password.check');



/*
|--------------------------------------------------------------------------
| Dashboard Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');


    /*
    |--------------------------------------------------------------------------
    | Company Routes
    |--------------------------------------------------------------------------
    */
    Route::get('/add-company', [CompanyController::class, 'companyList'])->name('add.company');
    Route::post('/add-company', [CompanyController::class, 'companyNameAdd'])->name('add.company.submit');
    Route::get('/edit-company/{id}', [CompanyController::class, 'editCompany'])->name('edit.company');
    Route::get('/delete-company/{id}', [CompanyController::class, 'destroy'])->name('delete.company');

    Route::get('/add-technology', [TechnologyController::class, 'technologyList'])->name('add.technology');
    Route::post('/add-technology', [TechnologyController::class, 'addTechnology'])->name('add.technology.submit');
    Route::get('/edit-technology/{id}', [TechnologyController::class, 'editTechnology'])->name('edit.technology');
    Route::get('/delete-technology/{id}', [TechnologyController::class, 'destroy'])->name('delete.technology');
    /*
    |--------------------------------------------------------------------------
    | User Routes
    |--------------------------------------------------------------------------
    */
    Route::get('/add-user', [UserController::class, 'showUserForm'])->name('add.user');
    Route::get('/view-user', [UserController::class, 'showUser'])->name('view.user');
    Route::post('/users', [UserController::class, 'store'])->name('add.user.submit');

    Route::get('/user/{id}/edit', [UserController::class, 'edit'])->name('user.edit');
    Route::put('/users/{id}', [UserController::class, 'update'])->name('update.user');

    /*
    |--------------------------------------------------------------------------
    | Role Routes
    |--------------------------------------------------------------------------
    */
    Route::get('/add-role', [RoleController::class, 'addRole'])->name('add.role');
    Route::post('/add-role-submit', [RoleController::class, 'submit'])->name('add.role.submit');
    // edit update delete role
    Route::get('/edit-role/{id}', [RoleController::class, 'edit'])->name('edit.role');
    Route::post('/update-role', [RoleController::class, 'update'])->name('update.role');
    Route::post('/delete-role/{id}', [RoleController::class, 'destroy'])->name('delete.role');

    /*
    |--------------------------------------------------------------------------
    | Generate Lead Status edit ,delete ,update controllre
    |--------------------------------------------------------------------------
    */
    Route::get('/add-leadstatus', [LeadStatusController::class, 'create'])->name('add.leadstatus');
    Route::post('/add-leadstatus', [LeadStatusController::class, 'store'])->name('add.leadstatus.submit');
    Route::get('/leadstatus/{id}/edit', [LeadStatusController::class, 'edit'])->name('leadstatus.edit');
    Route::put('/leadstatus/{leadstatus}', [LeadStatusController::class, 'update'])->name('leadstatus.update');
    Route::post('/leadstatus/{id}', [LeadStatusController::class, 'destroy'])->name('leadstatus.delete');

    /*
    |--------------------------------------------------------------------------
    | Generate Lead
    |--------------------------------------------------------------------------
    */
    Route::get('/add-lead', [LeadController::class, 'showLeadForm'])->name('add.lead');
    Route::post('/add-lead', [LeadStoreController::class, 'store'])->name('add.lead.submit');
    Route::get('/view-lead', [LeadController::class, 'index'])->name('view.lead');
    Route::match(['get', 'post'], '/view-C2C-lead', [LeadController::class, 'indexc2c'])->name('view.c2clead');

    //Search
    Route::post('/search-leads', [LeadController::class, 'searchLeads'])->name('search.leads');
    // Edit lead route
    Route::get('/leads/{lead}/edit', [LeadEditController::class, 'edit'])->name('leads.edit');
    Route::post('/leads/{lead}', [LeadEditController::class, 'update'])->name('leads.update');
    Route::delete('/leads/{lead}',[LeadEditController::class, 'destroy'])->name('leads.destroy');

    // View comment and update route
    Route::get('/leads/{lead}', [LeadCommentController::class, 'show'])->name('leads.show');
    Route::post('/comments/add', [LeadCommentController::class, 'store'])->name('comments.add');

    /*
    |--------------------------------------------------------------------------
    | Is Read
    |--------------------------------------------------------------------------
    */
    Route::post('/leads/{lead}/update-read-status', [LeadController::class, 'updateReadStatus'])->name('leads.updateReadStatus');
    Route::post('/updateLeadName', [LeadCommentController::class, 'LeadEndClientOrCompanyName'])->name('updateLeadName');


    /*
    |--------------------------------------------------------------------------
    | Live Search
    |--------------------------------------------------------------------------
    */
    Route::get('/search', [SearchController::class, 'search']);

    /*
    |--------------------------------------------------------------------------
    | user.leads.show
    |--------------------------------------------------------------------------
    */
    Route::get('/leads/user/{userId}', [LeadUserController::class, 'show'])->name('user.leads.show');
    Route::post('/lead-search/{searchuserId}', [LeadUserController::class, 'UserFilterLeads'])->name('user.leadsearchhow');
    Route::get('/profiles.index', [ProfileController::class, 'index'])->name('profiles.index');
    Route::get('/profiles', [ProfileController::class, 'create'])->name('profiles.create');
    Route::post('/profiles', [ProfileController::class, 'store'])->name('profiles.store');
    Route::get('/profiles/{profile}/edit', [ProfileController::class, 'edit'])->name('profiles.edit');
    Route::put('/profiles/{id}', [ProfileController::class, 'update'])->name('profiles.update');

    /*
    |--------------------------------------------------------------------------
    | Lead By CompanyId Ajax Find
    |--------------------------------------------------------------------------
    */
    Route::get('/leadsbycompanyid', [LeadByCompanyController::class, 'index']);


    /*
    |--------------------------------------------------------------------------
    | Vendor Registration
    |--------------------------------------------------------------------------
    */
    Route::get('/vendors', [VendorController::class, 'index'])->name('vendors.index');
    Route::get('/vendors/create', [VendorController::class, 'create'])->name('vendors.createVendor');
    Route::post('/add-vendor', [VendorController::class, 'store'])->name('add.vendor.submit');
    Route::get('/vendors/{vendor}', [VendorController::class, 'edit'])->name('vendors.editVendor');
    Route::post('/vendors/update', [VendorController::class, 'update'])->name('vendors.updateVendor');
/*joing form*/

    Route::get('/joining-form', [AdminHrController::class, 'joiningForm'])->name('adminhr.joiningForm');
    Route::get('/consultancy-form', [AdminHrController::class, 'consultancyForm'])->name('adminhr.consultancyForm');
    Route::get('/employe-history-form', [AdminHrController::class, 'employeHistoryForm'])->name('adminhr.employeHistoryForm');
    /*
    |--------------------------------------------------------------------------
    | user profile
    |--------------------------------------------------------------------------
    */
    Route::get('/profile', [UserProfileController::class, 'showUserProfile'])->name('user.profile');
    // Route::put('/profile', [UserProfileController::class, 'update'])->name('user.profile.update');
    Route::get('changepassword', [UserProfileController::class, 'changepassword'])->name('changepassword');
    Route::post('/profile/update-password', [UserProfileController::class, 'updatePassword'])->name('update.password');



    /*
    |--------------------------------------------------------------------------
    | history profile
    |--------------------------------------------------------------------------
    */
    Route::get('/call-history/show', [CallHistoryController::class, 'show'])->name('callhistory.show');

    Route::get('/call-history', [CallHistoryController::class, 'index'])->name('callhistory.index');
    Route::post('/call-history', [CallHistoryController::class, 'store'])->name('callhistory.store');
    Route::get('/call-history/{id}/edit', [CallHistoryController::class, 'edit'])->name('callhistory.edit');
    Route::put('/call-history/{id}', [CallHistoryController::class, 'update'])->name('callhistory.update');
    Route::delete('/call-history/{id}', [CallHistoryController::class, 'destroy'])->name('callhistory.destroy');

    Route::get('call-history/{id}/details', [CallHistoryController::class, 'viewCallDetails'])->name('callhistory.viewCallDetails');

    Route::post('/save-comment', [CallHistoryController::class, 'saveComment'])->name('save.comment');

    /*
    |--------------------------------------------------------------------------
    | Search Lead Before Entry
    |--------------------------------------------------------------------------
    */
    Route::get('/lead_search', [LeadSearchController::class, 'LeadSearch']);
    Route::get('/lead-searchform', [LeadSearchController::class, 'showSearchForm'])->name('leads.searchform');

    /*
    |--------------------------------------------------------------------------
    | Base on the lead status controller and view file name in view-lead.blade.php
    |--------------------------------------------------------------------------
    */
    Route::get('/lead/status/{id}', [LeadStatusBaseRecordController::class, 'StatusBaseRecordShow'])->name('leadstatus.filterRecord');
    // Define the route
    Route::get('/UpcomingOnboardingProjectList', [LeadStatusBaseRecordController::class, 'UpcomingOnboardingProjectList'])->name('UpcomingOnboardingProjectList');


    /*
    |--------------------------------------------------------------------------
    | EmailValidationController
    |--------------------------------------------------------------------------
    */
    Route::get('/email-form', [EmailValidationController::class, 'showForm'])->name('email.form');
    Route::post('/validate-email', [EmailValidationController::class, 'validateEmail'])->name('email.validate');
    Route::post('/export-valid-emails', [EmailValidationController::class, 'exportValidEmails'])->name('export.valid.emails');

    Route::get('/email-config', [EmailFilterController::class, 'showConfig'])->name('email.config');
    Route::post('email-filters', [EmailFilterController::class, 'store'])->name('email_filters.store');
    Route::delete('email-filters/{id}', [EmailFilterController::class, 'destroy'])->name('email_filters.destroy');
    Route::put('/email-filters/{id}', [EmailFilterController::class, 'update'])->name('email_filters.update');

    /*
    |--------------------------------------------------------------------------
    | Team Target Controller
    |--------------------------------------------------------------------------
    */

    // Dashboard
    Route::get('/performance-dashboard', [PerformanceController::class, 'index'])
        ->name('performance.dashboard');

    // Targets Management
    Route::prefix('performance-targets')->name('performance.targets.')->group(function () {
        Route::get('/', [CreateTargetController::class, 'index'])->name('index');
        Route::post('/', [CreateTargetController::class, 'store'])->name('store');
        Route::get('/{technology_target}/edit', [CreateTargetController::class, 'edit'])->name('edit');
        Route::put('/{technology_target}', [CreateTargetController::class, 'update'])->name('update');
        Route::delete('/{technology_target}', [CreateTargetController::class, 'destroy'])->name('destroy');
        Route::put('/{id}/toggle-status', [CreateTargetController::class, 'toggleStatus'])->name('toggleStatus');
    });

    // Sales Team Performance
    Route::get('/performance-salesteam/quarterLeadView', [PerfSalesTeamLeadViewController::class, 'showPerformanceSalesTeamLead'])
        ->name('performance.SalesTeamLeadView');

    // Closed Leads (Quarterly)
    Route::get('/performance/closed-leads/{year}/{quarter}', [ClosedLeadsViewController::class, 'getQuarterClosedLeads'])
        ->name('performance.closedLeads');

    Route::prefix('performance-dashboard')->name('performance.')->group(function () {
        Route::get('/running-projects-vendors', [RunningProjectsByVendorController::class, 'index'])
            ->name('running.projects.vendors');
    });

    Route::prefix('performance')->name('performance.')->group(function () {
        Route::get('/vendors/{id}', [RunningProjectsByVendorController::class, 'show'])->name('vendors.show');
    });

});