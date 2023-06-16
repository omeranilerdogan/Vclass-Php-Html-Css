<?php
    if( empty(session_id()) && !headers_sent())
    {
        session_start();
    }
    include 'ayar.php';
    include 'func.php';

    $link= @$_GET["link"];

    $data=$db->prepare("SELECT * FROM sorular WHERE soru_link=?");
    $data->execute([
        $link

    ]);

    $_data = $data->fetch(PDO::FETCH_ASSOC);
    
    include 'header.php';



?>

<html>
<head>
<meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?php echo $_data ["yazi_baslik"]; ?></title>
    <link rel="stylesheet" href="css/all.min.css" />
    <link rel="stylesheet" href="css/normalize.css" />
    <link rel="stylesheet" href="css/bootstrap-grid.min.css" />
    <link rel="stylesheet" href="css/bootstrap-reboot.min.css" />
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <link rel="stylesheet" href="css/style.css" />
</head>
    <body style="text-decoration:none">
    <div class="container  ">
        <div class="row ">
            <div class="col-lg-12 mt-5 mb-5 ">
                <br><br><br>
                <a href="sorucevap.php?link=<?php echo $link; ?>" class="link mt-5 "><h1 class="text-center  link-underline-opacity-0" >
                <strong><?php echo $_data ["soru_baslik"]; ?></strong></h1></a>
                <br><br><br><br>                  
                <center> <p><?php echo $_data ["soru_aciklama"]; ?></p></center>
            </div>
        </div>
    </div>


    <?php
   include 'yorum2.php';
   ?>
    </body>
</html>
