<?php

class LaporanController {
    private $db;
    private $absensiModel;

    public function __construct($db) {
        $this->db = $db;
        $this->absensiModel = new Absensi($db);
    }

    public function harian() {
        Middleware::auth();

        $query = Request::getQuery();
        $tanggal = $query['tanggal'] ?? date('Y-m-d');
        $kelas = $query['kelas'] ?? '';

        $data = $this->absensiModel->getLaporanHarian($tanggal, $kelas);
        Response::success('Laporan harian berhasil diambil', $data);
    }

    public function bulanan() {
        Middleware::auth();

        $query = Request::getQuery();
        $bulan = $query['bulan'] ?? date('m');
        $tahun = $query['tahun'] ?? date('Y');
        $kelas = $query['kelas'] ?? '';

        $data = $this->absensiModel->getLaporanBulanan($bulan, $tahun, $kelas);
        Response::success('Laporan bulanan berhasil diambil', $data);
    }
}
