<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Validator;

class ValidatorServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        Validator::extend('check_array', function ($attribute, $value, $parameters, $validator) {
            $count = 0;
            foreach ($value as $a) {
                if ($a) {
                    $count++;
                }
            }

            if ($count >= (int)$parameters[0]) {
                return true;
            }

            return false;
        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
