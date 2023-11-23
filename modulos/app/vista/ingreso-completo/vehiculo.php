<!-- DEJAR COMENTADO, GENERA BUGS
<div class="col-12 align-right">
    <button class="primary small" id="ingreso-vehiculo-test-moto">TEST MOTO</button>
    <button class="primary small" id="ingreso-vehiculo-test-liviano">TEST LIVIANO</button>
</div>
-->

<div class="col-6 col-12-small">
    <label class="label-datos-alt label-important"> Tipo vehículo </label>
    <div class="input-container">
        <i class="fas fa-car-side icon-input"></i>
        <div>
            <select name="tipo_vehiculo" id="ingreso-tipo_vehiculo">
                <option value="default" selected="">Seleccionar tipo vehículo</option>
            </select>
        </div>
    </div>
</div>
<div class="col-6 col-12-small">
    <label class="label-datos-alt label-important"> Servicio vehículo </label>
    <div class="input-container">
        <i class="fas fa-taxi icon-input"></i>
        <div>
            <select name="servicio_vehiculo" id="ingreso-servicio_vehiculo">
                <option value="default" selected="">Seleccionar servicio vehículo</option>
            </select>
        </div>
    </div>
</div>
<div class="col-6 col-12-small">
    <label class="label-important label-datos-alt"> Marca</label>
    <div class="input-container">
        <i class="fas fa-code-branch icon-input"></i>
        <div>
            <input type="text" id="ingreso-marca-text" value="" placeholder="Marca" autocomplete="off">
            <input type="hidden" name="marca" id="ingreso-marca-select" value="1" data-default="1">
        </div>
    </div>
</div>
<div class="col-6 col-12-small">
    <label class="label-important label-datos-alt"> Linea</label>
    <div class="input-container">
        <i class="fas fa-code-branch icon-input"></i>
        <div>
            <input type="text" id="ingreso-linea-text" value="" placeholder="Linea" autocomplete="off">
            <input type="hidden" name="linea" id="ingreso-linea-select" value="1" data-default="1">
        </div>
    </div>
</div>
<div class="col-6 col-12-small">
    <label class="label-important label-datos-alt"> Modelo</label>
    <div class="input-container">
        <i class="fas fa-hashtag icon-input"></i>
        <div>
            <input type="text" placeholder="2000" id="ingreso-modelo" name="modelo" inputmode="numeric"
                autocomplete="off">
        </div>
    </div>
</div>
<div class="col-6 col-12-small">
    <label class="label-important label-datos-alt"> Color</label>
    <div class="input-container">
        <i class="fas fa-palette icon-input"></i>
        <div>
            <input type="text" id="ingreso-color-text" value="" placeholder="Color" autocomplete="off">
            <input type="hidden" name="color" id="ingreso-color-select" value="1" data-default="1">
        </div>
    </div>
</div>
<div class="col-6 col-12-small" id="container-ingreso-carroceria" hidden>
    <label class="label-important label-datos-alt"> Carroceria</label>
    <div class="input-container">
        <i class="fas fa-code-branch icon-input"></i>
        <div>
            <input type="text" id="ingreso-carroceria-text" value="" placeholder="Carroceria" autocomplete="off">
            <input type="hidden" name="carroceria" id="ingreso-carroceria-select" value="1" data-default="1">
        </div>
    </div>
</div>
<div class="col-6 col-12-small">
    <label class="label-important label-datos-alt"> Combustible</label>
    <div class="input-container">
        <i class="fas fa-gas-pump icon-input"></i>
        <div>
            <select id="ingreso-combustible" name="combustible">
                <option value="default" selected="">Seleccionar combustible</option>
            </select>
        </div>
    </div>
</div>
<div class="col-12" id="container-ingreso-gas-gasolina" hidden>
    <fieldset class="fieldset-alt">
        <legend>
            <i class="fas fa-gas-pump"></i> GNCV / GASOLINA
        </legend>
        <div class="row gtr-25 gtr-uniform">
            <div class="col-6 col-12-small">
                <label class="label-important"> Nro certificado</label>
                <div class="input-container">
                    <i class="fas fa-hashtag icon-input"></i>
                    <div>
                        <input type="text" id="ingreso-certificado_gncv" name="certificado_gncv" inputmode="numeric"
                            value="NO_APLICA" autocomplete="off">
                    </div>
                </div>
            </div>
            <div class="col-6 col-12-small">
                <label class="label-important"> Fecha</label>
                <div class="input-container">
                    <i class="fas fa-calendar-days icon-input"></i>
                    <div>
                        <div class="input-container">
                            <input type="text" id="ingreso-fecha_gncv" name="fecha_gncv" value="01/01/2000"
                                class="input_date_listener" autocomplete="off">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </fieldset>
</div>
<div class="col-6 col-12-mobilep">
    <label class="label-important label-datos-alt"> Capacidad Kg/PSJ</label>
    <div class="input-container">
        <i class="fas fa-taxi icon-input"></i>
        <div>
            <input type="text" placeholder="2" id="ingreso-capacidad" name="capacidad" inputmode="numeric"
                autocomplete="off">
        </div>
    </div>
</div>
<div class="col-6 col-12-mobilep" id="container-ingreso-puertas" hidden>
    <label class="label-important label-datos-alt"> Puertas</label>
    <div class="input-container">
        <i class="fas fa-taxi icon-input"></i>
        <div>
            <input type="text" placeholder="2" id="ingreso-puertas" name="puertas" inputmode="numeric"
                autocomplete="off">
        </div>
    </div>
</div>
<div class="col-6 col-12-small align-center">
    <label class="align-left label-important label-datos-alt"> Enseñanza</label>
    <input type="radio" id="ingreso-enseñanza-si" name="enseñanza" value="2">
    <label for="ingreso-enseñanza-si">SI</label>
    <input type="radio" id="ingreso-enseñanza-no" name="enseñanza" value="1" checked="">
    <label for="ingreso-enseñanza-no">NO</label>
</div>
<div class="col-12">
    <div class="row gtr-50 gtr-uniform">
        <div class="col-6 col-12-mobilep">
            <label class="label-important label-datos-alt"> Kilometraje</label>
            <div class="input-container">
                <i class="far fa-calendar-alt icon-input"></i>
                <div>
                    <input type="text" placeholder="10001" id="ingreso-kilometraje" name="kilometraje"
                        inputmode="numeric" autocomplete="off">
                </div>
            </div>
        </div>
        <div class="col-6 col-12-mobilep">
            <label class="label-datos-alt-orange"> ¡Ayuda! </label>
            <button id="ingreso-btn-kilometraje" class="button primary small fit icon solid fa-link-slash"> No
                funcional</button>
        </div>
    </div>
</div>
<div class="col-6 col-12-small">
    <label class="label-important label-datos-alt"> Tipo caja</label>
    <div class="input-container">
        <i class="fas fa-gears icon-input"></i>
        <div>
            <select id="ingreso-tipo_caja" name="tipo_caja">
                <option value="default" selected="">Seleccionar tipo caja</option>
            </select>
        </div>
    </div>
</div>
<div class="col-12" id="container-ingreso-tiempos-disenio" hidden>
    <div class="row gtr-25 gtr-uniform">
        <div class="col-6 col-12-small align-center">
            <label class="align-left label-important label-datos-alt"> Tiempos del motor</label>
            <input type="radio" id="ingreso-motor-4t" name="tiempos_motor" value="1" checked="">
            <label for="ingreso-motor-4t">4T</label>
            <input type="radio" id="ingreso-motor-2t" name="tiempos_motor" value="3">
            <label for="ingreso-motor-2t">2T</label>
        </div>
        <div class="col-6 col-12-small align-center">
            <label class="align-left label-important label-datos-alt"> Diseño</label>
            <input type="radio" id="ingreso-diseno-convencional" name="disenio" value="1" checked="">
            <label for="ingreso-diseno-convencional">CONVENCIONAL</label>
            <input type="radio" id="ingreso-diseno-scooter" name="disenio" value="2">
            <label for="ingreso-diseno-scooter">SCOOTER</label>
        </div>
    </div>
</div>
<div class="col-6 col-12-small align-center">
    <label class="align-left label-important label-datos-alt"> Blindado</label>
    <input type="radio" id="ingreso-blindado-si" name="blindado" value="2">
    <label for="ingreso-blindado-si">SI</label>
    <input type="radio" id="ingreso-blindado-no" name="blindado" value="1" checked="">
    <label for="ingreso-blindado-no">NO</label>
</div>
<div class="col-6 col-12-small align-center" id="container-ingreso-polarizado" hidden>
    <label class="align-left label-important label-datos-alt"> Polarizado</label>
    <input type="radio" id="ingreso-polarizado-si" name="polarizado" value="2">
    <label for="ingreso-polarizado-si">SI</label>
    <input type="radio" id="ingreso-polarizado-no" name="polarizado" value="1" checked="">
    <label for="ingreso-polarizado-no">NO</label>
</div>
