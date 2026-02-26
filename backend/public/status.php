<?php

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../core/Response.php';

// CORS Headers
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Authorization');
header('Content-Type: application/json; charset=UTF-8');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

$response = new Response();
$database = new Database();

$status = [
    'status' => 'running',
    'message' => 'Backend API Sistem Absensi SMP berjalan dengan baik',
    'url' => 'https://absen.batucermin-desa.id',
    'timestamp' => date('Y-m-d H:i:s'),
    'php_version' => phpversion(),
    'database_connected' => false,
    'database_info' => null
];

// Test Database Connection
try {
    $conn = $database->connect();
    if ($conn) {
        $status['database_connected'] = true;
        
        // Get database info
        $stmt = $conn->query("SELECT DATABASE() as db_name, VERSION() as db_version");
        $db_info = $stmt->fetch(PDO::FETCH_ASSOC);
        
        $status['database_info'] = [
            'database_name' => $db_info['db_name'],
            'database_version' => $db_info['db_version']
        ];
    }
} catch (Exception $e) {
    $status['database_error'] = $e->getMessage();
}

// Check API Routes
$status['api_endpoints'] = [
    'status' => '/status.php',
    'auth' => '/router.php?route=auth/login (POST)',
    'users' => '/router.php?route=users (GET)',
    'siswa' => '/router.php?route=siswa (GET)',
    'absensi' => '/router.php?route=absensi (GET)',
    'laporan' => '/router.php?route=laporan (GET)',
    'monitoring' => '/router.php?route=monitoring (GET)'
];

$response->success($status);
