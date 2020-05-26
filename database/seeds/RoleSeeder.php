<?php

use App\Role;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {       
        $faker = Faker::create();
        
         Role::create([
            'name'              =>'user',
            'activo'            => $faker->boolean,   
            'description'       => $faker->sentence($nbWords = 6, $variableNbWords = true),
            'created_at'        => date('Y-m-d H:m:s'),
            'updated_at'        => date('Y-m-d H:m:s')          
        ]);
         Role::create([
            'name'              => 'admin',
            'activo'            => $faker->boolean,   
            'description'       => $faker->sentence($nbWords = 6, $variableNbWords = true),
            'created_at'        => date('Y-m-d H:m:s'),
            'updated_at'        => date('Y-m-d H:m:s')          
        ]);
         Role::create([
            'name'              =>'cajero',
            'activo'            => $faker->boolean,   
            'description'       => $faker->sentence($nbWords = 6, $variableNbWords = true),
            'created_at'        => date('Y-m-d H:m:s'),
            'updated_at'        => date('Y-m-d H:m:s')          
        ]);
         Role::create([
            'name'              =>'bar',
            'activo'            => $faker->boolean,   
            'description'       => $faker->sentence($nbWords = 6, $variableNbWords = true),
            'created_at'        => date('Y-m-d H:m:s'),
            'updated_at'        => date('Y-m-d H:m:s')          
        ]);
         Role::create([
            'name'              =>'restaurant',
            'activo'            => $faker->boolean,   
            'description'       => $faker->sentence($nbWords = 6, $variableNbWords = true),
            'created_at'        => date('Y-m-d H:m:s'),
            'updated_at'        => date('Y-m-d H:m:s')          
        ]);
        
    }
}
