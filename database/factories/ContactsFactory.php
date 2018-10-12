<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\Contact::class, function (Faker $faker) {

    $contacts_types_ids = \App\ContactType::all()->pluck('id');

    return [
        'contact_type_id' => $faker->randomElement($contacts_types_ids),
        'info' => \Illuminate\Support\Str::random(16),
    ];
});
