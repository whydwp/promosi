<?php
// routes/web.php

use App\Http\Controllers\RegionalController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\BranchController;

Route::get('/', function () {
    return view('login.index');
})->name('login');

Route::post('/', [AuthController::class, 'login']); // Handle POST request for login
Route::get('/login', [AuthController::class, 'showLogin'])->name('showLogin'); // Keep the existing login route for named routing
Route::post('/login', [AuthController::class, 'login'])->name('login'); // Keep the existing login route for named routing
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::resource('posts', PostController::class);
    Route::resource('regions', RegionalController::class);
    Route::resource('users', UserController::class);
    Route::resource('branches', BranchController::class);
    // Route::delete('/regions/{regional}', [RegionalController::class, 'destroy'])->name('regions.destroy');

    // Route::put('/regions/{regional}', [RegionalController::class, 'update'])->name('regions.update');

});

Route::get('/get-branches-by-region', [BranchController::class, 'getBranchesByRegion'])->name('getBranchesByRegion');
Route::post('/save-image-priority', [PostController::class, 'saveImagePriority'])->name('saveImagePriority');

Route::post('/save-sorted-images', 'PostController@saveSortedImages')->name('saveSortedImages');
Route::get('/{branch}', [PostController::class, 'showByBranch'])->name('posts.show_by_branch');

