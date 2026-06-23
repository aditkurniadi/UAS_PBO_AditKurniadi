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
}