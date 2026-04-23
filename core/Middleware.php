<?php

namespace Core;

abstract class Middleware {

    protected $request;

    abstract public function handle(Request $request);
    
}
