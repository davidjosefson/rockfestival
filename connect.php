<?php
define('DB_NAME', 'testDB');
define('DB_USER', 'root');
define('DB_PASSWORD', 'root'); 
define('DB_HOST', 'localhost');

/*
$link = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD);

mysql_set_charset('utf8',$link);

if(!$link)
    die('Kunde inte konnekta! Error: ' . mysql_error());

$db_selected = mysql_select_db(DB_NAME, $link);

if(!$db_selected)
        die('Kunde inte konnekta till databas ' . DB_NAME . " : " . mysql_error());*/

//PDO
try {
    $DBH = new PDO("mysql:host=".DB_HOST."; dbname=".DB_NAME."; charset=utf8mb4", DB_USER, DB_PASSWORD);
    $DBH->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

}
catch (PDOException $e) {
    echo "Ajajdå.. ", $e->getMessage();
}

//$STH = $DBH->query('SELECT * FROM Funktionar');    

header('Content-Type: text/html; charset=UTF-8');
setlocale(LC_ALL, 'sv_SE.UTF-8', 'sve');  


?>