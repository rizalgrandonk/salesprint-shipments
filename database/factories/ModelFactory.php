<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(Brackets\AdminAuth\Models\AdminUser::class, function (Faker\Generator $faker) {
    return [
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'email' => $faker->email,
        'password' => bcrypt($faker->password),
        'remember_token' => null,
        'activated' => true,
        'forbidden' => $faker->boolean(),
        'language' => 'en',
        'deleted_at' => null,
        'created_at' => $faker->dateTime,
        'updated_at' => $faker->dateTime,
        'last_login_at' => $faker->dateTime,

    ];
});/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\Shipment::class, static function (Faker\Generator $faker) {
    return [
        'awb' => $faker->sentence,
        'courier' => $faker->sentence,
        'service' => $faker->sentence,
        'status' => $faker->sentence,
        'desc' => $faker->sentence,
        'amount' => $faker->randomNumber(5),
        'weight' => $faker->randomNumber(5),
        'origin' => $faker->sentence,
        'destination' => $faker->sentence,
        'shipper' => $faker->sentence,
        'receiver' => $faker->sentence,
        'created_at' => $faker->dateTime,
        'updated_at' => $faker->dateTime,


    ];
});
/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(Brackets\AdminAuth\Models\AdminUser::class, function (Faker\Generator $faker) {
    return [
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'email' => $faker->email,
        'password' => bcrypt($faker->password),
        'remember_token' => null,
        'activated' => true,
        'forbidden' => $faker->boolean(),
        'language' => 'en',
        'deleted_at' => null,
        'created_at' => $faker->dateTime,
        'updated_at' => $faker->dateTime,
        'last_login_at' => $faker->dateTime,
        
    ];
});/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\Province::class, static function (Faker\Generator $faker) {
    return [
        'province_id' => $faker->sentence,
        'province' => $faker->sentence,
        'created_at' => $faker->dateTime,
        'updated_at' => $faker->dateTime,
        
        
    ];
});
/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\City::class, static function (Faker\Generator $faker) {
    return [
        'province_id' => $faker->sentence,
        'province' => $faker->sentence,
        'city_id' => $faker->sentence,
        'city_name' => $faker->sentence,
        'created_at' => $faker->dateTime,
        'updated_at' => $faker->dateTime,
        
        
    ];
});
/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\District::class, static function (Faker\Generator $faker) {
    return [
        'province_id' => $faker->sentence,
        'province' => $faker->sentence,
        'city_id' => $faker->sentence,
        'city_name' => $faker->sentence,
        'district_id' => $faker->sentence,
        'district_name' => $faker->sentence,
        'created_at' => $faker->dateTime,
        'updated_at' => $faker->dateTime,
        
        
    ];
});
