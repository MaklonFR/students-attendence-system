<?php
// Simple test - akses langsung tanpa .htaccess routing
// URL: https://absen.batucermin-desa.id/public/hello.php

header('Content-Type: application/json');

echo json_encode([
    'status' => 'Backend berjalan!',
    'timestamp' => date('Y-m-d H:i:s'),
    'php_version' => phpversion(),
    'request_uri' => $_SERVER['REQUEST_URI'],
    'document_root' => $_SERVER['DOCUMENT_ROOT'],
    'script_filename' => $_SERVER['SCRIPT_FILENAME']
], JSON_PRETTY_PRINT);
