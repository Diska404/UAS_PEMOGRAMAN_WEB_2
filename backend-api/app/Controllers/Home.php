<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;

class Home extends ResourceController
{
    protected $format = 'json';

    public function index()
    {
        return $this->respond([
            'status' => true,
            'message' => 'E-Inventory API Server aktif',
            'service' => 'E-Inventory Hardware Store',
        ]);
    }
}
