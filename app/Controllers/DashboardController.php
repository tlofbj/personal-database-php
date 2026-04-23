<?php

namespace App\Controllers;
use Core\Controller;
use Core\Request;
use App\Services\DataServices;

class DashboardController extends Controller{

    protected $request;
    protected $dataServices;

    public function __construct(Request $request, DataServices $dataServices) {
        $this->request = $request;
        $this->dataServices = $dataServices;
    }

    public function index() {
        $user_id = $this->request->session->get('user')['id'];
        $data = $this->dataServices->findDataByOwnerDescend($user_id, 'creation_timestamp');

        display('dashboard', [
            'title' => 'Dashboard',
            'data' => $data
        ]);
    }
}

