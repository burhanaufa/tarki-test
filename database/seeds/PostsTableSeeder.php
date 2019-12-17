<?php

use Illuminate\Database\Seeder;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $titles = array('Title 1', 'Title 2', 'Title 3', 'Title 4');
        $headlines = array('Headline 1', 'Headline 2', 'Headline 3', 'Headline 4');
        $descriptions = array('Description 1', 'Description 2', 'Description 3', 'Description 4');
        $status = array('0', '1', '2', '0');

        for ($i=0; $i < sizeof($titles); $i++) {
            DB::table('posts')->insert([
                'category_id' => ($i < 1) ? $i+1 : $i,
                'title' => $titles[$i],
                'headline' => $headlines[$i],
                'description' => $descriptions[$i],
                'status' => $status[$i],
                'created_by' => ($i < 1) ? $i+1 : $i
            ]);
        }
    }
}
