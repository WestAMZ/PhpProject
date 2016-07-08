<?php

    include(MODELS_DIR . 'solicitud.php');

        //$idSitio, $nombre, $pais, $ciudad, $direccion, $telefono, $latitud, $longitud, $estado
        if(!isset($_GET['mod']))
        {
            echo('dentro if');
            $solicitud = new Solicitud();
            $solicitud->setIdSolicitud(null);
            $solicitud->setFechaSolicitud(null);
            $solicitud->setObservaciones($_GET['observaciones']);
            $solicitud->setEstado(1);
            $solicitud->setIdEmpleado($_GET['id_empleado']);
            $solicitud->setIdTipoSolicitud($_GET['id_tipo_solicitud']);
            $solicitud->setGeneradoPor($_SESSION['id_empleado']);
            $solicitud-> setAprobadoPor($_SESSION['id_empleado']);
            $solicitud->setFechaAprobacion(null);
            if($solicitud-> saveSolicitud())
            {
                echo ('1');
            }
            else
            {
                echo ($aviso->add_error());
            }
        }




?>
