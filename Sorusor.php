<?php
    include 'ayar.php';
    include 'func.php';
?>


<!DOCTYPE html>
<html lang="tr">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Soru Sor</title>
    <link rel="stylesheet" href="css/all.min.css" />
    <link rel="stylesheet" href="css/normalize.css" />
    <link rel="stylesheet" href="css/bootstrap-grid.min.css" />
    <link rel="stylesheet" href="css/bootstrap-reboot.min.css" />
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <link rel="stylesheet" href="css/style.css" />
  </head>
      
  <?php
    include 'header.php';
    ?>
  <body>

  <div class="container position-absolute  mt-5">
    <div class="card col-lg-6 mx-auto   mt-5">
        <div class="card-header">
          Sorunu Sor
        </div>
        <div class="card-body">
          <h5 class="card-title">Sorunu sormak istermisn</h5>
          <p class="card-text">Eğer cevap ardığın ve danışmak istediğin soru varsa birkaç tık ile kolayca sorabilirsin</p>
          <a href="soru.php" class="btn btn-primary">Hadi soruya</a>
        </div>
      </div>
          <div class="container  mt-5">
            <div>
                    <center><h1>SORULAR</h1></center>
                    </div>
                  </div>
                  <div class="container col-lg-10">
                  <div class="row">  
                </div>
                <?php
                  $dataList = $db -> prepare("SELECT * FROM sorular order by soru_id desc");
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



