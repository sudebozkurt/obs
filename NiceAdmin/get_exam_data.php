<?php
$dbname = "obs";
$host = "localhost";
$username = "root";
$password = "root";

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['exam_id'])) {
  try {
    $db = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $examId = $_GET['exam_id'];

    $query = "SELECT id as exam_id, class_id, student_id, lesson_id, exam_score FROM t_exam WHERE id = :exam_id";
    $stmt = $db->prepare($query);
    $stmt->bindParam(':exam_id', $examId);

    if ($stmt->execute()) {
      $examData = $stmt->fetch(PDO::FETCH_ASSOC);

      header('Content-Type: application/json');
      echo json_encode($examData);
    } else {
      echo "Sınav verileri alınamadı.";
    }
  } catch (PDOException $e) {
    echo "Veritabanına bağlanırken hata oluştu: " . $e->getMessage();
  }
} else {
  echo "Geçersiz istek.";
}
?>
