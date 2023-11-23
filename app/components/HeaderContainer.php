<?php
if (isset($dir) && isset($data)) {
?>   
    <header class="special container">
        <span class="<?= $data->icon ?>"></span>
        <h2>
            <?= $data->name ?>
        </h2>
        <p>
            <?= htmlspecialchars($_SESSION['session_user'][3]); ?>
        </p>       
    </header>    
    <nav class="breadcrumbs" id="main-breadcrumbs"></nav>
<?php
}
