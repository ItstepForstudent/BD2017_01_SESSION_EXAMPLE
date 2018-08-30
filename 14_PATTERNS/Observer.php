<?php


interface Observer{
    public function onNotify(string $str);
}

interface IObservable{
    public function subscribe(Observer $obs);
    public function notify(string $str);
}

class Observable implements IObservable{

    private $observers = [];
    public function subscribe(Observer $obs)
    {
        $this->observers[] = $obs;
    }

    public function notify(string $str)
    {
        foreach ($this->observers as $observer){
            $observer->onNotify($str);
        }
    }
}



class Youtuber extends Observable{
    private $name;

    public function __construct(String $name)
    {
        $this->name = $name;
    }

    public function sendNewVideo($videoName){
        $this->notify($videoName);
    }

}

class Subscriber implements Observer{
    private $name;

    public function __construct(String $name)
    {
        $this->name = $name;
    }

    public function onNotify(string $str)
    {
        echo "Подписчик {$this->name} рад, новое видео:{$str}\n";
    }
}


$subs1 = new Subscriber("Vasia");
$subs2 = new Subscriber("Petia");
$youtuber = new Youtuber("Ivan");
$youtuber->subscribe($subs1);
$youtuber->subscribe($subs2);
$youtuber->sendNewVideo("Trulalala");