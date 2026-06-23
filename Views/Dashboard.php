<?php
$title = "Dashboard Manajemen Karyawan";

require_once '../Database/Koneksi.php';  

$db = new Database();
// Query untuk mendapatkan jumlah tiket
// $sql_tiket = "SELECT COUNT(*) AS total_tiket FROM tabel_tiket";
// $result_tiket = $db->koneksi->query($sql_tiket);

ob_start();
?>

<div class="mb-8">
    <h1 class="text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Selamat Datang, Adit Kurniadi</h1>
    <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">Berikut adalah ringkasan data pada Sistem Informasi
        Akademik saat ini.</p>
</div>

<div class="bg-white dark:bg-gray-900 overflow-hidden rounded-xl border border-gray-200 dark:border-gray-800 shadow-sm">
    <div class="mx-auto max-w-7xl">
        <div class="grid grid-cols-1 gap-px bg-gray-200 dark:bg-gray-800 sm:grid-cols-2 lg:grid-cols-4">

            <div class="bg-white px-4 py-6 sm:px-6 lg:px-8 dark:bg-gray-900">
                <p class="text-sm/6 font-medium text-gray-500 dark:text-gray-400">Total Tiket</p>
                <p class="mt-2 flex items-baseline gap-x-2">
                    <span class="text-4xl font-semibold tracking-tight text-gray-900 dark:text-white"></span>
                </p>
            </div>
            <div class="bg-white px-4 py-6 sm:px-6 lg:px-8 dark:bg-gray-900">
                <p class="text-sm/6 font-medium text-gray-500 dark:text-gray-400">Total Mahasiswa</p>
                <p class="mt-2 flex items-baseline gap-x-2">
                    <span class="text-4xl font-semibold tracking-tight text-gray-900 dark:text-white">Hehe</span>
                </p>
            </div>
            <div class="bg-white px-4 py-6 sm:px-6 lg:px-8 dark:bg-gray-900">
                <p class="text-sm/6 font-medium text-gray-500 dark:text-gray-400">Total Mahasiswa</p>
                <p class="mt-2 flex items-baseline gap-x-2">
                    <span class="text-4xl font-semibold tracking-tight text-gray-900 dark:text-white">Hehe</span>
                </p>
            </div>
            <div class="bg-white px-4 py-6 sm:px-6 lg:px-8 dark:bg-gray-900">
                <p class="text-sm/6 font-medium text-gray-500 dark:text-gray-400">Total Mahasiswa</p>
                <p class="mt-2 flex items-baseline gap-x-2">
                    <span class="text-4xl font-semibold tracking-tight text-gray-900 dark:text-white">Hehe</span>
                </p>
            </div>

        </div>
    </div>
</div>

<div class="bg-white dark:bg-gray-900 rounded-xl border border-gray-200 dark:border-gray-800 shadow-sm p-6 mt-8">
    <div class="mb-4">
        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Tren Mahasiswa per Angkatan</h3>
        <p class="text-sm text-gray-500 dark:text-gray-400">Grafik perbandingan jumlah mahasiswa yang terdaftar di
            setiap angkatan.</p>
    </div>

    <div class="relative w-full h-80">
        <canvas id="chartAngkatan"></canvas>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
const ctx = document.getElementById('chartAngkatan').getContext('2d');

const labelAngkatan = <?php echo json_encode($labels_angkatan); ?>;
const dataJumlah = <?php echo json_encode($totals_angkatan); ?>;

new Chart(ctx, {
    type: 'bar',
    data: {
        labels: labelAngkatan,
        datasets: [{
            label: 'Jumlah Mahasiswa',
            data: dataJumlah,
            backgroundColor: 'rgba(79, 70, 229, 0.8)',
            borderColor: 'rgba(79, 70, 229, 1)',
            borderWidth: 1,
            borderRadius: 6
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                display: false,
            }
        },
        scales: {
            x: {
                title: {
                    display: true,
                    text: 'Tahun Angkatan',
                    color: '#374151',
                    font: {
                        size: 14,
                        weight: 'bold',
                        family: "'Inter', sans-serif"
                    },
                    padding: {
                        top: 10,
                        left: 0,
                        right: 0,
                        bottom: 0
                    } // Memberi sedikit jarak
                },
                ticks: {
                    color: '#6b7280',
                },
                grid: {
                    display: false
                }
            },
            y: {
                // Menambahkan judul untuk sumbu Y (kiri)
                title: {
                    display: true,
                    text: 'Banyaknya Mahasiswa',
                    color: '#374151',
                    font: {
                        size: 14,
                        weight: 'bold',
                        family: "'Inter', sans-serif"
                    },
                    padding: {
                        top: 0,
                        left: 0,
                        right: 0,
                        bottom: 10
                    }
                },
                beginAtZero: true,
                ticks: {
                    stepSize: 1,
                    precision: 0,
                    color: '#6b7280',
                },
                grid: {
                    color: 'rgba(107, 114, 128, 0.2)'
                }
            }
        }
    }
});
</script>


<?php
$content = ob_get_clean();

// Memanggil layout utama
require_once 'Layout.php';
?>