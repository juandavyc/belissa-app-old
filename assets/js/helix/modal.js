/* MyModal.js v2.0 | @juandavyc | MIT licensed */

class MyModal {

    constructor(_config) {

        this._modal = document.getElementById(_config.container);
        this._head = document.createElement('div');
        this._container = this._modal.querySelector('.my-modal-container');
        this._content = this._modal.querySelector('.my-modal-content');

        this._onOpen = _config.event.onOpen;
        this._onClose = _config.event.onClose;

        this._modal_init(_config);
    }


    _modal_init(_config) {

        this._container.classList.add('my-modal_' + _config.columnClass);

        this._head.className = 'my-modal-head';
        this._head.innerHTML = '<span class="my-modal-title"><i class="icon solid ' + _config.icon + '"></i> ' + _config.title + '</span>';
      
        this._container.prepend(this._head);

        if(_config.closeIcon){
            this._head.innerHTML += '<span class="my-modal-close">&times;</span>';
            this._close = this._modal.querySelector('.my-modal-close');
            this._close.addEventListener("click", () => { 
                this.close() 
            });
        } 
    }


    open() {
        this._onOpen();
        this._modal.className = "my-modal my-modal-open-class";
    }

    close() {
        this._modal.className = "my-modal my-modal-close-class";
        this._onClose();
    }

    scrollTopContent(num){
        this._content.scrollTop = num;
    }

}
// Ejemplo 

// const myModalTest = new MyModal({
//     container: 'container-editar-rango', // id
//     title: 'Editar datos', 
//     icon: 'fa fa-warning', // fa fa icon
//     columnClass: 'md', //xs, sm, md, lg, mx
//     event: {
//         onOpen: () => { },
//         onClose: () => { editarRangoReset() },
//     },
// });

// Activar
// myModalTest.open();
// Cerrar
// myModalTest.close();