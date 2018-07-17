<?php
require "functions.php";

if(empty($_POST["name"])){
    die("Error params");
}
insertNote($_POST["name"]);
header("Location:".$_SERVER["HTTP_REFERER"]);