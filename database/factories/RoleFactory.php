<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Role;
use Faker\Generator as Faker;

$factory->define(Role::class, function (Faker $faker) {
    return [
        'name'              =>$faker->randomElement($array = array ('user','admin','cajero','bar','restaurant')),
        'activo'            => $faker->boolean,   
        'description'       => $faker->sentence($nbWords = 6, $variableNbWords = true),
        'created_at'        => date('Y-m-d H:m:s'),
        'updated_at'        => date('Y-m-d H:m:s')
    ];
});
