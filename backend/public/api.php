<?php

error_reporting(0);
ini_set('display_errors', 0);

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

require_once __DIR__ . '/../routes/api.php';
