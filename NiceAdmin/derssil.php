<?php
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "obs";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$lessonId = $_POST['lessonId'];

$deleteQuery = "DELETE FROM t_lesson WHERE id = :lessonId";
$deleteStatement = $conn->prepare($deleteQuery);
$deleteStatement->bindParam(":lessonId", $lessonId, PDO::PARAM_INT);

if ($deleteStatement->execute()) {
    echo "Ders başarıyla silindi.";
} else {
    echo "Dersi silerken bir hata oluştu.";
}

} catch (PDOException $e) {
    echo "Hata: " . $e->getMessage();
}

$conn = null;
?>
