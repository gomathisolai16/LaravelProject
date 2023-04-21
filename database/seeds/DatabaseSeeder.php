<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Illuminate\Database\Eloquent\Model::unguard();
        $this->call(UserTableSeeder::class);
        $this->call(ThemesTableSeeder::class);
        $this->call(DashboardTableSeeder::class);
        $this->call(CategoryTableSeeder::class);
        $this->call(ModuleTableSeeder::class);
        $this->call(SettingsTableSeeder::class);
        $this->call(RoleTableSeeder::class);
        $this->call(PermissionTableSeeder::class);
        //$this->call(NewsTableSeeder::class);
        //$this->call(TickerTableSeeder::class);
        // $this->call(ImageTableSeeder::class);
        \Illuminate\Database\Eloquent\Model::reguard();
    }
}
