<?php

namespace App\Providers;

use Illuminate\Support\Facades\Vite;
use Illuminate\Support\ServiceProvider;
use Illuminate\Validation\Rules\Password;

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
        Vite::prefetch(concurrency: 3);

        // Quy chuẩn mật khẩu: 8-16 ký tự, ít nhất 1 chữ hoa, 1 chữ thường và 1 ký tự đặc biệt
        Password::defaults(function () {
            return Password::min(8)
                ->max(16)
                ->mixedCase()
                ->symbols();
        });
    }
}
