<?php 
require_once('autoload.php');
include_once('autoload/DAO/dispositivoDAO.php');

use autoload\Classes\Dispositivo as Dispositivo;
use autoload\Classes\Fabricante as Fabricante;
use autoload\Classes\Modelo as Modelo;
use autoload\Classes\Tipo as Tipo;
use autoload\Classes\Usuario as Usuario;
use autoload\Classes\Criptografia as Criptografia;
 
$dSelecionado = selecionaDispositivo($conexao2, $_GET['pk']);

$fabricante = new Fabricante($dSelecionado[0]["nomeFabricante"]);
$tipo = new Tipo($dSelecionado[0]["nomeTipo"]);
$modelo = new Modelo($dSelecionado[0]["nomeModelo"]);
$usuario = new Usuario($dSelecionado[0]["nomeUsuario"]);
$criptografia = new Criptografia($dSelecionado[0]["hostname"]);

$dispositivo = new Dispositivo($dSelecionado[0]["idDispositivo"], $criptografia, $dSelecionado[0]["ip"],
$dSelecionado[0]["ativoDispositivo"], $tipo, $fabricante, $modelo, $usuario);

include("cabecalho.php");
?>

<section class="section-table">
    <div class="container">
        <h2>Editando Dispositivo <?=$dispositivo->getId()?></h2>
        <form class="form-ex" action="autoload/dispositivoEdicao.php" method="post">
            <div class="form-group">
                <label for="idCad">Identificador Único (ID)</label>
                <input type="text" class="form-control" id="idCad" name="idCad" value="<?=$dispositivo->getId()?>">
            </div>

            <div class="form-group">
                <label for="hostnameCad">Hostname</label>
                <input type="text" class="form-control" id="hostnameCad" name="hostnameCad" value="<?=$dispositivo->getHostname()->getTextReveal()?>">
            </div>

            <div class="form-group">
                <label for="ipCad">IP</label>
                <input type="text" class="form-control" id="ipCad" name="ipCad" value="<?=$dispositivo->getIp()?>">
            </div>

            <div class="form-group">
                <label for="usuarioCad">Usuário</label>
                <input type="text" class="form-control" id="usuarioCad" name="usuarioCad" value="<?=$dispositivo->getUsuario()->getNome()?>">
            </div>

            <div class="form-group">
                <label for="tipoCad">Tipo</label>
                <input type="text" class="form-control" id="tipoCad" name="tipoCad" value="<?=$dispositivo->getTipo()->getNome()?>">
            </div>

            <div class="form-group">
                <label for="fabricanteCad">Fabricante</label>
                <input type="text" class="form-control" id="fabricanteCad" name="fabricanteCad" value="<?=$dispositivo->getFabricante()->getNome()?>">
            </div>

            <div class="form-group">
                <label for="modeloCad">Modelo</label>
                <input type="text" class="form-control" id="modeloCad" name="modeloCad" value="<?=$dispositivo->getModelo()->getNome()?>">
            </div>

            <div class="form-group">
                <label for="ativoCad">Ativo/Inativo</label>
                <select class="form-control" id="ativoCad" name="ativoCad">
                    <option value="1">Ativo</option>
                    <option value="0">Inativo</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Salvar Alterações</button>
            <input type="hidden" name="pk" value="<?=$_GET['pk']?>">
        </form>
        <a href="/mt4_php/lista.php"><button type="button" class="btn btn-secondary">Voltar</button></a>
    </div>
</section>
    
<?php include("rodape.php"); ?>