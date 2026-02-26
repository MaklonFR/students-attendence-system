<?php

class Request {
    public static function getMethod() {
        return $_SERVER['REQUEST_METHOD'];
    }

    public static function getUri() {
        // Get the REQUEST_URI
        $uri = $_SERVER['REQUEST_URI'] ?? '/';
        
        // Parse URL to get path only (remove query string and fragment)
        $uri = parse_url($uri, PHP_URL_PATH);
        
        // Remove /public/ prefix
        $uri = preg_replace('#^/public#', '', $uri);
        
        // Jika kosong, set ke /
        if (empty($uri)) {
            $uri = '/';
        }
        
        $uri = rtrim($uri, '/') ?: '/';
        
        // Add /api prefix jika belum ada dan bukan root
        if ($uri !== '/' && strpos($uri, '/api') !== 0 && !in_array($uri, ['/test.php', '/hello.php', '/status'])) {
            $uri = '/api' . $uri;
        }
        
        return $uri;
    }

    public static function getBody() {
        $data = json_decode(file_get_contents('php://input'), true);
        return $data ?? [];
    }

    public static function getQuery() {
        // $_GET already contains all query parameters correctly
        return $_GET ?? [];
    }

    public static function getHeader($key) {
        $key = 'HTTP_' . strtoupper(str_replace('-', '_', $key));
        return $_SERVER[$key] ?? null;
    }
}
