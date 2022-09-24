<?php


foreach(glob("*") as $barcode){

    if(strstr($barcode, "qr_code_")){

        unlink($barcode);

    }


}