<div class="row gtr-25 gtr-uniform">
    <div class="col-12 align-center"> 
        <?php $app->ruta->getComponent(
                'TituloModulo',
                array(
                    'icon' => 'fa-magnifying-glass',
                    'title' => '<b>BUSCADOR</b> de Usuarios'
                )
            ) ?>
    </div>

    <div class="col-12">
        <fieldset>
            <legend>Búsqueda</legend>
            <form id="form_0_buscador">
                <div class="row gtr-25 gtr-uniform">
                    <div class="col-3 col-12-small">
                        <label> Buscar por</label>
                        <div class="input-container">
                            <i class="fas fa-list icon-input"></i>
                            <select id="form_0_filtro" name="filtro" required>
                                <option value="0">Todo</option>
                                <option value="1">Documento</option>
                                <option value="2">Nombre</option>
                                <option value="3">Apellido</option>
                                <option value="4">Correo</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-6 col-12-small">
                        <label>Contenido</label>
                        <div class="input-container">
                            <i class="fas fa-align-left icon-input"></i>
                            <input type="text" name="contenido" id="form_0_contenido" placeholder="Contenido a buscar" value="Todo" autocomplete="off" maxlength="50" readonly="" required />
                        </div>
                    </div>
                    <div class="col-3 col-12-small">
                        <label>Rango</label>
                        <div class="input-container">
                            <i class="fas fa-sort-numeric-down icon-input"></i>
                            <select id="form_0_rango" name="rango" required>
                                <option value="0">Todo</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-3 col-12-small">
                        <label>Estado</label>
                        <div class="input-container">
                            <i class="fas fa-sort-numeric-down icon-input"></i>
                            <select id="form_0_estado" name="estado" required>
                                <option value="0">Todo</option>
                                <option value="1">Activo</option>
                                <option value="2">Inactivo</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-3 col-12-small">
                        <label> Resultados</label>
                        <div class="input-container">
                            <i class="fas fa-sort-numeric-down icon-input"></i>
                            <select id="form_0_resultados" name="resultados" required>
                                <option value="25">25</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                                <option value="255">255</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-6 col-12-small">
                        <label>Buscar</label>
                        <input type="hidden" name="page" id="form_0_page" value="1" data-default="1">
                        <input type="hidden" name="order" id="form_0_order" value="nro" data-default="nro">
                        <input type="hidden" name="by" id="form_0_by" value="desc" data-default="desc">
                        <button type="submit" class="button primary small fit icon solid fa-search">
                            BUSCAR USUARIOS
                        </button>
                    </div>
                </div>
            </form>
        </fieldset>
    </div>
    <div class="col-12 align-right">
        <button id="form_0_exportar_excel" class="button primary small icon solid fa-file-excel">
            Exportar a EXCEL
        </button>
    </div>
    <div class="col-12">
        <div id="form_0_container_resultados_title" class="div-resultado-title" hidden></div>
        <div id="form_0_container_resultados_body" class="div-resultado-body" hidden></div>
        <div id="form_0_container_resultados_pagination" class="div-resultado-pagination" hidden></div>
    </div>
</div>