<?php

namespace App\Models;
use Core\Model;

class User extends Model {

    public $id;
    public $username;
    public $password;
    public $register_timestamp;

    public function getTableName(){
        return 'users';
    }

    public function create($id, $username, $hash) {
        $this->db->query("INSERT INTO users (id, username, password) VALUES (?, ?, ?)", [$id, $username, $hash]);
        $user = $this->find($id);
        return $user;
    }
}

