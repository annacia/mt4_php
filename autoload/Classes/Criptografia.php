<?php


namespace autoload\Classes;


class Criptografia {
    private $textC; //texto criptografado
    private $textD; //texto descriptografado
    private $textReveal; //texto descriptografado, caso a string recebida seja uma criptografia aes256
    
    const METODO = 'aes-256-cbc'; 
    
    protected $chave;
    protected $iv;
    
    public function __construct(string $text){
        $this->chave = substr(hash('sha256', 'MT4-n3tworks', true), 0, 32); 
        $this->iv = chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0);

        $this->setTextC($text);
        $this->setTextD($this->textC);
        $this->setTextReveal($text);

    }

    public function setTextReveal(string $text){
        $this->setTextD($text);
        $aux = $this->getTextD();
        $this->textReveal = $aux;
    }

    public function getTextReveal() : string{
        return $this->textReveal;
    } 

    public function setTextC(string $text){
        $encripitado = base64_encode(openssl_encrypt(
            $text, self::METODO, $this->chave, OPENSSL_RAW_DATA, $this->iv));

        $this->textC = $encripitado;
    }

    public function setTextD(string $text){
        $descripitado = openssl_decrypt(
            base64_decode($text), self::METODO, $this->chave, OPENSSL_RAW_DATA, $this->iv);

        $this->textD = $descripitado;
    }

    public function getTextC() : string {
        return $this->textC;
    }

    public function getTextD() : string {
        return $this->textD;
    }
}




