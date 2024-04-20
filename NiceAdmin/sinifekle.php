<?php
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "obs";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Bağlantı hatası: " . $e->getMessage();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $class_name = $_POST["className"];
    $teacher_id = $_POST["teacherId"];

    try {
        $insertClassQuery = "INSERT INTO t_class (class_name, class_teacher_id) VALUES (:class_name, :teacher_id)";
        $insertClassStatement = $conn->prepare($insertClassQuery);
        $insertClassStatement->bindParam(':class_name', $class_name);
        $insertClassStatement->bindParam(':teacher_id', $teacher_id);

        $insertClassStatement->execute();

        echo "Sınıf başarıyla eklenmiştir. İşlem başarılı!";
        header("Location: siniflar.php");
    } catch (PDOException $e) {
        echo "Sınıf eklerken bir hata oluştu: " . $e->getMessage();
    }
}
?>
