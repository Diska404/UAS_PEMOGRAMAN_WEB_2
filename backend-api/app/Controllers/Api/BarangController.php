<?php

namespace App\Controllers\Api;

use App\Models\BarangModel;
use CodeIgniter\RESTful\ResourceController;

class BarangController extends ResourceController
{
    protected $format = 'json';
    private BarangModel $barangModel;

    public function __construct()
    {
        $this->barangModel = new BarangModel();
    }

    public function index()
    {
        return $this->respond([
            'status' => true,
            'data' => $this->barangModel->getWithRelations(),
        ]);
    }

    public function show($id = null)
    {
        $data = $this->barangModel->getWithRelations((int) $id);

        if (!$data) {
            return $this->failNotFound('Barang tidak ditemukan.');
        }

        return $this->respond(['status' => true, 'data' => $data]);
    }

    public function create()
    {
        $payload = $this->payload();
        $rules = $this->rules();

        if (!$this->validateData($payload, $rules)) {
            return $this->failValidationErrors($this->validator->getErrors());
        }

        $this->barangModel->insert($this->mapPayload($payload));

        return $this->respondCreated([
            'status' => true,
            'message' => 'Barang berhasil ditambahkan.',
            'data' => $this->barangModel->getWithRelations((int) $this->barangModel->getInsertID()),
        ]);
    }

    public function update($id = null)
    {
        $data = $this->barangModel->find($id);

        if (!$data) {
            return $this->failNotFound('Barang tidak ditemukan.');
        }

        $payload = $this->payload();
        $rules = $this->rules($id);

        if (!$this->validateData($payload, $rules)) {
            return $this->failValidationErrors($this->validator->getErrors());
        }

        $this->barangModel->update($id, $this->mapPayload($payload));

        return $this->respond([
            'status' => true,
            'message' => 'Barang berhasil diperbarui.',
            'data' => $this->barangModel->getWithRelations((int) $id),
        ]);
    }

    public function delete($id = null)
    {
        $data = $this->barangModel->find($id);

        if (!$data) {
            return $this->failNotFound('Barang tidak ditemukan.');
        }

        $this->barangModel->delete($id);

        return $this->respondDeleted([
            'status' => true,
            'message' => 'Barang berhasil dihapus.',
        ]);
    }

    private function rules(?int $id = null): array
    {
        $uniqueRule = $id ? "is_unique[barang.kode_barang,id_barang,{$id}]" : 'is_unique[barang.kode_barang]';

        return [
            'id_kategori' => 'required|integer',
            'id_supplier' => 'required|integer',
            'kode_barang' => "required|min_length[3]|max_length[40]|{$uniqueRule}",
            'nama_barang' => 'required|min_length[3]|max_length[150]',
            'stok' => 'required|integer|greater_than_equal_to[0]',
            'satuan' => 'required|max_length[30]',
            'harga' => 'required|numeric|greater_than_equal_to[0]',
        ];
    }

    private function mapPayload(array $payload): array
    {
        return [
            'id_kategori' => (int) $payload['id_kategori'],
            'id_supplier' => (int) $payload['id_supplier'],
            'kode_barang' => trim($payload['kode_barang']),
            'nama_barang' => trim($payload['nama_barang']),
            'stok' => (int) $payload['stok'],
            'satuan' => trim($payload['satuan']),
            'harga' => (float) $payload['harga'],
            'deskripsi' => trim($payload['deskripsi'] ?? ''),
        ];
    }

    private function payload(): array
    {
        return $this->request->getJSON(true) ?? $this->request->getPost() ?? [];
    }
}
