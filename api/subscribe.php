<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') { http_response_code(200); exit; }
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['ok' => false, 'error' => 'Method not allowed']); exit;
}

$raw = file_get_contents('php://input');
$data = json_decode($raw, true) ?: $_POST;
$email = trim($data['email'] ?? '');
$name  = trim($data['name'] ?? '');

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo json_encode(['ok' => false, 'error' => 'Please enter a valid email address.']); exit;
}

// Check duplicate in temp storage (use DB/Mailchimp in production)
$subFile = '/tmp/ca_subscribers.json';
$subscribers = file_exists($subFile) ? json_decode(file_get_contents($subFile), true) : [];
$emails = array_column($subscribers, 'email');
if (in_array(strtolower($email), array_map('strtolower', $emails))) {
    echo json_encode(['ok' => false, 'error' => "You're already subscribed! Check your inbox for our latest updates."]); exit;
}

$subscribers[] = ['email' => $email, 'name' => $name, 'date' => date('Y-m-d H:i:s'), 'ip' => $_SERVER['REMOTE_ADDR'] ?? ''];
file_put_contents($subFile, json_encode($subscribers, JSON_PRETTY_PRINT), LOCK_EX);

echo json_encode([
    'ok' => true,
    'message' => "You're subscribed! 🎉 Welcome to the Cyber Alpha newsletter, " . ($name ?: 'hacker') . "!"
]);
