<?php

namespace App\Controllers\Api;

use App\Models\BarangModel;
use App\Models\StokHistoriModel;
use CodeIgniter\RESTful\ResourceController;

class StokHistoriController extends ResourceController
{
    protected $format = 'json';
    private StokHistoriModel $historiModel;
    private BarangModel $barangModel;

    public function __construct()
    {
        $this->historiModel = new StokHistoriModel();
        $this->barangModel = new BarangModel();
    }

    public function index()
    {
        return $this->respond([
            'status' => true,
            'data' => $this->historiModel->getWithBarang(),
        ]);
    }

    public function show($id = null)
    {
        $data = $this->historiModel->getWithBarang((int) $id);

        if (!$data) {
            return $this->failNotFound('Histori stok tidak ditemukan.');
        }

        return $this->respond(['status' => true, 'data' => $data]);
    }

    public function create()
    {
        $payload = $this->payload();
        $rules = [
            'id_barang' => 'required|integer',
            'jenis' => 'required|in_list[masuk,keluar]',
            'jumlah' => 'required|integer|greater_than[0]',
            'tanggal' => 'required|valid_date[Y-m-d]',
        ];

        if (!$this->validateData($payload, $rules)) {
            return $this->failValidationErrors($this->validator->getErrors());
        }

        $barang = $this->barangModel->find((int) $payload['id_barang']);

        if (!$barang) {
            return $this->failNotFound('Barang tidak ditemukan.');
        }

        $jumlah = (int) $payload['jumlah'];
        $stokSaatIni = (int) $barang['stok'];
        $stokBaru = $payload['jenis'] === 'masuk' ? $stokSaatIni + $jumlah : $stokSaatIni - $jumlah;

        if ($stokBaru < 0) {
            return $this->failValidationErrors('Jumlah barang keluar melebihi stok tersedia.');
        }

        $db = db_connect();
        $db->transStart();

        $this->historiModel->insert([
            'id_barang' => (int) $payload['id_barang'],
            'jenis' => $payload['jenis'],
            'jumlah' => $jumlah,
            'keterangan' => trim($payload['keterangan'] ?? ''),
            'tanggal' => $payload['tanggal'],
        ]);

        $this->barangModel->update((int) $payload['id_barang'], ['stok' => $stokBaru]);
        $db->transComplete();

        if (!$db->transStatus()) {
            return $this->failServerError('Histori stok gagal disimpan.');
        }

        return $this->respondCreated([
            'status' => true,
            'message' => 'Histori stok berhasil ditambahkan.',
            'data' => $this->historiModel->getWithBarang((int) $this->historiModel->getInsertID()),
        ]);
    }

    public function delete($id = null)
    {
        $data = $this->historiModel->find($id);

        if (!$data) {
            return $this->failNotFound('Histori stok tidak ditemukan.');
        }

        $this->historiModel->delete($id);

        return $this->respondDeleted([
            'status' => true,
            'message' => 'Histori stok berhasil dihapus.',
        ]);
    }

    private function payload(): array
    {
        return $this->request->getJSON(true) ?? $this->request->getPost() ?? [];
    }
}
