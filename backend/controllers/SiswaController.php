<?php

class SiswaController {
    private $db;
    private $siswaModel;

    public function __construct($db) {
        $this->db = $db;
        $this->siswaModel = new Siswa($db);
    }

    public function index() {
        Middleware::auth();

        $query = Request::getQuery();
        $search = $query['search'] ?? '';
        $kelas = $query['kelas'] ?? '';
        $page = isset($query['page']) ? (int)$query['page'] : 1;
        $limit = isset($query['limit']) ? (int)$query['limit'] : 10;
        $offset = ($page - 1) * $limit;

        $data = $this->siswaModel->getAll($search, $kelas, $limit, $offset);
        $total = $this->siswaModel->count($search, $kelas);

        Response::success('Data siswa berhasil diambil', [
            'data' => $data,
            'total' => $total,
            'page' => $page,
            'limit' => $limit
        ]);
    }

    public function show($id) {
        Middleware::auth();

        $siswa = $this->siswaModel->getById($id);
        
        if (!$siswa) {
            Response::error('Siswa tidak ditemukan', 404);
        }

        Response::success('Data siswa berhasil diambil', $siswa);
    }

    public function store() {
        Middleware::auth();

        $data = Request::getBody();

        if (empty($data['nis']) || empty($data['nama_lengkap']) || empty($data['kelas']) || empty($data['jenis_kelamin'])) {
            Response::error('NIS, nama lengkap, kelas, dan jenis kelamin harus diisi');
        }

        $data['status'] = $data['status'] ?? 'aktif';

        if ($this->siswaModel->create($data)) {
            Response::success('Siswa berhasil ditambahkan', null, 201);
        } else {
            Response::error('Gagal menambahkan siswa', 500);
        }
    }

    public function update($id) {
        Middleware::auth();

        $data = Request::getBody();

        if (empty($data['nis']) || empty($data['nama_lengkap']) || empty($data['kelas']) || empty($data['jenis_kelamin'])) {
            Response::error('NIS, nama lengkap, kelas, dan jenis kelamin harus diisi');
        }

        if ($this->siswaModel->update($id, $data)) {
            Response::success('Siswa berhasil diupdate');
        } else {
            Response::error('Gagal mengupdate siswa', 500);
        }
    }

    public function delete($id) {
        Middleware::auth();

        if ($this->siswaModel->delete($id)) {
            Response::success('Siswa berhasil dihapus');
        } else {
            Response::error('Gagal menghapus siswa', 500);
        }
    }
}
