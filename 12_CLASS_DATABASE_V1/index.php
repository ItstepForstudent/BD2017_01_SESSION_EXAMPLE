<?php
const DB_CONFIG = [
    "host" => "127.0.0.1",
    "dbname" => "demo",
    "user" => "root",
    "pass" => "0000",
    "charset" => "utf8"
];


$dsn = "mysql:host=" . DB_CONFIG["host"]
    . ";dbname=" . DB_CONFIG["dbname"]
    . ";charset=" . DB_CONFIG["charset"];
$dbh = new PDO($dsn, DB_CONFIG["user"], DB_CONFIG["pass"], [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
]);


//$stmt = $dbh->prepare("INSERT INTO `users` (`name`,`pass`) VALUES (:n,:psw)");
//$stmt->execute([
//    "n"=>"vasia3",
//    "psw"=>"5555"
//]);
//$stmt->execute([
//    "n"=>"vasia3",
//    "psw"=>"5555"
//]);

$stmt = $dbh->prepare("SELECT * FROM users WHERE `name` = ?");
$stmt->execute(["vasia3"]);
$result = $stmt->fetchAll();
foreach ($result as $user){
    echo "<div>{$user['name']} {$user['pass']}</div>";
}