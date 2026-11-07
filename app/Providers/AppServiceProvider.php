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

        // Tạo link đặt lại mật khẩu với host & port chính xác từ trình duyệt đang sử dụng
        \Illuminate\Auth\Notifications\ResetPassword::createUrlUsing(function ($notifiable, string $token) {
            $request = request();
            $baseUrl = config('app.url');

            if ($request && $request->getHttpHost()) {
                $scheme = $request->getScheme();
                $httpHost = $request->getHttpHost();
                $baseUrl = "{$scheme}://{$httpHost}";
            }

            return rtrim($baseUrl, '/') . route('password.reset', [
                'token' => $token,
                'email' => $notifiable->getEmailForPasswordReset(),
            ], false);
        });
    }
}
