<?php
    App::getHead('Gestion Permisos');
    Connection::initSession();
?>
    <div id="main-container" class="container-fluid row full">
<?php
        App::getLeftMain();
        App::getRightMain();
        App::getPermisos();
        App::getModal();
        App::getModalJefe();
?>

</div>

 </html>
