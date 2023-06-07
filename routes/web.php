<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AgentController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Backend\PropertyTypeController;
use App\Http\Controllers\Backend\PropertyController;
use App\Http\Controllers\Backend\AmenitiesController;
use App\Http\Controllers\Backend\CountryController;
use App\Http\Controllers\Backend\StateController;
use App\Http\Controllers\Backend\CityController;
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
Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
    // Admin Dashboard All Routes
    Route::controller(AdminController::class)->group(function () {
        Route::get('/dashboard', 'AdminDashboard')->name('admin.dashboard');
        Route::get('/profile', 'AdminProfile')->name('admin.profile');
        Route::post('/profile/store',  'AdminProfileStore')->name('admin.profile.store');
        Route::get('/change/password',  'AdminChangePassword')->name('admin.change.password');
        Route::post('/password/update',  'AdminPasswordUpdate')->name('admin.password.update');
    });
    // Property Type All Routes
    Route::resource('property_types',PropertyTypeController::class);
    
    // Property  All Routes
    Route::resource('properties',PropertyController::class);
    Route::post('/properties/states', [PropertyController::class, 'states'])->name('properties.states');
   
    // Property Amenities Type All Routes
    Route::resource('amenities',AmenitiesController::class);

     // Property Country All Routes
    Route::resource('countries',CountryController::class);
    Route::get('/countries/status/{country}', [CountryController::class, 'StatusUpdate'])->name('countries.status');
     // Property State All Routes
    Route::resource('states',StateController::class);
    Route::get('/states/status/{state}', [StateController::class, 'StatusUpdate'])->name('states.status');
//    
     // Property Cities Type All Routes
    Route::resource('cities',CityController::class);    
    Route::get('/city/status/{state}', [CityController::class, 'StatusUpdate'])->name('cities.status');
//      

    
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
