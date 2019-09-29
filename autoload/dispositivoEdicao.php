<?php

use autoload\Classes\Fabricante as Fabricante;
use autoload\Classes\Tipo as Tipo;
use autoload\Classes\Modelo as Modelo;
use autoload\Classes\Usuario as Usuario;
use autoload\Classes\Criptografia as Criptografia;
use autoload\Classes\Dispositivo as Dispositivo;

// use autoload\DAO\DispositivoDAO as DispositivoDAO;

require_once('../autoload.php');
require_once('DAO/conecta.php');
require_once('DAO/dispositivoDAO.php');

$fabricante = new Fabricante($_POST["fabricanteCad"]);
$tipo = new Tipo($_POST["tipoCad"]);
$modelo = new Modelo ($_POST["modeloCad"]);
$usuario = new Usuario ($_POST["usuarioCad"]);
$criptografia = new Criptografia($_POST["hostnameCad"]);

$dispositivo = new Dispositivo($_POST["idCad"], $criptografia, $_POST["ipCad"], $_POST["ativoCad"], $tipo, $fabricante, $modelo, $usuario);

alteraDispositivo($conexao2, $dispositivo, $_POST['pk']);

header("Location: /mt4_php/");
die();