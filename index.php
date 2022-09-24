<?php

require __DIR__ . "/barcode_qr.php";


$qrCode = new BarcodeQR();
$qrCode->url("https://www.mevlutcelik.com");


$qrCode->draw(250, "qr-code.png");


echo '<img src="qr-code.png">';