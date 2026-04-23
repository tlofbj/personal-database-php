<?php

namespace App\Services;

class ValidationServices {

    public function validateSignup($username, $password, $confirm_password) {
        if (!validate_string($username, 4, 20)) {
            $error = 'Hey, your username must be between 4 to 20 characters!';
        } else if (!validate_alphanumeric($username, '_.')) {
            $error = 'Hey, your username must only have letters, numbers, dots, and/or underscores!';
        } else if (!validate_string($password, 0, 25)) {
            $error = 'Hey, your password must not exceed 25 characters!';
        } else if ($password != $confirm_password) {
            $error = 'Hey, your password and confirmation don\'t seem to match!';
        } else {
            return null;
        }
        return $error;
    }

    public function validateUserdataCreate($contentTitle, $description, $content) {
        if (!validate_string($contentTitle, 0, 50)) {
            $error = 'Hey, title must be between 3 to 50 characters!';
        } else if (!validate_string($description, 0, 150)) {
            $error = 'Hey, description must not exceed 150 characters!';
        } else if (!validate_string($content, 0, 10000)) {
            $error = 'Hey, your content must not exceed 10,000 characters!';
        } else {
            return null;
        }
        return $error;
    }
}