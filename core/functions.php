<?php

use Core\Request;
use Core\Response;
use Core\View;

// Debugging functions

function logcon($input) {
    echo "<script>console.log({$input})</script>";
}

function dump($input, $color = 'black') {
    echo "<pre style='color: {$color}'>";
    var_dump($input);
    echo '</pre>';
}

function dumpdie($input, $color = 'black') {
    dump($input, $color);
    die;
}

// Utility functions

function random_int_digits($digits) {
    return random_int(10 ** ($digits - 1), (10 ** $digits) - 1);
}

function sanitize_and_flash($value, $key) {
    $sanitized_value = sanitize($value);
    flash($key, $sanitized_value);
    return $sanitized_value;
}

function escape_for_js(string $string) {
    $string = str_replace(["\r\n", "\n"], "\\n", $string);
    $string = str_replace(["'", "\\'"], ['"', '\\"'], $string);
    return $string;
}

// Session functions

function flash($key, $message) {
    $_SESSION['flash_messages'][$key] = $message;
}

function flash_get($key) {
    return $_SESSION['flash_messages'][$key] ?? null;
}

function flash_clear() {
    unset($_SESSION['flash_messages']);
}

// CSRF functions

function insert_csrf_token() {
    $token = bin2hex(random_bytes(32));
    $_SESSION['_csrf_token'] = $token;
    echo "<input type='hidden' name='_csrf_token' value='{$token}'>";
}

// HTTP functions

function display($template, $data = [], $statusCode = 400) {
    $view = (new View($template, $data))->render();
    $response = new Response();
    $response->setContent($view);
    $response->setStatusCode($statusCode);
    $response->setHeader('Content-Type', 'text/html');
    $response->send();
    flash_clear();
}

function redirect($uri, $statusCode = 302) {
    $response = new Response();
    $response->setHeader('Location', $uri);
    $response->setStatusCode($statusCode);
    $response->send();
    exit;
}

function abart() {}

function abort($code, $message = null, $title = null) {
    http_response_code($code);
    switch ($code) {
        case 404:
            $title = $title ?? 'Page Not Found';
            $message = $message ?? 'Sorry, I could not find page you were looking for.';
            break;
        case 401:
            $title = $title ?? 'Unauthorized';
            $message = $message ?? 'Hey, you\'re not supposed to be here!';
            break;
        case 403:
            $title = $title ?? 'Forbidden';
            $message = $message ?? 'Hey, you\'re never supposed to be here!';
        case 500:
            $title =  $title ?? 'Internal Server Error';
            $message = $message ?? 'Sorry, I made an internal error at somewhere, though I don\'t know why it happened.';
            break;
        default:
            $title = $title ?? "Error $code";
            $message = $message ?? 'An error occurred.';
            break;
    }
    require_once BASE_PATH . "/app/views/error.php";
    die();
}

// Validation and sanitization functions

function validate_string($input, $min = 0, $max = INF) {
    $length = strlen($input);
    return $length >= $min && $length <= $max;
}

function validate_number($input, $min = 0, $max = INF) {
    return is_numeric($input) && $input >= $min && $input <= $max;
}

function validate_alphanumeric($input, $extra_chars = '_.') {
    return preg_match("/^[a-zA-Z0-9{$extra_chars}]+$/", $input);
}

function validate_email($input) {
    return filter_var($input, FILTER_VALIDATE_EMAIL);
}

function sanitize($input) {
    return htmlspecialchars(trim($input ?? ''), ENT_QUOTES, 'UTF-8');
}

