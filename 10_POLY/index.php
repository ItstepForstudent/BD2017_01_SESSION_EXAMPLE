<?php

interface Crypt{
    public function encrypt(string $data):string ;
    public function decrypt(string $data):string ;
}

abstract class Crypter{
    protected $crypt;

    public function __construct(Crypt $crypt){
        $this->crypt = $crypt;
    }

    abstract public function encrypt();
    abstract public function decrypt();

}

class CesarCrypt implements Crypt {

    private $key;

    public function __construct(int $key)
    {
        $this->key = $key;
    }


    private function _crypt(string $data,int $key):string {
        $result = "";
        for($i=0;$i<strlen($data);$i++){
            $result.=chr(ord($data[$i])+$key);
        }
        return $result;
    }

    public function encrypt(string $data): string{
        return $this->_crypt($data,$this->key);
    }

    public function decrypt(string $data): string{
        return $this->_crypt($data,-$this->key);
    }
}
class StringCrypter extends Crypter{

    private $input,$output;

    public function __construct(Crypt $crypt,string $input){
        parent::__construct($crypt);
        $this->input = $input;
    }


    public function encrypt()
    {
        $this->output = $this->crypt->encrypt($this->input);
    }

    public function decrypt()
    {
        $this->output = $this->crypt->decrypt($this->input);
    }

    public function getOutput(){
        return $this->output;
    }


}
class FileCrypter extends Crypter{

    private $input,$output;

    public function __construct(Crypt $crypt,string $inputfile,string $outputfile){
        parent::__construct($crypt);
        $this->input = $inputfile;
        $this->output = $outputfile;
    }


    public function encrypt()
    {
        file_put_contents($this->output,$this->crypt->encrypt(file_get_contents($this->input)));
    }

    public function decrypt()
    {
        file_put_contents($this->output,$this->crypt->decrypt(file_get_contents($this->input)));
    }

}




//$crypter = new StringCrypter(new CesarCrypt(5),"hello world");
//$crypter->encrypt();
//$result = $crypter->getOutput();
//echo $result;
//
//echo "<br>";
//$crypter2 = new StringCrypter(new CesarCrypt(5),$result);
//$crypter2->decrypt();
//echo $crypter2->getOutput();

$crypter = new FileCrypter(new CesarCrypt(3),"out.txt","out2.txt");
$crypter->decrypt();