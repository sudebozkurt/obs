<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $isim = $_POST['isim'];
  $soyisim = $_POST['soyisim'];
  $kullaniciAdi = $_POST['kullaniciAdi'];
  $sifre = $_POST['sifre'];
  $rol = 'teacher';

  $hashedPassword = password_hash($sifre, PASSWORD_ARGON2ID);

  $servername = "localhost";
  $username = "root";
  $password = "root";
  $dbname = "obs";

  try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $sql = "INSERT INTO t_user (name, surname, username, password, role) VALUES (:isim, :soyisim, :kullaniciAdi, :sifre, :rol)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':isim', $isim, PDO::PARAM_STR);
    $stmt->bindParam(':soyisim', $soyisim, PDO::PARAM_STR);
    $stmt->bindParam(':kullaniciAdi', $kullaniciAdi, PDO::PARAM_STR);
    $stmt->bindParam(':sifre', $hashedPassword, PDO::PARAM_STR);
    $stmt->bindParam(':rol', $rol, PDO::PARAM_STR);
    $stmt->execute();

    echo "Sorumlu başarıyla eklendi.";

  } catch (PDOException $e) {
    echo "Hata: " . $e->getMessage();
  }

  $conn = null;
}
?>
