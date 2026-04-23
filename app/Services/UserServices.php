<?php

namespace App\Services;
use App\Repositories\UserRepository; 

class UserServices {

    protected $userRepository;

    public function __construct(UserRepository $userRepository) {
        $this->userRepository = $userRepository;
    }

    public function userExists($username) {
        return $this->userRepository->findUserByUsername($username);
    }

    public function createUser($username, $password) {
        do {
            $id = random_int_digits(6);
        } while ($this->userExists($username));
        $hash = password_hash($password, PASSWORD_DEFAULT);

        return $this->userRepository->createUser($id, $username, $hash);
    }
}

