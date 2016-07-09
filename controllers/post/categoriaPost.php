<?php
    include_once(MODELS_DIR . 'categoria.php');
    if(!isset($_GET['mod']))
        {
            $time = time();
            $categoria = new Categoria();
            $categoria->setNombre($_GET['nombre']);
            $categoria->setDescripcion($_GET['descripcion']);
            $categoria->setUrl($time);

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
            //$categoria = new Categoria($_GET['id_categoria'],$_GET['nombre'],$_GET['descripcion']);
            //$categoria->update();

            $categoria = new Categoria();
            $categoria->setIdCategoria($_POST['id_categoria']);
            $categoria->setNombre($_POST['nombre']);
            $categoria->setDescripcion($_POST['descripcion']);
            $categoria->setUrl(null);
            $categoria->setEstado(null);
            $categoria->updateCategoria();
            echo('1');
        }
        //mode 2: cambio de estado
        else if($_GET['mod']==2)
        {
            Categoria::cambiarEstado($_GET['id'],$_GET['estado']);
            echo('1');
        }
?>
