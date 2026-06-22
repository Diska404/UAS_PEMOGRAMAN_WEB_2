<?php

namespace App\Models;

use CodeIgniter\Model;

class BarangModel extends Model
{
    protected $table = 'barang';
    protected $primaryKey = 'id_barang';
    protected $returnType = 'array';
    protected $allowedFields = ['id_kategori', 'id_supplier', 'kode_barang', 'nama_barang', 'stok', 'satuan', 'harga', 'deskripsi'];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    public function getWithRelations(?int $id = null)
    {
        $builder = $this->select('barang.*, kategori.nama_kategori, supplier.nama_supplier')
            ->join('kategori', 'kategori.id_kategori = barang.id_kategori', 'left')
            ->join('supplier', 'supplier.id_supplier = barang.id_supplier', 'left')
            ->orderBy('barang.id_barang', 'DESC');

        if ($id !== null) {
            return $builder->where('barang.id_barang', $id)->first();
        }

        return $builder->findAll();
    }
}
