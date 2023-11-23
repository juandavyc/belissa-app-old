/* jquery confirm */
/* jquery validate */

const PROTOCOL_ = location.protocol;
const HOST_ = location.host;
const PROTOCOL_HOST = location.protocol + '//' + location.host;
const APP_CONTROLLERS = PROTOCOL_HOST + '/app/controllers/';
const APP_MODELS = PROTOCOL_HOST + '/app/models/';

const btnTopBody = document.getElementById('top-body-button');
const breadcrumbsArray = location.href.split('/').slice(2);
const breadcrumbsContainer = document.getElementById('main-breadcrumbs');

const btnIncreaseSizeFont = document.getElementById('btnIncrease');
const btnDecreaseSizeFont = document.getElementById('btnDecrease');
const containerMainApp = document.getElementById('main');

let fontSizeIncrement = 0;

const validateFormRulesEngine = ({ form, rules = {}, messages = {} }) => {
    /* jquery validate */
    const validacion = $(form).validate({
        rules: rules,
        messages: messages,
        errorPlacement: function (label, element) {
            label.addClass('errorMsq');
            element.parent().append(label);
        },
    });
    return validacion;
}

const createElementNode = (element) => document.createElement(element);

const validateFormError = (validate) => {
    const _ul = createElementNode('ul');
    // cloneNode (true)
    const _bold = createElementNode('b');
    const _italic = createElementNode('i');
    for (const [key, value] of Object.entries(validate.errorMap)) {
        const _li = createElementNode('li');
        _bold.textContent = (key.replace(/_/g, ' ').toUpperCase());
        _italic.textContent = (value);
        _li.appendChild(_bold.cloneNode(true));
        _li.appendChild(document.createTextNode(' : '));
        _li.appendChild(_italic.cloneNode(true));
        _ul.appendChild(_li);
    }
    /* jquery confirm */
    $.alert({
        title: 'Error',
        content: _ul
    });
}
// Active del sidebar
document.querySelector('#menu-' + document.body.getAttribute('data-id')).classList.add('active');

// Ir al cielo
btnTopBody.addEventListener('click', () => {
    window.scrollTo({
        top: document.body,
        behavior: 'smooth'
    });
});

window.onscroll = function () {
    if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
        btnTopBody.style.display = 'block'
    } else {
        btnTopBody.style.display = 'none'
    }
};


btnIncreaseSizeFont.addEventListener('click', (e) => {
    e.preventDefault();
    if (fontSizeIncrement <= 20) {
        changeFontSize(2);
    }
    else {
        alert("Se llego al límite de tamaño (Al Aumentar)");
    }
});

btnDecreaseSizeFont.addEventListener('click', (e) => {
    e.preventDefault();
    if (fontSizeIncrement >= -4) {
        changeFontSize(-2);
    }
    else {
        alert("Se llego al límite de tamaño (Al Disminuir)");
    }
});


const changeFontSize = (changeValue) => {
    const arrayElementsMain = containerMainApp.querySelectorAll('select, label, input, h1, h2, h3, h4, p, i, legend, button, table, a, .datepicker-grid, textarea, .autocomplete-items, ul');
    let currentFontSize = 0;
    arrayElementsMain.forEach(element => {
        const computedStyle = window.getComputedStyle(element);
        if (computedStyle.display !== 'none' && computedStyle.visibility !== 'hidden' && computedStyle.fontSize) {
            currentFontSize = parseFloat(computedStyle.fontSize);
            currentFontSize += changeValue;
            element.style.fontSize = currentFontSize + 'px';
        }
    });


    fontSizeIncrement += changeValue;

    sessionStorage.setItem('fontSizeIncrement', fontSizeIncrement);
}


const helixDelay = (callback, ms) => {
    let timer = 0;
    return function () {
        let context = this,
            args = arguments;
        clearTimeout(timer);
        timer = setTimeout(function () {
            callback.apply(context, args);
        }, ms || 0);
    };
}


if (breadcrumbsContainer) {

    for (let i = 0; i < breadcrumbsArray.length; i++) {
        let text = decodeURIComponent(breadcrumbsArray[i]).toLowerCase();
        if (text) {
            const linkElement = document.createElement('a');
            const title = text;
            text = text.replace(/\.php|\.html/g, '');

            // Construir el enlace corregido
            const link = '/' + breadcrumbsArray.slice(1, i + 1).join('/');

            linkElement.href = link;
            linkElement.className = 'breadcrumbs-item';
            linkElement.title = title;

            if (i == 0) {
                linkElement.textContent = 'CDA';
            } else {
                
                if(text.indexOf("index") !== -1){
                    linkElement.textContent = 'index';
                }
                else{
                    linkElement.textContent = text;
                }
            }

            breadcrumbsContainer.appendChild(linkElement);
        }
    }
}
const specialChars = (str) => {
    const map = {
        '&amp;': '&',
        '&lt;': '<',
        '&gt;': '>',
        '&quot;': '"',
        '&#039;': "'"
    };
    return str.replace(/&amp;|&lt;|&gt;|&quot;|&#039;/g, function (m) {
        return map[m];
    });
}

const getMyAppModel = (dir = null, model = null) => {
    if (model !== null) {
        return PROTOCOL_HOST + '/app/models/' + dir + 'Model.php?m=' + model;
    } else {
        return PROTOCOL_HOST + '/app/models/' + dir + 'Model.php';
    }
}

const getCurrentDate = () => {
    const today = new Date();
    const yyyy = today.getFullYear();
    let mm = today.getMonth() + 1;
    let dd = today.getDate();
    if (dd < 10) dd = '0' + dd;
    if (mm < 10) mm = '0' + mm;
    return formattedToday = dd + '/' + mm + '/' + yyyy;
}

const getRequestConfig = ({
    processData = false,
    url,
    formData,
    datatype = 'json'
}) => {
    const request = {
        url: url,
        type: 'POST',
        data: formData,
        headers: {
            'csrf-token': $('meta[name="csrf-token"]').attr('content'),
        },
        dataType: datatype,
        timeout: 35000,
    };

    if (processData === false) {
        request.processData = false;
        request.contentType = false;
    }

    return request;
}
document.addEventListener("DOMContentLoaded", function () {
    const fontSizeSession = sessionStorage.getItem('fontSizeIncrement');
    if (fontSizeSession == null || isNaN(fontSizeSession)) {
        changeFontSize(0);
    }
    else {
        changeFontSize(parseInt(fontSizeSession));
    }
});
