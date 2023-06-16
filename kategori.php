
<?php
  include 'ayar.php';

  $link= @$_GET["link"];

  $data=$db->prepare("SELECT * FROM uyeler WHERE uye_kadi=?");
  $data->execute([
      $link

  ]);

  $_data = $data->fetch(PDO::FETCH_ASSOC);

?>
<!doctype html>
<html lang="en">
  <head>
  <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    
    <link rel="stylesheet" href="css/all.min.css" />
    <link rel="stylesheet" href="css/normalize.css" />
    <link rel="stylesheet" href="css/bootstrap-grid.min.css" />
    <link rel="stylesheet" href="css/bootstrap-reboot.min.css" />
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <link rel="stylesheet" href="css/style.css" />
   
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Kategori Ekle</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css"
              rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" 
              crossorigin="anonymous">
              <link rel="stylesheet" href="kategori.css" />
  </head>

<body>
    <div class="row">
      <ul id="main">
        <li><a href="">Bütün Konular</a></li>
        <li><a href="">YGS-LYS</a>
        <ul>
          <li><a href="">Türkçe</a></li>
          <li><a href="">Matematik</a></li>
          <li><a href="">Fen Bilgisi</a></li>
          <li><a href="">Sosyal Bilgisi</a></li>
         </li>
        </ul>
        <li><a href="">TEOG</a></li>
        <li><a href="">Matematik</a></li>
        <li><a href="">Türkçe</a></li>
        <li><a href="">Edebiyat</a></li>
        <li><a href="">Geometri</a></li>
        <li><a href="">Fizik</a></li>
        <li><a href="">Kimya</a></li>
        <li><a href="">Biyoloji</a></li>
        <li><a href="">Tarih</a></li>
        <li><a href="">Cograyfa</a></li>
        <li><a href="">Din Kültür ve Ahlak Bilgisi</a></li>
        <li><a href=""> Felsefe</a></li>
      </ul>
    </div>

    <nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Navbar</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Features</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Pricing</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Dropdown link
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="#">Action</a></li>
            <li><a class="dropdown-item" href="#">Another action</a></li>
            <li><a class="dropdown-item" href="#">Something else here</a></li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>

      

</body>
    

  </body>
</html>