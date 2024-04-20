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
    if (isset($_POST["classId"]) && isset($_POST["className"]) && isset($_POST["teacherId"])) {
        $classId = $_POST["classId"];
        $className = $_POST["className"];
        $teacherId = $_POST["teacherId"];

        try {
            $updateQuery = "UPDATE t_class SET class_name = :class_name, class_teacher_id = :teacher_id WHERE id = :class_id";
            $stmt = $conn->prepare($updateQuery);
            $stmt->bindParam(":class_name", $className);
            $stmt->bindParam(":teacher_id", $teacherId);
            $stmt->bindParam(":class_id", $classId);

            if ($stmt->execute()) {
                echo "Sınıf başarıyla güncellendi.";
            } else {
                echo "Sınıf güncelleme hatası.";
            }
        } catch (PDOException $e) {
            echo "Sorgu hatası: " . $e->getMessage();
        }
    } else {
        echo "POST verileri eksik veya tanımlanmamış.";
    }
}
?>
