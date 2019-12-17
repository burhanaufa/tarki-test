<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $names = array('News', 'Article', 'Announcement', 'Assignment');
        $slugs = array('news', 'article', 'announcement', 'assignment');
        $is_home = array('0', '1', '0', '1');
        $is_enable = array('0', '1', '0', '1');

        for ($i=0; $i < sizeof($names); $i++) {
            DB::table('categories')->insert([
                'category_name' => $names[$i],
                'slug' => $slugs[$i],
                'is_home' => $is_home[$i],
                'is_enable' => $is_enable[$i],
                'created_by' => ($i < 1) ? $i+1 : $i,
            ]);
        }
    }
}
