<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Setting::upsert(
            [
                ['key'=>'appName', 'value'=> config('app.name')],
                ['key'=>'appDisc', 'value'=> config('app.name')],
                ['key'=>'appMail', 'value'=> 'betalamoud@gmail.com'],
                ['key'=>'appMobile', 'value'=> '+201062332549'],
                ['key'=>'appAddress', 'value'=> 'المملكة العربية السعودية'],
                ['key'=>'appDisc', 'value'=> 'إدارة الحجاج والموظفين.'],
                ['key'=>'appNewAccount', 'value'=> '1'],
                ['key'=>'appDefaultRole', 'value'=> ' user'],
                ['key'=>'appPolicy', 'value'=> ''],
                ['key'=>'appTerms', 'value'=> '']
            ],'key'
        );
    }
}
