<?php

/** @var \Illuminte\Database\Eloquent\Factory $factory */
use App\User;
use App\Category;
use App\Product;
use App\Transaction;
use App\Seller;

use Illuminate\Support\Str;
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

$factory->define(User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'img' => $faker->randomElement(['1.jpg','2.jpg','3.jpg']),
        'remember_token' => Str::random(10),
        'verified' => $verificado = $faker->randomElement([true,false]),
        "verification_token" => $verificado == User::USUARIO_VERIFICADO ? null : User::generarToken(),
        'role' => $faker->randomElement(['USER_ROLE','GUIDE_ROLE'])

    ];
});


$factory->define(Category::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'description' => $faker->paragraph(1),

    ];
});

$factory->define(Product::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'description' => $faker->paragraph(1),
        'location' => $faker->word,
        'cost' => $faker->numberBetween(1,10000),
        'calification'  => $faker->numberBetween(1,5),
        'status' => $faker->randomElement([true,false]),
        'image' => $faker->randomElement(['1.jpg','2.jpg','3.jpg']),
        'seller_id' => User::all()->random()->id,

    ];
});


$factory->define(Transaction::class, function (Faker $faker) {

    $vendedor = Seller::has('products')->get()->random();
    $comprador = User::all()->except($vendedor->id)->random();
    
    
    return [
        'quantity' => $faker->numberBetween(1,5),
        'buyer_id' => $comprador->id,
        'product_id' => $vendedor->products->random()->id,

    ];
});
 


