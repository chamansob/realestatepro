<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Agent\AgentPropertyController;
use App\Http\Controllers\AgentController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Backend\PropertyTypeController;
use App\Http\Controllers\Backend\PropertyController;
use App\Http\Controllers\Backend\AmenitiesController;
use App\Http\Controllers\Backend\CountryController;
use App\Http\Controllers\Backend\StateController;
use App\Http\Controllers\Backend\CityController;
use App\Http\Controllers\Backend\ImagePresetController;
use App\Http\Controllers\Backend\PlanController;
use App\Http\Controllers\Backend\PlanFeaturesController;
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
})->middleware(['auth', 'verified'])->name('dashboard')->middleware(RedirectIfAuthenticated::class);

Route::middleware(['auth', 'role:user'])->prefix('user')->group(function () {
    // User Routes
    Route::controller(UserController::class)->group(function () {
        Route::get('/profile', 'UserProfile')->name('user.profile');
        Route::post('/profile/store', 'UserProfileStore')->name('user.profile.store');
        Route::get('/change/password', 'UserChangePassword')->name('user.change.password');
        Route::post('/password/update', 'UserPasswordUpdate')->name('user.password.update');
    });
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
        // Agent User All Routes
        Route::get('/agents', 'AllAgents')->name('admin.agents');
        Route::get('/agent/add', 'AgentAdd')->name('admin.agent_add');
        Route::post('/agent/store',  'AgentStore')->name('admin.agent_store');
        Route::get('/agent/edit/{id}', 'AgentEdit')->name('admin.agent_edit');
        Route::put('/agent/update',  'AgentUpdate')->name('admin.agent_update');
        Route::put('/agent/status', 'AgentStatusUpdate')->name('admin.agent_status');
        Route::delete('/agent/delete/{id}', 'AgentDelete')->name('admin.agent_delete');

        //Agent Package Plan
        Route::get('/buy/package_history', 'AdminPackageHistory')->name('admin.package_history');
        Route::get('/buy/package_invoice/{id}', 'AdminPackageInvoice')->name('admin.package_invoice');

    });
    // Image Preset All Routes
    Route::resource('image_preset', ImagePresetController::class);
    Route::get('/image_preset/status/{image_preset}', [ImagePresetController::class, 'StatusUpdate'])->name('image_preset.status');

    // Property Type All Routes
    Route::resource('property_types', PropertyTypeController::class);
    // Buy Plan Type All Routes
    Route::resource('plan', PlanController::class);
    // Buy Plan Feature Type All Routes
    Route::resource('planFeatures', PlanFeaturesController::class);
    Route::patch('/planFeatures/status/{planFeatures}', [PlanFeaturesController::class, 'StatusUpdate'])->name('planFeatures.status');

    // Property  All Routes
    Route::resource('properties', PropertyController::class);
    Route::controller(PropertyController::class)->group(function () {
        Route::post('/properties/states', 'states')->name('properties.states');
        Route::patch('/properties/update_img/{property}', 'update_img')->name('properties.update_img');
        Route::get('/properties/multi_img_delete/{id}', 'multiImageDestory')->name('properties.multi_img_delete');
        Route::patch('/properties/multi_img_update/{property}',  'multiImageUpdate')->name('properties.multi_img_update');
        Route::patch('/properties/multi_img_update_one/{id}', 'multiImageUpdateOne')->name('properties.multi_img_update_one');
        Route::patch('/properties/facility_update/{property}',  'facilityUpdate')->name('properties.facility_update');
        Route::get('/properties/facility_delete/{id}', 'facilityDestory')->name('properties.facility_delete');
        Route::patch('/properties/status/{property}',  'StatusUpdate')->name('properties.status');
    });
    //  

    // Property Amenities Type All Routes
    Route::resource('amenities', AmenitiesController::class);

    // Property Country All Routes
    Route::resource('countries', CountryController::class);
    Route::patch('/countries/status/{country}', [CountryController::class, 'StatusUpdate'])->name('countries.status');
    // Property State All Routes
    Route::resource('states', StateController::class);
    Route::patch('/states/status/{state}', [StateController::class, 'StatusUpdate'])->name('states.status');
    //    
    // Property Cities Type All Routes

    Route::resource('cities', CityController::class);
    Route::controller(CityController::class)->group(function () {
        Route::post('/city/states',  'states')->name('cities.states');
        Route::post('/city/cities',  'cities')->name('cities.cities');
        Route::patch('/city/status/{state}',  'StatusUpdate')->name('cities.status');
        //      
    });

 });
// End Group Admin Middleware

// Agent Group Middleware
Route::middleware(['auth', 'role:agent'])->prefix('agent')->group(function () {
    Route::controller(AgentController::class)->group(function () {
        Route::get('/dashboard', 'AgentDashboard')->name('agent.dashboard');
        Route::get('/profile', 'AgentProfile')->name('agent.profile');
        Route::post('/profile/store',  'AgentProfileStore')->name('agent.profile.store');
        Route::get('/change/password',  'AgentChangePassword')->name('agent.change.password');
        Route::post('/password/update',  'AgentPasswordUpdate')->name('agent.password.update');
    });

    Route::controller(AgentPropertyController::class)->group(function () {
        Route::get('/properties/all', 'AgentProperty')->name('agent.properties');
        Route::get('/properties/show/{property}', 'show')->name('agent.properties.show');
        Route::get('/properties/create', 'create')->name('agent.properties.create');
        Route::post('/properties/store', 'store')->name('agent.properties.store');
        Route::post('/properties/states', 'states')->name('agent.properties.states');
        Route::get('/properties/edit/{property}', 'edit')->name('agent.properties.edit');
        Route::put('/properties/update/{property}', 'update')->name('agent.properties.update');
        Route::delete('/properties/delete', 'destory')->name('agent.properties.delete');
        Route::patch('/properties/update_img/{property}', 'update_img')->name('agent.properties.update_img');
        Route::get('/properties/multi_img_delete/{id}', 'multiImageDestory')->name('agent.properties.multi_img_delete');
        Route::patch('/properties/multi_img_update/{property}', 'multiImageUpdate')->name('agent.properties.multi_img_update');
        Route::patch('/properties/multi_img_update_one/{id}',  'multiImageUpdateOne')->name('agent.properties.multi_img_update_one');
        Route::patch('/properties/facility_update/{property}', 'facilityUpdate')->name('agent.properties.facility_update');
        Route::get('/properties/facility_delete/{id}',  'facilityDestory')->name('agent.properties.facility_delete');

        // Agent Buy Package Route from admin 
        Route::get('/buy/package', 'BuyPackage')->name('agent.buy.package');
        Route::get('/buy/plan/{id}', 'BuyPlan')->name('agent.buy.plan');
        Route::get('/buy/package_history', 'PackageHistory')->name('agent.buy.package.package_history');
        Route::get('/buy/package_invoice/{id}', 'PackageInvoice')->name('agent.buy.package.package_invoice');
        Route::post('/buy/plan/store', 'BuyPlanStore')->name('agent.buy.plan.store');
    });
});
// End Group Agent Middleware
Route::get('/agent/login', [AgentController::class, 'AgentLogin'])->name('agent.login')->middleware(RedirectIfAuthenticated::class);
Route::post('/agent/register', [AgentController::class, 'AgentRegister'])->name('agent.register')->middleware(RedirectIfAuthenticated::class);

Route::get('/admin/login', [AdminController::class, 'AdminLogin'])->name('admin.login')->middleware(RedirectIfAuthenticated::class);
Route::get('/admin/logout', [AdminController::class, 'AdminLogout'])->name('admin.logout');
Route::get('/agent/logout', [AgentController::class, 'AgentLogout'])->name('agent.logout');
Route::get('/user/logout', [UserController::class, 'UserLogout'])->name('user.logout');

require __DIR__ . '/auth.php';
