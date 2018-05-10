<?php
/*--------------- example 1 -------------------*/
function example1(){
    include "mysession.php";
    sessionRun();
    sessionSet("name","vasia");
    echo sessionGet("name");
}


/*------------------------example 2 -------------------*/
function example2(){
    session_start();
    //$_SESSION["name"]="petia";
    echo $_SESSION["name"];
    //session_destroy();
}

example2();