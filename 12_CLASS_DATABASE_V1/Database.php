<?php
/**
 * Created by PhpStorm.
 * User: mamedov
 * Date: 23.08.2018
 * Time: 18:54
 */




class Database
{
    const DB_CONFIG = [
        "host"=>"127.0.0.1",
        "dbname"=>"demo",
        "user"=>"root",
        "pass"=>"0000",
        "charset"=>"utf8"
    ];

    private $dbh;
    private $table=NULL;

    private static $instance = NULL;

    public static function instance():self{
        return self::$instance === NULL ? self::$instance = new self(): self::$instance;
    }

    private function __construct(){
        $dsn = "mysql:host=".self::DB_CONFIG["host"]
            .";dbname=".self::DB_CONFIG["dbname"]
            .";charset=".self::DB_CONFIG["charset"];
        $this->dbh = new PDO($dsn,self::DB_CONFIG["user"],self::DB_CONFIG["pass"],[
            PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE=>PDO::FETCH_ASSOC
        ]);
    }

    public function __get($name){
        $this->table = $name;
        return $this;
    }

    private function _insert($table,$data){
        $fields = array_keys($data);
        $query = "INSERT INTO `{$table}` (`"
            .implode("`,`",$fields)."`) VALUES (:"
            .implode(",:",$fields).")";
        $this->dbh->prepare($query)->execute($data);
        return $this->dbh->lastInsertId();
    }

    public function insert(array $data){
        return $this->_insert($this->table,$data);
    }


}



Database::instance()->users->insert([
   "name"=>"vasia5",
   "pass"=>"0000"
]);

