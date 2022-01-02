<?php

namespace App\Repositories;

use App\Models\User;
use App\Http\Requests\UploadProfileRequest;
use Illuminate\Support\Facades\Storage;

final class UserRepository
{
    public function handleUpload(UploadProfileRequest $request): bool
    {
        /** @var User */
        $user = auth()->user();

        if ($user->profile_pic) $this->remove($user->profile_pic);

        return $user->update(['profile_pic' => $this->store($request)]);
    }

    public function handleDestroy()
    {
        /** @var User */
        $user = auth()->user();

        if ($user->profile_pic) $this->remove($user->profile_pic);

        return $user->update(['profile_pic' => null]);
    }

    public function store(UploadProfileRequest $request): string|false
    {
        return $request->file('profile_pic')->store('pics', 'public');
    }

    public function remove(string $file): bool
    {
        return Storage::disk('public')->delete($file);
    }
}
