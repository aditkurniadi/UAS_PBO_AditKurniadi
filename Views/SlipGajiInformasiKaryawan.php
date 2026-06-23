<?php
$title = "Slip Gaji Karyawan";

require_once __DIR__ . '/../Database/Koneksi.php';
require_once __DIR__ . '/../Service/KaryawanTetap.php';
require_once __DIR__ . '/../Service/KaryawanMagang.php';
require_once __DIR__ . '/../Service/KaryawanKontrak.php';

$db = new Database();

$id_karyawan = $_GET['id'] ?? null;
$karyawan_data = null;
$karyawan_obj = null;
$error_message = null;
$gaji_bersih = 0;

if ($id_karyawan) {
    // Tanpa function di service, kita query langsung dari Views
    $sql = "SELECT * FROM tabel_karyawan WHERE id_karyawan = '" . $db->koneksi->real_escape_string($id_karyawan) . "'";
    $result = $db->koneksi->query($sql);

    if ($result && $result->num_rows > 0) {
        $karyawan_data = $result->fetch_assoc();

        // Membuat objek berdasarkan jenis_karyawan untuk mendapatkan gaji bersih
        if ($karyawan_data['jenis_karyawan'] === 'Tetap') {
            $karyawan_obj = new KaryawanTetap(
                $karyawan_data['id_karyawan'],
                $karyawan_data['nama_karyawan'],
                $karyawan_data['departemen'],
                $karyawan_data['hari_kerja_masuk'],
                $karyawan_data['gaji_dasar_per_hari'],
                $karyawan_data['jenis_karyawan'],
                $karyawan_data['tunjangan_kesehatan'] ?? 0,
                $karyawan_data['opsi_saham_id'] ?? ''
            );
            $gaji_bersih = $karyawan_obj->hitungGajiBersih();
        } elseif ($karyawan_data['jenis_karyawan'] === 'Magang') {
            $karyawan_obj = new KaryawanMagang(
                $karyawan_data['id_karyawan'],
                $karyawan_data['nama_karyawan'],
                $karyawan_data['departemen'],
                $karyawan_data['hari_kerja_masuk'],
                $karyawan_data['gaji_dasar_per_hari'],
                $karyawan_data['jenis_karyawan'],
                $karyawan_data['uang_saku_bulanan'] ?? 0,
                $karyawan_data['sertifikat_kampus_merdeka'] ?? ''
            );
            $gaji_bersih = $karyawan_obj->hitungGajiBersih();
        } elseif ($karyawan_data['jenis_karyawan'] === 'Kontrak') {
            $karyawan_obj = new KaryawanKontrak(
                $karyawan_data['id_karyawan'],
                $karyawan_data['nama_karyawan'],
                $karyawan_data['departemen'],
                $karyawan_data['hari_kerja_masuk'],
                $karyawan_data['gaji_dasar_per_hari'],
                $karyawan_data['jenis_karyawan'],
                $karyawan_data['durasi_kontrak_bulan'] ?? 0,
                $karyawan_data['agensi_penyalur'] ?? ''
            );
            $gaji_bersih = $karyawan_obj->hitungGajiBersih();
        }
    } else {
        $error_message = "Data karyawan tidak ditemukan.";
    }
}

// Ambil semua data untuk dropdown pilihan karyawan
$sql_all = "SELECT id_karyawan, nama_karyawan FROM tabel_karyawan ORDER BY nama_karyawan ASC";
$result_all = $db->koneksi->query($sql_all);
$list_karyawan = [];
if ($result_all) {
    while ($row = $result_all->fetch_assoc()) {
        $list_karyawan[] = $row;
    }
}

ob_start();
?>

<div class="px-4 sm:px-6 lg:px-8 mt-4">
    <div class="sm:flex sm:items-center mb-8">
        <div class="sm:flex-auto">
            <h1 class="text-base font-semibold text-gray-900 dark:text-white">Slip Gaji Karyawan</h1>
            <p class="mt-2 text-sm text-gray-700 dark:text-gray-300">Pilih karyawan untuk melihat slip gajinya secara
                detail.</p>
        </div>
    </div>

    <!-- Form Pemilihan Karyawan -->
    <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 mb-8">
        <form method="GET" action="SlipGajiInformasiKaryawan.php" class="flex flex-col sm:flex-row gap-4 items-end">
            <div class="w-full sm:w-1/2">
                <label for="id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Pilih
                    Karyawan</label>
                <select id="id" name="id"
                    class="mt-1 block w-full rounded-md border-gray-300 py-2 pl-3 pr-10 text-base focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                    required>
                    <option value="" disabled <?php echo !$id_karyawan ? 'selected' : ''; ?>>-- Pilih Karyawan --
                    </option>
                    <?php foreach ($list_karyawan as $karyawan) : ?>
                    <option value="<?php echo htmlspecialchars($karyawan['id_karyawan']); ?>"
                        <?php echo ($id_karyawan == $karyawan['id_karyawan']) ? 'selected' : ''; ?>>
                        <?php echo htmlspecialchars($karyawan['nama_karyawan']) . ' (' . htmlspecialchars($karyawan['id_karyawan']) . ')'; ?>
                    </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <button type="submit"
                class="inline-flex items-center justify-center rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 w-full sm:w-auto">
                Tampilkan Slip Gaji
            </button>
        </form>
    </div>

    <?php if ($error_message) : ?>
    <div class="rounded-md bg-red-50 p-4 mb-8">
        <div class="flex">
            <div class="ml-3">
                <h3 class="text-sm font-medium text-red-800"><?php echo $error_message; ?></h3>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <?php if ($karyawan_data && $karyawan_obj) : ?>
    <!-- Tampilan Slip Gaji -->
    <div
        class="max-w-2xl mx-auto bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-700 rounded-lg shadow p-8 mb-10">
        <!-- Header Slip -->
        <div
            class="border-b border-gray-300 dark:border-gray-700 pb-4 mb-6 flex flex-col sm:flex-row justify-between items-start sm:items-center">
            <div>
                <h2 class="text-2xl font-bold text-gray-900 dark:text-white uppercase">PT. Teknologi</h2>
                <p class="text-sm text-gray-500 dark:text-gray-400">Jl. Teknologi No. 1, Jakarta Selatan</p>
            </div>
            <div class="mt-4 sm:mt-0 text-left sm:text-right">
                <h1 class="text-xl font-bold text-indigo-600 dark:text-indigo-400 uppercase tracking-wider">Slip Gaji
                </h1>
                <p class="text-sm font-semibold text-gray-600 dark:text-gray-300">Periode: <?php echo date('F Y'); ?>
                </p>
            </div>
        </div>

        <!-- Data Diri Karyawan -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-8 text-sm">
            <div>
                <p class="text-gray-500 dark:text-gray-400">ID Karyawan</p>
                <p class="font-semibold text-gray-900 dark:text-white">
                    <?php echo htmlspecialchars($karyawan_data['id_karyawan']); ?></p>
            </div>
            <div>
                <p class="text-gray-500 dark:text-gray-400">Nama Lengkap</p>
                <p class="font-semibold text-gray-900 dark:text-white">
                    <?php echo htmlspecialchars($karyawan_data['nama_karyawan']); ?></p>
            </div>
            <div>
                <p class="text-gray-500 dark:text-gray-400">Departemen</p>
                <p class="font-semibold text-gray-900 dark:text-white">
                    <?php echo htmlspecialchars($karyawan_data['departemen']); ?></p>
            </div>
            <div>
                <p class="text-gray-500 dark:text-gray-400">Status Karyawan</p>
                <p class="font-semibold text-gray-900 dark:text-white">
                    <?php echo htmlspecialchars($karyawan_data['jenis_karyawan']); ?></p>
            </div>
        </div>

        <!-- Rincian Gaji -->
        <div class="mb-8">
            <h3
                class="text-md font-bold text-gray-900 dark:text-white border-b border-gray-200 dark:border-gray-700 pb-2 mb-4">
                Rincian Pendapatan</h3>
            <div class="space-y-3 text-sm">
                <div class="flex justify-between items-center">
                    <p class="text-gray-600 dark:text-gray-300">Gaji Dasar Per Hari (Rp
                        <?php echo number_format($karyawan_data['gaji_dasar_per_hari'], 0, ',', '.'); ?>)</p>
                    <p class="font-medium text-gray-900 dark:text-white">Rp
                        <?php echo number_format($karyawan_data['gaji_dasar_per_hari'] * $karyawan_data['hari_kerja_masuk'], 0, ',', '.'); ?>
                    </p>
                </div>
                <div class="flex justify-between items-center">
                    <p class="text-gray-600 dark:text-gray-300">Jumlah Kehadiran</p>
                    <p class="font-medium text-gray-900 dark:text-white">
                        <?php echo $karyawan_data['hari_kerja_masuk']; ?> Hari</p>
                </div>

                <!-- Pendapatan Tambahan Berdasarkan Jenis Karyawan -->
                <?php if ($karyawan_data['jenis_karyawan'] === 'Tetap' && !empty($karyawan_data['tunjangan_kesehatan'])) : ?>
                <div class="flex justify-between items-center">
                    <p class="text-gray-600 dark:text-gray-300">Tunjangan Kesehatan</p>
                    <p class="font-medium text-gray-900 dark:text-white">Rp
                        <?php echo number_format($karyawan_data['tunjangan_kesehatan'], 0, ',', '.'); ?></p>
                </div>
                <?php endif; ?>

                <?php if ($karyawan_data['jenis_karyawan'] === 'Magang' && !empty($karyawan_data['uang_saku_bulanan'])) : ?>
                <div class="flex justify-between items-center">
                    <p class="text-gray-600 dark:text-gray-300">Uang Saku Bulanan</p>
                    <p class="font-medium text-gray-900 dark:text-white">Rp
                        <?php echo number_format($karyawan_data['uang_saku_bulanan'], 0, ',', '.'); ?></p>
                </div>
                <?php endif; ?>
            </div>
        </div>

        <!-- Total Pendapatan / Gaji Bersih -->
        <div class="border-t-2 border-indigo-500 pt-4 mt-6">
            <div class="flex justify-between items-center">
                <h3 class="text-lg font-bold text-gray-900 dark:text-white">Total Take Home Pay</h3>
                <h3 class="text-xl font-bold text-indigo-600 dark:text-indigo-400">Rp
                    <?php echo number_format($gaji_bersih, 0, ',', '.'); ?></h3>
            </div>
        </div>

        <div class="mt-10 pt-6 border-t border-gray-200 dark:border-gray-700 text-center">
            <p class="text-xs text-gray-500 dark:text-gray-400 italic">Dokumen ini adalah slip gaji sah yang diterbitkan
                secara elektronik dan tidak memerlukan tanda tangan fisik.</p>
        </div>

        <div class="mt-6 flex justify-end">
            <button onclick="window.print()"
                class="inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 dark:hover:bg-gray-700">
                <svg class="-ml-1 mr-2 h-5 w-5 text-gray-500 dark:text-gray-400" viewBox="0 0 20 20"
                    fill="currentColor">
                    <path fill-rule="evenodd"
                        d="M5 4v3H4a2 2 0 00-2 2v3a2 2 0 002 2h1v2a2 2 0 002 2h6a2 2 0 002-2v-2h1a2 2 0 002-2V9a2 2 0 00-2-2h-1V4a2 2 0 00-2-2H7a2 2 0 00-2 2zm8 0H7v3h6V4zm0 8H7v4h6v-4z"
                        clip-rule="evenodd" />
                </svg>
                Cetak / Simpan PDF
            </button>
        </div>
    </div>
    <?php endif; ?>
</div>

<!-- Menyembunyikan elemen lain saat nge-print -->
<style>
@media print {
    body * {
        visibility: hidden;
    }

    .max-w-2xl,
    .max-w-2xl * {
        visibility: visible;
    }

    .max-w-2xl {
        position: absolute;
        left: 0;
        top: 0;
        width: 100%;
        box-shadow: none;
        border: none;
        margin: 0;
        padding: 0;
    }

    button {
        display: none !important;
    }
}
</style>

<?php
$content = ob_get_clean();

// Memanggil layout utama
require_once __DIR__ . '/Layout.php';
?>