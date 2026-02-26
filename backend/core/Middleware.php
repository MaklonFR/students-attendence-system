<?php

class Middleware {
    public static function auth() {
        $authHeader = Request::getHeader('Authorization');
        
        if (!$authHeader || !preg_match('/Bearer\s+(.*)$/i', $authHeader, $matches)) {
            Response::error('Token tidak ditemukan', 401);
        }

        $token = $matches[1];
        $decoded = JWTHandler::decode($token);

        if (!$decoded) {
            Response::error('Token tidak valid atau expired', 401);
        }

        return $decoded;
    }

    public static function adminOnly($user) {
        if ($user['role'] !== 'admin') {
            Response::error('Akses ditolak. Hanya admin yang diizinkan', 403);
        }
    }
}
