<?php

$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "obs";
try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Hata: " . $e->getMessage();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $lessonName = $_POST['lessonName'];
    $teacherId = $_POST['teacherId'];

    $insertLessonQuery = "INSERT INTO t_lesson (lesson_name, teacher_user_id) VALUES (:lessonName, :teacherId)";
    $insertLessonStatement = $conn->prepare($insertLessonQuery);
    $insertLessonStatement->bindParam(':lessonName', $lessonName, PDO::PARAM_STR);
    $insertLessonStatement->bindParam(':teacherId', $teacherId, PDO::PARAM_INT);

    if ($insertLessonStatement->execute()) {
        header("Location: dersler.php");
    } else {
        echo "Ders ekleme sırasında bir hata oluştu";
        
    }
}
?>