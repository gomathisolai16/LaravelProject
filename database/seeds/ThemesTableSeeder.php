<?php

use Illuminate\Database\Seeder;

class ThemesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $date = \Carbon\Carbon::now()->toDateTimeString();
        $insertData = [
            [
                'name' => 'Dark theme',
                'abbreviation' => 'dark',
                'active' => 1,
                'created_at' => $date,
                'updated_at' => $date
            ],
            [
                'name' => 'Light theme',
                'abbreviation' => 'light',
                'active' => 1,
                'created_at' => $date,
                'updated_at' => $date
            ]
        ];

        try{
            \App\Models\Theme::insert($insertData);
        }catch (\Exception $exception){

        }
    }
}
