<?php
    include_once( MODELS_DIR . 'categoria.php');
    $categorias = null;
    if(isset($_GET['search']) and $_GET['search'] !='')
    {
        $categorias = Categoria::SearchCategoria($_GET['search']);
    }
    else
    {
        $categorias = Categoria::getCategorias();
    }
    echo(sizeof($categorias));
    foreach ($categorias as &$categoria)
    {
        $id = $categoria->getIdCategoria();
        $estado = $categoria->getEstado();
    ?>

    <tr class="categoria">
        <td><?php echo($categoria->getIdCategoria())?></td>
        <td><?php echo($categoria->getNombre())?></td>
        <td><?php echo($categoria->getDescripcion())?></td>

        <td>
                <?php
                    if($categoria->getEstado()==1)
                    {

                        echo('<button class="btn cambiar-estado red" id="'. $id .'" estado="1">Deshabilitar</button>');

                    }
                    else
                    {

                      echo('<button class="btn cambiar-estado green" id="'. $id .'" estado="1">Habilitar</button>');


                    }
                ?>
        </td>
    </tr>

<?php
    }

?>
