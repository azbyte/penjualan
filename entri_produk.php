<?php include 'koneksi.sql'; ?>

<!DOCTYPE html>
<html>
<head>
    <title>Entri Produk</title>
</head>
<body>
    <h2>Form Entri Produk</h2>
    <form method="POST">
        Nama Produk: <input type="text" name="nama" required><br>
        Harga: <input type="number" name="harga" required><br>
        Stok: <input type="number" name="stok" required><br>
        <input type="submit" name="simpan" value="Simpan">
    </form>

    <?php
    if(isset($_POST['simpan'])){
        $nama = $_POST['nama'];
        $harga = $_POST['harga'];
        $stok = $_POST['stok'];
        
        $query = "INSERT INTO produk (nama, harga, stok) VALUES ('$nama', $harga, $stok)";
        mysqli_query($koneksi, $query);
        echo "Produk berhasil disimpan!";
    }
    ?>
</body>
</html>