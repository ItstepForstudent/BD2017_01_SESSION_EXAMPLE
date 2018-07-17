<?php
require "functions.php";
if(empty($_GET["id"])) die("INVALID PARAMS");
deleteNote($_GET["id"]);
header("Location:".$_SERVER['HTTP_REFERER']);