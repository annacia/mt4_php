<?php


$conexao = new PDO('mysql:host=localhost;dbname=mt4', 'root', '');

$conexao2 = new PDO(
    'mysql:host=localhost; dbname=mt4; charset=utf8', 'root', '',
    array(
        PDO::ATTR_PERSISTENT =>true
    )
);