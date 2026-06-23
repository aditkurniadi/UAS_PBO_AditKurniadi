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
}