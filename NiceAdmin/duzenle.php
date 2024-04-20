<?php
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "obs";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $student_id = $_POST['student_id'];
      $isim = $_POST['isim'];
      $soyisim = $_POST['soyisim'];
      $yeniSifre = $_POST['yeniSifre'];
      $yeniSifreTekrar = $_POST['yeniSifreTekrar'];
  
      if ($yeniSifre == $yeniSifreTekrar) {
        $hashedPassword = password_hash($yeniSifre, PASSWORD_ARGON2ID);
  
        $sql = "UPDATE t_user SET name = :isim, surname = :soyisim, password = :hashedPassword WHERE id = :student_id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':isim', $isim, PDO::PARAM_STR);
        $stmt->bindParam(':soyisim', $soyisim, PDO::PARAM_STR);
        $stmt->bindParam(':hashedPassword', $hashedPassword, PDO::PARAM_STR);
        $stmt->bindParam(':student_id', $student_id, PDO::PARAM_INT);
  
        if ($stmt->execute()) {
            echo "Öğrenci bilgileri ve şifresi başarıyla güncellendi.";
        } else {
            echo "Hata: Öğrenci bilgileri ve şifresi güncellenirken bir sorun oluştu.";
        }
      } else {
        echo "Hata: Yeni şifreler uyuşmuyor.";
      }
    }

} catch (PDOException $e) {
    echo "Hata: " . $e->getMessage();
}
?>
