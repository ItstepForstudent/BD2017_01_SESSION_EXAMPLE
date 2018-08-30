<?php
interface IComponent{
    public function meth();
    public function draw();
}

class Button implements IComponent {
    public function meth(){
        //TODO
    }

    public function draw()
    {
        echo "DRAWING A BUTTON\n";
    }
}


abstract class ComponentDecorator implements IComponent {
    private $component;
    public function __construct(IComponent $component)
    {
        $this->component = $component;
    }
    public function meth()
    {
        $this->component->meth();
    }

    public function draw()
    {
        $this->component->draw();
    }
}


class BorderDecorator extends ComponentDecorator {
    public function draw()
    {
        parent::draw();
        echo "DRAWING COMPONENT BORDER\n";
    }
}
class BgDecorator extends ComponentDecorator {
    public function draw()
    {
        parent::draw();
        echo "DRAWING BACKGROUND\n";
    }
}


$b = new BgDecorator(new BorderDecorator(new Button()));
$b->draw();
