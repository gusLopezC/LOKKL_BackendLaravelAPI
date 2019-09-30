<?php

namespace App\Providers;


use App\User;
use App\Mail\UserCreated;

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;


class AppServiceProvider extends ServiceProvider
{

     /**
     * Bootstrap any application services.
     *
     * @return void
     */
     public function boot()
     {
         //
         Schema::defaultStringLength(191);
 
 
         /* User::created(function($user){

            Mail::to($user->email)->send(new UserCreated($user));
          
          });*/

          User::updated(function($user){
           if($user->isDirty('email')){
           retry(5, function() use ($user){
            Mail::to($user->email)->send(new UserCreated($user));
           },100);
           }
        });
     }
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

   
}
