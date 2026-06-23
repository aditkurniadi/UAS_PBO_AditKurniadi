<?php

require_once 'Karyawan.php';
require_once '../Database/Koneksi.php';

class KaryawanKontrak extends Karyawan {
    public $durasi_kontrak_bulan;
    public $agensi_penyalur;

    public function __construct($id_karyawan, $nama_karyawan, $departemen, $hari_kerja_masuk, $gaji_dasar_per_hari, $jenis_karyawan, $durasi_kontrak_bulan, $agensi_penyalur) {
        parent::__construct($id_karyawan, $nama_karyawan, $departemen, $hari_kerja_masuk, $gaji_dasar_per_hari, $jenis_karyawan);
        $this->durasi_kontrak_bulan = $durasi_kontrak_bulan;
        $this->agensi_penyalur = $agensi_penyalur;
    }

    public function hitungGajiBersih() {
        return $this->hari_kerja_masuk * this->gaji_dasar_per_hari;
    }

    public function tampilkanProfilKaryawan() {
        echo "ID Karyawan: " . $this->id_karyawan . "<br>";
        echo "Nama Karyawan: " . $this->nama_karyawan . "<br>";
        echo "Departemen: " . $this->departemen . "<br>";
        echo "Hari Kerja Masuk: " . $this->hari_kerja_masuk . "<br>";
        echo "Gaji Dasar Per Hari: " . $this->gaji_dasar_per_hari . "<br>";
        echo "Jenis Karyawan: " . $this->jenis_karyawan . "<br>";
        echo "Durasi Kontrak (Bulan): " . $this->durasi_kontrak_bulan . "<br>";
        echo "Agensi Penyalur: " . $this->agensi_penyalur . "<br>";
    }
}