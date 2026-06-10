require("dotenv").config();
const express = require("express");
const bodyParser = require("body-parser");
const cors = require("cors");
const mysql = require("mysql2");
const Groq = require("groq-sdk");

const app = express();
const port = 3060;

app.use(bodyParser.json());
app.use(cors());

const groq = new Groq({ apiKey: process.env.GROQ_API_KEY });

const db = mysql.createConnection({
  host: process.env.DB_HOST,
  user: process.env.DB_USER,
  password: process.env.DB_PASSWORD,
  database: process.env.DB_NAME,
});

db.connect((err) => {
  if (err) {
    console.error("Database connection failed:", err.stack);
    return;
  }
  console.log("Connected to database.");
});

app.post("/api/chatbot", async (req, res) => {
  const userMessage = req.body.message;

  try {
    // Fetch data lapangan dari database
    db.query("SELECT * FROM lapangan", async (error, results) => {
      if (error) {
        console.error("Error fetching data:", error);
        res.status(500).json({
          reply: "Maaf, terjadi kesalahan saat mengambil data dari database.",
        });
        return;
      }

      // Cek jika hasil query kosong
      if (results.length === 0) {
        res.json({
          reply: "Maaf, tidak ada data lapangan yang tersedia di database.",
        });
        return;
      }

      // Format data lapangan untuk pesan chatbot
      const lapanganData = results.map((item) => ({
        Nama: item.namaLapangan,
        Harga: `Rp ${item.harga}`,
        Gambar: item.gambar,
      }));

      const fullMessage = `Restoran Kampung Rasa\n\nLapangan yang tersedia adalah:\n${lapanganData
        .map((data) => `Nama: ${data.Nama}, Harga: ${data.Harga}`)
        .join("\n")}\n\nPengguna: ${userMessage}`;

      console.log("Full message:", fullMessage);

      // Kirim pesan ke Groq untuk mendapatkan respons dari chatbot
      try {
        const chatCompletion = await groq.chat.completions.create({
          model: "llama3-8b-8192",
          messages: [
            {
              role: "system",
              content:
                "Anda adalah asisten yang berbicara dalam bahasa Indonesia dan memberikan informasi tentang lapangan futsal di Just Do Sport.",
            },
            {
              role: "user",
              content: fullMessage,
            },
          ],
        });

        const botResponse =
          chatCompletion.choices[0]?.message?.content ||
          "Tidak ada respons dari model.";

        res.json({ reply: botResponse });
      } catch (groqError) {
        console.error("Error fetching response from Groq:", groqError);
        res.status(500).json({
          reply: "Maaf, terjadi kesalahan saat memproses permintaan Anda.",
        });
      }
    });
  } catch (error) {
    console.error("Error:", error);
    res.status(500).json({
      reply: "Maaf, terjadi kesalahan saat memproses permintaan Anda.",
    });
  }
});

app.listen(port, () => {
  console.log(`Server is running on http://localhost:${port}`);
});
