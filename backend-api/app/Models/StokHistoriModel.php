<?php

namespace App\Models;

use CodeIgniter\Model;

class StokHistoriModel extends Model
{
    protected $table = 'stok_histori';
    protected $primaryKey = 'id_histori';
    protected $returnType = 'array';
    protected $allowedFields = ['id_barang', 'jenis', 'jumlah', 'keterangan', 'tanggal'];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    public function getWithBarang(?int $id = null)
    {
        $builder = $this->select('stok_histori.*, barang.kode_barang, barang.nama_barang, barang.satuan')
            ->join('barang', 'barang.id_barang = stok_histori.id_barang', 'left')
            ->orderBy('stok_histori.tanggal', 'DESC')
            ->orderBy('stok_histori.id_histori', 'DESC');

        if ($id !== null) {
            return $builder->where('stok_histori.id_histori', $id)->first();
        }

        return $builder->findAll();
    }
}
