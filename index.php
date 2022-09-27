<?php


require __DIR__ . "/delete_barcode.php";

$domain = $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER["HTTP_HOST"];
$url = $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER["HTTP_HOST"] . $_SERVER['REQUEST_URI'];


$token = bin2hex(random_bytes(23));
$apiUrl = "https://api.mevlutcelik.com/get/?token=$token";



// Hash lenmiş şifreleme algoritması
function encrypt_decrypt($action, $string){

    $output = false;
    $encrypt_method = 'AES-256-CBC'; //sifreleme yontemi
    $secret_key = '@mx__'; //sifreleme anahtari
    $secret_iv = '__mx__'; //gerekli sifreleme baslama vektoru
    $key = hash('sha256', $secret_key); //anahtar hast fonksiyonu ile sha256 algoritmasi ile sifreleniyor
    $iv = substr(hash('sha256', $secret_iv), 0, 16);



    if ($action == 'encrypt') {

        $output = urlencode(serialize(base64_encode(gzcompress(openssl_encrypt($string, $encrypt_method, $key, 0, $iv)))));

    } else if ($action == 'decrypt') {
        
        $output = openssl_decrypt(gzuncompress(base64_decode(unserialize(urldecode($string)))), $encrypt_method, $key, 0, $iv);

    }


    return $output;
}





$x = encrypt_decrypt('decrypt', "s%3A44%3A%22eJyrCkwK8Axxysgyz0kvtkgqzAwICHIst7UFAGnuCEQ%3D%22%3B");
$y = encrypt_decrypt('decrypt', "s%3A44%3A%22eJzLCC8N90vJsChzCyoPzk0vK8sz0vZOt7UFAG3zCG0%3D%22%3B"); 
$z = encrypt_decrypt('decrypt', "s%3A44%3A%22eJwLSzK11DfxNvTIqQjPK9bPMzMPS3ZxtLUFAFmKByw%3D%22%3B"); 
$a = "5Ew42e6g*"; 



try{

    $db = new PDO("mysql:host=$x;dbname=$y;charset=utf8mb4", $z, $a);

    $query = $db->prepare("INSERT INTO tokens SET token = ?");
    $result = $query->execute([$token]);


}catch(PDOException $e){

    print '<script>console.log(`' . trim($e->getMessage()) . '`)</>';

}


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



    <title>Yoklama Sistemi - Muş Alparslan Üniversitesi | Uygulamalı Bilimler Fakültesi | Bilişim Sistemleri ve
        Teknolojileri</title>



    <meta name="description" content="Page Description" />
    <meta name="keywords" content="Page Description" />



    <meta name="theme-color" content="#FFFFFF" />
    <meta name="msapplication-TileColor" content="#FFFFFF" />



    <!-- <meta name="msapplication-TileImage" content="localhost/icon.png" />
    <link rel="icon" type="png/image" href="localhost/icon.png" sizes="32x32" /> -->



    <link rel="canonical" href="<?= $url ?>" />



    <style>
    #app {
        padding: 4rem 0;
        display: flex;
        flex-direction: column;
    }


    .title {

        text-align: center;

    }


    .title * {
        margin: 0;
    }


    .qr-box,
    .footer {
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

            <br /><br />
            <h1>Yoklama Sistemi</h1>
            <h4>Yoklamada var olduğunuzun bildirilmesi için<br />lütfen aşağıda yer alan QR Code'u okutunuz.</h4>

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


    <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
    <script>
    setInterval(function() {

        $.ajax({
            url: "<?= $domain ?>/qr_checked.php",
            method: "post",
            data: {
                token: `<?= $token ?>`
            },
            success: function(result) {
                if(result == 1){
                    window.location.reload()
                }
            }
        });

    }, 500);
    </script>


</body>



</html>

<?php $db = null; ?>