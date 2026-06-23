<?php

abstract class Karyawan {
    protected $id_karyawan;
    protected $nama_karyawan;
    protected $departemen;
    protected $hari_kerja_masuk;
    protected $gaji_dasar_per_hari;
    protected $jenis_karyawan;

    public function __construct($id_karyawan, $nama_karyawan, $departemen, $hari_kerja_masuk, $gaji_dasar_per_hari, $jenis_karyawan) {
        $this->id_karyawan = $id_karyawan;
        $this->nama_karyawan = $nama_karyawan;
        $this->departemen = $departemen;
        $this->hari_kerja_masuk = $hari_kerja_masuk;
        $this->gaji_dasar_per_hari = $gaji_dasar_per_hari;
        $this->jenis_karyawan = $jenis_karyawan;
    }

    public abstract function hitungGajiBersih();

    public abstract function tampilkanProfilKaryawan();

    // Function ini digunakan untuk mengambil semua data karyawan yang ada di database
    public static function getAllKaryawan($koneksi) {
        $query = "SELECT * FROM tabel_karyawan";
        $result = $koneksi->query($query);
        $karyawanList = [];

        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $karyawanList[] = $row;
            }
        }

        return $karyawanList;
    }
}