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
                <label for="jenisLantai">Jenis Lantai (Rumput/Matras)</label>
                <input type="text" id="jenisLantai" name="jenisLantai" placeholder="Jenis Lantai" required>
            </div>
            <div class="form-group">
                <label for="jenisLapangan">Jenis Lapangan (Indoor/Outdoor)</label>
                <input type="text" id="jenisLapangan" name="jenisLapangan" placeholder="Jenis Lapangan" required>
            </div>
            <div class="form-group">
                <label for="pencahayaan">Pencahayaan</label>
                <input type="text" id="pencahayaan" name="pencahayaan" placeholder="Pencahayaan" required>
            </div>
            <div class="form-group">
                <label for="fasilitas">Fasilitas</label>
                <input type="text" id="fasilitas" name="fasilitas" placeholder="Fasilitas" required>
            </div>
            <div class="form-group">
                <label for="luasLapangan">Luas Lapangan</label>
                <input type="text" id="luasLapangan" name="luasLapangan" placeholder="Luas Lapangan" required>
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
    require __DIR__ . '/vendor/autoload.php';
    require_once __DIR__ . '/function.php';
    include '../server/koneksi.php';

    use LucianoTonet\GroqPHP\Groq;

    $dotenv = Dotenv\Dotenv::createUnsafeImmutable(__DIR__);
    $dotenv->load();

    $apiKey = getenv('GROQ_API_KEY');

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        try {
            $harga = $_POST['harga'];
            $jenisLantai = $_POST['jenisLantai'];
            $jenisLapangan = $_POST['jenisLapangan'];
            $pencahayaan = $_POST['pencahayaan'];
            $fasilitas = $_POST['fasilitas'];
            $luasLapangan = $_POST['luasLapangan'];

            $data = getDataTempatFutsal($conn);
            $groq = new Groq($apiKey);
            $dataTempatFutsal = "Berikut adalah data tempat futsal:\n";

            // Check if data is a MySQLi result set
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
    }
    ?>
</body>
</html>
