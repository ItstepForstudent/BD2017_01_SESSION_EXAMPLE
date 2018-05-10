<?php

function core_getData(string $name):array {
    return include DATA_PATH.$name.".php";

}

function core_saveArrayToFile(string $name, array $arr):void{
    $jstr = json_encode($arr);
    $path = STORAGE_PATH."{$name}.json";
    file_put_contents($path,$jstr);
};

function core_loadArrayFromFile(string $name):array {
    $path = STORAGE_PATH."{$name}.json";
    if(!file_exists($path))return[];
    $data = file_get_contents($path);
    return json_decode($data,true);
};

function core_appendToArrayInFile(string $name, $data):void{
    $arr = core_loadArrayFromFile($name);
    $arr[] = $data;
    core_saveArrayToFile($name,$arr);
};

function core_removeFromArrayInFile(string $name, int $index):void{
    $arr = core_loadArrayFromFile($name);
    array_splice($arr,$index);
    core_saveArrayToFile($name,$arr);
};

function core_render(string $view, array $data=[], string $templates="default"):void {       //шаблонизировать
    $content = VIEWS_PATH.$view.".php";
    extract($data);
    include TEMPLATES_PATH.$templates.".php";
}

function core_loadModel(string $name):void{
  include MODELS_PATH.$name.".php";
}

function is_empty():bool {
    foreach (func_get_args() as $arg) if(empty($arg)) return true;
    return false;
}


function core_navigate():void{
    $routes = core_getData("routes");
    $url = trim(explode("?",$_SERVER["REQUEST_URI"])[0],"/");
    $prefix = "02_SESSION_AUTH/";
    foreach ($routes as $route=>$command){
        if (trim($prefix.$route,"/")==$url){
            $cmd = explode("@",$command);
            $controller_name = "controller_".$cmd[0];
            $action_name = "action_".$cmd[1];
            if(!file_exists(CONTROLLERS_PATH.$controller_name.".php")) break;
            include_once CONTROLLERS_PATH.$controller_name.".php";
            if(!function_exists($action_name)) break;
            call_user_func($action_name);
            return;
        }
    }
    echo "404";
}