<?php
define('ADMIN_PASSWORD', getenv('ADMIN_PASSWORD') ?: 'CyberAlpha@2024');
define('AUTH_SECRET',    getenv('SESSION_SECRET')  ?: 'cyber-alpha-secret-key-default');

function isLoggedIn(): bool {
    if (empty($_COOKIE['ca_admin'])) return false;
    $parts = explode('.', $_COOKIE['ca_admin'], 2);
    if (count($parts) !== 2) return false;
    [$data, $sig] = $parts;
    return hash_equals(hash_hmac('sha256', $data, AUTH_SECRET), $sig);
}

function doLogin(string $password): bool {
    if (!hash_equals(ADMIN_PASSWORD, $password)) return false;
    $data = base64_encode(json_encode(['ts' => time(), 'u' => 'admin']));
    $sig  = hash_hmac('sha256', $data, AUTH_SECRET);
    setcookie('ca_admin', "$data.$sig", time() + 86400 * 7, '/', '', false, true);
    return true;
}

function doLogout(): void {
    setcookie('ca_admin', '', time() - 3600, '/');
}

function requireAuth(): void {
    if (!isLoggedIn()) {
        header('Location: /admin');
        exit;
    }
}

/* ── Data helpers ── */
function dataPath(string $file): string {
    return __DIR__ . '/../data/' . $file;
}

function readJson(string $file): array {
    $path = dataPath($file);
    if (!file_exists($path)) return [];
    return json_decode(file_get_contents($path), true) ?? [];
}

function writeJson(string $file, array $data): bool {
    $path = dataPath($file);
    $dir  = dirname($path);
    if (!is_dir($dir)) mkdir($dir, 0755, true);
    return file_put_contents($path, json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE)) !== false;
}

function nextId(array $items): int {
    if (empty($items)) return 1;
    return max(array_column($items, 'id')) + 1;
}
