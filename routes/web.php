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
use App\Http\Controllers\Backend\ImagePresetController;
use App\Http\Middleware\RedirectIfAuthenticated;


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

Route::middleware('auth')->group(function () {
    // User Routes
    Route::get('/user/profile', [UserController::class, 'UserProfile'])->name('user.profile');
    Route::post('/user/profile/store', [UserController::class, 'UserProfileStore'])->name('user.profile.store');   
    Route::get('/user/change/password', [UserController::class, 'UserChangePassword'])->name('user.change.password');
    Route::post('/user/password/update', [UserController::class, 'UserPasswordUpdate'])->name('user.password.update');

});

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
     // Image Preset All Routes
    Route::resource('image_preset',ImagePresetController::class);
    Route::get('/image_preset/status/{image_preset}', [ImagePresetController::class, 'StatusUpdate'])->name('image_preset.status');
    
    // Property Type All Routes
    Route::resource('property_types',PropertyTypeController::class);
    
    // Property  All Routes
    Route::resource('properties',PropertyController::class);
    Route::post('/properties/states', [PropertyController::class, 'states'])->name('properties.states');
    Route::patch('/properties/update_img/{property}', [PropertyController::class, 'update_img'])->name('properties.update_img');
    Route::get('/properties/multi_img_delete/{id}', [PropertyController::class, 'multiImageDestory'])->name('properties.multi_img_delete');
    Route::patch('/properties/multi_img_update/{property}', [PropertyController::class, 'multiImageUpdate'])->name('properties.multi_img_update');
    Route::patch('/properties/multi_img_update_one/{id}', [PropertyController::class, 'multiImageUpdateOne'])->name('properties.multi_img_update_one');
    Route::patch('/properties/facility_update/{property}', [PropertyController::class, 'facilityUpdate'])->name('properties.facility_update');   
    Route::get('/properties/facility_delete/{id}', [PropertyController::class, 'facilityDestory'])->name('properties.facility_delete');
    Route::patch('/properties/status/{property}', [PropertyController::class, 'StatusUpdate'])->name('properties.status');
//  
    
    // Property Amenities Type All Routes
    Route::resource('amenities',AmenitiesController::class);

     // Property Country All Routes
    Route::resource('countries',CountryController::class);
    Route::patch('/countries/status/{country}', [CountryController::class, 'StatusUpdate'])->name('countries.status');
     // Property State All Routes
    Route::resource('states',StateController::class);
    Route::patch('/states/status/{state}', [StateController::class, 'StatusUpdate'])->name('states.status');
//    
     // Property Cities Type All Routes
    Route::resource('cities',CityController::class); 
    Route::post('/city/states', [CityController::class, 'states'])->name('cities.states'); 
    Route::post('/city/cities', [CityController::class, 'cities'])->name('cities.cities');  
    Route::patch('/city/status/{state}', [CityController::class, 'StatusUpdate'])->name('cities.status');
//      

    
});
// End Group Admin Middleware

// Agent Group Middleware
Route::middleware(['auth', 'role:agent'])->group(function () {
    Route::get('/agent/dashboard', [AgentController::class, 'AgentDashboard'])->name('agent.dashboard');
});
// End Group Agent Middleware
Route::get('/agent/login', [AgentController::class, 'AgentLogin'])->name('agent.login')->middleware(RedirectIfAuthenticated::class);

Route::get('/admin/login', [AdminController::class, 'AdminLogin'])->name('admin.login')->middleware(RedirectIfAuthenticated::class);
Route::get('/admin/logout', [AdminController::class, 'AdminLogout'])->name('admin.logout');
Route::get('/user/logout', [UserController::class, 'UserLogout'])->name('user.logout');

require __DIR__ . '/auth.php';
