<?php

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
        $this->call([
            UsersTableSeeder::class,
            ConfigurationsTableSeeder::class,
            CategoriesTableSeeder::class,
            PostsTableSeeder::class,
            CommentsTableSeeder::class,
            RolesTableSeeder::class,
            PermissionsTableSeeder::class,
            RoleUserTableSeeder::class,
            PermissionRoleTableSeeder::class
        ]);
    }
}
