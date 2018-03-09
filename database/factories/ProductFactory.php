<?php

use Faker\Generator as Faker;

$factory->define(App\Product::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence(4),
        'slug' => $faker->unique()->slug,
        'barcode' => $faker->ean8,
        'description' => $faker->text,
        'published' => $faker->boolean($chanceOfGettingTrue = 90),
        'price' => $faker->randomFloat(2, 9.99, 9999.99),
        'image' => $faker->imageUrl,
        'user_id' => function () {
            return factory(App\User::class)->create()->id;
        }
    ];
});
