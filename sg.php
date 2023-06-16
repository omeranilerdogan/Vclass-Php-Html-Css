<?php

if( empty(session_id()) && !headers_sent())
{
    session_start();
}
    include 'ayar.php';
    include 'func.php';

    
   
?>


<!DOCTYPE html>
<html lang="tr">
  <head>
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/iconic/css/material-design-iconic-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
<!--===============================================================================================-->

	<title>Şİfre Değişme Paneli</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!--===============================================================================================-->
  </head>
  <body>
    <?php
    // include 'header.php';
    ?>
              <?php
                 $id=$_SESSION['uye_id'];
                 if($_POST){
                    $ad=$_POST["username"];
                    $sifre=md5(sha1($_POST["password"]));
  
  
                    // bosluk kont
                    if( empty($ad) || empty($sifre)){
                      echo '<p class="alert alert-warning">Lütfen boş bırakmayınız!</p>';
                    }
  
                    else{
                      //eğr boş değilise
                      
                      $veriguncelle = $db -> prepare(" UPDATE uyeler SET
                      uye_kadi=?,
                      uye_sifre=?

                      WHERE uye_id=?
                         ");
                  $veriguncelle -> execute([
                      $ad,
                      $sifre,
                      $id
                      
                  ]);
                  
                  if ( $veriguncelle ) {
                      echo '<p class="alert alert-success">Yazı başarı ile eklendi :)</p>';
                      header("REFRESH:1;URL=index.php ");
                    } 
                  else {
                      echo '<p class="alert alert-danger">Tekrar Deneyiniz yazı Eklenmedi :/</p>';
                      header("REFRESH:1;URL=profil.php");
                  }
                    }
  
                  }
                
              ?>
              <div class="limiter">
		        <div class="container-login100" style="background-image: url('images/bg-01.jpg');">
			        <div class="wrap-login100 p-l-55 p-r-55 p-t-65 p-b-54">
                          <form class="login100-form validate-form"method="POST">
                            <span class="login100-form-title p-b-49">
                            V-CLASS	Şifre Değiş
                            </span>
                            <input type="hidden" name="uyeid" value="<?=$_SESSION['uye_id']?>">
                            <div class="wrap-input100 validate-input m-b-23" data-validate = "kullanıcı adı gerekli">
                                <span class="label-input100">Kullanıcı Adı</span>
                                <input class="input100" type="text" name="username" placeholder="Kullanıcı adını giriniz...">
                                <span class="focus-input100" data-symbol="&#xf206;"></span>
                            </div>

                            <div class="wrap-input100 validate-input" data-validate="Şifre gereklidir">
                                <span class="label-input100">Şifre</span>
                                <input class="input100" type="password" name="password" placeholder="Şifrenizi giriniz...">
                                <span class="focus-input100" data-symbol="&#xf190;"></span>
                            </div>
                            
                            
                            <div class="container-login100-form-btn">
                                <div class="wrap-login100-form-btn">
                                    <div class="login100-form-bgbtn"></div>
                                    <button class="login100-form-btn" href="profil.php" name="sdegis">
                                        Şifreni Değiş
                                    </button>
                                </div>
                            </div>
                          </form>            
                        </div>
                    </div>
                </div>    
           


    <div id="dropDownSelect1"></div>
	
    <!--===============================================================================================-->
        <script src="vendor/jquery/jquery-3.2.1.min.js"></script>
    <!--===============================================================================================-->
        <script src="vendor/animsition/js/animsition.min.js"></script>
    <!--===============================================================================================-->
        <script src="vendor/bootstrap/js/popper.js"></script>
        <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
    <!--===============================================================================================-->
        <script src="vendor/select2/select2.min.js"></script>
    <!--===============================================================================================-->
        <script src="vendor/daterangepicker/moment.min.js"></script>
        <script src="vendor/daterangepicker/daterangepicker.js"></script>
    <!--===============================================================================================-->
        <script src="vendor/countdowntime/countdowntime.js"></script>
    <!--===============================================================================================-->
        <script src="js/main.js"></script>
  </body>
</html>

