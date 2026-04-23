<?php

namespace App\Models;
use Core\Model;

class Data extends Model {

    public $id;
    public $title;
    public $description;
    public $content;
    public $owner;
    public $creation_timestamp;

    public function getTableName(){
        return 'data';
    }

    public function create($id, $owner, $title, $description, $content) {
        $this->db->query("INSERT INTO {$this->getTableName()} (id, owner, title, description, content) VALUES (?, ?, ?, ?, ?)", [$id, $owner, $title, $description, $content]);
        $data = $this->find($id);
        return $data;
    }
}

