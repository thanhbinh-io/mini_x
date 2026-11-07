<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;
use Inertia\Inertia;
use Inertia\Response;

class NewPasswordController extends Controller
{
    /**
     * Display the password reset view.
     */
    public function create(Request $request): Response
    {
        return Inertia::render('Auth/ResetPassword', [
            'email' => $request->email,
            'token' => $request->route('token'),
        ]);
    }

    /**
     * Handle an incoming new password request.
     *
     * @throws ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // Here we will attempt to reset the user's password. If it is successful we
        // will update the password on an actual user model and persist it to the
        // database. Otherwise we will parse the error and return the response.
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user) use ($request) {
                $user->forceFill([
                    'password' => Hash::make($request->password),
                    'remember_token' => Str::random(60),
                ])->save();

                event(new PasswordReset($user));
            }
        );

        // Đặt lại mật khẩu thành công -> Tự động đăng nhập và chuyển hướng thẳng vào Trang chủ
        if ($status == Password::PASSWORD_RESET) {
            $user = User::where('email', $request->email)->first();
            if ($user) {
                Auth::login($user);
                $request->session()->regenerate();
            }

            return redirect()->route('tweets.index')->with('success', 'Mật khẩu đã được đặt lại thành công!');
        }

        $errorMsg = trans($status);
        if ($status === Password::INVALID_TOKEN) {
            $errorMsg = 'Liên kết đặt lại mật khẩu đã hết hạn hoặc không hợp lệ. Vui lòng yêu cầu lại.';
        } elseif ($status === Password::INVALID_USER) {
            $errorMsg = 'Không tìm thấy tài khoản với email này.';
        }

        throw ValidationException::withMessages([
            'email' => [$errorMsg],
        ]);
    }
}
