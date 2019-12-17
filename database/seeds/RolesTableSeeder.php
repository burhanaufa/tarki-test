<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $names = array('Superadministrator', 'Administrator', 'Admin-region', 'Admin-school');

        for ($i=0; $i < sizeof($names); $i++) {
            DB::table('roles')->insert([
                'role_name' => $names[$i],
                'created_by' => ($i < 1) ? $i+1 : $i,
            ]);
        }
    }
}
