<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\DancePlace;

class DancePlaceSeeder extends Seeder
{
    public function run(): void
    {
        DancePlace::insert([
            [
                'name' => 'Studio Beginner',
                'location' => 'Jakarta',
                'price_per_hour' => 75000,
                'description' => 'Studio nyaman untuk latihan dasar.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Studio Premium',
                'location' => 'Jakarta',
                'price_per_hour' => 150000,
                'description' => 'Studio luas untuk latihan tim.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Studio Practice',
                'location' => 'Jakarta',
                'price_per_hour' => 100000,
                'description' => 'Studio untuk latihan koreografi.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
