<?php
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "obs";
try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $sql_query = "SELECT t_lesson.lesson_name, t_lesson.id, t_user.name, t_user.surname, t_lesson.teacher_user_id
                  FROM t_lesson
                  JOIN t_user ON t_lesson.teacher_user_id = t_user.id";
    
    $statement = $conn->prepare($sql_query);
    $statement->execute();
    
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Hata: " . $e->getMessage();
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
        <a class="nav-link collapsed" data-bs-target="#charts-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-bar-chart"></i><span>Sınavlar</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="charts-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="sinavlar.php">
              <i class="bi bi-circle"></i><span>Sınavlar</span>
            </a>
          </li>
        </ul>
      </li><!-- End Sınavlar Nav -->

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
          <li class="breadcrumb-item"><a href="dersler.php">Dersler</a></li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    
    <label for="responsible-filter">Filtrele: </label>
    <select id="responsible-filter">
        <option value="">Tüm Sorumlular</option>
        <?php
        $sql_teacher_query = "SELECT id, name, surname FROM t_user WHERE role = 'teacher'";
        $teacher_statement = $conn->prepare($sql_teacher_query);
        $teacher_statement->execute();
        $teachers = $teacher_statement->fetchAll(PDO::FETCH_ASSOC);

        foreach ($teachers as $teacher) {
            echo "<option value='" . $teacher['id'] . "'>" . $teacher['name'] . ' ' . $teacher['surname'] . "</option>";
        }
        ?>
    </select>

    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addLessonModal">Ders Ekle</button>

    <div class="modal fade" id="addLessonModal" tabindex="-1" aria-labelledby="addLessonModalLabel" aria-hidden="true">
      <div class="modal-dialog">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="addLessonModalLabel">Ders Ekle</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                  <form action="dersekle.php" method="post">
                      <div class="mb-3">
                          <label for="lessonName" class="form-label">Ders Adı</label>
                          <input type="text" class="form-control" id="lessonName" name="lessonName" required>
                      </div>
                      <div class="mb-3">
                          <label for="teacherId" class="form-label">Öğretmen</label>
                          <select class="form-select" id="teacherId" name="teacherId" required>
                              <option value="">Seçiniz</option>
                              <?php
                              foreach ($teachers as $teacher) {
                                  echo "<option value='" . $teacher['id'] . "'>" . $teacher['name'] . ' ' . $teacher['surname'] . "</option>";
                              }
                              ?>
                          </select>
                      </div>
                      <button type="submit" class="btn btn-primary">Dersi Ekle</button>
                  </form>
              </div>
          </div>
      </div>
  </div>

    <?php 
  if (count($result) > 0) { ?>
    <table>
      <thead>
        <tr>
          <th>Ders Adı</th>
          <th>Öğretmen Adı</th>
          <th>Öğretmen Soyadı</th>
          <th> İşlemler </th>
        </tr>
      </thead>
      <tbody>
        <?php
        foreach ($result as $row) {
          echo "<tr data-teacher-id='" . $row['teacher_user_id'] . "'>";
          echo "<td>" . $row["lesson_name"] . "</td>";
          echo "<td>" . $row["name"] . "</td>";
          echo "<td>" . $row["surname"] . "</td>";
          echo "<td>"; ?>
          <button type="button" class="btn btn-primary edit-lesson-button"
            data-lesson-id="<?php echo $row['id']; ?>"
            data-lesson-name="<?php echo $row['lesson_name']; ?>"
            data-teacher-id="<?php echo $row['teacher_user_id']; ?>">
            Düzenle
        </button>


            <div class="modal fade" id="editLessonModal" tabindex="-1" aria-labelledby="editLessonModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                  <div class="modal-content">
                      <div class="modal-header">
                          <h5 class="modal-title" id="editLessonModalLabel">Dersi Güncelle</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                          <form action="dersduzenle.php" method="post">
                          <input type="hidden" id="lessonId" name="lessonId" value="">
                              <div class="mb-3">
                                  <label for="lessonName" class="form-label">Ders Adı</label>
                                  <input type="text" class="form-control" id="lessonName" name="lessonName" required>
                              </div>
                              <div class="mb-3">
                                  <label for="teacherId" class="form-label">Öğretmen</label>
                                  <select class="form-select" id="teacherId" name="teacherId" required>
                                      <option value="">Seçiniz</option>
                                      <?php
                                      foreach ($teachers as $teacher) {
                                          echo "<option value='" . $teacher['id'] . "'>" . $teacher['name'] . ' ' . $teacher['surname'] . "</option>";
                                      }
                                      ?>
                                  </select>
                              </div>
                              <button type="submit" class="btn btn-primary">Dersi Güncelle</button>
                          </form>
                      </div>
                  </div>
              </div>
            </div>
            <button type="button" class="btn btn-danger delete-lesson-button"
                data-lesson-id="<?php echo $row['id']; ?>">
                Sil
            </button>
</td>

          </td>
        </tr>
        <?php
        }
        ?>
      </tbody>
    </table>
    <?php
  } else {
    echo "Sonuç bulunamadı.";
  }
  ?>
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
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>

<style>
        body {
            margin: 0;
            padding: 0;
        }

        h1 {
            text-align: center;
            margin-top: 20px;
        }

        label {
            font-weight: bold;
        }

        select {
            padding: 5px;
        }

        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        th, td {
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #ddd;
        }

        button {
            padding: 5px 10px;
            background-color: #007BFF;
            color: white;
            border: none;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }
    </style>

<script>
$(document).on("click", ".edit-lesson-button", function () {
    var lessonId = $(this).data("lesson-id");
    var lessonName = $(this).data("lesson-name");
    var teacherId = $(this).data("teacher-id");

    $("#lessonId").val(lessonId);
    $("#editLessonName").val(lessonName);
    $("#editTeacherId").val(teacherId);
    $("#editLessonModal").modal("show");
});

$("#editLessonForm").on("submit", function (event) {
    event.preventDefault();

    var lessonId = $("#lessonId").val();
    var lessonName = $("#editLessonName").val();
    var teacherId = $("#editTeacherId").val();

    $.ajax({
        type: "POST",
        url: "dersduzenle.php",
        data: {
            lessonId: lessonId,
            lessonName: lessonName,
            teacherId: teacherId
        },
        success: function (data) {
            console.log("Ders başarıyla güncellendi.");
            location.reload();
        },
        error: function (xhr, status, error) {
            console.log("Error: " + error);
        }
    });
});

</script>

<script>
$(document).on("click", ".delete-lesson-button", function () {
    var lessonId = $(this).data("lesson-id");

    if (confirm("Dersi silmek istediğinizden emin misiniz?")) {
        $.ajax({
            type: "POST",
            url: "derssil.php",
            data: { lessonId: lessonId },
            success: function (data) {
                console.log("Ders başarıyla silindi.");
                location.reload();
            },
            error: function (xhr, status, error) {
                console.log("Error: " + error);
            }
        });
    }
});
</script>

<script>
    $("#responsible-filter").on("change", function () {
        var selectedTeacherId = $(this).val();
        filterLessons(selectedTeacherId);
    });

    function filterLessons(teacherId) {
        $("table tbody tr").hide();

        if (teacherId === "") {
            $("table tbody tr").show();
        } else {
            $("table tbody tr[data-teacher-id='" + teacherId + "']").show();
        }
    }
</script>

