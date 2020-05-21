<?php

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

        //for ($i=0; $i < 4; ) {
            DB::table('roles')->insert(array(
                'name'              =>$faker->randomElement($array = array ('user','admin','cajero','bar','restaurant')),
                'activo'            => $faker->boolean,   
                'description'       => $faker->sentence($nbWords = 6, $variableNbWords = true),
                'created_at'        => date('Y-m-d H:m:s'),
                'updated_at'        => date('Y-m-d H:m:s')
            ));
        //}
    }
}
