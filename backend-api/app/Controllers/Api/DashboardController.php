<?php

namespace App\Controllers\Api;

use App\Models\BarangModel;
use App\Models\KategoriModel;
use App\Models\StokHistoriModel;
use App\Models\SupplierModel;
use CodeIgniter\RESTful\ResourceController;

class DashboardController extends ResourceController
{
    protected $format = 'json';

    public function summary()
    {
        $barangModel = new BarangModel();
        $kategoriModel = new KategoriModel();
        $supplierModel = new SupplierModel();
        $historiModel = new StokHistoriModel();

        $barang = $barangModel->findAll();
        $totalStok = array_sum(array_map(static fn ($item) => (int) $item['stok'], $barang));
        $stokMenipis = array_values(array_filter($barang, static fn ($item) => (int) $item['stok'] <= 5));
        $recentHistori = array_slice($historiModel->getWithBarang(), 0, 5);

        return $this->respond([
            'status' => true,
            'data' => [
                'total_barang' => count($barang),
                'total_kategori' => $kategoriModel->countAllResults(),
                'total_supplier' => $supplierModel->countAllResults(),
                'total_stok' => $totalStok,
                'barang_stok_menipis' => count($stokMenipis),
                'total_histori' => $historiModel->countAllResults(),
                'recent_histori' => $recentHistori,
            ],
        ]);
    }
}
