<?php

namespace App\Controllers\Api;

use App\Models\KategoriModel;
use CodeIgniter\RESTful\ResourceController;

class KategoriController extends ResourceController
{
    protected $format = 'json';
    private KategoriModel $kategoriModel;

    public function __construct()
    {
        $this->kategoriModel = new KategoriModel();
    }

    public function index()
    {
        return $this->respond([
            'status' => true,
            'data' => $this->kategoriModel->orderBy('id_kategori', 'DESC')->findAll(),
        ]);
    }

    public function show($id = null)
    {
        $data = $this->kategoriModel->find($id);

        if (!$data) {
            return $this->failNotFound('Kategori tidak ditemukan.');
        }

        return $this->respond(['status' => true, 'data' => $data]);
    }

    public function create()
    {
        $payload = $this->payload();
        $rules = ['nama_kategori' => 'required|min_length[3]|max_length[100]'];

        if (!$this->validateData($payload, $rules)) {
            return $this->failValidationErrors($this->validator->getErrors());
        }

        $this->kategoriModel->insert([
            'nama_kategori' => trim($payload['nama_kategori']),
            'keterangan' => trim($payload['keterangan'] ?? ''),
        ]);

        return $this->respondCreated([
            'status' => true,
            'message' => 'Kategori berhasil ditambahkan.',
            'data' => $this->kategoriModel->find($this->kategoriModel->getInsertID()),
        ]);
    }

    public function update($id = null)
    {
        $data = $this->kategoriModel->find($id);

        if (!$data) {
            return $this->failNotFound('Kategori tidak ditemukan.');
        }

        $payload = $this->payload();
        $rules = ['nama_kategori' => 'required|min_length[3]|max_length[100]'];

        if (!$this->validateData($payload, $rules)) {
            return $this->failValidationErrors($this->validator->getErrors());
        }

        $this->kategoriModel->update($id, [
            'nama_kategori' => trim($payload['nama_kategori']),
            'keterangan' => trim($payload['keterangan'] ?? ''),
        ]);

        return $this->respond([
            'status' => true,
            'message' => 'Kategori berhasil diperbarui.',
            'data' => $this->kategoriModel->find($id),
        ]);
    }

    public function delete($id = null)
    {
        $data = $this->kategoriModel->find($id);

        if (!$data) {
            return $this->failNotFound('Kategori tidak ditemukan.');
        }

        $this->kategoriModel->delete($id);

        return $this->respondDeleted([
            'status' => true,
            'message' => 'Kategori berhasil dihapus.',
        ]);
    }

    private function payload(): array
    {
        return $this->request->getJSON(true) ?? $this->request->getPost() ?? [];
    }
}
