<?php
    include 'ayar.php';
    include 'func.php';

    $link= @$_GET["link"];

    $data=$db->prepare("SELECT * FROM yaziler WHERE yazi_link=?");
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
                <a href="yazi.php?link=<?php echo $link; ?>" class="link mt-5 "><h1 class="text-center  link-underline-opacity-0" >
                <strong><?php echo $_data ["yazi_baslik"]; ?></strong></h1></a>
                <br><br>
                <center><iframe  width="700" height="1000" src="<?php echo $_data ["yazi_pdf"]; ?>" alt=""></iframe></center>
                <center><a href="<?php echo $_data ["yazi_pdf"]; ?>" target="_blank" >Pdf Yeni Sekmede Açmak İçin </a></center>
                <br><br><br><br>
                <center><iframe  width="700" height="420" src="<?php echo $_data ["yazi_video"]; ?>"  title="YouTube video player" frameborder="0" 
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" 
                allowfullscreen></iframe></center>                   
                

            </div>
        </div>
    </div>

   
    <?php
         include 'yorum.php';
   ?>
    </body>
</html>
