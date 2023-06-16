<?php
    
    if( empty(session_id()) && !headers_sent())
    {
        session_start();
    }
    include 'ayar.php';
    include_once 'func.php';


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
  <body>
    <?php
    include 'header.php';
    ?>
    <div class="container position-absolute   mt-5">
        <div class="row ">
            <div class="col-lg-12 position-absolute mt-5 mb-5">
              <?php
                
                if($_POST){
                  $baslik=htmlspecialchars($_POST["baslik"]);
                  $aciklama=$_POST["aciklama"];
                  $link=sefflink($baslik);
                  // bosluk kont
                  if(empty($baslik)|| empty($aciklama) ){
                    echo '<p class="alert alert-warning">Lütfen boş bırakmayınız!</p>';
                  }

                  else{
                    //eğr boş değilise
                    
                    $dataAdd = $db -> prepare("INSERT INTO sorular SET
                    soru_baslik=?,
                    soru_aciklama=?,
                    soru_link=?,
                    soru_uye_id=?
                ");
                  $dataAdd -> execute([
                      $baslik,
                      $aciklama,
                      ($link),
                      $_SESSION["uye_id"]

                      
                  ]);
                
                if ( $dataAdd ) {
                    echo '<p class="alert alert-success">Successfully added. :)</p>';
                    
                    header("REFRESH:1;URL=sorusor.php");
                } else {
                    echo '<p class="alert alert-danger">Oops, you encountered an error while adding it. Please try again. :/</p>';
                    
                    header("REFRESH:1;URL=yaziekle.php");
                }
                  }

                }

                

              ?>
              <div class="container col-lg-6 mx-auto ">
                <form action="" method="post">
                    <strong>Başlık</strong>
                    <input type="text" name="baslik" id="" class="for-control col-lg-12">
                    <br><br>
                    <strong>Soru Açıklaması</strong>
                    <textarea name="aciklama" id="" cols="30" rows="10" class="form-control"></textarea>
                    <br><br>
                    <input type="submit" href="index.php" value="Yayinla" class="btn btn-dark">
                </form>
                </div>
                </div>
        </div>
    </div>
  </body>
</html>