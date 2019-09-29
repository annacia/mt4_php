<?php 
require_once('autoload.php');
require_once('autoload/DAO/dispositivoDAO.php');
include("cabecalho.php");
?>
<section class="section-table">
    <div class="container">
    <h2>Executar Comando SSH</h2>
    <p>(Não esqueça de verificar suas configurações de conexão)</p> 
    <form class="form-ex" action="autoload/executaComando.php" method="post">
            <div class="form-group">
                <label for="pkDispositivoEx">Dispositivo</label>
                <select class="form-control" id="pkDispositivoEx" name="pkDispositivoEx">
                    <?php
                    $dispositivosLista = listaDispositivos($conexao2); 
                    foreach($dispositivosLista as $dl) :
                    ?>
                    <option value="<?= $dl['pkDispositivo'] ?>">Dispositivo <?= $dl['idDispositivo']?></option>
                    <?php endforeach ?>
                </select>
            </div>
            <div class="form-group">
                <label for="senhaDispositivoEx">Senha</label>
                <input type="password" class="form-control" id="senhaDispositivoEx" name="senhaDispositivoEx">
            </div>
            <div class="form-group">
                <label for="comandoDispositivoEx">Comando</label>
                <select class="form-control" id="comandoDispositivoEx" name="comandoDispositivoEx">
                    <option value="WHOAMI">WHOAMI</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Executar</button>
        </form>
        <a href="/mt4_php/"><button type="button" class="btn btn-secondary">Voltar</button></a>
    </div>
</section>
    
<?php include("rodape.php"); ?>