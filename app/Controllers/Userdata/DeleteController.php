<?php

namespace App\Controllers\Userdata;
use Core\Controller;
use Core\Request;
use App\Services\DataServices;

class DeleteController extends Controller {

    protected $request;
    protected $dataServices;

    public function __construct(Request $request, ?DataServices $dataServices = null) {
        $this->request = $request;
        $this->dataServices = $dataServices;
    }

    public function index() {
        $id = $this->request->post('id');
        $this->dataServices->deleteData($id);
        flash_clear();
        redirect('/dashboard');
        exit;
    }
    
}

