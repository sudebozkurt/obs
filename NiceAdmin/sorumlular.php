<?php
$host = "localhost";
$dbname = "obs";
$username = "root";
$password = "root";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Veritabanına bağlantı hatası: " . $e->getMessage());
}

$sınıfAdi = isset($_GET['sınıfAdi']) ? $_GET['sınıfAdi'] : '';
$dersAdi = isset($_GET['dersAdi']) ? $_GET['dersAdi'] : '';

$query = "SELECT u.id, u.name, u.surname, u.username, l.lesson_name, c.class_name
FROM t_user u
LEFT JOIN t_lesson l ON u.id = l.teacher_user_id
LEFT JOIN t_class c ON u.id = c.class_teacher_id
WHERE u.role = 'teacher'";

if (!empty($sınıfAdi)) {
    $query .= " AND c.class_name = :class_name";
}

if (!empty($dersAdi)) {
    $query .= " AND l.lesson_name = :lesson_name";
}

try {
    $stmt = $pdo->prepare($query);
    if (!empty($sınıfAdi)) {
        $stmt->bindParam(':class_name', $sınıfAdi, PDO::PARAM_STR);
    }
    if (!empty($dersAdi)) {
        $stmt->bindParam(':lesson_name', $dersAdi, PDO::PARAM_STR);
    }

    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Sorgu hatası: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta href="https://cdn.jsdelivr.net/npm/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

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
          <li class="breadcrumb-item"><a href="sorumlular.php">Sorumlular</a></li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#sorumluEkleModal">
  Sorumlu Ekle
</button>
<div class="modal fade" id="sorumluEkleModal" tabindex="-1" role="dialog" aria-labelledby="sorumluEkleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="sorumluEkleModalLabel">Sorumlu Ekle</h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="sorumluekle.php" method="POST">
          <div class="mb-3">
            <label for="isim" class="form-label">İsim</label>
            <input type="text" class="form-control" id="isim" name="isim" required>
          </div>
          <div class="mb-3">
            <label for="soyisim" class="form-label">Soyisim</label>
            <input type="text" class="form-control" id="soyisim" name="soyisim" required>
          </div>
          <div class="mb-3">
            <label for="kullaniciAdi" class="form-label">Kullanıcı Adı</label>
            <input type="text" class="form-control" id="kullaniciAdi" name="kullaniciAdi" required>
          </div>
          <div class="mb-3">
            <label for="sifre" class="form-label">Şifre</label>
            <input type="password" class="form-control" id="sifre" name="sifre" required>
          </div>
          <button type="submit" class="btn btn-primary">Sorumlu Ekle</button>
        </form>
      </div>
    </div>
  </div>
</div>
    <div class="row">
    <div class="col-md-6">
        <label for="sorumlu-sinif">Sorumlu Sınıf:</label>
        <select class="form-select" id="sorumlu-sinif" name="sınıfAdi">
            <option value="">Tüm Sınıflar</option>
            <?php
            $classNames = [];

            $classNameQuery = "SELECT DISTINCT class_name FROM t_class";
            $classNameStmt = $pdo->prepare($classNameQuery);
            $classNameStmt->execute();
            $classNameResults = $classNameStmt->fetchAll(PDO::FETCH_ASSOC);
            
            foreach ($classNameResults as $classNameResult) {
                $classNames[] = $classNameResult['class_name'];
            }

            foreach ($classNames as $className) {
                $selected = ($className == $sınıfAdi) ? 'selected' : '';
                echo "<option value='$className' $selected>$className</option>";
            }
            ?>
        </select>
    </div>
      <div class="col-md-6">
        <label for="sorumlu-ders">Sorumlu Ders:</label>
        <select class="form-select" id="sorumlu-ders" name="dersAdi">
            <option value="">Tüm Dersler</option>
            <?php
            $lessonNames = [];

            $lessonQuery = "SELECT DISTINCT lesson_name FROM t_lesson";
            $lessonStmt = $pdo->prepare($lessonQuery);
            $lessonStmt->execute();
            $lessonResults = $lessonStmt->fetchAll(PDO::FETCH_ASSOC);

            foreach ($lessonResults as $lessonResult) {
                $lessonNames[] = $lessonResult['lesson_name'];
            }

            foreach ($lessonNames as $lessonName) {
                $selected = ($lessonName == $dersAdi) ? 'selected' : '';
                echo "<option value='$lessonName' $selected>$lessonName</option>";
            }
            ?>
        </select>
    </div>


        <div class="container">
            <h2>Öğretmenler ve İlgili Ders/Sınıf Bilgileri</h2>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Ad</th>
                        <th>Soyad</th>
                        <th>Ders Adı</th>
                        <th>Sınıf Adı</th>
                        <th>İşlemler</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($result as $row): ?>
                        <tr>
                            <td><?php echo $row['name']; ?></td>
                            <td><?php echo $row['surname']; ?></td>
                            <td><?php echo $row['lesson_name']; ?></td>
                            <td><?php echo $row['class_name']; ?></td>
                            <td>
                              <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#duzenleModal" data-id="<?php echo $row['id']; ?>" data-isim="<?php echo $row['name']; ?>" data-soyisim="<?php echo $row['surname']; ?>" data-kullanici-adi="<?php echo $row['username']; ?>">
                                  Düzenle
                              </button>
                              <a href="sorumlusil.php?id=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm">Sil</a>
                          </td>

                            <div class="modal fade" id="duzenleModal" tabindex="-1" role="dialog" aria-labelledby="duzenleModalLabel" aria-hidden="true">
                              <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title" id="duzenleModalLabel">Öğretmen Düzenle</h5>
                                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>
                                  <div class="modal-body">
                                    <form action="sorumluduzenle.php" method="POST">
                                      <input type="hidden" id="duzenle-id" name="id" value="<?php echo $row['id']; ?>">
                                      <div class="mb-3">
                                        <label for="duzenle-isim" class="form-label">İsim</label>
                                        <input value="<?php echo $row['name']; ?>" type="text" class="form-control" id="duzenle-isim" name="isim" required>
                                      </div>
                                      <div class="mb-3">
                                        <label for="duzenle-soyisim" class="form-label">Soyisim</label>
                                        <input value="<?php echo $row['surname']; ?>" type="text" class="form-control" id="duzenle-soyisim" name="soyisim" required>
                                      </div>
                                      <div class="mb-3">
                                        <label for="duzenle-kullaniciAdi" class="form-label">Kullanıcı Adı</label>
                                        <input value="<?php echo $row['username']; ?>" type="text" class="form-control" id="duzenle-kullaniciAdi" name="kullaniciAdi" required>
                                      </div>
                                      <div class="mb-3">
                                        <label for="duzenle-sifre" class="form-label">Şifre</label>
                                        <input type="password" class="form-control" id="duzenle-sifre" name="yeniSifre">
                                      </div>
                                      <button type="submit" class="btn btn-primary">Kaydet</button>
                                    </form>
                                  </div>
                                </div>
                              </div>
                            </div>

                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>



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

  <script>
document.getElementById("sorumlu-sinif").addEventListener("change", function() {
    var selectedClass = this.value;

    var currentURL = window.location.href;
    var updatedURL = updateURLParameter(currentURL, "sınıfAdi", selectedClass);
    window.location.href = updatedURL;
});

function updateURLParameter(url, param, value) {
    var re = new RegExp("([?&])" + param + "=.*?(&|$)", "i");
    var separator = url.indexOf("?") !== -1 ? "&" : "?";
    if (url.match(re)) {
        return url.replace(re, "$1" + param + "=" + value + "$2");
    } else {
        return url + separator + param + "=" + value;
    }
}
</script>

<script>
document.getElementById("sorumlu-ders").addEventListener("change", function() {
    var selectedLesson = this.value;
    var currentURL = window.location.href;
    var updatedURL = updateURLParameter(currentURL, "dersAdi", selectedLesson);
    window.location.href = updatedURL;
});
</script>

</body>

</html>

<style>
        body {
            font-family: Arial, sans-serif;
        }
        .container {
            margin-top: 20px;
        }
        .btn {
            margin-right: 5px;
        }
        .table {
            margin-top: 20px;
        }
    </style>

<script>
   $('#duzenleModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget);
    var id = button.data('id');
    var isim = button.data('isim');
    var soyisim = button.data('soyisim');
    var kullaniciAdi = button.data('kullanici-adi');

    var modal = $(this);
    modal.find('#duzenle-id').val(id);
    modal.find('#duzenle-isim').val(isim);
    modal.find('#duzenle-soyisim').val(soyisim);
    modal.find('#duzenle-kullaniciAdi').val(kullaniciAdi);
});

$('#duzenleForm').on('submit', function (e) {
    e.preventDefault();
    var formData = $(this).serialize();

    $.ajax({
        type: 'POST',
        url: 'sorumluduzenle.php',
        data: formData,
        success: function (response) {
            console.log(response);
            $('#duzenleModal').modal('hide');
        },
        error: function (error) {
            console.error(error);
        }
    });
});
</script>

<?php $conn=null;?>