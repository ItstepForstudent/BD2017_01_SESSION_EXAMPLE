<?php

function libs_routes_page_main():void{
    core_loadModel("humans");
   //model_humans_add("vasiliy","pupkin",2000);
    $humans = model_humans_getAll();
    core_render("main",["humans"=>$humans,"title"=>"My site::Главная"]);
};

function libs_routes_page_delete(){
    $id = @$_GET["id"];
    if(empty($id)){
        echo "Error";
        return;
    }
    core_loadModel("humans");
    core_loadModel("images");
    model_humans_deleteById($id);
    model_images_deleteByHuman($id);
    header("Location:/");
};

function libs_routes_page_add():void{
    core_loadModel("humans");
    if(is_empty(@$_POST["name"],@$_POST["surname"],@$_POST["year"])){
        echo "Please fill all fields.<a href='/'>back</a>";
        return;
    }
    model_humans_add($_POST["name"],$_POST["surname"],$_POST["year"]);

    header("Location:/");
};

function page_human_add_image(){
    $id = @$_GET["human_id"];
    if(empty($id)){
        echo "ERROR";
        return;
    }
    core_render("addimage",["hid"=>$id,"title"=>"My site::Добавить картинку"]);
};

function page_addimagehadle(){
   $human_id = @$_POST["human_id"];
   $url = @$_POST["url"];
   if(is_empty($human_id,$url)){
       echo "ERROR";
       return;
   }
  core_loadModel("images");
  model_images_add($human_id,$url);
  header("Location:/");

};

function page_images(){
    $human_id = @$_GET["human_id"];
    $url = @$_POST["url"];
    if(is_empty($human_id)){
        echo "ERROR";
        return;
    }
    core_loadModel("images");
    $images = model_images_getByHumanId($human_id);
    core_render("images",["images"=>$images,"title"=>"My site::Добавить картинку"]);
};

