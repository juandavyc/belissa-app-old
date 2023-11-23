export class BuscadorVehiculo {
  constructor(_claseEditar) {
    // this.claseEditar = _claseEditar;

    this.buscadorVehiculo = new VisorBuscador(
      'form_0_buscador',
      'form_0',
      PROTOCOL_HOST +
        '/modulos/app/modelo/vehiculo/vehiculo.modelo.php?m=Listado',
      {
        opciones: [
          {
            id: 'btn_edit',
            icon: 'fas solid fa-edit',
            title: 'Editar',
            func: _claseEditar.datosVehiculo,
          },
        ],
        //verificado, sin verificar y asi..
        icono: ['none', 'question', 'check', 'times'],
        // ¿a que campos deben afectar estos iconos?
        campo: ['email', 'paquetes', 'datos'],
      },
      true //¿ exportar exel ?
    );

    this.funcListener(this);
  }

  formularioRecargar() {
    this.buscadorVehiculo.formularioSubmit(true);
  }

  funcListener(_class) {
    $('#form_0_buscador').on('submit', function (e) {
      _class.formularioRecargar();
      e.preventDefault();
      return false;
    });

    setTimeout(function () {
      _class.formularioRecargar();
    }, 500);
  }
}
