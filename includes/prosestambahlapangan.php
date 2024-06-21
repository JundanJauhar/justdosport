<?php
include '../server/koneksi.php'; // Pastikan file koneksi.php sesuai dengan konfigurasi Anda

if (isset($_POST['aksi'])) {
    if ($_POST['aksi'] == "tambah") {
        $idFutsal = $_POST["idFutsal"];
        $namaLapangan = $_POST["namaLapangan"];
        $ketlapangan = $_POST["ketlapangan"];
        $cabor = $_POST["cabor"];
        $ruangan = $_POST["ruangan"];
        $lantai = $_POST["lantai"];
        $img = $_FILES['img']['name'];
        
        // Untuk upload gambar
        $dir = "img/";
        $tmpFile = $_FILES['img']['tmp_name'];
        $imgPath = $dir . basename($img);
        
        // Query SQL untuk INSERT
        $query = "INSERT INTO pilihanlapangan (idFutsal, namaLapangan, ketlapangan, cabor, ruangan, lantai, img) VALUES ('$idFutsal', '$namaLapangan', '$ketlapangan', '$cabor', '$ruangan', '$lantai', '$img')";
        
        // Eksekusi query
        $result = mysqli_query($koneksi, $query);
        
        // Periksa hasil eksekusi query
        if ($result) {
            // Jika berhasil, pindahkan file gambar ke direktori tujuan
            if ($tmpFile && move_uploaded_file($tmpFile, $imgPath)) {
                echo "Data berhasil ditambahkan.";
                header("location: dashbordLapangan.php");
                exit; // Hentikan eksekusi script setelah header redirect
            } else {
                echo "Gagal mengupload gambar.";
            }
        } else {
            echo "Error: " . mysqli_error($koneksi);
        }
        
    } else if ($_POST['aksi'] == "edit") {
        $idPilihan = $_POST["idPilihan"];
        $namaLapangan = $_POST["namaLapangan"];
        $ketlapangan = $_POST["ketlapangan"];
        $cabor = $_POST["cabor"];
        $ruangan = $_POST["ruangan"];
        $lantai = $_POST["lantai"];
        $img = $_FILES['img']['name'];
        
        // Query SQL untuk UPDATE
        $query = "UPDATE pilihanlapangan SET namaLapangan = '$namaLapangan', ketlapangan = '$ketlapangan', cabor = '$cabor', ruangan = '$ruangan', lantai = '$lantai'";
        
        // Tambahkan kolom img ke query UPDATE jika ada gambar baru di-upload
        if (!empty($img)) {
            $query .= ", img = '$img'";
        }
        
        $query .= " WHERE idPilihan = '$idPilihan'";
        
        // Eksekusi query
        $result = mysqli_query($koneksi, $query);
        
        // Periksa hasil eksekusi query
        if ($result) {
            // Jika berhasil, pindahkan file gambar ke direktori tujuan jika ada perubahan gambar
            if (!empty($img)) {
                $queryShow = "SELECT * FROM pilihanlapangan WHERE idPilihan = '$idPilihan'";
                $sqlShow = mysqli_query($koneksi, $queryShow);
                $row = mysqli_fetch_assoc($sqlShow);
                
                unlink("img/".$row['img']); // Hapus gambar lama
                move_uploaded_file($_FILES['img']['tmp_name'], 'img/'.$img);
            }
            header("location: dashbordLapangan.php");
            exit; // Hentikan eksekusi script setelah header redirect
        } else {
            echo "Error: " . mysqli_error($koneksi);
        }
    }
}

if (isset($_GET['hapus'])) {
    $idPilihan = $_GET['hapus'];
    
    // Query SQL untuk SELECT data yang akan dihapus
    $queryShow = "SELECT * FROM pilihanlapangan WHERE idPilihan = '$idPilihan'";
    $sqlShow = mysqli_query($koneksi, $queryShow);
    $row = mysqli_fetch_assoc($sqlShow);
    
    // Hapus gambar dari direktori
    unlink("img/".$row['img']);
    
    // Query SQL untuk DELETE
    $query = "DELETE FROM pilihanlapangan WHERE idPilihan ='$idPilihan'";
    $result = mysqli_query($koneksi, $query);
    
    // Periksa hasil eksekusi query DELETE
    if ($result) {
        header("location: dashbordLapangan.php");
        exit; // Hentikan eksekusi script setelah header redirect
    } else {
        echo "Error: " . mysqli_error($koneksi);
    }
}
?>
