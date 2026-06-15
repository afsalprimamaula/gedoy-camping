<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        if (config('app.env') === 'production' || env('APP_ENV') === 'production') {
            \Illuminate\Support\Facades\URL::forceScheme('https');
        }

        if (\Schema::hasTable('settings')) {
            $settings = \App\Models\Setting::pluck('value', 'key')->all();
            view()->share('settings', $settings);
        }

        // Share cartCount globally across all views
        view()->composer('*', function ($view) {
            $cart = session()->get('cart', []);
            $cartCount = 0;
            if (is_array($cart)) {
                foreach ($cart as $item) {
                    $cartCount += $item['quantity'] ?? 0;
                }
            }
            $view->with('cartCount', $cartCount);
        });
    }
}
