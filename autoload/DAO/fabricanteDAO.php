<?php



use autoload\Classes\Fabricante as Fabricante;
require_once('conecta.php');
// require_once('../../autoload.php');

//Insere fabricante se nao existe
function insereFabricante($conexao2, Fabricante $fabricante){
    $stmt = $conexao2->prepare(
        'INSERT INTO fabricante (createdFabricante, nomeFabricante)
        SELECT * FROM (SELECT NOW(), :nome) as f
        WHERE NOT EXISTS 
        (SELECT f.nomeFabricante FROM fabricante f 
        WHERE f.nomeFabricante = :nome) '
    );

    $stmt->bindValue(':nome', $fabricante->getNome());

    $stmt->execute();
}

//Lista fabricantes
function listaFabricantes($conexao2){
    $stmt = $conexao2->prepare(
        'SELECT pkFabricante, nomeFabricante FROM fabricante'
    );

    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

//Altera nome do fabricante
function alteraNomeFabricante($conexao2, $pk, $nome){
    $stmt = $conexao2->prepare(
        'UPDATE fabricante SET modifiedFabricante = NOW(), nomeFabricante = :nome
        WHERE pkFabricante = :pk'
    );

    $stmt->bindValue(':nome', $nome);
    $stmt->bindValue(':pk', $pk);

    $stmt->execute();
}

//Deleta fabricante
function deletaFabricante($conexao2, $pk){
    $stmt = $conexao2->prepare(
        'DELETE FROM fabricante WHERE pkFabricante = :pk'
    );

    $stmt->bindValue(':pk', $pk);
    $stmt->execute();
}

//$fabricante = new Fabricante('D-Link');
//insereFabricante($conexao2, $fabricante);
//var_dump(listaFabricantes($conexao2));
//alteraNomeFabricante($conexao2, 3, 'Generico');
//deletaFabricante($conexao2, 3);