<?php

namespace App\Controllers;
use Core\Controller;
use Core\Request;
use App\Services\AuthServices;

class LogoutController extends Controller{

    protected $request;
    protected $auth;
  
    public function __construct(Request $request, AuthServices $auth) {
        $this->request = $request;
        $this->auth = $auth;
    }

    public function index(){
        $this->auth->logout();
        redirect('/');
        exit;
    }
}

