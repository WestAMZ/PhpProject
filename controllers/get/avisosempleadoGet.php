<?php
include( MODELS_DIR . 'aviso.php');

$avisos = Aviso::getAvisosDelDia();
    foreach ($avisos as &$aviso)
    {
?>
    <li>
        <img src="<?php echo(IMG_DIR)?>cirular.png">
        <div class="caption center-align">
            <h3><?php echo($aviso->getTitulo())?></h3>
            <p class="date"><?php echo(date('y-m-j')) ?></p>
            <h5><?php echo($aviso->getContenido())?></h5>
        </div>
    </li>

    <?php
    }
?>
