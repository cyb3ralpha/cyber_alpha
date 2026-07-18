<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['ok' => false, 'error' => 'Method not allowed']);
    exit;
}

$raw = file_get_contents('php://input');
$data = json_decode($raw, true) ?: $_POST;

$name    = trim($data['name'] ?? '');
$email   = trim($data['email'] ?? '');
$subject = trim($data['subject'] ?? 'Contact from cyberalpha.dev');
$message = trim($data['message'] ?? '');
$type    = trim($data['type'] ?? 'general');

// Validation
if (!$name || strlen($name) < 2) {
    echo json_encode(['ok' => false, 'error' => 'Please enter your name (min 2 characters).']);
    exit;
}
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo json_encode(['ok' => false, 'error' => 'Please enter a valid email address.']);
    exit;
}
if (!$message || strlen($message) < 10) {
    echo json_encode(['ok' => false, 'error' => 'Message must be at least 10 characters.']);
    exit;
}

// Rate limiting (simple - in production use Redis/DB)
$rateKey = '/tmp/ca_contact_' . md5($email);
if (file_exists($rateKey) && (time() - filemtime($rateKey)) < 300) {
    echo json_encode(['ok' => false, 'error' => 'Please wait 5 minutes before sending another message.']);
    exit;
}
touch($rateKey);

// Compose email
$to = 'contact@cyberalpha.dev';
$emailSubject = "[CyberAlpha.dev] $subject";
$emailBody = "
Name: $name
Email: $email
Type: $type
Time: " . date('Y-m-d H:i:s T') . "
IP: " . ($_SERVER['HTTP_X_FORWARDED_FOR'] ?? $_SERVER['REMOTE_ADDR'] ?? 'unknown') . "

Message:
$message
";
$headers = "From: noreply@cyberalpha.dev\r\nReply-To: $email\r\nX-Mailer: CyberAlpha-v2";

// On Vercel production: use a mail service (SendGrid/Mailgun/Resend)
// mail($to, $emailSubject, $emailBody, $headers); // Enable when mail service configured

// Save to data/contacts.json so admin panel can read it
$dataFile = __DIR__ . '/../data/contacts.json';
$contacts = [];
if (file_exists($dataFile)) {
    $contacts = json_decode(file_get_contents($dataFile), true) ?? [];
}
$maxId    = empty($contacts) ? 0 : max(array_column($contacts, 'id'));
$contacts[] = [
    'id'      => $maxId + 1,
    'name'    => $name,
    'email'   => $email,
    'subject' => $subject,
    'message' => $message,
    'date'    => date('Y-m-d H:i:s'),
    'read'    => false,
];
@file_put_contents($dataFile, json_encode($contacts, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

// Also log to /tmp as fallback
$log   = '/tmp/ca_contacts.log';
$entry = date('[Y-m-d H:i:s]') . " From: $name <$email> | Type: $type | Subject: $subject\n";
file_put_contents($log, $entry, FILE_APPEND | LOCK_EX);

echo json_encode([
    'ok'      => true,
    'message' => "Message received! I'll get back to you within 24 hours, $name. 🔐"
]);
