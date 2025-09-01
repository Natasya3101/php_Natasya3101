<?php
$koneksi = new mysqli("localhost", "root", "", "testdb");

if ($koneksi->connect_error) {
    die("Koneksi gagal: " . $koneksi->connect_error);
}
?>
