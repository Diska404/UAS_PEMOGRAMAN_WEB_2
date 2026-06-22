<?php

namespace App\Controllers\Api;

use App\Models\SupplierModel;
use CodeIgniter\RESTful\ResourceController;

class SupplierController extends ResourceController
{
    protected $format = 'json';
    private SupplierModel $supplierModel;

    public function __construct()
    {
        $this->supplierModel = new SupplierModel();
    }

    public function index()
    {
        return $this->respond([
            'status' => true,
            'data' => $this->supplierModel->orderBy('id_supplier', 'DESC')->findAll(),
        ]);
    }

    public function show($id = null)
    {
        $data = $this->supplierModel->find($id);

        if (!$data) {
            return $this->failNotFound('Supplier tidak ditemukan.');
        }

        return $this->respond(['status' => true, 'data' => $data]);
    }

    public function create()
    {
        $payload = $this->payload();
        $rules = [
            'nama_supplier' => 'required|min_length[3]|max_length[120]',
            'email' => 'permit_empty|valid_email|max_length[120]',
        ];

        if (!$this->validateData($payload, $rules)) {
            return $this->failValidationErrors($this->validator->getErrors());
        }

        $this->supplierModel->insert([
            'nama_supplier' => trim($payload['nama_supplier']),
            'alamat' => trim($payload['alamat'] ?? ''),
            'telepon' => trim($payload['telepon'] ?? ''),
            'email' => trim($payload['email'] ?? ''),
        ]);

        return $this->respondCreated([
            'status' => true,
            'message' => 'Supplier berhasil ditambahkan.',
            'data' => $this->supplierModel->find($this->supplierModel->getInsertID()),
        ]);
    }

    public function update($id = null)
    {
        $data = $this->supplierModel->find($id);

        if (!$data) {
            return $this->failNotFound('Supplier tidak ditemukan.');
        }

        $payload = $this->payload();
        $rules = [
            'nama_supplier' => 'required|min_length[3]|max_length[120]',
            'email' => 'permit_empty|valid_email|max_length[120]',
        ];

        if (!$this->validateData($payload, $rules)) {
            return $this->failValidationErrors($this->validator->getErrors());
        }

        $this->supplierModel->update($id, [
            'nama_supplier' => trim($payload['nama_supplier']),
            'alamat' => trim($payload['alamat'] ?? ''),
            'telepon' => trim($payload['telepon'] ?? ''),
            'email' => trim($payload['email'] ?? ''),
        ]);

        return $this->respond([
            'status' => true,
            'message' => 'Supplier berhasil diperbarui.',
            'data' => $this->supplierModel->find($id),
        ]);
    }

    public function delete($id = null)
    {
        $data = $this->supplierModel->find($id);

        if (!$data) {
            return $this->failNotFound('Supplier tidak ditemukan.');
        }

        $this->supplierModel->delete($id);

        return $this->respondDeleted([
            'status' => true,
            'message' => 'Supplier berhasil dihapus.',
        ]);
    }

    private function payload(): array
    {
        return $this->request->getJSON(true) ?? $this->request->getPost() ?? [];
    }
}
