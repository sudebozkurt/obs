<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "obs";

try {
  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit;
  }

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_SESSION['id'];
    $currentPassword = $_POST["current_password"];
    $newPassword = $_POST["new_password"];

    $selectQuery = "SELECT password FROM t_user WHERE id = :user_id";
    $stmt = $conn->prepare($selectQuery);
    $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $stmt->execute();
    $row = $stmt->fetch();
    $hashedPassword = $row["password"];

    if (password_verify($currentPassword, $hashedPassword)) {
      $newHashedPassword = password_hash($newPassword, PASSWORD_ARGON2ID);

      $updateQuery = "UPDATE t_user SET password = :newPassword WHERE id = :user_id";
      $stmt = $conn->prepare($updateQuery);
      $stmt->bindParam(':newPassword', $newHashedPassword, PDO::PARAM_STR);
      $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
      $stmt->execute();

      echo "Şifre başarıyla güncellendi.";
    } else {
      echo "Mevcut şifre yanlış.";
    }
  }
} catch (PDOException $e) {
  echo "Veritabanı hatası: " . $e->getMessage();
}

$conn = null;
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Siber Vatan Yetkinlik Merkezi Bilgi Sistemi</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: NiceAdmin
  * Updated: Sep 18 2023 with Bootstrap v5.3.2
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
      <a href="ogretmenanasayfa.php" class="logo d-flex align-items-center">
        <img src="assets/img/logo.jpg" alt="">
        <span class="d-none d-lg-block">Siber Vatan</span>
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->

    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">

        <li class="nav-item dropdown">

          <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
            <i class="bi bi-chat-left-text"></i>
            <span class="badge bg-success badge-number">3</span>
          </a><!-- End Messages Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow messages">
            <li class="dropdown-header">
              You have 3 new messages
              <a href="#"><span class="badge rounded-pill bg-primary p-2 ms-2">View all</span></a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li class="message-item">
              <a href="#">
                <img src="assets/img/messages-1.jpg" alt="" class="rounded-circle">
                <div>
                  <h4>Maria Hudson</h4>
                  <p>Velit asperiores et ducimus soluta repudiandae labore officia est ut...</p>
                  <p>4 hrs. ago</p>
                </div>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li class="message-item">
              <a href="#">
                <img src="assets/img/messages-2.jpg" alt="" class="rounded-circle">
                <div>
                  <h4>Anna Nelson</h4>
                  <p>Velit asperiores et ducimus soluta repudiandae labore officia est ut...</p>
                  <p>6 hrs. ago</p>
                </div>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li class="message-item">
              <a href="#">
                <img src="assets/img/messages-3.jpg" alt="" class="rounded-circle">
                <div>
                  <h4>David Muldon</h4>
                  <p>Velit asperiores et ducimus soluta repudiandae labore officia est ut...</p>
                  <p>8 hrs. ago</p>
                </div>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li class="dropdown-footer">
              <a href="#">Show all messages</a>
            </li>

          </ul><!-- End Messages Dropdown Items -->

        </li><!-- End Messages Nav -->

        <li class="nav-item dropdown pe-3">

          <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
            <img src="assets/img/profile.jpeg" alt="Profile" class="rounded-circle">
            <span class="d-none d-md-block dropdown-toggle ps-2">Student</span>
          </a><!-- End Profile Iamge Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <li class="dropdown-header">
              <h6>Student</h6>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="ayarlar.php">
                <i class="bi bi-gear"></i>
                <span>Ayarlar</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="../logout.php">
                <i class="bi bi-box-arrow-right"></i>
                <span>Çıkış Yap</span>
              </a>
            </li>

          </ul><!-- End Profile Dropdown Items -->
        </li><!-- End Profile Nav -->

      </ul>
    </nav><!-- End Icons Navigation -->

  </header><!-- End Header -->

  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link " href="ogrencianasayfa.php">
          <i class="bi bi-grid"></i>
          <span>Ana Sayfa</span>
        </a>
      </li><!-- End Dashboard Nav -->

      <li class="nav-item">
          <a class="nav-link collapsed" data-bs-target="#dersler-nav" data-bs-toggle="collapse" href="#">
              <i class="bi bi-list-ul"></i><span>Sınıflar</span><i class="bi bi-chevron-down ms-auto"></i>
          </a>
          <ul id="dersler-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
            <li>
              <a href="ogrencidensiniflar.php">
                <i class="fa fa-graduation-cap"></i><span>Sınıflar</span>
              </a>
            </li>

          </ul>
      </li> <!-- End Sınıflar Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#icons-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-gem"></i><span>Profil</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="icons-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="ogrencidenprofil.php">
              <i class="bi bi-circle"></i><span>Profilim</span>
            </a>
          </li>
        </ul>
      </li><!-- End Icons Nav -->
    </ul>

  </aside><!-- End Sidebar-->

  <main id="main" class="main">
  <div class="container">
    <div class="row">
      <div class="col-md-6 mx-auto">
        <div class="user-profile text-center">
          <img src="assets/img/profile.jpeg" alt="Profile" class="rounded-circle"> <br>
          <h4>Student</h4>
        </div>
        <form method="POST" action="">
          <div class="mb-3 row">
            <label for="current-password" class="col-md-4 col-form-label text-md-end">Mevcut Şifre:</label>
            <div class="col-md-6">
              <input type="password" id="current-password" name="current_password" class="form-control form-control-sm" required>
            </div>
          </div>

          <div class="mb-3 row">
            <label for="new-password" class="col-md-4 col-form-label text-md-end">Yeni Şifre:</label>
            <div class="col-md-6">
              <input type="password" id="new-password" name="new_password" class="form-control form-control-sm" required>
            </div>
          </div>

          <div class="text-center">
            <button type="submit" class="btn btn-primary">Şifreyi Değiştir</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</main>




    

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">
    <div class="copyright">
      &copy;Bu yazılım<strong><span> 14.10.2023 tarihinde Sude Bozkurt tarafından</span></strong> yazılmıştır.
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/chart.js/chart.umd.js"></script>
  <script src="assets/vendor/echarts/echarts.min.js"></script>
  <script src="assets/vendor/quill/quill.min.js"></script>
  <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>

<style>
  .custom-button {
  background-color: #ff6600;
  color: #fff;
  font-weight: bold;
}
.user-profile {
    text-align: center;
  }

.user-profile img {
  display: block;
  margin: 0 auto;
  width: 150px; 
  height: 150px; 
}

.form-label {
  width: 150px; 
  text-align: center;
  margin: center;
}

.form-control {
  max-width: 200px;
  margin: center;
}

</style>
