<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\Company;
use Faker\Generator as Faker;

$factory->define(\App\Customer::class, function (Faker $faker) {
    return [
        'company_id' =>factory(Company::class)->create(),
        'name'=>$faker->name,
        'email'=>$faker->unique()->safeEmail,
        'active'=>1,
    ];
});

