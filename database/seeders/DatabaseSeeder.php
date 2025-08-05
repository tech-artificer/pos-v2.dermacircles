<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Branch;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Branch::firstOrCreate([
            'name' => 'Warehouse',
            'location' => 'Main'
        ]);

        Branch::firstOrCreate([
            'name' => 'Re-enhance - Robinsons',
            'location' => 'Robinsons Butuan'
        ]);

        Branch::firstOrCreate([
            'name' => 'Re-enhance - San Franz',
            'location' => 'San Franz'
        ]);

        Branch::firstOrCreate([
            'name' => 'DermaCircles - SM Butuan',
            'location' => 'SM Butuan'
        ]);

        User::firstOrCreate(
            ['email' => 'angeligarciamd1@gmail.com'],
            [
                'name' => 'Angeli Garcia MD',
                'password' => bcrypt('password'),
                'is_admin' => true,
            ]
        );

        User::firstOrCreate(
            ['email' => 'ryanpastoriza@gmail.com'],
            [
                'name' => 'RP',
                'password' => bcrypt('password'),
                'is_admin' => true,
            ]
        );

    }
}
