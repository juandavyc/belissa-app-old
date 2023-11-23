<?php
if (isset($dir) && isset($data)) {
?>
    <i class="fa-solid <?=$data->icon?> fa-3x"></i>
    <h3> <?= $data->title ?></h3>
<?php
}
?>