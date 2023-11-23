/* canvas.firma.js v3.0 | @juandavyc | MIT licensed */

class CanvasFirma {

    constructor({ container, title }) {

        this.canvasRound = 5;
        this.canvasLines = [];
        this.canvasPoints = [];

        this.IMAGE = new Image();
        this.IS_DRAWING = false;
        this.IS_USED = false;

        this.mainContainer = container;
        this.canvasContainer = document.createElement('canvas');
        this.canvasContext2D = this.canvasContainer.getContext("2d");

        this.canvasContainer.width = this.mainContainer.offsetWidth - 90;
        this.canvasContainer.height = this.mainContainer.offsetWidth / 2.8;

        this.canvasContext2D.lineWidth = 3;
        this.canvasContext2D.lineJoin = "round";
        this.canvasContext2D.strokeStyle = "#04303C";

        this.buttonUndo = document.createElement('button');
        this.buttonResize = document.createElement('button');


        this.stringBlob = "";
        this.appendCanvas(title);
        this.eventListener(this);
    }

    appendCanvas(title) {
        const labelTitle = document.createElement('label');
        const lineBreak = document.createElement('br');

        this.buttonUndo.classList.add('primary', 'small', 'icon', 'solid', 'fa-undo');
        this.buttonResize.classList.add('primary', 'small', 'icon', 'solid', 'fa-minimize');

        labelTitle.textContent = title;

        this.mainContainer.appendChild(labelTitle);
        this.mainContainer.appendChild(this.canvasContainer);
        this.mainContainer.appendChild(lineBreak);
        this.mainContainer.appendChild(this.buttonUndo);
        this.mainContainer.appendChild(this.buttonResize);
    }


    eventListener(_class = this) {

        // buttons
        _class.buttonUndo.addEventListener("click", (e) => {
            e.preventDefault();
            _class.setDefault();
        });
        _class.buttonResize.addEventListener("click", (e) => {
            e.preventDefault();
            _class.setResize();
        });
      



        // touch
        _class.canvasContainer.addEventListener("touchstart", (e) => { // mousedown
            _class.drawStart(e.touches[0]);
        });
        _class.canvasContainer.addEventListener("touchmove", (e) => {
            e.preventDefault();
            _class.drawMove(e.touches[0]);
        });
        _class.canvasContainer.addEventListener("touchend", (e) => { // mouseup           
            _class.drawLines(e.touches[0]);
        });
        // mouse
        _class.canvasContainer.addEventListener("mousedown", (e) => {
            _class.drawStart();
        });
        _class.canvasContainer.addEventListener("mouseup", (e) => {
            _class.drawLines();
        });
        _class.canvasContainer.addEventListener("mouseout", (e) => {
            _class.drawLines();
        });
        _class.canvasContainer.addEventListener("mousemove", (e) => {
            _class.drawMove(e);
        });

    }

    mouseCurrentPos = (_touch) => {
        return {
            x: _touch.clientX - this.canvasContainer.getBoundingClientRect().left,
            y: _touch.clientY - this.canvasContainer.getBoundingClientRect().top
        }
    }

    setDefault() {
        this.canvasContext2D.lineWidth = 3;
        this.canvasContext2D.clearRect(0, 0, this.canvasContainer.width, this.canvasContainer.height);
        this.canvasContext2D.beginPath();
        this.IS_DRAWING = false;
        this.IS_USED = false;
        this.canvasPoints = [];
        this.canvasLines = [];
    }

    setResize() {

        this.canvasContainer.width = this.mainContainer.offsetWidth - 90;
        this.canvasContainer.height = this.mainContainer.offsetWidth / 2.8;
        this.setDefault();
    }

    drawStart() {
        this.IS_DRAWING = true;
        this.IS_USED = true;
        this.canvasContext2D.beginPath();
        this.canvasPoints.length = 0;
    }

    drawMove(_touch) {
        if (this.IS_DRAWING) {
            this.canvasPoints.push(this.mouseCurrentPos(_touch));
            this.canvasContext2D.lineTo(this.mouseCurrentPos(_touch).x, this.mouseCurrentPos(_touch).y);
            this.canvasContext2D.stroke();
        }
    }

    drawLines() {
       
        if (this.IS_DRAWING) {
            this.canvasContext2D.clearRect(0, 0, this.canvasContainer.width, this.canvasContainer.height);
            this.reduceArray(this.canvasPoints);
            for (let i = 0; i < this.canvasLines.length; i++)
                this.smoothLine(this.canvasLines[i]);
        }
        this.IS_DRAWING = false;
    }

    reduceArray(pointsArray) {
        let tempArray = [];
        tempArray[0] = pointsArray[0];
        for (let i = 0; i < pointsArray.length; i++) {
            if (i % this.canvasRound == 0) {
                tempArray[tempArray.length] = pointsArray[i];
            }
        }
        tempArray[tempArray.length - 1] = pointsArray[pointsArray.length - 1];
        this.canvasLines.push(tempArray);
    }

    mouseCheckPoint = (ry, a, b) => {
        return {
            x: (ry[a].x + ry[b].x) / 2,
            y: (ry[a].y + ry[b].y) / 2
        }
    }

    smoothLine(ry) {
        if (ry.length > 1) {
            let lastPoint = ry.length - 1;
            this.canvasContext2D.beginPath();
            this.canvasContext2D.moveTo(ry[0].x, ry[0].y);
            for (var i = 1; i < ry.length - 2; i++) {
                let pc = this.mouseCheckPoint(ry, i, i + 1);
                this.canvasContext2D.quadraticCurveTo(ry[i].x, ry[i].y, pc.x, pc.y);
            }
            this.canvasContext2D.quadraticCurveTo(ry[lastPoint - 1].x, ry[lastPoint - 1].y, ry[lastPoint].x, ry[lastPoint].y);
            this.canvasContext2D.stroke();
        }
    }

    setBlob(blob) {
        const ctx = this.canvasContext2D;
        this.IMAGE.onload = (t) => {
            ctx.drawImage(this, 0, 0)
        },
            this.image.src = blob;
    }

    setImage(_image) {

        const _ctx = this.canvasContext2D;
        const _canvas = this.canvasContainer;
        this.setDefault();

        this.IMAGE.onload = function (e) {
            _ctx.drawImage(
                this,
                0,
                0,
                this.width,
                this.height,
                0,
                0,
                _canvas.width,
                _canvas.height
            );
        };
        this.IS_USED = true;
        this.IS_DRAWING = false;
        this.IMAGE.src = _image;
    }

    get getBlob() {
        return this.canvasContainer.toDataURL()
    }
    get getStatus() {
        return this.IS_USED
    }

}

// Uso?
// const formulario = document.getElementById('formulario-agregar');
// const firma = new CanvasFirma({
//     container: formulario.querySelector('#firma-usuario'),
//     title: "Su firma",
// });
// <? php $app -> ruta -> getComponent(
//     'CameraControl',
//     array(
//         'id' => 'foto-usuario',
//         'name' => 'foto',
//         'title' => 'Foto del usuario',
//         'value' => '/images/sin_imagen.png',
//         'folder' => 'usuario/foto'
//     )
// ) ?>
