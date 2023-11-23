export const VideoRechazo = () => {

    let _placa = null;

    const recargarVideo = document.getElementById('btn-recargar-video');
    const containerResultado = document.getElementById('container-resultado');
    const videoReproductor = document.getElementById('reproductor-video');
    const tituloReproductor = document.getElementById('reproductor-titulo');

    const myModal = new MyModal({
        container: 'video-ingreso-modal',
        title: 'Video',
        icon: 'fa fa-video',
        columnClass: 'lg',
        closeIcon: true,
        event: {
            onOpen: () => {
            },
            onClose: () => {
                videoReproductor.src = '';
                tituloReproductor.textContent = 'Seleccionar';
                _placa = null;
            },
        },
    });

    const pruebaVideo = (placa) => {
        videoReproductor.src = '';
        tituloReproductor.textContent = 'Seleccionar';
        _placa = placa;
        filtraPorPlaca();
    }

    recargarVideo.addEventListener('click', (e) => {
        e.preventDefault();
        filtraPorPlaca();
    });
    const filtraPorPlaca = () => {
        let self = $.confirm({
            content: function () {
                return $.ajax(
                    getRequestConfig({
                        processData: true,
                        url: getMyAppModel('inspector-evidencia/EvidenciaFiltrar'),
                        formData: {
                            placa: _placa
                        },
                        datatype: 'json'
                    })
                ).done(function (response) {
                    if (response.statusText === "bien") {
                        while (containerResultado.firstChild) {
                            containerResultado.removeChild(containerResultado.firstChild);
                        }
                        generarLista(containerResultado, response.src);
                        self.close();
                        myModal.open();
                    }
                    else {
                        self.setTitle(response.statusText);
                        self.setContent(response.message);
                    }

                }).fail(function (jqXHR, textStatus, errorThrown) {
                    self.setTitle('Error fatal');
                    self.setContent(JSON.stringify(errorThrown));
                    console.log(errorThrown);
                });
            },
            buttons: {
                aceptar: function () { },
            },
        });
    }


    const generarLista = (element, data) => {
        for (const key in data) {
            if (data.hasOwnProperty(key)) {
                const item = data[key];
                // Crear un elemento <details> para carpetas
                if (item.type === 'folder') {

                    const li = document.createElement('li');
                    const ul = document.createElement('ul');

                    li.textContent = item.name;
                    // Usar el nombre de la carpeta como título
                    li.appendChild(ul);
                    // Llamar a la función recursivamente para las subcarpetas
                    if (item.subfolder) {
                        generarLista(ul, item.subfolder);
                    }
                    element.appendChild(li);
                } else {
                    const li = document.createElement('li');
                    li.textContent = item.name; // Usar el nombre del archivo
                    element.appendChild(li);

                    li.addEventListener('click', (e) => {
                        e.preventDefault();

                        tituloReproductor.textContent = item.name;
                        videoReproductor.src = item.url;
                        videoReproductor.load();

                    });
                }
            }
        }
    }

    return {
        pruebaVideo
    }
}