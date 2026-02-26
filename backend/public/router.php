<?php
// Router untuk PHP built-in server
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// Jika file fisik ada, serve langsung
if ($uri !== '/' && file_exists(__DIR__ . $uri)) {
    return false;
}

// Semua request lainnya ke index.php
require_once __DIR__ . '/index.php';
