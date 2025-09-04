<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Models\Sales as Sale;
use App\Http\Controllers\{
    ReportsController,
    UserController,
    RoleController,
    BranchController,
    AccessibilityController,
    DiagnosisTagsController,
};

use App\Http\Controllers\Report\{
    SalesReportController,
    PatientReportController,
};

Route::redirect('/', '/login');

Route::get('dashboard', function () {

      $monthlySales = Sale::whereMonth('date_created', now()->month)
                    ->whereYear('date_created', now()->year)
                    ->sum('total');
                    
        // Format the result as a currency string if needed
        $formattedMonthlySales = number_format($monthlySales, 2);

    return Inertia::render('Dashboard', [
        'title' => 'Dashboard',
        'description' => 'Dashboard',
        'monthlySales' => $formattedMonthlySales
    ]);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {

    Route::prefix('/reports')->group(function () {

        Route::get('/', [ReportsController::class, 'index'])->name('reports.index');
        Route::get('/patients', [PatientReportController::class, 'index'])->name('reports.patients.index');
        Route::get('/patients/demographics', [PatientReportController::class, 'demographics'])->name('reports.patients.demographics');
        Route::get('/patients/diagnosis', [PatientReportController::class, 'diagnosis'])->name('reports.patients.diagnosis');
        Route::get('/patients/visits', [PatientReportController::class, 'visits'])->name('reports.patients.visits');
        
        Route::get('/sales', [SalesReportController::class, 'index'])->name('reports.sales.index');
        Route::get('/sales/summary', [SalesReportController::class, 'summary'])->name('reports.sales.summary');
        Route::get('/sales/products-services', [SalesReportController::class, 'summary'])->name('reports.sales.products-services');
        Route::get('/sales/employees', [SalesReportController::class, 'summary'])->name('reports.sales.employees');
        Route::post('/sales-report', [SalesReportController::class, 'generateReport']);
    });

    
    Route::resource('/users', UserController::class);
    Route::resource('/branches', BranchController::class);
    Route::get('/accessibility', [AccessibilityController::class, 'index'])->name('accessibility.index');
    Route::post('/accessibility/{role}/role-permissions', [AccessibilityController::class, 'updatePermissions'])->name('accessibility.role-permissions');


    Route::get('/roles', [RoleController::class, 'index'])->name('roles.index');
    Route::post('/roles', [RoleController::class, 'store'])->name('roles.store');

});

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
