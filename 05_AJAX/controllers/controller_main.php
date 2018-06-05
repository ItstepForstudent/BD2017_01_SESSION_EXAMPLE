<?php
function action_index(){
    //core_loadModel("humans");
    //$humans = model_humans_getAll();
    //core_render("main",["humans"=>$humans,"title"=>"My site::Главная"]);
    return core_render("main",["title"=>"My site::Главная"]);
}
function action_addCountry(){
    $name = @$_POST["name"];
    if(empty($name))return "no";
    core_loadModel("countries");
    model_countries_add($name);
    return "yes";
}
function action_getCountries(){
    core_loadModel("countries");
    $c = model_countries_getAll();
    return json_encode($c);
}
function action_addCity(){
    $name = @$_POST["name"];
    $cid = @$_POST["country_id"];
    if(empty($name)||empty($cid))return "no";
    core_loadModel("cities");
    model_cities_add($name,(int)$cid);
    return "yes";
}
function action_getCities(){
    core_loadModel("cities");
    $cid = @$_POST["country_id"];
    if(empty($cid)) return "[]";
    $c = model_cities_getByCountryId((int)$cid);
    return json_encode($c);
}
function action_addPlace(){
    $name = @$_POST["name"];
    $cid = @$_POST["city_id"];
    if(empty($name)||empty($cid))return "no";
    core_loadModel("places");
    model_places_add($name,(int)$cid);
    return "yes";
}