<?php
define('DB_NAME', 'Rockfestival');
define('DB_USER', 'root');
define('DB_PASSWORD', 'root'); 
define('DB_HOST', 'localhost');

//PDO
try {
    $DBH = new PDO("mysql:host=".DB_HOST."; dbname=".DB_NAME."; charset=utf8mb4", DB_USER, DB_PASSWORD);
    $DBH->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

}
catch (PDOException $e) {
    echo "Ajajdå.. ", $e->getMessage();
}

header('Content-Type: text/html; charset=UTF-8');
setlocale(LC_ALL, 'sv_SE.UTF-8', 'sve');  


?>