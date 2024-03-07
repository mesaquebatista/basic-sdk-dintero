<?php

namespace Src\Dintero\Models;

class Response
{
    public int $httpCode = 200;

    public $success;
    public $error;

    public function __construct() {
        $this->success = null;
        $this->error = null;
    }
}