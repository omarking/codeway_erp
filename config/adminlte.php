<?php

use phpDocumentor\Reflection\PseudoTypes\True_;

return [

    /*
    |--------------------------------------------------------------------------
    | Title
    |--------------------------------------------------------------------------
    |
    | Here you can change the default title of your admin panel.
    |
    | For more detailed instructions you can look here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/#61-title
    |
    */

    /* Título */

    /* El título predeterminado */
    'title' => 'Codeway |',
    /* El prefijo del título -> Contenido del titulo del lado derecho */
    'title_prefix' => '',
    /* El sufijo del título -> Contenido del titulo del lado izquierdo */
    'title_postfix' => '',

    /*
    |--------------------------------------------------------------------------
    | Favicon
    |--------------------------------------------------------------------------
    |
    | Here you can activate the favicon.
    |
    | For more detailed instructions you can look here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/#62-favicon
    |
    */

    /* Favicon */

    /* Con la configuración anterior public/favicons/favicon.icose utilizará el archivo favicon.icon */
    'use_ico_only' => false,
    /* Con la configuración anterior, public/favicons/se utilizarán varios archivos de favicon ubicados en la carpeta */
    'use_full_favicon' => true,

    /*
    |--------------------------------------------------------------------------
    | Logo
    |--------------------------------------------------------------------------
    |
    | Here you can change the logo of your admin panel.
    |
    | For more detailed instructions you can look here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/#63-logo
    |
    */

    /* Logotipo */

    /* El contenido del logotipo de texto, puede usar HTML código */
    'logo' => '<b>Codeway</b>',
    /* La ruta a la imagen del logotipo pequeño. El tamaño recomendado es: 50x50px */
    'logo_img' => 'favicons/logo_img.png',
    /* Clases extra para la imagen del logo pequeño */
    'logo_img_class' => 'brand-image img-circle elevation-3',
    /* La ruta a la imagen del logotipo grande, si establece una URL de imagen aquí, reemplazará el texto y el logotipo pequeño con un logotipo grande. Cuando la barra lateral está contraída, solo mostrará el logotipo pequeño. El tamaño recomendado es: 210x33px */
    'logo_img_xl' => 'favicons/logo_img_xl-2.png',
    /* Clases extra para la imagen del logo grande */
    'logo_img_xl_class' => 'brand-image-xs',
    /* El texto alternativo para las imágenes del logotipo */
    'logo_img_alt' => 'Codeway',

    /*
    |--------------------------------------------------------------------------
    | User Menu
    |--------------------------------------------------------------------------
    |
    | Here you can activate and change the user menu.
    |
    | For more detailed instructions you can look here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/#64-user-menu
    |
    */

    /* Menú de usuario */

    /* Si habilitar el menú de usuario en lugar del botón de cierre de sesión predeterminado */
    'usermenu_enabled' => true,
    /* Ya sea para habilitar la sección de encabezado dentro del menú de usuario */
    'usermenu_header' => true,
    /* Clases adicionales para la sección de encabezado dentro del menú de usuario */
    'usermenu_header_class' => 'bg-dark elevation-3',
    /* Si habilitar la imagen de usuario para el menú de usuario y la pantalla de bloqueo => para esta función, deberá agregar una función adicional nombrada adminlte_image()dentro del Usermodelo */
    'usermenu_image' => true,
    /* Si habilitar la descripción de usuario para el menú de usuario => para esta función, deberá agregar una función adicional nombrada adminlte_desc()dentro del Usermodelo */
    'usermenu_desc' => true,
    /* Si habilitar si la URL del perfil de usuario se puede establecer dinámicamente para el usuario en lugar de usar la opción de configuración profile_url => para esta función, debe agregar una función adicional nombrada adminlte_profile_url()dentro del Usermodelo */
    'usermenu_profile_url' => true,

    /*
    |--------------------------------------------------------------------------
    | Layout
    |--------------------------------------------------------------------------
    |
    | Here we change the layout of your admin panel.
    |
    | For more detailed instructions you can look here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/#71-layout
    |
    */

    /* Disposición */

    /* Habilita / deshabilita el diseño de solo navegación superior, esto eliminará la barra lateral y colocará sus enlaces en la barra de navegación superior. No se puede usar con layout_boxed */
    'layout_topnav' => false,
    /* Habilita / deshabilita el diseño en caja que se extiende a lo ancho solo hasta 1250 px. No se puede usar con layout_topnav */
    'layout_boxed' => false,
    /* Activa / desactiva el modo de barra lateral fija. No se puede usar con layout_topnav */
    'layout_fixed_sidebar' => true,
    /* Habilita / deshabilita el modo fijo de la barra de navegación (navegación superior), aquí puede configurar trueo arraypara un uso receptivo. No se puede usar con layout_boxed */
    'layout_fixed_navbar' => true,
    /* Habilita / deshabilita el modo de pie de página fijo, aquí puede establecer trueo arraypara un uso receptivo. No se puede usar con layout_boxed */
    'layout_fixed_footer' => false,

    /*
    |--------------------------------------------------------------------------
    | Authentication Views Classes
    |--------------------------------------------------------------------------
    |
    | Here you can change the look and behavior of the authentication views.
    |
    | For more detailed instructions you can look here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/#721-authentication-views-classes
    |
    */

    /* Clases de vistas de autenticación */

    /* Clases extra para la caja de cartas. Las clases se agregarán al elemento div.card */
    'classes_auth_card' => '',
    /* Clases extra para el encabezado de la caja de tarjetas. Las clases se agregarán al elemento div.card-header */
    'classes_auth_header' => 'bg-gradient-info',
    /* Clases extra para el cuerpo de la caja de tarjetas. Las clases se agregarán al elemento div.card-body */
    'classes_auth_body' => '',
    /* Clases extra para el pie de página de la caja de cartas. Las clases se agregarán al elemento div.card-footer */
    'classes_auth_footer' => 'text-center',
    /* Clases adicionales para los íconos de entrada (íconos impresionantes de fuentes relacionados con los campos de entrada) */
    'classes_auth_icon' => 'fa-lg text-info',
    /* Clases adicionales para los botones de envío */
    'classes_auth_btn' => 'btn-flat btn-primary',

    /*
    |--------------------------------------------------------------------------
    | Admin Panel Classes
    |--------------------------------------------------------------------------
    |
    | Here you can change the look and behavior of the admin panel.
    |
    | For more detailed instructions you can look here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/#722-admin-panel-classes
    |
    */

    /* Clases del panel de administración */

    /* Clases extra para el cuerpo */
    'classes_body' => '',
    /* Clases extra para la marca. Las clases se agregarán al elemento a.navbar-brandsi layout_topnavse usa, de lo contrario, se agregarán al elemento a.brand-link */
    'classes_brand' => 'bg-white',
    /* Clases extra para el texto de la marca. Las clases se agregarán al elemento span.brand-text */
    'classes_brand_text' => '',
    /* Clases para contenedor contenedor de contenido. Las clases se agregarán al contenedor del elemento div.content-wrapper */
    'classes_content_wrapper' => '',
    /* Clases para el contenedor de encabezado de contenido. Las clases se agregarán al contenedor del elemento div.content-header. Si lo dejó vacío, se containerusará una clase predeterminada cuando layout_topnavse use; de ​​lo contrario container-fluid, se usará como predeterminada */
    'classes_content_header' => '',
    /* Clases para el contenedor de contenido. Las clases se agregarán al contenedor del elemento div.content. Si lo dejó vacío, se containerusará una clase predeterminada cuando layout_topnavse use; de ​​lo contrario container-fluid, se usará como predeterminada */
    'classes_content' => '',
    /* Clases adicionales para la barra lateral. Las clases se agregarán al elemento aside.main-sidebar <sidebar-dark-<color> || <sidebar-light-<color> */
    'classes_sidebar' => 'sidebar-dark-primary elevation-4',
    /* Clases adicionales para la navegación de la barra lateral. Las clases se agregarán al elemento ul.nav.nav-pills.nav-sidebar */
    /*  nav-child-indent -> para sangrar los elementos secundarios.
        nav-compact -> para obtener un estilo de navegación compacto.
        nav-flat -> para obtener un estilo de navegación plano.
        nav-legacy -> para obtener un estilo de navegación v2 heredado */
    'classes_sidebar_nav' => 'nav-legacy nav-child-indent',
    /* Clases adicionales para la barra de navegación superior. Las clases se agregarán al elemento nav.main-header.navbar  <navbar-<color> */
    'classes_topnav' => 'navbar-dark navbar-dark',
    /* Clases extra para la navegación superior. Las clases se agregarán al elemento nav.main-header.navbar. Cuando se habilita, layout_topnavla recomendación es usar navbar-expand-mdpara que los elementos se contraigan automáticamente en un botón de menú en tamaños de pantalla bajos. De lo contrario, quédese con la navbar-expandclase */
    'classes_topnav_nav' => 'navbar-expand',
    /* Clases adicionales para el contenedor de la barra de navegación superior. Las clases se agregarán al divelemento contenedor interno nav.main-header.navbar */
    'classes_topnav_container' => 'container',

    /*
    |--------------------------------------------------------------------------
    | Sidebar
    |--------------------------------------------------------------------------
    |
    | Here we can modify the sidebar of the admin panel.
    |
    | For more detailed instructions you can look here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/#73-sidebar
    |
    */

    /* Barra lateral (izquierda)*/

    /* Habilita / deshabilita la mini barra lateral contraída para el escritorio y pantallas más grandes (> = 992px), puede configurar esta opción en true, falseo 'md'habilitarla para tabletas pequeñas y pantallas más grandes (> = 768px). */
    'sidebar_mini' => true,
    /* Activa / desactiva el modo contraído de forma predeterminada */
    'sidebar_collapse' => false,
    /* Habilita / deshabilita el colapso automático estableciendo un ancho mínimo para colapsar automáticamente */
    'sidebar_collapse_auto_size' => false,
    /* Habilita / deshabilita el script para recordar contraer */
    'sidebar_collapse_remember' => true,
    /* Habilita / deshabilita la transición después de volver a cargar la página */
    'sidebar_collapse_remember_no_transition' => true,
    /* Cambia el tema de la barra de desplazamiento de la barra lateral */
    'sidebar_scrollbar_theme' => 'os-theme-light',
    /* Cambia el activador de ocultación automática de la barra de desplazamiento de la barra lateral */
    'sidebar_scrollbar_auto_hide' => '1',
    /* Activa / desactiva la función de acordeón de navegación de la barra lateral */
    'sidebar_nav_accordion' => true,
    /* Cambia la velocidad de animación de la diapositiva de la barra lateral */
    'sidebar_nav_animation_speed' => 500,

    /*
    |--------------------------------------------------------------------------
    | Control Sidebar (Right Sidebar)
    |--------------------------------------------------------------------------
    |
    | Here we can modify the right sidebar aka control sidebar of the admin panel.
    |
    | For more detailed instructions you can look here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/#74-control-sidebar-right-sidebar
    |
    */

    /* Barra lateral de control (barra lateral derecha) */

    /* Activa / desactiva la barra lateral derecha */
    'right_sidebar' => true,
    /* Cambia el icono del botón alternador de la barra lateral derecha en la navegación superior */
    'right_sidebar_icon' => 'fas fa-cogs',
    /* Cambia el tema de la barra lateral derecha, las siguientes opciones están disponibles: dark & light */
    'right_sidebar_theme' => 'dark',
    /* Activa / desactiva la animación de diapositivas */
    'right_sidebar_slide' => true,
    /* Habilita / deshabilita la inserción de contenido en lugar de superposición para la barra lateral derecha */
    'right_sidebar_push' => true,
    /* Cambia el tema de la barra de desplazamiento de la barra lateral. El valor predeterminado es os-theme-light */
    'right_sidebar_scrollbar_theme' => 'os-theme-dark',
    /* Cambia el activador de ocultación automática de la barra de desplazamiento de la barra lateral. El valor predeterminado es l */
    'right_sidebar_scrollbar_auto_hide' => '1',

    /*
    |--------------------------------------------------------------------------
    | URLs
    |--------------------------------------------------------------------------
    |
    | Here we can modify the url settings of the admin panel.
    |
    | For more detailed instructions you can look here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/#65-urls
    |
    */

    /* Ya sea para usar route() en lugar del método url() para generar las URL */
    'use_route_url' => false,
    /* Cambia la URL del panel / logotipo. Esta URL se utilizará, por ejemplo, cuando haga clic en el logotipo superior izquierdo */
    'dashboard_url' => 'home',
    /* Cambia la URL del botón de cierre de sesión. Esta URL se utilizará cuando haga clic en el botón Cerrar sesión */
    'logout_url' => 'logout',
    /* Cambia la URL de inicio de sesión. Esta URL se utilizará cuando haga clic en el botón de inicio de sesión */
    'login_url' => 'login',
    /* Cambia la URL de registro. Configure esta opción para falseocultar el enlace de registro que se muestra en la vista de inicio de sesión */
    'register_url' => false,
    /* Cambia la URL de restablecimiento de contraseña. Esta URL debe apuntar a la vista que muestra el formulario de restablecimiento de contraseña. Configure esta opción para falseocultar el enlace de restablecimiento de contraseña que se muestra en la vista de inicio de sesión */
    'password_reset_url' => 'password/reset',
    /* Cambia la URL de correo electrónico de la contraseña. Esta URL debe apuntar a la vista que muestra el formulario de enlace de restablecimiento de envío */
    'password_email_url' => 'password/email',
    /* Cambia la URL del perfil de usuario. Cuando no false, mostrará un botón en el menú de usuario */
    'profile_url' => false,

    /*
    |--------------------------------------------------------------------------
    | Laravel Mix
    |--------------------------------------------------------------------------
    |
    | Here we can enable the Laravel Mix option for the admin panel.
    |
    | For more detailed instructions you can look here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/#92-laravel-mix
    |
    */

    'enabled_laravel_mix' => false,
    'laravel_mix_css_path' => 'css/app.css',
    'laravel_mix_js_path' => 'js/app.js',

    /*
    |--------------------------------------------------------------------------
    | Menu Items
    |--------------------------------------------------------------------------
    |
    | Here we can modify the sidebar/top navigation of the admin panel.
    |
    | For more detailed instructions you can look here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/#8-menu-configuration
    |
    */

    /* Menu */
    /*
    Permite manejar las rutas del sidebar, así como controlar todo lo que implica
    Creamos un arreglo con los datos que nos permitiran manejar dicha ruta
    [
        - Texto que representa el nombre del artículo
        'text' => 'Nombre',
        - Una ruta de URL, generalmente utilizada en elementos de enlace
        'url' => 'User/profile',
        - Un nombre de ruta, generalmente utilizado en elementos de enlace
        'route' => '/profile',
        - Definir cuándo el artículo debe tener el estilo activo
        'active' => [ 'páginas' , 'contenido' , 'contenido *' , 'regex: @ ^ contenido / [0-9] + $ @ ' ],
        - Permisos del elemento para su uso con Laravel's Gate
        'can' => 'user.view',
        - Para agregar clases personalizadas a un elemento del menú
        'classes' => 'text-yellow text-bold text-center',
        - Un ícono de fuente impresionante para el artículo
        'icon' => 'fas fa-fw fa-exclamation-triangle',
        - Un color de AdminLTE para la insignia (información, primario, etc.)
        'icon_color' => 'primario' ,
        - Una clave de identificación única para hacer referencia al artículo
        'key' => '1',
        - Texto de una insignia asociada con el artículo
        'label' => 4,
        - Un color de AdminLTE para la insignia (información, primario, etc.)
        'label_color' => 'éxito ' ,
        - Valor para colocar el elemento en la barra de navegación superior
        'topnav' => true,
        - Valor para colocar el elemento en la sección derecha de la barra de navegación superior
        'topnav_right' => true,
        - Valor para colocar el elemento en el menú de usuario
        'topnav_user' => true,
        - Matriz con data-*atributos para el artículo
        'data' => [
            'test-one' => 'content-one' ,
            'test-two' => 'contenido-dos' ,
        ],
        - Texto que representa el nombre de un encabezado (solo para encabezados)
        'header'   => 'INFORMES' ,
        - Matriz con elementos secundarios que habilita menús anidados
        'submenu' => [
            [ 'text' => 'child 1' ,
                'url'   => 'menu / niño1 ' ,
            ],
            [ ' texto ' => ' niño 2 ' ,
                ' url '   => ' menú / niño2 ' ,
            ],
        ],
    ]

    */
    'menu' => [
        [
            /* Caja de busqueda en el navbar */
            'text' => 'Buscar',
            'search' => true,
            'topnav' => true,
        ],
        [
            /* Caja de busqueda en el sidebar */
            'search' => true,
            'url' => 'test',                     // the form action
            'method' => 'POST',                  // the form method
            'input_name' => 'menu-search-input', // the input name
            'text' => 'Buscar',                  // the input placeholder
        ],
        /* Links en el navbar del lado izquierdo */
        /*
        [
            'text' => 'Home',
            'url'  => '#',
            'can'  => '',
            'topnav' => false,
        ],
        [
             'text' => 'Explore',
            'url'  => '#',
            'can'  => '',
            'topnav' => false,
        ],
    */
        /* Links en el navbar del lado derecho */
        /*
        [
            'text' => 'Contact',
            'url'  => '#',
            'can'  => '',
            'topnav_right' => false,
        ],
        [
            'text' => 'Info',
            'url'  => '#',
            'can'  => '',
            'topnav_right' => false,
        ],
    */
        /* Links en el menu del usuario */
        /*
        [
            'text' => 'Acount',
            'url'  => '#',
            'can'  => '',
            'topnav_user' => true,
        ],
        [
            'text' => 'Info',
            'url'  => '#',
            'can'  => '',
            'topnav_user' => true,
        ],
    */
        /* Configuraciones con diferentes tipos de etiquetas */
        /*
        [
            'text' => 'Config',
            'url'  => '#',
            'can'  => '',
            'label'       => 10,
            'label_color' => 'info',
        ],
        [
            'text' => 'Files',
            'url'  => '#',
            'can'  => '',
            'label'       => 2,
            'label_color' => 'danger',
        ],
        [
            'text'        => 'pages',
            'url'         => '#',
            'icon'        => 'far fa-fw fa-file',
            'label'       => 4,
            'label_color' => 'success',
        ],
    */
        /* Inicia ASIDE */
        [
            'text' => 'Principal',
            'url'  => 'home',
            'can'  => '',
            'icon' => 'fas fa-fw fa-home'
        ],
        /* ['header' => 'TAREAS'], */
        [
            'text'    => 'Tareas',
            'icon'    => 'fas fa-fw fa-tasks',
            'submenu' => [
                [
                    'text'  => 'Tareas',
                    'url'   => 'task',
                    'icon'  => 'fas fa-fw fa-tasks',
                ],
                [
                    'text'  => 'Tipos',
                    'url'   => 'type',
                    'icon'  => 'fas fa-fw fa-crop-alt',
                ],
                [
                    'text'  => 'Prioridades',
                    'url'   => 'priority',
                    'icon'  => 'fas fa-fw fa-list-ol',/* stream */
                ],
                [
                    'text'  => 'Estados',
                    'url'   => 'status',
                    'icon'  => 'fas fa-fw fa-spinner',
                ],
            ],
        ],
        /* ['header' => 'PROYECTOS'], */
        [
            'text'    => 'Proyectos',
            'icon'    => 'fas fa-fw fa-project-diagram',
            'submenu' => [
                [
                    'text'  => 'Proyectos',
                    'url'   => 'project',
                    'icon'  => 'fas fa-fw fa-project-diagram',
                ],
                [
                    'text'  => 'Categorias',
                    'url'   => 'category',
                    'icon'  => 'fas fa-fw fa-boxes',
                ],
                [
                    'text'  => 'Clases',
                    'url'   => 'class',
                    'icon'  => 'fas fa-fw fa-layer-group',/*folder-tree layer-group bring-forward*/
                ],
            ],
        ],
        /* ['header' => 'VACACIONES'], */
        [
            'text'    => 'Vacaciones',
            'icon'    => 'fas fa-fw fa-plane-departure',
            'submenu' => [
                [
                    'text'  => 'Vacaciones',
                    'url'   => 'holiday',
                    'icon'  => 'fas fa-fw fa-plane-departure',
                ],
                [
                    'text'  => 'Periodos',
                    'url'   => 'period',
                    'icon'  => 'fas fa-fw fa-thumbtack',
                ],
                [
                    'text'  => 'Ausencias',
                    'url'   => 'absence',
                    'icon'  => 'fas fa-fw fa-user-slash',/* user-times */
                ],
            ],
        ],
        /* ['header' => 'VACANTES'], */
        [
            'text'    => 'Vacantes',
            'icon'    => 'fas fa-fw fa-clipboard',
            'submenu' => [
                [
                    'text'  => 'Vacantes',
                    'url'   => 'vacant',
                    'icon'  => 'fas fa-fw fa-clipboard',/* sticky-note */
                ],
                [
                    'text'  => 'Asirantes',
                    'url'   => 'preuser',
                    'icon'  => 'fas fa-fw fa-portrait',/* user-check user-plus */
                ],
            ],
        ],
        /* ['header' => 'USUARIOS'], */
        [
            'text' => 'Usuarios',
            'url'  => 'user',
            'icon' => 'fas fa-fw fa-users',
        ],
        [
            'text'  => 'Eventos',
            'url'   => 'event',
            'icon'  => 'fas fa-fw fa-calendar-check',/* calendar-check */
        ],
        [
            'text'  => 'Posiciones',
            'url'   => 'position',
            'icon'  => 'fas fa-fw fa-address-card',/* user-chart */
        ],
        [
            'text'    => 'Departamentos',
            'icon'    => 'fas fa-fw fa-building',
            'submenu' => [
                [
                    'text'  => 'Departamentos',
                    'url'   => 'departament',
                    'icon'  => 'fas fa-fw fa-building',
                ],
                [
                    'text'  => 'Grupos',
                    'url'   => 'group',
                    'icon'  => 'fas fa-fw fa-user-friends',
                ],
            ],
        ],
        [
            'text'    => 'Roles',
            'icon'    => 'fas fa-fw fa-user-tag',
            'submenu' => [
                [
                    'text' => 'Roles',
                    'url'  => 'role',
                    'icon' => 'fas fa-fw fa-user-tag',/* user-shield */
                ],
                [
                    'text' => 'Permisos',
                    'url'  => 'permission',
                    'icon' => 'fas fa-fw fa-user-lock',
                ],
            ],
        ],
        ['header' => 'AJUSTES DE LA CUENTA'],
        [
            'text'    => 'Configurar Perfil',
            'url'     => 'profile',
            'icon'    => 'fas fa-fw fa-user-tie',
        ],
        ['header' => 'labels'],
        [
            'text'       => 'important',
            'icon_color' => 'red',
            'url'        => '#',
        ],
        [
            'text'       => 'warning',
            'icon_color' => 'yellow',
            'url'        => '#',
        ],
        [
            'text'       => 'information',
            'icon_color' => 'cyan',
            'url'        => '#',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Menu Filters
    |--------------------------------------------------------------------------
    |
    | Here we can modify the menu filters of the admin panel.
    |
    | For more detailed instructions you can look here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/#83-custom-menu-filters
    |
    */

    'filters' => [
        JeroenNoten\LaravelAdminLte\Menu\Filters\GateFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\HrefFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\SearchFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ActiveFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ClassesFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\LangFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\DataFilter::class,
    ],

    /*
    |--------------------------------------------------------------------------
    | Plugins Initialization
    |--------------------------------------------------------------------------
    |
    | Here we can modify the plugins used inside the admin panel.
    |
    | For more detailed instructions you can look here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/#91-plugins
    |
    */

    'plugins' => [
        'Datatables' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js',
                ],
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js',
                ],
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '//cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css',
                ],
            ],
        ],
        'Select2' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js',
                ],
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.css',
                ],
            ],
        ],
        'Chartjs' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.0/Chart.bundle.min.js',
                ],
            ],
        ],
        'Sweetalert2' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdn.jsdelivr.net/npm/sweetalert2@8',
                ],
            ],
        ],
        'Pace' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/themes/blue/pace-theme-center-radar.min.css',
                ],
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/pace.min.js',
                ],
            ],
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Livewire
    |--------------------------------------------------------------------------
    |
    | Here we can enable the Livewire support.
    |
    | For more detailed instructions you can look here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/#93-livewire
    */

    'livewire' => true,
];
