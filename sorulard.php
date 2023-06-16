<?php

if( empty(session_id()) && !headers_sent())
{
    session_start();
}
    include 'ayar.php';
    include 'func.php';


    if (!@$_SESSION["uye_onay"] == 1) {
      // Admin değilse

      echo '<center><h1>Sadece Yöneticiler Görebilir<h1/></center>';

      exit;
    }

    $link= @$_GET["link"];

    $data=$db->prepare("SELECT * FROM sorular WHERE soru_link=?");
    $data->execute([
        $link

    ]);

    $_data = $data->fetch(PDO::FETCH_ASSOC);


   
?>

<!DOCTYPE html>
<html lang="en">
  <head>
  <link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>V-Class Admin</title>
    <link rel="stylesheet" href="css/all.min.css" />
    <link rel="stylesheet" href="css/normalize.css" />
    <link rel="stylesheet" href="css/bootstrap-grid.min.css" />
    <link rel="stylesheet" href="css/bootstrap-reboot.min.css" />
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <link rel="stylesheet" href="css/style.css" />
  </head>
  <body>
    <br>

    <header class="container">
      <div class="row">
        <div class="col-lg-6 text-lg ">
            <a href="" class="logo"><strong>V-Class</strong></a>
        </div>
        <div class="col-lg-6 text-end">
            <a href="index.php" class="menu">Siteyi Görüntüle</a>
            <a href="admin.php" class="menu">Yazılar</a>
            <a href="sorulard.php" class="menu">sorular</a>
            <a href="yaziekle.php" class="menu">Yazı Ekle</a>
        </div>
      </div>
    </header>

    <br><br>

    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <table class="table table-dark table-striped">
                  <tr>
                    <td>
                      Başlık
                    </td>
                    <td>
                      Tarih
                    </td>
                    <td>
                       SİL
                    </td>
                  </tr>
                  <?php
                  $dataList = $db -> prepare("SELECT * FROM sorular order by soru_id desc");
                  $dataList -> execute();
                  $dataList = $dataList -> fetchALL(PDO::FETCH_ASSOC);
                  
                  foreach($dataList as $row){
                      echo'<tr>
                      <td>
                      <a href="soru.php?link='.$row["soru_link"].'"class="text-white" target="_blank">'.$row["soru_baslik"]. '</a>
                      </td>
                      <td>
                      '.$row["soru_tarih"].'
                      </td>
                      <td>
                      <a  href="sorulard.php?sil='.$row["soru_id"].'" class="btn btn-danger">
                        SİL
                      </a>
                      </td>
                      
                    </tr>'; 
                  }

                  
                  ?>

                    
                  
                  

                  <?php
                    if (isset ($_GET['sil'])) {
                      $verisil = $db->prepare(" DELETE FROM sorular WHERE soru_id=? ");
                      $verisil ->execute([$_GET['sil']]);
                    }
                  ?>
                </table>
            </div>
        </div>
    </div>
  </body>
</html>