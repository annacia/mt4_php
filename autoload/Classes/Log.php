<?php 


namespace autoload\Classes;


use autoload\Classes\Dispositivo as Dispositivo;
use autoload\Classes\Fabricante as Fabricante;
use autoload\Classes\Modelo as Modelo;
use autoload\Classes\Tipo as Tipo;
use autoload\Classes\Usuario as Usuario;
use autoload\Classes\Criptografia as Criptografia;

class Log{

    private $resultado;
    private $senha;
    private $dispositivo;

    public function __construct(string $senha, Dispositivo $dispositivo){
        $this->setSenha($senha);
        $this->setDispositivo($dispositivo);
        $this->estabeleceConexao();
    }

    public function setSenha(string $senha){
        $this->senha = $senha;
    }

    public function setDispositivo(Dispositivo $dispositivo){
        $this->dispositivo = $dispositivo;
    }

    public function getSenha() : string{
        return $this->senha;
    }

    public function getDispositivo() : Dispositivo{
        return $this->dispositivo;
    }

    public function setResultado(string $resultado){
        $this->resultado = $resultado;
    }

    public function getResultado() : string{
        return $this->resultado;
    }

    public function estabeleceConexao(){
        $r = '';

        if (!function_exists("ssh2_connect")){
            $r .= "<br> Função ssh2_connect não existe, verifique as configurações do seu sistema";
            die();
        } 

        if(!($con = ssh2_connect($this->getDispositivo()->getIp()))){ //recebe o ip
            $r .= "<br> Nao foi possivel estabelecer a conexao";
        } else {
            // Recebe o usuario e a senha
            if(!ssh2_auth_password($con, $this->getDispositivo()->getUsuario()->getNome(), $this->getSenha())) {
                $r .= "<br> Falha na autenticação";
            } else {
                $r .= "<br> Login realizado com sucesso";
                if (!($stream = ssh2_exec($con, "whoami" ))) {
                    $r .= "<br> Falha no comando";
                } else {
                    stream_set_blocking($stream, true);
                    $data = "";
                    while ($buf = fread($stream,4096)) {
                        $data .= $buf;
                    }
                    $r .= '<br> WHOAMI: ' . $data;
                    fclose($stream);
                }
            }
        }
        $this->setResultado($r);
    }
}

