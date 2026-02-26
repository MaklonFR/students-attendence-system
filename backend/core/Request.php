<?php

class Request {
    public static function getMethod() {
        return $_SERVER['REQUEST_METHOD'];
    }

    public static function getUri() {
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        return rtrim($uri, '/');
    }

    public static function getBody() {
        $data = json_decode(file_get_contents('php://input'), true);
        return $data ?? [];
    }

    public static function getQuery() {
        return $_GET;
    }

    public static function getHeader($key) {
        $key = 'HTTP_' . strtoupper(str_replace('-', '_', $key));
        return $_SERVER[$key] ?? null;
    }
}
