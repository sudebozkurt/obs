<?php
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "obs";

try {
  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $student_id = $_POST["student_id"];

    $sql_remove_exams = "DELETE FROM t_exam WHERE student_id = :student_id";
    $stmt_remove_exams = $conn->prepare($sql_remove_exams);
    $stmt_remove_exams->bindParam(":student_id", $student_id, PDO::PARAM_INT);
    $stmt_remove_exams->execute();

    $sql_remove_class = "DELETE FROM t_classes_student WHERE student_id = :student_id";
    $stmt_remove_class = $conn->prepare($sql_remove_class);
    $stmt_remove_class->bindParam(":student_id", $student_id, PDO::PARAM_INT);
    $stmt_remove_class->execute();

    $sql_remove_student = "DELETE FROM t_user WHERE id = :student_id";
    $stmt_remove_student = $conn->prepare($sql_remove_student);
    $stmt_remove_student->bindParam(":student_id", $student_id, PDO::PARAM_INT);

    if ($stmt_remove_student->execute()) {
      header("Location: ogrenciler.php");
      exit();
    } else {
      echo "Öğrenci silinirken bir hata oluştu.";
    }
  }
} catch (PDOException $e) {
  echo "Hata: " . $e->getMessage();
}

$conn = null;
?>
