<?php
$dbname = "obs";
$host = "localhost";
$username = "root";
$password = "root";

if (isset($_GET['exam_id'])) {
    try {
        $db = new PDO("localhost:host=$host;dbname=$dbname", $username, $password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $examId = $_GET['exam_id'];
        $deleteQuery = "DELETE FROM t_exam WHERE id = :exam_id";
        $deleteStmt = $db->prepare($deleteQuery);
        $deleteStmt->bindParam(':exam_id', $examId, PDO::PARAM_INT);
        $deleteStmt->execute();

        echo "Sınav başarıyla silindi.";
    } catch (PDOException $e) {
        echo "Sınavı silme işlemi başarısız oldu: " . $e->getMessage();
    }
} else {
    echo "Geçerli bir sınav kimliği sağlanmadı.";
}
?>
