<?php

class Single{
    private static $instance = NULL;
    public static function instance():self{
//        if(self::$instance==NULL) self::$instance = new self();
//        return self::$instance;
        return self::$instance === NULL ? self::$instance = new self(): self::$instance;
    }
    private function __construct(){
        echo "<div>create instance</div>";
    }
}


$s = Single::instance();
$s2 = Single::instance();