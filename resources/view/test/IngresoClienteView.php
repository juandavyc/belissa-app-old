<form id="formulario-datos-basicos">
    <div class="row gtr-25 gtr-uniform">
        <div class="col-7 col-12-small">
            <div class="align-middle">
                <div>
                    <h1 class="h1-lg-size">Placa</h1>
                    <p> Lorem ipsum dolor sit amet consectetur adipisicing elit. Eum quas illo vitae accusamus fugiat facilis tenetur </p>
                </div>
            </div>
        </div>
        <div class="col-5 col-12-small">
            <fieldset class="fieldset-gray">
                <legend> Datos básicos </legend>
                <div class="row gtr-25 gtr-uniform">
                    <div class="col-12">
                        <label class="label-important" for="basico-placa"> Placa</label>
                        <div>
                            <input type="text" id="basico-placa" class="basico-input-placa" placeholder="Placa" name="placa" value="" required="" autocomplete="off">
                        </div>
                    </div>
                    <div class="col-12">
                        <label class="label-important" for="basico-tipo_vehiculo"> Tipo de vehículo</label>
                        <div>
                            <select name="tipo_vehiculo" id="basico-tipo_vehiculo" class="basico-select-placa">
                                <option value="default" selected="">Seleccionar tipo vehículo</option>
                                <option value="2">LIVIANO</option>
                                <option value="4">MOTO</option>
                                <option value="6">TAXI</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-12">
                        <br>
                        <button type="submit" class="primary fit"> Continuar</button>
                    </div>
                </div>
            </fieldset>
        </div>
    </div>
</form>
<br><br><br>
<form id="formulario-datos-ingreso">
    <div class="row gtr-25 gtr-uniform">
        <div class="col-12 align-center">
            <h2>Datos del propietario RUNT</h2>
        </div>
        <div class="col-6 col-12-small">
            <label for="ingreso-propietario_documento">Documento</label>
            <div class="input-container">
                <i class="fas fa-hashtag icon-input"></i>
                <input type="text" name="contenido" id="ingreso-propietario_documento" name="propietario_documento" placeholder="Documento" autocomplete="off" maxlength="50" required />
            </div>
        </div>
        <div class="col-6 col-12-small">
            <label for="ingreso-propietario-tipo-documento">Tipo Documento</label>
            <div class="input-container">
                <i class="fas fa-list icon-input"></i>
                <select id="ingreso-propietario-tipo-documento" name="propietario-tipo_documento">
                    <option value="default" selected="">Seleccionar tipo de documento</option>
                    <option value="8">CARNET DIPLOMATICO</option>
                    <option value="1">CEDULA</option>
                    <option value="3">CEDULA DE EXTRANGERIA</option>
                    <option value="2">NIT</option>
                    <option value="5">PASAPORTE</option>
                    <option value="7">REGISTRO CIVIL</option>
                    <option value="4">TARJETA IDENTIDAD</option>
                </select>
            </div>
        </div>
        <div class="col-6 col-12-small">
            <label class="label-important" for="ingreso-propietario_nombres"> Nombres</label>
            <div class="input-container">
                <i class="fas fa-signature icon-input"></i>
                <div>
                    <input type="text" placeholder="Nombres propietario" id="ingreso-propietario_nombres" name="propietario_nombres" value="" autocomplete="off">
                </div>
            </div>
        </div>
        <div class="col-6 col-12-small">
            <label class="label-important" for="ingreso-propietario_apellidos"> Apellidos</label>
            <div class="input-container">
                <i class="fas fa-signature icon-input"></i>
                <div>
                    <input type="text" placeholder="Apellidos propietario" id="ingreso-propietario_apellidos" name="propietario_apellidos" value="" autocomplete="off">
                </div>
            </div>
        </div>

        <div class="col-6 col-12-small">
            <label class="label-important" for="ingreso-telefono_propietario"> Whatsapp </label>
            <div class="input-container">
                <i class="fas fa-phone-volume icon-input"></i>
                <div>
                    <input type="text" placeholder="000 000 0000" id="ingreso-telefono_propietario" name="propietario_telefono" inputmode="numeric" value="" autocomplete="off">
                </div>
            </div>
        </div>
        <div class="col-12">
            <label class="label-important" for="ingreso-correo_propietario"> Correo </label>
            <div class="input-container">
                <i class="fas fa-signature icon-input"></i>
                <div>
                    <input type="text" placeholder="correo@correo.com" id="ingreso-correo_propietario" name="propietario_correo" value="" autocomplete="off">
                </div>
            </div>
        </div>
        <div class="col-12">
            <label class="label-datos-alt" for="ingreso-direccion_propietario"> Dirección</label>
            <div class="input-container">
                <i class="fas fa-map-marked-alt icon-input"></i>
                <div>
                    <input type="text" placeholder="Calle 00 # 00 - 00" id="ingreso-direccion_propietario" autocomplete="off" name="propietario_direccion" value="">
                </div>
            </div>
        </div>
        <div class="col-12 align-center">
            <h2>¿Eres el conductor</h2>
            <input type="radio" id="soy-conductor-si" name="soy-conductor" value="si">
            <label for="soy-conductor-si"> Si</label>
            <input type="radio" id="soy-conductor-no" name="soy-conductor" value="no">
            <label for="soy-conductor-no"> No</label>
        </div>
        <div class="col-12 align-center">
            <h2>Datos de quien trae el vehiculo</h2>
        </div>
        <div class="col-6 col-12-small">
            <label for="ingreso-conductor_documento">Documento</label>
            <div class="input-container">
                <i class="fas fa-hashtag icon-input"></i>
                <input type="text" name="contenido" id="ingreso-conductor_documento" name="conductor_documento" placeholder="Documento" autocomplete="off" maxlength="50" required />
            </div>
        </div>
        <div class="col-6 col-12-small">
            <label for="ingreso-conductor-tipo-documento">Tipo Documento</label>
            <div class="input-container">
                <i class="fas fa-list icon-input"></i>
                <select id="ingreso-conductor-tipo-documento" name="conductor-tipo_documento">
                    <option value="default" selected="">Seleccionar tipo de documento</option>
                    <option value="8">CARNET DIPLOMATICO</option>
                    <option value="1">CEDULA</option>
                    <option value="3">CEDULA DE EXTRANGERIA</option>
                    <option value="2">NIT</option>
                    <option value="5">PASAPORTE</option>
                    <option value="7">REGISTRO CIVIL</option>
                    <option value="4">TARJETA IDENTIDAD</option>
                </select>
            </div>
        </div>
        <div class="col-6 col-12-small">
            <label class="label-important" for="ingreso-conductor_nombres"> Nombres</label>
            <div class="input-container">
                <i class="fas fa-signature icon-input"></i>
                <div>
                    <input type="text" placeholder="Nombres conductor" id="ingreso-conductor_nombres" name="conductor_nombres" value="" autocomplete="off">
                </div>
            </div>
        </div>
        <div class="col-6 col-12-small">
            <label class="label-important" for="ingreso-conductor_apellidos"> Apellidos</label>
            <div class="input-container">
                <i class="fas fa-signature icon-input"></i>
                <div>
                    <input type="text" placeholder="Apellidos conductor" id="ingreso-conductor_apellidos" name="conductor_apellidos" value="" autocomplete="off">
                </div>
            </div>
        </div>
        <div class="col-6 col-12-small">
            <label class="label-important" for="ingreso-telefono_conductor"> Whatsapp </label>
            <div class="input-container">
                <i class="fas fa-phone-volume icon-input"></i>
                <div>
                    <input type="text" placeholder="000 000 0000" id="ingreso-telefono_conductor" name="conductor_telefono" inputmode="numeric" value="" autocomplete="off">
                </div>
            </div>
        </div>
        <div class="col-12">
            <label class="label-important" for="ingreso-correo_conductor"> Correo </label>
            <div class="input-container">
                <i class="fas fa-signature icon-input"></i>
                <div>
                    <input type="text" placeholder="correo@correo.com" id="ingreso-correo_conductor" name="conductor_correo" value="" autocomplete="off">
                </div>
            </div>
        </div>
        <div class="col-12">
            <label class="label-datos-alt" for="ingreso-direccion_conductor"> Dirección</label>
            <div class="input-container">
                <i class="fas fa-map-marked-alt icon-input"></i>
                <div>
                    <input type="text" placeholder="Calle 00 # 00 - 00" id="ingreso-direccion_conductor" autocomplete="off" name="conductor_direccion" value="">
                </div>
            </div>
        </div>
        <div class="col-12 align-center">
            <h2>Factura a nombre de </h2>
            <input type="radio" id="factura-propietario" name="soy-factura" value="propietario">
            <label for="factura-propietario"> Propietario </label>
            <input type="radio" id="factura-Conductor" name="soy-factura" value="conductor">
            <label for="factura-Conductor"> Conductor </label>
            <input type="radio" id="factura-otro" name="soy-factura" value="otro">
            <label for="factura-otro"> Otro </label>
        </div>

        <div class="col-12 align-center">
            <h2>Datos de quien va dirigida la factura </h2>
        </div>
        <div class="col-6 col-12-small">
            <label for="ingreso-factura_documento">Documento</label>
            <div class="input-container">
                <i class="fas fa-hashtag icon-input"></i>
                <input type="text" name="contenido" id="ingreso-factura_documento" name="factura_documento" placeholder="Documento" autocomplete="off" maxlength="50" required />
            </div>
        </div>
        <div class="col-6 col-12-small">
            <label for="ingreso-factura-tipo-documento">Tipo Documento</label>
            <div class="input-container">
                <i class="fas fa-list icon-input"></i>
                <select id="ingreso-factura-tipo-documento" name="factura-tipo_documento">
                    <option value="default" selected="">Seleccionar tipo de documento</option>
                    <option value="8">CARNET DIPLOMATICO</option>
                    <option value="1">CEDULA</option>
                    <option value="3">CEDULA DE EXTRANGERIA</option>
                    <option value="2">NIT</option>
                    <option value="5">PASAPORTE</option>
                    <option value="7">REGISTRO CIVIL</option>
                    <option value="4">TARJETA IDENTIDAD</option>
                </select>
            </div>
        </div>
        <div class="col-6 col-12-small">
            <label class="label-important" for="ingreso-factura_nombres"> Nombres</label>
            <div class="input-container">
                <i class="fas fa-signature icon-input"></i>
                <div>
                    <input type="text" placeholder="Nombres a quien factura" id="ingreso-factura_nombres" name="factura_nombres" value="" autocomplete="off">
                </div>
            </div>
        </div>
        <div class="col-6 col-12-small">
            <label class="label-important" for="ingreso-factura_apellidos"> Apellidos</label>
            <div class="input-container">
                <i class="fas fa-signature icon-input"></i>
                <div>
                    <input type="text" placeholder="Apellidos a quien factura" id="ingreso-factura_apellidos" name="factura_apellidos" value="" autocomplete="off">
                </div>
            </div>
        </div>

        <div class="col-6 col-12-small">
            <label class="label-important" for="ingreso-telefono_factura"> Whatsapp </label>
            <div class="input-container">
                <i class="fas fa-phone-volume icon-input"></i>
                <div>
                    <input type="text" placeholder="000 000 0000" id="ingreso-telefono_factura" name="factura_telefono" inputmode="numeric" value="" autocomplete="off">
                </div>
            </div>
        </div>
        <div class="col-12">
            <label class="label-important" for="ingreso-correo_factura"> Correo </label>
            <div class="input-container">
                <i class="fas fa-signature icon-input"></i>
                <div>
                    <input type="text" placeholder="correo@correo.com" id="ingreso-correo_factura" name="factura_correo" value="" autocomplete="off">
                </div>
            </div>
        </div>
        <div class="col-12">
            <label class="label-datos-alt" for="ingreso-direccion_factura"> Dirección</label>
            <div class="input-container">
                <i class="fas fa-map-marked-alt icon-input"></i>
                <div>
                    <input type="text" placeholder="Calle 00 # 00 - 00" id="ingreso-direccion_factura" autocomplete="off" name="factura_direccion" value="">
                </div>
            </div>
        </div>
        <div class="col-12">
            <label for="cargar-rut">Foto o archivo RUT</label>
            <?php $app->ruta->getComponent(
                'FileChooserCameraControl',
                array(
                    'id' => 'cargar-rut',
                    'name' => 'rut',
                    'title' => 'RUT',
                    'icon' => 'fa-user',
                    'value' => '/images/sin-rut.png',
                    'folder' => 'usuario/foto'
                )
            ) ?>
        </div>
        <div class="col-12 align-center">
            <br><br><br>
            <h2>Tarjeta de propiedad</h2>
        </div>
        <div class="col-6 col-12-small">
            <div class="align-center">
                <img src="/images/sin_imagen.png" style="width: 22.5em; border: 3px solid #8097b5;">
            </div>
            <br>
            <?php $app->ruta->getComponent(
                'FileChooserCameraControl',
                array(
                    'id' => 'cargar-rut',
                    'name' => 'rut',
                    'title' => 'Foto Delantera',
                    'icon' => 'fa-user',
                    'value' => '/images/delantera.png',
                    'folder' => 'usuario/foto'
                )
            ) ?>
        </div>
        <div class="col-6 col-12-small">
            <div class="align-center">
                <img src="/images/sin_imagen.png" style="width: 22.5em; border: 3px solid #8097b5;">
            </div>
            <br>
            <?php $app->ruta->getComponent(
                'FileChooserCameraControl',
                array(
                    'id' => 'cargar-rut',
                    'name' => 'rut',
                    'title' => 'Foto Trasera',
                    'icon' => 'fa-user',
                    'value' => '/images/delantera.png',
                    'folder' => 'usuario/foto'
                )
            ) ?>
        </div>
    </div>
</form>