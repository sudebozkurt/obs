<?php
$student_id = $_GET['student_id'];
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
$sql = "SELECT t_user.name, t_user.surname, t_class.class_name
            FROM t_classes_student
            INNER JOIN t_user ON t_classes_student.student_id = t_user.id
            INNER JOIN t_class ON t_classes_student.class_id = t_class.id
            WHERE t_classes_student.student_id = :student_id";

$stmt = $conn->prepare($sql);
$stmt->bindParam(':student_id', $student_id, PDO::PARAM_INT);
$stmt->execute();
$studentInfo = $stmt->fetch(PDO::FETCH_ASSOC);

$sql = "SELECT t_exam.exam_date, t_exam.exam_score, t_lesson.lesson_name, t_class.class_name
        FROM t_exam
        INNER JOIN t_lesson ON t_exam.lesson_id = t_lesson.id
        INNER JOIN t_class ON t_exam.class_id = t_class.id
        WHERE t_exam.student_id = :student_id";

$stmt = $conn->prepare($sql);
$stmt->bindParam(':student_id', $student_id, PDO::PARAM_INT);
$stmt->execute();
$examResults = $stmt->fetchAll(PDO::FETCH_ASSOC);

$sqlClassAverage = "SELECT AVG(exam_score) AS class_average
                   FROM t_exam
                   WHERE class_id = (SELECT class_id FROM t_classes_student WHERE student_id = :student_id)";


$stmtClassAverage = $conn->prepare($sqlClassAverage);
$stmtClassAverage->bindParam(':student_id', $student_id, PDO::PARAM_INT);
$stmtClassAverage->execute();
$classAverageResult = $stmtClassAverage->fetch(PDO::FETCH_ASSOC);
$classAverage = $classAverageResult['class_average'];

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
      <a href="admin.php" class="logo d-flex align-items-center">
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
            <span class="d-none d-md-block dropdown-toggle ps-2">Admin</span>
          </a><!-- End Profile Iamge Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <li class="dropdown-header">
              <h6>Admin</h6>
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
        <a class="nav-link " href="admin.php">
          <i class="bi bi-grid"></i>
          <span>Ana Sayfa</span>
        </a>
      </li><!-- End Dashboard Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-menu-button-wide"></i><span>Öğrenciler</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="ogrenciler.php">
              <i class="bi bi-circle"></i><span>Öğrenciler</span>
            </a>
          </li>
        </ul>
      </li><!-- End Öğrenciler Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-journal-text"></i><span>Sorumlular</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="forms-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="sorumlular.php">
              <i class="bi bi-circle"></i><span>Sorumlular</span>
            </a>
        </ul>
      </li><!-- End Sorumlular Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#tables-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-layout-text-window-reverse"></i><span>Dersler</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="tables-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="dersler.php">
              <i class="bi bi-circle"></i><span>Dersler</span>
            </a>
          </li>
        </ul>
      </li><!-- End Dersler Nav -->

      <li class="nav-item">
          <a class="nav-link collapsed" data-bs-target="#dersler-nav" data-bs-toggle="collapse" href="#">
              <i class="bi bi-list-ul"></i><span>Sınıflar</span><i class="bi bi-chevron-down ms-auto"></i>
          </a>
          <ul id="dersler-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
            <li>
              <a href="siniflar.php">
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
            <a href="profil.php">
              <i class="bi bi-circle"></i><span>Profilim</span>
            </a>
          </li>
        </ul>
      </li><!-- End Icons Nav -->
    </ul>

  </aside><!-- End Sidebar-->

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Bilgiler</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="ogrenciler.php">Öğrenciler</a></li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
        
        <div class="student-info">
            <h2>Öğrenci Adı: <?php echo $studentInfo['name']." ".$studentInfo['surname']; ?> </h2>
            <h2>Sınıf: <?php echo $studentInfo['class_name']?></h2>
        </div>

        <table class="exam-history">
          <thead>
              <tr>
                  <th>Sınav Tarihi</th>
                  <th>Sınav Puanı</th>
                  <th>Sınav Adı</th>
                  <th>Sınıf Ortalaması</th>
              </tr>
          </thead>
          <tbody>
          <?php foreach ($examResults as $result) { ?>
              <tr>
                  <td><?php echo $result['exam_date']; ?></td>
                  <td><?php echo $result['exam_score']; ?></td>
                  <td><?php echo $result['lesson_name']; ?></td>
                  <td><?php echo $classAverage; ?></td>
              </tr>
          <?php } ?>
          </tbody>
</table>


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
    .exam-history {
  width: 100%;
  border-collapse: collapse;
  margin-top: 20px;
}

.exam-history th,
.exam-history td {
  border: 1px solid #dee2e6;
  padding: 8px;
  text-align: center;
}

.exam-history th {
  background-color: #f8f9fa;
}

.exam-history tbody tr:nth-child(even) {
  background-color: #f2f2f2;
}

.exam-history tbody tr:hover {
  background-color: #e2e6ea;
}


</style>

<?php 
$conn = null;
?>