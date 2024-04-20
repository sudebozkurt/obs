<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $isim = $_POST['isim'];
  $soyisim = $_POST['soyisim'];
  $kullaniciAdi = $_POST['kullaniciAdi'];
  $sifre = $_POST['sifre'];
  $rol = 'student';
  $sinif = $_POST['sinif'];

  $options = [
    'memory_cost' => 1 << 14,
    'time_cost' => 4,
    'threads' => 2,
  ];

  $hashedPassword = password_hash($sifre, PASSWORD_ARGON2ID, $options);

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

    $ogrenciID = $conn->lastInsertId();

    $sqlSinifEkle = "INSERT INTO t_classes_student (student_id, class_id) VALUES (:ogrenciID, :sinif)";
    $stmtSinifEkle = $conn->prepare($sqlSinifEkle);
    $stmtSinifEkle->bindParam(':ogrenciID', $ogrenciID, PDO::PARAM_INT);
    $stmtSinifEkle->bindParam(':sinif', $sinif, PDO::PARAM_INT);
    $stmtSinifEkle->execute();

    echo "Öğrenci başarıyla eklendi.";

  } catch (PDOException $e) {
    echo "Hata: " . $e->getMessage();
  }

  $conn = null;
}
?>