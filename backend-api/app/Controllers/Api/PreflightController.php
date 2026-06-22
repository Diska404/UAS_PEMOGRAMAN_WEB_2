<?php

namespace App\Controllers\Api;

use CodeIgniter\RESTful\ResourceController;

class PreflightController extends ResourceController
{
    protected $format = 'json';

    public function index()
    {
        return $this->response->setStatusCode(204);
    }
}
