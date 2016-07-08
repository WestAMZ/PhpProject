<?php
    if(!isset($_GET['mod']))
        {
            $categoria = new Categoria($_GET['nombre'],$_GET['descripcion'],null);

            if($categoria->saveCategoria())
            {
                echo ('1');
            }
            else
            {
                echo ($categoria->add_error());
            }
        }
        //mode 1 : update
        else if($_GET['mod']==1)
        {
            $categoria = new Categoria($_GET['id_categoria'],$_GET['nombre'],$_GET['descripcion']);
            $categoria->update();
        }
        //mode 2: cambio de estado
        else if($_GET['mod']==2)
        {
            Categoria::cambiarEstado($_GET['id'],$_GET['estado']);
            echo('1');
        }
?>
