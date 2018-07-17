<?php
function getConnection(){
    static $connecion = null;
    if($connecion!==null) return $connecion;

    $dbname = "mydb";
    $user = "root";
    $pass = "0000";
    $host = "127.0.0.1";
    $charset ="utf8";

    $dsn = "mysql:dbname={$dbname};host={$host};charset={$charset}";

    $connecion = new PDO($dsn,$user,$pass,[
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING
    ]);

    return $connecion;
}

function getData($query){
    $conn = getConnection();
    $stmt = $conn->query($query);
    return $stmt->fetchAll();
}
function insertData($table,$data){
    $fields = array_keys($data);
    $values = array_values($data);

    $conn = getConnection();

    $values = array_map(function ($elem) use ($conn){
        return is_string($elem) ? $conn->quote($elem) : $elem;
    },$values);


    $query = "INSERT INTO `{$table}` (`"
        .implode("`,`",$fields)."`) VALUES ("
        .implode(",",$values).")";

    $conn->exec($query);
}

function deleteData($table,$id){
    $q = "DELETE FROM `{$table}` WHERE `id`={$id}";
    getConnection()->exec($q);
}


function getAllNotes(){
    return getData("SELECT * FROM `notes`");
}
function insertNote($name){
    insertData("notes",["name"=>$name]);
}
function deleteNote($id){
    deleteData("notes",(int)$id);
}





