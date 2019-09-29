<?php 
require_once('autoload.php');
include_once('autoload/DAO/logDAO.php');
include("cabecalho.php");
?>

<section class="section-table">
    <div class="container">
        <h2>Logs de Conexões</h2>
        <table class="table table-striped table-bordered table-responsive table-mt4">
        <thead class="thead-mt4">
            <tr class="tr-mt4">
                <th scope="col">Resultado</th>
                <th scope="col">Data/Hora</th>
                <th scope="col">ID</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $logLista = listaLogs($conexao2); 
            foreach($logLista as $l) :
            ?>
            <tr class="tr-mt4">
                <th scope="row"><?= $l['resultado']?></th>
                <td><?= $l['createdLog']?></td>
                <td><?= $l['idDispositivo']?></td>
            </tr>
            <?php endforeach ?>
        </tbody>
        </table>
        <a href="/mt4_php/"><button type="button" class="btn btn-secondary">Voltar</button></a>
    </div>
</section>
<?php include("rodape.php"); ?>