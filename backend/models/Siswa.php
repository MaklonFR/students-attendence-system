<?php

class Siswa {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getAll($search = '', $kelas = '', $status = '', $limit = 50, $offset = 0) {
        $query = "SELECT * FROM siswa WHERE 1=1";
        
        if ($search) {
            $query .= " AND (nama_lengkap LIKE :search OR nis LIKE :search)";
        }
        if ($kelas) {
            $query .= " AND kelas = :kelas";
        }
        if ($status) {
            $query .= " AND status = :status";
        }
        
        $query .= " ORDER BY nama_lengkap ASC LIMIT :limit OFFSET :offset";
        
        // Debug log dengan tipe data
        error_log('=== Siswa::getAll() ===');
        error_log('Query: ' . $query);
        error_log('Params: [search="' . $search . '", kelas="' . $kelas . '", status="' . $status . '", limit=' . $limit . ', offset=' . $offset . ']');
        error_log('Kelas is empty: ' . (empty($kelas) ? 'YES' : 'NO'));
        error_log('Kelas value: [' . $kelas . ']');
        error_log('Kelas type: ' . gettype($kelas));
        error_log('==================');
        
        $stmt = $this->conn->prepare($query);
        
        if ($search) {
            $searchParam = "%{$search}%";
            $stmt->bindParam(':search', $searchParam);
        }
        if ($kelas) {
            error_log('Binding kelas parameter: ' . $kelas);
            $stmt->bindParam(':kelas', $kelas);
        }
        if ($status) {
            error_log('Binding status parameter: ' . $status);
            $stmt->bindParam(':status', $status);
        }
        
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
        
        $result = $stmt->execute();
        error_log('Execute result: ' . ($result ? 'SUCCESS' : 'FAILED'));
        
        $data = $stmt->fetchAll();
        error_log('Rows returned: ' . count($data));
        
        return $data;
    }

    public function count($search = '', $kelas = '', $status = '') {
        $query = "SELECT COUNT(*) as total FROM siswa WHERE 1=1";
        
        if ($search) {
            $query .= " AND (nama_lengkap LIKE :search OR nis LIKE :search)";
        }
        if ($kelas) {
            $query .= " AND kelas = :kelas";
        }
        if ($status) {
            $query .= " AND status = :status";
        }
        
        $stmt = $this->conn->prepare($query);
        
        if ($search) {
            $searchParam = "%{$search}%";
            $stmt->bindParam(':search', $searchParam);
        }
        if ($kelas) {
            $stmt->bindParam(':kelas', $kelas);
        }
        if ($status) {
            $stmt->bindParam(':status', $status);
        }
        
        $stmt->execute();
        return $stmt->fetch()['total'];
    }

    public function getById($id) {
        $query = "SELECT * FROM siswa WHERE id = :id LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch();
    }

    public function create($data) {
        $query = "INSERT INTO siswa (nis, nama_lengkap, kelas, jenis_kelamin, alamat, status) 
                  VALUES (:nis, :nama_lengkap, :kelas, :jenis_kelamin, :alamat, :status)";
        $stmt = $this->conn->prepare($query);
        
        $stmt->bindParam(':nis', $data['nis']);
        $stmt->bindParam(':nama_lengkap', $data['nama_lengkap']);
        $stmt->bindParam(':kelas', $data['kelas']);
        $stmt->bindParam(':jenis_kelamin', $data['jenis_kelamin']);
        $stmt->bindParam(':alamat', $data['alamat']);
        $stmt->bindParam(':status', $data['status']);
        
        return $stmt->execute();
    }

    public function update($id, $data) {
        $query = "UPDATE siswa SET nis = :nis, nama_lengkap = :nama_lengkap, kelas = :kelas, 
                  jenis_kelamin = :jenis_kelamin, alamat = :alamat, status = :status WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        
        $stmt->bindParam(':nis', $data['nis']);
        $stmt->bindParam(':nama_lengkap', $data['nama_lengkap']);
        $stmt->bindParam(':kelas', $data['kelas']);
        $stmt->bindParam(':jenis_kelamin', $data['jenis_kelamin']);
        $stmt->bindParam(':alamat', $data['alamat']);
        $stmt->bindParam(':status', $data['status']);
        $stmt->bindParam(':id', $id);
        
        return $stmt->execute();
    }

    public function delete($id) {
        $query = "DELETE FROM siswa WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}
