<?php
    if( empty(session_id()) && !headers_sent())
    {
        session_start();
    }
  include 'ayar.php';
  include 'func.php';
  include 'ukas.php';
?>
<!DOCTYPE html>
<html lang="en">
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
    <link rel="stylesheet" href="sınıf.css" />
  
  </head>
  <body>
  

<?php
include 'header.php';
?>

    
    <br><br>
    <div class="carousel slide  px-5 ">
        <div id="carouselExample" class="carousel px-5  ">
            <div class="carousel-inner">
              <div class="carousel-item active">
                <img src="./images/slider.jpg" class="d-block w-100" alt="...">
              </div>
             
              <div class="carousel-item">
                <img src="./images/slider2.jpg" class="d-block w-100" alt="...">
              </div>
              <div class="carousel-item">
                <img src="./images/slider3.jpg" class="d-block w-100" alt="...">
              </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Next</span>
            </button>
          </div>
    </div>
   

    

 

    
    

    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js" integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.min.js" integrity="sha384-heAjqF+bCxXpCWLa6Zhcp4fu20XoNIA98ecBC1YkdXhszjoejr5y9Q77hIrv8R9i" crossorigin="anonymous"></script>
</body>
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center mt-5 mb-5 ">
            </div>
        <div class="row">
        <?php
                      require_once 'ayar.php';
                      if ($_GET)
                      {
                        $kelime=$_GET['kelime'];
                        if(!$kelime){
                          echo "<center><strong>ARAMA YAPMAK İÇİN KELİME GİRİNİZ</strong></center><br><br><br><br><br>";
                        }
                        else{
                          $sorgu=$db->prepare("SELECT * FROM yaziler WHERE yazi_aciklama LIKE :yazi_aciklama");
                          $sorgu->execute(array(':yazi_aciklama'=>'%'.$kelime.'%'));
                          if($sorgu->rowCount()){
                            foreach($sorgu as $row)
                            { 
                            echo "<br>";
                            echo '<br><div class="col-lg-4 mt-5 ">
                            <div class="card " style="width: 18rem;">
                                <img  style="text-align:center width:150px; height: 200px" src="'.$row["yazi_resim"]. '"alt="...">
                                <div class="card-body">
                                  <h5 class="card-title">'.$row["yazi_baslik"].'</h5>
                                  <p class="card-text">'. kisalt($row["yazi_aciklama"]) .'</p>
                                  <a href="yazi.php?link='.$row["yazi_link"].'"class="btn btn-primary">Devami</a>
                                </div>
                              </div>
                        </div><br>';
                            }
                          }
                          else{
                            echo "<br><br><center><p>ARANAN KELİME BULUNAMADI</p></center><br><br>";
                          }
                        }
                      }
                      ?>

                   <?php
                  if (!@$_GET) {
                     
                  $dataList = $db -> prepare("SELECT * FROM yaziler order by yazi_id desc");
                  $dataList -> execute();
                  $dataList = $dataList -> fetchALL(PDO::FETCH_ASSOC);

                  foreach($dataList as $row){
                      echo'<br><div class="col-lg-4 mt-5 ">
                      <div class="card " style="width: 18rem;">
                          <img  style="text-align:center width:150px; height: 200px" src="'.$row["yazi_resim"]. '" alt="...">
                          <div class="card-body">
                            <h5 class="card-title">'.$row["yazi_baslik"].'</h5>
                            <p class="card-text">'. kisalt($row["yazi_aciklama"],20) .'</p>
                            <a href="yazi.php?link='.$row["yazi_link"].'"class="btn btn-primary">Devami</a>
                          </div>
                        </div>
                  </div><br>';

                  }
                 
                }
                  ?>
        </div>
    </div><br><br>
    <script>
var url = 'https://wati-integration-service.clare.ai/ShopifyWidget/shopifyWidget.js?52710';
var s = document.createElement('script');
s.type = 'text/javascript';
s.async = true;
s.src = url;
var options = {
"enabled":true,
"chatButtonSetting":{
"backgroundColor":"#4dc247",
"ctaText":"",
"borderRadius":"25",
"marginLeft":"0",
"marginBottom":"50",
"marginRight":"50",
"position":"right"
},
"brandSetting":{
"brandName":"SİTE ADINIZ",
"brandSubTitle":"DURUM YAZISI",
"brandImg":"https://cdn.clare.ai/wati/images/WATI_logo_square_2.png",
"welcomeText":"Bir sorununuz mu var?",
"messageText":"V-class canlı destek",
"backgroundColor":"#0a5f54",
"ctaText":"GÖRÜŞMEYİ BAŞLAT",
"borderRadius":"25",
"autoShow":false,
"phoneNumber":"+90 551 398 2623"
}
};
s.onload = function() {
CreateWhatsappChatWidget(options);
};
var x = document.getElementsByTagName('script')[0];
x.parentNode.insertBefore(s, x);
</script>
  </body>

<?php
include 'footer.php';
?>
</html>
