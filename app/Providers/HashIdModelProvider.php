<?php

namespace App\Providers;

use App\Models\User;
use Hashids\Hashids;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class HashIdModelProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        User::created(function ($model) {
            $generator = new Hashids(User::class, 10);
            $model->url_string = $generator->encode($model->id);
            $model->save();
        });

        Route::bind('user', function ($value) {
            return User::where('url_string', $value)->first();
        });
    }
}
