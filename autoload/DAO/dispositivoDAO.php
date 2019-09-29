<?php


use autoload\Classes\Dispositivo as Dispositivo;
use autoload\Classes\Fabricante as Fabricante;
use autoload\Classes\Log as Log;
use autoload\Classes\Modelo as Modelo;
use autoload\Classes\Tipo as Tipo;
use autoload\Classes\Usuario as Usuario;
use autoload\Classes\Criptografia as Criptografia;

// require_once('../../autoload.php');
require_once('conecta.php');
// require_once('tipoDAO.php');

//Seleciona dispositivo
function selecionaDispositivo($conexao2, $pk){
    $stmt = $conexao2->prepare(
        'SELECT * FROM dispositivo p 
        INNER JOIN tipo t ON p.fkTipo = t.pkTipo
        INNER JOIN fabricante f ON p.fkFabricante = f.pkFabricante
        INNER JOIN modelo m ON p.fkModelo = m.pkModelo
        INNER JOIN usuario u ON p.fkUsuario = u.pkUsuario
        WHERE p.pkDispositivo = :pk' 
    );

    $stmt->bindValue(':pk', $pk);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

//Insere novo dispositivo
function insereNovoDispositivo($conexao2, Dispositivo $dispositivo){

    require_once('tipoDAO.php');
    require_once('modeloDAO.php');
    require_once('fabricanteDAO.php');
    require_once('usuarioDAO.php');
        
    inserindoTipo($conexao2, $dispositivo->getTipo());
    insereModelo($conexao2, $dispositivo->getModelo());
    insereFabricante($conexao2, $dispositivo->getFabricante());
    cadastraUsuario($conexao2, $dispositivo->getUsuario());

    $stmt = $conexao2->prepare(
        'INSERT INTO dispositivo (createdDispositivo, idDispositivo, hostname, 
        ip, fkTipo, fkFabricante, fkModelo, fkUsuario, 
        ativoDispositivo)
        VALUES (NOW(), :id, :hostname, :ip, 
        (SELECT pkTipo FROM tipo WHERE nomeTipo = :nomeTipo),
        (SELECT pkFabricante FROM fabricante 
        WHERE nomeFabricante = :nomeFabricante),
        (SELECT pkModelo FROM modelo WHERE nomeModelo = :nomeModelo),
        (SELECT pkUsuario FROM usuario WHERE nomeUsuario = :nomeUsuario),
        :ativo)'
    );

    $stmt->bindValue(':id', $dispositivo->getId());
    $stmt->bindValue(':hostname', $dispositivo->getHostname()->getTextC());
    $stmt->bindValue(':ip', $dispositivo->getIp());
    $stmt->bindValue(':ativo', (int)$dispositivo->getAtivo());
    $stmt->bindValue(':nomeTipo', $dispositivo->getTipo()->getNome());
    $stmt->bindValue(':nomeFabricante', $dispositivo->getFabricante()->getNome());
    $stmt->bindValue(':nomeModelo', $dispositivo->getModelo()->getNome());
    $stmt->bindValue(':nomeUsuario', $dispositivo->getUsuario()->getNome());


    // $stmt->bindValue(':id', '15');
    // $stmt->bindValue(':hostname', 'CbX2Dh/YUbcuAmiDRh5mNQ==');
    // $stmt->bindValue(':ip', '262636');
    // $stmt->bindValue(':ativo', 0);
    // $stmt->bindValue(':nomeTipo', 'TipoDeTeste2');
    // $stmt->bindValue(':nomeFabricante', 'Fabricante de Teste');
    // $stmt->bindValue(':nomeModelo', 'Modelo de Teste');
    // $stmt->bindValue(':nomeUsuario', 'camila');





    var_dump($dispositivo->getId());
    var_dump($dispositivo->getHostname()->getTextC());
    var_dump($dispositivo->getIp());
    var_dump($dispositivo->getAtivo());
    var_dump($dispositivo->getTipo()->getNome());
    var_dump($dispositivo->getFabricante()->getNome());
    var_dump($dispositivo->getModelo()->getNome());
    var_dump($dispositivo->getUsuario()->getNome());





    $stmt->execute();

    if (!$stmt) {
        echo "PDO::errorInfo():\n";
        print_r($dbh->errorInfo());
    }
    
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
    
}

//Lista dispositivos
function listaDispositivos($conexao2){
    $stmt = $conexao2->prepare(
        'SELECT d.pkDispositivo, d.idDispositivo, d.hostname, d.ip, t.nomeTipo, 
        d.ativoDispositivo 
        FROM dispositivo d
        INNER JOIN tipo t ON  d.fkTipo = t.pkTipo
        '
    );

    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

//Altera Dispositivo
function alteraDispositivo($conexao2, Dispositivo $dispositivo, $pk){
    
    require_once('tipoDAO.php');
    inserindoTipo($conexao2, $dispositivo->getTipo());
    
    $stmt = $conexao2->prepare(
        'UPDATE dispositivo SET modifiedDispositivo = NOW(), idDispositivo = :id, 
        hostname = :hostname, ip = :ip,
        ativoDispositivo = :ativo, fkTipo = 
        (SELECT pkTipo FROM tipo WHERE nomeTipo = :nome) WHERE pkDispositivo = :pk'
    );

    $stmt->bindValue(':id', $dispositivo->getId());
    $stmt->bindValue(':hostname', $dispositivo->getHostname()->getTextC());
    $stmt->bindValue(':ip', $dispositivo->getIp());
    $stmt->bindValue(':ativo', (int)$dispositivo->getAtivo());
    $stmt->bindValue(':nome', $dispositivo->getTipo()->getNome());
    $stmt->bindValue(':pk', $pk);

    $stmt->execute();

    if (!$stmt) {
        echo "PDO::errorInfo():\n";
        print_r($dbh->errorInfo());
    }
    
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
    
}

//Ativa ou Desativa
function ativaDispositivo($conexao2, Dispositivo $dispositivo, $pk){
    $stmt = $conexao2->prepare(
        'UPDATE dispositivo SET modifiedDispositivo = NOW(), 
        ativoDispositivo = :ativo WHERE pkDispositivo = :pk'
    );

    $stmt->bindValue(':ativo', (int)$dispositivo->getAtivo());
    $stmt->bindValue(':pk', $pk);

    $stmt->execute();
}

//Deleta Dispositivo
function deletaDispositivo($conexao2, $pk){
    $stmt = $conexao2->prepare(
        'DELETE FROM dispositivo WHERE pkDispositivo = :pk'
    );

    $stmt->bindValue(':pk', $pk);

    $stmt->execute();
}

// $fabricante = new Fabricante('Cisco');
// $tipo = new Tipo('extensor');
// $tipo2 = new Tipo('extensor2');
// $modelo = new Modelo ('Teste');
// $usuario = new Usuario ('carol', 'a');

// $dispositivo = new Dispositivo('3', '333333333333333333333333', '111111111111', 0, $tipo, $fabricante, $modelo, $usuario);
// $dispositivo2 = new Dispositivo('7', '333333333333333333333333', '611111111111', 0, $tipo2, $fabricante, $modelo, $usuario);

//alteraDispositivo($conexao2, $dispositivo2, 3);
//ativaDispositivo($conexao2, $dispositivo, 2);
// insereNovoDispositivo($conexao2, $dispositivo, $tipo, $modelo, $fabricante,  $usuario);
//deletaDispositivo($conexao2, 4);
// echo var_dump(listaDispositivos($conexao2));

// $fabricante = new Fabricante('Fabricante de Teste');
// $tipo = new Tipo('TipoDeTeste2');
// $tipo2 = new Tipo('extensor2');
// $modelo = new Modelo ('Modelo de Teste');
// $usuario = new Usuario ('camila');
// $criptografia = new Criptografia('batata');

// $dispositivo = new Dispositivo('3992', $criptografia, '19630531', 1, $tipo, $fabricante, $modelo, $usuario);

// var_dump($dispositivo);
// var_dump(insereNovoDispositivo($conexao, $dispositivo));
// var_dump(inserindoTipo($conexao2, $dispositivo->getTipo()));