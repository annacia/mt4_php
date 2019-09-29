<?php



use autoload\Classes\Fabricante as Fabricante;
use autoload\Classes\Tipo as Tipo;
use autoload\Classes\Modelo as Modelo;
use autoload\Classes\Usuario as Usuario;
use autoload\Classes\Criptografia as Criptografia;
use autoload\Classes\Dispositivo as Dispositivo;
use autoload\Classes\Log as Log;

require_once('../autoload.php');
require_once('DAO/conecta.php');
require_once('DAO/LogDAO.php');
require_once('DAO/dispositivoDAO.php');

$dSelecionado = selecionaDispositivo($conexao2, $_POST["pkDispositivoEx"]);

$fabricante = new Fabricante($dSelecionado[0]["nomeFabricante"]);
$tipo = new Tipo($dSelecionado[0]["nomeTipo"]);
$modelo = new Modelo($dSelecionado[0]["nomeModelo"]);
$usuario = new Usuario($dSelecionado[0]["nomeUsuario"]);
$criptografiaAux = new Criptografia($dSelecionado[0]["hostname"]);
$criptografia = new Criptografia($criptografiaAux->getTextReveal());

$dispositivo = new Dispositivo($dSelecionado[0]["idDispositivo"], $criptografia, $dSelecionado[0]["ip"],
$dSelecionado[0]["ativoDispositivo"], $tipo, $fabricante, $modelo, $usuario);

$log = new Log($_POST["senhaDispositivoEx"], $dispositivo);
insereLog($conexao2, $log);






// $dispositivo = new Dispositivo($_POST["idCad"], $criptografia, $_POST["ipCad"], $_POST["ativoCad"], $tipo, $fabricante, $modelo, $usuario);
// $log = new Log($senha, $dispositivo);

// var_dump($dispositivo);
// var_dump(insereLog($conexao2, $log));