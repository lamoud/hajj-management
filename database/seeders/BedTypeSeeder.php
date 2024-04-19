<?php

namespace Database\Seeders;

use App\Models\BedType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BedTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        BedType::create(['name' => 'فردي', 'slug' => 'single', 'description' => 'Single bed', 'extra' => null]);
        BedType::create(['name' => 'ثنائي', 'slug' => 'double', 'description' => 'Double bed', 'extra' => null]);
        BedType::create(['name' => 'دورين', 'slug' => 'twin', 'description' => 'Twin bed', 'extra' => null]);
    }
}
