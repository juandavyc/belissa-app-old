<?php
class MyAppMenu
{

    public $inner_html = '';
    private $verificar = null;
    private $modulos = null;
    public $current = [];
    private $menuApp = array(
        'inicio' => array(
            'nombre' => 'Inicio',
            'icono' => 'icon solid fa-home',
            'url' => '/web/',
        ),
        'ingreso-rapido' => array(
            'nombre' => 'Ingreso Rapido',
            'icono' => 'icon solid fa-gauge-simple-high',
            'url' => '/web/ingreso-rapido/',
        ),
        'ingreso-completo' => array(
            'nombre' => 'Ingreso Completo',
            'icono' => 'icon solid fa-gauge-simple',
            'url' => '/web/ingreso-completo/',
        ),
        'crear-cliente-vehiculo' => array(
            'nombre' => 'Crear Cliente-Vehículo',
            'icono' => 'icon solid fa-circle-plus',
            'url' => '/web/crear-cliente-vehiculo/',
        ),     
        'callcenter' => array(
            'nombre' => 'Call Center',
            'icono' => 'icon solid fa-phone',
            'url' => '/web/callcenter/',
        ),
        'cda-agendamiento' => array(
            'nombre' => 'CDA - Agendamiento',
            'icono' => 'icon solid fa-calendar-week',
            'url' => '/web/cda-agendamiento/',
        ),
        'mi-agendamiento' => array(
            'nombre' => 'Mi - Agendamiento',
            'icono' => 'icon solid fa-calendar',
            'url' => '/web/mi-agendamiento/',
        ),
        'visor-ingreso' => array(
            'nombre' => 'Visor Ingreso',
            'icono' => 'icon solid fa-table-list',
            'url' => '/web/visor-ingreso/',
        ),
        'visor-psi' => array(
            'nombre' => 'Visor PSI',
            'icono' => 'icon solid fa-circle',
            'url' => '/web/visor-psi/',
        ),
        'visor-pdf' => array(
            'nombre' => 'Visor PDF',
            'icono' => 'icon solid fa-file-pdf',
            'url' => '/web/visor-pdf/',
        ),
        'pqrsc' => array(
            'nombre' => 'PQRS & C',
            'icono' => 'icon solid fa-mug-hot',
            'url' => '/web/pqrsc/',
        ),
        'bitacora' => array(
            'nombre' => 'Bitácora',
            'icono' => 'icon solid fa-users-rays',
            'url' => '/web/bitacora/',
        ),
        'conteo-rtm' => array(
            'nombre' => 'Conteo RTMyEC',
            'icono' => 'icon solid fa-chart-pie',
            'url' => '/web/conteo-rtm/',
        ),
        'cpanel' => array(
            'nombre' => 'cPanel',
            'icono' => 'icon solid fa-table-list',
            'url' => '/web/visor-pdf/',
            'sub-menu' => array(
                'novedades' => array(
                    'nombre' => 'Novedades',
                    'icono' => 'icon solid fa-newspaper',
                    'url' => '/web/cpanel/novedades',
                ),
                'rango' => array(
                    'nombre' => 'Rangos',
                    'icono' => 'icon solid fa-people-arrows',
                    'url' => '/web/cpanel/rango',
                ),
                'usuarios' => array(
                    'nombre' => 'Usuarios',
                    'icono' => 'icon solid fa-users-line',
                    'url' => '/web/cpanel/usuario',
                ),
                // 'mercadeo' => array(
                //     'nombre' => 'Mercadeo',
                //     'icono' => 'icon solid fa-chart-simple',
                //     'url' => '/web/cpanel/mercadeo',
                // ),
                // 'vehiculos' => array(
                //     'nombre' => 'Vehiculos',
                //     'icono' => 'icon solid fa-car-side',
                //     'url' => '/web/cpanel/vehiculo',
                // ),
                // 'clientes' => array(
                //     'nombre' => 'Clientes',
                //     'icono' => 'icon solid fa-user-tie',
                //     'url' => '/web/cpanel/cliente',
                // ),
            ),
        ),
        'documentacion' => array(
            'nombre' => 'Documentación',
            'icono' => 'icon solid fa-video',
            'url' => '/web/documentacion/',
        ),
        'legal' => array(
            'nombre' => 'Legal',
            'icono' => 'icon solid fa-scale-unbalanced-flip',
            'url' => '/web/legal/',
        ),
        'test' => array(
            'nombre' => 'Test',
            'icono' => 'icon solid fa-vial',
            'url' => '/web/test/',
        ),
        'inspector-evidencia' => array(
            'nombre' => 'Evidencia Inspector',
            'icono' => 'icon solid fa-video',
            'url' => '/web/inspector-evidencia/',
        ),
        'mi-perfil' => array(
            'nombre' => 'Mi Perfil',
            'icono' => 'icon solid fa-user-cog',
            'url' => '/web/mi-perfil/',
        ),
    );

    public function __construct($verificar)
    {
        $this->verificar = $verificar;
        $this->modulos = $this->verificar->getModulos();
    }

    public function getMenu($name, $root)
    {
        $this->inner_html = ' <div id="sidebar">';
        $this->inner_html .= '<div class="inner">';
        $this->inner_html .= '<section id="logo">';
        $this->inner_html .= '<h1> <a href="' . $root . '"> ' . $name . ' </a></h1>';
        $this->inner_html .= '</section>';
        $this->inner_html .= '<nav id="menu">';
        $this->inner_html .= '<header class="major"><h2>MENÚ</h2> </header>';
        $this->inner_html .= '<ul>';

        foreach ($this->menuApp as $key => $value) {
            if (in_array($key, $this->verificar->getModulos())) {
                if (!isset($value['sub-menu'])) {
                    $this->inner_html .= '<li id="menu-' . $key . '">';
                    $this->inner_html .= '<a href="' . $value['url'] . '" class="' . $value['icono'] . '"> ' . htmlspecialchars($value['nombre']) . '</a>';
                    $this->inner_html .= '</li>';
                } else {
                    $this->inner_html .= '<li id="menu-' . $key . '">';
                    $this->inner_html .= '<span class="opener"> ' . $value['nombre'] . ' </span>';
                    $this->inner_html .= '<ul>';
                    foreach ((array) $value['sub-menu'] as $subkey => $subvalue) {
                        $this->inner_html .= '<li>';
                        $this->inner_html .= '<a href="' . $subvalue['url'] . '" class="' . $subvalue['icono'] . '"> ' . htmlspecialchars($subvalue['nombre']) . '</a>';
                        $this->inner_html .= '</li>';
                    }
                    $this->inner_html .= '</ul>';
                    $this->inner_html .= '</li>';
                }
            }
        }
        $this->inner_html .= '<li>';
        $this->inner_html .= '<a href="/web/cerrar/" class="icon solid fa-right-from-bracket">Cerrar sesión</a>';
        $this->inner_html .= '</li>';

        $this->inner_html .= '<li class="align-center">';
        $this->inner_html .= '<br>';
        $this->inner_html .= '<img src="/images/cda-small.png">';
        $this->inner_html .= '</li>';

        $this->inner_html .= '</ul>';
        $this->inner_html .= '</nav>';
        $this->inner_html .= '</div>';
        $this->inner_html .= '</div>';

        return $this->inner_html;
    }


    public function getMenuArray()
    {
        return $this->menuApp;
    }

    public function setModulo($array)
    {
        $this->current = array(
            'name' => htmlspecialchars($array['nombre']),
            'icon' => $array['icono']
        );
    }
}
