<?php

$domain = $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER["HTTP_HOST"];
$url = $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER["HTTP_HOST"] . $_SERVER['REQUEST_URI'];

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



    <title>Muş Alparslan Üniversitesi Bilişim Sistemleri ve Teknolojileri Yoklama Sistemi</title>
    <meta name="description" content="Muş, Alparslan Üniversitesi, Bilişim Sistemleri ve Teknolojileri" />
    <meta name="keywords" content="Muş, Alparslan Üniversitesi, Bilişim Sistemleri ve Teknolojileri" />



    <meta name="theme-color" content="#1A73E8" />
    <meta name="msapplication-TileColor" content="#1A73E8" />



    <link rel="canonical" href="<?= $url ?>" />



    <!-- <meta name="msapplication-TileImage" content="localhost/icon.png" /> -->
    <!-- <link rel="icon" type="png/image" href="localhost/icon.png" sizes="32x32" /> -->
    
    
    
    <link rel="stylesheet" href="<?= $domain ?>/css/style.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Zilla+Slab:wght@600&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500&display=swap" rel="stylesheet">



</head>



<body>



    <div id="app">



        <div class="left-bar">

            <div class="logo">
            
                <div style="display: flex;flex-direction:column;">
                    <span style="font-size:28px;font-family: 'Zilla Slab', serif;">Muş Alparslan Üniversitesi</span>
                    <span style="font-size:18px;font-family: 'Zilla Slab', serif;">Uygulamalı Bilimler Fakültesi</span>
                    <span style="font-size:14px;font-family: 'Zilla Slab', serif;">Bilişim Sistemleri ve Teknolojileri</span>
                </div>
            
            </div>



            <div class="left-text">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Blanditiis libero dolor aut perspiciatis ea dolores cumque alias, enim tempore fuga voluptate vel est neque iure necessitatibus a mollitia sint molestiae?</div>



        </div>



        <div class="right-bar">

            right

        </div>



    </div>



</body>
</html>