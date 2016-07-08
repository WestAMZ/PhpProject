<?php
    App::getHead('Gestion Sitio');
    Connection::initSession();
?>
    <div id="main-container" class="container-fluid row full">

<?php
        App::getLeftMain();
        App::getRightMain();
        App::getModal();
        App::getSitio();
?>

    </div>

</html>
