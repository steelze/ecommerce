<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer(
            [
                'welcome',
                'user.shop',
                'user.cart',
                'user.order',
                'auth.login',
                'user.profile',
                'user.payment',
                'user.product',
                'user.checkout',
                'user.transaction',
                'auth.register',
                'auth.admin.login'
            ],
            'App\Http\ViewComposers\CategoryComposer'
        );
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
