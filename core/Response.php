<?php

namespace Core;

class Response {

    protected $content;
    protected $statusCode = 200;
    protected $headers = [];

    public function __construct($content = '', $statusCode = 200, $headers = []) {
        $this->content = $content;
        $this->statusCode = $statusCode;
        $this->headers = $headers;
    }

    public function setContent($content) {
        $this->content = $content;
        return $this;
    }

    public function setStatusCode($statusCode) {
        $this->statusCode = $statusCode;
        return $this;
    }

    public function setHeader($key, $value) {
        $this->headers[$key] = $value;
        return $this;
    }

    public function send() {
        http_response_code($this->statusCode);
        foreach ($this->headers as $key => $value) {
            header("{$key}: {$value}");
        }
        echo $this->content;
    }
}

