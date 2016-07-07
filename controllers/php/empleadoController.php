<?php
    App::getHead('Employees');
?>

    <div id="main-container" class="container-fluid row full">

<?php
    App::getLeftMain();
    App::getRightMain();
    if($_SESSION['role']=='1')
    {
        //gerente general
        App::getEmployee_gg();
    }
    else if($_SESSION['role']=='2')
    {
        //gerente de sitio
    }

    App::getModal();
    App::getModalPuesto();
?>
