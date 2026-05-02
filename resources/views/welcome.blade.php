<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes">
    <title>REGU - Evaluasi Guru Modern</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,300;400;500;600;700&display=swap');
        * { font-family: 'Inter', sans-serif; }
        body {
            background: linear-gradient(135deg, #0f4c5c 0%, #1a9988 50%, #6ec8c6 100%);
            background-attachment: fixed;
        }
        .glass-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 32px;
            box-shadow: 0 25px 45px rgba(0, 0, 0, 0.2);
        }
        .btn-gradient {
            background: linear-gradient(105deg, #0f4c5c 0%, #1a9988 100%);
            transition: transform 0.2s;
        }
        .btn-gradient:hover { transform: translateY(-2px); }
    </style>
</head>
<body>
    <div class="min-h-screen flex items-center justify-center p-4">
        <div class="glass-card w-full max-w-md p-8 md:p-10">
            <div class="text-center mb-8">
                <div class="inline-flex items-center justify-center w-20 h-20 bg-gradient-to-br from-teal-500 to-cyan-600 rounded-2xl shadow-lg mb-4">
                    <i class="fas fa-chalkboard-user text-white text-4xl"></i>
                </div>
                <h1 class="text-3xl md:text-4xl font-bold bg-gradient-to-r from-teal-700 to-cyan-600 bg-clip-text text-transparent">REGU</h1>
                <p class="text-gray-500 mt-2 font-medium">Rating Guru • Evaluasi Kinerja</p>
                <p class="text-xs text-gray-400 mt-1">UPN Veteran Jakarta</p>
            </div>
            
            <form id="loginForm" class="space-y-5">
                <div>
                    <label class="block text-gray-700 font-semibold mb-2"><i class="fas fa-id-card text-teal-600 mr-2"></i>NIS / NIP</label>
                    <input type="text" id="username" class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-teal-500 focus:outline-none" placeholder="Masukkan NIS atau NIP" required>
                </div>
                <div>
                    <label class="block text-gray-700 font-semibold mb-2"><i class="fas fa-lock text-teal-600 mr-2"></i>Password</label>
                    <input type="password" id="password" class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-teal-500 focus:outline-none" placeholder="Masukkan password" required>
                </div>
                <button type="submit" class="btn-gradient w-full text-white font-bold py-3 rounded-xl flex items-center justify-center gap-2 text-lg"><i class="fas fa-arrow-right-to-bracket"></i> Masuk ke Dashboard</button>
            </form>
            
            <div class="mt-8 pt-6 border-t border-gray-200">
                <p class="text-center text-xs text-gray-500 mb-3"><i class="fas fa-info-circle text-teal-500"></i> Demo Akun</p>
                <div class="grid grid-cols-3 gap-2">
                    <div onclick="fillDemo('12345', 'siswa123')" class="bg-white/50 rounded-xl p-2 text-center cursor-pointer hover:shadow-md"><i class="fas fa-user-graduate text-blue-600"></i><p class="text-[11px] font-semibold">Siswa</p><p class="text-[10px] text-gray-500">12345</p></div>
                    <div onclick="fillDemo('9999', 'bk123')" class="bg-white/50 rounded-xl p-2 text-center cursor-pointer hover:shadow-md"><i class="fas fa-chalkboard-user text-purple-600"></i><p class="text-[11px] font-semibold">Guru BK</p><p class="text-[10px] text-gray-500">9999</p></div>
                    <div onclick="fillDemo('8888', 'kepsek123')" class="bg-white/50 rounded-xl p-2 text-center cursor-pointer hover:shadow-md"><i class="fas fa-building-user text-green-600"></i><p class="text-[11px] font-semibold">Kepsek</p><p class="text-[10px] text-gray-500">8888</p></div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // ⚠️ GANTI DENGAN URL APPS SCRIPT KAMU! ⚠️
        const API_URL = 'https://script.google.com/macros/s/AKfycbzhkKfEYA7W2JfBO7zJsdnIvhg5_a29nyv7BJBMT-OUX2tD8a82o7Un8hFwCUJc75PGfA/exec';
        
        window.fillDemo = function(nis, pass) {
            document.getElementById('username').value = nis;
            document.getElementById('password').value = pass;
            Swal.fire({ icon: 'info', title: 'Akun Demo Dipilih', timer: 1500, showConfirmButton: false });
        };
        
        document.getElementById('loginForm').addEventListener('submit', async (e) => {
            e.preventDefault();
            const username = document.getElementById('username').value.trim();
            const password = document.getElementById('password').value;
            Swal.fire({ title: 'Memproses...', allowOutsideClick: false, didOpen: () => { Swal.showLoading(); } });
            
            if (username === '9999' && password === 'bk123') {
                Swal.close();
                localStorage.setItem('role', 'bk');
                window.location.href = 'bk_dashboard.html';
                return;
            }
            if (username === '8888' && password === 'kepsek123') {
                Swal.close();
                localStorage.setItem('role', 'kepsek');
                window.location.href = 'kepsek_dashboard.html';
                return;
            }
            
            try {
                const url = `${API_URL}?action=login&nis=${username}&pass=${password}`;
                const response = await fetch(url);
                const data = await response.json();
                Swal.close();
                if (data.status === 'success') {
                    localStorage.setItem('role', 'siswa');
                    localStorage.setItem('nis_siswa', username);
                    localStorage.setItem('nama_siswa', data.nama);
                    localStorage.setItem('kelas', data.kelas);
                    window.location.href = 'siswa_dashboard.html';
                } else {
                    Swal.fire({ icon: 'error', title: 'Gagal Login!', text: data.message || 'NIS atau password salah' });
                }
            } catch (error) {
                Swal.close();
                Swal.fire({ icon: 'error', title: 'Koneksi Gagal', text: 'Cek koneksi internet atau URL API' });
            }
        });
    </script>
</body>
</html>