<section class="wrapper style3 container max" id="container-ingreso-cliente">
    <?php
    if ($authIngreso['statusText'] === "bien") {
        require $app->ruta->getView('pre-ingreso/Ingreso');
    } else {
    ?>
        <div class="align-center">
            <i class="fa-solid fa-face-sad-cry fa-3x"></i>
            <h2><?= htmlspecialchars(strtoupper($authIngreso['statusText'])) ?></h2>
            <h3><?= htmlspecialchars($authIngreso['message']) ?></h3>
            <br><br>
            <p>
                Para más información, comunícate al
                <h3>(+57) 316 222 3400</h3>
                <a href="tel:3162223400" class="button primary"><i class="fa-solid fa-phone"></i> Llamar</a> 
                <a href="https://api.whatsapp.com/send/?phone=573162223400&text=hola+quisiera+mas+informaci%C3%B3n+sobre+CDAAUTOMOTOS&app_absent=0" class="button primary"><i class="fa-brands fa-whatsapp"></i> Whatsapp</a>
            </p>
            <h4>CDA AUTOMOTOS S.A.S</h4>
        </div>
    <?php
    }
    ?>
</section>