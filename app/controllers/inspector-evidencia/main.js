const video = document.getElementById('video-rtc');
const videoReproductor = document.getElementById('reproductor-video');

const startRecording = document.getElementById('btn-start-recording');
const pauseRecording = document.getElementById('btn-pause-recording');
const stopRecording = document.getElementById('btn-stop-recording');
const closeRecording = document.getElementById('btn-close-recording');
const recargarVideo = document.getElementById('btn-recargar-video');
const selectDevicesList = document.getElementById('devices-list');

const containerResultado = document.getElementById('container-resultado');
const containerPlaca = document.getElementById('container-placa');

const containerCargarVideo = document.getElementById('container-cargar-video');
const containerSeleccionaPlaca = document.getElementById('container-seleccionar-placa');


const inputPlacaEvidencia = document.getElementById('placa');

const inputPlaca = document.getElementById('placa-text');
const inputHiddenPlaca = document.getElementById('placa-select');

const btnSiguientePlaca = document.getElementById('btn-siguiente-placa');

let videoDevices = [];
let recorder;

const videoConfiguracion = {
    video: {
        // facingMode: { exact: 'environment' }, // user environment
        width: { ideal: 1280 },
        height: { ideal: 720 },
        deviceId: { exact: 'your_device_id_here' },
    },
    audio: true
};

myAutocomplete({
    url: '/app/models/inspector-evidencia/BuscarPlaca.php',
    parent: true,
    create: false,
    input: {
        text: document.getElementById("placa-text"),
        hidden: document.getElementById("placa-select"),
    },
    table: [null, null, null],
    childs: [],
    default: [0, 'Seleccionar'],
});



navigator.mediaDevices.enumerateDevices().then(devices => {
    devices.forEach((device, index) => {
        if (device.kind === "videoinput") {
            videoDevices[index] = device.deviceId;
            const option = document.createElement('option');
            option.value = index;
            option.innerHTML = device.label;
            selectDevicesList.appendChild(option);
        }
    });
});

btnSiguientePlaca.addEventListener('click', (e) => {
    e.preventDefault();
    if (inputHiddenPlaca.value.length >= 5) {
        containerPlaca.textContent = inputHiddenPlaca.value;
        inputPlacaEvidencia.value = inputHiddenPlaca.value;

        evidenciaFiltrar(inputHiddenPlaca.value);
        // limpiar
        inputHiddenPlaca.value = '';
        inputPlaca.value = '';
        // mostrar
        containerSeleccionaPlaca.style.display = 'none';
        containerCargarVideo.style.display = 'block';
    }
    else {
        $.alert("Placa no valida");
    }

});

startRecording.addEventListener('click', (e) => {
    e.preventDefault();

    startRecording.disabled = true;

    const selectedIndex = parseInt(selectDevicesList.value);
    const selectedDevice = (videoDevices[selectedIndex] !== undefined) ? videoDevices[selectedIndex] : null;
    videoConfiguracion.video.deviceId.exact = selectedDevice;

    navigator.mediaDevices.getUserMedia(videoConfiguracion)
        .then(stream => {
            video.muted = true;
            video.volume = 0;
            video.srcObject = stream;
            recorder = RecordRTC(stream, {
                recorderType: MediaStreamRecorder,
                type: 'video',
                bitsPerSecond: 5800000000,
                audioBitsPerSecond: 5800000000,
                numberOfAudioChannels: 2,
            });
            recorder.startRecording();
            recorder.camera = stream;

            stopRecording.disabled = false;
            pauseRecording.disabled = false;
            closeRecording.disabled = true;
        })
        .catch(error => {
            console.error('Error al intentar acceder a la cámara:', error);
            alert('No se pudo acceder a la cámara. Verifica el ID de la cámara o los permisos.');
        });

})
pauseRecording.addEventListener('click', (e) => {
    e.preventDefault();
    // disabled
    pauseRecording.disabled = true;
    if (pauseRecording.innerHTML === 'PAUSE') {
        video.pause();
        recorder.pauseRecording();
        pauseRecording.innerHTML = 'CONTINUE';
    } else {
        recorder.resumeRecording();
        video.play();
        pauseRecording.innerHTML = 'PAUSE';
    }

    setTimeout(() => {
        pauseRecording.disabled = false;
        stopRecording.disabled = false;
    }, 1000);
});
stopRecording.addEventListener('click', (e) => {
    e.preventDefault();
    stopRecording.disabled = true;
    recorder.stopRecording(stopRecordingCallback);
});


recargarVideo.addEventListener('click', (e) => {
    e.preventDefault();
    evidenciaFiltrar(inputPlacaEvidencia.value);
});

closeRecording.addEventListener('click', (e) => {
    e.preventDefault();
    closeRecordingHandler();
});

const closeRecordingHandler = () => {
    $.confirm({
        title: 'Alerta',
        content: '¿Desea salir?',
        type: 'red',
        typeAnimated: true,
        buttons: {
            btnAceptar: {
                text: 'Aceptar',
                btnClass: 'btn-blue',
                action: function () {
                    // recorder.stopRecording()
                    containerPlaca.textContent = '';
                    inputPlacaEvidencia.value = '';
                    // limpiar
                    inputHiddenPlaca.value = '';
                    inputPlaca.value = '';
                    // mostrar
                    containerSeleccionaPlaca.style.display = 'block';
                    containerCargarVideo.style.display = 'none';

                }
            },
            btnCancelar: {
                text: 'Cancelar',
                action: function () {

                }
            }
        }
    });
}

const evidenciaFiltrar = (_placa) => {
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
                    createDetails(containerResultado, response.src);
                    self.close();
                }
                else if (response.statusText === 'no_session' || response.statusText === 'no_token') {
                    self.close();
                    call_recuperar_session(function (k) {
                        evidenciaFiltrar(_placa);
                    });
                } else {
                    self.setTitle(response.statusText);
                    self.setContent(response.message);
                    self.close();
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


const createDetails = (element, data) => {

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
                    createDetails(ul, item.subfolder);
                }
                element.appendChild(li);
            } else {
                const li = document.createElement('li');
                li.textContent = item.name; // Usar el nombre del archivo
                element.appendChild(li);

                li.addEventListener('click', (e) => {
                    e.preventDefault();

                    videoReproductor.src = item.url;
                    videoReproductor.load();
                })

            }
        }
    }
}

const stopRecordingCallback = () => {

    video.src = video.srcObject = null;
    video.muted = false;
    video.volume = 1;

    video.src = URL.createObjectURL(recorder.getBlob());
    video.pause();

    const formData = new FormData();

    formData.append('video', new File([recorder.getBlob()], 'video_temp', {
        type: 'video/webm'
    }));

    formData.append('placa', inputPlacaEvidencia.value);

    $.confirm({
        title: 'Guardar ',
        content: '¿Desea guardar este video?',
        type: 'red',
        typeAnimated: true,
        buttons: {
            btnAceptar: {
                text: 'Si',
                btnClass: 'btn-blue',
                action: function () {
                    subirEvidencia(formData)
                }
            },
            btnCancelar: {
                text: 'No',
                action: function () {

                    video.src = ''
                    startRecording.disabled = false;
                    pauseRecording.disabled = true;
                    stopRecording.disabled = true;
                    closeRecording.disabled = false;
                }
            }
        }
    });

    // destroy
    recorder.camera.stop();
    recorder.destroy();
    recorder = null;
}


const subirEvidencia = (formulario) => {
    let statusEvidencia = false;
    let self = $.confirm({
        content: function () {
            return $.ajax({
                url: getMyAppModel('inspector-evidencia/EvidenciaUpload'),
                type: 'POST',
                data: formulario,
                headers: {
                    'csrf-token': $('meta[name="csrf-token"]').attr('content'),
                },
                dataType: 'json',
                processData: false,
                contentType: false,
            }).done(function (response) {
                if (response.statusText === "bien") {
                    self.setTitle(response.statusText);
                    self.setContent(response.message);
                    statusEvidencia = true;
                }
                else if (response.statusText === 'no_session' || response.statusText === 'no_token') {
                    self.close();
                    call_recuperar_session(function (k) {
                        subirEvidencia(formulario);
                    });
                } else {
                    self.setTitle(response.statusText);
                    self.setContent(response.message);
                }
            }).fail(function (jqXHR, textStatus, errorThrown) {
                self.setTitle('Error fatal');
                self.setContent(
                    JSON.stringify(errorThrown) + "<br>" +
                    JSON.stringify(textStatus) + "<br>" +
                    JSON.stringify(jqXHR) + "<br>"
                );
                console.log(errorThrown);
            });
        },
        buttons: {
            aceptar: function () {
                if (statusEvidencia) {
                    evidenciaFiltrar(inputPlacaEvidencia.value);
                    video.src = '';
                    startRecording.disabled = false;
                    pauseRecording.disabled = true;
                    stopRecording.disabled = true;
                    closeRecording.disabled = false;
                }
            },
        },
    });
}


