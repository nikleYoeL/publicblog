<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only(['edit', 'update', 'destroy']);
        $this->authorizeResource(User::class, 'profile');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $profile)
    {
        return view('User.show', ['user' => $profile]);
    }

    public function showPosts(User $profile)
    {
        return view('User.posts', ['user' => $profile, 'posts' => $profile->posts()->paginate(5)]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $profile)
    {
        return view('User.edit', ['user' => $profile]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $profile)
    {
        if ($request->input('name') !== $profile->name) {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
            ]);

            $profile->name = $validated['name'];
        }

        if ($request->input('email') !== $profile->email) {
            $validated = $request->validate([
                'email' => 'required|email|unique:users|max:255',
            ]);

            $profile->email = $validated['email'];
            $profile->email_verified_at = null;
        }

        if ($request->hasFile('avatar')) {
            $validated = $request->validate([
                'avatar' => 'nullable|mimes:jpg,jpeg,png,gif|max:2048',
            ]);

            $profile->removeCurrentFromStorage();

            $avatarPath = $validated['avatar']->storeAs(
                'images',
                time() . $request->file('avatar')->getClientOriginalName(),
                'public'
            );

            $profile->avatar = $avatarPath;
        }

        if ($request->input('bio') !== $profile->bio) {
            $validated = $request->validate([
                'bio' => 'nullable|string|max:300',
            ]);

            $profile->bio = $validated['bio'];
        }

        if ($profile->isDirty()) {
            $profile->save();
        }

        return redirect()->route('profile.show', $profile);
    }

    public function setDefaultAvatar(User $profile)
    {
        if (request()->user()->cannot('deleteAvatar', $profile)) {
            abort(403);
        }

        $profile->removeCurrentFromStorage();

        $profile->avatar = $profile->getDefaultImage();
        $profile->save();

        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $profile)
    {
        $profile->delete();

        if (url()->previous() === route('user.index')) {
            return back()->with('status', 'Пользователь успешно удалён');
        }
        
        return redirect()->route('post.listing');
    }
}
