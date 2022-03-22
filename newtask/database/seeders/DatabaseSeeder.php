<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory(5)->create();
        \App\Models\project::factory(10)->create();
        \App\Models\tasks::factory(25)->create();
        \App\Models\projectuser::factory(20)->create();
    }
}
