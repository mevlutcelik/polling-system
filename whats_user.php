<meta http-equiv="refresh" content="5; URL=<?= $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER["HTTP_HOST"] . $_SERVER['REQUEST_URI'] ?>" />
<h1>Burada Olanlar</h1>
<?php
$d = date('d');
$m = date('m');
$Y = date('Y');
if(!file_exists(__DIR__ . "/logs")){
    mkdir("logs", 0777, true);
}
if(!file_exists(__DIR__ . "/logs/" . $d . "_" . $m . "_" . $Y . ".txt")){
    file_put_contents(__DIR__ . "/logs/" . $d . "_" . $m . "_" . $Y . ".txt", "");
}
$dosya = fopen("logs/" . $d . "_" . $m . "_" . $Y . ".txt", "r");
$x = explode("\n", fread($dosya, filesize("logs/" . $d . "_" . $m . "_" . $Y . ".txt")));
echo "<ul>";
foreach($x as $key => $value){
    echo "<li>". $value ."</li>";
}
echo "</ul>";
?>