// v1
class VisorBuscador {
    constructor(_id_formulario, _id_indicativo, _ajax_url, _personalizacion_tabla, _excel = false, _findstring = false) {
        this.formulario = _id_formulario;
        this.indicativo = _id_indicativo;
        this.ajaxUrl = _ajax_url;
        this.personalizacionTabla = _personalizacion_tabla;

        this.excel = _excel;
        this.func_listener(this);
    }

    func_listener() {
        let _this = this;
        // by function
        $.each(this.personalizacionTabla.opciones, function (key, value) {
            // listener buttons
            $('#' + _this.indicativo + '_container_resultados_body').on('click', '#' + value.id, function (e) {
                value.func($(this).attr('btn-id'));
            });
        });
        // cambio de buscador
        $('#' + this.indicativo + '_basica,#' + this.indicativo + '_avanzada').on('click ', function (e) {
            _this.buscadorAvanzado(this.value);
        });
        // input de contenido
        $('#' + this.indicativo + '_filtro').on('change', function () {
            _this.buscadorContenido(this.value);
        });
        // li-data
        $('#' + this.indicativo + '_container_resultados_pagination').on('click', '#li-data', function (e) {
            _this.buscadorLiData($(this).attr('data-id'));
            e.preventDefault();
            return false;
        });

        $('#' + this.indicativo + '_container_resultados_body').on('click', '#th-data', function (e) {
            _this.buscadorThData($(this).attr('field-id'), $(this).attr('data-id'));
            e.preventDefault();
            return false;
        });
        $('#form_0_exportar_excel').on('click', function (e) {
            _this.buscadorExcel();
            e.preventDefault();
            return false;
        });

        $('#form_0_buscar_string').on('click', function (e) {
            _this.buscarStringConfirm();
            e.preventDefault();
            return false;
        });

        // apply css

        $('#form_0_exportar_excel').css('max-width', '150px');
        $('#form_0_buscar_string').css('max-width', '95px');
    }
    buscarStringConfirm() {
        let _class = this;
        let stringBuscar = '';
        $.confirm({
            icon: 'fa fa-magnifying-glass',
            title: 'Buscador de palabras',
            content: `
              <center> 
              Esta palabra se buscará en el <b>documento</b> <br><b>NO en la base de datos</b>.
              <br> <b> CTRL + F </b> <br>
              <input type="text" placeholder="Escribe la palabra" 
              class="palabra-jconfirm" maxlenght="100" autocomplete="off" required /> 
              </center> `,
            typeAnimated: true,
            scrollToPreviousElement: false,
            scrollToPreviousElementAnimate: false,
            columnClass: 'small',
            closeIcon: true,
            buttons: {
                formSubmit: {
                    text: 'Buscar',
                    btnClass: 'btn-blue',
                    action: function () {
                        stringBuscar = this.$content.find('.palabra-jconfirm').val();
                        if (!stringBuscar) {
                            $.alert('No puede ser vacio');
                            return false;
                        } else {
                            _class.#buscarString(stringBuscar.toString());
                        }
                    },
                },
            },
        });
    }
    #buscarString(_text) {
        let strFound;
        if (window.find) {
            strFound = self.find(_text, true);
            if (!strFound) {
                strFound = self.find(_text, true, 1);
                while (self.find(_text, true, 1)) continue;
            }
        }
    }

    tituloTabla(_response) {
        if (Object.keys(_response).length === 0) {
            $('#' + this.indicativo + '_container_resultados_title')
                .empty()
                .hide(100);
        } else {
            $('#' + this.indicativo + '_container_resultados_title')
                .html(`Resultados : ${_response['total']} ( Página ${_response['page']} de ${_response['total_pages']} ) `)
                .show(100);
        }
    }
    paginacionTabla(_paginacion) {
        let _inner_pag = '';
        let _pagina = null;
        let _total = null;
        let _prev = 0;
        let _next = 0;
        let _ciclo = 0;
        let _rango = 2;

        if (Object.keys(_paginacion).length === 0) {
            $('#' + this.indicativo + '_container_resultados_pagination')
                .empty()
                .hide(100);
        } else {
            // importante
            _pagina = _paginacion.pages;
            _total = _paginacion.total_pages;

            if (_total > 1) {
                _inner_pag += `<h4> página ( ${_pagina} `;
                _inner_pag += ` de ${_total} )</h4>`;
                _inner_pag += `<ul class="pagination">`;
                if (_pagina > 1) {
                    _inner_pag += `<li id="li-data" data-id="1"> `;
                    _inner_pag += `<a class="page" data-id="1"> &laquo; </a>`;
                    _inner_pag += `</li>`;
                    _prev = _pagina - 1;
                    _inner_pag += `<li id="li-data" data-id="${_prev}">`;
                    _inner_pag += `<a class="page" data-id="${_prev}"> &#8249; </a>`;
                    _inner_pag += `</li>`;
                }
                for (_ciclo = _pagina - _rango; _ciclo < _pagina + _rango + 1; _ciclo++) {
                    if (_ciclo > 0 && _ciclo <= _total) {
                        _inner_pag += `<li id="li-data" `;
                        _inner_pag += `data-id="${_ciclo}">`;
                        if (_ciclo == _pagina) {
                            _inner_pag += `<a class="page active">${_ciclo}</a>`;
                        } else {
                            _inner_pag += `<a class="page">${_ciclo}</a>`;
                        }
                        _inner_pag += `</li>`;
                    }
                }
                if (_pagina != _total) {
                    _next = _pagina + 1;
                    _inner_pag += `<li id="li-data" `;
                    _inner_pag += `data-id="${_next}"> `;
                    _inner_pag += `<a class="page" data-id="${_next}"> &#8250;</a> `;
                    _inner_pag += `</li> `;
                    //
                    _inner_pag += `<li id="li-data" `;
                    _inner_pag += `data-id="${_total}"> `;
                    _inner_pag += `<a class="page" data-id="${_total}"> &raquo;</a> `;
                    _inner_pag += `</ul>`;
                    _inner_pag += `</li> `;
                }
                _inner_pag += `</ul>`;

                $('#' + this.indicativo + '_container_resultados_pagination')
                    .append(_inner_pag)
                    .show(100);
            }
        }
    }
    contenidoTabla(_cabeza, _cuerpo) {
        // solo si tiene contenido
        let _class = this;
        let _inner_table = '';

        if (Object.keys(_cabeza).length === 0 || Object.keys(_cuerpo).length === 0) {
            $('#' + this.indicativo + '_container_resultados_body')
                .empty()
                .hide(100);
        } else {
            _inner_table = `<table class="alt">`;
            _inner_table += `<thead>`;
            $.each(_cabeza.fields, function (key, value) {
                _inner_table += `<th id="th-data" `;
                _inner_table += `field-id="${value}" `;
                if (value === _cabeza.order) {
                    _inner_table += `class="th-data-active" `;
                    _inner_table += `data-id="${_cabeza.by == 'asc' ? 'desc' : 'asc'}"> `;
                    // flecha
                    _inner_table += `${_cabeza.by === 'asc' ? '&dArr;' : '&uArr;'}`;
                    // titulo
                } else {
                    _inner_table += ` data-id="asc"> `;
                }
                _inner_table += ` ${value}`;
                _inner_table += `</th>`;
            });
            _inner_table += `</thead>`;
            _inner_table += `<tbody>`;
            $.each(_cuerpo, function (key) {
                _inner_table += `<tr id="${key}">`;
                $.each(_cuerpo[key], function (index, element) {
                    _inner_table += `<td data-label="${index}" id="table_${index}">`;

                    /*for (const [key, value] of Object.entries(_class.personalizacionTabla.campo)) {
                      console.log(`${key}: ${value}`);
                    }*/

                    if (index in _class.personalizacionTabla.campo) {
                        _inner_table += `<${_class.personalizacionTabla.campo[index].tag} `;
                        // solo una clase
                        if (Array.isArray(_class.personalizacionTabla.campo[index].class)) {
                            _inner_table += ` class="${_class.personalizacionTabla.campo[index].class[element.id]}" `;
                            _inner_table += ` title="${element.nombre}" >`;
                            _inner_table += `${_class.personalizacionTabla.campo[index].text == true ? element.nombre : ''}`;
                        } else {
                            _inner_table += ` class="${_class.personalizacionTabla.campo[index].class}" `;
                            _inner_table += ` title="${element}" >`;
                            _inner_table += `${_class.personalizacionTabla.campo[index].text == true ? element : ''}`;
                        }
                        _inner_table += `</${_class.personalizacionTabla.campo[index].tag}>`;
                    } else if (index == 'opciones') {
                        // crear botones
                        $.each(_class.personalizacionTabla.opciones, function (index_button, element_button) {
                            _inner_table += `<button btn-id="${element}" `;
                            _inner_table += `id="${element_button.id}" `;
                            _inner_table += `class="button primary small icon solid `;
                            _inner_table += `${element_button.icon}" `;
                            _inner_table += `title="${element_button.title}"></button>`;
                        });
                    } else {
                        _inner_table += element;
                    }
                    _inner_table += `</td>`;
                });
                _inner_table += `</tr>`;
            });
            _inner_table += '</tbody>';
            _inner_table += '</table>';
            $('#' + this.indicativo + '_container_resultados_body')
                .append(_inner_table)
                .show(100);
        }
    }
    buscadorAvanzado(_value) {
        if (_value == 1) {
            $('#' + this.indicativo + '-container-buscador-avanzado').hide(200);
        } else {
            $('#' + this.indicativo + '-container-buscador-avanzado').show(200);
        }
        // general
        $('#' + this.formulario).trigger('reset');
        // para los datetime

        //console.log('#' + this.formulario + ' .input_date_listener');
        $('#' + this.formulario + ' .input_date_listener').each(function () {  
            $('#'+this.id).val(getCurrentDate());
        });
        // para los ocultos del autocomplete
        $('#' + this.formulario)
            .find('input[type=hidden]')
            .each(function () {
                $(this).val($(this).attr('data-default'));
            });
    }
    buscadorContenido(_value) {
        if (_value == 0) {
            $('#' + this.indicativo + '_contenido')
                .attr('readonly', true)
                .val('Todo');
        } else {
            $('#' + this.indicativo + '_contenido')
                .attr('readonly', false)
                .val('');
        }
    }
    formularioSubmit(_type) {
        let _class = this;

        if (_type == true) {
            $('#' + _class.indicativo + '_page').val('1');
            $('#' + _class.indicativo + 'order').val('nro');
            $('#' + _class.indicativo + 'by').val('desc');
        }
        $('#' + _class.indicativo + '_container_resultados_title')
            .empty()
            .hide();
        $('#' + _class.indicativo + '_container_resultados_body')
            .empty()
            .hide();
        $('#' + _class.indicativo + '_container_resultados_pagination')
            .empty()
            .hide();

        let self = $.confirm({
            title: false,
            content: 'Cargando, espere...',
            typeAnimated: true,
            scrollToPreviousElement: false,
            scrollToPreviousElementAnimate: false,
            content: function () {
                return $.ajax({
                    url: _class.ajaxUrl,
                    type: 'POST',
                    data: new FormData($('#' + _class.formulario)[0]),
                    headers: {
                        'csrf-token': $('meta[name="csrf-token"]').attr('content'),
                    },
                    dataType: 'json',
                    processData: false,
                    contentType: false,
                    timeout: 35000,
                })
                    .done(function (response) {
                        // console.log(response.statusText);
                        if (response.statusText === 'bien') {
                            // console.log("bienn");
                            self.setTitle('Completado!');
                            self.setContent('Espere un momento...');
                            _class.tituloTabla(response.title);
                            _class.contenidoTabla(response.head, response.body);
                            _class.paginacionTabla(response.pages);
                            self.close();
                        } else if (response.statusText === 'sin_resultados') {
                            // console.log("sin resultados");
                            self.setTitle('Completado!');
                            self.setContent('Espere un momento...');
                            $('#' + _class.indicativo + '_container_resultados_body')
                                .html('<center>' + response.message + '</center>')
                                .show(100);
                            self.close();
                        } else if (response.statusText === 'no_session' || response.statusText === 'no_token') {
                            // console.log("Session o token");
                            self.close();
                            call_recuperar_session(function (k) {
                                _class.formularioSubmit(_type);
                            });
                        } else {
                            // console.log("dif a bien");
                            self.setTitle(response.statusText);
                            self.setContent(JSON.stringify(response.message));
                        }
                    })
                    .fail(function (response) {
                        self.setTitle('Error fatal');
                        self.setContent(JSON.stringify(response));
                        // console.log(response);
                    });
            },
            buttons: {
                aceptar: function () { },
            },
        });
    }
    buscadorLiData(_data_id) {
        if (_data_id !== '') {
            $('#' + this.indicativo + '_page').val(_data_id);
            this.formularioSubmit(false);
        } else {
            $.alert('Pagina incorrecta');
        }
    }
    buscadorThData(_field_id, _data_id) {
        $('#' + this.indicativo + '_page').val('1');
        $('#' + this.indicativo + '_order').val(_field_id);
        $('#' + this.indicativo + '_by').val(_data_id);
        this.formularioSubmit(false);
    }

    buscadorExcel() {
        let _class = this;

        if (_class.excel == true) {
            let self = $.confirm({
                title: false,
                content: 'Cargando, espere...',
                typeAnimated: true,
                scrollToPreviousElement: false,
                scrollToPreviousElementAnimate: false,
                content: function () {
                    return $.ajax({
                        url: _class.ajaxUrl,
                        type: 'POST',
                        data: new FormData($('#' + _class.formulario)[0]),
                        processData: false,
                        contentType: false,
                        headers: {
                            'csrf-token': $('meta[name="csrf-token"]').attr('content'),
                        },
                        dataType: 'json',
                    })
                        .done(function (response) {
                            if (response.statusText === 'bien') {
                                let array_excel = [];
                                // let temp_array = [];
                                $.each(response.body, function (key, value) {
                                    // numero
                                    Object.assign(array_excel, { [key]: {} });
                                    $.each(value, function (key_, value_) {
                                        if (typeof value_ === 'object') {
                                            $.each(value_, function (key__, value__) {
                                                Object.assign(array_excel[key], {
                                                    [_class.JSON2Replace(key_ + '_' + key__)]: _class.JSON2Replace(value__),
                                                });
                                            });
                                        } else {
                                            // ya va un valor
                                            Object.assign(array_excel[key], {
                                                [_class.JSON2Replace(key_)]: _class.JSON2Replace(value_),
                                            });
                                        }
                                    });
                                });
                                _class.JSON2CSV(JSON.stringify(Object.values(array_excel)), self);
                            } else if (response.statusText === 'no_session' || response.statusText === 'no_token') {
                                self.close();
                                call_recuperar_session(function (k) {
                                    _class.buscadorExcel();
                                });
                            } else {
                                self.setTitle('Error');
                                self.setContent('Sin resultados');
                            }
                        })
                        .fail(function (response) {
                            self.setTitle('Error fatal');
                            self.setContent(JSON.stringify(response));
                            console.log(response);
                        });
                },
                buttons: {
                    aceptar: function () { },
                },
            });
        } else {
            $.alert({
                title: '¡Error!',
                content: '<center><b>Sin privilegios</b> para exportar</center>',
            });
        }
    }
    JSON2Replace(str) {
        return str.toString().replace(/,/g, '');
    }

    JSON2CSV(objArray, self) {
        let array = typeof objArray != 'object' ? JSON.parse(objArray) : objArray;

        let str = '';
        let line = '';

        for (let index in array[0]) {
            let value = index + '';
            line += '"' + value.replace(/"/g, '""') + '",';
        }

        line = line.slice(0, -1);
        str += line + '\r\n';

        for (let i = 0; i < array.length; i++) {
            line = '';
            for (let index in array[i]) {
                line += array[i][index] + ',';
            }
            line = line.slice(0, -1);
            str += line + '\r\n';
        }

        str = 'sep=,\r\n' + str;
        let name = 'Reporte_' + $.now() + '.csv';
        let link = document.createElement('a');
        link.href = 'data:text/csv;charset=utf-8,' + encodeURIComponent(str);
        link.style = 'visibility:hidden';
        link.download = name;
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);

        self.setTitle('¡Completado!');
        self.setContent(`<center>Verifique el archivo en la carpeta descargas<br><b>${name}</b></center>`);
    }
}