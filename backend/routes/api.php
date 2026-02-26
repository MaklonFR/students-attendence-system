<?php

$database = new Database();
$db = $database->connect();

$router = new Router();

// Auth routes
$router->add('POST', '/api/login', function() use ($db) {
    $controller = new AuthController($db);
    $controller->login();
});

$router->add('POST', '/api/logout', function() use ($db) {
    $controller = new AuthController($db);
    $controller->logout();
});

// User routes (Admin only)
$router->add('GET', '/api/users', function() use ($db) {
    $controller = new UserController($db);
    $controller->index();
});

$router->add('POST', '/api/users', function() use ($db) {
    $controller = new UserController($db);
    $controller->store();
});

$router->add('PUT', '/api/users/{id}', function($id) use ($db) {
    $controller = new UserController($db);
    $controller->update($id);
});

$router->add('DELETE', '/api/users/{id}', function($id) use ($db) {
    $controller = new UserController($db);
    $controller->delete($id);
});

// Siswa routes
$router->add('GET', '/api/siswa', function() use ($db) {
    $controller = new SiswaController($db);
    $controller->index();
});

$router->add('GET', '/api/siswa/{id}', function($id) use ($db) {
    $controller = new SiswaController($db);
    $controller->show($id);
});

$router->add('POST', '/api/siswa', function() use ($db) {
    $controller = new SiswaController($db);
    $controller->store();
});

$router->add('PUT', '/api/siswa/{id}', function($id) use ($db) {
    $controller = new SiswaController($db);
    $controller->update($id);
});

$router->add('DELETE', '/api/siswa/{id}', function($id) use ($db) {
    $controller = new SiswaController($db);
    $controller->delete($id);
});

// Absensi routes
$router->add('GET', '/api/absensi', function() use ($db) {
    $controller = new AbsensiController($db);
    $controller->index();
});

$router->add('POST', '/api/absensi', function() use ($db) {
    $controller = new AbsensiController($db);
    $controller->store();
});

$router->add('PUT', '/api/absensi/{id}', function($id) use ($db) {
    $controller = new AbsensiController($db);
    $controller->update($id);
});

$router->add('DELETE', '/api/absensi/{id}', function($id) use ($db) {
    $controller = new AbsensiController($db);
    $controller->delete($id);
});

$router->add('GET', '/api/statistik', function() use ($db) {
    $controller = new AbsensiController($db);
    $controller->statistik();
});

// Laporan routes
$router->add('GET', '/api/laporan/harian', function() use ($db) {
    $controller = new LaporanController($db);
    $controller->harian();
});

$router->add('GET', '/api/laporan/bulanan', function() use ($db) {
    $controller = new LaporanController($db);
    $controller->bulanan();
});

// Monitoring routes
$router->add('GET', '/api/monitoring/weekly', function() use ($db) {
    $controller = new MonitoringController($db);
    $controller->getWeeklyMonitoring();
});

$router->dispatch();
