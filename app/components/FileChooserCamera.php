<div id="modal-filechooser-camera" class="my-modal">
    <div class="my-modal-container">
        <div class="my-modal-content">
            <div id="filechooser-camera-container">
                <div class="row gtr-25 gtr-uniform">
                    <div class="col-8 col-12-small">
                        <div class="camera-video-container">
                            <video id="filechooser-camera-video" class="camera-video-off">
                                Video stream not available.
                            </video>
                            <!-- <input type="hidden" id="filechooser-camera-input-folder" value="" /> -->
                        </div>

                        <div class="canvas-camera-container">
                            <canvas id="filechooser-camera-canvas" class="camera-canvas"></canvas>
                        </div>
                    </div>
                    <div class="col-4 col-12-small">
                        <fieldset>
                            <legend> Control </legend>
                            <div class="row gtr-25 gtr-uniform">
                                <div class="col-12">
                                    <button id="btn-camera-take" class="button primary small fit btn-camera"> Tomar Foto</button>
                                </div>
                                <div class="col-12">
                                    <button id="btn-camera-upload" class="button primary small fit btn-camera"> Guardar </button>
                                </div>
                                <div class="col-12">
                                    <button id="btn-camera-reload" class="button primary small fit btn-camera"> Corregir </button>
                                </div>
                                <div class="col-2 col-12-mobilep">
                                    <i class="fa-solid fa-folder-tree fa-sm"></i>
                                </div>
                                <div class="col-10 col-12-mobilep">
                                    <h4 id="filechooser-camera-h4-folder-date"> Folder </h4>
                                </div>
                                <div class="col-2 col-12-mobilep">
                                    <i class="fa-solid fa-bolt-lightning fa-sm"></i>
                                </div>
                                <div class="col-10 col-12-mobilep">
                                    <input type="checkbox" id="checkbox-camera-flash">
                                    <label for="checkbox-camera-flash"> Activar <b>flash</b></label>
                                </div>
                            </div>
                        </fieldset>
                    </div>
                    <div class="col-12 align-center">
                        <h4>Released: <b>08.1251</b> Last Updated: <b>17.07.23</b></h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<input type="file" id="filechooser-file" accept="image/*,video/*" style="display: none;">