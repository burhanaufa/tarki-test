<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'username' => 'administrator',
            'email' => 'administrator@gmail.com',
            'full_name' => 'administrator tarakanita',
            'password' => bcrypt('password'),
            'created_by' => '1'
        ]);
    }
}
