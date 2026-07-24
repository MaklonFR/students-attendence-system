<?php

class Absensi {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getByDate($tanggal, $kelas = '') {
        $query = "SELECT a.*, s.nis, s.nama_lengkap, s.kelas, u.nama as guru_nama 
                  FROM absensi a
                  JOIN siswa s ON a.siswa_id = s.id
                  JOIN users u ON a.guru_id = u.id
                  WHERE a.tanggal = :tanggal";
        
        if ($kelas) {
            $query .= " AND s.kelas = :kelas";
        }
        
        $query .= " ORDER BY s.nama_lengkap ASC";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':tanggal', $tanggal);
        
        if ($kelas) {
            $stmt->bindParam(':kelas', $kelas);
        }
        
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function create($data) {
        $query = "INSERT INTO absensi (siswa_id, tanggal, status, keterangan, guru_id) 
                  VALUES (:siswa_id, :tanggal, :status, :keterangan, :guru_id)
                  ON DUPLICATE KEY UPDATE status = VALUES(status), keterangan = VALUES(keterangan), guru_id = VALUES(guru_id)";
        $stmt = $this->conn->prepare($query);
        
        $stmt->bindParam(':siswa_id', $data['siswa_id'], PDO::PARAM_INT);
        $stmt->bindParam(':tanggal', $data['tanggal']);
        $stmt->bindParam(':status', $data['status']);
        $stmt->bindParam(':keterangan', $data['keterangan']);
        $stmt->bindParam(':guru_id', $data['guru_id'], PDO::PARAM_INT);
        
        return $stmt->execute();
    }

    public function update($id, $data) {
        $query = "UPDATE absensi SET status = :status, keterangan = :keterangan WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        
        $stmt->bindParam(':status', $data['status']);
        $stmt->bindParam(':keterangan', $data['keterangan']);
        $stmt->bindParam(':id', $id);
        
        return $stmt->execute();
    }

    public function delete($id) {
        $query = "DELETE FROM absensi WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    public function getLaporanHarian($tanggal, $kelas = '') {
        $query = "SELECT 
                    s.id, s.nis, s.nama_lengkap, s.kelas,
                    COALESCE(a.status, 'alpha') as status,
                    CASE WHEN a.status = 'hadir' THEN 1 ELSE 0 END as hadir,
                    CASE WHEN a.status = 'izin' THEN 1 ELSE 0 END as izin,
                    CASE WHEN a.status = 'sakit' THEN 1 ELSE 0 END as sakit,
                    CASE WHEN a.status = 'alpha' OR a.id IS NULL THEN 1 ELSE 0 END as alpha
                  FROM siswa s
                  LEFT JOIN absensi a ON s.id = a.siswa_id AND a.tanggal = :tanggal
                  WHERE s.status = 'aktif'";
        
        if ($kelas) {
            $query .= " AND s.kelas = :kelas";
        }
        
        $query .= " ORDER BY s.nama_lengkap ASC";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':tanggal', $tanggal);
        
        if ($kelas) {
            $stmt->bindParam(':kelas', $kelas);
        }
        
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getLaporanBulanan($bulan, $tahun, $kelas = '') {
        $query = "SELECT 
                    s.id, s.nis, s.nama_lengkap, s.kelas,
                    SUM(CASE WHEN a.status = 'hadir' THEN 1 ELSE 0 END) as hadir,
                    SUM(CASE WHEN a.status = 'izin' THEN 1 ELSE 0 END) as izin,
                    SUM(CASE WHEN a.status = 'sakit' THEN 1 ELSE 0 END) as sakit,
                    SUM(CASE WHEN a.status = 'alpha' THEN 1 ELSE 0 END) as alpha,
                    GROUP_CONCAT(CONCAT(DATE_FORMAT(a.tanggal, '%d-%m-%Y'), ' (', UPPER(SUBSTRING(a.status, 1, 1)), SUBSTRING(a.status, 2), ')') ORDER BY a.tanggal ASC SEPARATOR ', ') as tanggal_absen
                  FROM siswa s
                  LEFT JOIN absensi a ON s.id = a.siswa_id 
                    AND MONTH(a.tanggal) = :bulan 
                    AND YEAR(a.tanggal) = :tahun
                  WHERE s.status = 'aktif'";
        
        if ($kelas) {
            $query .= " AND s.kelas = :kelas";
        }
        
        $query .= " GROUP BY s.id ORDER BY s.nama_lengkap";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':bulan', $bulan);
        $stmt->bindParam(':tahun', $tahun);
        
        if ($kelas) {
            $stmt->bindParam(':kelas', $kelas);
        }
        
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getLaporanSemester($semester, $tahun, $kelas = '') {
        $query = "SELECT 
                    s.id, s.nis, s.nama_lengkap, s.kelas,
                    SUM(CASE WHEN a.status = 'hadir' THEN 1 ELSE 0 END) as hadir,
                    SUM(CASE WHEN a.status = 'izin' THEN 1 ELSE 0 END) as izin,
                    SUM(CASE WHEN a.status = 'sakit' THEN 1 ELSE 0 END) as sakit,
                    SUM(CASE WHEN a.status = 'alpha' THEN 1 ELSE 0 END) as alpha
                  FROM siswa s
                  LEFT JOIN absensi a ON s.id = a.siswa_id";
        
        if ($semester == 1) {
            $query .= " AND MONTH(a.tanggal) IN (7,8,9) AND YEAR(a.tanggal) = :tahun";
        } else {
            $query .= " AND MONTH(a.tanggal) IN (1,2,3,4,5,6) AND YEAR(a.tanggal) = :tahun";
        }
        
        $query .= " WHERE s.status = 'aktif'";
        
        if ($kelas) {
            $query .= " AND s.kelas = :kelas";
        }
        
        $query .= " GROUP BY s.id ORDER BY s.nama_lengkap";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':tahun', $tahun);
        
        if ($kelas) {
            $stmt->bindParam(':kelas', $kelas);
        }
        
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getStatistik() {
        $today = date('Y-m-d');
        $query = "SELECT 
                    (SELECT COUNT(*) FROM siswa WHERE status = 'aktif') as total_siswa,
                    (SELECT COUNT(*) FROM users) as total_guru,
                    COALESCE((SELECT COUNT(*) FROM absensi WHERE tanggal = :today1 AND status = 'hadir'), 0) as hadir_hari_ini,
                    COALESCE((SELECT COUNT(*) FROM absensi WHERE tanggal = :today2 AND status = 'alpha'), 0) as alpha_hari_ini";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':today1', $today);
        $stmt->bindParam(':today2', $today);
        $stmt->execute();
        return $stmt->fetch();
    }
}
