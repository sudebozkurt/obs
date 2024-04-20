<?php
$dbname = "obs";
$host = "localhost";
$username = "root";
$password = "root";

try {
  $db = new PDO("localhost:host=$host;dbname=$dbname", $username, $password);
  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  $classQuery = "SELECT id, class_name FROM t_class";
  $classStmt = $db->prepare($classQuery);
  $classStmt->execute();
  $classData = $classStmt->fetchAll(PDO::FETCH_ASSOC);

  $lessonQuery = "SELECT id, lesson_name FROM t_lesson";
  $lessonStmt = $db->prepare($lessonQuery);
  $lessonStmt->execute();
  $lessonData = $lessonStmt->fetchAll(PDO::FETCH_ASSOC);

  $studentQuery = "SELECT id, name, surname FROM t_user WHERE role = 'student'";
  $studentStmt = $db->prepare($studentQuery);
  $studentStmt->execute();
  $studentData = $studentStmt->fetchAll(PDO::FETCH_ASSOC);

  $examQuery = "SELECT e.id as exam_id, e.exam_date, c.class_name, u.name as student_name, u.surname as student_surname, l.lesson_name, e.exam_score
  FROM t_exam e
  INNER JOIN t_class c ON e.class_id = c.id
  INNER JOIN t_user u ON e.student_id = u.id
  INNER JOIN t_lesson l ON e.lesson_id = l.id";

$examStmt = $db->prepare($examQuery);
$examStmt->execute();
$examData = $examStmt->fetchAll(PDO::FETCH_ASSOC);

$selectClassQuery = "SELECT DISTINCT class_name FROM t_class";
$selectClassStmt = $db->prepare($selectClassQuery);
$selectClassStmt->execute();
$classNames = $selectClassStmt->fetchAll(PDO::FETCH_COLUMN);

} catch (PDOException $e) {
  echo "Veritabanına bağlanırken hata oluştu: " . $e->getMessage();
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
        <a class="nav-link " href="ogretmenanasayfa.php">
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
            <a href="ogretmendenogrenciler.php">
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
            <a href="ogretmendensorumlular.php">
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
            <a href="ogretmendendersler.php">
              <i class="bi bi-circle"></i><span>Dersler</span>
            </a>
          </li>
        </ul>
      </li><!-- End Dersler Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#charts-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-bar-chart"></i><span>Sınavlar</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="charts-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="ogretmendensinavlar.php">
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
            <a href="ogretmendenprofil.php">
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
          <li class="breadcrumb-item"><a href="ogretmendensinavlar.php">Sınavlar</a></li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

<button class="btn btn-success" id="add-exam-button" data-bs-toggle="modal" data-bs-target="#add-exam-modal">Yeni Sınav Ekle</button>

<!-- Sınav Ekleme Modal -->
<div class="modal fade" id="add-exam-modal" tabindex="-1" aria-labelledby="add-exam-modal-label" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="add-exam-modal-label">Yeni Sınav Ekle</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="add-exam-form" method="post" action="sinavekle.php">
          <div class="mb-3">
            <label for="class-select" class="form-label">Sınıf Adı</label>
              <select class="form-select" id="class-select" name="class_id">
                <option value="" selected>Seçiniz</option>
                <?php foreach ($classData as $class) : ?>
                    <option value="<?php echo $class['id']; ?>"><?php echo $class['class_name']; ?></option>
                <?php endforeach; ?>>
            </select>
          </div>
          <div class="mb-3">
            <label for="student-name" class="form-label">Öğrenci İsmi Soyismi</label>
              <select class="form-select" id="student-name" name="student_id">
                  <option value="" selected>Seçiniz</option>
                  <?php foreach ($studentData as $student) : ?>
                      <option value="<?php echo $student['id']; ?>">
                          <?php echo $student['name'] . ' ' . $student['surname']; ?>
                      </option>
                  <?php endforeach; ?>
              </select>
          </div>
          <div class="mb-3">
            <label for="lesson-select" class="form-label">Ders Adı</label>
              <select class="form-select" id="lesson-select" name="lesson_id">
                <option value="" selected>Seçiniz</option>
                <?php foreach ($lessonData as $lesson) : ?>
                    <option value="<?php echo $lesson['id']; ?>"><?php echo $lesson['lesson_name']; ?></option>
                <?php endforeach; ?>
            </select>
          </div>
          <div class="mb-3">
            <label for="exam-score" class="form-label">Sınav Notu</label>
            <input type="number" class="form-control" id="exam-score" name="exam_score" min="0" max="100" placeholder="0-100 arası not">
          </div>
        </form>
      </div>
      <div class="modal-footer">  
      <button type="button" class="btn btn-primary" id="save-exam-button">Kaydet</button>
      </div>
    </div>
  </div>
</div>
        <script>
          const addExamModal = document.getElementById("add-exam-modal");
          const addExamForm = document.getElementById("add-exam-form");

          document.getElementById("add-exam-button").addEventListener("click", function() {
            addExamModal.hidden = false;
          });

          document.getElementById("save-exam-button").addEventListener("click", function() {

            addExamModal.hidden = true;
          });
        </script>

<select id="class-filter">
  <option value="">Tüm Sınıflar</option>
  <?php foreach ($classNames as $className) : ?>
    <option value="<?php echo $className; ?>"><?php echo $className; ?></option>
  <?php endforeach; ?>
</select>

    <table id="exam-table">
  <thead>
    <tr>
      <th>Sınav Tarihi</th>
      <th>Sınıf Adı</th>
      <th>Öğrenci İsmi</th>
      <th>Öğrenci Soy İsmi</th>
      <th>Ders Adı</th>
      <th>Ders Notu</th>
      <th>İşlemler</th>
    </tr>
  </thead>
  <tbody>
        <?php foreach ($examData as $exam) : ?>
          <tr>
            <td><?php echo $exam['exam_date']; ?></td>
            <td><?php echo $exam['class_name']; ?></td>
            <td><?php echo $exam['student_name']; ?></td>
            <td><?php echo $exam['student_surname']; ?></td>
            <td><?php echo $exam['lesson_name']; ?></td>
            <td><?php echo $exam['exam_score']; ?></td>
            <td>
            <button class="btn btn-primary btn-sm edit-exam-button" data-bs-toggle="modal" data-bs-target="#edit-exam-modal" data-exam-id="<?php echo $exam['exam_id']; ?>">Düzenle</button>
              <div class="modal fade" id="edit-exam-modal" tabindex="-1" aria-labelledby="edit-exam-modal-label" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="edit-exam-modal-label">Sınavı Düzenle</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <form id="edit-exam-form" method="post" action="sinavduzenle.php">
                        <input type="hidden" id="exam-id" name="exam_id" value=""> 
                        <div class="mb-3">
                          <label for="class-select" class="form-label">Sınıf Adı</label>
                          <select class="form-select" id="edit-class-select" name="class_id">
                            <option value="" selected>Seçiniz</option>
                            <?php foreach ($classData as $class) : ?>
                              <option value="<?php echo $class['id']; ?>"><?php echo $class['class_name']; ?></option>
                            <?php endforeach; ?>
                          </select>
                        </div>
                        <div class="mb-3">
                          <label for="edit-student-name" class="form-label">Öğrenci İsmi Soyismi</label>
                          <select class="form-select" id="edit-student-name" name="student_id">
                            <option value="" selected>Seçiniz</option>
                            <?php foreach ($studentData as $student) : ?>
                              <option value="<?php echo $student['id']; ?>">
                                <?php echo $student['name'] . ' ' . $student['surname']; ?>
                              </option>
                            <?php endforeach; ?>
                          </select>
                        </div>
                        <div class="mb-3">
                          <label for="lesson-select" class="form-label">Ders Adı</label>
                          <select class="form-select" id="edit-lesson-select" name="lesson_id">
                            <option value="" selected>Seçiniz</option>
                            <?php foreach ($lessonData as $lesson) : ?>
                              <option value="<?php echo $lesson['id']; ?>"><?php echo $lesson['lesson_name']; ?></option>
                            <?php endforeach; ?>
                          </select>
                        </div>
                        <div class="mb-3">
                          <label for="edit-exam-score" class="form-label">Sınav Notu</label>
                          <input type="number" class="form-control" id="edit-exam-score" name="exam_score" min="0" max="100" placeholder="0-100 arası not">
                        </div>
                      </form>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-primary" id="update-exam-button">Güncelle</button>
                    </div>
                  </div>
                </div>
              </div>

              <button class="btn btn-danger btn-sm delete-exam-button" data-exam-id="<?php echo $exam['exam_id']; ?>">Sil</button>
            </td>
          </tr>
        <?php endforeach; ?>
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
#main {
  padding: 20px;
}

#class-filter {
  width: 100%;
  padding: 10px;
  margin-bottom: 20px;
}

#exam-table {
  width: 100%;
}

#exam-table th,
#exam-table td {
  padding: 10px;
  text-align: center;
}

.btn {
  padding: 10px 20px;
  margin-right: 10px;
}
</style>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.11.7/js/jquery.dataTables.min.js"></script>

<script>
 $(document).ready(function () {
      $('#exam-table').DataTable();
    });

document.getElementById("save-exam-button").addEventListener("click", function () {
  const classId = document.getElementById("class-select").value;
  const studentId = document.getElementById("student-name").value;
  const lessonId = document.getElementById("lesson-select").value;
  const examScore = document.getElementById("exam-score").value;

  const formData = new FormData();
  formData.append("class_id", classId);
  formData.append("student_id", studentId);
  formData.append("lesson_id", lessonId);
  formData.append("exam_score", examScore);

  fetch("sinavekle.php", {
    method: "POST",
    body: formData,
  })
    .then(function (response) {
      if (response.ok) {
        window.location.href = "sinavlar.php";
      } else {
        console.log("Sunucu hatası: " + response.status);
        response.text().then(function (text) {
          console.log("Sunucu yanıtı: " + text);
        });
      }
    })
    .catch(function (error) {
      console.error("İstek hatası:", error);
    });
});

</script>

<script>
  document.querySelectorAll(".edit-exam-button").forEach((button) => {
    button.addEventListener("click", function (event) {
      const examId = event.target.getAttribute("data-exam-id");
      const editExamModal = document.getElementById("edit-exam-modal");
      editExamModal.hidden = false;

      fetch(`get_exam_data.php?exam_id=${examId}`)
        .then((response) => response.json())
        .then((data) => {
          document.getElementById("exam-id").value = data.exam_id;
          document.getElementById("edit-class-select").value = data.class_id;
          document.getElementById("edit-student-name").value = data.student_id;
          document.getElementById("edit-lesson-select").value = data.lesson_id;
          document.getElementById("edit-exam-score").value = data.exam_score;
        })
        .catch((error) => {
          console.error("Veri alınamadı:", error);
        });
    });
  });

  document.getElementById("update-exam-button").addEventListener("click", function () {
    const examId = document.getElementById("exam-id").value;
    const classId = document.getElementById("edit-class-select").value;
    const studentId = document.getElementById("edit-student-name").value;
    const lessonId = document.getElementById("edit-lesson-select").value;
    const examScore = document.getElementById("edit-exam-score").value;

    const formData = new FormData();
    formData.append("exam_id", examId);
    formData.append("class_id", classId);
    formData.append("student_id", studentId);
    formData.append("lesson_id", lessonId);
    formData.append("exam_score", examScore);

    fetch("sinavduzenle.php", {
      method: "POST",
      body: formData,
    })
      .then(function (response) {
        if (response.ok) {
          window.location.href = "sinavlar.php";
        } else {
          console.log("Sunucu hatası: " + response.status);
          response.text().then(function (text) {
            console.log("Sunucu yanıtı: " + text);
          });
        }
      })
      .catch(function (error) {
        console.error("İstek hatası:", error);
      });
  });
</script>

<script>
document.querySelectorAll(".delete-exam-button").forEach((button) => {
  button.addEventListener("click", function (event) {
    const examId = event.target.getAttribute("data-exam-id");

    if (confirm("Bu sınavı silmek istediğinizden emin misiniz?")) {
      fetch(`sinavsil.php?exam_id=${examId}`, {
        method: "GET",
      })
        .then(function (response) {
          if (response.ok) {
            window.location.reload();
          } else {
            console.error("Silme işlemi başarısız oldu. Sunucu hatası: " + response.status);
            response.text().then(function (text) {
              console.error("Sunucu yanıtı: " + text);
            });
          }
        })
        .catch(function (error) {
          console.error("İstek hatası:", error);
        });
    }
  });
});

</script>

<script>
const examTable = document.getElementById("exam-table");
const classFilter = document.getElementById("class-filter");

classFilter.addEventListener("change", function () {
  const selectedClass = classFilter.value;
  const rows = examTable.getElementsByTagName("tr");

  for (let i = 1; i < rows.length; i++) {
    const row = rows[i];
    const classCell = row.cells[1];
    if (selectedClass === "" || classCell.textContent === selectedClass) {
      row.style.display = "";
    } else {
      row.style.display = "none";
    }
  }
});

classFilter.dispatchEvent(new Event("change"));

</script>
