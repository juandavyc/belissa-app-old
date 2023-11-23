export class VehiculoClass {
    constructor() {

    }

    setId(_id = 0) {
        $('#ingreso-id_vehiculo').val(_id);
    }
    setPlaca(_valor = 'abc123') {
        $('#ingreso-placa_vehiculo').val(_valor);
        $('#ingreso-placa_vehiculo-html').empty().html(_valor);
    }
    setTipo(_valor = 1) {
        $('#ingreso-tipo_vehiculo').val(_valor);
    }
    setServicio(_valor = 1) {
        $('#ingreso-servicio_vehiculo').val(_valor);
    }
    setModelo(_modelo = 2000) {
        $('#ingreso-modelo').val(_modelo);
    }

    setDefault(){
        $('#ingreso-tipo_vehiculo').val('default');
        $('#ingreso-tipo_vehiculo').val('default');
        $('#ingreso-servicio_vehiculo').val('default');
        $('#ingreso-modelo').val('');
    }

}
