<?php
include 'ayar.php';
include 'header.php';
include 'func.php';

if( empty(session_id()) && !headers_sent())
{
    session_start();
}
$id= @$_GET["uye_id"];

    $data=$db->prepare("SELECT * FROM uyeler WHERE uye_id=?");
    $data->execute([
        $id

    ]);


$_data = $data->fetch(PDO::FETCH_ASSOC);

?>
<html>
  <head>
  <link rel="stylesheet" href="sınıf.css" />
  </head>
  <body>
    <br><br><br><br><br>
    

    <div class="container">
      <div class="container row justify-content-center">
        <div class="card" style="width: 18rem;">
          <img src="https://cdn-icons-png.flaticon.com/512/6522/6522516.png" class="card-img-top" alt="...">
          <div class="card-body">
            <center><h4 class="card-title"><?=uye_kadi_den_isim($_GET["kadi"])?></h4></center>
          </div>
          <ul class="list-group list-group-flush">
            <li class="list-group-item"><?=$_GET["kadi"]?></li>
            <li class="list-group-item"><?=uye_kadi_den_eposta($_GET["kadi"])?></li>
          </ul>
          <div class="card-body">
          <center><a href="sg.php" class="btn btn-primary">Şifreni Değiş</a></center>
          </div>
      </div>

      <div class="container ">
          <div class="container row justify-content-center">
              <h1 class="s"> Sorular</h1>

              <?php

                  $soru_u_id= uye_kadi_den_id($_GET["kadi"]);
                  $dataList = $db -> prepare("SELECT * FROM sorular WHERE soru_uye_id = $soru_u_id
                  ");
                  $dataList -> execute();
                  $dataList = $dataList -> fetchALL(PDO::FETCH_ASSOC);

                  foreach($dataList as $row){
                      echo'<div class="card col-lg-6 mx-auto   mt-5">
                      <div class="card-header">
                        Soruyu Cevaplarmısın
                      </div>
                      <div class="card-body">
                        <h5 class="card-title">'.$row["soru_baslik"].'</h5>
                        <p class="card-text">'. kisalt($row["soru_aciklama"],15) .'</p>
                        <a href="sorucevap.php?link='.$row["soru_link"].'" class="btn btn-primary">Hadi soruya</a>
                      </div>
                    </div>';
                  }
                  ?>

          </div>
      </div>
  </body>
</html>