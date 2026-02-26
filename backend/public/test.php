<?php
// File test sederhana untuk verifikasi backend berjalan
// Akses: https://absen.batucermin-desa.id/public/test.php

header('Content-Type: application/json; charset=UTF-8');

$status = [
    'status' => 'running',
    'message' => 'Backend API Sistem Absensi SMP berjalan dengan baik',
    'timestamp' => date('Y-m-d H:i:s'),
    'php_version' => phpversion(),
    'environment' => [
        'document_root' => $_SERVER['DOCUMENT_ROOT'],
        'request_uri' => $_SERVER['REQUEST_URI'],
        'script_filename' => $_SERVER['SCRIPT_FILENAME']
    ],
    'files_check' => [],
    'database_connected' => false
];

// Check apakah file-file penting ada
$files_to_check = [
    'config/database.php' => __DIR__ . '/../config/database.php',
    'core/Router.php' => __DIR__ . '/../core/Router.php',
    'routes/api.php' => __DIR__ . '/../routes/api.php'
];

foreach ($files_to_check as $name => $path) {
    $status['files_check'][$name] = file_exists($path) ? 'exist' : 'missing';
}

// Test Database Connection
try {
    require_once __DIR__ . '/../config/database.php';
    $database = new Database();
    $conn = $database->connect();
    
    if ($conn) {
        $status['database_connected'] = true;
        
        // Get database info
        $stmt = $conn->query("SELECT DATABASE() as db_name, VERSION() as db_version");
        $db_info = $stmt->fetch(PDO::FETCH_ASSOC);
        
        $status['database'] = [
            'status' => 'connected',
            'database_name' => $db_info['db_name'] ?? 'unknown',
            'database_version' => $db_info['db_version'] ?? 'unknown'
        ];
    }
} catch (PDOException $e) {
    $status['database'] = [
        'status' => 'error',
        'error' => 'PDO Connection Error: ' . $e->getMessage()
    ];
} catch (Exception $e) {
    $status['database'] = [
        'status' => 'error',
        'error' => 'Error: ' . $e->getMessage()
    ];
}

http_response_code(200);
echo json_encode($status, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);

