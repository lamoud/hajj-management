<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $superAdminRole = Role::create(['guard_name'=>'web','name' => 'super_admin', 'display_name'=> 'المدير العام', 'display_name_en'=> 'Super Administrator', 'color'=> 'purple']);
        $adminRole = Role::create(['guard_name'=>'web','name' => 'admin', 'display_name'=> 'مدير', 'display_name_en'=> 'Administrator']);
        $userRole = Role::create(['guard_name'=>'web','name' => 'user', 'display_name'=> 'مستخدم', 'display_name_en'=> 'User']);
    
        $admin_view = Permission::create(['guard_name'=>'web','name' => 'admin_view', 'display_name'=> 'عرض  لوحة التحكم', 'display_name_en'=> 'View dashboard']);

        $roles_view = Permission::create(['guard_name'=>'web','name' => 'roles_view', 'display_name'=> 'عرض  الصلاحيات', 'display_name_en'=> 'View roles']);
        $roles_add = Permission::create(['guard_name'=>'web','name' => 'roles_add', 'display_name'=> 'إضافة صلاحيات', 'display_name_en'=> 'Add roles']);
        $roles_update = Permission::create(['guard_name'=>'web','name' => 'roles_update', 'display_name'=> 'تعديل الصلاحيات', 'display_name_en'=> 'Update roles']);
        $roles_delete = Permission::create(['guard_name'=>'web','name' => 'roles_delete', 'display_name'=> 'حذف صلاحيات', 'display_name_en'=> 'Delete roles']);

        $users_view = Permission::create(['guard_name'=>'web','name' => 'users_view', 'display_name'=> 'عرض  المستخدمين', 'display_name_en'=> 'View users']);
        $users_add = Permission::create(['guard_name'=>'web','name' => 'users_add', 'display_name'=> 'إضافة مستخدمين', 'display_name_en'=> 'Add users']);
        $users_update = Permission::create(['guard_name'=>'web','name' => 'users_update', 'display_name'=> 'تعديل مستخدمين', 'display_name_en'=> 'Update users']);
        $users_delete = Permission::create(['guard_name'=>'web','name' => 'users_delete', 'display_name'=> 'حذف مستخدمين', 'display_name_en'=> 'Delete users']);

        $settings_view = Permission::create(['guard_name'=>'web','name' => 'settings_view', 'display_name'=> 'عرض الإعدادات', 'display_name_en'=> 'View settings']);
        $settings_update = Permission::create(['guard_name'=>'web','name' => 'settings_update', 'display_name'=> 'تعديل الإعدادات', 'display_name_en'=> 'Update settings']);

        $media_view = Permission::create(['guard_name'=>'web','name' => 'media_view', 'display_name'=> 'عرض  الجهات', 'display_name_en'=> 'View media']);
        $media_add = Permission::create(['guard_name'=>'web','name' => 'media_add', 'display_name'=> 'إضافة جهة', 'display_name_en'=> 'Add media']);
        $media_update = Permission::create(['guard_name'=>'web','name' => 'media_update', 'display_name'=> 'تعديل جهة', 'display_name_en'=> 'Update media']);
        $media_delete = Permission::create(['guard_name'=>'web','name' => 'media_delete', 'display_name'=> 'حذف جهة', 'display_name_en'=> 'Delete media']);

        $season_view = Permission::create(['guard_name'=>'web','name' => 'season_view', 'display_name'=> 'عرض مواسم الحج', 'display_name_en'=> 'View season']);
        $season_add = Permission::create(['guard_name'=>'web','name' => 'season_add', 'display_name'=> 'إضافة موسم حج', 'display_name_en'=> 'Add season']);
        $season_update = Permission::create(['guard_name'=>'web','name' => 'season_update', 'display_name'=> 'تعديل موسم حج', 'display_name_en'=> 'Update aseason']);
        $season_delete = Permission::create(['guard_name'=>'web','name' => 'season_delete', 'display_name'=> 'حذف موسم حج', 'display_name_en'=> 'Delete season']);

        $agency_view = Permission::create(['guard_name'=>'web','name' => 'agency_view', 'display_name'=> 'عرض  الجهات', 'display_name_en'=> 'View agency']);
        $agency_add = Permission::create(['guard_name'=>'web','name' => 'agency_add', 'display_name'=> 'إضافة جهة', 'display_name_en'=> 'Add agency']);
        $agency_update = Permission::create(['guard_name'=>'web','name' => 'agency_update', 'display_name'=> 'تعديل جهة', 'display_name_en'=> 'Update agency']);
        $agency_delete = Permission::create(['guard_name'=>'web','name' => 'agency_delete', 'display_name'=> 'حذف جهة', 'display_name_en'=> 'Delete agency']);

        $camps_view = Permission::create(['guard_name'=>'web','name' => 'camps_view', 'display_name'=> 'عرض  المحيمات', 'display_name_en'=> 'View camps']);
        $camps_add = Permission::create(['guard_name'=>'web','name' => 'camps_add', 'display_name'=> 'إضافة مخيم', 'display_name_en'=> 'Add camp']);
        $camps_update = Permission::create(['guard_name'=>'web','name' => 'camps_update', 'display_name'=> 'تعديل مخيم', 'display_name_en'=> 'Update camp']);
        $camps_delete = Permission::create(['guard_name'=>'web','name' => 'camps_delete', 'display_name'=> 'حذف مخيم', 'display_name_en'=> 'Delete camp']);

        $units_view = Permission::create(['guard_name'=>'web','name' => 'units_view', 'display_name'=> 'عرض  الوحدات', 'display_name_en'=> 'View units']);
        $units_add = Permission::create(['guard_name'=>'web','name' => 'units_add', 'display_name'=> 'إضافة وحدة', 'display_name_en'=> 'Add unit']);
        $units_update = Permission::create(['guard_name'=>'web','name' => 'units_update', 'display_name'=> 'تعديل وحدة', 'display_name_en'=> 'Update unit']);
        $units_delete = Permission::create(['guard_name'=>'web','name' => 'units_delete', 'display_name'=> 'حذف وحدة', 'display_name_en'=> 'Delete unit']);

        $pilgrims_view = Permission::create(['guard_name'=>'web','name' => 'pilgrims_view', 'display_name'=> 'عرض  الحجاج', 'display_name_en'=> 'View pilgrims']);
        $pilgrims_add = Permission::create(['guard_name'=>'web','name' => 'pilgrims_add', 'display_name'=> 'إضافة حاج', 'display_name_en'=> 'Add pilgrim']);
        $pilgrims_update = Permission::create(['guard_name'=>'web','name' => 'pilgrims_update', 'display_name'=> 'تعديل حاج', 'display_name_en'=> 'Update pilgrim']);
        $pilgrims_delete = Permission::create(['guard_name'=>'web','name' => 'pilgrims_delete', 'display_name'=> 'حذف حاج', 'display_name_en'=> 'Delete pilgrim']);

        $buses_view = Permission::create(['guard_name'=>'web','name' => 'buses_view', 'display_name'=> 'عرض الباصات', 'display_name_en'=> 'View buses']);
        $buses_add = Permission::create(['guard_name'=>'web','name' => 'buses_add', 'display_name'=> 'إضافة باص', 'display_name_en'=> 'Add bus']);
        $buses_update = Permission::create(['guard_name'=>'web','name' => 'buses_update', 'display_name'=> 'تعديل ياص', 'display_name_en'=> 'Update bus']);
        $buses_delete = Permission::create(['guard_name'=>'web','name' => 'buses_delete', 'display_name'=> 'حذف ياص', 'display_name_en'=> 'Delete bus']);

        
        $permissions = Permission::pluck('name')->toArray();
        $adminRole->syncPermissions($permissions);
        $superAdminRole->syncPermissions($permissions);


        $superAdmin = User::create([
            'name'               => 'Super Admin',
            'email'              => 'betalamoud@gmail.com',
            'email_verified_at'  => Carbon::now(),
            'password'           => Hash::make('Admin_123@#')
        ]);

        $superAdmin->assignRole('super_admin');
    
        $admin = User::create([
            'name'               => 'Admin',
            'email'              => 'admin@betalamoud.com',
            'email_verified_at'  => Carbon::now(),
            'password'           => Hash::make('Admin_123@#')
        ]);

        $admin->assignRole('admin');
    
    }
}
