<?php

require_once 'Karyawan.php';
require_once '../Database/Koneksi.php';

class KaryawanTetap extends Karyawan{
    public $tunjangan_kesehatan;
    public $opsi_saham_id;
    
    public function __construct($id_karyawan, $nama_karyawan, $departemen, $hari_kerja_masuk, $gaji_dasar_per_hari, $jenis_karyawan, $tunjangan_kesehatan, $opsi_saham_id) {
        parent::__construct($id_karyawan, $nama_karyawan, $departemen, $hari_kerja_masuk, $gaji_dasar_per_hari, $jenis_karyawan);
        $this->tunjangan_kesehatan = $tunjangan_kesehatan;
        $this->opsi_saham_id = $opsi_saham_id;
    }

    public function hitungGajiBersih() {
        return ($this->hari_kerja_masuk * $this->gaji_dasar_per_hari) + $this->tunjangan_kesehatan;
    }

    public function tampilkanProfilKaryawan() {
        echo "ID Karyawan: " . $this->id_karyawan . "<br>";
        echo "Nama Karyawan: " . $this->nama_karyawan . "<br>";
        echo "Departemen: " . $this->departemen . "<br>";
        echo "Hari Kerja Masuk: " . $this->hari_kerja_masuk . "<br>";
        echo "Gaji Dasar Per Hari: " . $this->gaji_dasar_per_hari . "<br>";
        echo "Jenis Karyawan: " . $this->jenis_karyawan . "<br>";
        echo "Tunjangan Kesehatan: " . $this->tunjangan_kesehatan . "<br>";
        echo "Opsi Saham ID: " . $this->opsi_saham_id . "<br>";
    }
}