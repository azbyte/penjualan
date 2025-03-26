<?php include 'koneksi.php'; ?>

<!DOCTYPE html>
<html>
<head>
    <title>Laporan Penjualan</title>
</head>
<body>
    <h2>Rekapitulasi Penjualan</h2>
    
    <form method="POST">
        Pilih Periode:
        <select name="periode">
            <option value="hari">Harian</option>
            <option value="bulan">Bulanan</option>
            <option value="tahun">Tahunan</option>
        </select>
        <input type="submit" name="tampil" value="Tampilkan">
    </form>

    <?php
    if(isset($_POST['tampil'])){
        $periode = $_POST['periode'];
        
        $query = "SELECT ";
        switch($periode){
            case 'hari':
                $query .= "DATE(tgl_transaksi) AS periode, SUM(total) AS total";
                $group = "DATE(tgl_transaksi)";
                break;
            case 'bulan':
                $query .= "MONTH(tgl_transaksi) AS bulan, YEAR(tgl_transaksi) AS tahun, SUM(total) AS total";
                $group = "YEAR(tgl_transaksi), MONTH(tgl_transaksi)";
                break;
            case 'tahun':
                $query .= "YEAR(tgl_transaksi) AS tahun, SUM(total) AS total";
                $group = "YEAR(tgl_transaksi)";
                break;
        }
        
        $query .= " FROM penjualan GROUP BY $group";
        
        $result = mysqli_query($koneksi, $query);
        
        echo "<h3>Laporan Per $periode</h3>";
        echo "<table border='1'>";
        echo "<tr><th>Periode</th><th>Total Penjualan</th></tr>";
        
        while($row = mysqli_fetch_array($result)){
            echo "<tr>";
            if($periode == 'bulan'){
                echo "<td>".$row['bulan']."-".$row['tahun']."</td>";
            } else {
                echo "<td>".$row['periode']."</td>";
            }
            echo "<td>".number_format($row['total'], 0, ',', '.')."</td>";
            echo "</tr>";
        }
        echo "</table>";
    }
    ?>
</body>
</html>