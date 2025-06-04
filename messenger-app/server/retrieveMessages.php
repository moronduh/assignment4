<?php
header('Content-Type: application/json');

// Get recipient from query parameter
$recipient = isset($_GET['recipient']) ? htmlspecialchars($_GET['recipient']) : '';

if (empty($recipient)) {
    http_response_code(400);
    echo json_encode(['error' => 'Recipient parameter is required']);
    exit;
}

$filename = "messages/{$recipient}.txt";
$messages = [];

if (file_exists($filename)) {
    $lines = file($filename, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        $messageData = json_decode($line, true);
        if ($messageData) {
            $messages[] = $messageData;
        }
    }
}

// Return messages in reverse chronological order
usort($messages, function($a, $b) {
    return strtotime($b['timestamp']) - strtotime($a['timestamp']);
});

echo json_encode(['messages' => $messages]);
?>