<?php
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "obs";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Veritabanı bağlantısında hata: " . $conn->connect_error);
}

$ad = $_POST["ad"];
$soyad = $_POST["soyad"];
$kullaniciadi = $_POST["kullaniciadi"];
$sifre = $_POST["sifre"];
$role = "student";

$sql = "INSERT INTO t_user (name, surname, username, password, role)
        VALUES ('$ad', '$soyad', '$kullaniciadi', '$sifre', '$role')";

if ($conn->query($sql) === TRUE) {
    header("Location: ogrenciler.php");
    exit;
} else {
    echo "Hata: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>