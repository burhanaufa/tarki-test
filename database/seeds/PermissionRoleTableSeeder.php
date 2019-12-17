<?php

use Illuminate\Database\Seeder;

class PermissionRoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=9; $i < 17; $i++) {
            DB::table('permission_role')->insert([
                'permission_id' => $i,
                'role_id' => 1,
                'created_by' => 1
            ]);
        }
    }
}
