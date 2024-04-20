<?php
$host = "localhost";
$dbname = "obs";
$username = "root";
$password = "root";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Veritabanına bağlantı hatası: " . $e->getMessage());
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $isim = $_POST['isim'];
    $soyisim = $_POST['soyisim'];
    $kullaniciAdi = $_POST['kullaniciAdi'];
    $yeniSifre = $_POST['yeniSifre'];

    $sql = "UPDATE t_user SET name = :isim, surname = :soyisim, username= :kullaniciAdi";
    if (!empty($yeniSifre)) {
        $sql .= ", password = :yeniSifre";
    }
    $sql .= " WHERE id = :id";

    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->bindParam(':isim', $isim);
    $stmt->bindParam(':soyisim', $soyisim);
    $stmt->bindParam(':kullaniciAdi', $kullaniciAdi);

    if (!empty($yeniSifre)) {
        $hashedPassword = password_hash($yeniSifre, PASSWORD_ARGON2ID);
        $stmt->bindParam(':yeniSifre', $hashedPassword);

    }

    if ($stmt->execute()) {
        echo 'Success';
    } else {
        echo 'Error';
    }
}
?>
