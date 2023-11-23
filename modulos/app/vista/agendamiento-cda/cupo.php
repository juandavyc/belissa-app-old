<div class="container medium">
    <div class="row gtr-50 gtr-uniform">
        <div class="col-12 align-right">
            <button class="primary small icon solid fa-rotate align-right" id="btn-cupo-recargar"> Recargar</button>
        </div>
        <div class="col-12 align-center">
            <i class="icon solid fas fa-star fa-3x"></i>
            <h3>Indique el número de cupos disponibles para <b>agendar</b> por <b>día</b></h3>
            <h4> Cupos disponibles <b>(30 Días)</b></h4>
        </div>
        <div class="col-12 align-center">
            <b>Fecha</b> ( <b class="b-moto">Cupo libre moto</b> – <b class="b-liviano">Cupo libre liviano</b> )
            <br>
            Motos: <b class="b-moto" id="cupo-moto-html"></b> Liviano: <b class="b-liviano" id="cupo-liviano-html"></b>
        </div>
        <div class="col-12">
            <div id="container-cupos"> </div>
        </div>
        <div class="col-12">
            <form id="form_cupo">
                <div class="row gtr-25 gtr-uniform">
                    <div class="col-2 col-12-small">
                        <label class="label-datos label-important"> Motos</label>
                    </div>
                    <div class="col-4 col-12-small">
                        <div class="input-container">
                            <i class="fas fa-arrow-up-9-1 icon-input"></i>
                            <div>
                                <input type="text" placeholder="100" id="cupo-moto" name="moto" value=""
                                    autocomplete="off">
                            </div>
                        </div>
                    </div>
                    <div class="col-2 col-12-small">
                        <label class="label-datos label-important"> Liviano</label>
                    </div>
                    <div class="col-4 col-12-small">
                        <div class="input-container">
                            <i class="fas fa-arrow-up-9-1 icon-input"></i>
                            <div>
                                <input type="text" placeholder="100" id="cupo-liviano" name="liviano" value=""
                                    autocomplete="off">
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <fieldset class="fieldset-save">
                            <legend> <i class="fas fa-pencil-alt"> </i> Términos y condiciones</legend>
                            <div class="row gtr-50 gtr-uniform">
                                <div class="col-12">
                                    <input type="checkbox" id="cupo-acepto-terminos-condiciones"
                                        name="acepto_terminos_condiciones" required="">
                                    <label for="cupo-acepto-terminos-condiciones" style="text-transform:none;">Yo
                                        <b><?=htmlspecialchars($_SESSION["session_user"][3]);?></b>, He leído y acepto
                                        los
                                        <a href="/modulos/legal/" target="_blank">términos y condiciones</a> de uso.
                                    </label>
                                </div>
                                <div class="col-6 col-12-mobilep">
                                    <button type="submit" class="button primary small fit icon solid fa-save">
                                        Guardar
                                    </button>
                                </div>
                                <div class="col-6 col-12-mobilep">
                                    <button type="reset" id="form_agendar_reset"
                                        class="button primary small fit icon solid fa-undo" disabled>
                                        Cancelar
                                    </button>
                                </div>
                            </div>
                        </fieldset>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>