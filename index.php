<meta name="viewport" content="width=device-width, initial-scale=1.0">
<?php

foreach (glob("*") as $barcode) {

    if (strstr($barcode, "qr_code_")) {

        unlink($barcode);
    }
}




$getToken = @$_GET["token"];
$d = date('d');
$m = date('m');
$Y = date('Y');
date_default_timezone_set("Europe/Istanbul");


$domain = $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER["HTTP_HOST"];
$url = $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER["HTTP_HOST"] . $_SERVER['REQUEST_URI'];


if ($getToken === null) {
    $token = bin2hex(random_bytes(23));
    $apiUrl = "https://qr.mevlutcelik.com/?token=$token";


    if (!file_exists(__DIR__ . "/tokens")) {
        mkdir("tokens", 0777, true);
    }


    if (file_exists(__DIR__ . "/tokens/" . $d . "_" . $m . "_" . $Y . ".txt")) {

        $file = fopen("tokens/" . $d . "_" . $m . "_" . $Y . ".txt", "a");
        fwrite($file, "\n" . $token);
        fclose($file);
    } else {


        file_put_contents(__DIR__ . "/tokens/" . $d . "_" . $m . "_" . $Y . ".txt", $token);
    }



    require __DIR__ . "/barcode_qr.php";


    $qrCode = new BarcodeQR();
    $qrCode->url($apiUrl);

    $randName = md5(rand(1000000, 9999999));

    $imageName = "qr_code_" . $randName . ".png";
    $qrCode->draw(350, $imageName);
?>



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
        .footer,
        .whats-button {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .button {
            font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
            background: #1a73e8;
            border: none;
            outline: none;
            height: 3rem;
            width: fit-content;
            padding: 0 1.5rem;
            margin: 1rem 0 -1rem;
            z-index: 2;
            display: flex;
            align-items: center;
            text-decoration: none;
            justify-content: center;
            border-radius: 0.5rem;
            font-size: 13px;
            font-weight: 500;
            color: #fff;
            cursor: pointer;
            transition: all 0.3s;
            box-shadow: rgba(0, 0, 0, 0.1) 0px 10px 15px -3px, rgba(0, 0, 0, 0.05) 0px 4px 6px -2px;
        }
    </style>




    <div id="app">


        <div class="title">

            <h1>Muş Alparslan Üniversitesi</h1>
            <h2>Uygulamalı Bilimler Fakültesi</h2>
            <h3>Bilişim Sistemleri ve Teknolojileri</h3>

            <br /><br />
            <h1>Yoklama Sistemi</h1>
            <h4>Yoklamada var olduğunuzun bildirilmesi için<br />lütfen aşağıda yer alan QR Code'u okutunuz.</h4>

        </div>

        <div class="whats-button">
            <a class="button" href="<?= $domain ?>/whats_user.php" target="_blank">Kimler burada?</a>
        </div>

        <div class="qr-box">
            <img width="350" src="<?= $domain . "/" . $imageName ?>" alt="QR Code">
        </div>


        <div class="footer">

            <small>&copy;
                <?= date("Y"); ?> Mevlüt Çelik - Tüm Hakları Saklıdır.
            </small>

        </div>


    </div>





<?php

} else {

?>
    <style>
        .modal {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.4);
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-align: center;
            -ms-flex-align: center;
            align-items: center;
            -webkit-box-pack: center;
            -ms-flex-pack: center;
            justify-content: center;
            z-index: 3;
            font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
        }

        .modal-content {
            background: #fff;
            color: #000;
            padding: 1.5rem;
            border-radius: 0.5rem;
            font-size: 16px;
            font-weight: 500;
        }
    </style>
    <?php


    if (file_exists(__DIR__ . "/tokens/" . $d . "_" . $m . "_" . $Y . ".txt")) {
        $dosya = fopen("tokens/" . $d . "_" . $m . "_" . $Y . ".txt", "r");
        $x = explode("\n", fread($dosya, filesize("tokens/" . $d . "_" . $m . "_" . $Y . ".txt")));

        if (!in_array($getToken, $x)) {
            echo "Geçersiz Token!";
        } else {

            $fingerprint = md5(@$_SERVER["HTTP_USER_AGENT"] .@$_SERVER["PATH"]);
            // echo $fingerprint;
            // print_r($_SERVER);

            if (file_exists(__DIR__ . "/fingerprints/" . $fingerprint . ".json")) {

                $dosya = fopen("fingerprints/" . $fingerprint . ".json", "r");
                $json = json_decode(fread($dosya, filesize("fingerprints/" . $fingerprint . ".json")));

                if(!file_exists(__DIR__ . "/logs")){
                    mkdir("logs", 0777, true);
                }

                if (file_exists(__DIR__ . "/logs/" . $d . "_" . $m . "_" . $Y . ".txt")) {

                    $file = fopen("logs/" . $d . "_" . $m . "_" . $Y . ".txt", "a");
                    fwrite($file, "\n" . $json->name . " " . $json->surname);
                    fclose($file);
                } else {
            
            
                    file_put_contents(__DIR__ . "/logs/" . $d . "_" . $m . "_" . $Y . ".txt", $json->name . " " . $json->surname);
                }

    ?>
                <div class="modal">
                    <div class="modal-content">Hoşgeldin <?= $json->name ?> 🎉</div>
                </div>
            <?php
            } else {




            ?>


                <style>
                    * {
                        font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
                    }

                    body {
                        margin-bottom: 4rem;
                    }

                    h1,
                    h2,
                    h3,
                    h4,
                    p {
                        margin: 0;
                        line-height: 1.25;
                        text-align: center;
                    }

                    h1 {
                        margin-top: 4rem;
                    }

                    form {
                        display: flex;
                        flex-direction: column;
                        align-items: center;
                        width: 30rem;
                        max-width: 90%;
                        margin: 4rem auto;
                    }

                    input {
                        background: #fff;
                        height: 3rem;
                        border-radius: 0.5rem;
                        margin-bottom: 2rem;
                        border: 1px solid rgba(0, 0, 0, 0.15);
                        outline: none;
                        box-shadow: rgba(0, 0, 0, 0.1) 0px 10px 15px -3px, rgba(0, 0, 0, 0.05) 0px 4px 6px -2px;
                        font-size: 13px;
                        font-weight: 500;
                        padding: 0 1rem;
                        width: 100%;
                    }

                    button {
                        background: #1a73e8;
                        border: none;
                        outline: none;
                        height: 3rem;
                        width: fit-content;
                        padding: 0 1.5rem;
                        border-radius: 0.5rem;
                        font-size: 13px;
                        font-weight: 500;
                        color: #fff;
                        cursor: pointer;
                        transition: all 0.3s;
                        box-shadow: rgba(0, 0, 0, 0.1) 0px 10px 15px -3px, rgba(0, 0, 0, 0.05) 0px 4px 6px -2px;
                    }

                    button:disabled {
                        opacity: 0.45;
                        pointer-events: none;
                    }
                </style>

                <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.7/jquery.inputmask.min.js"></script>

                <h1>Muş Alparslan Üniversitesi</h1>
                <h2>Uygulamalı Bilimler Fakültesi</h2>
                <h3>Bilişim Sistemleri ve Teknolojileri</h3>

                <br><br>
                <h4>Yoklama Sistemine Öğrenci Kayıt İşlemi</h4>
                <p>Bu ekranı ilk defa kayıt yaptırdığınız zaman göreceksiniz. Daha sonraki girişlerinizde bu ekranı görmeyeceksiniz.
                </p>
                <?php
                if (isset($_POST["qr_save"])) {

                    $student_id = @$_POST["student_id"];
                    $tc_no = @$_POST["tc_no"];
                    $name = @$_POST["name"];
                    $surname = @$_POST["surname"];
                    $phone = @$_POST["phone"];
                    $email = @$_POST["email"];

                    $userDetail = [
                        "student_id" => $student_id,
                        "tc_no" => $tc_no,
                        "name" => $name,
                        "surname" => $surname,
                        "phone" => $phone,
                        "email" => $email,
                    ];

                    if (!file_exists(__DIR__ . "/fingerprints")) {
                        mkdir("fingerprints", 0777, true);
                    }
                    $save = file_put_contents(__DIR__ . "/fingerprints/" . $fingerprint . ".json", json_encode($userDetail));
                    if ($save) {
                        if(!file_exists(__DIR__ . "/logs")){
                            mkdir("logs", 0777, true);
                        }
        
                        if (file_exists(__DIR__ . "/logs/" . $d . "_" . $m . "_" . $Y . ".txt")) {
        
                            $file = fopen("logs/" . $d . "_" . $m . "_" . $Y . ".txt", "a");
                            fwrite($file, "\n" . $name . " " . $surname);
                            fclose($file);
                        } else {
                    
                    
                            file_put_contents(__DIR__ . "/logs/" . $d . "_" . $m . "_" . $Y . ".txt", $name . " " . $surname);
                        }
                ?>
                        <div class="modal">
                            <div class="modal-content">Hoşgeldin <?= ucfirst($name); ?> 🎉</div>
                        </div>
                <?php
                    }
                }
                ?>
                <form id="student_login" action="<?= $url ?>" method="POST" autocomplete="off">
                    <input type="text" inputmode="numeric" name="student_id" id="student_id" placeholder="Öğrenci No" />
                    <input type="text" inputmode="numeric" name="tc_no" id="tc_no" placeholder="TC Kimlik No" />
                    <input type="text" name="name" id="name" placeholder="Ad" />
                    <input type="text" name="surname" id="surname" placeholder="Soyad" />
                    <input type="tel" inputmode="tel" name="phone" id="phone" placeholder="Telefon" />
                    <input type="email" name="email" id="email" placeholder="E-Posta adresi" />
                    <button name="qr_save" type="submit">Kaydet</button>
                </form>
                <script>
                    $(document).ready(function() {
                        $('#student_id').inputmask("999999999");
                        $('#tc_no').inputmask("99999999999");
                        $('#phone').inputmask("0 (999) 999 99 99");
                    });
                </script>


<?php
            }
        }

        fclose($dosya);
    }
}
