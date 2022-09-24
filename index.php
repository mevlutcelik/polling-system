<?php


require __DIR__ . "/delete_barcode.php";

$domain = $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER["HTTP_HOST"];
$url = $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER["HTTP_HOST"] . $_SERVER['REQUEST_URI'];


$token = bin2hex(random_bytes(23));
$apiUrl = "https://api.mevlutcelik.com/get/?token=$token";


?>
<!DOCTYPE html>
<html lang="tr-TR">



<head>

    <meta charset="UTF-8" />
    

    
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta http-equiv="Content-Language" content="tr" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    
    
    
    <meta name="msapplication-tap-highlight" content="no" />



    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    
    
    
    <meta name="robots" content="index, follow" />
    <meta name="googlebot" content="index, follow" />
    <meta name="revisit-after" content="7 Days" />
    
    
    
    <title>Yoklama Sistemi - Muş Alparslan Üniversitesi | Uygulamalı Bilimler Fakültesi | Bilişim Sistemleri ve Teknolojileri</title>



    <meta name="description" content="Page Description" />
    <meta name="keywords" content="Page Description" />



    <meta name="theme-color" content="#FFFFFF" />
    <meta name="msapplication-TileColor" content="#FFFFFF" />



    <!-- <meta name="msapplication-TileImage" content="localhost/icon.png" />
    <link rel="icon" type="png/image" href="localhost/icon.png" sizes="32x32" /> -->



    <link rel="canonical" href="<?= $url ?>" />



    <style>

        #app{
            padding: 4rem 0;
            display: flex;
            flex-direction: column;
        }


        .title{

            text-align: center;

        }


        .title *{
            margin: 0;
        }


        .qr-box, .footer{
            display: flex;
            align-items: center;
            justify-content: center;
        }

        
    </style>



</head>



<body>


    <div id="app">


        <div class="title">

            <h1>Muş Alparslan Üniversitesi</h1>
            <h2>Uygulamalı Bilimler Fakültesi</h2>
            <h3>Bilişim Sistemleri ve Teknolojileri</h3>

            <br/><br/><h1>Yoklama Sistemi</h1>
            <h4>Yoklamada var olduğunuzun bildirilmesi için<br/>lütfen aşağıda yer alan QR Code'u okutunuz.</h4>

        </div>


        <?php

        require __DIR__ . "/barcode_qr.php";


        $qrCode = new BarcodeQR();
        $qrCode->url($apiUrl);

        $randName = md5(rand(1000000, 9999999));

        $imageName = "qr_code_$randName.png";

        $qrCode->draw(350, $imageName);

        ?>


        <div class="qr-box">
            <img width="350" src="<?= $domain . "/" . $imageName ?>" alt="QR Code">
        </div>


        <div class="footer">
            
            <small>&copy; <?= date("Y"); ?> Mevlüt Çelik - Tüm Hakları Saklıdır.</small>
        
        </div>


    </div>


</body>



</html>