<?php
session_start();
include '../server/koneksi.php';

// Validate customer session
if (!isset($_SESSION['nama']) || !isset($_SESSION['role']) || $_SESSION['role'] !== 'customer') {
    header("Location: ../login/login2.php?error=" . urlencode("Silakan login terlebih dahulu!"));
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_lapangan = intval($_POST['id_lapangan']);
    $rating = intval($_POST['rating']);
    $komentar = trim($_POST['komentar']);
    $nama_kustomer = $_SESSION['nama'];

    if ($id_lapangan === 0 || $rating < 1 || $rating > 5 || empty($komentar)) {
        header("Location: PesananSaya.php?error=" . urlencode("Data ulasan tidak valid."));
        exit();
    }

    // Run AI Sentiment Analysis
    $sentiment = analyzeSentimentAI($komentar, $rating);

    // Save to database
    $query = "INSERT INTO ulasan (id_lapangan, nama_kustomer, rating, komentar, analisis_sentimen) VALUES (?, ?, ?, ?, ?)";
    if ($stmt = mysqli_prepare($koneksi, $query)) {
        mysqli_stmt_bind_param($stmt, "isiss", $id_lapangan, $nama_kustomer, $rating, $komentar, $sentiment);
        if (mysqli_stmt_execute($stmt)) {
            header("Location: PesananSaya.php?success=" . urlencode("Terima kasih! Ulasan Anda berhasil dikirim dan dianalisis oleh AI."));
            exit();
        } else {
            echo "Error executing query: " . mysqli_error($koneksi);
        }
        mysqli_stmt_close($stmt);
    } else {
        echo "Error preparing statement: " . mysqli_error($koneksi);
    }
} else {
    header("Location: PesananSaya.php");
    exit();
}

/**
 * Analyze sentiment of the review comment using Groq API (AI) with a local rule-based fallback
 */
function analyzeSentimentAI($text, $rating) {
    // 1. Local Rule-Based Fallback (Offline, fast, and robust)
    $sentiment = 'Netral';
    if ($rating >= 4) {
        $sentiment = 'Positif';
    } elseif ($rating <= 2) {
        $sentiment = 'Negatif';
    }

    $pos_keywords = ['bagus', 'puas', 'mantap', 'nyaman', 'bersih', 'keren', 'rekomendasi', 'suka', 'ramah', 'baik', 'wangi', 'murah'];
    $neg_keywords = ['jelek', 'kecewa', 'kotor', 'panas', 'rusak', 'mahal', 'buruk', 'kurang', 'lambat', 'parah', 'licin', 'gelap'];

    $lowercase_text = strtolower($text);
    $pos_count = 0;
    $neg_count = 0;

    foreach ($pos_keywords as $kw) {
        if (strpos($lowercase_text, $kw) !== false) {
            $pos_count++;
        }
    }
    foreach ($neg_keywords as $kw) {
        if (strpos($lowercase_text, $kw) !== false) {
            $neg_count++;
        }
    }

    if ($pos_count > $neg_count) {
        $sentiment = 'Positif';
    } elseif ($neg_count > $pos_count) {
        $sentiment = 'Negatif';
    }

    // 2. Groq AI Analysis (Online)
    try {
        $autoload_path = __DIR__ . '/../includes/vendor/autoload.php';
        $env_path = __DIR__ . '/../includes';

        if (file_exists($autoload_path)) {
            require_once $autoload_path;
            
            if (class_exists('LucianoTonet\GroqPHP\Groq')) {
                // Load .env files securely
                if (class_exists('Dotenv\Dotenv')) {
                    $dotenv = Dotenv\Dotenv::createUnsafeImmutable($env_path);
                    $dotenv->safeLoad();
                }

                $apiKey = getenv('GROQ_API_KEY');
                if (!empty($apiKey)) {
                    $groq = new LucianoTonet\GroqPHP\Groq($apiKey);
                    $chatCompletion = $groq->chat()->completions()->create([
                        'model'    => 'llama3-8b-8192',
                        'messages' => [
                            [
                                'role'    => 'system',
                                'content' => 'Kamu adalah AI asisten untuk analisis sentimen ulasan penyewaan arena olahraga (seperti futsal, badminton, sepak bola, tenis) di Indonesia. Analisis komentar dan rating dari pengguna, lalu tentukan sentimen mereka. Balas HANYA dengan satu kata persis: "Positif", "Negatif", atau "Netral" (tanpa tanda kutip, tanpa penjelasan, tanpa kata lain).'
                            ],
                            [
                                'role'    => 'user',
                                'content' => "Komentar: \"$text\"\nRating Bintang: $rating/5"
                            ]
                        ],
                        'temperature' => 0.1,
                        'max_tokens' => 10
                    ]);

                    if ($chatCompletion && isset($chatCompletion['choices'][0]['message']['content'])) {
                        $ai_response = trim($chatCompletion['choices'][0]['message']['content']);
                        // Clean any punctuation
                        $ai_response = preg_replace('/[^a-zA-Z]/', '', $ai_response);
                        
                        if (in_array($ai_response, ['Positif', 'Negatif', 'Netral'])) {
                            $sentiment = $ai_response;
                        }
                    }
                }
            }
        }
    } catch (\Exception $e) {
        // Fallback silently to rule-based sentiment
    }

    return $sentiment;
}
?>
