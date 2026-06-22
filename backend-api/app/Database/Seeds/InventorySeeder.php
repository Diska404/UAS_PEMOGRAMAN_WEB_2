<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class InventorySeeder extends Seeder
{
    public function run()
    {
        $now = date('Y-m-d H:i:s');

        $this->db->table('users')->insert([
            'nama' => 'Administrator',
            'email' => 'admin@inventory.test',
            'password' => '$2y$12$3oFEw6zFGaPoBW7weKUrz.5o38ROgCiMJ1bxfyFxqxhiGnF4a/Ed2',
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        $this->db->table('kategori')->insertBatch([
            ['id_kategori' => 1, 'nama_kategori' => 'Prosesor', 'keterangan' => 'CPU untuk komputer rakitan dan kebutuhan upgrade', 'created_at' => $now, 'updated_at' => $now],
            ['id_kategori' => 2, 'nama_kategori' => 'Kartu Grafis', 'keterangan' => 'GPU gaming, desain grafis, rendering, dan workstation', 'created_at' => $now, 'updated_at' => $now],
            ['id_kategori' => 3, 'nama_kategori' => 'Motherboard', 'keterangan' => 'Mainboard AMD dan Intel berbagai chipset', 'created_at' => $now, 'updated_at' => $now],
            ['id_kategori' => 4, 'nama_kategori' => 'RAM', 'keterangan' => 'Memori DDR4 dan DDR5 untuk PC dan laptop', 'created_at' => $now, 'updated_at' => $now],
            ['id_kategori' => 5, 'nama_kategori' => 'Penyimpanan', 'keterangan' => 'SSD NVMe, SSD SATA, dan perangkat storage', 'created_at' => $now, 'updated_at' => $now],
            ['id_kategori' => 6, 'nama_kategori' => 'Power Supply', 'keterangan' => 'PSU bersertifikasi untuk komputer rakitan', 'created_at' => $now, 'updated_at' => $now],
            ['id_kategori' => 7, 'nama_kategori' => 'Cooling dan Casing', 'keterangan' => 'Pendingin prosesor, fan, thermal paste, dan casing PC', 'created_at' => $now, 'updated_at' => $now],
            ['id_kategori' => 8, 'nama_kategori' => 'Laptop', 'keterangan' => 'Laptop kerja, gaming, dan content creation', 'created_at' => $now, 'updated_at' => $now],
            ['id_kategori' => 9, 'nama_kategori' => 'Monitor', 'keterangan' => 'Monitor kantor, gaming, dan desain', 'created_at' => $now, 'updated_at' => $now],
            ['id_kategori' => 10, 'nama_kategori' => 'Peripheral', 'keterangan' => 'Keyboard, mouse, headset, dan aksesoris komputer', 'created_at' => $now, 'updated_at' => $now],
            ['id_kategori' => 11, 'nama_kategori' => 'Networking', 'keterangan' => 'Router, access point, switch, dan perangkat jaringan', 'created_at' => $now, 'updated_at' => $now],
            ['id_kategori' => 12, 'nama_kategori' => 'Komponen Servis', 'keterangan' => 'Spare part dan perlengkapan servis perangkat IT', 'created_at' => $now, 'updated_at' => $now],
        ]);

        $this->db->table('supplier')->insertBatch([
            ['id_supplier' => 1, 'nama_supplier' => 'AGRES.ID', 'alamat' => 'Jakarta Pusat', 'telepon' => '02130000101', 'email' => 'sales@agresid.test', 'created_at' => $now, 'updated_at' => $now],
            ['id_supplier' => 2, 'nama_supplier' => 'Enter Komputer', 'alamat' => 'Mangga Dua, Jakarta', 'telepon' => '02130000202', 'email' => 'admin@enterkomputer.test', 'created_at' => $now, 'updated_at' => $now],
            ['id_supplier' => 3, 'nama_supplier' => 'Tekno Computer', 'alamat' => 'Bekasi', 'telepon' => '02130000303', 'email' => 'order@teknocomputer.test', 'created_at' => $now, 'updated_at' => $now],
            ['id_supplier' => 4, 'nama_supplier' => 'Nano Komputer', 'alamat' => 'Jakarta Barat', 'telepon' => '02130000404', 'email' => 'sales@nanokomputer.test', 'created_at' => $now, 'updated_at' => $now],
            ['id_supplier' => 5, 'nama_supplier' => 'Pemmz', 'alamat' => 'Jakarta Selatan', 'telepon' => '02130000505', 'email' => 'support@pemmz.test', 'created_at' => $now, 'updated_at' => $now],
            ['id_supplier' => 6, 'nama_supplier' => 'COC Komputer', 'alamat' => 'Tangerang', 'telepon' => '02130000606', 'email' => 'store@coccomputer.test', 'created_at' => $now, 'updated_at' => $now],
        ]);

        $this->db->table('barang')->insertBatch([
            ['id_barang' => 1, 'id_kategori' => 1, 'id_supplier' => 2, 'kode_barang' => 'CPU-R5-5600', 'nama_barang' => 'AMD Ryzen 5 5600', 'stok' => 8, 'satuan' => 'unit', 'harga' => 1899000, 'deskripsi' => 'Prosesor 6 core 12 thread untuk PC gaming dan produktivitas', 'created_at' => $now, 'updated_at' => $now],
            ['id_barang' => 2, 'id_kategori' => 1, 'id_supplier' => 1, 'kode_barang' => 'CPU-I5-12400F', 'nama_barang' => 'Intel Core i5-12400F', 'stok' => 5, 'satuan' => 'unit', 'harga' => 2099000, 'deskripsi' => 'Prosesor Intel generasi ke-12 tanpa integrated graphics', 'created_at' => $now, 'updated_at' => $now],
            ['id_barang' => 3, 'id_kategori' => 2, 'id_supplier' => 2, 'kode_barang' => 'GPU-RTX4060-MSI', 'nama_barang' => 'MSI GeForce RTX 4060 Ventus 2X 8GB', 'stok' => 4, 'satuan' => 'unit', 'harga' => 5099000, 'deskripsi' => 'Kartu grafis NVIDIA RTX 4060 untuk gaming 1080p dan rendering ringan', 'created_at' => $now, 'updated_at' => $now],
            ['id_barang' => 4, 'id_kategori' => 2, 'id_supplier' => 3, 'kode_barang' => 'GPU-RX7600-ASUS', 'nama_barang' => 'ASUS Dual Radeon RX 7600 8GB', 'stok' => 3, 'satuan' => 'unit', 'harga' => 4299000, 'deskripsi' => 'Kartu grafis AMD Radeon RX 7600 dengan memori 8GB', 'created_at' => $now, 'updated_at' => $now],
            ['id_barang' => 5, 'id_kategori' => 3, 'id_supplier' => 4, 'kode_barang' => 'MB-B550M-ASROCK', 'nama_barang' => 'ASRock B550M Steel Legend', 'stok' => 7, 'satuan' => 'unit', 'harga' => 1890000, 'deskripsi' => 'Motherboard AM4 chipset B550 form factor micro ATX', 'created_at' => $now, 'updated_at' => $now],
            ['id_barang' => 6, 'id_kategori' => 3, 'id_supplier' => 1, 'kode_barang' => 'MB-B760M-ASUS', 'nama_barang' => 'ASUS Prime B760M-A WiFi D4', 'stok' => 6, 'satuan' => 'unit', 'harga' => 2499000, 'deskripsi' => 'Motherboard Intel B760 DDR4 dengan konektivitas WiFi', 'created_at' => $now, 'updated_at' => $now],
            ['id_barang' => 7, 'id_kategori' => 4, 'id_supplier' => 2, 'kode_barang' => 'RAM-KF-16D4', 'nama_barang' => 'Kingston Fury Beast 16GB DDR4 3200', 'stok' => 18, 'satuan' => 'pcs', 'harga' => 669000, 'deskripsi' => 'RAM DDR4 kapasitas 16GB untuk PC rakitan', 'created_at' => $now, 'updated_at' => $now],
            ['id_barang' => 8, 'id_kategori' => 4, 'id_supplier' => 4, 'kode_barang' => 'RAM-CV-32D4', 'nama_barang' => 'Corsair Vengeance LPX 32GB DDR4 3200 Kit', 'stok' => 10, 'satuan' => 'kit', 'harga' => 1299000, 'deskripsi' => 'Paket RAM dual channel 32GB untuk gaming dan editing', 'created_at' => $now, 'updated_at' => $now],
            ['id_barang' => 9, 'id_kategori' => 5, 'id_supplier' => 1, 'kode_barang' => 'SSD-S980-500', 'nama_barang' => 'Samsung 980 NVMe M.2 500GB', 'stok' => 15, 'satuan' => 'pcs', 'harga' => 799000, 'deskripsi' => 'SSD NVMe M.2 untuk sistem operasi dan aplikasi utama', 'created_at' => $now, 'updated_at' => $now],
            ['id_barang' => 10, 'id_kategori' => 5, 'id_supplier' => 3, 'kode_barang' => 'SSD-SN580-1TB', 'nama_barang' => 'WD Blue SN580 NVMe 1TB', 'stok' => 12, 'satuan' => 'pcs', 'harga' => 1049000, 'deskripsi' => 'SSD NVMe 1TB untuk penyimpanan cepat', 'created_at' => $now, 'updated_at' => $now],
            ['id_barang' => 11, 'id_kategori' => 6, 'id_supplier' => 2, 'kode_barang' => 'PSU-CM-650B', 'nama_barang' => 'Cooler Master MWE 650 Bronze V2', 'stok' => 9, 'satuan' => 'unit', 'harga' => 879000, 'deskripsi' => 'Power supply 650W 80 Plus Bronze untuk PC gaming menengah', 'created_at' => $now, 'updated_at' => $now],
            ['id_barang' => 12, 'id_kategori' => 6, 'id_supplier' => 4, 'kode_barang' => 'PSU-SS-GX750', 'nama_barang' => 'Seasonic Focus GX-750 80+ Gold', 'stok' => 5, 'satuan' => 'unit', 'harga' => 1849000, 'deskripsi' => 'Power supply 750W modular dengan sertifikasi 80 Plus Gold', 'created_at' => $now, 'updated_at' => $now],
            ['id_barang' => 13, 'id_kategori' => 7, 'id_supplier' => 3, 'kode_barang' => 'CLR-DC-AK400', 'nama_barang' => 'DeepCool AK400', 'stok' => 14, 'satuan' => 'unit', 'harga' => 399000, 'deskripsi' => 'Air cooler single tower untuk prosesor desktop', 'created_at' => $now, 'updated_at' => $now],
            ['id_barang' => 14, 'id_kategori' => 7, 'id_supplier' => 6, 'kode_barang' => 'CAS-TW-FM2', 'nama_barang' => 'Tecware Forge M2', 'stok' => 6, 'satuan' => 'unit', 'harga' => 599000, 'deskripsi' => 'Casing micro ATX airflow dengan tempered glass', 'created_at' => $now, 'updated_at' => $now],
            ['id_barang' => 15, 'id_kategori' => 8, 'id_supplier' => 5, 'kode_barang' => 'LTP-LNV-LS5', 'nama_barang' => 'Lenovo Legion Slim 5 16APH8', 'stok' => 3, 'satuan' => 'unit', 'harga' => 18999000, 'deskripsi' => 'Laptop gaming dan content creation dengan layar 16 inci', 'created_at' => $now, 'updated_at' => $now],
            ['id_barang' => 16, 'id_kategori' => 8, 'id_supplier' => 1, 'kode_barang' => 'LTP-ASUS-A15', 'nama_barang' => 'ASUS TUF Gaming A15', 'stok' => 2, 'satuan' => 'unit', 'harga' => 14999000, 'deskripsi' => 'Laptop gaming seri TUF untuk performa harian dan grafis', 'created_at' => $now, 'updated_at' => $now],
            ['id_barang' => 17, 'id_kategori' => 10, 'id_supplier' => 2, 'kode_barang' => 'PRF-LG-G304', 'nama_barang' => 'Logitech G304 Lightspeed', 'stok' => 25, 'satuan' => 'pcs', 'harga' => 459000, 'deskripsi' => 'Mouse wireless gaming dengan sensor HERO', 'created_at' => $now, 'updated_at' => $now],
            ['id_barang' => 18, 'id_kategori' => 10, 'id_supplier' => 6, 'kode_barang' => 'PRF-FT-MAX61', 'nama_barang' => 'Fantech Maxfit61 Frost', 'stok' => 11, 'satuan' => 'pcs', 'harga' => 529000, 'deskripsi' => 'Keyboard mekanikal compact 60 persen untuk setup gaming', 'created_at' => $now, 'updated_at' => $now],
            ['id_barang' => 19, 'id_kategori' => 11, 'id_supplier' => 3, 'kode_barang' => 'NET-TP-AX23', 'nama_barang' => 'TP-Link Archer AX23', 'stok' => 8, 'satuan' => 'unit', 'harga' => 749000, 'deskripsi' => 'Router WiFi 6 dual band untuk rumah dan kantor kecil', 'created_at' => $now, 'updated_at' => $now],
            ['id_barang' => 20, 'id_kategori' => 9, 'id_supplier' => 4, 'kode_barang' => 'MON-LG-24GN60R', 'nama_barang' => 'LG UltraGear 24GN60R', 'stok' => 4, 'satuan' => 'unit', 'harga' => 2199000, 'deskripsi' => 'Monitor gaming 24 inci refresh rate tinggi', 'created_at' => $now, 'updated_at' => $now],
        ]);

        $this->db->table('stok_histori')->insertBatch([
            ['id_barang' => 1, 'jenis' => 'masuk', 'jumlah' => 8, 'keterangan' => 'Stok awal dari Enter Komputer', 'tanggal' => date('Y-m-d'), 'created_at' => $now, 'updated_at' => $now],
            ['id_barang' => 2, 'jenis' => 'masuk', 'jumlah' => 5, 'keterangan' => 'Stok awal dari AGRES.ID', 'tanggal' => date('Y-m-d'), 'created_at' => $now, 'updated_at' => $now],
            ['id_barang' => 3, 'jenis' => 'masuk', 'jumlah' => 5, 'keterangan' => 'Stok awal GPU NVIDIA', 'tanggal' => date('Y-m-d'), 'created_at' => $now, 'updated_at' => $now],
            ['id_barang' => 4, 'jenis' => 'masuk', 'jumlah' => 3, 'keterangan' => 'Stok awal GPU AMD', 'tanggal' => date('Y-m-d'), 'created_at' => $now, 'updated_at' => $now],
            ['id_barang' => 5, 'jenis' => 'masuk', 'jumlah' => 7, 'keterangan' => 'Stok awal motherboard AM4', 'tanggal' => date('Y-m-d'), 'created_at' => $now, 'updated_at' => $now],
            ['id_barang' => 6, 'jenis' => 'masuk', 'jumlah' => 6, 'keterangan' => 'Stok awal motherboard Intel', 'tanggal' => date('Y-m-d'), 'created_at' => $now, 'updated_at' => $now],
            ['id_barang' => 7, 'jenis' => 'masuk', 'jumlah' => 20, 'keterangan' => 'Stok awal RAM DDR4', 'tanggal' => date('Y-m-d'), 'created_at' => $now, 'updated_at' => $now],
            ['id_barang' => 8, 'jenis' => 'masuk', 'jumlah' => 10, 'keterangan' => 'Stok awal paket RAM 32GB', 'tanggal' => date('Y-m-d'), 'created_at' => $now, 'updated_at' => $now],
            ['id_barang' => 9, 'jenis' => 'masuk', 'jumlah' => 15, 'keterangan' => 'Stok awal SSD Samsung', 'tanggal' => date('Y-m-d'), 'created_at' => $now, 'updated_at' => $now],
            ['id_barang' => 10, 'jenis' => 'masuk', 'jumlah' => 12, 'keterangan' => 'Stok awal SSD WD', 'tanggal' => date('Y-m-d'), 'created_at' => $now, 'updated_at' => $now],
            ['id_barang' => 11, 'jenis' => 'masuk', 'jumlah' => 9, 'keterangan' => 'Stok awal PSU 650W', 'tanggal' => date('Y-m-d'), 'created_at' => $now, 'updated_at' => $now],
            ['id_barang' => 12, 'jenis' => 'masuk', 'jumlah' => 5, 'keterangan' => 'Stok awal PSU modular', 'tanggal' => date('Y-m-d'), 'created_at' => $now, 'updated_at' => $now],
            ['id_barang' => 13, 'jenis' => 'masuk', 'jumlah' => 14, 'keterangan' => 'Stok awal cooling', 'tanggal' => date('Y-m-d'), 'created_at' => $now, 'updated_at' => $now],
            ['id_barang' => 14, 'jenis' => 'masuk', 'jumlah' => 6, 'keterangan' => 'Stok awal casing', 'tanggal' => date('Y-m-d'), 'created_at' => $now, 'updated_at' => $now],
            ['id_barang' => 15, 'jenis' => 'masuk', 'jumlah' => 4, 'keterangan' => 'Stok awal laptop Lenovo', 'tanggal' => date('Y-m-d'), 'created_at' => $now, 'updated_at' => $now],
            ['id_barang' => 16, 'jenis' => 'masuk', 'jumlah' => 2, 'keterangan' => 'Stok awal laptop ASUS', 'tanggal' => date('Y-m-d'), 'created_at' => $now, 'updated_at' => $now],
            ['id_barang' => 17, 'jenis' => 'masuk', 'jumlah' => 28, 'keterangan' => 'Stok awal mouse wireless', 'tanggal' => date('Y-m-d'), 'created_at' => $now, 'updated_at' => $now],
            ['id_barang' => 18, 'jenis' => 'masuk', 'jumlah' => 11, 'keterangan' => 'Stok awal keyboard mekanikal', 'tanggal' => date('Y-m-d'), 'created_at' => $now, 'updated_at' => $now],
            ['id_barang' => 19, 'jenis' => 'masuk', 'jumlah' => 8, 'keterangan' => 'Stok awal router WiFi 6', 'tanggal' => date('Y-m-d'), 'created_at' => $now, 'updated_at' => $now],
            ['id_barang' => 20, 'jenis' => 'masuk', 'jumlah' => 4, 'keterangan' => 'Stok awal monitor gaming', 'tanggal' => date('Y-m-d'), 'created_at' => $now, 'updated_at' => $now],
            ['id_barang' => 3, 'jenis' => 'keluar', 'jumlah' => 1, 'keterangan' => 'Terjual untuk paket rakitan gaming', 'tanggal' => date('Y-m-d'), 'created_at' => $now, 'updated_at' => $now],
            ['id_barang' => 7, 'jenis' => 'keluar', 'jumlah' => 2, 'keterangan' => 'Terjual untuk upgrade memori pelanggan', 'tanggal' => date('Y-m-d'), 'created_at' => $now, 'updated_at' => $now],
            ['id_barang' => 15, 'jenis' => 'keluar', 'jumlah' => 1, 'keterangan' => 'Booking unit display', 'tanggal' => date('Y-m-d'), 'created_at' => $now, 'updated_at' => $now],
            ['id_barang' => 17, 'jenis' => 'keluar', 'jumlah' => 3, 'keterangan' => 'Penjualan aksesoris harian', 'tanggal' => date('Y-m-d'), 'created_at' => $now, 'updated_at' => $now],
        ]);
    }
}
