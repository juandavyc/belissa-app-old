<?php $app->ruta->getComponent('HeaderContainer', $app->menu->current) ?>
<section class="wrapper style3 container max" id="container-ingreso-cliente">
    <?php ///require $app->ruta->getView('test/CodigoQr') 
    ?>
    <?php //require $app->ruta->getView('test/IngresoCliente') 
    ?>
    <form id="form-mercadeo">
        <div class="row gtr-25 gtr-uniform">
            <div class="col-6">
                <label class="label-important label-datos-alt"> Canal de mercadeo </label>
                <div class="input-container">
                    <i class="fas fa-briefcase icon-input"></i>
                    <div>
                        <input type="text" id="ingreso-canal-mercadeo-text" value="" placeholder="Escriba el canal de mercadeo" autocomplete="off">
                        <div style="display: none;">
                            <input type="text" name="canal_mercadeo_create" id="ingreso_canal_mercadeo_select" value="" required="">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <label class="label-important label-datos-alt"> Canal de mercadeo </label>
                <div class="input-container">
                    <i class="fas fa-briefcase icon-input"></i>
                    <div>
                        <input type="text" id="ingreso-canal-mercadeo-2-text" value="" placeholder="Escriba el canal de mercadeo" autocomplete="off">
                        <div style="display: none;">
                            <input type="text" name="canal_mercadeo_no_create" id="ingreso-canal-mercadeo-2-select" value="" data-default="1" required="">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-4">
            </div>
            <div class="col-8">
                <input type="radio" id="huey" name="drone" value="huey" checked />
                <label for="huey">Huey</label>
                <input type="radio" id="raptor" name="drone" value="raptor" />
                <label for="raptor">raptor</label>
                checkbox
                <input type="checkbox" id="raptor_2" name="droned" value="raptor" />
                <label for="raptor_2">raptor</label>
            </div>
            <div class="col-6">
                <button type="submit" class="primary">Submit</button>
            </div>
        </div>
    </form>
</section>