<div class="row gtr-25 gtr-uniform">
    <div class="col-6 col-12-small"> </div>
    <div class="col-6 col-12-small">
        <aside class="note-wrap note-yellow">
            Seleccione el rango de fechas de los vehiculos a los cuales se<br>
            va a enviar un mensaje predeterminado <b>Masivo</b>.
        </aside>
    </div>
    <div class="col-12 align-center">
        <h4>Los datos de su sesion seran tomados como medida de seguridad</h4>
    </div>
    <div class="col-12">
        <fieldset>
            <legend>
                Configuracion de mensajes masivo
            </legend>
            <form id="form_enviar_mensajes_masivos">
                <div class="row gtr-25 gtr-uniform">
                    <div class="col-12">
                        <div class="row gtr-25 gtr-uniform">
                            <div class="col-6 col-12-small">
                                <label> Mensaje predeterminado</label>
                                <div class="input-container">
                                    
                                    <textarea name="mensaje_masivo" id="mensaje_masivo" cols="30" rows="5"></textarea>
                                <!-- <i class="fas fa-list icon-input"></i>
                                    <select id="form_0_filtro" name="filtro" required>
                                        <option value="0">Todo</option>
                                        <option value="1">Placa</option>
                                        <option value="5">Mensaje predeterminado 1</option>

                                    </select> -->
                                </div>
                            </div>

                            <div class="col-6 col-12-small align-center">
                                <label> Dias</label>

                                <input type="radio" id="radio_dias_5" name="dias" value="5" checked="">
                                <label for="radio_dias_5">5</label>
                                <input type="radio" id="radio_dias_10" name="dias" value="10" checked="">
                                <label for="radio_dias_10">10</label>
                                <input type="radio" id="radio_dias_15" name="dias" value="15" checked="">
                                <label for="radio_dias_15">15</label>

                            </div>

                        </div>
                    </div>

                    <div class="col-12 col-12-small">
                        <label>Buscar</label>
                        <button type="submit" class="button primary small fit icon solid fa-search">
                            AGENDAR MENSAJES
                        </button>
                    </div>
                </div>
            </form>
        </fieldset>
    </div>
</div>