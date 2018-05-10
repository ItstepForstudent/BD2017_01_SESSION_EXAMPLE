<?php
function action_index(){
    //core_loadModel("humans");
    //$humans = model_humans_getAll();
    //core_render("main",["humans"=>$humans,"title"=>"My site::Главная"]);
    core_render("main",["title"=>"My site::Главная"]);
}

function action_reg(){
    if(is_empty(@$_POST["login"],@$_POST["pass"]) || !auth_register($_POST["login"],$_POST["pass"])){
        echo "Произошла ошибка регистрации";
    }else{
        header("Location:/02_SESSION_AUTH");
    }
}

function action_register(){
    core_render("register",["title"=>"My site::Регистрация"]);
}
function action_login(){
    if(is_empty(@$_POST["login"],@$_POST["pass"]) || !auth_login($_POST["login"],$_POST["pass"])){
        echo "Произошла ошибка авторизации";
    }else{
        header("Location:/02_SESSION_AUTH");
    }
}

function action_logout(){
    auth_logout();
    header("Location:/02_SESSION_AUTH");
}