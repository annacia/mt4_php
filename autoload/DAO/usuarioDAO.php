<?php



use autoload\Classes\Usuario as Usuario;

require_once('conecta.php');
// require_once('../../autoload.php');

//Cadastrando o usuario
function cadastraUsuario($conexao2, Usuario $usuario){
    $stmt = $conexao2->prepare(
        'INSERT INTO usuario (createdUsuario, nomeUsuario)
        SELECT * FROM (SELECT NOW(), :nome) as u
        WHERE NOT EXISTS
        (SELECT u.nomeUsuario FROM usuario u
        WHERE u.nomeUsuario = :nome)'
    );
    
    $stmt->bindValue(':nome', $usuario->getNome());

    $stmt->execute();
}

//Lista de usuarios
function listaUsuarios($conexao2){
    $stmt = $conexao2->prepare(
        'SELECT pkUsuario, nomeUsuario FROM usuario'
    );

    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

//Removendo Usuario
function removeUsuario($conexao2, int $pk){
    $stmt = $conexao2->prepare(
        'DELETE FROM usuario WHERE pkUsuario = :pk'
    );

    $stmt->bindValue(':pk', $pk);

    $stmt->execute();
}

// $usuario = new Usuario('nick', 'b');
// $usuario2 = new Usuario('nick', '1234');
// cadastraUsuario($conexao2, $usuario);
// var_dump(listaUsuarios($conexao2));
// novaSenha($conexao2, $usuario2);
// removeUsuario($conexao2, 3);