<?php
    include(MODELS_DIR . 'insidencia.php');
    include_once (MODELS_DIR . 'usuario.php');
    include(MODELS_DIR . 'comentario.php');

    $insidencias = Insidencia :: getInsidencias();
    foreach ($insidencias as &$insidencia)
    {
        if($insidencia->getId_Usuario() == $_SESSION['id_usuario'])
        {
            if($insidencia->getEstado() == 1)
            {
?>

    <div class="row">
        <div class="col s12 m10 offset-m1" style="margin-bottom:50px">
            <div class="card">
                <div class="card-content" style="height:auto;">
                    <div class="row">
                        <div class="col s2">

                            <div class="profile-preview-mini" style="background:url(<?php
                    $usuario = Usuario::getUsuarioById($insidencia->getId_Usuario());
                    echo(PROFILE_DIR . $usuario->getFoto());
                  ?>)">
                            </div>
                        </div>
                        <div class="col s8 left-align">
                            <p class="grey-text text-darken-4 margin">
                                <?php echo(Usuario :: getNameUser($insidencia->getId_Usuario())) ?>
                            </p>
                            <span class="grey-text text-darken-1 ultra-small"><?php echo($insidencia->getFecha())?></span>

                            <p>
                                <a href="<?php echo(INSIDENCIAS_DIR. $insidencia->getAdjunto()) ?>">
                                    <?php echo($insidencia->getAdjunto()) ?>
                                </a>
                            </p>
                        </div>
                        <div class="col s2">
                            <?php
                                if($insidencia->getId_Usuario() == $_SESSION['id_usuario'])
                                {
                            ?>
                                <a class="editar" name="<?php echo($insidencia->getId_Insidencia())?>" style="cursor:pointer"><i class="material-icons">edit</i></a>
                                <?php
                                }
                            ?>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col s12">
                            <p class="left-align">
                                <?php echo($insidencia->getDescripcion())?>
                            </p>
                        </div>
                    </div>
                </div>
                <form class="formcomentario" id="formcomentario" class="card-action row">
                    <div class="col s12 m2 card-action-share left-align">
                        <span class="badge green white-text left-align" style="border-radius:10px"> <?php echo(Comentario :: getTotalComment($insidencia->getId_Insidencia()))?></span>
                        <a class="activator" style="cursor:pointer">Ver Comentarios</a>
                        <a class="finalizar" name="<?php echo($insidencia->getId_Insidencia())?>" style="cursor:pointer">Finalizar</a>
                    </div>


                    <div class="input-field col s10 m8">
                        <textarea id="comment" row="2" class="materialize-textarea" name="comentario" required></textarea>
                        <label for="comment">Comentar</label>
                    </div>
                    <div class="col s1 m1" style="margin-top:40px">
                        <button class="btn-floating btn-large waves-effect waves-light red tooltipped" type="submit" data-position="top" data-delay="50" data-tooltip="Enviar comentario"><i class="material-icons">send</i></button>
                    </div>
                    <input type="hidden" name="Id_Insidencia" value="<?php echo($insidencia->getId_Insidencia()) ?>">
                    <div class="result-comentario">
                    </div>
                </form>

                <form class="formcomentario card-reveal">
                    <p class=" brown-text">
                        <?php echo($insidencia->getDescripcion())?>
                    </p>
                    <span class="card-title grey-text text-darken-4 left-align">Comentarios<i class="material-icons right">close</i></span>
                    <ul class="collection">

                        <?php include( GET_DIR . 'comentariosGet.php')?>

                    </ul>
                </form>
            </div>
        </div>
    </div>

    <?php
            }
            else
            {
    ?>

        <div class="row">
            <div class="col s12 m10 offset-m1" style="margin-bottom:50px">
                <div class="card">
                    <div class="card-content" style="height:auto;">
                        <div class="row">
                            <div class="col s2">

                                <div class="profile-preview-mini" style="background:url(<?php
                    $usuario = Usuario::getUsuarioById($insidencia->getId_Usuario());
                    echo(PROFILE_DIR . $usuario->getFoto());
                  ?>)">
                                </div>
                            </div>
                            <div class="col s8 left-align">
                                <p class="grey-text text-darken-4 margin">
                                    <?php echo(Usuario :: getNameUser($insidencia->getId_Usuario())) ?>
                                </p>
                                <span class="grey-text text-darken-1 ultra-small"><?php echo($insidencia->getFecha())?></span>

                                <p>
                                    <a href="<?php echo(FILE_DIR . $insidencia->getAdjunto()) ?>">
                                        <?php echo($insidencia->getAdjunto()) ?>
                                    </a>
                                </p>
                            </div>
                            <div class="col s2">
                                <?php
                                if($insidencia->getId_Usuario() == $_SESSION['id_usuario'])
                                {
                            ?>
                                    <a class="editar" name="<?php echo($insidencia->getId_Insidencia())?>" style="cursor:pointer"><i class="material-icons">edit</i></a>

                                    <?php
                                }
                            ?>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col s12">
                                <p class="left-align">
                                    <?php echo($insidencia->getDescripcion())?>
                                </p>
                            </div>
                        </div>
                    </div>
                    <form class="formcomentario" id="formcomentario" class="card-action row">
                        <div class="col s12 m2 card-action-share left-align">
                            <span class="badge green white-text left-align" style="border-radius:10px"> <?php echo(Comentario :: getTotalComment($insidencia->getId_Insidencia()))?></span>
                            <a class="activator" style="cursor:pointer">Ver Comentarios</a>
                            <a class="activar" style="cursor:pointer" name="<?php echo($insidencia->getId_Insidencia())?>">Reanudar</a>
                        </div>


                        <div class="input-field col s10 m8">
                            <textarea id="comment" row="2" class="materialize-textarea center" name="comentario" placeholder="Resuelta" required disabled></textarea>
                            <label for="comment">Comentar</label>
                        </div>
                        <div class="col s1 m1" style="margin-top:40px">
                            <button disabled class="btn-floating btn-large waves-effect waves-light red tooltipped" type="submit" data-position="top" data-delay="50" data-tooltip="Enviar comentario"><i class="material-icons">send</i></button>
                        </div>
                        <input type="hidden" name="Id_Insidencia" value="<?php echo($insidencia->getId_Insidencia()) ?>">
                        <div class="result-comentario">
                        </div>
                    </form>

                    <form class="formcomentario card-reveal">
                        <p class=" brown-text">
                            <?php echo($insidencia->getDescripcion())?>
                        </p>
                        <span class="card-title grey-text text-darken-4 left-align">Comentarios<i class="material-icons right">close</i></span>
                        <ul class="collection">

                            <?php include( GET_DIR . 'comentariosGet.php')?>

                        </ul>
                    </form>
                </div>
            </div>
        </div>

        <?php
            }
        }
        else
        {
            if($insidencia->getEstado() == 1)
            {
        ?>

            <div class="row">
                <div class="col s12 m10 offset-m1" style="margin-bottom:50px">
                    <div class="card">
                        <div class="card-content" style="height:auto;">
                            <div class="row">
                                <div class="col s2">

                                    <div class="profile-preview-mini" style="background:url(<?php
                    $usuario = Usuario::getUsuarioById($insidencia->getId_Usuario());
                    echo(PROFILE_DIR . $usuario->getFoto());
                  ?>)">
                                    </div>
                                </div>
                                <div class="col s8 left-align">
                                    <p class="grey-text text-darken-4 margin">
                                        <?php echo(Usuario :: getNameUser($insidencia->getId_Usuario())) ?>
                                    </p>
                                    <span class="grey-text text-darken-1 ultra-small"><?php echo($insidencia->getFecha())?></span>

                                    <p>
                                        <a href="<?php echo(FILE_DIR . $insidencia->getAdjunto()) ?>">
                                            <?php echo($insidencia->getAdjunto()) ?>
                                        </a>
                                    </p>
                                </div>
                                <div class="col s2">
                                    <?php
                                if($insidencia->getId_Usuario() == $_SESSION['id_usuario'])
                                {
                            ?>
                                        <a class=" tooltipped" data-position="bottom" data-delay="50" data-tooltip="I am tooltip" name=<?php $insidencia->getId_Insidencia()?>><i class="material-icons editar-inisdencia">edit</i></a>
                                        <?php
                                }
                            ?>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col s12">
                                    <p class="left-align">
                                        <?php echo($insidencia->getDescripcion())?>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <form class="formcomentario" id="formcomentario" class="card-action row">
                            <div class="col s12 m2 card-action-share left-align">
                                <span class="badge green white-text left-align" style="border-radius:10px"> <?php echo(Comentario :: getTotalComment($insidencia->getId_Insidencia()))?></span>
                                <a class="activator" style="cursor:pointer">Ver Comentarios</a>
                            </div>


                            <div class="input-field col s10 m8">
                                <textarea id="comment" row="2" class="materialize-textarea" name="comentario" required></textarea>
                                <label for="comment">Comentar</label>
                            </div>
                            <div class="col s1 m1" style="margin-top:40px">
                                <button class="btn-floating btn-large waves-effect waves-light red tooltipped" type="submit" data-position="top" data-delay="50" data-tooltip="Enviar comentario"><i class="material-icons">send</i></button>
                            </div>
                            <input type="hidden" name="Id_Insidencia" value="<?php echo($insidencia->getId_Insidencia()) ?>">
                            <div class="result-comentario">
                            </div>
                        </form>

                        <form class="formcomentario card-reveal">
                            <p class=" brown-text">
                                <?php echo($insidencia->getDescripcion())?>
                            </p>
                            <span class="card-title grey-text text-darken-4 left-align">Comentarios<i class="material-icons right">close</i></span>
                            <ul class="collection">

                                <?php include( GET_DIR . 'comentariosGet.php')?>

                            </ul>
                        </form>
                    </div>
                </div>
            </div>

            <?php
            }
            else
            {
            ?>

            <div class="row">
                <div class="col s12 m10 offset-m1" style="margin-bottom:50px">
                    <div class="card">
                        <div class="card-content" style="height:auto;">
                            <div class="row">
                                <div class="col s2">

                                    <div class="profile-preview-mini" style="background:url(<?php
                    $usuario = Usuario::getUsuarioById($insidencia->getId_Usuario());
                    echo(PROFILE_DIR . $usuario->getFoto());
                  ?>)">
                                    </div>
                                </div>
                                <div class="col s8 left-align">
                                    <p class="grey-text text-darken-4 margin">
                                        <?php echo(Usuario :: getNameUser($insidencia->getId_Usuario())) ?>
                                    </p>
                                    <span class="grey-text text-darken-1 ultra-small"><?php echo($insidencia->getFecha())?></span>

                                    <p>
                                        <a href="<?php echo(FILE_DIR . $insidencia->getAdjunto()) ?>">
                                            <?php echo($insidencia->getAdjunto()) ?>
                                        </a>
                                    </p>
                                </div>
                                <div class="col s2">
                                    <?php
                                if($insidencia->getId_Usuario() == $_SESSION['id_usuario'])
                                {
                            ?>
                                        <a href="#" class=" tooltipped" data-position="bottom" data-delay="50" data-tooltip="I am tooltip"><i class="material-icons">edit</i></a>
                                        <?php
                                }
                            ?>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col s12">
                                    <p class="left-align">
                                        <?php echo($insidencia->getDescripcion())?>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <form class="formcomentario" id="formcomentario" class="card-action row">
                            <div class="col s12 m2 card-action-share left-align">
                                <span class="badge green white-text left-align" style="border-radius:10px"> <?php echo(Comentario :: getTotalComment($insidencia->getId_Insidencia()))?></span>
                                <a class="activator" style="cursor:pointer">Ver Comentarios</a>
                            </div>


                            <div class="input-field col s10 m8">
                                <textarea id="comment" row="2" class="materialize-textarea center" name="comentario" required disabled placeholder="Resuelta"></textarea>
                                <label for="comment">Comentar</label>
                            </div>
                            <div class="col s1 m1" style="margin-top:40px">
                                <button disabled class="btn-floating btn-large waves-effect waves-light red tooltipped" type="submit" data-position="top" data-delay="50" data-tooltip="Enviar comentario"><i class="material-icons">send</i></button>
                            </div>
                            <input type="hidden" name="Id_Insidencia" value="<?php echo($insidencia->getId_Insidencia()) ?>">
                            <div class="result-comentario">
                            </div>
                        </form>

                        <form class="formcomentario card-reveal">
                            <p class=" brown-text">
                                <?php echo($insidencia->getDescripcion())?>
                            </p>
                            <span class="card-title grey-text text-darken-4 left-align">Comentarios<i class="material-icons right">close</i></span>
                            <ul class="collection">

                                <?php include( GET_DIR . 'comentariosGet.php')?>

                            </ul>
                        </form>
                    </div>
                </div>
            </div>

<?php
            }
        }
    }
?>
