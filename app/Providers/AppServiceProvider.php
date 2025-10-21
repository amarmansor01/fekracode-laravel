<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL; // ✅ هذا السطر ضروري

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
    public function boot()
    {
        if (config('app.env') === 'production') {
            URL::forceScheme('https');
        }

        \Log::info('Cloudinary Config', [
        'CLOUD_NAME' => env('CLOUDINARY_CLOUD_NAME'),
        'API_KEY'    => env('CLOUDINARY_API_KEY'),
        'API_SECRET' => env('CLOUDINARY_API_SECRET') ? '*** موجودة ***' : '❌ فارغة',
        ]);

    }
}
