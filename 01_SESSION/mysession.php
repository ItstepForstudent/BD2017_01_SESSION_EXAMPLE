<?php
define("SESSION_COOKIE","SESID");
define("SESSION_PATH",__DIR__."/sessions/");
$_SESSION_STARTED=false;
$_SESSION_FILE=null;

function sessionRun(){
    $GLOBALS["_SESSION_STARTED"]=true;
    if(!empty($_COOKIE[SESSION_COOKIE]) && file_exists(SESSION_PATH.$_COOKIE[SESSION_COOKIE].".json")) {
        $GLOBALS["_SESSION_FILE"]=SESSION_PATH.$_COOKIE[SESSION_COOKIE].".json";
        return;
    }
    $name = time()."_".rand(100000,999999);
    $GLOBALS["_SESSION_FILE"]=SESSION_PATH.$name.".json";
    file_put_contents(SESSION_PATH.$name.".json","[]");
    setcookie(SESSION_COOKIE,$name,0,"/");
}

function __loadSessionFromFile(){
    return json_decode(file_get_contents($GLOBALS["_SESSION_FILE"]),true);
}
function __saveSessionToFile($session){
    file_put_contents($GLOBALS["_SESSION_FILE"],json_encode($session));
}

function sessionGet($key){
    if(! $GLOBALS["_SESSION_STARTED"]) return NULL;
    return __loadSessionFromFile()[$key];
}
function sessionSet($key,$value){
    if(! $GLOBALS["_SESSION_STARTED"]) return;
    $arr = __loadSessionFromFile();
    $arr[$key]=$value;
    __saveSessionToFile($arr);
}
function sessionIsset($key){
    if(! $GLOBALS["_SESSION_STARTED"]) return false;
    $arr = __loadSessionFromFile();
    return isset($arr[$key]);
}

function sessionDestroy(){
    if(! $GLOBALS["_SESSION_STARTED"]) sessionRun();
    unlink( $GLOBALS["_SESSION_FILE"]);
    setcookie(SESSION_COOKIE,"",time()-1,"/");
    $GLOBALS["_SESSION_STARTED"]=false;
}
