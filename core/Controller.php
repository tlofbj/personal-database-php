<?php

namespace Core;
use Core\Request;

abstract class Controller{

    protected $request;
    
    public function __construct(Request $request) {
        $this->request = $request;
    }

}
