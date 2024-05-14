<?php

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

        Route::get('/dashboard/season-management', 'season_management')->name('season_management')->middleware(['can:season_view']);
        Route::get('/dashboard/agency-management', 'agency_management')->name('agency_management')->middleware(['can:agency_view']);
        Route::get('/dashboard/mena-camps', 'camps_management')->name('camps_management')->middleware(['can:camps_view']);
        Route::get('/dashboard/arafa-camps', 'arafa_camps')->name('arafa_camps')->middleware(['can:camps_view']);
        Route::get('/dashboard/muzdalifah-camps', 'muzdalifah_camps')->name('muzdalifah_camps')->middleware(['can:camps_view']);
        Route::get('/dashboard/buildings-management', 'buildings_management')->name('buildings_management')->middleware(['can:buildings_view']);
        Route::get('/dashboard/units-management', 'units_management')->name('units_management')->middleware(['can:units_view']);
        Route::get('/dashboard/units-management/types', 'units_management_type')->name('units_management_type')->middleware(['can:units_view']);
        Route::get('/dashboard/pilgrims-management', 'pilgrims_management')->name('pilgrims_management')->middleware(['can:pilgrims_view']);
        
        Route::get('/dashboard/buses-management', 'buses_management')->name('buses_management')->middleware(['can:buses_view']);
        Route::get('/dashboard/bus_escalation', 'bus_escalation')->name('bus_escalation')->middleware(['can:buses_escalation']);
        Route::get('/dashboard/buses_swap', 'buses_swap')->name('buses_swap')->middleware(['can:buses_swap']);
        
        Route::get('/dashboard/gift-management', 'gift_management')->name('gift_management')->middleware(['can:gift_view']);
        Route::get('/dashboard/gift_distribution', 'gift_distribution')->name('gift_distribution')->middleware(['can:gift_distribution']);
        
        Route::get('/dashboard/services-management', 'services_management')->name('services_management')->middleware(['can:services_view']);
        Route::get('/dashboard/service-providing', 'service_providing')->name('service_providing')->middleware(['can:service_providing']);
        
        //Route::get('/dashboard/attachments_management', 'attachments_management')->name('attachments_management')->middleware(['can:attachments_view']);
        Route::get('/dashboard/bracelets_management', 'bracelets_management')->name('bracelets_management')->middleware(['can:attachments_view']);
        Route::get('/dashboard/stickers_management', 'stickers_management')->name('stickers_management')->middleware(['can:attachments_view']);
        
        //Route::get('/dashboard/attachments_management', 'attachments_management')->name('attachments_management')->middleware(['can:attachments_view']);
        Route::get('/dashboard/employees_management', 'employees_management')->name('employees_management')->middleware(['can:employees_view']);
        Route::get('/dashboard/employees_salaries', 'employee_salaries')->name('employee_salaries')->middleware(['can:employees_view']);
        Route::get('/dashboard/employees_rewards', 'employee_rewards')->name('employee_rewards')->middleware(['can:employees_view']);
        Route::get('/dashboard/employees_requests', 'employee_requests')->name('employee_requests')->middleware(['can:employees_view']);
        Route::get('/dashboard/employees_positions', 'employee_positions')->name('employee_positions')->middleware(['can:employees_view']);

        // Start media
        Route::get('/dashboard/media', 'admin_media')->name('admin_media');
        // End media        
        Route::get('/dashboard/roles', 'admin_roles')->name('admin_roles')->middleware(['can:roles_view']);
        Route::get('/dashboard/roles/add-new', 'admin_roles_new')->name('admin_roles_new')->middleware(['can:roles_add']);
    
        // Start user
        Route::get('/dashboard/users', 'dashboard_users')->name('dashboard_users');
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
