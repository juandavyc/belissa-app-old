export const InformacionUsuario = () => {
    const getInformacion = (id, _callback) => {
        let self = $.confirm({
            title: false,
            content: 'Cargando, espere...',
            typeAnimated: true,
            scrollToPreviousElement: false,
            scrollToPreviousElementAnimate: false,
            columnClass: 'large',
            closeIcon: true,
            content: function () {
                return $.ajax({
                    url: getMyAppModel('usuario/Usuario', 'Informacion'),
                    type: 'POST',
                    data: {
                        id_elemento: id,
                    },
                    headers: {
                        'csrf-token': $('meta[name="csrf-token"]').attr('content'),
                    },
                    dataType: 'json',
                    timeout: 35000,
                }).done(function (response) {
                    if (response.statusText === 'bien') {
                        self.close();
                        _callback(response.usuario);
                    } else if (response.statusText === 'no_session' || response.statusText === 'no_token') {
                        self.close();
                        call_recuperar_session(function (k) {
                            getInformacion(id, _callback);
                        });
                    } else {
                        self.setTitle(response.statusText);
                        self.setContent(response.message);
                    }
                })
                    .fail(function (response) {
                        self.setTitle('Error fatal');
                        self.setContent(JSON.stringify(response));
                        data = response;
                    });
            },
            buttons: {
                aceptar: function () { },
            },
        });
    }

    const getDatos = (usuario)=>{
        return usuario;
    }

    const setDatos = (usuario) => {
        return `
      <div class="row">
        <div class="col-12">
            <div class="container xsmall">
                <span class="image fit">
                    <img src="${usuario.foto}" />
                </span>
            </div>
        </div>
        <div class="col-12">
            <hr />
        </div>
        <div class="col-4 col-12-small">
            <label class="label-datos"> DOCUMENTO </label>
        </div>
        <div class="col-8 col-12-small">
            <label class="label-resultados">
                ${usuario.documento}
            </label>
        </div>
        <div class="col-4 col-12-small">
            <label class="label-datos"> NOMBRE </label>
        </div>
        <div class="col-8 col-12-small">
            <label class="label-resultados">
                ${usuario.nombre}
            </label>
        </div>
        <div class="col-4 col-12-small">
            <label class="label-datos"> Apellido </label>
        </div>
        <div class="col-8 col-12-small">
            <label class="label-resultados">
                ${usuario.apellido}
            </label>
        </div>    
        <div class="col-4 col-12-small">
            <label class="label-datos"> Correo </label>
        </div>
        <div class="col-8 col-12-small">
            <label class="label-resultados">
                ${usuario.correo}
            </label>
        </div>
    
        <div class="col-4 col-12-small">
            <label class="label-datos"> NACIMIENTO</label>
        </div>
        <div class="col-8 col-12-small">
            <label class="label-resultados">
                ${usuario.fecha_nacimiento}
            </label>
        </div>   
    
        <div class="col-4 col-12-small">
            <label class="label-datos"> ESTADO </label>
        </div>
        <div class="col-8 col-12-small">
            <label class="label-resultados">
                ${usuario.estado}
            </label>
        </div>
    
        <div class="col-12 align-center">
            <h3> Rango </h3>
        </div>
        <div class="col-4 col-12-small">
            <label class="label-datos"> Nombre </label>
        </div>
        <div class="col-8 col-12-small">
            <label class="label-resultados">
                ${usuario.rango.nombre}
            </label>
        </div>
        <div class="col-4 col-12-small">
            <label class="label-datos"> Permisos </label>
        </div>
        <div class="col-8 col-12-small">
            <p> ${usuario.rango.modulos}</p>
        </div>
        <div class="col-12">
            <hr />
        </div>
        <div class="col-12">
            <div class="container small">
                <span class="image fit">
                    <img src="${usuario.firma}" />
                </span>
            </div>        
        </div>
        <div class="col-12">
            <hr />
        </div>   
        <div class="col-4 col-12-small">
            <label class="label-datos"> USUARIO RESPONSABLE </label>
        </div>
        <div class="col-8 col-12-small">
            <label class="label-resultados">
                ${usuario.responsable.nombre} ${usuario.responsable.apellido}
            </label>
        </div>
        <div class="col-4 col-12-small">
            <label class="label-datos"> FECHA CREADO </label>
        </div>
        <div class="col-8 col-12-small">
            <label class="label-resultados">
                ${usuario.fecha}
            </label>
        </div>   
      </div>  `;
    }
    
    return {
        getInformacion,
        setDatos,
        getDatos
    }
    

}





