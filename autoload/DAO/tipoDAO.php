<?php



use autoload\Classes\Tipo as Tipo;

require_once('conecta.php');
// require_once('../../autoload.php');

//Inserindo o tipo se ele nao existe
function inserindoTipo($conexao2, Tipo $tipo){
    $stmt = $conexao2->prepare(
        'INSERT INTO tipo (createdTipo, nomeTipo)
        SELECT * FROM (SELECT NOW(), :nome) as t
        WHERE NOT EXISTS 
        (SELECT t.nomeTipo FROM tipo t 
        WHERE t.nomeTipo = :nome) '
    );

    $stmt->bindValue(':nome', $tipo->getNome());

    $stmt->execute();
}

//Listando os tipos
function listaTipos($conexao2){
    $stmt = $conexao2->prepare(
        'SELECT pkTipo, nomeTipo FROM tipo'
    );

    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

//Alterando nome dos tipos
function alteraNomeTipo($conexao2, $pk, $nome){
    $stmt = $conexao2->prepare(
        'UPDATE tipo SET modifiedTipo = NOW(), nomeTipo = :nome
        WHERE pkTipo = :pk'
    );

    $stmt->bindValue(':nome', $nome);
    $stmt->bindValue(':pk', $pk);

    $stmt->execute();
}

//Deleta tipo
function deletaTipo($conexao2, $pk){
    $stmt = $conexao2->prepare(
        'DELETE FROM tipo WHERE pkTipo = :pk'
    );

    $stmt->bindValue(':pk', $pk);
    $stmt->execute();
}

// $tipo = new Tipo('Tipo de teste');
//inserindoTipo($conexao2, $tipo);
//var_dump(listaTipos($conexao2));
// alteraNomeTipo($conexao2, 5, 'Mudei o nome');
// deletaTipo($conexao2, 5);