<?php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "toko_roti"; // Diubah agar sesuai dengan DB Toko Roti

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die(json_encode(["status" => "error", "message" => "Koneksi gagal: " . $conn->connect_error]));
}
?>