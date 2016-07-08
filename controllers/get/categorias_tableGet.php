<?php
    include_once( MODELS_DIR . 'categoria.php');
    if(isset($_GET['search']) and $_GET['search'] !='')
    {
    $categorias = Categoria::SearchinCategoria($_GET['search']);
    foreach ($categorias as &$categoria)
    {
?>
    <tr class="sitio">
        <td><?php echo($sitio->getIdSitio())?></td>
        <td><?php echo($sitio->getName())?></td>
        <td><?php echo($sitio->getCity())?></td>
        <td><?php echo($sitio->getCountry())?></td>
        <td><?php echo($sitio->getPhone())?></td>
        <td><?php echo($sitio->getAddress())?></td>
        <td>
            <button class="btn cambiar-estado" id="<?php echo($sitio->getIdSitio())?>" estado="<?php echo($sitio->getStatus())?>">
                <?php
                    if($sitio->getStatus()==1)
                    {
                        echo('Desabilitar');
                    }
                    else
                    {
                        echo('Habilitar');
                    }
                ?>
            </button></td>
    </tr>
<?php
    }
}
else
{
    $categoria = Categorias::getCategorias();
    foreach ($categorias as &$categoria)
    {

?>

    <tr class="sitio">
        <td><?php echo($categoria->getIdSitio())?></td>
        <td><?php echo($categoria->getName())?></td>
        <td><?php echo($categoria->getCity())?></td>

        <td>

                <?php
                    if($categoria->getEstado()==1)
                    {
                ?>
                        <button class="btn cambiar-estado green" id="<?php echo($categoria->getCategoria())?>" estado="<?php echo($sitio->getEstado())?>">Habilitar</button></td>
                <?php
                    }
                    else
                    {
                      <button class="btn cambiar-estado red" id="<?php echo($categoria->getCategoria())?>" estado="<?php echo($sitio->getEstado())?>">Deshabilitar</button></td>
                 ?>
                <?php
                    }
                ?>

    </tr>

<?php
    }
}
?>
