<?php
$title = "Dashboard Manajemen Karyawan";

require_once '../Database/Koneksi.php';  

$db = new Database();

// Query untuk menampilkan jumlah total karyawan
$sql_total = "SELECT COUNT(*) AS total FROM tabel_karyawan";
$result_total = $db->koneksi->query($sql_total);
$total_karyawan = $result_total->fetch_assoc()['total'] ?? 0;

// Query untuk menampilkan karyawan tetap
$sql_tetap = "SELECT COUNT(*) AS total FROM tabel_karyawan WHERE jenis_karyawan = 'Tetap'";
$result_tetap = $db->koneksi->query($sql_tetap);
$total_tetap = $result_tetap->fetch_assoc()['total'] ?? 0;

// Query untuk menampilkan karyawan kontrak
$sql_kontrak = "SELECT COUNT(*) AS total FROM tabel_karyawan WHERE jenis_karyawan = 'Kontrak'";
$result_kontrak = $db->koneksi->query($sql_kontrak);
$total_kontrak = $result_kontrak->fetch_assoc()['total'] ?? 0;

// Query untuk menampilkan karyawan magang
$sql_magang = "SELECT COUNT(*) AS total FROM tabel_karyawan WHERE jenis_karyawan = 'Magang'";
$result_magang = $db->koneksi->query($sql_magang);
$total_magang = $result_magang->fetch_assoc()['total'] ?? 0;

// Query untuk menampilkan data chart (Karyawan per departemen)
$sql_dept = "SELECT departemen, COUNT(*) AS jumlah FROM tabel_karyawan GROUP BY departemen";
$result_dept = $db->koneksi->query($sql_dept);
$labels_dept = [];
$totals_dept = [];
if ($result_dept) {
    while ($row = $result_dept->fetch_assoc()) {
        $labels_dept[] = $row['departemen'];
        $totals_dept[] = $row['jumlah'];
    }
}

ob_start();
?>

<div class="mb-8">
    <h1 class="text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Selamat Datang, Adit Kurniadi</h1>
    <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">Berikut adalah ringkasan data pada Sistem Informasi
        Manajemen Karyawan saat ini.</p>
</div>

<div class="bg-white dark:bg-gray-900 overflow-hidden rounded-xl border border-gray-200 dark:border-gray-800 shadow-sm">
    <div class="mx-auto max-w-7xl">
        <div class="grid grid-cols-1 gap-px bg-gray-200 dark:bg-gray-800 sm:grid-cols-2 lg:grid-cols-4">

            <div class="bg-white px-4 py-6 sm:px-6 lg:px-8 dark:bg-gray-900">
                <p class="text-sm/6 font-medium text-gray-500 dark:text-gray-400">Total Karyawan</p>
                <p class="mt-2 flex items-baseline gap-x-2">
                    <span
                        class="text-4xl font-semibold tracking-tight text-gray-900 dark:text-white"><?php echo $total_karyawan; ?></span>
                </p>
            </div>
            <div class="bg-white px-4 py-6 sm:px-6 lg:px-8 dark:bg-gray-900">
                <p class="text-sm/6 font-medium text-gray-500 dark:text-gray-400">Karyawan Tetap</p>
                <p class="mt-2 flex items-baseline gap-x-2">
                    <span
                        class="text-4xl font-semibold tracking-tight text-gray-900 dark:text-white"><?php echo $total_tetap; ?></span>
                </p>
            </div>
            <div class="bg-white px-4 py-6 sm:px-6 lg:px-8 dark:bg-gray-900">
                <p class="text-sm/6 font-medium text-gray-500 dark:text-gray-400">Karyawan Kontrak</p>
                <p class="mt-2 flex items-baseline gap-x-2">
                    <span
                        class="text-4xl font-semibold tracking-tight text-gray-900 dark:text-white"><?php echo $total_kontrak; ?></span>
                </p>
            </div>
            <div class="bg-white px-4 py-6 sm:px-6 lg:px-8 dark:bg-gray-900">
                <p class="text-sm/6 font-medium text-gray-500 dark:text-gray-400">Karyawan Magang</p>
                <p class="mt-2 flex items-baseline gap-x-2">
                    <span
                        class="text-4xl font-semibold tracking-tight text-gray-900 dark:text-white"><?php echo $total_magang; ?></span>
                </p>
            </div>

        </div>
    </div>
</div>

<div class="bg-white dark:bg-gray-900 rounded-xl border border-gray-200 dark:border-gray-800 shadow-sm p-6 mt-8">
    <div class="mb-4">
        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Distribusi Karyawan per Departemen</h3>
        <p class="text-sm text-gray-500 dark:text-gray-400">Grafik yang menampilkan jumlah karyawan berdasarkan
            departemen.</p>
    </div>

    <div class="relative w-full h-80">
        <canvas id="chartDepartemen"></canvas>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
const ctx = document.getElementById('chartDepartemen').getContext('2d');

const labelDept = <?php echo json_encode($labels_dept); ?>;
const dataJumlah = <?php echo json_encode($totals_dept); ?>;

new Chart(ctx, {
    type: 'bar',
    data: {
        labels: labelDept,
        datasets: [{
            label: 'Jumlah Karyawan',
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
                    text: 'Departemen',
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
                    }
                },
                ticks: {
                    color: '#6b7280',
                },
                grid: {
                    display: false
                }
            },
            y: {
                title: {
                    display: true,
                    text: 'Banyaknya Karyawan',
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