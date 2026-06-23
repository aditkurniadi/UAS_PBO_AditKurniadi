<?php
class Database {
    private $host = "localhost";
    private $username = "root";
    private $password = "";
    private $dbname = "db_uas_pbo_trpl1b_aditkurniadi";
    public $koneksi;
    
    public function __construct() {
        $this->koneksi = mysqli_connect($this->host, $this->username, $this->password, $this->dbname);
        
        if (!$this->koneksi) {
            echo ("Koneksi gagal: " . $this->koneksi->connect_error);
        } else {
            // echo "Koneksi berhasil";
        }
    }

}

$db = new Database();