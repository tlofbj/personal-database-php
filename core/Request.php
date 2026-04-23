<?php

namespace Core;

class Request {

    public $uri;
    public $method;
    public $headers;
    public $get;
    public $post;
    public $cookies;
    public $session;

    public function __construct() {
        $this->uri = $this->retrieve_uri();
        $this->method = $this->retrieve_method();
        $this->headers = $this->retrieve_headers();
        $this->get = $_GET;
        $this->post = $_POST;
        $this->cookies = $_COOKIE;
        $this->session = new Session();
    }

    public function retrieve_uri() {
        return parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) ?? '/';
    }

    public function retrieve_method() {
        return $_POST['_request_method'] ?? $_SERVER['REQUEST_METHOD'] ?? 'GET';
    }

    public function retrieve_headers() {
        $headers = [];
        foreach ($_SERVER as $key => $value) {
            if (strpos($key, 'HTTP_') === 0) {
                $header_name = str_replace('HTTP_', '', $key);
                $header_name = ucwords(strtolower(str_replace('_', '-', $header_name)));
                $headers[$header_name] = $value;
            }
        }
        return $headers;
    }

    public function input($key, $default = null) {
        if ($this->method === 'GET') {
            return $this->get[$key] ?? $default;
        } else {
            return $this->post[$key] ?? $default; 
        }
    }

    public function header($key = null, $default = null) {
        if ($key === null) {
            return $this->headers;
        }
        return $this->headers[$key] ?? $default;
    }

    public function post($key = null, $default = null) {
        if ($key === null) {
            return $this->post;
        }
        if (empty($this->post[$key])) {
            return $default;
        }
        return $this->post[$key];
    }

    public function get($key = null, $default = null) {
        if ($key === null) {
            return $this->get;
        }
        if (empty($this->get[$key])) {
            return $default;
        }
        return $this->get[$key];
    }

    public function session($key = null, $default = null) {
        if ($key === null) {
            return $this->session;
        }
        return $this->session->get($key) ?? $default;
    }
}

