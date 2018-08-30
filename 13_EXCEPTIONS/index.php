<?php


set_error_handler(function ($eerno,$errstr,$errfile,$errline){
    if(!error_reporting()) return;
    throw new ErrorException($errstr,$eerno,0,$errfile,$errline);
});


try {
    $x = file_get_contents("a");
}catch (Exception $e){
    echo "file not found";
    $e->getMessage();
    $e->getCode();
    $e->getFile();
    $e->getLine();


    foreach ($e->getTrace() as $x){
        echo "<li> in function ".$x['function']." on line ".@$x['args'][1];
    }
    echo "<pre>";
}

