<?php
    include_once( MODELS_DIR . 'categoria.php');
    $categorias = null;
    if(isset($_GET['search']) and $_GET['search'] !='')
    {
        $categorias = Categoria::SearchinCategoria($_GET['search']);
    }
    else
    {
        $categorias = Categoria::getCategorias();
    }
    echo(sizeof($categorias));
    foreach ($categorias as &$categoria)
    {

?>

    <tr class="categoria">
        <td><?php echo($categoria->getIdCategoria())?></td>
        <td><?php echo($categoria->getNombre())?></td>
        <td><?php echo($categoria->getDescripcion())?></td>

        <td>
                <?php
                    if($categoria->getEstado()==1)
                    {

                        echo('<button class="btn cambiar-estado green" id="<?php echo($categoria->getCategoria())?>" estado="<?php echo($sitio->getEstado())?>">Habilitar</button>');

                    }
                    else
                    {

                      echo('<button class="btn cambiar-estado red" id="<?php echo($categoria->getCategoria())?>" estado="<?php echo($sitio->getEstado())?>">Deshabilitar</button>');


                    }
                ?>
        </td>
    </tr>

<?php
    }

?>
