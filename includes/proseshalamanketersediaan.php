<?php

include '../server/koneksi.php';

if(isset($_GET['id'])){
    $id = $_GET['id'];

    $query = "SELECT * FROM lapangan WHERE id = $id;";
    $sql = mysqli_query($koneksi, $query);

    if($sql) {
        $row = mysqli_fetch_assoc($sql);
        $no = 0;
    }else{
        echo "error : " . mysqli_error($koneksi);
    }
}else{
    echo "Pemandu ID is not specified.";
    exit();
}


?>