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
use App\Http\Controllers\Artisan\DashboardController as ArtisanDashboardController;
use App\Http\Controllers\Artisan\IssueController as ArtisanIssueController;
use App\Http\Controllers\Artisan\ThreadController as ArtisanThreadController;
use App\Models\User;
use App\Notifications\TestPusherNotification;
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

Route::group(['middleware' => ['auth', 'role:artisan']], function(){
    Route::get('/artisan/dashboard', [ArtisanDashboardController::class, 'index'])->name('artisan-dashboard');

    Route::get('/artisan/issues', [ArtisanIssueController::class, 'index'])->name('artisan-issues');
    Route::get('/artisan/issues/{id}', [ArtisanIssueController::class, 'show'])->name('artisan-issues-show');
    Route::put('/artisan/issues/{id}/update', [ArtisanIssueController::class, 'update'])->name('artisan-issues-update');

    Route::post('/artisan/thread/store', [ThreadController::class, 'store'])->name('artisan-thread-store');
});

require __DIR__.'/auth.php';
