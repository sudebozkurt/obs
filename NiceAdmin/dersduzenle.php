<?php
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "obs";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $lessonId = $_POST['lessonId'];
    $lessonName = $_POST['lessonName'];
    $teacherId = $_POST['teacherId'];

    $sql = "UPDATE t_lesson SET lesson_name = :lessonName, teacher_user_id = :teacherId WHERE id = :lessonId";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':lessonName', $lessonName);
    $stmt->bindParam(':teacherId', $teacherId);
    $stmt->bindParam(':lessonId', $lessonId);
    $stmt->execute();

    echo "Ders başarıyla güncellendi.";

} catch (PDOException $e) {
    echo "Hata: " . $e->getMessage();
}

$conn = null;
?>
