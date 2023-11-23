import { PreIngreso } from "./PreIngreso.js";

const preIngreso = PreIngreso();
preIngreso.setTipoDocumento();

new FileChooserCamera(
    {
        folder: 'ingreso/foto',
        rotate: 0,
        url: {
            file: `${PROTOCOL_HOST}/cda/pre-ingreso/model/UploadFile.php`,
            photo: `${PROTOCOL_HOST}/cda/pre-ingreso/model/UploadPhoto.php`,
        }
    }
);