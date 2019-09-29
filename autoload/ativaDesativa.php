<?php

use autoload\Classes\Dispositivo as Dispositivo;
use autoload\Classes\Fabricante as Fabricante;
use autoload\Classes\Modelo as Modelo;
use autoload\Classes\Tipo as Tipo;
use autoload\Classes\Usuario as Usuario;
use autoload\Classes\Criptografia as Criptografia;

if(isset($_POST['pk'])){
    
    require_once('../autoload.php');
    require_once('DAO/conecta.php');
    include_once('DAO/dispositivoDAO.php');
        
    
    $dSelecionado = selecionaDispositivo($conexao2, $_POST['pk']);
    
    $fabricante = new Fabricante($dSelecionado[0]["nomeFabricante"]);
    $tipo = new Tipo($dSelecionado[0]["nomeTipo"]);
    $modelo = new Modelo($dSelecionado[0]["nomeModelo"]);
    $usuario = new Usuario($dSelecionado[0]["nomeUsuario"]);
    $criptografia = new Criptografia($dSelecionado[0]["hostname"]);
    
    if($dSelecionado[0]["ativoDispositivo"]==1){
        $ativo = 0;
    } else {
        $ativo = 1;
    }
    
    $dispositivo = new Dispositivo($dSelecionado[0]["idDispositivo"], $criptografia, $dSelecionado[0]["ip"],
    $ativo, $tipo, $fabricante, $modelo, $usuario);
    
    ativaDispositivo($conexao2, $dispositivo, $_POST['pk']);


}