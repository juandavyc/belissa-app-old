<?php
if (
    isset($_POST['buscador']) && // fecha o contenido
    isset($_POST['fecha']) &&
    isset($_POST['filtro']) &&
    isset($_POST['contenido']) &&
    isset($_POST['status']) &&
    count($_POST) == 5
) {

    $rtmClass = new RtmClass($this->pdo);

    $_buscador = htmlspecialchars($_POST['buscador']);
    $_array_sql = array(
        'rtm_1.fecha_expedicion',
        'veh.id',
        'veh.placa',
        'veh.modelo',
        'veh.vin',
        'prop.id',
        'prop.documento',
        'prop.nombre',
        'prop.apellido',
        'prop.telefono_1',
        'prop.telefono_2',
        'prop.telefono_3',
        'prop.email',
        'prop.direccion',
        'cond.id',
        'cond.documento',
        'cond.nombre',
        'cond.apellido',
        'cond.telefono_1',
        'cond.telefono_2',
        'cond.telefono_3',
        'cond.email',
        'cond.direccion',
    );
    $_columna_sql = ''; // veh.placa
    $_contenido = ''; // abc123

    if ($_buscador == 1) {
        $_columna_sql = $_array_sql[0];
        $_contenido = getSpecialDateDatabase($_POST['fecha']);
    } else {
        $_columna_sql = $_array_sql[($_POST['filtro'])];
        $_contenido = htmlspecialchars($_POST['contenido']);
    }

    $this->arrayResponse = $rtmClass->getListado(
        $_columna_sql,
        $_contenido
    );

    $this->pdo = null;
} else if (!isset($_POST['status'])) {
    $this->arrayResponse = $this->configuracion->sinPermisosParaAcceder();
} else {
    $this->arrayResponse = $this->configuracion->formularioIncompleto();
}