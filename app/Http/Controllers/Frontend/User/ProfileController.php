<?php

namespace App\Http\Controllers\Frontend\User;

use App\Domains\Auth\Services\UserService;
use App\Http\Requests\Frontend\User\UpdateProfileRequest;
use Illuminate\Support\Facades\Storage;

/**
 * Class ProfileController.
 */
class ProfileController
{
    /**
     * @param  UpdateProfileRequest  $request
     * @param  UserService  $userService
     * @return mixed
     */
    public function update(UpdateProfileRequest $request, UserService $userService)
    {
        if ($request->hasFile('profile_picture')) {
            abort_unless(Storage::disk('public')->putFileAs('avatars', $request->file('profile_picture'), md5(strtolower(trim($request->user()->email))).'.jpg'), 500);
        }
        
        $userService->updateProfile($request->user(), $request->validated());

        if (session()->has('resent')) {
            return redirect()->route('frontend.auth.verification.notice')->withFlashInfo(__('You must confirm your new e-mail address before you can go any further.'));
        }

        return redirect()->route('frontend.user.account', ['#information'])->withFlashSuccess(__('Profile successfully updated.'));
    }
}
