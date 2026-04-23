<?php

namespace Core;

class Application {

    protected static $container;

    public static function init($container) {
        static::$container = $container;
        return new static();
    }

    public static function get($key) {
        return static::$container->get($key);
    }

    public function run() {
        $router = static::get('router');
        $router->dispatch();
    }
    
}
