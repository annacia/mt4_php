<?php 
require_once('autoload.php');
include_once('autoload/DAO/dispositivoDAO.php');
include("cabecalho.php");
?>

<section class="section-table">
    <div class="container">
        <h2>Cadastro de Dispositivo</h2> 
        <form class="form-ex" action="autoload/dispositivoCadastro.php" method="post">
            <div class="form-group">
                <label for="idCad">Identificador Único (ID)</label>
                <input type="text" class="form-control" id="idCad" name="idCad">
            </div>

            <div class="form-group">
                <label for="hostnameCad">Hostname</label>
                <input type="text" class="form-control" id="hostnameCad" name="hostnameCad">
            </div>

            <div class="form-group">
                <label for="ipCad">IP</label>
                <input type="text" class="form-control" id="ipCad" name="ipCad">
            </div>

            <div class="form-group">
                <label for="usuarioCad">Usuário</label>
                <input type="text" class="form-control" id="usuarioCad" name="usuarioCad">
            </div>

            <div class="form-group">
                <label for="tipoCad">Tipo</label>
                <input type="text" class="form-control" id="tipoCad" name="tipoCad">
            </div>

            <div class="form-group">
                <label for="fabricanteCad">Fabricante</label>
                <input type="text" class="form-control" id="fabricanteCad" name="fabricanteCad">
            </div>

            <div class="form-group">
                <label for="modeloCad">Modelo</label>
                <input type="text" class="form-control" id="modeloCad" name="modeloCad">
            </div>

            <div class="form-group">
                <label for="ativoCad">Ativo/Inativo</label>
                <select class="form-control" id="ativoCad" name="ativoCad">
                    <option value="1">Ativo</option>
                    <option value="0">Inativo</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Cadastrar</button>
        </form>
        <a href="/mt4_php/"><button type="button" class="btn btn-secondary">Voltar</button></a>
    </div>
</section>

<?php include("rodape.php"); ?>
    