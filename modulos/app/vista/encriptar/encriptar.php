<form id="form_encriptar">
    <div class="row gtr-50 gtr-uniform">
        <div class="col-12 align-center">
            <p>Texto encriptado bajo llaves publicas y privadas para Belissa CallCenter</p>
        </div>
        <div class="col-12 align-center">

            <input type="radio" id="task_encr" name="tarea" value="1">
            <label for="task_encr">Encriptar</label>
            <input type="radio" id="tasdesc" name="tarea" value="2" checked="">
            <label for="tasdesc">Desencriptar</label>

        </div>
        <div class="col-6 col-12-small">
            <label>Contenido </label>
            <textarea id="form_encriptar_1" name="form_encriptar_1" rows="5" placeholder="Contenido a encriptar"
                maxlength="500" required></textarea>
        </div>
        <div class="col-6 col-12-small">
            <label>Resultado</label>
            <textarea id="form_encriptar_2" rows="5" placeholder="Contenido desencriptado" readonly></textarea>
        </div>
        <div class="col-12">
            <button type="submit" class="button primary small fit icon solid fa-arrow-right">
                Ejecutar tarea
            </button>
        </div>
    </div>
</form>