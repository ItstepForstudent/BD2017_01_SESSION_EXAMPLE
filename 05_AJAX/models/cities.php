<?php
function model_cities_add(string $name,int $cid):void{
    core_appendToArrayInFile("cities",[
        "id"=>time(),
        "name"=>$name,
        "country_id"=>$cid
    ]);
}


function model_cities_getAll():array {
    return core_loadArrayFromFile("cities");
}


function model_cities_getById(int $id){
    $humans = model_cities_getAll();
    foreach ($humans as $human){
        if($human["id"]==$id)return $human;
    }
    return NULL;
}

function model_cities_getByCountryId(int $id){
    $humans = model_cities_getAll();
    $res=[];
    foreach ($humans as $human){
        if($human["country_id"]==$id)$res[]=$human;
    }
    return $res;
}


function model_cities_deleteById(int $id):void{
    $humans = model_cities_getAll();
    $res = [];
    foreach ($humans as $human){
        if ($human["id"]!=$id) $res[]= $human;
    }
    core_saveArrayToFile("cities",$res);
}