<?php
interface IStrategy{
    public function createSite();
}

class LowMoneyStrategy implements IStrategy {

    public function createSite()
    {
        echo "Lern HTML\n";
        echo "Lern CSS\n";
        echo "Lern JS\n";
        echo "Create a site";
    }
}

class ManyMoneyStrategy implements IStrategy{

    public function createSite()
    {
        echo "Give money for worker\n";
        echo "Get a website";
    }
}


class CreateSiteWork{
    private $strategy;

    public function doSite(int $money){
        $this->strategy = $money>1000 ? new ManyMoneyStrategy() : new LowMoneyStrategy();
        $this->strategy->createSite();
    }
}



$csw = new CreateSiteWork();
$csw->doSite(800);
