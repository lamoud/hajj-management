<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class NotificationTemplatesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('notification_templates')->truncate();

        $templates = [
            [
                'name' => 'تحقق من البريد الإلكتروني',
                'content' => null,
                'subject' => 'تحقق من البريد الإلكتروني',
                'body' => 'مرحبًا [username]، يرجى تأكيد عنوان بريدك الإلكتروني عن طريق النقر على الرابط أدناه: [verification_url]',
                'sms_body' => null,
                'database_body' => 'مرحبًا [username]، يرجى تأكيد عنوان بريدك الإلكتروني عن طريق النقر على الرابط أدناه: [verification_url]',
                'whatsapp_body' => null,
                'to_sms' => false,
                'to_database' => true,
                'to_email' => true,
                'to_whatsapp' => false,
                'slug' => 'email-verification',
                'extra' => null,
            ],
            [
                'name' => 'رسالة الترحيب',
                'content' => null,
                'subject' => 'مرحبًا في تطبيقنا',
                'body' => 'مرحبًا في تطبيقنا، [username]! نحن مسرورون بوجودك معنا ونأمل أن تستمتع بتجربتك.',
                'sms_body' => null,
                'database_body' => 'مرحبًا في تطبيقنا، [username]! نحن مسرورون بوجودك معنا ونأمل أن تستمتع بتجربتك.',
                'whatsapp_body' => null,
                'to_sms' => false,
                'to_database' => true,
                'to_email' => true,
                'to_whatsapp' => false,
                'slug' => 'welcome-message',
                'extra' => null,
            ],
            [
            'name' => 'استكمال الملف الشخصي',
            'content' => null,
            'subject' => 'استكمال الملف الشخصي',
            'body' => 'مرحبًا [username]، يرجى استكمال ملفك الشخصي لضمان أفضل تجربة معنا.',
            'sms_body' => null,
            'database_body' => 'مرحبًا [username]، يرجى استكمال ملفك الشخصي لضمان أفضل تجربة معنا.',
            'whatsapp_body' => null,
            'to_sms' => false,
            'to_database' => true,
            'to_email' => true,
            'to_whatsapp' => false,
            'slug' => 'complete-profile',
            'extra' => null,
            ],
        ];

        
        DB::table('notification_templates')->insert($templates);
    }
}
