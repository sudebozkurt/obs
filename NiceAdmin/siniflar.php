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

$teachers = array();
try {
    $teachersQuery = "SELECT id, name, surname FROM t_user WHERE role = 'teacher'";
    $teachersStatement = $conn->query($teachersQuery);
    $teachers = $teachersStatement->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Öğretmen bilgilerini getirirken bir hata oluştu: " . $e->getMessage();
}
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
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/css/custom.css" rel="stylesheet">

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
          <li class="breadcrumb-item"><a href="siniflar.php">Sınıflar</a></li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addClassModal">Sınıf Ekle</button>

<div class="modal fade" id="addClassModal" tabindex="-1" aria-labelledby="addClassModalLabel" aria-hidden="true">
  <div class="modal-dialog">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="addClassModalLabel">Sınıf Ekle</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
          <form action="sinifekle.php" method="post">
                <div class="mb-3">
                    <label for="className" class="form-label">Sınıf Adı</label>
                    <input type="text" class="form-control" id="className" name="className" required>
                </div>
                <div class="mb-3">
                    <label for="teacherId" class="form-label">Öğretmen</label>
                    <select class="form-select" id="teacherId" name="teacherId" required>
                        <option value="">Öğretmeni Seçiniz</option>
                        <?php
                        foreach ($teachers as $teacher) {
                            echo "<option value='" . $teacher['id'] . "'>" . $teacher['name'] . ' ' . $teacher['surname'] . "</option>";
                        }
                        ?>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Sınıfı Ekle</button>
            </form>
          </div>
      </div>
  </div>
</div>

    <table class="table table-striped">
  <thead>
    <tr>
      <th>Sınıf Adı</th>
      <th>Sınıf Sorumlusu</th>
      <th>Sınıf Ortalaması</th>
      <th>Öğrenci Sayısı</th>
      <th>İşlemler</th>
    </tr>
  </thead>
  <tbody>
    <?php
  try {
          $class_query = "SELECT class_name, id FROM t_class";
          $class_statement = $conn->query($class_query);

          while ($class_row = $class_statement->fetch(PDO::FETCH_ASSOC)) {
            $class_name = $class_row["class_name"];
            $class_id = $class_row["id"];

            $teacher_query = "SELECT name, surname FROM t_user WHERE id IN (SELECT class_teacher_id FROM t_class WHERE id = $class_id)";
            $teacher_statement = $conn->query($teacher_query);

            $teacher_row = $teacher_statement->fetch(PDO::FETCH_ASSOC);
            $teacher_name = $teacher_row["name"];
            $teacher_surname = $teacher_row["surname"];

            $exam_query = "SELECT AVG(exam_score) AS average_score FROM t_exam WHERE class_id = $class_id";
            $exam_statement = $conn->query($exam_query);

            $exam_row = $exam_statement->fetch(PDO::FETCH_ASSOC);
            $average_score = $exam_row["average_score"];

            $student_query = "SELECT COUNT(*) AS student_count FROM t_classes_student WHERE class_id = $class_id";
            $student_statement = $conn->query($student_query);

            $student_row = $student_statement->fetch(PDO::FETCH_ASSOC);
            $student_count = $student_row["student_count"];

            echo "<tr>";
            echo "<td>$class_name</td>";
            echo "<td>$teacher_name $teacher_surname</td>";
            echo "<td>$average_score</td>";
            echo "<td>$student_count</td>"; ?>
            <td>
            
            <button type="button" class="btn btn-primary edit-button" data-bs-toggle="modal" data-bs-target="#editClassModal" data-class-id="<?php echo $class_id; ?>"> Düzenle </button>

            <div class="modal fade" id="editClassModal" tabindex="-1" aria-labelledby="editClassModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editClassModalLabel">Sınıfı Düzenle</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                    <form action="sinifduzenle.php" method="post">
                    <input type="hidden" class="form-control" id="classId" name="classId">
                            <div class="mb-3">
                                <label for="className" class="form-label">Sınıf Adı</label>
                                <input type="text" class="form-control" id="className" name="className" required>
                            </div>
                            <div class="mb-3">
                                <label for="teacherId" class="form-label">Öğretmen</label>
                                <select class="form-select" id="teacherId" name="teacherId" required>
                                    <option value="">Öğretmeni Seçiniz</option>
                                    <?php
                                    foreach ($teachers as $teacher) {
                                        echo "<option value='" . $teacher['id'] . "'>" . $teacher['name'] . ' ' . $teacher['surname'] . "</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Sınıfı Düzenle</button>
                        </form>
                    </div>
                </div>
            </div>
            </div>
            <button class="btn btn-danger delete-button" data-class-id="<?php echo $class_id; ?>">Sınıfı Sil</button>
            
            </td>
            </tr>
            <?php
          }
        } catch (PDOException $e) {
          echo "Sorgu hatası: " . $e->getMessage();
        }
        ?>
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

table {
  width: 100%;
  border-collapse: collapse;
}

table, th, td {
  border: 1px solid #e1e1e1;
}

th, td {
  padding: 10px;
  text-align: left;
}

th {
  background-color: #f2f2f2;
}

.edit-button, .delete-button {
  padding: 8px 16px;
  margin: 5px;
  border: none;
  cursor: pointer;
}
</style>

<script>
document.addEventListener("DOMContentLoaded", function () {
    var editButtons = document.querySelectorAll('.edit-button');
editButtons.forEach(function (button) {
    button.addEventListener('click', function () {
        var classId = button.getAttribute('data-class-id');
        var classNameInput = document.getElementById('editClassName');
        var teacherIdInput = document.getElementById('editTeacherId');
        document.getElementById('classId').value = classId;
    });
});


    var editClassModal = document.querySelector('#editClassModal');
    editClassModal.addEventListener('hidden.bs.modal', function () {
        var classNameInput = document.getElementById('editClassName');
        var teacherIdInput = document.getElementById('editTeacherId');
        classNameInput.value = "";
        teacherIdInput.value = "";
    });
});
</script>

<script>
document.addEventListener("DOMContentLoaded", function () {
    var deleteButtons = document.querySelectorAll('.delete-button');
    deleteButtons.forEach(function (button) {
        button.addEventListener('click', function () {
            var classId = button.getAttribute('data-class-id');

            if (confirm("Bu sınıfı silmek istediğinizden emin misiniz?")) {
                var xhr = new XMLHttpRequest();
                xhr.open('POST', 'sinifsil.php', true);
                xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                xhr.onreadystatechange = function () {
                    if (xhr.readyState === 4 && xhr.status === 200) {
                        location.reload();
                    }
                };
                xhr.send('classId=' + classId);
            }
        });
    });
});
</script>