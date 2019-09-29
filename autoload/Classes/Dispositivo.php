<?php



namespace autoload\Classes;


use autoload\Classes\Fabricante as Fabricante;
use autoload\Classes\Modelo as Modelo;
use autoload\Classes\Tipo as Tipo;
use autoload\Classes\Usuario as Usuario;
use autoload\Classes\Criptografia as Criptografia;


class Dispositivo{
    private $id;
    private $hostname;
    private $ip;
    private $ativo;
    private $tipo;
    private $fabricante;
    private $modelo;
    private $usuario;

    public function __construct(string $id, Criptografia $hostname,
    string $ip, bool $ativo, Tipo $tipo, Fabricante $fabricante, 
    Modelo $modelo, Usuario $usuario){
        $this->setId($id);
        $this->setHostname($hostname);
        $this->setIp($ip);
        $this->setAtivo($ativo);
        $this->setTipo($tipo);
        $this->setFabricante($fabricante);
        $this->setModelo($modelo);
        $this->setUsuario($usuario);        
    }

    public function setId(string $id){
        $this->id = $id;
    }

    public function setHostname(Criptografia $hostname){
        $this->hostname = $hostname;
    }

    public function setIp(string $ip){
        $this->ip = $ip;
    }

    public function setAtivo(bool $ativo){
        $this->ativo = $ativo;
    }

    public function setTipo(Tipo $tipo){
        $this->tipo = $tipo;
    }

    public function setFabricante(Fabricante $fabricante){
        $this->fabricante = $fabricante;
    }

    public function setModelo(Modelo $modelo){
        $this->modelo = $modelo;
    }

    public function setUsuario(Usuario $usuario){
        $this->usuario = $usuario;
    }
    
    public function getId() : string{
        return $this->id;
    }

    public function getHostname() : Criptografia{
        return $this->hostname;
    }

    public function getIp() : string{
        return $this->ip;
    }

    public function getAtivo() : bool{
        return $this->ativo;
    }

    public function getTipo() : Tipo{
        return $this->tipo;
    }

    public function getFabricante() : Fabricante{
        return $this->fabricante;
    }

    public function getModelo() : Modelo{
        return $this->modelo;
    }

    public function getUsuario() : Usuario{
        return $this->usuario;
    }  

}