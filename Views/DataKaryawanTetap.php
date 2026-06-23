<?php
$title = "Manajemen Data Karyawan";

require_once __DIR__ . '/../Database/Koneksi.php';
require_once __DIR__ . '/../Service/KaryawanTetap.php';

$data_karyawan = KaryawanTetap::getAllKaryawanTetap($db->koneksi);

ob_start();
?>

<div class="px-4 sm:px-6 lg:px-8 mt-4">
    <div class="sm:flex sm:items-center">
        <div class="sm:flex-auto">
            <h1 class="text-base font-semibold text-gray-900 dark:text-white">Data Karyawan Tetap</h1>
            <p class="mt-2 text-sm text-gray-700 dark:text-gray-300">Daftar seluruh karyawan tetap yang terdaftar.</p>
        </div>
    </div>

    <div class="mt-8 flow-root">
        <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="inline-block min-w-full py-2 align-middle">
                <table class="min-w-full border-separate border-spacing-0">
                    <thead>
                        <tr>
                            <th scope="col"
                                class="sticky top-0 z-10 border-b border-gray-300 bg-white/75 py-3.5 pr-3 pl-4 text-left text-sm font-semibold text-gray-900 backdrop-blur-sm backdrop-filter sm:pl-6 lg:pl-8 dark:border-white/15 dark:bg-gray-900/75 dark:text-white">
                                ID Karyawan</th>
                            <th scope="col"
                                class="sticky top-0 z-10 border-b border-gray-300 bg-white/75 px-3 py-3.5 text-left text-sm font-semibold text-gray-900 backdrop-blur-sm backdrop-filter dark:border-white/15 dark:bg-gray-900/75 dark:text-white">
                                Nama Karyawan</th>
                            <th scope="col"
                                class="sticky top-0 z-10 border-b border-gray-300 bg-white/75 px-3 py-3.5 text-left text-sm font-semibold text-gray-900 backdrop-blur-sm backdrop-filter dark:border-white/15 dark:bg-gray-900/75 dark:text-white">
                                Departemen</th>
                            <th scope="col"
                                class="sticky top-0 z-10 border-b border-gray-300 bg-white/75 px-3 py-3.5 text-left text-sm font-semibold text-gray-900 backdrop-blur-sm backdrop-filter dark:border-white/15 dark:bg-gray-900/75 dark:text-white">
                                Hari Kerja Masuk</th>
                            <th scope="col"
                                class="sticky top-0 z-10 border-b border-gray-300 bg-white/75 px-3 py-3.5 text-left text-sm font-semibold text-gray-900 backdrop-blur-sm backdrop-filter dark:border-white/15 dark:bg-gray-900/75 dark:text-white">
                                Gaji Dasar Per Hari</th>
                            <th scope="col"
                                class="sticky top-0 z-10 border-b border-gray-300 bg-white/75 px-3 py-3.5 text-left text-sm font-semibold text-gray-900 backdrop-blur-sm backdrop-filter dark:border-white/15 dark:bg-gray-900/75 dark:text-white">
                                Gaji Bersih</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($data_karyawan)) : ?>
                        <?php 
                        $totalData = count($data_karyawan);
                        foreach ($data_karyawan as $index => $karyawan_item) : 
                            $isLast = ($index === $totalData - 1);
                            $borderClass = $isLast ? '' : 'border-b border-gray-200 dark:border-white/10';
                        ?>
                        <tr>
                            <td
                                class="<?= $borderClass ?> py-4 pr-3 pl-4 text-sm font-medium whitespace-nowrap text-gray-900 sm:pl-6 lg:pl-8 dark:text-white">
                                <?= htmlspecialchars($karyawan_item['id_karyawan']) ?>
                            </td>
                            <td
                                class="<?= $borderClass ?> px-3 py-4 text-sm whitespace-nowrap text-gray-500 dark:text-gray-400">
                                <?= htmlspecialchars($karyawan_item['nama_karyawan']) ?>
                            </td>
                            <td
                                class="<?= $borderClass ?> px-3 py-4 text-sm whitespace-nowrap text-gray-500 dark:text-gray-400">
                                <?= htmlspecialchars($karyawan_item['departemen']) ?>
                            </td>
                            <td
                                class="<?= $borderClass ?> px-3 py-4 text-sm whitespace-nowrap text-gray-500 dark:text-gray-400">
                                <?= htmlspecialchars($karyawan_item['hari_kerja_masuk']) ?>
                            </td>
                            <td
                                class="<?= $borderClass ?> px-3 py-4 text-sm whitespace-nowrap text-gray-500 dark:text-gray-400">
                                Rp <?= number_format($karyawan_item['gaji_dasar_per_hari'], 0, ',', '.') ?>
                            </td>
                            <td
                                class="<?= $borderClass ?> px-3 py-4 text-sm whitespace-nowrap text-gray-500 dark:text-gray-400">
                                <?php
                                $karyawan_obj = new KaryawanKontrak(
                                    $karyawan_item['id_karyawan'],
                                    $karyawan_item['nama_karyawan'],
                                    $karyawan_item['departemen'],
                                    $karyawan_item['hari_kerja_masuk'],
                                    $karyawan_item['gaji_dasar_per_hari'],
                                    $karyawan_item['jenis_karyawan'],
                                    $karyawan_item['durasi_kontrak_bulan'] ?? 0,
                                    $karyawan_item['agensi_penyalur'] ?? ''
                                );
                                ?>
                                Rp <?= number_format($karyawan_obj->hitungGajiBersih(), 0, ',', '.') ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                        <?php else : ?>
                        <tr>
                            <td colspan="6" class="py-8 text-center text-sm text-gray-500 dark:text-gray-400 italic">
                                Tidak ada data karyawan.
                            </td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


<?php
$content = ob_get_clean();

require_once __DIR__ . '/Layout.php';
?>