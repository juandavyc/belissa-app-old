<header class="special container">
    <span class="<?= $app->menu->current['icon'] ?>"></span>
    <h2>
        <?= $app->menu->current['name'] ?>
    </h2>
    <p>Ingrese sus credenciales para iniciar la sesión</p>
</header>

<div style="height: 55vh; display: flex;align-items: center;">

    <section class="wrapper style3 container xsmall">
        <form id="formulario-iniciar-session">
            <div class="row gtr-25 gtr-uniform">
                <div class="col-12 align-center">
                    <h3>Ir a <b><?= $app::NAME ?></b></h3>
                </div>
                <div class="col-12">
                    <label class="label-important" for="usuario"> <b>Cedula</b></label>
                    <div class="input-container">
                        <i class="fa fa-user icon-input"></i>
                        <div>
                            <input type="text" id="usuario" name="usuario" maxlength="25" required="" placeholder="Cedula" autocomplete="off">
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <label class="label-important" for="contrasenia"> <b>Contraseña</b></label>
                    <div class="input-container">
                        <i class="fa fa-lock icon-input"></i>
                        <div>
                            <input type="password" id="contrasenia" name="contrasenia" maxlength="25" required="" placeholder="Contraseña" autocomplete="off">
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <br>
                    <button type="submit" class="primary small fit icon solid fa-sign-in-alt">
                        INICIAR SESIÓN
                    </button>
                </div>
                <div class="col-12 align-right">
                    <a id="recuperar-contrasenia">¿Has olvidado tu contraseña?</a>
                </div>
            </div>
        </form>
    </section>
</div>