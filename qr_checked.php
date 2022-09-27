<?php

if(isset($_POST["token"])){
    

    $token = $_POST["token"];



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


    $query_token = $db->prepare("SELECT token, seed FROM tokens WHERE token = ?");
    $query_token->execute([$token]);


    if($query_token->rowCount() === 1){

        $result_token = $query_token->fetchObject();

        echo $result_token->seed;



    }else{
        echo "invalid_token";
    }




}catch(PDOException $e){

    print '<script>console.log(`' . trim($e->getMessage()) . '`)</script>';

}


}


$db = null;