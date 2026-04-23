<?php

namespace Core;

class View {

    protected $template;
    protected $data = [];

    public function __construct($template, $data = []) {
        $this->template = $template;
        $this->data = $data;
    }
    
    public function render() {
        $path = BASE_PATH . "/app/views/{$this->template}.php";
        if (file_exists($path)) {
            ob_start();
            extract($this->data);
            require $path;
            $content = ob_get_clean();
            return $content;
        } else {
            abort(500, "View template ($this->template) not found in file ($path)!");
            exit;
        }
    }

    public function set($key, $value) {
        $this->data[$key] = $value;
    }

    public function update(array $data) {
        $this->data = array_merge($this->data, $data);
    }

}
