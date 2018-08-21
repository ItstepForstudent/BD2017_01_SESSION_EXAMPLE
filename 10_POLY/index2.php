<?php

interface Drawable{
    public function draw($img);
}

abstract class Figure implements Drawable {
    protected $x,$y,$color;

    public function __construct(int $x,int $y,int $color)
    {
        $this->x = $x;
        $this->y = $y;
        $this->color = $color;
    }

}

class Canvas{
    private $img,$width,$height;

    public function __construct(int $width,int $height){
        $this->width=$width;
        $this->height=$height;
        $this->img = imagecreatetruecolor($width,$height);
    }

    public function drawFigure(Drawable $f){
        $f->draw($this->img);
    }

    public function show()
    {
        header("Content-Type:image/png");
        imagepng($this->img);
    }

}



class Rect extends Figure {
    private $w,$h;

    public function __construct(int $x, int $y, int $w, int $h,int $color)
    {
        parent::__construct($x,$y,$color);
        $this->w = $w;
        $this->h = $h;
    }

    public function draw($img)
    {
        imagerectangle($img,
            $this->x,$this->y,
            $this->x+$this->w,$this->y+$this->h,
            $this->color
        );
    }
}


class Circle extends Figure{
    private $radius;
    public function __construct(int $x, int $y,int $radius, int $color)
    {
        $this->radius=$radius;
        parent::__construct($x, $y, $color);
    }

    public function draw($img)
    {
       imageellipse($img,
           $this->x,$this->y,
           2*$this->radius,
           2*$this->radius,
           $this->color
       );
    }
}


class FigureArray implements Drawable{

    private $arr=[];

    public function add(Figure $f){
        $this->arr[] = $f;
    }

    public function draw($img)
    {
        foreach ($this->arr as $figure) $figure->draw($img);
    }
}


$figures = new FigureArray();
$figures->add(new Rect(10,10,50,50,0xff0000));
$figures->add(new Circle(70,70,20,0x00ff00));

$canvas = new Canvas(200,200);
$canvas->drawFigure($figures);
$canvas->show();