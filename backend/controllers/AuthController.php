<?php

class AuthController {
    private $db;
    private $userModel;

    public function __construct($db) {
        $this->db = $db;
        $this->userModel = new User($db);
    }

    public function login() {
        $data = Request::getBody();

        if (empty($data['email']) || empty($data['password'])) {
            Response::error('Email dan password harus diisi');
        }

        $user = $this->userModel->findByEmail($data['email']);

        if (!$user || !password_verify($data['password'], $user['password'])) {
            Response::error('Email atau password salah', 401);
        }

        $token = JWTHandler::encode([
            'id' => $user['id'],
            'email' => $user['email'],
            'nama' => $user['nama'],
            'role' => $user['role']
        ]);

        Response::success('Login berhasil', [
            'token' => $token,
            'user' => [
                'id' => $user['id'],
                'nama' => $user['nama'],
                'email' => $user['email'],
                'role' => $user['role']
            ]
        ]);
    }

    public function logout() {
        Response::success('Logout berhasil');
    }
}
