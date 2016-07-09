<?php
    App::getHead('Subir archivo');
?>

    <div id="main-container" class="container-fluid row full">

<?php
    App::getLeftMain();
    App::getRightMain();
    include(HTML_DIR. 'archivo.html');
    App::getModal();
?>
