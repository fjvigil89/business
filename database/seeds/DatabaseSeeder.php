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
        $this->call(RoleSeeder::class);
        //factory(App\Role::class, 5)->create();
        
        $this->call(UserSeeder::class);
        factory(App\User::class, 5)->create();
        
        
    }
}
