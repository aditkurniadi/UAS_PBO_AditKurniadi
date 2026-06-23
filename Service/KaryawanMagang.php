<?php

require_once 'Karyawan.php';
require_once '../Database/Koneksi.php';

class KaryawanMagang extends Karyawan {
    public $uang_saku_bulanan;
    public $sertifikat_kampus_merdeka;

    public function __construct($id_karyawan, $nama_karyawan, $departemen, $hari_kerja_masuk, $gaji_dasar_per_hari, $jenis_karyawan, $uang_saku_bulanan, $sertifikat_kampus_merdeka) {
        parent::__construct($id_karyawan, $nama_karyawan, $departemen, $hari_kerja_masuk, $gaji_dasar_per_hari, $jenis_karyawan);
        $this->uang_saku_bulanan = $uang_saku_bulanan;
        $this->sertifikat_kampus_merdeka = $sertifikat_kampus_merdeka;
    }

    public function hitungGajiBersih() {
        return ($this->hari_kerja_masuk * $this->gaji_dasar_per_hari) * 0.80;
    }

    public function tampilkanProfilKaryawan() {
        return [
            'id_karyawan' => $this->id_karyawan,
            'nama_karyawan' => $this->nama_karyawan,
            'departemen' => $this->departemen,
            'hari_kerja_masuk' => $this->hari_kerja_masuk,
            'gaji_dasar_per_hari' => $this->gaji_dasar_per_hari,
            'jenis_karyawan' => $this->jenis_karyawan,
            'uang_saku_bulanan' => $this->uang_saku_bulanan,
            'sertifikat_kampus_merdeka' => $this->sertifikat_kampus_merdeka,
        ];
    }

    public static function getAllKaryawanMagang($koneksi) {
        $sql = "SELECT * FROM tabel_karyawan WHERE jenis_karyawan = 'Magang'";
        $hasil = $koneksi->query($sql);

        if ($hasil && $hasil->num_rows > 0) {
            return $hasil->fetch_all(MYSQLI_ASSOC);
        }

        return [];
    }
}