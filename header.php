<?php

  if( empty(session_id()) && !headers_sent())
  {
    session_start();
  }

 
?>
  <html>
  <head>
  <link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
      <meta charset="UTF-8" />
      <meta http-equiv="X-UA-Compatible" content="IE=edge" />
      <meta name="viewport" content="width=device-width, initial-scale=1.0" />
      <title>V-Class</title>
      <link rel="stylesheet" href="css/all.min.css" />
      <link rel="stylesheet" href="css/normalize.css" />
      <link rel="stylesheet" href="css/bootstrap-grid.min.css" />
      <link rel="stylesheet" href="css/bootstrap-reboot.min.css" />
      <link rel="stylesheet" href="css/bootstrap.min.css" />
      <link rel="stylesheet" href="css/style.css" />
    </head>
  <body>
      <div class="container  ">
          <nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark">
                  <a class="navbar-brand ms-5 " href="index.php">
                    <img src="resim/img.png" alt="Bootstrap" width="40" height="40"  >
                    V-Class
                  </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                  <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse ms-3 " id="navbarNavAltMarkup">
                  <div class="navbar-nav ">
                    <a class="nav-link active" aria-current="page" href="index.php">Ana Sayfa</a>
                    <a class="nav-link active" aria-current="page" href="discord.php">Etüt Odaları</a>
                    <a class="nav-link active" aria-current="page" href="Sorusor.php">Soru Sor</a>


                  

                    <?php
                    if (@$_SESSION["uye_id"]) {
                      # Sadece üyeler görsün I
                      echo '<a class="nav-link active text-start" aria-current="page" href="profil.php?kadi='.@$_SESSION ["uye_kadi"].'">Profilim</a>
                      <a class="nav-link active text-start" aria-current="page" href="uyelik.php?p=cikis">Çıkış Yap</a>';
                      if (@$_SESSION["uye_onay"] == 1) {
                        // Admin değilse
                        echo '<a class="nav-link active text-start" aria-current="page" href="admin.php">Admin</a>';
                      }
                    } else {
                      # Sadece üye olmayanlar görsün
                      echo '<a class="nav-link active text-start" aria-current="page" href="uyelik.php?p=kayit">Üye ol</a> 
                      <a class="nav-link active text-start" aria-current="page" href="uyelik.php">Giriş Yap</a>';
                    }
                  ?>


                  </div>
                </div>
                      <form class="d-flex justify-content-end me-5" role="search">
                        <input class="form-control me-2" type="search" placeholder="Ara..." name ="kelime" aria-label="Ara">
                        <button class="btn btn-outline-success"  type="submit">Search</button>
                      </form>
                      
            </nav>
      </div>
  </body>
  </html>


