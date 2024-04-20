<?php
if (isset($_POST['classId'])) {
    try {
        $classId = $_POST['classId'];

        $servername = "localhost";
        $username = "root";
        $password = "root";
        $dbname = "obs";

        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $studentRemoveQuery = "DELETE FROM t_classes_student WHERE class_id = :classId";
        $studentRemoveStatement = $conn->prepare($studentRemoveQuery);
        $studentRemoveStatement->bindParam(':classId', $classId, PDO::PARAM_INT);
        $studentRemoveStatement->execute();

        $examRemoveQuery = "DELETE FROM t_exam WHERE class_id = :classId";
        $examRemoveStatement = $conn->prepare($examRemoveQuery);
        $examRemoveStatement->bindParam(':classId', $classId, PDO::PARAM_INT);
        $examRemoveStatement->execute();

        $classRemoveQuery = "DELETE FROM t_class WHERE id = :classId";
        $classRemoveStatement = $conn->prepare($classRemoveQuery);
        $classRemoveStatement->bindParam(':classId', $classId, PDO::PARAM_INT);
        $classRemoveStatement->execute();

        echo "Sınıf başarıyla silindi.";

    } catch (PDOException $e) {
        echo "Sınıf silinemedi: " . $e->getMessage();
    }
} else {
    echo "Geçersiz istek.";
}

$conn = null;
?>
