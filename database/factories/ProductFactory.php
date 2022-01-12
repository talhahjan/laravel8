<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Product;
use Faker\Generator as Faker;
use Illuminate\Support\Arr;

$factory->define(Product::class, function (Faker $faker) {
    $title=$faker->unique()->sentence(30);
    $sizes=config('services.sizes');
    $colors=config('services.colors');

    return [
        'title'=>$title,
        'description'=>$faker->paragraph,
        'price' => $faker->numberBetween($min = 1500, $max = 6000),
        'discount_price'=>$faker->numberBetween($min = 100, $max = 500),
        'discount'=>$faker->numberBetween($min = 0, $max = 1),
        'color'=> $faker->randomElement(['Black', 'Brown','Dark Brown', 'Blue',' Navy Blue','Purple', 'Pink', 'Dark Pink','White','Gray','Green','Red','Orange','Fown','Mustard']),
        'stock'=>'6-2,7-2,8-2,9-2,10-11,12-2',
        'size_range'=>'36-39',
        'slug'=>strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $title))),
        'brand_id'=>$faker->numberBetween($min = 1, $max = 10),
        'status'=>$faker->numberBetween($min = 0, $max = 1),
        'created_at'=>now(),
    ];
});
