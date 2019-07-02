<?php

namespace Laragems\SambSms;

use Illuminate\Support\ServiceProvider;

class LaragemsSambsmsProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->publishes([
            __DIR__ . '/Config/laragems_sambsms.php' => config('laragems_sambsms.php')
        ]);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
