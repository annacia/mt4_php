<?php



use autoload\Classes\Dispositivo as Dispositivo;
use autoload\Classes\Fabricante as Fabricante;
use autoload\Classes\Log as Log;
use autoload\Classes\Modelo as Modelo;
use autoload\Classes\Tipo as Tipo;
use autoload\Classes\Usuario as Usuario;

require_once('conecta.php');
// require_once('../../autoload.php');

//Insere log 
function insereLog($conexao2, Log $log){
    $stmt = $conexao2->prepare(
        'INSERT INTO log (createdLog, resultado, fkDispositivo)
        VALUES (NOW(), :resultado, 
        (SELECT pkDispositivo FROM dispositivo
        WHERE idDispositivo = :id))'
    );

    $stmt->bindValue(':resultado', $log->getResultado());
    $stmt->bindValue(':id', $log->getDispositivo()->getId());

    $stmt->execute();
}

//Lista logs
function listaLogs($conexao2){
    $stmt = $conexao2->prepare(
        'SELECT resultado, createdLog, idDispositivo FROM log l 
        INNER JOIN dispositivo d ON l.fkDispositivo = d.pkDispositivo'
    );

    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

//Deleta Log
function deletaLog($conexao2, $pk){
    $stmt = $conexao2->prepare(
        'DELETE FROM log WHERE pkLog = :pk'
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
// $log = new Log('teste backend', $dispositivo);

// insereLog($conexao2, $log);

//var_dump(listaLogs($conexao2));

// deletaLog($conexao2, 2);