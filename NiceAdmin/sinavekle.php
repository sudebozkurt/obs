<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $dbname = "obs";
  $host = "localhost";
  $username = "root";
  $password = "root";

  try {
    $db = new PDO("localhost:host=$host;dbname=$dbname", $username, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $classId = $_POST['class_id'];
    $studentId = $_POST['student_id'];
    $lessonId = $_POST['lesson_id'];
    $examScore = $_POST['exam_score'];

    $query = "INSERT INTO t_exam (class_id, student_id, lesson_id, exam_score) VALUES (:class_id, :student_id, :lesson_id, :exam_score)";
    $stmt = $db->prepare($query);
    $stmt->bindParam(':class_id', $classId);
    $stmt->bindParam(':student_id', $studentId);
    $stmt->bindParam(':lesson_id', $lessonId);
    $stmt->bindParam(':exam_score', $examScore);
    $stmt->execute();

    header("Location: ogretmendensinavlar.php");
    exit(); 
  } catch (PDOException $e) {
    echo "Veritabanına bağlanırken hata oluştu: " . $e->getMessage();
  }
}
?>
