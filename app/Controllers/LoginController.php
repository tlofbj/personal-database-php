<?php

namespace App\Controllers;
use Core\Controller;
use Core\Request;
use App\Services\UserServices;
use App\Services\AuthServices;

class LoginController extends Controller{

    protected $request;
    protected $userServices;
    protected $authServices;
  
    public function __construct(Request $request, ?UserServices $userServices = null, ?AuthServices $authServices = null) {
        $this->request = $request;
        $this->userServices = $userServices;
        $this->authServices = $authServices;
    }

    public function index() {
        display('login', [
            'title' => 'Sign Up',
            'username' => flash_get('username'),
            'password' => flash_get('password'),
            'error' => flash_get('error')
        ]);
    }

    public function process() {

        $username = sanitize_and_flash($this->request->post('username'), 'username');
        $password = sanitize_and_flash($this->request->post('password'), 'password');
        
        if (!$this->userServices->userExists($username)) {
            flash('error', 'Sorry, I don\'t recognize this username!');
            redirect('/login');
            exit;
        }

        $user = $this->authServices->authenticate($username, $password);
        if (!$user) {
            flash('error', 'Sorry, I can\'t let you in! Are you sure you have the right password?');
            redirect('/login');
            exit;
        }
        $this->authServices->login($user);
        redirect('/dashboard');
        exit;
    }

}

