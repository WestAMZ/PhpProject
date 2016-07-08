<?php
    App::getHead('Login');
    App::getModal();
?>
<body>
    <div class="container-fluid">
        <div id="formlogin" class="col s6">
            <form id="login_form" class="col s12 m12">
                <div class="row">
                    <div id="form-title" class="col s12">
                        <h3> Inicio de Sesion</h3>
                    </div>
                </div>
                <div id="result"></div>
                <div class="row">
                    <div class="input-field col s11 center">
                        <i class="material-icons prefix">account_circle</i>
                        <input id="email" type="email" class="validate center" required name="correo">
                        <label for="email" data-error="email invalido" data-success="email correcto">Email</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s11">
                        <i class="material-icons prefix">vpn_key</i>
                        <input id="password" type="password" class="validate center" name="password"required>
                        <label for="password">Password</label>
                    </div>
                </div>
                <div class="row">
                    <p id="checkboxlogin" class="col s11">
                        <input type="checkbox" id="checklogin" />
                        <label for="checklogin">Recordar Contraseña</label>
                    </p>
                </div>
                <div class="row">
                    <p class="center col s12">
                        <button id="buttonaccess" class="btn waves-effect waves-light" type="submit" name="action">Acceder</button>
                    </p>
                </div>
            </form>
        </div>
    </div>

    <!-- this part is the script to use -->
    <script src="<?php echo(AJAX_DIR) ?>login.js">
    </script>
</body>

</html>
