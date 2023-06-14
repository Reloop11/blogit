<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use Illuminate\Http\Request;

class ProfilesController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth')->except('show');
        $this->middleware('sanitize', ['htmlInputs' => ['bio']])->only('update');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $profile = Profile::findOrFail($id);
        return view('profiles.show')->with('profile', $profile);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $profile = Profile::findOrFail($id);

        if ($profile->user->id != auth()->user()->id) {
            abort(401);
        }

        return view('profiles.edit')->with('profile', $profile);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $profile = Profile::findOrFail($id);

        if ($profile->user->id != auth()->user()->id) {
            abort(401);
        }

        $rules = [
            'name' => 'required|unique:users,name|max:255',
            'avatar' => 'image|max:2048|nullable',
            'bio' => 'nullable',
        ];

        if ($request->input('name') !== null && $profile->user->name === $request->input('name')) {
            $request->request->remove('name');
            unset($rules['name']);
        }

        $profileData = $request->validate($rules);       

        if ($request->hasFile('avatar')) {
            $image = $request->file('avatar');
            $avatarExt = $image->getClientOriginalExtension();
            $avatarName = 'IMG_'.time().'.'.$avatarExt;

            storeUploadedImage($image, $avatarName, '/public/avatar_images');
            $profileData['avatar'] = $avatarName;
        } else {
            unset($profileData['avatar']);
        }

        $profile->update($profileData);

        return redirect()->route('profiles.show', ['profile' => $profile->id]);
    }

    /**
     * Validate user form input
     */
    protected function validateRequest(Request $request) {
        return $request->validate([
            'name' => 'required|unique:users,name|max:255',
            'avatar' => 'image|max:2048|nullable',
            'bio' => 'nullable',
        ]);
    }
}
