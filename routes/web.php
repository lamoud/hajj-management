<?php

use App\Exports\UsersExport;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileSettingsController;
use Illuminate\Support\Facades\Route;
use Maatwebsite\Excel\Facades\Excel;

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

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {

    Route::get('users/export/', function(){
        return Excel::download(new UsersExport, 'users.xlsx');
    });

    Route::get('/', function () {
        return redirect()->to(route('dashboard'));
    });

    // Route::get('/dashboard', function () {
    //     return view('dashboard');
    // })->name('dashboard');

    Route::middleware([
        'can:admin_view',
    ])->controller(AdminController::class)->group(function () {


        
        Route::get('/dashboard', 'admin_show')->name('dashboard');

        Route::get('/dashboard/agency-management', 'agency_management')->name('agency_management')->middleware(['can:agency_view']);
        Route::get('/dashboard/camps-management', 'camps_management')->name('camps_management')->middleware(['can:camps_view']);
        Route::get('/dashboard/units-management', 'units_management')->name('units_management')->middleware(['can:units_view']);
        Route::get('/dashboard/pilgrims-management', 'pilgrims_management')->name('pilgrims_management')->middleware(['can:pilgrims_view']);
        Route::get('/dashboard/buses-management', 'buses_management')->name('buses_management')->middleware(['can:pilgrims_view']);

        // Start media
        Route::get('/dashboard/media', 'admin_media')->name('admin_media');
        // End media        
        Route::get('/dashboard/roles', 'admin_roles')->name('admin_roles')->middleware(['can:roles_view']);
        Route::get('/dashboard/roles/add-new', 'admin_roles_new')->name('admin_roles_new')->middleware(['can:roles_add']);
    
        // Start user
        Route::get('/dashboard/users', 'dashboard_users')->name('dashboard_users');
        Route::get('/dashboard/users/new', 'dashboard_users_new')->name('dashboard_users_new');
        Route::post('/dashboard/users/new', 'validate_dashboard_users_new')->name('validate_dashboard_users_new');
        Route::get('/dashboard/users/update/{id}-{email}', 'dashboard_users_update')->name('dashboard_users_update');
        Route::post('/dashboard/users/update/{id}-{email}', 'validate_dashboard_users_update')->name('validate_dashboard_users_update');
        Route::delete('/dashboard/users/delete/{id}-{email}', 'validate_dashboard_users_delete')->name('validate_dashboard_users_delete');
        // End users
        // Start settings
        Route::get('/admin/admin_settings', 'admin_settings')->name('admin_settings')->middleware(['can:settings_view']);
        Route::post('/admin/admin_settings', 'validate_admin_settings')->name('validate_admin_settings');
        Route::get('/admin/social-media', 'admin_social')->name('admin_social')->middleware(['can:settings_view']);
        Route::post('/admin/social-media', 'validate_admin_social')->name('validate_admin_social');

        Route::get('/admin/admin_maintenance', 'admin_maintenance')->name('admin_maintenance')->middleware(['can:settings_view']);
        Route::post('/admin/admin_maintenance', 'validate_admin_maintenance')->name('validate_admin_maintenance');
        Route::get('/admin/app-terms', 'admin_appterms')->name('admin_appterms')->middleware(['can:settings_view']);
        Route::post('/admin/app-terms', 'validate_admin_appterms')->name('validate_admin_appterms');
        Route::get('/admin/app-policy', 'admin_apppolicy')->name('admin_apppolicy')->middleware(['can:settings_view']);
        Route::post('/admin/app-policy', 'validate_admin_apppolicy')->name('validate_admin_apppolicy');
        // End settings

    });

    Route::controller(ProfileSettingsController::class)->group(function () {
        Route::get('/user/profile/settings', 'profile_settings')->name('profile_settings');
        Route::get('/user/profile/posts', 'profile_posts')->name('profile_posts');
        Route::get('/user/profile/platforms', 'profile_platforms')->name('profile_platforms');
        Route::get('/user/profile-show/{email}', 'user_profile')->name('user_profile');
    });

});
