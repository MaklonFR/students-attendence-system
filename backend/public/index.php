<?php

error_reporting(0);
ini_set('display_errors', 0);

// Debug: Log incoming request
// file_put_contents(__DIR__ . '/debug.log', date('Y-m-d H:i:s') . ' - ' . $_SERVER['REQUEST_METHOD'] . ' ' . $_SERVER['REQUEST_URI'] . PHP_EOL, FILE_APPEND);

require_once __DIR__ . '/../config/cors.php';
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../core/Response.php';
require_once __DIR__ . '/../core/Request.php';
require_once __DIR__ . '/../core/Router.php';
require_once __DIR__ . '/../core/JWTHandler.php';
require_once __DIR__ . '/../core/Middleware.php';
require_once __DIR__ . '/../models/User.php';
require_once __DIR__ . '/../models/Siswa.php';
require_once __DIR__ . '/../models/Absensi.php';
require_once __DIR__ . '/../controllers/AuthController.php';
require_once __DIR__ . '/../controllers/UserController.php';
require_once __DIR__ . '/../controllers/SiswaController.php';
require_once __DIR__ . '/../controllers/AbsensiController.php';
require_once __DIR__ . '/../controllers/LaporanController.php';
require_once __DIR__ . '/../controllers/MonitoringController.php';

// Handle route query parameter untuk backward compatibility
if (isset($_GET['route'])) {
    // Preserve query parameters while setting correct REQUEST_URI
    $query_params = $_GET;
    unset($query_params['route']);
    $route = $_GET['route'];
    
    // Build proper API path
    $_SERVER['REQUEST_URI'] = '/api/' . $route;
    if (!empty($query_params)) {
        $_SERVER['REQUEST_URI'] .= '?' . http_build_query($query_params);
    }
}

require_once __DIR__ . '/../routes/api.php';
