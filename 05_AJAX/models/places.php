<?php
function model_places_add(string $name,int $cid):void{
    core_appendToArrayInFile("places",[
        "id"=>time(),
        "name"=>$name,
        "city_id"=>$cid
    ]);
}


function model_places_getAll():array {
    return core_loadArrayFromFile("places");
}


function model_places_getById(int $id){
    $humans = model_places_getAll();
    foreach ($humans as $human){
        if($human["id"]==$id)return $human;
    }
    return NULL;
}

function model_places_getByCityId(int $id){
    $humans = model_places_getAll();
    $res=[];
    foreach ($humans as $human){
        if($human["city_id"]==$id)$res[]=$human;
    }
    return $res;
}


function model_places_deleteById(int $id):void{
    $humans = model_places_getAll();
    $res = [];
    foreach ($humans as $human){
        if ($human["id"]!=$id) $res[]= $human;
    }
    core_saveArrayToFile("places",$res);
}