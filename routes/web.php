<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

use App\Http\Controllers\{
    ReportsController,
    UserController,
    AccessibilityController,
    DiagnosisTagsController,
};

use App\Http\Controllers\Report\{
    SalesReportController,
    PatientReportController,
};

Route::get('/', function () {
    return Inertia::render('Welcome');
})->name('home');

Route::get('dashboard', function () {

    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {

    Route::prefix('/reports')->group(function () {

        Route::get('/', [ReportsController::class, 'index'])->name('reports.index');
        Route::get('/patients', [PatientReportController::class, 'index'])->name('reports.patients.index');
        Route::get('/patients/demographics', [PatientReportController::class, 'demographics'])->name('reports.patients.demographics');
        Route::get('/patients/diagnosis', [PatientReportController::class, 'diagnosis'])->name('reports.patients.diagnosis');
        
        Route::get('/sales', [SalesReportController::class, 'index'])->name('reports.sales.index');
        Route::get('/sales/summary', [SalesReportController::class, 'summary'])->name('reports.sales.summary');
    });

    
    Route::resource('/users', UserController::class)->except(['show']);
    Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');

    Route::get('/accessibility', [AccessibilityController::class, 'index'])->name('accessibility.index');

    Route::resource('/configuration/diagnosis/tags', DiagnosisTagsController::class);
    // Route::get('accessibility/roles', [AccessibilityController::class, 'roles'])->name('accessibility.roles');
    // Route::get('accessibility/permissions', [AccessibilityController::class, 'permissions'])->name('accessibility.permissions');
    // Route::get('accessibility/roles/{role}/edit', [AccessibilityController::class, 'editRole'])->name('accessibility.roles.edit');
    // Route::put('accessibility/roles/{role}', [AccessibilityController::class, 'updateRole'])->name('accessibility.roles.update');
    // Route::get('accessibility/permissions/{permission}/edit', [AccessibilityController::class, 'editPermission'])->name('accessibility.permissions.edit');
    // Route::put('accessibility/permissions/{permission}', [AccessibilityController::class, 'updatePermission'])->name('accessibility.permissions.update');

    // Route::get('settings', function () {
    //     return Inertia::render('Settings/Index');
    // })->name('settings.index');
});

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
