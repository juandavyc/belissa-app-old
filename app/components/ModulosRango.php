<?php
if (isset($dir) && isset($data)) {
?>
    <fieldset>
        <legend>
            ¿A que módulos tiene acceso?
        </legend>
        <div class="row gtr-50 gtr-uniform">
            <div class="col-12 align-center">
                <h4>Módulos <b>Obligatorios</b></h4>
            </div>
            <div class="col-4 col-12-small">
                <input type="checkbox" name="modulo[]" id="<?= $data ?>_modulo_inicio" value="inicio" disabled checked>
                <label for="<?= $data ?>_modulo_inicio"> Inicio </label>
            </div>
            <div class="col-4 col-12-small">
                <input type="checkbox" name="modulo[]" id="<?= $data ?>_modulo_documentacion" value="documentacion" disabled checked>
                <label for="<?= $data ?>_modulo_documentacion"> Documentación </label>
            </div>           
            <div class="col-4 col-12-small">
                <input type="checkbox" name="modulo[]" id="<?= $data ?>_modulo_legal" value="legal" disabled checked>
                <label for="<?= $data ?>_modulo_legal"> Legal </label>
            </div>
            <div class="col-4 col-12-small">
                <input type="checkbox" name="modulo[]" id="<?= $data ?>_modulo_mi-perfil" value="mi-perfil" disabled checked>
                <label for="<?= $data ?>_modulo_mi-perfil"> Mi Perfil</label>
            </div>
            <div class="col-12 align-center">
                <h4>Módulos <b>Complementarios</b></h4>
            </div>
            <div class="col-4 col-12-small">
                <input type="checkbox" name="modulo[]" id="<?= $data ?>_modulo_cpanel" value="cpanel">
                <label for="<?= $data ?>_modulo_cpanel"> Cpanel</label>
            </div>

            <div class="col-4 col-12-small">
                <input type="checkbox" name="modulo[]" id="<?= $data ?>_modulo_callcenter" value="callcenter">
                <label for="<?= $data ?>_modulo_callcenter"> CallCenter </label>
            </div>

            <div class="col-4 col-12-small">
                <input type="checkbox" name="modulo[]" id="<?= $data ?>_modulo_ingreso-completo" value="ingreso-completo">
                <label for="<?= $data ?>_modulo_ingreso-completo"> Ingreso Completo</label>
            </div>
            <div class="col-4 col-12-small">
                <input type="checkbox" name="modulo[]" id="<?= $data ?>_modulo_ingreso-rapido" value="ingreso-rapido">
                <label for="<?= $data ?>_modulo_ingreso-rapido"> Ingreso Rapido</label>
            </div>   
            <div class="col-4 col-12-small">
                <input type="checkbox" name="modulo[]" id="<?= $data ?>_modulo_crear-cliente-vehiculo" value="crear-cliente-vehiculo">
                <label for="<?= $data ?>_modulo_crear-cliente-vehiculo"> Crear cliente-vehículo </label>
            </div>

            <div class="col-4 col-12-small">
                <input type="checkbox" name="modulo[]" id="<?= $data ?>_modulo_cda-agendamiento" value="cda-agendamiento">
                <label for="<?= $data ?>_modulo_cda-agendamiento"> CDA Agendamiento  </label>
            </div>
            <div class="col-4 col-12-small">
                <input type="checkbox" name="modulo[]" id="<?= $data ?>_modulo_mi-agendamiento" value="mi-agendamiento">
                <label for="<?= $data ?>_modulo_mi-agendamiento"> MI Agendamiento </label>
            </div>
       
            <div class="col-4 col-12-small">
                <input type="checkbox" name="modulo[]" id="<?= $data ?>_modulo_visor-ingreso" value="visor-ingreso">
                <label for="<?= $data ?>_modulo_visor-ingreso"> Visor Ingreso </label>
            </div>
            <div class="col-4 col-12-small">
                <input type="checkbox" name="modulo[]" id="<?= $data ?>_modulo_visor-pdf" value="visor-pdf">
                <label for="<?= $data ?>_modulo_visor-pdf"> Visor PDF </label>
            </div>
            <div class="col-4 col-12-small">
                <input type="checkbox" name="modulo[]" id="<?= $data ?>_modulo_visor-psi" value="visor-psi">
                <label for="<?= $data ?>_modulo_visor-psi"> Visor PSI </label>
            </div>    
            <div class="col-4 col-12-small">
                <input type="checkbox" name="modulo[]" id="<?= $data ?>_modulo_bitacora" value="bitacora">
                <label for="<?= $data ?>_modulo_bitacora"> Bitácora </label>
            </div>
            <div class="col-4 col-12-small">
                <input type="checkbox" name="modulo[]" id="<?= $data ?>_modulo_test" value="test">
                <label for="<?= $data ?>_modulo_test"> Test </label>
            </div>
             <div class="col-4 col-12-small">
                <input type="checkbox" name="modulo[]" id="<?= $data ?>_modulo_conteo_rtm" value="conteo-rtm">
                <label for="<?= $data ?>_modulo_conteo_rtm"> Conteo RTMyEC </label>
            </div>
            <div class="col-12">
                <hr>
            </div>
            <div class="col-6 col-12-small">
                <input type="checkbox" name="modulo[]" id="<?= $data ?>_modulo_evidencia" value="inspector-evidencia">
                <label for="<?= $data ?>_modulo_evidencia"> (**) inspector-evidencia</label>
            </div>    
        </div>
    </fieldset>
<?php
}
