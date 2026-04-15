<?php

namespace App\Services;

use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Hash;

class UserService
{
    public function __construct(
        protected UserRepository $userRepository
    ) {}

    public function createUser(array $data)
    {
        $data['password'] = Hash::make($data['password']);

        return $this->userRepository->create($data);
    }

    public function getAllUsers()
    {
        return $this->userRepository->all();
    }

    public function updateUser($user, array $data)
    {
        if (isset($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        }

        return $this->userRepository->update($user, $data);
    }

    public function deleteUser($user)
    {
        return $this->userRepository->delete($user);
    }
}