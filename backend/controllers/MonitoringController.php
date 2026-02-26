<?php

class MonitoringController {
    private $db;
    
    public function __construct($db) {
        $this->db = $db;
    }
    
    public function getWeeklyMonitoring() {
        try {
            $endDate = date('Y-m-d');
            $startDate = date('Y-m-d', strtotime('-6 days'));
            
            $query = "SELECT 
                        s.id,
                        s.nis,
                        s.nama_lengkap,
                        s.kelas,
                        SUM(CASE WHEN a.status = 'hadir' THEN 1 ELSE 0 END) as hadir,
                        SUM(CASE WHEN a.status = 'izin' THEN 1 ELSE 0 END) as izin,
                        SUM(CASE WHEN a.status = 'sakit' THEN 1 ELSE 0 END) as sakit,
                        SUM(CASE WHEN a.status = 'alpha' THEN 1 ELSE 0 END) as alpha
                      FROM siswa s
                      LEFT JOIN absensi a ON s.id = a.siswa_id 
                        AND a.tanggal BETWEEN :start_date AND :end_date
                      WHERE s.status = 'aktif'
                      GROUP BY s.id, s.nis, s.nama_lengkap, s.kelas
                      ORDER BY alpha DESC, s.nama_lengkap ASC";
            
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':start_date', $startDate);
            $stmt->bindParam(':end_date', $endDate);
            $stmt->execute();
            
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            return Response::json([
                'success' => true,
                'data' => $data,
                'period' => [
                    'start' => $startDate,
                    'end' => $endDate
                ]
            ]);
        } catch (Exception $e) {
            return Response::json([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage()
            ], 500);
        }
    }
}
