<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Title
    |--------------------------------------------------------------------------
    |
    | Here you can change the default title of your admin panel.
    |
    | For detailed instructions you can look the title section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'title' => 'Control Flota Vehicular',
    'title_prefix' => '',
    'title_postfix' => '',

    /*
    |--------------------------------------------------------------------------
    | Favicon
    |--------------------------------------------------------------------------
    |
    | Here you can activate the favicon.
    |
    | For detailed instructions you can look the favicon section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'use_ico_only' => false,
    'use_full_favicon' => false,

    /*
    |--------------------------------------------------------------------------
    | Google Fonts
    |--------------------------------------------------------------------------
    |
    | Here you can allow or not the use of external google fonts. Disabling the
    | google fonts may be useful if your admin panel internet access is
    | restricted somehow.
    |
    | For detailed instructions you can look the google fonts section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'google_fonts' => [
        'allowed' => true,
    ],

    /*
    |--------------------------------------------------------------------------
    | Admin Panel Logo
    |--------------------------------------------------------------------------
    |
    | Here you can change the logo of your admin panel.
    |
    | For detailed instructions you can look the logo section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'logo' => '<b>Control Flota Vehicular</b>',
    'logo_img' => '',
    'logo_img_class' => '',
    'logo_img_xl' => null,
    'logo_img_xl_class' => '',
    'logo_img_alt' => '',

    /*
    |--------------------------------------------------------------------------
    | Authentication Logo
    |--------------------------------------------------------------------------
    |
    | Here you can setup an alternative logo to use on your login and register
    | screens. When disabled, the admin panel logo will be used instead.
    |
    | For detailed instructions you can look the auth logo section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'auth_logo' => [
        'enabled' => false,
        'img' => [
            'path' => 'vendor/adminlte/dist/img/AdminLTELogo.png',
            'alt' => 'Auth Logo',
            'class' => '',
            'width' => 50,
            'height' => 50,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Preloader Animation
    |--------------------------------------------------------------------------
    |
    | Here you can change the preloader animation configuration.
    |
    | For detailed instructions you can look the preloader section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'preloader' => [
        'enabled' => true,
        'img' => [
            'path' => 'vendor/adminlte/dist/img/AdminLTELogo.png',
            'alt' => 'AdminLTE Preloader Image',
            'effect' => 'animation__shake',
            'width' => 60,
            'height' => 60,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | User Menu
    |--------------------------------------------------------------------------
    |
    | Here you can activate and change the user menu.
    |
    | For detailed instructions you can look the user menu section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'usermenu_enabled' => true,
    'usermenu_header' => false,
    'usermenu_header_class' => 'bg-primary',
    'usermenu_image' => false,
    'usermenu_desc' => false,
    'usermenu_profile_url' => false,

    /*
    |--------------------------------------------------------------------------
    | Layout
    |--------------------------------------------------------------------------
    |
    | Here we change the layout of your admin panel.
    |
    | For detailed instructions you can look the layout section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'layout_topnav' => null,
    'layout_boxed' => null,
    'layout_fixed_sidebar' => null,
    'layout_fixed_navbar' => null,
    'layout_fixed_footer' => null,
    'layout_dark_mode' => null,

    /*
    |--------------------------------------------------------------------------
    | Authentication Views Classes
    |--------------------------------------------------------------------------
    |
    | Here you can change the look and behavior of the authentication views.
    |
    | For detailed instructions you can look the auth classes section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'classes_auth_card' => 'card-outline card-primary',
    'classes_auth_header' => '',
    'classes_auth_body' => '',
    'classes_auth_footer' => '',
    'classes_auth_icon' => '',
    'classes_auth_btn' => 'btn-flat btn-primary',

    /*
    |--------------------------------------------------------------------------
    | Admin Panel Classes
    |--------------------------------------------------------------------------
    |
    | Here you can change the look and behavior of the admin panel.
    |
    | For detailed instructions you can look the admin panel classes here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'classes_body' => '',
    'classes_brand' => '',
    'classes_brand_text' => '',
    'classes_content_wrapper' => '',
    'classes_content_header' => '',
    'classes_content' => '',
    'classes_sidebar' => 'sidebar-dark-primary elevation-4',
    'classes_sidebar_nav' => '',
    'classes_topnav' => 'navbar-white navbar-light',
    'classes_topnav_nav' => 'navbar-expand',
    'classes_topnav_container' => 'container',

    /*
    |--------------------------------------------------------------------------
    | Sidebar
    |--------------------------------------------------------------------------
    |
    | Here we can modify the sidebar of the admin panel.
    |
    | For detailed instructions you can look the sidebar section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'sidebar_mini' => 'lg',
    'sidebar_collapse' => false,
    'sidebar_collapse_auto_size' => false,
    'sidebar_collapse_remember' => false,
    'sidebar_collapse_remember_no_transition' => true,
    'sidebar_scrollbar_theme' => 'os-theme-light',
    'sidebar_scrollbar_auto_hide' => 'l',
    'sidebar_nav_accordion' => true,
    'sidebar_nav_animation_speed' => 300,

    /*
    |--------------------------------------------------------------------------
    | Control Sidebar (Right Sidebar)
    |--------------------------------------------------------------------------
    |
    | Here we can modify the right sidebar aka control sidebar of the admin panel.
    |
    | For detailed instructions you can look the right sidebar section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'right_sidebar' => false,
    'right_sidebar_icon' => 'fas fa-cogs',
    'right_sidebar_theme' => 'dark',
    'right_sidebar_slide' => true,
    'right_sidebar_push' => true,
    'right_sidebar_scrollbar_theme' => 'os-theme-light',
    'right_sidebar_scrollbar_auto_hide' => 'l',

    /*
    |--------------------------------------------------------------------------
    | URLs
    |--------------------------------------------------------------------------
    |
    | Here we can modify the url settings of the admin panel.
    |
    | For detailed instructions you can look the urls section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'use_route_url' => false,
    'dashboard_url' => 'home',
    'logout_url' => 'logout',
    'login_url' => 'login',
    'register_url' => 'register',
    'password_reset_url' => 'password/reset',
    'password_email_url' => 'password/email',
    'profile_url' => false,

    /*
    |--------------------------------------------------------------------------
    | Laravel Mix
    |--------------------------------------------------------------------------
    |
    | Here we can enable the Laravel Mix option for the admin panel.
    |
    | For detailed instructions you can look the laravel mix section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Other-Configuration
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
    | For detailed instructions you can look here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Menu-Configuration
    |
    */

    'menu' => [
        // Navbar items:
        /*[
            'type'         => 'navbar-search',
            'text'         => 'search',
            'topnav_right' => true,
        ],
        [
            'type'         => 'fullscreen-widget',
            'topnav_right' => true,
        ],

        // Sidebar items:
        [
            'type' => 'sidebar-menu-search',
            'text' => 'search',
        ],
        [
            'text' => 'blog',
            'url'  => 'admin/blog',
            'can'  => 'manage-blog',
        ],
        [
            'text'        => 'pages',
            'url'         => 'admin/pages',
            'icon'        => 'far fa-fw fa-file',
            'label'       => 4,
            'label_color' => 'success',
        ],
        ['header' => 'account_settings'],
        [
            'text' => 'profile',
            'url'  => 'admin/settings',
            'icon' => 'fas fa-fw fa-user',
        ],
        [
            'text' => 'change_password',
            'url'  => 'admin/settings',
            'icon' => 'fas fa-fw fa-lock',
        ],
        [
            'text'    => 'multilevel',
            'icon'    => 'fas fa-fw fa-share',
            'submenu' => [
                [
                    'text' => 'level_one',
                    'url'  => '#',
                ],
                [
                    'text'    => 'level_one',
                    'url'     => '#',
                    'submenu' => [
                        [
                            'text' => 'level_two',
                            'url'  => '#',
                        ],
                        [
                            'text'    => 'level_two',
                            'url'     => '#',
                            'submenu' => [
                                [
                                    'text' => 'level_three',
                                    'url'  => '#',
                                ],
                                [
                                    'text' => 'level_three',
                                    'url'  => '#',
                                ],
                            ],
                        ],
                    ],
                ],
                [
                    'text' => 'level_one',
                    'url'  => '#',
                ],
            ],
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
        ],*/

        // AQUI vamos empezar aramar el MENU
        [
            'text'       => 'Administracion',
            'icon' => 'fas fa-copy',
            'submenu'        =>[

               [
                'text'=> 'Registros',
                'icon'=> 'fas fa-map-pin',
                'submenu' => [
                [ 'text' => 'provincia',
                'icon'=> 'fas fa-map-pin',
                  'url'=> '/provincias'
                ],
                [ 'text' => 'Distritos',
                'icon'=> 'fas fa-map-pin',
                  'url'=> '/distritos'
                ],
                [ 'text' => 'Parroquias',
                'icon'=> 'fas fa-map-pin',
                  'url'=> '/parroquias'
                ],
                [ 'text' => 'Circuitos',
                'icon'=> 'fas fa-map-pin',
                  'url'=> '/circuitos'
                ],
                [ 'text' => 'subcircuitos',
                'icon'=> 'fas fa-map-pin',
                  'url'=> '/subcircuitos'
                ],
            ],
            ],
                [
                    'text'    => 'Dependencia',
                    'icon'=> 'fas fa-map',
                    'submenu' => [
                        [
                            'text' => 'Registro Dependencia',
                            'icon'=> 'fas fa-map',
                            'url'  => 'registro_dependencia',
                        ],
                          [
                            'text' => 'Listado Dependencia ',
                            'icon'=> 'fas fa-map',
                            'url'  => 'listado_dependencias',
                        ],

                    ],
                ],

                [
                    'text' => 'Personal',
                    'icon'=>'fas fa-users',
                    'url'=> '#',
                    'submenu'=>[
                        [
                            'text' => 'Registro Personal',
                            'icon'=>'fas fa-user',
                            'url'  => 'personals',
                        ],
                        [
                            'text' => 'Listado Personal',
                            'icon'=>'fas fa-list',
                            'url'  => 'list_personals',
                        ],


                    ],
                ],

                [
                    'text' => 'Flota Vehicular',
                    'icon'=>'fas fa-car',
                    'url'=> '#',
                    'submenu'=>[
                        [
                            'text' => 'Registro Vehículo',
                            'icon'=>'fas fa-car',
                            'url'  => 'vehiculos',
                        ],
                        [
                            'text' => 'Listado Vehículo',
                            'icon'=>'fas fa-list',
                            'url'  => 'list_vehiculos',
                        ],
                    ],
                ],


            ],

        ],


        [
            'text'       => 'Gestión de Asignación y Vinculación',
            'icon' => 'fas fa-tasks',
            'submenu'        =>[
                [ 'text' => 'Asignar Personal a Subcircuito',
                'icon'=> 'fas fa-user',
                  'url'=> '/asignar_peronal_subcircuitos'
                ],
                [ 'text' => 'Asignar Vehículo a Subcircuito',
                'icon'=> 'fas fa-car',
                  'url'=> '/asignar_vehiculo_subcircuitos'
                ],
                [ 'text' => 'Asignar Vehículo a Personal',
                  'icon'=> 'fas fa-user-plus',
                  'url'=> '/asignar_peronal_vehiculos'
                ],
            ],

        ],

            [
            'text'       => 'Mantenimiento Preventivo',
            'icon' => 'fas  fa-wrench',
            'submenu'        =>[
                [ 'text' => 'Registrar Solicitud',
                'icon' => 'fas  fa-wrench',
                  'url'=> '/solicituds'
                ],
                [ 'text' => 'Recepción y Registro de Mantenimiento',
                'icon' => 'fas  fa-wrench',
                  'url'=> '/recepreg'
                ],
                [ 'text' => 'Listado Mantenimiento Preventivo',
                'icon' => 'fas  fa-wrench',
                  'url'=> '/list_mps'
                ],

            ],

        ],



        [
            'text'       => 'Eventos',
            'icon' => 'fas fa-copy',
            'submenu'        =>[
                [ 'text' => 'Lista de Eventos',
                  'url'=> '/events'
                ],
                [ 'text' => 'Registro de Eventos',
                  'url'=> '/events-create'
                ],


            ],

        ],
       [
            'text'=> 'Examen',
            'submenu'=>[
            [
            'text' => 'Registrar Armamento',
            'url' => '/rastrillo',],
            ['text'=>'Listado Rastrillo',
            'url'=>'/list_rastrillo',
            ],
            [
                'text'=>'Asignar Pertrechos a Personal',
                'url'=>'/asignar_armamento_personal',
            ],
        ],

    ],
    [
    'text'=> 'Generar Orden Combustible',
            'submenu'=>[
            [
            'text' => 'Orden Combustible',
            'url' => '/orden',],

            [
                'text'=>'Lista de Ordenes Combustible',
                'url'=>'/asignar_armamento_personal',
            ],
        ],
    ],
],

    /*
    |--------------------------------------------------------------------------
    | Menu Filters
    |--------------------------------------------------------------------------
    |
    | Here we can modify the menu filters of the admin panel.
    |
    | For detailed instructions you can look the menu filters section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Menu-Configuration
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
    | For detailed instructions you can look the plugins section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Plugins-Configuration
    |
    */

    'plugins' => [
            'KrajeeFileinput' => [
        'active' => false,
        'files' => [
            [
                'type' => 'css',
                'asset' => true,
                'location' => 'vendor/krajee-fileinput/css/fileinput.min.css',
            ],
            [
                'type' => 'css',
                'asset' => true,
                'location' => 'vendor/krajee-fileinput/themes/explorer-fa5/theme.min.css',
            ],
            [
                'type' => 'js',
                'asset' => true,
                'location' => 'vendor/krajee-fileinput/js/fileinput.min.js',
            ],
            [
                'type' => 'js',
                'asset' => true,
                'location' => 'vendor/krajee-fileinput/themes/fa5/theme.min.js',
            ],
            [
                'type' => 'js',
                'asset' => true,
                'location' => 'vendor/krajee-fileinput/themes/explorer-fa5/theme.min.js',
            ],
            [
                'type' => 'js',
                'asset' => true,
                'location' => 'vendor/krajee-fileinput/js/locales/es.js',
            ],
        ],
    ],

         'TempusDominusBs4' => [
        'active' => true,
        'files' => [
            [
                'type' => 'js',
                'asset' => true,
                'location' => 'vendor/moment/moment.min.js',
            ],
            [
                'type' => 'js',
                'asset' => true,
                'location' => 'vendor/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js',
            ],
            [
                'type' => 'css',
                'asset' => true,
                'location' => 'vendor/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css',
            ],
        ],
        ],
        'Datatables' => [
            'active' => true,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => '//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js',
                ],
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => '//cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js',
                ],
                [
                    'type' => 'css',
                    'asset' => true,
                    'location' => '//cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css',
                ],
            ],
        ],

        'DatatablesPlugins' => [
    'active' => true,
    'files' => [
        [
            'type' => 'js',
            'asset' => true,
            'location' => 'vendor/datatables-plugins/buttons/js/dataTables.buttons.min.js',
        ],
        [
            'type' => 'js',
            'asset' => true,
            'location' => 'vendor/datatables-plugins/buttons/js/buttons.bootstrap4.min.js',
        ],
        [
            'type' => 'js',
            'asset' => true,
            'location' => 'vendor/datatables-plugins/buttons/js/buttons.html5.min.js',
        ],
        [
            'type' => 'js',
            'asset' => true,
            'location' => 'vendor/datatables-plugins/buttons/js/buttons.print.min.js',
        ],
        [
            'type' => 'js',
            'asset' => true,
            'location' => 'vendor/datatables-plugins/jszip/jszip.min.js',
        ],
        [
            'type' => 'js',
            'asset' => true,
            'location' => 'vendor/datatables-plugins/pdfmake/pdfmake.min.js',
        ],
        [
            'type' => 'js',
            'asset' => true,
            'location' => 'vendor/datatables-plugins/pdfmake/vfs_fonts.js',
        ],
        [
            'type' => 'css',
            'asset' => true,
            'location' => 'vendor/datatables-plugins/buttons/css/buttons.bootstrap4.min.css',
        ],
    ],
],
        'Select2' => [
            'active' => true,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js',
                ],
                [
                    'type' => 'css',
                    'asset' => true,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.css',
                ],
                  [
                    'type' => 'css',
                    'asset' => true,
                    'location' => 'vendor/select2-bootstrap4-theme/dist/select2-bootstrap4.min.css',
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
    | IFrame
    |--------------------------------------------------------------------------
    |
    | Here we change the IFrame mode configuration. Note these changes will
    | only apply to the view that extends and enable the IFrame mode.
    |
    | For detailed instructions you can look the iframe mode section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/IFrame-Mode-Configuration
    |
    */

    'iframe' => [
        'default_tab' => [
            'url' => null,
            'title' => null,
        ],
        'buttons' => [
            'close' => true,
            'close_all' => true,
            'close_all_other' => true,
            'scroll_left' => true,
            'scroll_right' => true,
            'fullscreen' => true,
        ],
        'options' => [
            'loading_screen' => 1000,
            'auto_show_new_tab' => true,
            'use_navbar_items' => true,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Livewire
    |--------------------------------------------------------------------------
    |
    | Here we can enable the Livewire support.
    |
    | For detailed instructions you can look the livewire here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Other-Configuration
    |
    */

    'livewire' => false,
];
