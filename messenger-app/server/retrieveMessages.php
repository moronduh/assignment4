<?php
header('Content-Type: application/json');

// Get recipient from query parameter
$recipient = isset($_GET['recipient']) ? $_GET['recipient'] : '';

if (empty($recipient)) {
    http_response_code(400);
    echo json_encode(['error' => 'Recipient parameter is required']);
    exit;
}

// Only allow alphanumeric recipient names for security
if (!preg_match('/^[a-zA-Z0-9_\-]+$/', $recipient)) {
    http_response_code(400);
    echo json_encode(['error' => 'Invalid recipient']);
    exit;
}

$filename = "messages/{$recipient}.txt";
$messages = [];

if (!is_dir('messages')) {
    http_response_code(500);
    echo json_encode(['error' => 'Messages directory does not exist']);
    exit;
}

if (file_exists($filename) && is_readable($filename)) {
    $lines = file($filename, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        $messageData = json_decode($line, true);
        if ($messageData) {
            $messages[] = $messageData;
        }
    }
} elseif (file_exists($filename)) {
    http_response_code(500);
    echo json_encode(['error' => 'Cannot read messages file']);
    exit;
}

// Return messages in reverse chronological order
usort($messages, function($a, $b) {
    return strtotime($b['timestamp']) - strtotime($a['timestamp']);
});

echo json_encode(['messages' => $messages]);
?>