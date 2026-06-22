CREATE DATABASE IF NOT EXISTS uas_web_2 CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE uas_web_2;
SET FOREIGN_KEY_CHECKS = 0;

DROP TABLE IF EXISTS stok_histori;
DROP TABLE IF EXISTS barang;
DROP TABLE IF EXISTS supplier;
DROP TABLE IF EXISTS kategori;
DROP TABLE IF EXISTS users;
SET FOREIGN_KEY_CHECKS = 1;

CREATE TABLE users (
    id_user INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(120) NOT NULL,
    email VARCHAR(120) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    token VARCHAR(255) NULL,
    created_at DATETIME NULL,
    updated_at DATETIME NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE kategori (
    id_kategori INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nama_kategori VARCHAR(100) NOT NULL,
    keterangan TEXT NULL,
    created_at DATETIME NULL,
    updated_at DATETIME NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE supplier (
    id_supplier INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nama_supplier VARCHAR(120) NOT NULL,
    alamat TEXT NULL,
    telepon VARCHAR(30) NULL,
    email VARCHAR(120) NULL,
    created_at DATETIME NULL,
    updated_at DATETIME NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE barang (
    id_barang INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    id_kategori INT UNSIGNED NOT NULL,
    id_supplier INT UNSIGNED NOT NULL,
    kode_barang VARCHAR(40) NOT NULL UNIQUE,
    nama_barang VARCHAR(150) NOT NULL,
    stok INT NOT NULL DEFAULT 0,
    satuan VARCHAR(30) NOT NULL,
    harga DECIMAL(14,2) NOT NULL DEFAULT 0,
    deskripsi TEXT NULL,
    created_at DATETIME NULL,
    updated_at DATETIME NULL,
    CONSTRAINT fk_barang_kategori FOREIGN KEY (id_kategori) REFERENCES kategori(id_kategori) ON UPDATE CASCADE ON DELETE RESTRICT,
    CONSTRAINT fk_barang_supplier FOREIGN KEY (id_supplier) REFERENCES supplier(id_supplier) ON UPDATE CASCADE ON DELETE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE stok_histori (
    id_histori INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    id_barang INT UNSIGNED NOT NULL,
    jenis ENUM('masuk', 'keluar') NOT NULL,
    jumlah INT NOT NULL,
    keterangan TEXT NULL,
    tanggal DATE NOT NULL,
    created_at DATETIME NULL,
    updated_at DATETIME NULL,
    CONSTRAINT fk_histori_barang FOREIGN KEY (id_barang) REFERENCES barang(id_barang) ON UPDATE CASCADE ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO users (nama, email, password, token, created_at, updated_at) VALUES
('Administrator', 'admin@inventory.test', '$2y$12$3oFEw6zFGaPoBW7weKUrz.5o38ROgCiMJ1bxfyFxqxhiGnF4a/Ed2', NULL, NOW(), NOW());

INSERT INTO kategori (id_kategori, nama_kategori, keterangan, created_at, updated_at) VALUES
(1, 'Prosesor', 'CPU desktop untuk rakitan gaming, workstation ringan, dan upgrade platform.', NOW(), NOW()),
(2, 'Kartu Grafis', 'GPU untuk gaming, rendering, desain grafis, dan kebutuhan akselerasi visual.', NOW(), NOW()),
(3, 'Motherboard', 'Mainboard AMD dan Intel dengan dukungan chipset, slot ekspansi, dan storage modern.', NOW(), NOW()),
(4, 'RAM', 'Memori DDR4 dan DDR5 untuk PC rakitan, editing, multitasking, dan upgrade laptop.', NOW(), NOW()),
(5, 'Penyimpanan', 'SSD NVMe, SSD SATA, dan perangkat storage untuk sistem operasi maupun data kerja.', NOW(), NOW()),
(6, 'Power Supply', 'PSU bersertifikasi untuk menjaga suplai daya sistem tetap stabil dan aman.', NOW(), NOW()),
(7, 'Cooling dan Casing', 'Pendingin prosesor, casing airflow, fan, dan komponen pendukung suhu sistem.', NOW(), NOW()),
(8, 'Laptop', 'Laptop gaming, produktivitas, content creation, dan kebutuhan kerja mobile.', NOW(), NOW()),
(9, 'Monitor', 'Monitor gaming, kantor, desain, dan kebutuhan display harian.', NOW(), NOW()),
(10, 'Peripheral', 'Keyboard, mouse, headset, dan aksesoris pendukung setup komputer.', NOW(), NOW()),
(11, 'Networking', 'Router, access point, switch, dan perangkat jaringan untuk rumah atau kantor.', NOW(), NOW()),
(12, 'PC Rakitan', 'Unit komputer rakitan siap pakai berdasarkan kebutuhan gaming, kerja, dan editing.', NOW(), NOW()),
(13, 'Komponen Servis', 'Spare part dan perlengkapan servis untuk perawatan perangkat IT.', NOW(), NOW()),
(14, 'Audio Gear', 'Microphone, speaker, headset, soundcard, dan perangkat audio pendukung.', NOW(), NOW());

INSERT INTO supplier (id_supplier, nama_supplier, alamat, telepon, email, created_at, updated_at) VALUES
(1, 'AGRES.ID', 'Jakarta Pusat', '02130000101', 'sales@agresid.test', NOW(), NOW()),
(2, 'Enter Komputer', 'Mangga Dua, Jakarta', '02130000202', 'admin@enterkomputer.test', NOW(), NOW()),
(3, 'Tekno Computer', 'Bekasi', '02130000303', 'order@teknocomputer.test', NOW(), NOW()),
(4, 'Nano Komputer', 'Jakarta Barat', '02130000404', 'sales@nanokomputer.test', NOW(), NOW()),
(5, 'Pemmz', 'Jakarta Selatan', '02130000505', 'support@pemmz.test', NOW(), NOW()),
(6, 'COC Komputer', 'Tangerang', '02130000606', 'store@coccomputer.test', NOW(), NOW()),
(7, 'Rakitan.com', 'Jakarta Utara', '02130000707', 'sales@rakitan.test', NOW(), NOW()),
(8, 'Sim Lim Tech Store', 'Jakarta', '02188990011', 'sales@simlimtech.test', NOW(), NOW());

INSERT INTO barang (id_barang, id_kategori, id_supplier, kode_barang, nama_barang, stok, satuan, harga, deskripsi, created_at, updated_at) VALUES
(1, 1, 2, 'CPU-R5-5600', 'AMD Ryzen 5 5600', 8, 'unit', 1899000.00, 'Socket AM4, 6 core 12 thread, base 3,5GHz, boost hingga 4,4GHz, L3 cache 32MB, TDP 65W. Cocok untuk rakitan gaming 1080p dan PC produktivitas.', NOW(), NOW()),
(2, 1, 1, 'CPU-I5-12400F', 'Intel Core i5-12400F', 5, 'unit', 2099000.00, 'Socket LGA1700, 6 Performance-core 12 thread, base 2,5GHz, turbo hingga 4,4GHz, Intel Smart Cache 18MB, base power 65W. Varian F membutuhkan VGA terpisah.', NOW(), NOW()),
(3, 2, 2, 'GPU-RTX4060-MSI', 'MSI GeForce RTX 4060 Ventus 2X Black 8G OC', 4, 'unit', 5099000.00, 'GPU NVIDIA RTX 4060, 3072 CUDA core, 8GB GDDR6 128-bit 17Gbps, PCIe 4.0 x8, output 3 DisplayPort dan 1 HDMI, konsumsi daya sekitar 115W.', NOW(), NOW()),
(4, 2, 3, 'GPU-RX7600-ASUS', 'ASUS Dual Radeon RX 7600 OC 8GB', 3, 'unit', 4299000.00, 'GPU AMD Radeon RX 7600, 2048 stream processor, 8GB GDDR6 128-bit 18Gbps, boost OC hingga 2745MHz, 1 HDMI 2.1 dan 3 DisplayPort 1.4a.', NOW(), NOW()),
(5, 3, 4, 'MB-B550M-ASROCK', 'ASRock B550M Steel Legend', 7, 'unit', 1890000.00, 'Motherboard mATX AMD AM4 chipset B550, 4 slot DDR4 hingga 4733+ OC, PCIe 4.0 x16, Hyper M.2 PCIe Gen4 x4, serta slot M.2 tambahan PCIe Gen3/SATA.', NOW(), NOW()),
(6, 3, 1, 'MB-B760M-ASUS', 'ASUS Prime B760M-A WiFi D4', 6, 'unit', 2499000.00, 'Motherboard mATX Intel LGA1700 chipset B760, mendukung prosesor Intel Gen 12/13/14, DDR4, PCIe 4.0, 2 slot M.2, WiFi 6, Realtek 2.5Gb Ethernet, dan USB 3.2 Gen 2.', NOW(), NOW()),
(7, 4, 2, 'RAM-KF-16D4', 'Kingston Fury Beast 16GB DDR4-3200 CL16', 18, 'pcs', 669000.00, 'RAM desktop 16GB DDR4 3200MT/s, timing CL16-18-18, voltase 1,35V, form factor 288-pin DIMM, mendukung Intel XMP 2.0 untuk profil performa.', NOW(), NOW()),
(8, 4, 4, 'RAM-CV-32D4', 'Corsair Vengeance LPX 32GB DDR4-3200 C16 Kit', 10, 'kit', 1299000.00, 'Kit RAM 32GB 2x16GB DDR4 3200MHz, timing 16-20-20-38, voltase 1,35V, XMP 2.0, heat spreader low-profile untuk casing dengan ruang terbatas.', NOW(), NOW()),
(9, 5, 1, 'SSD-S980-500', 'Samsung 980 NVMe M.2 500GB', 15, 'pcs', 799000.00, 'SSD M.2 2280 NVMe PCIe 3.0 x4, kapasitas 500GB, sequential read hingga 3100MB/s dan write hingga 2600MB/s, controller Samsung dengan Host Memory Buffer.', NOW(), NOW()),
(10, 5, 3, 'SSD-SN580-1TB', 'WD Blue SN580 NVMe M.2 1TB', 12, 'pcs', 1049000.00, 'SSD M.2 NVMe PCIe Gen4 kapasitas 1TB, sequential read/write hingga 4150MB/s, cocok untuk OS, aplikasi kreatif, game library, dan transfer file besar.', NOW(), NOW()),
(11, 6, 2, 'PSU-CM-650B', 'Cooler Master MWE 650 Bronze V2 230V', 9, 'unit', 879000.00, 'PSU ATX 650W 80 PLUS Bronze 230V, efisiensi tipikal 88%, desain DC-to-DC + LLC, fan 120mm, kabel flat, cocok untuk rakitan gaming kelas menengah.', NOW(), NOW()),
(12, 6, 4, 'PSU-SS-GX750', 'Seasonic Focus GX-750 80+ Gold', 5, 'unit', 1849000.00, 'PSU 750W 80 PLUS Gold, fully modular, dimensi 140x150x86mm, efisiensi hingga 90% pada beban 50%, cocok untuk sistem GPU menengah ke atas.', NOW(), NOW()),
(13, 7, 3, 'CLR-DC-AK400', 'DeepCool AK400', 14, 'unit', 399000.00, 'Air cooler single tower dengan 4 heatpipe 6mm, fan 120mm PWM 500-1850RPM, airflow hingga 68,99CFM, noise maksimal 28dBA, tinggi sekitar 155-156mm.', NOW(), NOW()),
(14, 7, 6, 'CAS-TW-FM2', 'Tecware Forge M2 ARGB', 6, 'unit', 599000.00, 'Casing mini tower mATX/ITX dengan panel tempered glass, dukungan GPU hingga 300mm, tinggi cooler hingga 165mm, radiator depan hingga 240mm, ukuran 350x200x390mm.', NOW(), NOW()),
(15, 8, 5, 'LTP-LNV-LS5', 'Lenovo Legion Slim 5 16APH8', 3, 'unit', 18999000.00, 'Laptop 16 inci WQXGA 2560x1600 165Hz, AMD Ryzen 7 7840HS, NVIDIA GeForce RTX 4060 8GB, RAM 16GB DDR5, SSD NVMe 512GB, WiFi 6E, Bluetooth 5.3.', NOW(), NOW()),
(16, 8, 1, 'LTP-ASUS-A15', 'ASUS TUF Gaming A15 FA507NUR', 2, 'unit', 14999000.00, 'Laptop gaming 15,6 inci FHD 144Hz, AMD Ryzen 7 7435HS, NVIDIA GeForce RTX 4050, RAM DDR5 16GB, SSD PCIe 512GB, WiFi 6, Windows 11.', NOW(), NOW()),
(17, 10, 2, 'PRF-LG-G304', 'Logitech G304 Lightspeed', 25, 'pcs', 459000.00, 'Mouse wireless gaming dengan sensor HERO 200-12000DPI, koneksi LIGHTSPEED 1ms, 6 tombol programmable, onboard memory, dan daya tahan baterai hingga 250 jam.', NOW(), NOW()),
(18, 10, 6, 'PRF-FT-MAX61', 'Fantech Maxfit61 Frost Wireless', 11, 'pcs', 529000.00, 'Keyboard mekanikal 60% dengan koneksi tri-mode wired, 2.4GHz, dan Bluetooth, hot-swappable switch, RGB backlight, detachable Type-C, dan full anti-ghosting.', NOW(), NOW()),
(19, 11, 3, 'NET-TP-AX23', 'TP-Link Archer AX23 AX1800 WiFi 6', 8, 'unit', 749000.00, 'Router WiFi 6 dual-band AX1800, kecepatan hingga 1201Mbps pada 5GHz dan 574Mbps pada 2,4GHz, dual-core CPU, OFDMA, beamforming, 1 WAN gigabit dan 4 LAN gigabit.', NOW(), NOW()),
(20, 9, 4, 'MON-LG-24GN60R', 'LG UltraGear 24GN60R-B', 4, 'unit', 2199000.00, 'Monitor gaming 23,8 inci IPS Full HD 1920x1080, refresh rate 144Hz, response time 1ms GtG, sRGB 99%, HDR10, AMD FreeSync Premium, HDMI dan DisplayPort.', NOW(), NOW()),
(21, 12, 7, 'PC-R5-RTX4060', 'PC Rakitan Gaming Ryzen 5 RTX 4060', 2, 'unit', 11999000.00, 'Paket PC siap pakai dengan Ryzen 5 5600, RTX 4060 8GB, RAM 16GB DDR4 3200, SSD NVMe 1TB, PSU 650W Bronze, casing airflow, dan Windows siap instal.', NOW(), NOW()),
(22, 12, 7, 'PC-I5-OFFICE', 'PC Rakitan Office Intel i5 Gen 12', 5, 'unit', 7799000.00, 'Paket PC kerja dengan Intel Core i5-12400F, VGA basic display, RAM 16GB DDR4, SSD NVMe 500GB, motherboard B760, PSU 550W, dan casing mATX.', NOW(), NOW()),
(23, 8, 1, 'Predator PHN16-71', 'Acer PREDATOR HELIOS NEO 16', 1, 'unit', 21323221.35, '', NOW(), NOW());

INSERT INTO stok_histori (id_barang, jenis, jumlah, keterangan, tanggal, created_at, updated_at) VALUES
(1, 'masuk', 8, 'Stok awal AMD Ryzen 5 5600', CURDATE(), NOW(), NOW()),
(2, 'masuk', 5, 'Stok awal Intel Core i5-12400F', CURDATE(), NOW(), NOW()),
(3, 'masuk', 4, 'Stok awal MSI GeForce RTX 4060 Ventus 2X Black 8G OC', CURDATE(), NOW(), NOW()),
(4, 'masuk', 3, 'Stok awal ASUS Dual Radeon RX 7600 OC 8GB', CURDATE(), NOW(), NOW()),
(5, 'masuk', 7, 'Stok awal ASRock B550M Steel Legend', CURDATE(), NOW(), NOW()),
(6, 'masuk', 6, 'Stok awal ASUS Prime B760M-A WiFi D4', CURDATE(), NOW(), NOW()),
(7, 'masuk', 18, 'Stok awal Kingston Fury Beast 16GB DDR4-3200 CL16', CURDATE(), NOW(), NOW()),
(8, 'masuk', 10, 'Stok awal Corsair Vengeance LPX 32GB DDR4-3200 C16 Kit', CURDATE(), NOW(), NOW()),
(9, 'masuk', 15, 'Stok awal Samsung 980 NVMe M.2 500GB', CURDATE(), NOW(), NOW()),
(10, 'masuk', 12, 'Stok awal WD Blue SN580 NVMe M.2 1TB', CURDATE(), NOW(), NOW()),
(11, 'masuk', 9, 'Stok awal Cooler Master MWE 650 Bronze V2 230V', CURDATE(), NOW(), NOW()),
(12, 'masuk', 5, 'Stok awal Seasonic Focus GX-750 80+ Gold', CURDATE(), NOW(), NOW()),
(13, 'masuk', 14, 'Stok awal DeepCool AK400', CURDATE(), NOW(), NOW()),
(14, 'masuk', 6, 'Stok awal Tecware Forge M2 ARGB', CURDATE(), NOW(), NOW()),
(15, 'masuk', 3, 'Stok awal Lenovo Legion Slim 5 16APH8', CURDATE(), NOW(), NOW()),
(16, 'masuk', 2, 'Stok awal ASUS TUF Gaming A15 FA507NUR', CURDATE(), NOW(), NOW()),
(17, 'masuk', 25, 'Stok awal Logitech G304 Lightspeed', CURDATE(), NOW(), NOW()),
(18, 'masuk', 11, 'Stok awal Fantech Maxfit61 Frost Wireless', CURDATE(), NOW(), NOW()),
(19, 'masuk', 8, 'Stok awal TP-Link Archer AX23 AX1800 WiFi 6', CURDATE(), NOW(), NOW()),
(20, 'masuk', 4, 'Stok awal LG UltraGear 24GN60R-B', CURDATE(), NOW(), NOW()),
(21, 'masuk', 2, 'Stok awal PC Rakitan Gaming Ryzen 5 RTX 4060', CURDATE(), NOW(), NOW()),
(22, 'masuk', 3, 'Stok awal PC Rakitan Office Intel i5 Gen 12', CURDATE(), NOW(), NOW()),
(3, 'keluar', 1, 'Terjual untuk paket rakitan gaming', CURDATE(), NOW(), NOW()),
(7, 'keluar', 2, 'Upgrade memori pelanggan', CURDATE(), NOW(), NOW()),
(15, 'keluar', 1, 'Unit display untuk demo toko', CURDATE(), NOW(), NOW()),
(17, 'keluar', 3, 'Penjualan aksesoris harian', CURDATE(), NOW(), NOW()),
(21, 'masuk', 1, 'Tambahan unit rakitan prebuilt', CURDATE(), NOW(), NOW()),
(22, 'masuk', 2, 'Penyesuaian stok PC rakitan office saat pengujian form', CURDATE(), NOW(), NOW());
