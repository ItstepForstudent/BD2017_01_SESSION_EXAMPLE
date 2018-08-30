<?php

class Logger{
    private static $inst=null;
    private function __construct(){}

    public static function instance(){
        if(self::$inst===null) self::$inst = new self();
        return self::$inst;
    }

    public function log(string $s){
        echo $s."\n";
    }
}

interface IStorageAdapter{
    public function doit(array $s);
}

class Storage{
    private $data = ["a","b","c"];
    private $adapter;

    public function __construct(IStorageAdapter $adapter)
    {
        $this->adapter = $adapter;
    }

    public function activate(){
        $this->adapter->doit($this->data);
    }
}



class LoggerStorageAdapter implements IStorageAdapter{

    private $logger;

    public function __construct(Logger $logger)
    {
        $this->logger = $logger;
    }

    public function doit(array $s)
    {
        foreach ($s as $str){
            $this->logger->log($str);
        }
    }
}


$sa = new LoggerStorageAdapter(Logger::instance());
$st = new Storage($sa);
$st->activate();