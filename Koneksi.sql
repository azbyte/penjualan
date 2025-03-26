CREATE DATABASE toko_kelontong;

CREATE TABLE produk (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nama VARCHAR(100),
    harga DECIMAL(10,2),
    stok INT
);

CREATE TABLE pelanggan (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nama VARCHAR(100),
    alamat TEXT,
    telepon VARCHAR(15)
);

CREATE TABLE penjualan (
    id INT PRIMARY KEY AUTO_INCREMENT,
    id_pelanggan INT,
    tgl_transaksi DATETIME,
    total DECIMAL(10,2)
);

CREATE TABLE detail_penjualan (
    id INT PRIMARY KEY AUTO_INCREMENT,
    id_penjualan INT,
    id_produk INT,
    qty INT,
    harga DECIMAL(10,2)
);