<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateInventoryTables extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_user' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'nama' => ['type' => 'VARCHAR', 'constraint' => 120],
            'email' => ['type' => 'VARCHAR', 'constraint' => 120, 'unique' => true],
            'password' => ['type' => 'VARCHAR', 'constraint' => 255],
            'token' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id_user', true);
        $this->forge->createTable('users', true);

        $this->forge->addField([
            'id_kategori' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'nama_kategori' => ['type' => 'VARCHAR', 'constraint' => 100],
            'keterangan' => ['type' => 'TEXT', 'null' => true],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id_kategori', true);
        $this->forge->createTable('kategori', true);

        $this->forge->addField([
            'id_supplier' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'nama_supplier' => ['type' => 'VARCHAR', 'constraint' => 120],
            'alamat' => ['type' => 'TEXT', 'null' => true],
            'telepon' => ['type' => 'VARCHAR', 'constraint' => 30, 'null' => true],
            'email' => ['type' => 'VARCHAR', 'constraint' => 120, 'null' => true],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id_supplier', true);
        $this->forge->createTable('supplier', true);

        $this->forge->addField([
            'id_barang' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'id_kategori' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'id_supplier' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'kode_barang' => ['type' => 'VARCHAR', 'constraint' => 40, 'unique' => true],
            'nama_barang' => ['type' => 'VARCHAR', 'constraint' => 150],
            'stok' => ['type' => 'INT', 'constraint' => 11, 'default' => 0],
            'satuan' => ['type' => 'VARCHAR', 'constraint' => 30],
            'harga' => ['type' => 'DECIMAL', 'constraint' => '14,2', 'default' => 0],
            'deskripsi' => ['type' => 'TEXT', 'null' => true],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id_barang', true);
        $this->forge->addForeignKey('id_kategori', 'kategori', 'id_kategori', 'CASCADE', 'RESTRICT');
        $this->forge->addForeignKey('id_supplier', 'supplier', 'id_supplier', 'CASCADE', 'RESTRICT');
        $this->forge->createTable('barang', true);

        $this->forge->addField([
            'id_histori' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'id_barang' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'jenis' => ['type' => 'ENUM', 'constraint' => ['masuk', 'keluar']],
            'jumlah' => ['type' => 'INT', 'constraint' => 11],
            'keterangan' => ['type' => 'TEXT', 'null' => true],
            'tanggal' => ['type' => 'DATE'],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id_histori', true);
        $this->forge->addForeignKey('id_barang', 'barang', 'id_barang', 'CASCADE', 'CASCADE');
        $this->forge->createTable('stok_histori', true);
    }

    public function down()
    {
        $this->forge->dropTable('stok_histori', true);
        $this->forge->dropTable('barang', true);
        $this->forge->dropTable('supplier', true);
        $this->forge->dropTable('kategori', true);
        $this->forge->dropTable('users', true);
    }
}
