<?php
header('Content-Type: application/json');

// Get the JSON data from the request body
$data = json_decode(file_get_contents('php://input'), true);

// Validate input
if (empty($data['sender']) || empty($data['recipient']) || empty($data['message'])) {
    http_response_code(400);
    echo json_encode(['error' => 'Missing required fields']);
    exit;
}

// Sanitize inputs
$sender = htmlspecialchars($data['sender']);
$recipient = htmlspecialchars($data['recipient']);
$message = htmlspecialchars($data['message']);

// Create messages directory if it doesn't exist
if (!file_exists('messages')) {
    mkdir('messages');
}

// File-based storage
$filename = "messages/{$recipient}.txt";

// Format the message
$messageData = [
    'sender' => $sender,
    'recipient' => $recipient,
    'message' => $message,
    'timestamp' => date('Y-m-d H:i:s')
];

// Append to file
file_put_contents($filename, json_encode($messageData) . PHP_EOL, FILE_APPEND);

// Return success response
echo json_encode(['success' => true, 'message' => 'Message stored successfully']);
?><?php
header('Content-Type: application/json');

// Get the JSON data from the request body
$data = json_decode(file_get_contents('php://input'), true);

// Validate input
if (empty($data['sender']) || empty($data['recipient']) || empty($data['message'])) {
    http_response_code(400);
    echo json_encode(['error' => 'Missing required fields']);
    exit;
}

// Sanitize inputs
$sender = htmlspecialchars($data['sender']);
$recipient = htmlspecialchars($data['recipient']);
$message = htmlspecialchars($data['message']);

// Create messages directory if it doesn't exist
if (!file_exists('messages')) {
    mkdir('messages');
}

// File-based storage
$filename = "messages/{$recipient}.txt";

// Format the message
$messageData = [
    'sender' => $sender,
    'recipient' => $recipient,
    'message' => $message,
    'timestamp' => date('Y-m-d H:i:s')
];

// Append to file
file_put_contents($filename, json_encode($messageData) . PHP_EOL, FILE_APPEND);

// Return success response
echo json_encode(['success' => true, 'message' => 'Message stored successfully']);
?>