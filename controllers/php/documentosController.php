<?php
    App::getHead('Documentos');
    Connection::initSession();
?>
    <div id="main-container" class="container-fluid row full">
<?php
        App::getLeftMain();
        App::getRightMain();
        include(HTML_DIR . 'documentos.html');
        App::getModal();
?>

    </div>

    </html>
