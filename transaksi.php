<?php include 'koneksi.php'; ?>

<!DOCTYPE html>
<html>
<head>
    <title>Transaksi Penjualan</title>
</head>
<body>
    <h2>Transaksi Penjualan</h2>
    
    <form method="POST">
        Pelanggan: 
        <select name="id_pelanggan">
            <?php
            $q = mysqli_query($koneksi, "SELECT * FROM pelanggan");
            while($row = mysqli_fetch_array($q)){
                echo "<option value='".$row['id']."'>".$row['nama']."</option>";
            }
            ?>
        </select><br>
        
        Produk: 
        <select name="id_produk">
            <?php
            $q = mysqli_query($koneksi, "SELECT * FROM produk");
            while($row = mysqli_fetch_array($q)){
                echo "<option value='".$row['id']."'>".$row['nama']."</option>";
            }
            ?>
        </select><br>
        
        Jumlah: <input type="number" name="qty" required><br>
        <input type="submit" name="simpan" value="Simpan Transaksi">
    </form>

    <?php
    if(isset($_POST['simpan'])){
        // Proses transaksi
        $id_pelanggan = $_POST['id_pelanggan'];
        $id_produk = $_POST['id_produk'];
        $qty = $_POST['qty'];
        
        // Dapatkan harga produk
        $produk = mysqli_fetch_array(mysqli_query($koneksi, "SELECT harga FROM produk WHERE id=$id_produk"));
        $total = $produk['harga'] * $qty;
        
        // Insert ke tabel penjualan
        mysqli_query($koneksi, "INSERT INTO penjualan (id_pelanggan, tgl_transaksi, total) 
                               VALUES ($id_pelanggan, NOW(), $total)");
        
        $id_penjualan = mysqli_insert_id($koneksi);
        
        // Insert ke detail penjualan
        mysqli_query($koneksi, "INSERT INTO detail_penjualan (id_penjualan, id_produk, qty, harga)
                               VALUES ($id_penjualan, $id_produk, $qty, ".$produk['harga'].")");
        
        // Update stok produk
        mysqli_query($koneksi, "UPDATE produk SET stok = stok - $qty WHERE id = $id_produk");
        
        echo "Transaksi berhasil!";
    }
    ?>
</body>
</html>