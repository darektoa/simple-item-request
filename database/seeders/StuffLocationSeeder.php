<?php

namespace Database\Seeders;

use App\Models\StuffLocation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StuffLocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        StuffLocation::factory(10)->create();
    }
}
