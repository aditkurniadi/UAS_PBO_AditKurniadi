<?php

require_once 'Karyawan.php';

class KaryawanKontrak extends Karyawan{
    public $durasi_kontrak_bulan;
    public $agensi_penyalur;

    public function __construct($id_karyawan, $nama_karyawan, $departemen, $hari_kerja_masuk, $gaji_dasar_per_hari, $jenis_karyawan, $durasi_kontrak_bulan, $agensi_penyalur) {
        parent::__construct($id_karyawan, $nama_karyawan, $departemen, $hari_kerja_masuk, $gaji_dasar_per_hari, $jenis_karyawan);
        $this->durasi_kontrak_bulan = $durasi_kontrak_bulan;
        $this->agensi_penyalur = $agensi_penyalur;
    }

    public function hitungGajiBersih() {
        return $this->hari_kerja_masuk * $this->gaji_dasar_per_hari;
    }

    public function tampilkanProfilKaryawan() {
        return [
            'id_karyawan' => $this->id_karyawan,
            'nama_karyawan' => $this->nama_karyawan,
            'departemen' => $this->departemen,
            'hari_kerja_masuk' => $this->hari_kerja_masuk,
            'gaji_dasar_per_hari' => $this->gaji_dasar_per_hari,
            'jenis_karyawan' => $this->jenis_karyawan,
            'durasi_kontrak_bulan' => $this->durasi_kontrak_bulan,
            'agensi_penyalur' => $this->agensi_penyalur,
        ];
    }

    public static function getAllKaryawanKontrak($koneksi) {
        $sql = "SELECT * FROM tabel_karyawan WHERE jenis_karyawan = 'Kontrak'";
        $hasil = $koneksi->query($sql);

        if ($hasil && $hasil->num_rows > 0) {
            return $hasil->fetch_all(MYSQLI_ASSOC);
        }

        return [];
    }
}