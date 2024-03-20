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
            [
                'name' => 'إجابة على الاستبيان',
                'content' => null,
                'subject' => 'إجابة على الاستبيان',
                'body' => 'مرحبًا [username]، برجاء الإجابة على الإستبيان التالي: [survey_url] لاستكمال بياناتك.',
                'sms_body' => null,
                'database_body' => 'مرحبًا [username]، شكرًا لإجابتك على الاستبيان. نحن نقدر مساهمتك وتعاونك.',
                'whatsapp_body' => null,
                'to_sms' => false,
                'to_database' => true,
                'to_email' => true,
                'to_whatsapp' => false,
                'slug' => Str::slug('survey-response'),
                'extra' => null,
            ],
            [
                'name' => 'طلب رفع ملف PDF',
                'content' => null,
                'subject' => 'طلب رفع ملف PDF',
                'body' => 'مرحبًا [username]، نحتاج إلى ملف PDF منك. يرجى رفع الملف عبر الرابط التالي: [upload_url]',
                'sms_body' => null,
                'database_body' => 'مرحبًا [username]، نحتاج إلى ملف PDF منك. يرجى رفع الملف عبر الرابط التالي: [upload_url]',
                'whatsapp_body' => null,
                'to_sms' => false,
                'to_database' => true,
                'to_email' => true,
                'to_whatsapp' => false,
                'slug' => Str::slug('request-upload-pdf'),
                'extra' => null,
            ],
            [
                'name' => 'تغيير صلاحية المدرس',
                'content' => null,
                'subject' => 'لقد أصبحت مدرب',
                'body' => 'مرحبًا [username]، تم تغيير صلاحيتك إلى مدرس. نتمنى لك تجربة ممتعة!',
                'sms_body' => null,
                'database_body' => 'مرحبًا [username]، تم تغيير صلاحيتك إلى مدرس. نتمنى لك تجربة ممتعة!',
                'whatsapp_body' => null,
                'to_sms' => false,
                'to_database' => true,
                'to_email' => true,
                'to_whatsapp' => false,
                'slug' => Str::slug('teacher-role-changed'),
                'extra' => null,
            ],
            [
                'name' => 'قبول الطالب',
                'content' => null,
                'subject' => 'تهانينا! لقد تم قبولك',
                'body' => 'مرحبًا [username]، نحن نسرّ بإعلامك أنك قد تم قبولك كطالب في [specializationname]. نتطلع إلى رحب بك في مجتمعنا!',
                'sms_body' => null,
                'database_body' => 'مرحبًا [username]، نحن نسرّ بإعلامك أنك قد تم قبولك كطالب في [specializationname]. نتطلع إلى رحب بك في مجتمعنا!',
                'whatsapp_body' => null,
                'to_sms' => false,
                'to_database' => true,
                'to_email' => true,
                'to_whatsapp' => false,
                'slug' => Str::slug('student-accepted'),
                'extra' => null,
            ],
            [
                'name' => 'ترقية الطالب',
                'content' => null,
                'subject' => 'تهانينا على الترحيل',
                'body' => 'مرحبًا [username]، تهانينا! نود إبلاغك بأن [username] قد تم ترقيته إلى [levelname] في [specializationname]. نتمنى له مستقبلًا ناجحًا.',
                'sms_body' => null,
                'database_body' => 'مرحبًا [username]، تهانينا! نود إبلاغك بأن [username] قد تم ترقيته إلى [levelname] في [specializationname]. نتمنى له مستقبلًا ناجحًا.',
                'whatsapp_body' => null,
                'to_sms' => false,
                'to_database' => true,
                'to_email' => true,
                'to_whatsapp' => false,
                'slug' => Str::slug('student-promotion'),
                'extra' => null,
            ],
        ];

        
        DB::table('notification_templates')->insert($templates);
    }
}
