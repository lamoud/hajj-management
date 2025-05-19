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
    private array $roles = [
        'super_admin' => ['display_name' => 'المدير العام', 'display_name_en' => 'Super Administrator', 'color' => 'purple'],
        'admin' => ['display_name' => 'مدير', 'display_name_en' => 'Administrator'],
        'user' => ['display_name' => 'مستخدم', 'display_name_en' => 'User'],
    ];

    private array $permissionGroups = [
        // صلاحيات المدير - إدارة لوحة التحكم
        'admin' => [
            'view' => ['عرض لوحة التحكم', 'View dashboard'],
        ],

        // صلاحيات الأدوار - إدارة صلاحيات المستخدمين
        'roles' => [
            'view' => ['عرض الصلاحيات', 'View roles'],
            'add' => ['إضافة صلاحيات', 'Add roles'],
            'update' => ['تعديل الصلاحيات', 'Update roles'],
            'delete' => ['حذف صلاحيات', 'Delete roles'],
        ],

        // صلاحيات المستخدمين - إدارة حسابات المستخدمين
        'users' => [
            'view' => ['عرض المستخدمين', 'View users'],
            'add' => ['إضافة مستخدمين', 'Add users'],
            'update' => ['تعديل مستخدمين', 'Update users'],
            'delete' => ['حذف مستخدمين', 'Delete users'],
        ],

        // صلاحيات الإعدادات - إدارة إعدادات النظام
        'settings' => [
            'view' => ['عرض الإعدادات', 'View settings'],
            'update' => ['تعديل الإعدادات', 'Update settings'],
            'upload_logo' => ['رفع شعار الموقع', 'Upload site logo'],
            'add_description' => ['اضافة وصف الموقع', 'Add site description'],
            'update_description' => ['تعديل وصف الموقع', 'Update site description'],
            'delete_description' => ['حذف وصف الموقع', 'Delete site description']
        ],

        // صلاحيات الملفات - إدارة الوسائط والمرفقات
        'media' => [
            'view' => ['عرض الوسائط', 'View media'],
            'add' => ['إضافة وسائط', 'Add media'],
            'update' => ['تعديل وسائط', 'Update media'],
            'delete' => ['حذف وسائط', 'Delete media'],
        ],

        // صلاحيات المواسم - إدارة مواسم الحج
        'season' => [
            'view' => ['عرض مواسم الحج', 'View season'],
            'add' => ['إضافة موسم حج', 'Add season'],
            'update' => ['تعديل موسم حج', 'Update season'],
            'delete' => ['حذف موسم حج', 'Delete season'],
        ],

        // صلاحيات الجهات - إدارة الجهات المسؤولة
        'agency' => [
            'view' => ['عرض الجهات', 'View agency'],
            'add' => ['إضافة جهة', 'Add agency'],
            'update' => ['تعديل جهة', 'Update agency'],
            'delete' => ['حذف جهة', 'Delete agency'],
        ],

        // صلاحيات المخيمات - إدارة المخيمات
        'camps' => [
            'view' => ['عرض المخيمات', 'View camps'],
            'add' => ['إضافة مخيم', 'Add camp'],
            'update' => ['تعديل مخيم', 'Update camp'],
            'delete' => ['حذف مخيم', 'Delete camp'],
            'upload_pilgrim_front' => ['رفع تصميم بطاقة الحاج', 'Upload pilgrim card front design'],
            'upload_pilgrim_back' => ['رفع تصميم البطاقة الخلفية للحجاج', 'Upload pilgrim card back design']
        ],

        // صلاحيات الوحدات السكنية - إدارة الوحدات
        'units' => [
            'view' => ['عرض الوحدات', 'View units'],
            'add' => ['إضافة وحدة', 'Add unit'],
            'update' => ['تعديل وحدة', 'Update unit'],
            'delete' => ['حذف وحدة', 'Delete unit'],
        ],

        // صلاحيات الحجاج - إدارة بيانات الحجاج
        'pilgrims' => [
            'view' => ['عرض الحجاج', 'View pilgrims'],
            'add' => ['إدخال بيانات الحجاج', 'Add pilgrim data'],
            'update' => ['تعديل بيانات الحجاج', 'Update pilgrim data'],
            'delete' => ['حذف بيانات الحجاج', 'Delete pilgrim data'],
            'archive' => ['أرشفة بيانات الحجاج', 'Archive pilgrim data'],
            'print_card' => ['طباعة بطاقة الحاج', 'Print pilgrim card'],
            'update_name' => ['تعديل اسم الحاج', 'Update pilgrim name'],
            'update_id' => ['تعديل رقم هوية الحاج', 'Update pilgrim ID'],
            'update_permit' => ['تعديل رقم تصريح الحاج', 'Update pilgrim permit'],
            'housing' => ['تسكين الحاج', 'Pilgrim housing'],
            'tent_transfer' => ['نقل الحاج بين الخيام', 'Transfer pilgrim between tents'],
            'bus_transfer' => ['نقل الحاج بين الباصات', 'Transfer pilgrim between buses'],
            'escalate' => ['تصعيد الحاج', 'Escalate pilgrim'],
            'show_barcode' => ['اظهار باركود الحاج من الجدول', 'Show pilgrim barcode in table'],
            'hide_barcode' => ['اخفاء باركود الحاج من الجدول', 'Hide pilgrim barcode in table'],
        ],

        // صلاحيات الباصات - إدارة وسائل النقل
        'buses' => [
            'view' => ['عرض الباصات', 'View buses'],
            'add' => ['إضافة باص', 'Add bus'],
            'update' => ['تعديل باص', 'Update bus'],
            'delete' => ['حذف باص', 'Delete bus'],
        ],

        // صلاحيات الهدايا - إدارة الهدايا وتوزيعها
        'gifts' => [
            'view' => ['عرض الهدايا', 'View gifts'],
            'add' => ['إضافة هدية', 'Add gift'],
            'update' => ['تعديل هدية', 'Update gift'],
            'delete' => ['حذف هدية', 'Delete gift'],
            'distribution' => ['توزيع الهدايا', 'Gift distribution'],
            'hide_page' => ['اخفاء صفحة الهدايا وقائمة الهدايا', 'Hide gifts page and list'],
        ],

        // صلاحيات الخدمات - إدارة الخدمات المقدمة
        'services' => [
            'view' => ['عرض الخدمات', 'View services'],
            'add' => ['إضافة خدمة', 'Add service'],
            'update' => ['تعديل خدمة', 'Update service'],
            'delete' => ['حذف خدمة', 'Delete service'],
            'providing' => ['تقديم خدمة', 'Service providing'],
            'hide_page' => ['اخفاء صفحة الخدمات وقائمة الخدمات', 'Hide services page and list'],
        ],

        // صلاحيات المرفقات - إدارة الأساور والاستيكرات
        'attachments' => [
            'view' => ['عرض الأساور والإستيكرات', 'View attachments'],
            'add' => ['إضافة أساور واستيكرات', 'Add attachment'],
            'update' => ['تعديل أساور واستيكرات', 'Update attachment'],
            'delete' => ['حذف أساور واستيكرات', 'Delete attachment'],
            'print' => ['طباعة أساور واستيكرات', 'Print attachment'],
            'delivery' => ['تسليم أساور واستيكرات', 'Delivery attachment'],
            'show' => ['اظهار المرفقات', 'Show attachments'],
            'hide' => ['اخفاء المرفقات', 'Hide attachments'],
            'upload' => ['رفع المرفقات', 'Upload attachments'],
        ],

        // صلاحيات الموظفين - إدارة شؤون الموظفين
        'employees' => [
            'view' => ['عرض الموظفين', 'View employees'],
            'add' => ['إضافة موظف', 'Add employee'],
            'update' => ['تعديل موظف', 'Update employee'],
            'delete' => ['حذف موظف', 'Delete employee'],
            'archive' => ['ارشفة موظف', 'Archive employee'],
            'print_card' => ['طباعة بطاقة موظف', 'Print employee card'],
            'print_experience' => ['طباعة شهادة الخبرة', 'Print experience certificate'],
            'add_salary' => ['اضافة الراتب', 'Add salary'],
            'update_salary' => ['تعديل الراتب', 'Update salary'],
            'delete_salary' => ['حذف الراتب', 'Delete salary'],
            'deliver_salary' => ['تسليم راتب موظف', 'Delivery employee salary'],
            'show_salary' => ['اظهار راتب الموظف', 'Show employee salary'],
            'hide_salary' => ['اخفاء راتب الموظف', 'Hide employee salary'],
            'add_bonus' => ['اضافة مكافئة', 'Add bonus'],
            'update_bonus' => ['تعديل مكافئة', 'Update bonus'],
            'delete_bonus' => ['حذف مكافئة', 'Delete bonus'],
            'deliver_bonus' => ['تسليم المكافئة', 'Deliver bonus'],
            'show_bonus' => ['اظهار مكافئة الموظف', 'Show employee bonus'],
            'hide_bonus' => ['اخفاء مكافئة الموظف', 'Hide employee bonus'],
            'upload_id_image' => ['تحميل مرفقات صورة الهوية', 'Upload ID image'],
            'show_id_image' => ['اظهار مرفقات صورة الهوية', 'Show ID image'],
            'hide_id_image' => ['اخفاء مرفقات صورة الهوية', 'Hide ID image'],
            'show_id_date' => ['اظهار تاريخ هوية الموظف', 'Show employee ID date'],
            'hide_id_date' => ['اخفاء تاريخ هوية الموظف', 'Hide employee ID date'],
            'upload_photo' => ['رفع الصورة الشخصية للموظفين', 'Upload employee photo'],
            'upload_card_front' => ['رفع تصميم بطاقة الموظفين', 'Upload employee card front design'],
            'upload_card_back' => ['رفع تصميم البطاقة الخلفية للموظفين', 'Upload employee card back design'],

        ],

        // صلاحيات المباني - إدارة المباني
        'buildings' => [
            'view' => ['عرض البنايات', 'View buildings'],
            'add' => ['إضافة مبنى', 'Add building'],
            'update' => ['تعديل مبنى', 'Update building'],
            'delete' => ['حذف مبنى', 'Delete building'],
            'print' => ['طباعة المباني', 'Print building'],
        ],

        // صلاحيات الخيام - إدارة الخيام
        'tents' => [
            'add' => ['اضافة خيمة', 'Add tent'],
            'update' => ['تعديل خيمة', 'Update tent'],
            'delete' => ['حذف خيمة', 'Delete tent'],
            'add_beds' => ['اضافة عدد السرر في كل خيمة', 'Add beds count per tent'],
            'update_beds' => ['تعديل عدد السرر في كل خيمة', 'Update beds count per tent'],
            'add_type' => ['اضافة نوع الخيام رجال او نساء او خاصة', 'Add tent type (men/women/special)'],
            'update_type' => ['تعديل نوع الخيام رجال او نساء او خاصة', 'Update tent type (men/women/special)'],
            'add_bed_type' => ['اضافة نوع السرير مفرد ثنائي', 'Add bed type (single/double)'],
            'update_bed_type' => ['تعديل نوع السرير مفرد ثنائي', 'Update bed type (single/double)'],
            'add_capacity' => ['اضافة عدد الحجاج للخيمة', 'Add tent pilgrim capacity'],
            'update_capacity' => ['تعديل عدد الحجاج للخيمة', 'Update tent pilgrim capacity'],
        ],

        // صلاحيات القدوم والمغادرة - إدارة حركة الحجاج
        'arrival_departure' => [
            'add' => ['ادخال بيانات القدوم والمغادرة', 'Add arrival/departure data'],
            'update' => ['تعديل بيانات القدوم والمغادرة', 'Update arrival/departure data'],
            'delete' => ['حذف بيانات القدوم والمغادرة', 'Delete arrival/departure data'],
        ],

        // صلاحيات الأقسام الوظيفية - إدارة الأقسام
        'departments' => [
            'add' => ['اضافة قسم وظيفي', 'Add department'],
            'update' => ['تعديل قسم وظيفي', 'Update department'],
            'delete' => ['حذف قسم وظيفي', 'Delete department'],
        ],

        // صلاحيات المسميات الوظيفية - إدارة المسميات
        'job_titles' => [
            'add' => ['اضافة مسمى وظيفي', 'Add job title'],
            'update' => ['تعديل مسمى وظيفي', 'Update job title'],
            'delete' => ['حذف مسمى وظيفي', 'Delete job title'],
        ],
        'messaging' => [
            'whatsapp' => ['ارسال رسائل الواتساب', 'Send WhatsApp messages'],
            'sms' => ['ارسال رسائل SMS', 'Send SMS messages']
        ],
        'exports' => [
            'excel' => ['تصدير ملف اكسل', 'Export Excel file'],
            'pdf' => ['تصدير ملف PDF', 'Export PDF file']
        ],
        'table_columns' => [
            'toggle' => ['امكانية اظهار واخفاء الاعمدة في الجدول', 'Toggle table columns visibility']
        ],
        'reports' => [
            'show' => ['اظهار التقارير', 'Show reports'],
            'hide' => ['اخفاء التقارير', 'Hide reports']
        ],
        'stickers' => [
            'show_print' => ['اظهار خيار طباعة الاستكر', 'Show sticker print option'],
            'hide_print' => ['اخفاء خيار طباعة الاستكر', 'Hide sticker print option'],
            'select_fields' => ['اختيار حقول الاستكر', 'Select sticker fields']
        ],
        'maps' => [
            'add' => ['اضافة خرائط المخيمات والخيام والمرافق', 'Add camps, tents and facilities maps'],
            'update' => ['تعديل خرائط المخيمات والخيام والمرافق', 'Update camps, tents and facilities maps'],
            'delete' => ['حذف خرائط المخيمات والخيام والمرافق', 'Delete camps, tents and facilities maps'],
            'add_google_maps' => ['اضافة روابط قوقل ماب في المخيمات والخيام والمرافق', 'Add Google Maps links for camps, tents and facilities'],
            'update_google_maps' => ['تعديل روابط قوقل ماب في المخيمات والخيام والمرافق', 'Update Google Maps links for camps, tents and facilities'],
            'delete_google_maps' => ['حذف روابط قوقل ماب في المخيمات والخيام والمرافق', 'Delete Google Maps links for camps, tents and facilities']
        ],
        'print' => [
            'show_png' => ['اظهار خيار طباعة البطاقة png', 'Show PNG card print option'],
            'hide_png' => ['اخفاء خيار طباعة البطاقة png', 'Hide PNG card print option'],
            'show_pdf' => ['اظهار خيار طباعة البطاقة pdf', 'Show PDF card print option'],
            'hide_pdf' => ['اخفاء خيار طباعة البطاقة pdf', 'Hide PDF card print option'],
            'show_direct' => ['اظهار خيار طباعة البطاقة امر الطباعة المباشرة', 'Show direct print option'],
            'hide_direct' => ['اخفاء خيار طباعة البطاقة امر الطباعة المباشرة', 'Hide direct print option'],
            'count_show' => ['اظهار عدد مرات طباعة البطاقات لكل حاج وموظف', 'Show card print count per pilgrim and employee'],
            'count_hide' => ['اخفاء عدد مرات طباعة البطاقات لكل حاج وموظف', 'Hide card print count per pilgrim and employee']

        ],
        'notes' => [
            'add' => ['اضافة ملاحظات', 'Add notes']
        ],
    ];

    private array $defaultUsers = [
        'super_admin' => [
            'name' => 'Super Admin',
            'email' => 'info@dlaaz.com',
            'password' => 'Dlaaz_123@#',
        ],
        'admin' => [
            'name' => 'Admin',
            'email' => 'support@dalaaz.com',
            'password' => 'Dlaaz_123@#',
        ],
    ];

    public function run(): void
    {
        $this->createRoles();
        $this->createPermissions();
        $this->assignPermissionsToRoles();
        $this->createDefaultUsers();
    }

    private function createRoles(): void
    {
        foreach ($this->roles as $name => $attributes) {
            $roleData = ['guard_name' => 'web', 'name' => $name] + $attributes;
            Role::create($roleData);
        }
    }

    private function createPermissions(): void
    {
        foreach ($this->permissionGroups as $group => $permissions) {
            foreach ($permissions as $action => $labels) {
                $name = ($group === 'admin') ? 'admin_view' : "{$group}_{$action}";
                Permission::create([
                    'guard_name' => 'web',
                    'name' => $name,
                    'display_name' => $labels[0],
                    'display_name_en' => $labels[1],
                ]);
            }
        }
    }

    private function assignPermissionsToRoles(): void
    {
        $permissions = Permission::pluck('name')->toArray();
        Role::findByName('admin')->syncPermissions($permissions);
        Role::findByName('super_admin')->syncPermissions($permissions);
    }

    private function createDefaultUsers(): void
    {
        foreach ($this->defaultUsers as $role => $userData) {
            $user = User::create([
                'name' => $userData['name'],
                'email' => $userData['email'],
                'email_verified_at' => Carbon::now(),
                'password' => Hash::make($userData['password']),
            ]);
            
            $user->assignRole($role);
        }
    }
}