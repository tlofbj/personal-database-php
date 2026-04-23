<?php

namespace Core;
use PDO;

abstract class Model {

    protected $db;

    public function __construct(Database $db) {
        $this->db = $db;
    }

    abstract public function getTableName();

    private function object($row) {
        if ($row === false) {
            return null;
        }
        $model = new static($this->db);
        foreach ($row as $key => $value) {
            $model->$key = $value;
        }
        return $model;
    }

    private function objectArray ($array){
        if ($array === false) {
            return null;
        }
        $object_array = [];
        foreach ($array as $row) {
            array_push($object_array, $this->object($row));
        }
        return $object_array;
    }

    public function where($column, $value) {
        $stmt = $this->db->query("SELECT * FROM {$this->getTableName()} WHERE $column = ?", [$value]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $this->object($row);
    }

    public function whereAll($column, $value) {
        $stmt = $this->db->query("SELECT * FROM {$this->getTableName()} WHERE $column = ?", [$value]);
        $array = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $this->objectArray($array);
    }

    public function whereAllDescend($column, $value, $descending_column) {
        $stmt = $this->db->query("SELECT * FROM {$this->getTableName()} WHERE $column = ? ORDER BY $descending_column DESC", [$value]);
        $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $this->objectArray($row);
    }

    public function find($id) {
        $stmt = $this->db->query("SELECT * FROM {$this->getTableName()} WHERE id = ?", [$id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $this->object($row);
    }

    public function all() {
        $stmt = $this->db->query("SELECT * FROM {$this->getTableName()}", []);
        $array = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $this->objectArray($array);
    }

    public function delete($id) {
        $stmt = $this->db->query("DELETE FROM {$this->getTableName()} WHERE id = ?", [$id]);
    }
}
