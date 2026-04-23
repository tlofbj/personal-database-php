<?php

namespace App\Repositories;
use App\Models\User; 

class UserRepository {

    protected $userModel;

    public function __construct(User $userModel) {
        $this->userModel = $userModel;
    }

    public function findUserByUsername($username) {
        return $this->userModel->where('username', $username);
    }

    public function findUserById($id) {
        return $this->userModel->find($id);
    }

    public function createUser($id, $username, $password) {
        return $this->userModel->create($id, $username, $password);
    }
}

