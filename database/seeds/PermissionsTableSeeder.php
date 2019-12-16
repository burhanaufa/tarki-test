<?php

use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $names = array('create-categories', 'read-categories', 'update-categories', 'delete-categories',
                        'create-posts', 'read-posts', 'update-posts', 'delete-posts',
                        'create-users', 'read-users', 'update-users', 'delete-users',
                        'create-roles', 'read-roles', 'update-roles', 'delete-roles',
                        'create-regions', 'read-regions', 'update-regions', 'delete-regions',
                        'create-comments', 'read-comments', 'update-comments', 'delete-comments',
                        'create-files', 'read-files', 'update-files', 'delete-files',
                        'update-configurations');

        for ($i=0; $i < sizeof($names); $i++) {
            DB::table('permissions')->insert([
                'name' => $names[$i],
                'created_at' => date('Y-m-d H:i:s'),
                'created_by' => ($i < 1) ? $i+1 : $i,
            ]);
        }
    }
}
