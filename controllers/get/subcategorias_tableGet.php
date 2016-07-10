<?php
    include_once( MODELS_DIR . 'subcategoria.php');
    $categorias = null;
    if(isset($_GET['search']) and $_GET['search'] !='')
    {
        $categoria = getCategoriaByUrl($_GET['url']);
        $id_categoria = $categoria->getIdCategoria();
        $subcategorias = Subcategoria::SearchSubCategoria($_GET['search'],$id_categoria);
    }
    else
    {
        $categoria = Categoria::getCategoriaByUrl($_GET['url']);
        $id_categoria = $categoria->getIdCategoria();
        $subcategorias = Subcategoria::getAllSubcategorias($id_categoria);
    }
    foreach ($subcategorias as &$subcategoria)
    {
        $id = $subcategoria->getIdSubcategoria();
        $estado = $subcategoria->getEstado();
    ?>

    <tr class="subcategoria">
        <td><?php echo($subcategoria->getIdSubcategoria())?></td>
        <td><?php echo($subcategoria->getNombre())?></td>


        <td>
                <?php


                    if($subcategoria->getEstado()==1)
                    {

                        echo('<a class="btn cambiar-estado green" id="'. $id .'" estado="1">Desabilitar</a>');

                    }
                    else
                    {

                      echo('<a class="btn cambiar-estado red" id="'. $id .'" estado="0">Habilitar</a>');


                    }

                ?>
        </td>
    </tr>

<?php
    }

?>
