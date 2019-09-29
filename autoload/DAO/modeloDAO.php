<?php



use autoload\Classes\Modelo as Modelo;

require_once('conecta.php');
// require_once('../../autoload.php');

//Insere modelo se nao existe
function insereModelo($conexao2, Modelo $modelo){
    $stmt = $conexao2->prepare(
        'INSERT INTO modelo (createdModelo, nomeModelo)
        SELECT * FROM (SELECT NOW(), :nome) as m
        WHERE NOT EXISTS 
        (SELECT m.nomeModelo FROM modelo m 
        WHERE m.nomeModelo = :nome) '
    );

    $stmt->bindValue(':nome', $modelo->getNome());

    $stmt->execute();
}

//Lista modelos
function listaModelos($conexao2){
    $stmt = $conexao2->prepare(
        'SELECT pkModelo, nomeModelo FROM modelo'
    );

    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

//Muda o nome de um modelo
function alteraNomeModelo($conexao2, $pk, $nome){
    $stmt = $conexao2->prepare(
        'UPDATE modelo SET modifiedModelo = NOW(), nomeModelo = :nome
        WHERE pkModelo = :pk'
    );

    $stmt->bindValue(':nome', $nome);
    $stmt->bindValue(':pk', $pk);

    $stmt->execute();
}

//Deleta Modelo
function deletaModelo($conexao2, $pk){
    $stmt = $conexao2->prepare(
        'DELETE FROM modelo WHERE pkModelo = :pk'
    );

    $stmt->bindValue(':pk', $pk);

    $stmt->execute();
}

// $modelo = new Modelo('modeloTeste');
//insereModelo($conexao2, $modelo);
// var_dump(listaModelos($conexao2));
// alteraNomeModelo($conexao2, 4, 'Mudei o nome');
// deletaModelo($conexao2, 4);