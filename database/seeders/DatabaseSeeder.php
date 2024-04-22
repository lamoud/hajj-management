<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $this->call(RolesSeeder::class);
        $this->call(SettingsSeeder::class);
        $this->call(BedTypeSeeder::class);
        $this->call(UnitTypeSeeder::class);
        $this->call(NationalitySeeder::class);
        $this->call(NotificationTemplatesSeeder::class);
    }
}
