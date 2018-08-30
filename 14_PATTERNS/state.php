<?php


interface BaseState{
    public function draw($canvas);
}

class PlayState implements BaseState{

    public function draw($canvas)
    {
        //draw the game process
    }
}

class PauseState implements BaseState{

    public function draw($canvas)
    {
        // draw the pause screen
    }
}


class Game implements BaseState {
    private $state;
    public function __construct(){
        $this->state = new PlayState();
    }

    public function getState(): BaseState{
        return $this->state;
    }
    public function setState(BaseState $state): void{
        $this->state = $state;
    }


    public function draw($canvas)
    {
        $this->state->draw($canvas);
    }
}

$g = new Game();
$playstate = $g->getState();
$g->setState(new PauseState());

$g->setState($playstate);