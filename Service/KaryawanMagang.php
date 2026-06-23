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
        echo "ID Karyawan: " . $this->id_karyawan . "<br>";
        echo "Nama Karyawan: " . $this->nama_karyawan . "<br>";
        echo "Departemen: " . $this->departemen . "<br>";
        echo "Hari Kerja Masuk: " . $this->hari_kerja_masuk . "<br>";
        echo "Gaji Dasar Per Hari: " . $this->gaji_dasar_per_hari . "<br>";
        echo "Jenis Karyawan: " . $this->jenis_karyawan . "<br>";
        echo "Uang Saku Bulanan: " . $this->uang_saku_bulanan . "<br>";
        echo "Sertifikat Kampus Merdeka: " . ($this->sertifikat_kampus_merdeka ? 'Ya' : 'Tidak') . "<br>";
    }
}