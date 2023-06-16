<html>
    <head>
        
	<title>V-Class</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
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

	<title>Kullanıcı Giriş Paneli</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
   
   
<!--===============================================================================================-->
    </head>

    <body style="background-image: url('images/bg-01.jpg');";>
    <?php
          session_start();
          include 'ayar.php';
          include 'ukas.php';
          $p = @$_GET["p"];


        switch ($p) {
           case 'sifremiunuttum':
            if ($_POST) {
                $eposta = htmlspecialchars( $_POST["eposta"] );

                if (
                    empty( $eposta )
                ) {
                    echo '<p class="alert alert-warning">Lütfen boş bırakmayınız!</p>';
                } else {
                    if (filter_var($eposta, FILTER_VALIDATE_EMAIL)){ //  :)
                        $selectRow = $db -> prepare("SELECT * FROM uyeler WHERE
                            uye_eposta =:uye_eposta
                        ");
                        $selectRow -> execute([
                            'uye_eposta' => $eposta
                        ]);
                        $selectRow = $selectRow -> rowCount();
                        
                        if($selectRow > 0){ // Var
                            $yeniSifre  = time() . rand(111,999);
                            $Sifrele    = md5(sha1( $yeniSifre ));

                            $sifreyiGuncelle = $db->prepare("UPDATE uyeler SET uye_sifre=? WHERE uye_eposta=?");
                            $sifreyiGuncelle -> execute([
                                $Sifrele,
                                $eposta
                            ]);

                            if ($sifreyiGuncelle) {





                                require("emailotomasyonu/class.phpmailer.php"); // PHPMailer dosyamizi çagiriyoruz
                                
                                $mailim = "noreply@minik.link";
                                $mail = new PHPMailer(); // Sinifimizi $mail degiskenine atadik
                                $mail->IsSMTP(true);  // Mailimizin SMTP ile gönderilecegini belirtiyoruz
                                $mail->CharSet = 'UTF-8'; //Türkçe yazı karakterleri için CharSet  ayarını bu şekilde yapıyoruz.
                                $mail->From     = $mailim;//"admin@localhost"; //Gönderen kisminda yer alacak e-mail adresi
                                $mail->Sender   = $mailim;//"admin@localhost";//Gönderen Mail adresi
                                //$mail->ReplyTo  = ($mailim);//"admin@localhost";//Tekrar gönderimdeki mail adersi
                                $mail->AddReplyTo=($mailim);//"admin@localhost";//Tekrar gönderimdeki mail adersi
                                $mail->FromName = "Ugur KILCI";//"PHP Mailer";//gönderenin ismi
                                $mail->Host     = "mail.site.com";//"localhost"; //SMTP server adresi
                                $mail->SMTPAuth = true; //SMTP server'a kullanici adi ile baglanilcagini belirtiyoruz
                                $mail->SMTPSecure = false;
                                $mail->SMTPAutoTLS = false;
                                $mail->Port     = 587; //Natro SMPT Mail Portu
                                
                                $mail->Username = "noreply@site.com";//"admin@localhost"; //SMTP kullanici adi
                                $mail->Password = 'şifreniz';//""; //SMTP mailinizin sifresi
                                $mail->WordWrap = 50;
                                $mail->IsHTML(true); //Mailimizin HTML formatinda hazirlanacagini bildiriyoruz.
                                $mail->Subject  = "Başlık";//"Deneme Maili"; // Mailin Konusu Konu
                                //Mailimizin gövdesi: (HTML ile)
                                $body  = '<b>Site adınız:</b><br>Şifreniz yenilendi! Yeni şifreniz: ' . $yeniSifre . '<br><b>Not:</b> Eğer şifrenizi siz güncellemediyseniz lütfen info@site.com adresine eposta gönderiniz!<br><br><b>Tarih:</b> ' . date("m.d.Y") . ' <b>Saat:</b> ' . date("H:i:s");
                                
                                $textBody = $body;
                                $mail->Body = $body;
                                $mail->AltBody = $textBody;
                                $mail->ClearAddresses();
                                $mail->ClearAttachments();
                                
                                // Mail gönderilecek adresleri ekliyoruz. Birden fazla ekleme yapılabilir.
                                $mail->AddBCC( $eposta );
                                
                                $mail->Send();
                                $mail->ClearAddresses();
                                $mail->ClearAttachments();
                                error_reporting(0);
                                echo '<p class="alert alert-success">Şifreniz başarıyla güncellendi! Lütfen eposta adresinizi kontrol ediniz. Yeni şifrenizi oraya gönderdik! :) [NOT: Spam kutunuza da bakmayı unutmayınız!]</p>';


                            } else {
                                echo '<p class="alert alert-danger">Şifreniz güncellenemedi! Lütfen tekrar deneyiniz!</p>';
                            }
                        }else{ // Yok
                            echo '<p class="alert alert-danger">Böyle bir eposta adresi bulunmamaktadır!</p>';
                        }
                    } else { // :(
                        echo '<p class="alert alert-danger">Lütfen gerçek bir eposta adresi yazınız!</p>';
                    }
                }
                
            }
            echo '
            <form action="" method="POST">
            <div class="limiter">
            <div class="container-login100" style="background-image: url("images/bg-01.jpg");">
                <div class="wrap-login100 p-l-55 p-r-55 p-t-65 p-b-54">
                    <form class="login100-form validate-form">
                        <span class="login100-form-title p-b-49">
                        V-CLASS	Şİfremi Unuttum
                        </span>

                        <div class="wrap-input100 validate-input m-b-23" data-validate = "E-Posta">
                            <span class="label-input100">Ad Soyad</span>
                            <input class="input100 class="form-control " type="text" name="eposta" placeholder="E-Posta Giriniz">
                            <span class="focus-input100" data-symbol="&#xf206;"></span>
                        </div>
                        
                        <div class="container-login100-form-btn">
                            <div class="wrap-login100-form-btn">
                                <div class="login100-form-bgbtn"></div>
                                <button class="login100-form-btn" type="submit" href="index.php" name="sifremiunuttum">
                                   Yeni Şifremi Epostama Gönder
                                </button>
                            </div>
                        </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>                
        <div id="dropDownSelect1"></div>';

            break;
            case 'cikis':
                if (@$_SESSION["uye_id"]) {
                    ukas_cikis("index.php");
                }else{
                    header("LOCATION:index.php");
                }
                break;

            case 'kayit':
                if (@$_SESSION["uye_id"]) {
                    header("LOCATION:index.php");
                }else{
                    ukas_kayit("<p class='text-warning'>Lütfen boş bırakmayınız!</p>", "<p class='text-danger'>Böyle bir eposta mevcut! Lütfen başka bir tane deneyiniz!</p>", "<p class='text-warning'>Böyle bir kullanıcı adı mevcut! Lütfen başka bir tane deneyiniz!</p>", "<p class='text-success'>Başarıyla kaydoldun! :)</p>", "index.php", "<p class='text-danger'>Kullanıcı adı veya şifre hatalı!</p>", "<p class='text-danger'>Kayıt başarısız!</p>", "<p>Şifreniz bir birine eşleşmiyor!</p>", "<p>Lütfen gerçek bir eposta giriniz!</p>");
                    echo '
                    <form action="" method="POST">
                    <div class="limiter">
                    <div class="container-login100" style="background-image: url("images/bg-01.jpg");">
                        <div class="wrap-login100 p-l-55 p-r-55 p-t-65 p-b-54">
                            <form class="login100-form validate-form">
                                <span class="login100-form-title p-b-49">
                                V-CLASS	Kayıt
                                </span>

                                <div class="wrap-input100 validate-input m-b-23" data-validate = "Ad Soyad">
                                    <span class="label-input100">Ad Soyad</span>
                                    <input class="input100 class="form-control " type="text" name="adsoyad" placeholder="Ad Soyad  giriniz...">
                                    <span class="focus-input100" data-symbol="&#xf206;"></span>
                                </div>
            
                                <div class="wrap-input100 validate-input m-b-23" data-validate = "kullanıcı adı gerekli">
                                    <span class="label-input100">Kullanıcı Adı</span>
                                    <input class="input100 class="form-control " type="text" name="kadi" placeholder="Kullanıcı adını giriniz...">
                                    <span class="focus-input100" data-symbol="&#xf206;"></span>
                                </div>
            
                                <div class="wrap-input100 validate-input" data-validate="Şifre gereklidir">
                                    <span class="label-input100">Şifre</span>
                                    <input class="input100 class="form-control " type="password" name="sifre" placeholder="Şifrenizi giriniz...">
                                    <span class="focus-input100" data-symbol="&#xf190;"></span>
                                </div>

                                <div class="wrap-input100 validate-input" data-validate="Şifre gereklidir">
                                    <span class="label-input100">Şifre</span>
                                    <input class="input100 class="form-control " type="password" name="sifret" placeholder="Şifrenizi giriniz...">
                                    <span class="focus-input100" data-symbol="&#xf190;"></span>
                                </div>

                                
                                <div class="wrap-input100 validate-input m-b-23" data-validate = "E-posta gerekli">
                                    <span class="label-input100">E-Posta</span>
                                    <input class="input100 class="form-control " type="text" name="eposta" placeholder="E-Posta giriniz...">
                                    <span class="focus-input100" data-symbol="&#xf206;"></span>
                                </div>
                                
                                <div class="container-login100-form-btn">
                                    <div class="wrap-login100-form-btn">
                                        <div class="login100-form-bgbtn"></div>
                                        <button class="login100-form-btn" type="submit" href="index.php" name="kayit">
                                            Kayıt ol
                                        </button>
                                    </div>
                                </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>                
                <div id="dropDownSelect1"></div>';
                }
                break;

            default:
                if (@$_SESSION["uye_id"]) {
                    header("LOCATION:index.php");
                }else{
                    ukas_giris("index.php", "<p class='text-warning'>Lütfen boş bırakmayınız!</p>", "<p class='text-danger'>Kullanıcı adı veya şifre hatalı!</p>");

                    echo '
                    <form action="" method="POST">
                    <div class="limiter">
                    <div class="container-login100" style="background-image: url("images/bg-01.jpg");">
                        <div class="wrap-login100 p-l-55 p-r-55 p-t-65 p-b-54">
                            <form class="login100-form validate-form">
                                <span class="login100-form-title p-b-49">
                                V-CLASS	Giriş
                                </span>
            
                                <div class="wrap-input100 validate-input m-b-23" data-validate = "kullanıcı adı gerekli">
                                    <span class="label-input100">Kullanıcı Adı</span>
                                    <input class="input100 class="form-control " type="text" name="kadi" placeholder="Kullanıcı adını giriniz...">
                                    <span class="focus-input100" data-symbol="&#xf206;"></span>
                                </div>
            
                                <div class="wrap-input100 validate-input" data-validate="Şifre gereklidir">
                                    <span class="label-input100">Şifre</span>
                                    <input class="input100 class="form-control " type="password" name="sifre" placeholder="Şifrenizi giriniz...">
                                    <span class="focus-input100" data-symbol="&#xf190;"></span>
                                </div>
                                
                                <div class="text-right p-t-8 p-b-31">
                                    <a href="uyelik.php?p=sifremiunuttum">
                                        Şifreyi Unuttum
                                    </a>
                                </div>
                                
                                <div class="container-login100-form-btn">
                                    <div class="wrap-login100-form-btn">
                                        <div class="login100-form-bgbtn"></div>
                                        <button class="login100-form-btn" href="index.php" name="giris">
                                            Giriş
                                        </button>
                                    </div>
                                </div><br>


                                <div class="flex-col-c p-t-1"><a href="uyelik.php?p=kayit" class="txt2">
                                Kayıt Ol  </a>
                                </div>
                                </form>
                            </form>
                        </div>
                    </div>
                </div>
                
            
                <div id="dropDownSelect1"></div>';
                    }
                break;
        }
        

      ?>
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

