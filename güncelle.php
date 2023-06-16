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

    $data=$db->prepare("SELECT * FROM yaziler WHERE yazi_id=?");
    $data->execute([
        $_GET['yazi_id']
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
    <title>yazı güncelleme</title>
    <link rel="stylesheet" href="css/all.min.css" />
    <link rel="stylesheet" href="css/normalize.css" />
    <link rel="stylesheet" href="css/bootstrap-grid.min.css" />
    <link rel="stylesheet" href="css/bootstrap-reboot.min.css" />
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <link rel="stylesheet" href="css/style.css" />
  </head>
  <body>
    <header class="container">
      <div class="row">
        <div class="col-lg-6 text-xl ">
            <a href="" class="logo"><strong>Yazi Ekle</strong></a>
        </div>
        <div class="col-lg-6 text-end">
            <a href="index.php" class="menu">Siteyi Görüntüle</a>
            <a href="admin.php" class="menu">Yazılar</a>
            <a href="yaziekle.php" class="menu">Yazı Ekle</a>
            <a href="kategori.php" class="menu">Kategori Ekle</a>
        </div>
      </div>
    </header>

    <div class="container">
        <div class="row">
            <div class="col-lg-12 mt-5 mb-5">
              <?php
                 
                 if($_POST){
                    $baslik=htmlspecialchars($_POST["baslik"]);
                    $resim=$_POST["resim"];
                    $pdf=$_POST["pdf"];
                    $aciklama=$_POST["aciklama"];
                    $video=$_POST["video"];
                    $link=permalink($baslik);
                    $id=($_POST["yaziid"]);
  
  
                    // bosluk kont
                    if(empty($baslik)|| empty($aciklama) || empty($resim)){
                      echo '<p class="alert alert-warning">Lütfen boş bırakmayınız!</p>';
                    }
  
                    else{
                      //eğr boş değilise
                      
                      $veriguncelle = $db -> prepare(" UPDATE yaziler SET
                      yazi_baslik=?,
                      yazi_aciklama=?,
                      yazi_link=?,
                      yazi_resim=?,
                      yazi_video=?,
                      yazi_pdf=?

                      WHERE yazi_id=?
                  ");
                  $veriguncelle -> execute([
                      $baslik,
                      $aciklama,
                      $link,
                      $resim,
                      $video,
                      $pdf,
                      $id
                  ]);
                  
                  if ( $veriguncelle ) {
                      echo '<p class="alert alert-success">Yazı başarı ile eklendi :)</p>';
                      
                      header("REFRESH:1;URL=yazi.php?link= ". $link);
                  } else {
                      echo '<p class="alert alert-danger">Tekrar Deneyiniz yazı Eklenmedi :/</p>';
                      
                      header("REFRESH:1;URL=yaziekle.php");
                  }
                    }
  
                  }
                
              ?>
                <form action="" method="post">
                    <input type="hidden" name="yaziid" value="<?=$_data['yazi_id']?>">
                    <strong>Başlık</strong>
                    <input type="text" name="baslik" id="" value="<?=$_data['yazi_baslik']?>" class="for-control col-lg-12">
                    <br><br>
                    <strong>Açıklama</strong>
                    <textarea name="aciklama" type="text" id=""  cols="30" rows="10" class="form-control"></textarea>
                    <strong>Kapak resmi link</strong>
                    <input type="text" name="resim" id="" value="<?=$_data['yazi_resim']?>"  class="for-control col-lg-12">
                    <br><br>
                    <strong>Pdf Link</strong>
                    <input type="text" name="pdf" id="" value="<?=$_data['yazi_pdf']?>"  class="for-control col-lg-12">
                    <br><br>
                    <strong>Video Linki</strong>
                    <input type="text" name="video" id="" value="<?=$_data['yazi_video']?>"  class="for-control col-lg-12">
                    <br><br>
                    <input type="submit" href="URL=yazi.php?link=" . $link" value="Yayinla" class="btn btn-dark">
                    <br><br><br>
                </form>
           

            </div>
        </div>
    </div>
  </body>
</html>

