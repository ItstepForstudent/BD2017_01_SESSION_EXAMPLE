<?php
function action_index(){
    //core_loadModel("humans");
    //$humans = model_humans_getAll();
    //core_render("main",["humans"=>$humans,"title"=>"My site::Главная"]);
    core_render("main",["title"=>"My site::Главная"]);
}