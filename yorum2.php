<?php
    if( empty(session_id()) && !headers_sent())
    {
        session_start();
    }
    include 'ayar.php';
    include 'ukas.php';
    include_once 'func.php';

    $link= @$_GET["link"];

    $data=$db->prepare("SELECT * FROM sorular WHERE soru_link=?");
    $data->execute([
        $link

    ]);

    $_data = $data->fetch(PDO::FETCH_ASSOC);
    error_reporting(0);

?>
    


    <?php
       if (@$_SESSION["uye_id"]!=0) {
        #üye olanlar görebilir
        
        if ($_POST) {
            
            $yorum=$_POST["yorum"];//yorum ne
        

            $dataAdd = $db -> prepare("INSERT INTO yorumlar SET
                y_uye_id=?,
                y_soru_id=?,
                yorum=?
            ");
            $dataAdd -> execute([
                $_SESSION["uye_id"],
                $_data["soru_id"],
                $yorum
            ]);

            if ( $dataAdd ) {


                $yorumcek = $db -> prepare("SELECT * FROM yorumlar WHERE
                    y_uye_id=?
                    &&y_soru_id=?

                    ORDER BY y_id DESC
                ");
                $yorumcek -> execute([
                    $_SESSION["uye_id"],
                    $_data["soru_id"]
                ]);
                $_yorumcek = $yorumcek -> fetch(PDO::FETCH_ASSOC);

                //echo '<p class="alert alert-success">Successfully added. :)</p>';
                
                header("REFRESH:1; URL=sorucevap.php?link=" . $link . "#yorum" . $_yorumcek["y_id"]);
            } else {
                echo '<p class="alert alert-danger">Oops, you encountered an error while adding it. Please try again. :/</p>';
                
                header("REFRESH:1;URL=index.php" );
            }

            
        }


        echo'<center><hr class="container col-6"><h4>Yorum Yap</h4><hr class="container col-6">

            <form action="" method="post">
            <div class="form-group container col-6">
            <div class="input-group mb-2">
                <div class="input-group-prepend">
                    <div class="input-group-text">
                        <i class="fa fa-comment text-info"></i>
                        </div>
                            </div>
                                <textarea class="form-control" name="yorum" placeholder="Lütfen Mesajınızı Buraya Yazın.." rows="6" required></textarea>
                            </div>
                        </div>
                    <div class="text-center">
                    <input type="submit" value="gönder" class="btn btn-info btn-block">
                    </form>
                    </center>
        
        ';
        
       }


       else {
        # üye olmayanlar görür

        echo' <center>Yorum yapabilmek için<a href="uyelik.php"> Giriş yap </a>yada<a href="uyelik.php?p=kayit"> Kayıt ol </a></center>';
       }
       
    ?>
<center>
    <hr class="container col-6">
<strong>
<h3>Yorumlar</h3>
</strong>
<hr class="container col-6">
</center>

<?php

$dataList = $db -> prepare ("SELECT * FROM yorumlar where y_soru_id=?");
$dataList->execute([
    $_data["soru_id"]
]);
$dataList = $dataList ->fetchALL (PDO::FETCH_ASSOC);

foreach($dataList as $row){
    echo '<div class="container col-6">
        <a href="profil.php?kadi='.uye_ID_den_kadi ($row["y_uye_id"]).'" id="yorum'.$row["y_id"].'">
            <center><strong>
             '.uye_ID_den_kadi  ($row["y_uye_id"]).'
            </center></strong>
        </a><br>
            <center><p>
             '.$row["yorum"].'
            </center></p>
        <small><b>Tarih:</b> '.$row["y_tarih"]. '</small>
        <hr></div>';
    }
?>