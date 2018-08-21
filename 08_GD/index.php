<?php

//$img = imagecreatetruecolor(800,600);
//$white_color = imagecolorallocate($img,255,255,255);
//
//imageline($img,0,0,800,600,$white_color);
//imagefilledrectangle($img,100,100,200,150,$white_color);
//
//imagesetthickness($img,5);
//imagepolygon($img,[100,300,100,350,150,350],3,0xFF0000);
//
//


$img = imagecreatefromjpeg("images.jpg");
$size = getimagesize("images.jpg");
$w = $size[0];
$h = $size[1];

for($x=0;$x<$w;$x++){
    for($y=0;$y<$h;$y++){
        $pixel = imagecolorat($img,$x,$y);
        $red = ($pixel>>16)&0xFF;
        $green = ($pixel>>8)&0xFF;
        $blue = $pixel&0xFF;


        $sr_ar = (int)(($red+$green+$blue)/3);

        $red=$green=$blue= ($sr_ar>200)?255:0;
        $pixel = ($red<<16)|($green<<8)|$blue;
        imagesetpixel($img,$x,$y,$pixel);
    }
}

header("Content-type:image/png");
imagepng($img);




