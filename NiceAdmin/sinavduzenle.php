<?php
$dbname = "obs";
$host = "localhost";
$username = "root";
$password = "root";

try {
  $db = new PDO("localhost:host=$host;dbname=$dbname", $username, $password);
  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  $examId = $_POST['exam_id'];
  $classId = $_POST['class_id'];
  $studentId = $_POST['student_id'];
  $lessonId = $_POST['lesson_id'];
  $examScore = $_POST['exam_score'];

  $updateQuery = "UPDATE t_exam SET class_id = :class_id, student_id = :student_id, lesson_id = :lesson_id, exam_score = :exam_score WHERE id = :exam_id";
  $updateStmt = $db->prepare($updateQuery);
  $updateStmt->bindParam(':class_id', $classId);
  $updateStmt->bindParam(':student_id', $studentId);
  $updateStmt->bindParam(':lesson_id', $lessonId);
  $updateStmt->bindParam(':exam_score', $examScore);
  $updateStmt->bindParam(':exam_id', $examId);

  if ($updateStmt->execute()) {
    echo "Sınav başarıyla güncellendi.";
  } else {
    echo "Sınav güncelleme işlemi sırasında bir hata oluştu.";
  }
} catch (PDOException $e) {
  echo "Veritabanına bağlanırken hata oluştu: " . $e->getMessage();
}
?>

