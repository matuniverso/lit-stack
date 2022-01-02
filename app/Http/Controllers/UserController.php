<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\UploadProfileRequest;
use App\Repositories\UserRepository;

class UserController extends Controller
{
    public function __construct(
        private UserRepository $userRepository
    ) {
    }

    public function users()
    {
        $users = User::query()
            ->oldest()
            ->paginate(5);

        return inertia('Users/Index', compact('users'));
    }

    public function profile()
    {
        return inertia('Profile');
    }

    public function update(UploadProfileRequest $request)
    {
        $request->validated();

        $this->userRepository->handleUpload($request);

        return back();
    }

    public function destroy()
    {
        $this->userRepository->handleDestroy();

        return back();
    }
}
