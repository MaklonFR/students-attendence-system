<?php

class AbsensiController {
    private $db;
    private $absensiModel;

    public function __construct($db) {
        $this->db = $db;
        $this->absensiModel = new Absensi($db);
    }

    public function index() {
        Middleware::auth();

        $query = Request::getQuery();
        $tanggal = $query['tanggal'] ?? date('Y-m-d');
        $kelas = $query['kelas'] ?? '';

        $data = $this->absensiModel->getByDate($tanggal, $kelas);
        Response::success('Data absensi berhasil diambil', $data);
    }

    public function store() {
        $user = Middleware::auth();

        $data = Request::getBody();

        if (empty($data['siswa_id']) || empty($data['tanggal']) || empty($data['status'])) {
            Response::error('Siswa ID, tanggal, dan status harus diisi');
        }

        $data['guru_id'] = $user['id'];
        $data['keterangan'] = $data['keterangan'] ?? '';

        try {
            if ($this->absensiModel->create($data)) {
                Response::success('Absensi berhasil disimpan', null, 201);
            } else {
                Response::error('Gagal menyimpan absensi', 500);
            }
        } catch (Exception $e) {
            Response::error('Error: ' . $e->getMessage(), 500);
        }
    }

    public function update($id) {
        Middleware::auth();

        $data = Request::getBody();

        if (empty($data['status'])) {
            Response::error('Status harus diisi');
        }

        $data['keterangan'] = $data['keterangan'] ?? '';

        if ($this->absensiModel->update($id, $data)) {
            Response::success('Absensi berhasil diupdate');
        } else {
            Response::error('Gagal mengupdate absensi', 500);
        }
    }

    public function delete($id) {
        Middleware::auth();

        if ($this->absensiModel->delete($id)) {
            Response::success('Absensi berhasil dihapus');
        } else {
            Response::error('Gagal menghapus absensi', 500);
        }
    }

    public function statistik() {
        Middleware::auth();

        $data = $this->absensiModel->getStatistik();
        Response::success('Statistik berhasil diambil', $data);
    }
}
