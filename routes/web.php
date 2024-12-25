<?php

use App\Http\Controllers;
use App\Http\Controllers\ProfileController;
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

    Route::resource('/roles',Controllers\RoleController::class);

    Route::resource('/profiles', ProfileController::class);
    Route::resource('/statuses',Controllers\StatusesController::class);
    Route::resource('/types',Controllers\TypeController::class);
    Route::resource('/warehouses',Controllers\WarehouseController::class);
    Route::resource('/stages',Controllers\StagesController::class);
    Route::resource('/religions',Controllers\ReligionController::class);
    Route::resource('/paymentTypes',Controllers\PaymentTypeController::class);
    Route::resource('/genders',Controllers\GenderController::class);
    Route::resource('/days',Controllers\DayController::class);
    Route::resource('/categories',Controllers\CategoryController::class);

});

require __DIR__.'/auth.php';
