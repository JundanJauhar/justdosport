<?php
require __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . 'function.php';
include '../Koneksi/koneksi.php';

use LucianoTonet\GroqPHP\Groq;

$dotenv = Dotenv\Dotenv::createUnsafeImmutable(__DIR__);
$dotenv->load();

$apiKey = getenv('GROQ_API_KEY');

session_start();

try {
    $harga = $jenisLantai = $jenisLapangan = "";
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $harga = $_POST['harga'];
        $jenisLantai = $_POST['jenisLantai'];
        $jenisLapangan = $_POST['jenisLapangan'];
    }
    
    $data = getDataTempatFutsal($conn);
    $groq = new Groq($apiKey);
    $dataTempatFutsal = "Here are the menu details:\n";
    
    // Check if data is a MySQLi result set
    if ($data != "") {
        while ($row = $data->fetch_assoc()) {
            $dataTempatFutsal .= "ID: " . $row['id_tempatFutsal'] . "\n";
            $dataTempatFutsal .= "Nama Tempat Futsal: " . $row['nama'] . "\n";
            $dataTempatFutsal .= "Harga: " . $row['harga'] . "\n";
            $dataTempatFutsal .= "Jenis Lantai: " . $row['jenis_lantai'] . "\n";
            $dataTempatFutsal .= "Jenis Lapangan: " . $row['jenis_lapangan'] . "\n";
            $dataTempatFutsal .= "-----------------------------------\n";
        }
    } else {
        $dataTempatFutsal = "Tidak ada tempat futsal sesuai dengan pencarian anda.";
    }
    
    $chatCompletion = $groq->chat()->completions()->create([
        'model'    => 'mixtral-8x7b-32768', // Ensure this model ID is correct
        'messages' => [
            [
                'role'    => 'system',
                'content' => 'Anda adalah asisten dan ahli analisis yang memberikan rekomendasi tempat futsal berdasarkan data yang dimasukkan pengguna dan data tempat futsal yang aku berikan.' . $dataTempatFutsal
            ],
            [
                'role'    => 'user',
                'content' => 'Data saya: Harga: Rp.' . $harga . ', Jenis Lantai: ' . $jenisLantai . ', Jenis Lapangan: ' . $jenisLapangan . '. Tolong berikan rekomendasi tempat futsal, termasuk nama tempat futsalnya dan alamatnya.'
            ],
        ],
    ]);
    // if (!is_null($chatCompletion)) {
    //     session_start();
    //     $_SESSION['resultGroq'] = $chatCompletion['choices'][0]['message']['content'];
    //     $_SESSION['flag'] = 1;
    //     header("Location: ../Menu/menu.php");
    //     die();
    // } else {
    //     $_SESSION['resultGroq'] = "sumething wrong";
    //     $_SESSION['flag'] = 1;
    //     header("Location: ../Menu/menu.php");
    //     die();
    // }
} catch (\Exception $e) {
    echo "Error: " . $e->getMessage();
}

