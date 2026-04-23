<?php

namespace App\Controllers\Userdata;
use Core\Controller;
use Core\Request;
use App\Services\DataServices;
use App\Services\ValidationServices;

class CreateController extends Controller {

    protected $request;
    protected $dataServices;
    protected $validationServices;

    public function __construct(Request $request, ?DataServices $dataServices = null, ?ValidationServices $validationServices = null) {
        $this->request = $request;
        $this->dataServices = $dataServices;
        $this->validationServices = $validationServices;
    }

    public function index() {
        display('userdata/create', [
            'title' => 'Create Data',
            'contentTitle' => flash_get('contentTitle'),
            'description' => flash_get('description'),
            'content' => flash_get('content'),
            'error' => flash_get('error')
        ]);
    }

    public function process() {
        $owner = $this->request->session->get('user')['id'];
        $contentTitle = sanitize_and_flash($this->request->post('contentTitle') ?? '...', 'contentTitle');
        $description = sanitize_and_flash($this->request->post('description') ?? '...', 'description');
        $content = sanitize_and_flash($this->request->post('content'), 'content');

        $error = $this->validationServices->validateUserdataCreate($contentTitle, $description, $content);
        if ($error) {
            flash('error', $error);
            redirect('/create');
            exit;
        }

        $this->dataServices->createData($owner, $contentTitle, $description, $content);
        flash_clear();
        redirect('/dashboard');
        exit;
    }
    
}

