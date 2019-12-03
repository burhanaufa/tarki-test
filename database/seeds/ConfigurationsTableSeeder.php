<?php

use Illuminate\Database\Seeder;

class ConfigurationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $config_names = array('Project Name', 'Address', 'Phone', 'Email', 'Tagline', 'Logo');
        $descriptions = array('Project Name Description', 'Address Description', 'Phone Description', 'Email Description', 'Tagline Description', 'Logo Description');

        for ($i=0; $i < sizeof($config_names); $i++) {
            DB::table('configurations')->insert([
                'config_name' => $config_names[$i],
                'description' => $descriptions[$i],
                'created_by' => ($i < 1) ? $i+1 : $i,
            ]);
        }
    }
}
