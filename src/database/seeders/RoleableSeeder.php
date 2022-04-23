<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::transaction(function () {
            $this->call([
                PermissionsTableSeeder::class,
                SubPermissionsTableSeeder::class,
                RolesTableSeeder::class,
             ]);
        });
    }
}
