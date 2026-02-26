<?php

class UserController {
    private $db;
    private $userModel;

    public function __construct($db) {
        $this->db = $db;
        $this->userModel = new User($db);
    }

    public function index() {
        $user = Middleware::auth();
        Middleware::adminOnly($user);

        $users = $this->userModel->getAll();
        Response::success('Data users berhasil diambil', $users);
    }

    public function store() {
        $user = Middleware::auth();
        Middleware::adminOnly($user);

        $data = Request::getBody();

        if (empty($data['nama']) || empty($data['email']) || empty($data['password']) || empty($data['role'])) {
            Response::error('Semua field harus diisi');
        }

        if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            Response::error('Format email tidak valid');
        }

        if ($this->userModel->create($data)) {
            Response::success('User berhasil ditambahkan', null, 201);
        } else {
            Response::error('Gagal menambahkan user', 500);
        }
    }

    public function update($id) {
        $user = Middleware::auth();
        Middleware::adminOnly($user);

        $data = Request::getBody();

        if (empty($data['nama']) || empty($data['email']) || empty($data['role'])) {
            Response::error('Nama, email, dan role harus diisi');
        }

        if ($this->userModel->update($id, $data)) {
            Response::success('User berhasil diupdate');
        } else {
            Response::error('Gagal mengupdate user', 500);
        }
    }

    public function delete($id) {
        $user = Middleware::auth();
        Middleware::adminOnly($user);

        if ($user['id'] == $id) {
            Response::error('Tidak dapat menghapus akun sendiri');
        }

        if ($this->userModel->delete($id)) {
            Response::success('User berhasil dihapus');
        } else {
            Response::error('Gagal menghapus user', 500);
        }
    }
}
