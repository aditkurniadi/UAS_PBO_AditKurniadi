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
        return [
            'id_karyawan' => $this->id_karyawan,
            'nama_karyawan' => $this->nama_karyawan,
            'departemen' => $this->departemen,
            'hari_kerja_masuk' => $this->hari_kerja_masuk,
            'gaji_dasar_per_hari' => $this->gaji_dasar_per_hari,
            'jenis_karyawan' => $this->jenis_karyawan,
            'tunjangan_kesehatan' => $this->tunjangan_kesehatan,
            'opsi_saham_id' => $this->opsi_saham_id,
        ];
    }

    public static function getAllKaryawanTetap($koneksi) {
        $sql = "SELECT * FROM tabel_karyawan WHERE jenis_karyawan = 'Tetap'";
        $hasil = $koneksi->query($sql);

        if ($hasil && $hasil->num_rows > 0) {
            return $hasil->fetch_all(MYSQLI_ASSOC);
        }

        return [];
    }
}