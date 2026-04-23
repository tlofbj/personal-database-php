<?php

namespace App\Middlewares;
use Core\Middleware;
use Core\Request;

class GuestOnly extends Middleware {
    
    public function handle(Request $request) {
        if ($request->session->get('user')['id'] ?? null) {
            redirect('/dashboard');
            exit;
        }
    }
}

