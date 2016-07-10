<?php
    include_once(MODELS_DIR . 'subcategoria.php');
    if(!isset($_GET['mod']))
        {
            $time = time();
            $subcategoria = new Subcategoria();
            $subcategoria->setNombre($_GET['nombre']);
            $subcategoria->setUrl($time);

            if($subcategoria->saveSubcategoria())
            {
                echo ('1');
            }
            else
            {
                echo ($subcategoria->add_error());
            }
        }
        //mode 1 : update
        else if($_GET['mod']==1)
        {
            //$subcategoria = new subcategoria($_GET['id_subcategoria'],$_GET['nombre'],$_GET['descripcion']);
            //$subcategoria->update();

            $subcategoria = new Subcategoria();
            $subcategoria->setIdSubcategoria($_POST['id_subcategoria']);
            $subcategoria->setNombre($_POST['nombre']);
            $subcategoria->setUrl(null);
            $subcategoria->setEstado(null);
            $subcategoria->updateSubcategoria();
            echo('1');
        }
        //mode 2: cambio de estado
        else if($_GET['mod']==2)
        {
           if( Subcategoria::cambiarEstado($_GET['id'],$_GET['estado']))
           {
                echo('1');
           }

        }
?>
