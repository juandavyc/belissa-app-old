<?php session_start();
require $_SERVER["DOCUMENT_ROOT"] . '/app/config.php';
$app = new MyCallCenterApp();
$app->verificar->isVigenteSession('HTML');
$app->verificar->isAutorizado('test', true);
$app->menu->setModulo($app->menu->getMenuArray()['test']);
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <?php require $app->ruta->getHead() ?>

    <style>
        .h1-lg-size {
            font-size: 4em;
            line-height: 0.3em;
        }



        .fieldset-gray {
            background: #f4f7fb;
        }

        .fieldset-gray legend {
            background: #f4f7fb;
            border-radius: 4px;
        }

        .basico-input-placa {
            font-size: 45px;
            text-align: center;
            border: 1px solid #CED4DA;
            border-top-left-radius: 10px;
            border-bottom-left-radius: 10px;
            text-transform: uppercase;
            padding: 0px !important;
        }

        .basico-select-placa {
            font-size: 18px;
            text-align: center;
            border: 1px solid #CED4DA;
            border-top-left-radius: 10px;
            border-bottom-left-radius: 10px;
        }

        .align-middle {
            height: 100%;
            display: flex;
            align-items: center;
        }
    </style>
</head>

<body data-id="test" class="is-preload landing">
    <div id="page-wrapper">
        <article id="main">
            <?php $app->ruta->getComponent('FileChooserCamera') ?>
            <?php require $app->ruta->getView('RecuperarSession') ?>
            <?php require $app->ruta->getView('test/Main') ?>
        </article>
        <?php require $app->ruta->getFooter() ?>
    </div>
    <?= $app->menu->getMenu($app::NAME, $app->ruta->getRoot()) ?>
    <?php require $app->ruta->getScript() ?>
    <?php require $app->ruta->getScriptHelix() ?>
    <script>
        // autocomplete

        myAutocomplete({
            parent: true,
            create: true,
            input: {
                text: document.getElementById("ingreso-canal-mercadeo-text"),
                hidden: document.getElementById("ingreso_canal_mercadeo_select"),
            },
            table: ['id', 'nombre', 'canal'],
            childs: [],
            default: [0, 'Seleccione'],
        });

        myAutocomplete({
            parent: true,
            create: false,
            input: {
                text: document.getElementById("ingreso-canal-mercadeo-2-text"),
                hidden: document.getElementById("ingreso-canal-mercadeo-2-select"),
            },
            table: ['id', 'nombre', 'canal'],
            childs: [],
            default: [0, 'Seleccione'],
        });


        $.validator.addMethod("hiddenField", function(value, element) {
            // Validar que el valor del campo no esté vacío
            return value !== "";
        }, "Este campo es obligatorio.");
        $.validator.setDefaults({
            ignore: [],
        });

        const formulario = document.getElementById('form-mercadeo');
        const validacion = validateFormRulesEngine({
            form: formulario,
            rules: {
                canal_mercadeo_create: {
                    required: true,
                    valueNotEquals: '1'

                },
                canal_mercadeo_no_create: {
                    required: true,
                    valueNotEquals: '1'
                }
            },
            messages: {
                // canal_mercadeo_create: "Este campo es obligatorio.",
                // canal_mercadeo_no_create: "Este campo es obligatorio.",
            }
        });


        formulario.addEventListener('submit', (e) => {

            if ($(formulario).valid()) {
                console.log("valid");
            } else {
                validateFormError(validacion);

            }
            e.preventDefault();
        });


        // const formularioBasico = document.getElementById('formulario-datos-basicos');
        // const elementosBasico = {

        // };
        // const validacionBasico = validateFormRulesEngine({
        //     form: formularioBasico,
        //     rules: {
        //         placa: {
        //             required: true,
        //             minlength: 5,
        //             maxlength: 6,
        //             noSpace: true,
        //             placaValidator: true
        //         },
        //         tipo_vehiculo: {
        //             required: true,
        //             valueNotEquals: 'default'
        //         },
        //     },
        //     messages: {}
        // });

        // formularioBasico.addEventListener('submit', (e) => {
        //     e.preventDefault();
        //     if ($(formularioBasico).valid()) {
        //         console.log("valid");
        //     } else {
        //         validateFormError(validacionBasico);
        //     }
        // });
    </script>
</body>

</html>