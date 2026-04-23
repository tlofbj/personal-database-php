<?php

namespace Core;

class Container {
    
    protected $bindings = [];

    public function register($key, $value) {
        $this->bindings[$key] = $value;
    }

    public function get($key) {
        if (isset($this->bindings[$key])) {
            return call_user_func($this->bindings[$key]);
        }
        abort(500, "Container: No binding found for key ($key)!");
    }
}

