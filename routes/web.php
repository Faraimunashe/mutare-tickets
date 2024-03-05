<?php

use App\Http\Controllers\AuthenticatorController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\User\DashboardController;
use App\Http\Controllers\User\IssueController;
use App\Http\Controllers\User\ThreadController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\IssueController as AdminIssueController;
use App\Http\Controllers\Admin\ThreadController as AdminThreadController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\AllocateController as AdminAllocateController;
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
    return redirect()->route('login');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/dashboard', [AuthenticatorController::class, 'index'])->middleware('auth')->name('dashboard');

Route::group(['middleware' => ['auth', 'role:user']], function(){
    Route::get('/user/dashboard', [DashboardController::class, 'index'])->name('user-dashboard');

    Route::get('/user/issues', [IssueController::class, 'index'])->name('user-issues');
    Route::get('/user/issues/create', [IssueController::class, 'create'])->name('user-issues-create');
    Route::get('/user/issues/{id}', [IssueController::class, 'show'])->name('user-issues-show');
    Route::post('/user/issues/store', [IssueController::class, 'store'])->name('user-issues-store');

    Route::post('/user/thread/store', [ThreadController::class, 'store'])->name('user-thread-store');

});

Route::group(['middleware' => ['auth', 'role:admin']], function(){
    Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin-dashboard');

    Route::get('/admin/issues', [AdminIssueController::class, 'index'])->name('admin-issues');
    Route::get('/admin/issues/{id}', [AdminIssueController::class, 'show'])->name('admin-issues-show');

    Route::post('/admin/thread/store', [AdminThreadController::class, 'store'])->name('admin-thread-store');

    Route::get('/admin/users', [AdminUserController::class, 'index'])->name('admin-users');
    Route::put('/admin/users/update/{id}', [AdminUserController::class, 'update'])->name('admin-users-update');
    Route::post('/admin/users/store', [AdminUserController::class, 'store'])->name('admin-users-store');

    Route::post('/admin/allocate', [AdminAllocateController::class, 'store'])->name('admin-allocate');
});

require __DIR__.'/auth.php';
