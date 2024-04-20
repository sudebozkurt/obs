<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Siber Vatan Yetkinlik Merkezi Öğrenci Bilgi Merkezi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <link href="css/loginstyles.css" rel="stylesheet" />
    
</head>
<body>
<div class="wrapper fadeInDown">
  <div id="formContent">
    <!-- Tabs Titles -->
    <h2 class="active"> Giriş Yap </h2>

    <!-- Login Form -->
    <form method="POST" action="loginfunc.php">
      <input type="text" id="login" class="fadeIn second" name="Username" placeholder="Kullanıcı Adı">
      <input type="password" id="password" class="fadeIn third" name="Password" placeholder="Şifre">
      <input type="submit" class="fadeIn fourth" value="Giriş Yap">
    </form>

    <!-- Remind Passowrd -->
    <div id="formFooter">
      <a class="underlineHover" href="#">Şifreyi Sıfırla</a>
    </div>

  </div>
</div>
</body>
</html>

<style>
  input[type=password] {
  background-color: #f6f6f6;
  border: none;
  color: #0d0d0d;
  padding: 15px 32px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  margin: 5px;
  width: 85%;
  border: 2px solid #f6f6f6;
  -webkit-transition: all 0.5s ease-in-out;
  -moz-transition: all 0.5s ease-in-out;
  -ms-transition: all 0.5s ease-in-out;
  -o-transition: all 0.5s ease-in-out;
  transition: all 0.5s ease-in-out;
  -webkit-border-radius: 5px 5px 5px 5px;
  border-radius: 5px 5px 5px 5px;
}

input[type=password]:focus {
  background-color: #fff;
  border-bottom: 2px solid #6EB70D;
}

input[type=password]:placeholder {
  color: #cccccc;
}

</style>