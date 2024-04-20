<?php
session_start();

$host = "localhost";
$dbname = "obs";
$username = "root";
$password = "root";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    if (isset($_POST['Username']) && isset($_POST['Password'])) {
        $username = $_POST['Username'];
        $password = $_POST['Password'];
        
        $stmt = $pdo->prepare("SELECT * FROM t_user WHERE username = :username");
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        
        $row = $stmt->fetch();

        $_SESSION['id'] = $row['id'];
        $_SESSION['role'] = $role;

        
        if ($row) {
            $hashedPassword = $row['password'];
            if (password_verify($password, $hashedPassword)) {
                $role = $row['role'];
                switch ($role) {
                    case 'admin':
                        header("Location: NiceAdmin/admin.php?id=" . $row['id']);
                        break;
                    case 'student':
                        header("Location: NiceAdmin/ogrencianasayfa.php?id=" . $row['id']);
                        break;
                    case 'teacher':
                        header("Location: NiceAdmin/ogretmenanasayfa.php?id=" . $row['id']);
                        break;
                    default:
                        echo "Tanımsız rol: " . $role;
                }
                
            } else {
                echo "Kullanıcı adı veya şifre yanlış.";
            }
        } else {
            echo "Kullanıcı bulunamadı.";
        }
    }
} catch (PDOException $e) {
    echo "Veritabanı hatası: " . $e->getMessage();
}
?>
