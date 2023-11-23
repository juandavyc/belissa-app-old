/* autocomplete.js v2.0 | @juandavyc | MIT licensed */

const myAutocomplete = (_config) => {

    let valor = _config.input.text.value;
    let urlSearch = null;

    const autocompleteList = document.createElement("div");

    const strongElement = document.createElement("strong");
    const inputNombre = document.createElement("input");
    const inputId = document.createElement("input");

    // No autocomplete

    
    _config.input.text.classList.add("autocomplete-input");
    inputNombre.type = "hidden";
    inputId.type = "hidden";

    _config.input.text.setAttribute("autocomplete", "off");

    autocompleteList.setAttribute("id", _config.input.text.id + "autocomplete-list");
    autocompleteList.setAttribute("class", "autocomplete-items");

    // agregar 
    _config.input.text.parentNode.appendChild(autocompleteList);


    if(_config.hasOwnProperty('url')){
        urlSearch = PROTOCOL_HOST + _config.url;
    }
    else{
        urlSearch = PROTOCOL_HOST + "/app/class/autocomplete-v2/search.php";
    }


    $(_config.input.text).keyup(helixDelay(function (e) {
        getValidationInput(this.value);
    }, 500));


    const getValidationInput = (_value) => {
        if (_value.length > 0) {
            ajaxSearchItem(_value);
        } else {
            onCloseAllLists();
            onParentChildsReset();
        }
        _config.input.hidden.value = '';
    }


    const getParent = () => (_config.parent == true) ? true : false;
    const getParentId = () => getParent() ? 'parent' : _config.parent.value;
    const getParentColumn = () => getParent() ? 'parent' : _config.table[3]
    const getChildsLength = () => _config.childs.length;

    const onParentChildsReset = () => {
        if (getParent() == true && getChildsLength() > 0) {
            onChildsReset();
        }
    }

    const ajaxSearchItem = (_value) => {
        $.ajax({
            url: urlSearch,
            type: "POST",
            dataType: 'json',
            data: {
                value: _value,
                id: _config.table[0],
                column: _config.table[1],
                table: _config.table[2],
                parent_id: getParentId(),
                parent_column: getParentColumn()
            },
            timeout: 10000,
            headers: {
                'csrf-token': 'token',
            },
            success: function (_response) {
                if (_response.statusText === 'bien') {
                    onSelectItem(_response.items);
                } else if (_response.statusText === 'sin_resultados') {
                    noResult();
                } else if (
                    _response.statusText === 'no_token' ||
                    _response.statusText === 'no_session'
                ) {
                    call_recuperar_session(function (k) {
                        ajaxSearchItem(_value);
                    });
                } else {
                    $.alert(JSON.stringify(_response));
                }
            },
        })
    }

    const ajaxCreateItem = (_value) => {

        onParentChildsReset();
        onResetInputs();

        let self = $.confirm({
            title: 'Espere... ',
            content: 'Cargando, espere...',
            typeAnimated: true,
            scrollToPreviousElement: false,
            scrollToPreviousElementAnimate: false,
            content: function () {
                return $.ajax({
                    url: PROTOCOL_HOST + '/app/class/autocomplete-v2/create.php',
                    type: 'POST',
                    data: {
                        value: _value,
                        column: _config.table[1],
                        table: _config.table[2],
                        parent_id: getParentId(),
                        parent_column: getParentColumn()
                    },
                    headers: {
                        'csrf-token': $('meta[name="csrf-token"]').attr('content'),
                    },
                    dataType: 'json',
                    timeout: 10000,
                })
                    .done(function (response) {
                        if (response.statusText === 'bien') {
                            self.setTitle('Completado');
                            self.setContent(`<center><b>(${response.nombre})</b> <br> Creado correctamente</center>`);

                            _config.input.text.value = response.nombre;
                            if ("key" in _config.input) {
                                _config.input.hidden.value = response.nombre;
                            }
                            else {
                                _config.input.hidden.value = response.id;
                            }

                            onCloseAllLists();
                        } else if (
                            response.statusText === 'no_token' ||
                            response.statusText === 'no_session'
                        ) {
                            call_recuperar_session(function (k) {
                                ajaxCreateItem(_value);
                            });
                        } else {

                            self.setTitle('Error');
                            self.setContent(JSON.stringify(response));
                        }
                    })
                    .fail(function (response) {
                        self.setTitle('Error fatal');
                        self.setContent(JSON.stringify(response));
                    });
            },
            buttons: {
                aceptar: function () { },
            },
        });
    }

    const noResult = () => {
        onCloseAllLists();
        makeSecureCreateItem();
    }

    const makeSecureCreateItem = () => {
        const container = document.createElement("div");
        if (_config.create) {
            container.classList.add("autocomplete-items-create");
            container.textContent = "Crear ítem: ";
            strongElement.textContent = _config.input.text.value;
            inputNombre.value = _config.input.text.value;
            container.appendChild(inputNombre.cloneNode(true));
            container.appendChild(strongElement.cloneNode(true));
            container.addEventListener("click", function (e) {
                e.preventDefault();
                ajaxCreateItem(this.getElementsByTagName("input")[0].value);
                onParentChildsReset();
                onCloseAllLists();
            });

            autocompleteList.appendChild(container);
        } else {
            container.classList.add("autocomplete-items-no-create");
            container.textContent = "Denegado: ";
            strongElement.textContent = 'no puede crear ítems.';
            container.appendChild(strongElement.cloneNode(true));
            container.addEventListener("click", function (e) {
                e.preventDefault();
                onResetInputs();
                onCloseAllLists();
            });
            autocompleteList.appendChild(container);
        }

        return container;
    }

    const onChildsReset = () => {
        _config.childs.forEach((element, index) => {
            element.value = '';
        })
    }
    const makeSecurelistItems = (valor, value) => {

        const container = document.createElement("div");

        const remainingText = document.createTextNode(value.nombre.substr(valor.length));
        strongElement.textContent = value.nombre.substr(0, valor.length);

        inputNombre.value = value.nombre;
        inputId.value = value.id;

        container.appendChild(strongElement.cloneNode(true));
        container.appendChild(remainingText);
        container.appendChild(inputNombre.cloneNode(true));
        container.appendChild(inputId.cloneNode(true));

        autocompleteList.appendChild(container);

        return container;
    }


    const onSelectItem = (_arr) => {
        onCloseAllLists();
        valor = _config.input.text.value;
        $.each(_arr, function (key, value) {
            makeSecurelistItems(valor, value).addEventListener("click", function (e) {
                e.preventDefault();
                _config.input.text.value = this.getElementsByTagName("input")[0].value;
                if ("key" in _config.input) {
                    _config.input.hidden.value = this.getElementsByTagName("input")[0].value;
                }
                else {
                    _config.input.hidden.value = this.getElementsByTagName("input")[1].value;
                }
                onParentChildsReset();
                onCloseAllLists();
            });
        });

        makeSecureCreateItem();
    }

    const onCloseAllLists = (_elemento) => {
        const x = document.getElementsByClassName("autocomplete-items");
        for (let i = 0; i < x.length; i++) {
            if (_elemento !== x[i] && _elemento !== _config.input.text) {
                while (x[i].firstChild) {
                    x[i].removeChild(x[i].firstChild);
                }
            }
        }
    }
    const onResetInputs = () => {
        _config.input.text.value = '';
        _config.input.hidden.value = '';
    }

}


const autoCompleteForceCloseAllLists = (_elemento) => {
    const x = document.getElementsByClassName("autocomplete-items");
    for (let i = 0; i < x.length; i++) {
        if (_elemento !== x[i]) {
            while (x[i].firstChild) {
                x[i].removeChild(x[i].firstChild);
            }
        }
    }
}
