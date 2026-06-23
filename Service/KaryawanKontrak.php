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
}