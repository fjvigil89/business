<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\User;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        //User::truncate();
        $faker = Faker::create();

        $password = Hash::make('12345678');

        User::create([
            'name'              => 'admin',
            'email'             => 'admin@gmail.com',
            'email_verified_at' => date('Y-m-d H:m:s'),
            'password'          => $password,            
            'activo'            => 1,            
            //'role_id'           => 1,            
            'created_at'        => date('Y-m-d H:m:s'),
            'updated_at'        => date('Y-m-d H:m:s')
        ]);
         
    }
}
