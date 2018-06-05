<?php
function model_countries_add(string $name):void{
    core_appendToArrayInFile("countries",[
        "id"=>time(),
        "name"=>$name
    ]);
}


function model_countries_getAll():array {
    return core_loadArrayFromFile("countries");
}


function model_countries_getById(int $id){
    $humans = model_countries_getAll();
    foreach ($humans as $human){
        if($human["id"]==$id)return $human;
    }
    return NULL;
}


function model_countries_deleteById(int $id):void{
    $humans = model_countries_getAll();
    $res = [];
    foreach ($humans as $human){
        if ($human["id"]!=$id) $res[]= $human;
    }
    core_saveArrayToFile("countries",$res);
}