<?php

namespace App\Middlewares;
use Core\Middleware;
use Core\Request;

class VerifyCsrfToken extends Middleware {

    public function handle(Request $request) {
        $this->request = $request;
        if (!$this->verify_csrf_token()) {
            abort(403);
        }
    }

    private function verify_csrf_token() {
        $request_token = $this->request->post('_csrf_token') ?? null;
        $session_token = $this->request->session('_csrf_token') ?? null;
    
        if (!$request_token || !$session_token || $request_token !== $session_token) {
            return false;
        }
        unset($_SESSION['_csrf_token']);
        return true;
    }
}

