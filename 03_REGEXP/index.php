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

