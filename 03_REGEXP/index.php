<?php


/***
 * \n
 * \t
 * \s - space пробельный символ
 * \S - НЕ пробельный символ
 * \w - wordsymbol буква/цифра
 * \W -
 * \b - граница слова \w\s  \s\w
 * \B
 * \d - digit
 * \D
 *
 * .
 *
 * ?
 * *
 * +
 * {n}
 * {n,m}
 * {n,}
 *
 * [abcd]
 * [a-z]
 * [0-9]
 * [a-zA-Z0-9]
 * [^abc]
 * [^abcdz]
 *
 * ^ - start of text
 * $ - end of text
 *
 * ()
 * (0|80|380|\+380)(\d{9})
 *
 */

function example1(){
    $rexp = '/^([a-z0-9][a-z0-9\-\.\_]*)@[a-z0-9]+(\.[a-z]{2,10}){1,4}$/i';
    $email = "das-asdas-d@mail.com.ua";

    if(preg_match($rexp,$email)){
        echo "valid";
    }else{
        echo "invalid";
    }

    echo preg_replace(
        "/(0|80|380|\+380)(\d{9})/",
        '0$2',
        "dfdagsdfgm agasdf g 0930001122 dsagsdf cvzdf +380684445566");
}

function example2(){
   /*
    * '/pattern/flags'
    *
    * i - case insesetive
    * s - space
    * x - space ignore
    * m - multiline ^$
    *
    * u
    */


   $rexp = '/\(.+\)/';
   $text="
lorem ipsum
(doloR sit
amet)
fasdgdfb dfsgf
   ";

   preg_match_all($rexp,$text,$result);
   var_dump($result);




}

function example3(){
    /*
     * '*','+','?'
     */

    $text = "<p><p>hello</p></p><p>wprld</p>";
    //$rexp = "/a\w+c/";
    $rexp = '/<p>.+?<\/p>/';
    preg_match_all($rexp,$text,$r);
    var_dump($r);


}

function ex4(){
    $html= file_get_contents("a.html");
    $rexp = '/(<div.*?class=")(.+?)(".*?>)/i';
    $html2 = preg_replace($rexp,"$1vasia$3",$html);
    echo $html2;
}

function ex5(){
    $html= file_get_contents("a.html");
    $classname='a';
    preg_match('/<div[^<>]*?class="a".*?>.*<\/div>/s',$html,$result);
    echo $result[0];

    $div_rexp = '/<\/?div[^<>]*>/';
    $div_o_rexp = '/<div[^<>]*>/';
    $i=0;
    $index = 0;
    preg_match_all($div_rexp,$result[0],$tags);
    var_dump($tags[0]);
    $n = 0;
    do{
       $tag = $tags[0][$n++];
       if(preg_match($div_o_rexp,$tag))$i++;
       else $i--;
       $index = strpos($result[0],$tag,$index)+strlen($tag);
       echo "\n--------------\n".substr($result[0],0,$index)."\n";
    }while($i!=0);




}

function ex6(){
    $html= file_get_contents("a.html");
    $classname='a';
    $tagname = 'div';
    preg_match('/<'.$tagname.'[^<>]*?class="'.$classname.'".*?>.*<\/'.$tagname.'>/s',$html,$result);

    $div_rexp = '/<\/?'.$tagname.'[^<>]*>/';
    $div_o_rexp = '/<'.$tagname.'[^<>]*>/';

    preg_match_all($div_rexp,$result[0],$tags);
    $i=0;
    $index = 0;
    foreach ($tags[0] as $tag){
        if(preg_match($div_o_rexp,$tag))$i++;
        else $i--;
        $index = strpos($result[0],$tag,$index)+strlen($tag);
        if($i==0)break;
    }
    echo substr($result[0],0,$index);
}


ex6();

