<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chatbot</title>
</head>
<body>
    <div>
        <div class="flex flex-col h-96 w-full border border-gray-300 rounded-md p-4 space-y-2 mt-2 overflow-y-auto">
            <!-- PHP code to fetch messages from the backend -->
            <?php
            // Function to send POST request to Node.js backend
            function sendRequest($message) {
                $url = 'http://localhost:3001/api/chatbot';
                $data = array('message' => $message);

                // Use curl to send POST request
                $ch = curl_init($url);
                curl_setopt($ch, CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                $response = curl_exec($ch);
                curl_close($ch);

                return json_decode($response, true);
            }

            // Handle form submission
            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['message'])) {
                $userMessage = $_POST['message'];
                $botResponse = sendRequest($userMessage)['reply'];

                // Display user message
                echo '<div class="' . ($_SESSION['username'] === 'You' ? 'text-right' : 'text-left') . '">';
                echo '<span class="font-bold">You:</span> ' . htmlspecialchars($userMessage);
                echo '</div>';

                // Display bot response
                echo '<div class="text-left">';
                echo '<span class="font-bold">Bot:</span> ' . htmlspecialchars($botResponse);
                echo '</div>';
            }
            ?>
        </div>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" class="flex space-x-2 mt-2">
            <input type="text" name="message" placeholder="Ketik pesan Anda..." class="border border-gray-300 rounded-md p-2 w-full" required>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md">Kirim</button>
        </form>
    </div>
</body>
</html>
