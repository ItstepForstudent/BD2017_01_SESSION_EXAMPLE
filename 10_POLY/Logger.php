<?php

interface Logger{
    public function log(string $message);
}

class ScreenLogger implements Logger{

    public function log(string $message)
    {
        echo strftime("%H:%M:%S").": ".$message."<br/>";
    }
}


class FileLogger implements Logger{
    private $filename;
    public function __construct(string $filename){
        $this->filename=$filename;
    }


    public function log(string $message)
    {
        file_put_contents($this->filename,strftime("%H:%M:%S").": ".$message."\n\r",FILE_APPEND);
    }
}

class ComboLogger implements Logger{

    private $flogger,$slogger;

    public function __construct()
    {
        $this->flogger=new FileLogger("combo.log");
        $this->slogger=new ScreenLogger();
    }

    public function log(string $message)
    {
        $this->slogger->log($message);
        $this->flogger->log($message);
    }
}

class Prover{
    public static function getLogger():Logger{
        return new ComboLogger();
    }
}


class Demo{
    public function ddemo(Logger $l){
        $l->log("hello from demo");
        $l->log("process started");
        sleep(2);
        $l->log("process finished");
    }
}


$d = new Demo();
$d->ddemo(Prover::getLogger());

