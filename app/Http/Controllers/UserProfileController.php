<?php

namespace App\Http\Controllers;

use App\Models\Tweet;
use App\Models\User;
use App\Support\ReservedUsernames;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class UserProfileController extends Controller
{
    /**
     * Display the specified user's profile with filtered tabs.
     */
    public function show(Request $request, string $username): Response
    {
        if (ReservedUsernames::isReserved($username)) {
            abort(404);
        }

        $user = User::where('username', $username)
            ->withCount(['followers', 'following', 'tweets'])
            ->firstOrFail();

        $currentUser = $request->user();
        $currentUserId = $currentUser?->id;

        $isFollowing = $currentUser ? $currentUser->isFollowing($user) : false;
        $isBlocked = $currentUser ? $currentUser->hasBlocked($user) : false;
        $isMuted = $currentUser ? $currentUser->hasMuted($user) : false;
        $isBlockedBy = $currentUser ? $user->hasBlocked($currentUser) : false;

        $tab = $request->query('tab', 'tweets');

        $tweets = collect();

        if (! $isBlocked && ! $isBlockedBy) {
            if ($tab === 'replies') {
                $tweets = Tweet::where('user_id', $user->id)
                    ->whereNotNull('parent_id')
                    ->withInteractionDetails($currentUserId)
                    ->orderByDesc('id')
                    ->get();
            } elseif ($tab === 'media') {
                $tweets = Tweet::where('user_id', $user->id)
                    ->whereNotNull('file')
                    ->withInteractionDetails($currentUserId)
                    ->orderByDesc('id')
                    ->get();
            } elseif ($tab === 'likes') {
                $tweets = $user->likedTweets()
                    ->withInteractionDetails($currentUserId)
                    ->orderByDesc('likes.id')
                    ->get();
            } else {
                // Default 'tweets' tab
                $tweets = Tweet::where('user_id', $user->id)
                    ->whereNull('parent_id')
                    ->withInteractionDetails($currentUserId)
                    ->orderByDesc('id')
                    ->get();
            }
        }

        return Inertia::render('Profile/Show', [
            'profileUser' => $user,
            'currentTab' => $tab,
            'tweets' => $tweets,
            'isFollowing' => $isFollowing,
            'isBlocked' => $isBlocked,
            'isMuted' => $isMuted,
            'isBlockedBy' => $isBlockedBy,
        ]);
    }

    /**
     * Update the authenticated user's profile details and upload avatar/banner.
     */
    public function update(Request $request)
    {
        $user = $request->user();

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'bio' => ['nullable', 'string', 'max:280'],
            'location' => ['nullable', 'string', 'max:100'],
            'website' => ['nullable', 'string', 'max:100'],
            'birthdate' => ['nullable', 'date'],
            'avatar' => ['nullable', 'file', 'mimes:jpg,jpeg,png', 'max:5120'],
            'banner' => ['nullable', 'file', 'mimes:jpg,jpeg,png', 'max:10240'],
        ]);

        $user->name = $request->input('name');
        $user->bio = $request->input('bio');
        $user->location = $request->input('location');
        $user->website = $request->input('website');
        $user->birthdate = $request->input('birthdate');

        $oldAvatar = null;
        $oldBanner = null;

        // Handle avatar upload
        if ($request->hasFile('avatar')) {
            $oldAvatar = $user->avatar_path;
            $avatarFile = $request->file('avatar');
            $extension = $avatarFile->guessExtension() ?: ($avatarFile->extension() ?: 'jpg');
            $avatarName = \Illuminate\Support\Str::random(40) . '.' . $extension;
            $savedPath = $avatarFile->storeAs('avatars', $avatarName, 'public');
            $user->avatar_path = '/storage/' . $savedPath;
        }

        // Handle banner upload
        if ($request->hasFile('banner')) {
            $oldBanner = $user->banner_path;
            $bannerFile = $request->file('banner');
            $extension = $bannerFile->guessExtension() ?: ($bannerFile->extension() ?: 'jpg');
            $bannerName = \Illuminate\Support\Str::random(40) . '.' . $extension;
            $savedPath = $bannerFile->storeAs('banners', $bannerName, 'public');
            $user->banner_path = '/storage/' . $savedPath;
        }

        $user->save();

        // Safely delete previous image files only after database persistence succeeds
        if ($oldAvatar) {
            $this->deleteOldImage($oldAvatar, 'avatars');
        }
        if ($oldBanner) {
            $this->deleteOldImage($oldBanner, 'banners');
        }

        return redirect()->back();
    }

    /**
     * Safely delete an existing user image from storage or legacy paths.
     */
    protected function deleteOldImage(?string $path, string $type): void
    {
        if (empty($path) || str_starts_with($path, 'http://') || str_starts_with($path, 'https://')) {
            return;
        }

        // Prevent path traversal
        if (str_contains($path, '..')) {
            return;
        }

        // Handle modern /storage/ path
        if (str_starts_with($path, '/storage/')) {
            $relativePath = ltrim(substr($path, 9), '/');
            if (str_starts_with($relativePath, $type . '/')) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($relativePath);
            }
            return;
        }

        // Handle legacy /pics/ path in public directory
        if (str_starts_with($path, "/pics/{$type}/")) {
            $fullPath = public_path($path);
            $realPath = realpath($fullPath);
            $allowedBase = realpath(public_path("pics/{$type}"));

            if ($realPath && $allowedBase && str_starts_with($realPath, $allowedBase) && is_file($realPath)) {
                @unlink($realPath);
            }
        }
    }
}
