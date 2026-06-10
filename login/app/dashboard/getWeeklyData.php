<?php
include '../../../server/koneksi.php'; // Pastikan file ini mendefinisikan koneksi database dengan benar

// Query untuk mengambil data mingguan
$queryWeekly = "SELECT WEEK(tanggal) as week, YEAR(tanggal) as year, SUM(harga) as total_harga 
                FROM pemesanan 
                GROUP BY year, week 
                ORDER BY year, week";

$resultWeekly = mysqli_query($koneksi, $queryWeekly);

$weeklyData = [];
while ($row = mysqli_fetch_assoc($resultWeekly)) {
    $weeklyData[] = $row;
}

// Query untuk mengambil data harian dalam kurun waktu satu minggu terakhir
$queryDaily = "SELECT DAY(tanggal) as day, MONTH(tanggal) as month, YEAR(tanggal) as year, SUM(harga) as total_harga 
               FROM pemesanan 
               WHERE tanggal >= DATE_SUB(CURDATE(), INTERVAL 1 WEEK)
               GROUP BY year, month, day 
               ORDER BY year, month, day";

$resultDaily = mysqli_query($koneksi, $queryDaily);

$dailyData = [];
while ($row = mysqli_fetch_assoc($resultDaily)) {
    $dailyData[] = $row;
}

echo json_encode(['weekly' => $weeklyData, 'daily' => $dailyData]);
?>
