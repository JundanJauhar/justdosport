<?php

include '../server/koneksi.php';

$sql = "SELECT idPilihan, cabor, ruangan, lantai, img FROM pilihanlapangan";
$result = $conn->query($sql);

if($result->num_rows > 0){
    while($row = $result->fetch_assoc()){
        echo '<h3>'.$row["cabor"].'</h3>';
        echo '<h3>'.$row["ruangan"].'</h3>';
        echo '<h3>'.$row["lantai"].'</h3>';
        echo '<h3>'.$row["img"].'</h3>';
    }
    $conn->close();
}

?>