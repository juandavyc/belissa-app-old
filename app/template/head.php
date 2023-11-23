<title><?= $app->menu->current['name'] ?> | <?= $app::NAME ?></title>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
<meta name="csrf-token" content="<?= $app->verificar->getToken() ?>">
<link rel="shortcut icon" type="image/jpg" href="/images/favicon.png" />
<link rel="stylesheet" href="/assets/css/main.css" />
<noscript>
    <link rel="stylesheet" href="/assets/css/noscript.css" />
</noscript>