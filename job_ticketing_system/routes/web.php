<?php

use App\Http\Controllers\ProfileController;

use App\Http\Controllers\ClientController;
use App\Http\Controllers\AdminHomeController;
use App\Http\Controllers\AdministratorController;
use App\Http\Controllers\MonitorController;

use App\Http\Controllers\ITFormController;
use App\Http\Controllers\SysFormController;
use App\Http\Controllers\CreativeFormController;

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// CLIENT ROUTES
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
// DASHBOARD ////////////////////////////////
Route::get('/dashboard', function () { return view('dashboard'); })->middleware(['auth', 'user'])->name('dashboard');
// FORM ROUTES
Route::get('/creative-works-form', [ClientController::class, 'showFormCreative'])->name('creative-works-form');
Route::get('/it-repair-form', [ClientController::class, 'showFormRepair'])->name('it-repair-form');
Route::get('/system-dev-form', [ClientController::class, 'showForm'])->name('system-dev-form');
// TRANSACTION LIST
Route::get('/job-info-request', [ClientController::class, 'index'])->name('job_info.request');
Route::get('/job-info-status', [ClientController::class, 'status'])->name('job_info.status');
// STORE FORM DATA AND GENERATE PDF
Route::post('/save-data', [CreativeFormController::class, 'saveData'])->name('save-data');
Route::post('/save-data-it', [ITFormController::class, 'saveData'])->name('save-data-it');
Route::post('/save-data-sys', [SysFormController::class, 'saveData'])->name('save-data-sys');
//////////////////////////////////////////////

// ADMIN/IT PERSONNEL ROUTES ////////////////////////////////
Route::get('/admin/dashboard', [AdminHomeController::class, 'adminRequest'])->middleware(['auth', 'admin'])->name('admin.dashboard');
Route::get('/admin/assigned-task', [AdminHomeController::class, 'index'])->middleware(['auth', 'admin'])->name('admin.assignedTask');
Route::get('/admin/reports', [AdminHomeController::class, 'reportsIndex'])->middleware(['auth', 'admin'])->name('admin.reports');
// ADMIN/IT PERSONNEL FORM
Route::get('/admin/preview/{id}', [AdminHomeController::class, 'preview'])->name('admin.preview');
// ADMIN/IT GENERATE SERVICES FORM
Route::post('/service-pdf', [AdminHomeController::class, 'servicePDF'])->name('service_pdf');
// ADMIN/IT GENERATE TRANSACTIONS FORM
Route::post('/transact-pdf', [AdminHomeController::class, 'transactPDF'])->name('transact_pdf');
// EDIT ADMIN REQUEST
Route::resource('job_info', AdminHomeController::class)->except(['show']);

// FORM ROUTES
Route::get('admin/creative-works-form', [AdminHomeController::class, 'showFormCreative'])->name('admin.creative-works-form');
Route::get('admin/it-repair-form', [AdminHomeController::class, 'showFormRepair'])->name('admin.it-repair-form');
Route::get('admin/system-dev-form', [AdminHomeController::class, 'showForm'])->name('admin.system-dev-form');
////////////////////////////////////////////////////////////

// MONITOR ROUTES //////////////////////////////////////////
Route::get('monitor/dashboard', [MonitorController::class, 'index'])->middleware(['auth', 'monitor'])->name('monitor.dashboard');
// FETCH ATTENDING PERSONNEL
Route::get('/fetch-attending-personnel/{officeId}', [MonitorController::class, 'fetchAttendingPersonnel']);
// EDIT
Route::resource('job_request', MonitorController::class)->except(['show']);
////////////////////////////////////////////////////////////

// ADMINISTRATOR ROUTES ////////////////////////////////////
Route::post('/departments', [AdministratorController::class, 'storeDepartment'])->name('storeDepartment');
Route::put('/departments/{id}', [AdministratorController::class, 'updateDepartment'])->name('updateDepartment');
// VOID
Route::post('/void-request/{id}', [AdministratorController::class, 'voidRequest'])->name('void-request');
// DASHBOARD INTERFACE
Route::get('administrator/dashboard', [AdministratorController::class, 'index'])
    ->middleware(['auth', 'administrator'])->name('administrator.dashboard');
// SAVE USERTYPE AND OFFICE
Route::post('/saveUserType/{id}', [AdministratorController::class, 'saveUserType'])->name('saveUserType');
// DEPARTMENT MANAGEMENT INTERFACE
Route::get('administrator/department', [AdministratorController::class, 'departmentIndex'])->name('administrator.department');
// VOID REQUEST MANAGEMENT INTERFACE
Route::get('administrator/void-request', [AdministratorController::class, 'voidIndex'])->name('administrator.void-request');
// VOID LIST MANAGEMENT INTERFACE
Route::get('administrator/void-list', [AdministratorController::class, 'voidListIndex'])->name('administrator.void-list');
// REPORTS INTERFACE
Route::get('/administrator/reports', [AdministratorController::class, 'reportsIndex'])->middleware(['auth', 'administrator'])->name('administrator.reports');
// ADMINISTRATOR/IT GENERATE SERVICES FORM
Route::post('administrator/service-pdf', [AdministratorController::class, 'servicetransactionPDF'])->name('administrator_service_pdf');
// ADMINISTRATOR/IT DROPDOWN OFFICE AND ATTENDING PERSONNEL IN REPORTS.BLADE
Route::get('/fetch-attending-personnel/{office}', [AdministratorController::class, 'fetchAttendingPersonnel']);
// SUMMARY INDEX
Route::post('/summary-request-pdf', [AdministratorController::class, 'summaryRequestPDF'])->name('administrator_summary_pdf');
////////////////////////////////////////////////////////////

require __DIR__.'/auth.php';
