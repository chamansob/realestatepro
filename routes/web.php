<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AgentController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Backend\PropertyTypeController;
use App\Http\Controllers\Backend\AmenitiesController;
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

// Route::get('/', function () {
//     return view('welcome');
// });

// User Frontend All Route
Route::get('/', [UserController::class, 'Index']);

Route::get('/dashboard', function () {
    return view('frontend.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware('auth')->group(function () {
//     // User Routes
//     Route::get('/user/profile', [UserController::class, 'UserProfile'])->name('user.profile');
//     Route::post('/user/profile/store', [UserController::class, 'UserProfileStore'])->name('user.profile.store');   
//     Route::get('/user/change/password', [UserController::class, 'UserChangePassword'])->name('user.change.password');
//     Route::post('/user/password/update', [UserController::class, 'UserPasswordUpdate'])->name('user.password.update');

// });

// Admin Group Middleware
Route::middleware(['auth', 'role:admin'])->group(function () {
    // Admin Dashboard All Routes
    Route::controller(AdminController::class)->group(function () {
        Route::get('/admin/dashboard', 'AdminDashboard')->name('admin.dashboard');
        Route::get('/admin/profile', 'AdminProfile')->name('admin.profile');
        Route::post('/admin/profile/store',  'AdminProfileStore')->name('admin.profile.store');
        Route::get('/admin/change/password',  'AdminChangePassword')->name('admin.change.password');
        Route::post('/admin/password/update',  'AdminPasswordUpdate')->name('admin.password.update');
    });
    // Property Type All Routes
    Route::resource('property_types',PropertyTypeController::class);
    // Route::controller(PropertyTypeController::class)->group(function () {
    //     Route::get('/all/type',  'AllType')->name('all.type');
    //     Route::get('/add/type',  'AddType')->name('add.type');
    //     Route::post('/type/store',  'TypeStore')->name('type.store');
    //     Route::get('/edit/type/{id}',  'EditType')->name('edit.type');
    //     Route::post('/type/update/{id}',  'TypeUpdate')->name('type.update');
    //     Route::get('/type/delete/{id}',  'TypeDelete')->name('delete.type');
    // });

    // Property Amenities Type All Routes
    Route::resource('amenities',AmenitiesController::class);
    // Route::controller(AmenitiesController::class)->group(function () {
    //     Route::get('/all/amenities',  'Index')->name('all.amenities');
    //     Route::get('/add/amenities',  'Create')->name('add.amenities');
    //     Route::post('/amenities/store',  'Store')->name('amenities.store');
    //     Route::get('/edit/amenities/{id}',  'Edit')->name('edit.amenities');
    //     Route::post('/amenities/update/{id}',  'Update')->name('amenities.update');
    //     Route::get('/amenities/delete/{id}',  'Destroy')->name('delete.amenities');
    // });
    
});
// End Group Admin Middleware

// Agent Group Middleware
Route::middleware(['auth', 'role:agent'])->group(function () {
    Route::get('/agent/dashboard', [AgentController::class, 'AgentDashboard'])->name('agent.dashboard');
});
// End Group Agent Middleware

Route::get('/admin/login', [AdminController::class, 'AdminLogin'])->name('admin.login');
Route::get('/admin/logout', [AdminController::class, 'AdminLogout'])->name('admin.logout');
Route::get('/user/logout', [UserController::class, 'UserLogout'])->name('user.logout');

require __DIR__ . '/auth.php';
