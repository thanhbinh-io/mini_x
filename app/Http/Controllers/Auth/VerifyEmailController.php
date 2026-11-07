<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Verified;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response;

class VerifyEmailController extends Controller
{
    /**
     * Mark the user's email address as verified and show success landing page.
     */
    public function __invoke(Request $request, $id, $hash): Response
    {
        $user = User::findOrFail($id);

        if (! hash_equals((string) $hash, sha1($user->getEmailForVerification()))) {
            abort(403, 'Liên kết xác thực không hợp lệ hoặc đã hết hạn.');
        }

        $alreadyVerified = $user->hasVerifiedEmail();

        if (! $alreadyVerified) {
            if ($user->markEmailAsVerified()) {
                event(new Verified($user));
            }
        }

        // Logout any active session so the user doesn't jump directly into the account
        if (Auth::check()) {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
        }

        return Inertia::render('Auth/VerifySuccess', [
            'alreadyVerified' => $alreadyVerified,
            'email' => $user->email,
            'name' => $user->name,
        ]);
    }
}
