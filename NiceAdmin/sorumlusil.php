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

if (isset($_GET['id'])) {
    $teacherId = $_GET['id'];

    try {
        $pdo->beginTransaction();

        $queryDeleteExams = "DELETE FROM t_exam WHERE class_id IN (SELECT id FROM t_class WHERE class_teacher_id = :teacherId)";
        $stmtDeleteExams = $pdo->prepare($queryDeleteExams);
        $stmtDeleteExams->bindParam(':teacherId', $teacherId, PDO::PARAM_INT);
        $stmtDeleteExams->execute();

        $queryDeleteFromLesson = "DELETE FROM t_lesson WHERE teacher_user_id = :teacherId";
        $stmtDeleteFromLesson = $pdo->prepare($queryDeleteFromLesson);
        $stmtDeleteFromLesson->bindParam(':teacherId', $teacherId, PDO::PARAM_INT);
        $stmtDeleteFromLesson->execute();

        $queryDeleteFromClass = "DELETE FROM t_class WHERE class_teacher_id = :teacherId";
        $stmtDeleteFromClass = $pdo->prepare($queryDeleteFromClass);
        $stmtDeleteFromClass->bindParam(':teacherId', $teacherId, PDO::PARAM_INT);
        $stmtDeleteFromClass->execute();

         $queryDeleteUser = "DELETE FROM t_user WHERE id = :teacherId";
         $stmtDeleteUser = $pdo->prepare($queryDeleteUser);
         $stmtDeleteUser->bindParam(':teacherId', $teacherId, PDO::PARAM_INT);
         $stmtDeleteUser->execute();

        $pdo->commit();

        header("Location: sorumlular.php");
        exit();
    } catch (PDOException $e) {
        $pdo->rollBack();
        die("Silme hatası: " . $e->getMessage());
    }
} else {
    echo "Geçersiz istek.";
}
?>
