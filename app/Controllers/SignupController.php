<?php

namespace App\Controllers;
use Core\Controller;
use Core\Request;
use App\Services\UserServices;
use App\Services\AuthServices;
use App\Services\ValidationServices;

class SignupController extends Controller{

    protected $request;
    protected $userServices;
    protected $authServices;
    protected $validationServices;

    public function __construct(Request $request, ?UserServices $userServices = null, ?AuthServices $authServices = null, ?ValidationServices $validationServices = null) {
        $this->request = $request;
        $this->userServices = $userServices;
        $this->authServices = $authServices;
        $this->validationServices = $validationServices;
    }

    public function index() {
        display('signup', [
            'title' => 'Sign Up',
            'username' => flash_get('username'),
            'password' => flash_get('password'),
            'confirm_password' => flash_get('confirm_password'),
            'error' => flash_get('error')
        ]);
    }

    public function process() {

        $username = sanitize_and_flash($this->request->post('username'), 'username');
        $password = sanitize_and_flash($this->request->post('password'), 'password') ?? 'default';
        $confirm_password = sanitize_and_flash($this->request->post('confirm_password'), 'confirm_password') ?? 'default';

        if ($this->userServices->userExists($username)) {
            flash('error', 'Sorry, this username is taken!');
            redirect('/signup');
            exit;
        }

        $error = $this->validationServices->validateSignup($username, $password, $confirm_password);
        if ($error) {
            flash('error', $error);
            redirect('/signup');
            exit;
        }

        $user = $this->userServices->createUser($username, $password);
        $this->authServices->login($user);

        flash_clear();
        redirect('/dashboard');
        exit;
    }
}

