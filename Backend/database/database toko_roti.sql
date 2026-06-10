CREATE DATABASE IF NOT EXISTS toko_roti;
USE toko_roti;

-- Tabel 1: Kategori Roti
CREATE TABLE kategori (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama_kategori VARCHAR(100) NOT NULL,
    deskripsi TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Tabel 2: Produk Roti (Relasi ke Kategori)
CREATE TABLE produk (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_kategori INT NOT NULL,
    nama_produk VARCHAR(150) NOT NULL,
    harga INT NOT NULL,
    stok INT NOT NULL DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_kategori) REFERENCES kategori(id) ON DELETE CASCADE
);

-- Tabel 3: Pelanggan
CREATE TABLE pelanggan (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama_lengkap VARCHAR(150) NOT NULL,
    email VARCHAR(100) UNIQUE,
    no_telp VARCHAR(20),
    alamat TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Tabel 4: Pesanan / Transaksi Utama (Relasi ke Pelanggan)
CREATE TABLE pesanan (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_pelanggan INT NOT NULL,
    tanggal_pesanan DATETIME DEFAULT CURRENT_TIMESTAMP,
    total_harga INT NOT NULL DEFAULT 0,
    status_pembayaran ENUM('Pending', 'Lunas', 'Batal') DEFAULT 'Pending',
    FOREIGN KEY (id_pelanggan) REFERENCES pelanggan(id) ON DELETE CASCADE
);

-- Tabel 5: Detail Pesanan (Relasi ke Pesanan dan Produk)
CREATE TABLE detail_pesanan (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_pesanan INT NOT NULL,
    id_produk INT NOT NULL,
    jumlah INT NOT NULL,
    subtotal INT NOT NULL,
    FOREIGN KEY (id_pesanan) REFERENCES pesanan(id) ON DELETE CASCADE,
    FOREIGN KEY (id_produk) REFERENCES produk(id) ON DELETE CASCADE
);

-- Tabel 6: user baru
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    api_key VARCHAR(100) NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);


-- ==========================================================
-- 2. MENGISI DATA (DML) - MINIMAL 25 RECORD PER TABEL
-- ==========================================================

-- Isi Tabel Kategori (25 Record)
INSERT INTO kategori (nama_kategori, deskripsi) VALUES
('Roti Tawar', 'Berbagai jenis roti tawar untuk sarapan'),
('Roti Manis', 'Roti lembut dengan berbagai isian manis'),
('Roti Sobek', 'Roti porsi besar yang bisa disobek'),
('Kue Kering', 'Kue renyah tahan lama seperti nastar dan kastengel'),
('Kue Basah', 'Jajanan pasar dan kue tradisional'),
('Cake & Tart', 'Kue ulang tahun dan kue bolu besar'),
('Pastry', 'Kue berlapis yang renyah seperti puff pastry'),
('Croissant', 'Roti sabit khas Prancis yang flaking'),
('Donat', 'Roti goreng berbentuk cincin dengan topping'),
('Cookies', 'Kue kukis dengan berbagai rasa dan choco chip'),
('Dessert Box', 'Kue dalam kotak yang disajikan dingin'),
('Pudding', 'Hidangan penutup lembut dan manis'),
('Pie', 'Kue panggang dengan kulit renyah dan isian'),
('Muffin', 'Kue manggang padat mirip cupcake tanpa frosting'),
('Scone', 'Kue panggang tradisional Inggris teman minum teh'),
('Baguette', 'Roti panjang bertekstur keras khas Prancis'),
('Cheese Roll', 'Roti gulung dengan isian keju gurih'),
('Chiffon Cake', 'Kue bolu yang sangat lembut dan berongga'),
('Sponge Cake', 'Kue dasar bertekstur membal'),
('Roll Cake', 'Bolu gulung dengan selai atau krim'),
('Eclair', 'Pastry panjang dengan isian krim dan toping cokelat'),
('Churros', 'Donat spanyol yang digoreng panjang dengan kayu manis'),
('Croffle', 'Perpaduan adonan croissant yang dicetak di alat waffle'),
('Bika Ambon', 'Kue tradisional berongga khas Medan'),
('Roti Sisir', 'Roti klasik yang dioles mentega dan gula');

-- Isi Tabel Produk (25 Record)
INSERT INTO produk (id_kategori, nama_produk, harga, stok) VALUES
(1, 'Roti Tawar Gandum', 18000, 50),
(2, 'Roti Cokelat Lumer', 9000, 100),
(2, 'Roti Keju Susu', 9500, 85),
(3, 'Roti Sobek Kombinasi', 22000, 30),
(4, 'Nastar Premium 500g', 85000, 40),
(4, 'Kastengel Keju Edam', 90000, 35),
(6, 'Black Forest Small', 150000, 15),
(6, 'Red Velvet Cake Slice', 35000, 20),
(7, 'Cromboloni Chocolate', 28000, 45),
(8, 'Butter Croissant Original', 18000, 60),
(8, 'Almond Croissant', 24000, 40),
(9, 'Donat Kampung Isi 6', 30000, 25),
(10, 'Soft Choco Cookies', 15000, 70),
(11, 'Matcha Tiramisu Box', 45000, 20),
(12, 'Pudding Cokelat Fla', 25000, 30),
(13, 'Apple Pie Medium', 65000, 12),
(14, 'Blueberry Muffin', 16000, 50),
(16, 'French Baguette Classic', 20000, 15),
(17, 'Crispy Cheese Roll', 12000, 90),
(18, 'Pandan Chiffon Cake', 55000, 18),
(20, 'Bolu Gulung Meranti', 75000, 25),
(21, 'Chocolate Eclair', 14000, 40),
(22, 'Churros Isi Chocolate 5pcs', 20000, 35),
(23, 'Caramel Croffle', 15000, 65),
(24, 'Bika Ambon Ukuran Besar', 60000, 10);

-- Isi Tabel Pelanggan (25 Record)
INSERT INTO pelanggan (nama_lengkap, email, no_telp, alamat) VALUES
('Ahmad Fauzi', 'ahmad@email.com', '081234567890', 'Jl. Merdeka No. 10, Jakarta'),
('Budi Santoso', 'budi@email.com', '081234567891', 'Jl. Mawar No. 5, Bandung'),
('Citra Lestari', 'citra@email.com', '081234567892', 'Jl. Anggrek No. 12, Surabaya'),
('Dewi Sartika', 'dewi@email.com', '081234567893', 'Jl. Diponegoro No. 8, Semarang'),
('Eko Prasetyo', 'eko@email.com', '081234567894', 'Jl. Sudirman No. 45, Yogyakarta'),
('Fajar Hidayat', 'fajar@email.com', '081234567895', 'Jl. Gajah Mada No. 21, Medan'),
('Gita Permata', 'gita@email.com', '081234567896', 'Jl. Pemuda No. 3, Makassar'),
('Hadi Wijaya', 'hadi@email.com', '081234567897', 'Jl. Melati No. 14, Palembang'),
('Indah Cahyani', 'indah@email.com', '081234567898', 'Jl. Kenanga No. 9, Denpasar'),
('Joko Widodo', 'joko@email.com', '081234567899', 'Jl. Solo No. 100, Surakarta'),
('Kartika Putri', 'kartika@email.com', '081234567800', 'Jl. Dahlia No. 7, Malang'),
('Lestari Ningsih', 'lestari@email.com', '081234567801', 'Jl. Flamboyan No. 2, Bogor'),
('Mega Utami', 'mega@email.com', '081234567802', 'Jl. Tulip No. 11, Bekasi'),
('Nugroho Adi', 'nugroho@email.com', '081234567803', 'Jl. Orchid No. 4, Tangerang'),
('Oki Setiana', 'oki@email.com', '081234567804', 'Jl. Sakura No. 18, Depok'),
('Putra Pratama', 'putra@email.com', '081234567805', 'Jl. Kamboja No. 6, Balikpapan'),
('Qori Sandioriva', 'qori@email.com', '081234567806', 'Jl. Teratai No. 15, Samarinda'),
('Rian Hidayat', 'rian@email.com', '081234567807', 'Jl. Tanjung No. 22, Banjarmasin'),
('Siti Aminah', 'siti@email.com', '081234567808', 'Jl. Pahlawan No. 33, Padang'),
('Taufik Hidayat', 'taufik@email.com', '081234567809', 'Jl. Cempaka No. 17, Pekanbaru'),
('Utari Putri', 'utari@email.com', '081234567811', 'Jl. Bougenville No. 29, Pontianak'),
('Vino Bastian', 'vino@email.com', '081234567812', 'Jl. Raden Saleh No. 50, Jakarta'),
('Wulan Guritno', 'wulan@email.com', '081234567813', 'Jl. Wijaya No. 88, Bandung'),
('Xavier Malik', 'xavier@email.com', '081234567814', 'Jl. Sunset Road No. 9, Badung'),
('Yayan Ruhian', 'yayan@email.com', '081234567815', 'Jl. Gatot Subroto No. 12, Tasikmalaya');

-- Isi Tabel Pesanan (25 Record)
INSERT INTO pesanan (id_pelanggan, tanggal_pesanan, total_harga, status_pembayaran) VALUES
(1, '2026-06-01 08:00:00', 36000, 'Lunas'),
(2, '2026-06-01 09:30:00', 18000, 'Lunas'),
(3, '2026-06-02 10:15:00', 170000, 'Lunas'),
(4, '2026-06-02 11:00:00', 35000, 'Pending'),
(5, '2026-06-02 14:00:00', 56000, 'Lunas'),
(6, '2026-06-03 07:45:00', 30000, 'Lunas'),
(7, '2026-06-03 08:30:00', 45000, 'Batal'),
(8, '2026-06-03 13:20:00', 65000, 'Lunas'),
(9, '2026-06-04 16:10:00', 32000, 'Lunas'),
(10, '2026-06-04 17:00:00', 55000, 'Lunas'),
(11, '2026-06-05 09:00:00', 150000, 'Pending'),
(12, '2026-06-05 10:30:00', 24000, 'Lunas'),
(13, '2026-06-05 11:15:00', 12000, 'Lunas'),
(14, '2026-06-05 15:00:00', 15000, 'Lunas'),
(15, '2026-06-06 08:15:00', 60000, 'Lunas'),
(16, '2026-06-06 09:45:00', 22000, 'Lunas'),
(17, '2026-06-06 13:00:00', 90000, 'Lunas'),
(18, '2026-06-06 14:30:00', 28000, 'Pending'),
(19, '2026-06-07 10:00:00', 75000, 'Lunas'),
(20, '2026-06-07 11:30:00', 20000, 'Lunas'),
(21, '2026-06-07 15:45:00', 25000, 'Lunas'),
(22, '2026-06-08 08:00:00', 18000, 'Lunas'),
(23, '2026-06-08 09:15:00', 19000, 'Lunas'),
(24, '2026-06-08 10:30:00', 85000, 'Lunas'),
(25, '2026-06-08 11:00:00', 40000, 'Lunas');

-- Isi Tabel Detail Pesanan (25 Record)
-- Berfungsi menghubungkan relasi belanja dari tiap pesanan di atas
INSERT INTO detail_pesanan (id_pesanan, id_produk, jumlah, subtotal) VALUES
(1, 1, 2, 36000),   -- Pesanan 1 beli 2 Roti Tawar Gandum
(2, 10, 1, 18000),  -- Pesanan 2 beli 1 Butter Croissant
(3, 5, 2, 170000),  -- Pesanan 3 beli 2 Nastar Premium
(4, 8, 1, 35000),   -- Pesanan 4 beli 1 Red Velvet
(5, 9, 2, 56000),   -- Pesanan 5 beli 2 Cromboloni
(6, 12, 1, 30000),  -- Pesanan 6 beli 1 Donat Kampung
(7, 14, 1, 45000),  -- Pesanan 7 beli 1 Matcha Tiramisu
(8, 16, 1, 65000),  -- Pesanan 8 beli 1 Apple Pie
(9, 17, 2, 32000),  -- Pesanan 9 beli 2 Blueberry Muffin
(10, 20, 1, 55000), -- Pesanan 10 beli 1 Pandan Chiffon
(11, 7, 1, 15000),  -- Pesanan 11 beli 1 Black Forest
(12, 11, 1, 24000), -- Pesanan 12 beli 1 Almond Croissant
(13, 19, 1, 12000), -- Pesanan 13 beli 1 Crispy Cheese Roll
(14, 24, 1, 15000), -- Pesanan 14 beli 1 Caramel Croffle
(15, 25, 1, 60000), -- Pesanan 15 beli 1 Bika Ambon
(16, 4, 1, 22000),  -- Pesanan 16 beli 1 Roti Sobek
(17, 6, 1, 90000),  -- Pesanan 17 beli 1 Kastengel Keju
(18, 9, 1, 28000),  -- Pesanan 18 beli 1 Cromboloni
(19, 21, 1, 75000), -- Pesanan 19 beli 1 Bolu Gulung
(20, 18, 1, 20000), -- Pesanan 20 beli 1 French Baguette
(21, 15, 1, 25000), -- Pesanan 21 beli 1 Pudding Cokelat
(22, 2, 2, 18000),  -- Pesanan 22 beli 2 Roti Cokelat
(23, 3, 2, 19000),  -- Pesanan 23 beli 2 Roti Keju Susu
(24, 5, 1, 85000),  -- Pesanan 24 beli 1 Nastar Premium
(25, 23, 2, 40000); -- Pesanan 25 beli 2 Churros