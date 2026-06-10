<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Futsal Court Recommendation</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h2 class="text-center mt-4">Futsal Court Recommendation</h2>
        <form action="groq.php" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="harga">Harga (Rp)</label>
                <input type="number" id="harga" name="harga" placeholder="Harga" required>
            </div>
            <div class="form-group">
                <label for="jenisLantai">Jenis Lantai</label>
                <select id="jenisLantai" name="jenisLantai" class="form-control" required>
                    <option value="Rumput">Rumput</option>
                    <option value="Matras">Matras</option>
                </select>
            </div>
            <div class="form-group">
                <label for="jenisLapangan">Jenis Lapangan</label>
                <select id="jenisLapangan" name="jenisLapangan" class="form-control" required>
                    <option value="Outdoor">Outdoor</option>
                    <option value="Indoor">Indoor</option>
                </select>
            </div>
            <div class="form-group">
                <label for="pencahayaan">Pencahayaan</label>
                <select id="pencahayaan" name="pencahayaan" class="form-control" required>
                    <option value="Terang">Terang</option>
                    <option value="Standar">Standar</option>
                </select>
            </div>
            <div class="form-group">
                <label for="fasilitas">Fasilitas</label>
                <input type="text" id="fasilitas" name="fasilitas" placeholder="Fasilitas" required>
            </div>
            <div class="form-group">
                <label for="luasLapangan">Luas Lapangan</label>
                <select id="luasLapangan" name="luasLapangan" class="form-control" required>
                    <option value="25-33 meter (panjang) x 15-20 meter (lebar)">
                        Panjang lapangan = 25-33 meter dan Lebar lapangan = 15-20 meter
                    </option>
                    <option value="33-42 meter (panjang) x 20-25 meter (lebar)">
                        Panjang lapangan = 33-42 meter dan Lebar lapangan = 20-25 meter
                    </option>
                </select>
            </div>
            <div class="form-group text-center">
                <button type="submit" name="recommend" class="btn btn-primary">Get Recommendation</button>
            </div>
        </form>
        <div>
            <?php
            session_start();
            if (isset($_SESSION['resultGroq'])) {
                echo '<div class="alert alert-success mt-4">' . nl2br(htmlspecialchars($_SESSION['resultGroq'])) . '</div>';
                unset($_SESSION['resultGroq']);
            }
            ?>
        </div>
    </div>

    <?php
echo '<pre>';
print_r($_POST);
echo '</pre>';

require __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/function.php';
include '../server/koneksi.php';

use LucianoTonet\GroqPHP\Groq;

$dotenv = Dotenv\Dotenv::createUnsafeImmutable(__DIR__);
$dotenv->load();

$apiKey = getenv('GROQ_API_KEY');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    try {
        $harga = isset($_POST['harga']) ? $_POST['harga'] : null;
        $jenisLantai = isset($_POST['jenisLantai']) ? $_POST['jenisLantai'] : null;
        $jenisLapangan = isset($_POST['jenisLapangan']) ? $_POST['jenisLapangan'] : null;
        $pencahayaan = isset($_POST['pencahayaan']) ? $_POST['pencahayaan'] : null;
        $fasilitas = isset($_POST['fasilitas']) ? $_POST['fasilitas'] : null;
        $luasLapangan = isset($_POST['luasLapangan']) ? $_POST['luasLapangan'] : null;

        if (is_null($harga) || is_null($jenisLantai) || is_null($jenisLapangan) || is_null($pencahayaan) || is_null($fasilitas) || is_null($luasLapangan)) {
            throw new Exception("One or more required fields are missing.");
        }

        $data = getDataTempatFutsal($conn);
        $groq = new Groq($apiKey);
        $dataTempatFutsal = "Berikut adalah data tempat futsal:\n";

        if ($data != "") {
            while ($row = $data->fetch_assoc()) {
                $dataTempatFutsal .= "ID: " . $row['id_tempatFutsal'] . "\n";
                $dataTempatFutsal .= "Nama Tempat Futsal: " . $row['nama'] . "\n";
                $dataTempatFutsal .= "Harga: " . $row['harga'] . "\n";
                $dataTempatFutsal .= "Jenis Lantai: " . $row['jenis_lantai'] . "\n";
                $dataTempatFutsal .= "Jenis Lapangan: " . $row['jenis_lapangan'] . "\n";
                $dataTempatFutsal .= "Pencahayaan: " . $row['pencahayaan'] . "\n";
                $dataTempatFutsal .= "Fasilitas: " . $row['fasilitas'] . "\n";
                $dataTempatFutsal .= "Luas Lapangan: " . $row['luas_lapangan'] . "\n";
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
                    'content' => 'Data saya: Harga: Rp.' . $harga . ', Jenis Lantai: ' . $jenisLantai . ', Jenis Lapangan: ' . $jenisLapangan . ', Pencahayaan: ' . $pencahayaan . ', Fasilitas: ' . $fasilitas . ', Luas Lapangan: ' . $luasLapangan . '. Tolong berikan rekomendasi tempat futsal, termasuk nama tempat futsalnya dan alamatnya.'
                ],
            ],
        ]);

        if (!is_null($chatCompletion)) {
            $_SESSION['resultGroq'] = $chatCompletion['choices'][0]['message']['content'];
            header("Location: " . $_SERVER['PHP_SELF']);
            exit();
        } else {
            $_SESSION['resultGroq'] = "Something went wrong.";
            header("Location: " . $_SERVER['PHP_SELF']);
            exit();
        }
    } catch (\Exception $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    echo "No POST data received.";
}
?>


</body>
</html>
