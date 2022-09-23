<?php

namespace App\Services;

use App\Dto\InputUserDto;
use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Hash;

class UserService
{
    protected $userRepository;

    const HASH_OPTION = ['rounds' => 12];

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function create(InputUserDto $userDto)
    {
        $user = new User();
        $user->name = $userDto->getName();
        $user->email = $userDto->getEmail();
        $user->password = $this->getPasswordHash($userDto->getPassword());
        $user->status = $userDto->getStatus();
        $user->user_type = $userDto->getUserType();
        $user->remark = $userDto->getRemark();
        $user->save();
    }

    private function getPasswordHash(string $passowrd)
    {
        return Hash::make($passowrd, $this::HASH_OPTION);
    }

    private function validPassword(string $passowrd, string $hashedPassword)
    {
        return Hash::check($passowrd, $hashedPassword, $this::HASH_OPTION);
    }
}
