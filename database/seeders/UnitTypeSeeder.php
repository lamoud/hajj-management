<?php

namespace Database\Seeders;

use App\Models\UnitType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UnitTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        UnitType::create(['name' => 'رجال', 'slug' => 'men', 'description' => 'رجال', 'extra' => null]);
        UnitType::create(['name' => 'نساء', 'slug' => 'women', 'description' => 'نساء', 'extra' => null]);
        UnitType::create(['name' => 'أصدقاء اناث', 'slug' => 'female-friends', 'description' => 'أصدقاء اناث', 'extra' => null]);
        UnitType::create(['name' => 'أصدقاء ذكور', 'slug' => 'male-friends', 'description' => 'أصدقاء ذكور', 'extra' => null]);
        UnitType::create(['name' => 'أفراد رجال', 'slug' => 'male-individuals', 'description' => 'أفراد رجال', 'extra' => null]);
        UnitType::create(['name' => 'أفراد نساء', 'slug' => 'female-individuals', 'description' => 'أفراد نساء', 'extra' => null]);

    }
}
