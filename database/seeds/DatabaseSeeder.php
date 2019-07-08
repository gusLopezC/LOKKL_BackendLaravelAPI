<?php


use App\User;
use App\Category;
use App\Product;
use App\Transaction;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
		Eloquent::unguard();

		//disable foreign key check for this connection before running seeders
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        
        User::truncate();
        Category::truncate();
        Product::truncate();
        Transaction::truncate();


        $cantidadUsuarios = 200;
        $cantidadCategorias = 10;
        $cantidadTransacciones = 2000;

        factory(User::class, $cantidadUsuarios)->create();
        factory(Category::class, $cantidadCategorias)->create();

        factory(Product::class, $cantidadCategorias)->create()->each(
            function($producto){
                $categorias = Category::all()->random(mt_rand(1,5))->pluck('id');
            
                $producto-> categories()->attach($categorias->first());
            }
        );

       factory(Transaction::class, $cantidadTransacciones)->create();

    }
    
}
