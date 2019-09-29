<?php 
require_once('autoload.php');
include_once('autoload/DAO/dispositivoDAO.php');
include("cabecalho.php");
?>
<section class="section-table">
    <div class="container">
        <h2>Relatório</h2>
        <table class="table table-striped table-bordered table-responsive table-mt4">
        <thead class="thead-mt4">
            <tr class="tr-mt4">
            <th scope="col">ID</th>
            <th scope="col">Hostname</th>
            <th scope="col">IP</th>
            <th scope="col">Tipo</th>
            <th scope="col">Ativo/Inativo</th>
            <th scope="col">Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $dispositivosLista = listaDispositivos($conexao2); 
            foreach($dispositivosLista as $dl) :
            ?>
            <tr class="tr-mt4">
                <th scope="row"><?= $dl['idDispositivo']?></th>
                <td><?= $dl['hostname']?></td>
                <td><?= $dl['ip']?></td>
                <td><?= $dl['nomeTipo']?></td>
                <td>
                    <?php
                    ($dl['ativoDispositivo']==0) ? $echo = 'Não' : $echo = 'sim';
                    echo $echo;
                    ?>
                </td>
                <td>
                    <form action="edicao.php?pk=<?= $dl['pkDispositivo']?>" method="post">
                        <input type="hidden" name="pk" value="<?= $dl['pkDispositivo']?>">
                        <button class="edite-btn" type="submit"><i class="fas fa-pencil-alt"></i> Editar</button><br>
                    </form>
                    <?php
                    if ($dl['ativoDispositivo']==0){
                        echo '<a data-value="' . $dl["pkDispositivo"] . '" class="ative-btn" href="#"><i class="fas fa-toggle-on"></i> Ativar</a><br>';
                    }
                    else{
                        echo '<a data-value="' . $dl["pkDispositivo"] . '" class="desative-btn" href="#"><i class="fas fa-toggle-off" ></i> Desativar</a><br>'; 
                    }
                    ?>
                    
                    
                </td>
            </tr>
            <?php endforeach ?>
            
            
        </tbody>
        </table>
        <a href="/mt4_php/"><button type="button" class="btn btn-secondary">Voltar</button></a>
    </div>
</section>
    
<?php include("rodape.php"); ?>