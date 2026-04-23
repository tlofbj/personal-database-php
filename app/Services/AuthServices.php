<?php

namespace App\Services;
use App\Repositories\UserRepository; 

class AuthServices {

    protected $userRepository;

    public function __construct(UserRepository $userRepository) {
        $this->userRepository = $userRepository;
    }

    public function authenticate($username, $password) {
        $user = $this->userRepository->findUserByUsername($username);
        if ($user && password_verify($password, $user->password)) {
            return $user;
        }
        return false;
    }

    public function login($user) {
        $_SESSION['user'] = [
            'id' => $user->id,
            'username' => $user->username
        ];
        return $user;
    }

    public function logout() {
        $_SESSION['user'] = null;
    }
}

