<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Mabrouk\PermissionSimple\Helpers\RouteInvestigator;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $investigator = new RouteInvestigator();
        $investigator->createPermissions()->map(function ($permission) {
            $permission->translate([
                'display_name' => $permission->name,
            ], 'en');
            return $permission->refresh();
        });
    }
}
