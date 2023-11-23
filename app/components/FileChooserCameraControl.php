<?php
if (isset($dir) && isset($data)) {
?>
    <div class="photo-control">
        <div class="photo-input-container">
            <label><i class="fas <?= $data->icon ?>"></i> <?= $data->title ?></label>
            <input type="text" id="<?= $data->id ?>" name="<?= $data->name ?>" value="<?= $data->value ?>" readonly />
        </div>
        <div class="photo-buttons-container">
            <button class="button primary small btn-file-open" id="btn-<?= $data->id ?>" data-folder="<?= $data->folder ?>" input-id="<?= $data->id ?>"></button>
            <button class="button primary small btn-camera-open" id="btn-<?= $data->id ?>" data-folder="<?= $data->folder ?>" input-id="<?= $data->id ?>"></button>
            <button class="button primary small btn-camera-show" data-id="<?= $data->id ?>"></button>
        </div>
    </div>
<?php
}
