<?php

namespace Core;
use PDO;

class Database {

    protected $config;
    protected $conn;

    public function __construct($config){
        $this->config = $config;
        $this->connect();
    }

    public function connect(){
        try {
            $dsn = "mysql:host={$this->config['host']};port={$this->config['port']};dbname={$this->config['dbname']}";
            $this->conn = new PDO($dsn, $this->config['username'], $this->config['password']);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $this->conn;
        } catch (\Exception $e){
            abort(500, "Database connection failed: {$e->getMessage()}!", "Internal Server Error: Database");
        }
    }

    public function query($sql, $params = []){
        try {
            $stmt = $this->conn->prepare($sql);
            $stmt->execute($params);
            return $stmt;
        } catch (\PDOException $e) {
            abort(500, "Database query failed: {$e->getMessage()}", 'Internal Server Error: Database');
        }
    }
}

