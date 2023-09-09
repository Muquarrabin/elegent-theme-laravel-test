<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CustomerController;
use Illuminate\Support\Facades\Route;

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

//Route::get('/', function () {
//    return view('welcome');
//});

Route::get('/', [CustomerController::class, 'create'])->name('customer.create');
Route::post('/customer-data', [CustomerController::class, 'store'])->name('customer.store');
Route::get('/customer-details/{email}', [CustomerController::class, 'show'])->name('customer.show');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/dashboard', [CustomerController::class,'index'])->name('dashboard');
    Route::get('/customer-ajax', [CustomerController::class,'customerDataAjax'])->name('customer-data.ajax');
    Route::post('/wp-customer-create', [CustomerController::class,'createWpAccount'])->name('customer.create.wp');

});

require __DIR__.'/auth.php';
