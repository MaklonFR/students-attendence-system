import API_CONFIG from './config.js';
import { getToken } from './auth.js';

const apiRequest = async (endpoint, options = {}) => {
    const token = getToken();
    const headers = {
        'Content-Type': 'application/json',
        ...options.headers
    };

    if (token) {
        headers['Authorization'] = `Bearer ${token}`;
    }

    try {
        const response = await fetch(`${API_CONFIG.BASE_URL}${endpoint}`, {
            ...options,
            headers
        });

        const text = await response.text();
        
        if (!text) {
            throw new Error('Server tidak memberikan response');
        }

        let data;
        try {
            data = JSON.parse(text);
        } catch (e) {
            console.error('Response:', text);
            throw new Error('Server error: Invalid JSON response');
        }

        if (!response.ok) {
            throw new Error(data.message || 'Terjadi kesalahan');
        }

        return data;
    } catch (error) {
        throw error;
    }
};

export const api = {
    login: (credentials) => apiRequest(API_CONFIG.ENDPOINTS.LOGIN, {
        method: 'POST',
        body: JSON.stringify(credentials)
    }),

    logout: () => apiRequest(API_CONFIG.ENDPOINTS.LOGOUT, { method: 'POST' }),

    getUsers: () => apiRequest(API_CONFIG.ENDPOINTS.USERS),
    createUser: (data) => apiRequest(API_CONFIG.ENDPOINTS.USERS, {
        method: 'POST',
        body: JSON.stringify(data)
    }),
    updateUser: (id, data) => apiRequest(`${API_CONFIG.ENDPOINTS.USERS}/${id}`, {
        method: 'PUT',
        body: JSON.stringify(data)
    }),
    deleteUser: (id) => apiRequest(`${API_CONFIG.ENDPOINTS.USERS}/${id}`, { method: 'DELETE' }),

    getSiswa: (params = '') => apiRequest(`${API_CONFIG.ENDPOINTS.SISWA}${params}`),
    getSiswaById: (id) => apiRequest(`${API_CONFIG.ENDPOINTS.SISWA}/${id}`),
    createSiswa: (data) => apiRequest(API_CONFIG.ENDPOINTS.SISWA, {
        method: 'POST',
        body: JSON.stringify(data)
    }),
    updateSiswa: (id, data) => apiRequest(`${API_CONFIG.ENDPOINTS.SISWA}/${id}`, {
        method: 'PUT',
        body: JSON.stringify(data)
    }),
    deleteSiswa: (id) => apiRequest(`${API_CONFIG.ENDPOINTS.SISWA}/${id}`, { method: 'DELETE' }),

    getAbsensi: (params = '') => apiRequest(`${API_CONFIG.ENDPOINTS.ABSENSI}${params}`),
    createAbsensi: (data) => apiRequest(API_CONFIG.ENDPOINTS.ABSENSI, {
        method: 'POST',
        body: JSON.stringify(data)
    }),
    updateAbsensi: (id, data) => apiRequest(`${API_CONFIG.ENDPOINTS.ABSENSI}/${id}`, {
        method: 'PUT',
        body: JSON.stringify(data)
    }),
    deleteAbsensi: (id) => apiRequest(`${API_CONFIG.ENDPOINTS.ABSENSI}/${id}`, { method: 'DELETE' }),

    getStatistik: () => apiRequest(API_CONFIG.ENDPOINTS.STATISTIK),
    getLaporanHarian: (params = '') => apiRequest(`${API_CONFIG.ENDPOINTS.LAPORAN_HARIAN}${params}`),
    getLaporanBulanan: (params = '') => apiRequest(`${API_CONFIG.ENDPOINTS.LAPORAN_BULANAN}${params}`),
    getMonitoringWeekly: () => apiRequest('/api/monitoring/weekly')
};
