<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ShiftController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\AccountSaleController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'role:admin'])->group(function (): void {
    Route::resource('products', ProductController::class);
    Route::resource('users', UserController::class);
});

Route::middleware(['auth'])->group(function () {

    // ---------- Turnos ----------
    Route::resource('shifts', ShiftController::class)->except(['show']);

    // Vista de cierre de turno (antes de cerrarlo)
    Route::get('/shifts/{shift}/close-view', [ShiftController::class, 'closeView'])
        ->name('shifts.close.view');

    //   Acción de cerrar (POST)
    Route::post('/shifts/{shift}/close', [ShiftController::class, 'close'])
        ->name('shifts.close');

    // Reporte del turno (PDF / detalle)
    Route::get('/shifts/{shift}/report', [ShiftController::class, 'report'])
        ->name('shifts.report');
});


Route::middleware(['auth'])->group(function () {

    Route::resource('sales', SaleController::class)
        ->except(['show']); // si no usas el show, lo quitamos

        Route::resource('accounts', App\Http\Controllers\AccountController::class);

        Route::resource('accounts', AccountController::class);

// ventas internas de cada cuenta
Route::post('/accounts/{account}/sales', [AccountSaleController::class, 'store'])
    ->name('accounts.sales.store');

Route::delete('/account-sales/{sale}', [AccountSaleController::class, 'destroy'])
    ->name('accounts.sales.destroy');


});



require __DIR__.'/auth.php';
