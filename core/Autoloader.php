<?php

namespace Core;

class Autoloader{

    protected static $map = [];

    public static function init($config = ['map' => []]){
        static::$map = $config['map'];
        return new static();
    }

    public function register(){
        spl_autoload_register([static::class, 'loader']);
    }

    public function loader($class){
        foreach (static::$map as $namespace_key => $namespace_directory) {
            if (strpos($class, $namespace_key) === 0) {
                $class_directory = str_replace($namespace_key, $namespace_directory, $class);
                break;
            }
        }
        $file = BASE_PATH .'/'. str_replace('\\', '/', $class_directory) . '.php';
        if (file_exists($file)) {
            require_once $file;
        } else {
            abort(500, "Autoloader: No class ($class) found in file ($file)!");
        }
    }
}

