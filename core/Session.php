<?php

namespace Core;

class Session {

  public function __construct() {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
  }

  public function get($key, $default = null) {
    return $_SESSION[$key] ?? $default;
  }

  public function set($key, $value) {
    $_SESSION[$key] = $value;
    return this;
  }

  public function unset($key) {
    unset($_SESSION[$key]);
    return this;
  }
  
}

