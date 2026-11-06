<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class EmailVerificationNotificationController extends Controller
{
    /**
     * Send a new email verification notification.
     */
    public function store(Request $request): RedirectResponse
    {
        if ($request->user()->hasVerifiedEmail()) {
            return redirect()->intended(route('dashboard', absolute: false));
        }

        try {
            $request->user()->sendEmailVerificationNotification();
            return back()->with('status', 'verification-link-sent');
        } catch (\Throwable $e) {
            \Illuminate\Support\Facades\Log::warning('Resend email verification failed: ' . $e->getMessage());
            return back()->with('error', 'Không thể kết nối máy chủ gửi email. Vui lòng kiểm tra lại cấu hình MAIL trong .env hoặc dùng nút kích hoạt nhanh.');
        }
    }
}
