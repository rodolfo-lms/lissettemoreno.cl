<?php

if (!class_exists('Corpix_Core')) {
    return;
}

if (!function_exists('tpc_get_redux_icons')) {
    function tpc_get_redux_icons()
    {
        return TPCAdminIcon()->get_icons_name(true);
    }

    add_filter('redux/font-icons', 'tpc_get_redux_icons');
}

//* This is theme option name where all the Redux data is stored.
$theme_slug = 'corpix_set';

/**
 * Set all the possible arguments for Redux
 * For full documentation on arguments, please refer to: https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments
 * */
$theme = wp_get_theme();

Redux::setArgs($theme_slug, [
    'opt_name' => $theme_slug, //* This is where your data is stored in the database and also becomes your global variable name.
    'display_name' => $theme->get('Name'), //* Name that appears at the top of your panel
    'display_version' => $theme->get('Version'), //* Version that appears at the top of your panel
    'menu_type' => 'menu', //* Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
    'allow_sub_menu' => true, //* Show the sections below the admin menu item or not
    'menu_title' => esc_html__('Theme Options', 'corpix'),
    'page_title' => esc_html__('Theme Options', 'corpix'),
    'google_api_key' => '', //* You will need to generate a Google API key to use this feature. Please visit: https://developers.google.com/fonts/docs/developer_api#Auth
    'google_update_weekly' => false, //* Set it you want google fonts to update weekly. A google_api_key value is required.
    'async_typography' => true, //* Must be defined to add google fonts to the typography module
    'admin_bar' => true, //* Show the panel pages on the admin bar
    'admin_bar_icon' => 'dashicons-admin-generic', //* Choose an icon for the admin bar menu
    'admin_bar_priority' => 50, //* Choose an priority for the admin bar menu
    'global_variable' => '', //* Set a different name for your global variable other than the opt_name
    'dev_mode' => false,
    'update_notice' => true, //* If dev_mode is enabled, will notify developer of updated versions available in the GitHub Repo
    'customizer' => true,
    'page_priority' => 3, //* Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
    'page_parent' => 'tpc-dashboard-panel', //* For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
    'page_permissions' => 'manage_options', //* Permissions needed to access the options panel.
    'menu_icon' => 'dashicons-admin-generic', //* Specify a custom URL to an icon
    'last_tab' => '', //* Force your panel to always open to a specific tab (by id)
    'page_icon' => 'icon-themes', //* Icon displayed in the admin panel next to your menu_title
    'page_slug' => 'tpc-theme-options-panel', //* Page slug used to denote the panel, will be based off page title then menu title then opt_name if not provided
    'save_defaults' => true, //* On load save the defaults to DB before user clicks save or not
    'default_show' => false, //* If true, shows the default value next to each field that is not the default value.
    'default_mark' => '', //* What to print by the field's title if the value shown is default. Suggested: *
    'show_import_export' => true, //* Shows the Import/Export panel when not used as a field.
    'transient_time' => 60 * MINUTE_IN_SECONDS, //* Show the time the page took to load, etc
    'output' => true, //* Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
    'output_tag' => true, //* FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
    'database' => '', //* possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
    'use_cdn' => true,
]);

Redux::setSection(
    $theme_slug,
    [
        'id' => 'general',
        'title' => esc_html__('General', 'corpix'),
        'icon' => 'el el-screen',
        'fields' => [
            [
                'id' => 'use_minified',
                'title' => esc_html__('Use minified css/js files', 'corpix'),
                'type' => 'switch',
                'desc' => esc_html__('Speed up your site load.', 'corpix'),
                'on' => esc_html__('Yes', 'corpix'),
                'off' => esc_html__('No', 'corpix'),
            ],
            [
                'id' => 'preloader-start',
                'title' => esc_html__('Preloader', 'corpix'),
                'type' => 'section',
                'indent' => true,
            ],
            [
                'id' => 'preloader',
                'title' => esc_html__('Preloader', 'corpix'),
                'type' => 'switch',
                'on' => esc_html__('Use', 'corpix'),
                'off' => esc_html__('Hide', 'corpix'),
                'default' => false,
            ],
            [
                'id' => 'preloader_background',
                'title' => esc_html__('Preloader Background', 'corpix'),
                'type' => 'color',
                'required' => ['preloader', '=', '1'],
                'transparent' => false,
                'default' => '#ffffff',
            ],
            [
                'id' => 'preloader_color',
                'title' => esc_html__('Preloader Color', 'corpix'),
                'type' => 'color',
                'required' => ['preloader', '=', '1'],
                'transparent' => false,
                'default' => '#ffa800',
            ],
            [
                'id' => 'preloader-end',
                'type' => 'section',
                'indent' => false,
            ],
            [
                'id' => 'search_settings',
                'type' => 'section',
                'title' => esc_html__('Search', 'corpix'),
                'indent' => true,
            ],
            [
                'id' => 'search_style',
                'title' => esc_html__('Choose search style', 'corpix'),
                'type' => 'button_set',
                'options' => [
                    'standard' => esc_html__('Standard', 'corpix'),
                    'alt' => esc_html__('Full Page Width', 'corpix'),
                ],
                'default' => 'standard',
            ],
            [
                'id' => 'search_settings-end',
                'type' => 'section',
                'indent' => false,
            ],
            [
                'id' => 'scroll_up_settings',
                'title' => esc_html__('Scroll Up Button', 'corpix'),
                'type' => 'section',
                'indent' => true,
            ],
            [
                'id' => 'scroll_up',
                'title' => esc_html__('Button', 'corpix'),
                'type' => 'switch',
                'on' => esc_html__('Use', 'corpix'),
                'off' => esc_html__('Disable', 'corpix'),
                'default' => true,
            ],
            [
                'id' => 'scroll_up_appearance',
                'title' => esc_html__('Appearance', 'corpix'),
                'type' => 'switch',
                'required' => ['scroll_up', '=', true],
                'on' => esc_html__('Text', 'corpix'),
                'off' => esc_html__('Icon', 'corpix'),
                'default' => false,
            ],
            [
                'id' => 'scroll_up_text',
                'title' => esc_html__('Button Text', 'corpix'),
                'type' => 'text',
                'required' => ['scroll_up_appearance', '=', true],
                'default' => esc_html__('Top', 'corpix'),
            ],
            [
                'id' => 'scroll_up_arrow_color',
                'title' => esc_html__('Text Color', 'corpix'),
                'type' => 'color',
                'required' => ['scroll_up', '=', true],
                'transparent' => false,
                'default' => '#ffffff',
            ],
            [
                'id' => 'scroll_up_bg_color',
                'title' => esc_html__('Background Color', 'corpix'),
                'type' => 'color',
                'required' => ['scroll_up', '=', true],
                'transparent' => false,
                'default' => '#ffa800',
            ],
            [
                'id' => 'scroll_up_settings-end',
                'type' => 'section',
                'indent' => false,
            ],
        ],
    ]
);

Redux::setSection(
    $theme_slug,
    [
        'id' => 'editors-option',
        'title' => esc_html__('Custom JS', 'corpix'),
        'subsection' => true,
        'fields' => [
            [
                'id' => 'custom_js',
                'title' => esc_html__('Custom JS', 'corpix'),
                'type' => 'ace_editor',
                'subtitle' => esc_html__('Paste your JS code here.', 'corpix'),
                'mode' => 'javascript',
                'theme' => 'chrome',
                'default' => ''
            ],
            [
                'id' => 'header_custom_js',
                'title' => esc_html__('Custom JS', 'corpix'),
                'type' => 'ace_editor',
                'subtitle' => esc_html__('Code to be added inside HEAD tag', 'corpix'),
                'mode' => 'html',
                'theme' => 'chrome',
                'default' => ''
            ],
        ],
    ]
);

Redux::setSection(
    $theme_slug,
    [
        'id' => 'header_section',
        'title' => esc_html__('Header', 'corpix'),
        'icon' => 'fas fa-window-maximize',
    ]
);

$header_builder_items = [
    'default' => [
        'html1' => ['title' => esc_html__('HTML 1', 'corpix'), 'settings' => true],
        'html2' => ['title' => esc_html__('HTML 2', 'corpix'), 'settings' => true],
        'html3' => ['title' => esc_html__('HTML 3', 'corpix'), 'settings' => true],
        'html4' => ['title' => esc_html__('HTML 4', 'corpix'), 'settings' => true],
        'html5' => ['title' => esc_html__('HTML 5', 'corpix'), 'settings' => true],
        'html6' => ['title' => esc_html__('HTML 6', 'corpix'), 'settings' => true],
        'html7' => ['title' => esc_html__('HTML 7', 'corpix'), 'settings' => true],
        'html8' => ['title' => esc_html__('HTML 8', 'corpix'), 'settings' => true],
        'delimiter1' => ['title' => esc_html__('|', 'corpix'), 'settings' => true],
        'delimiter2' => ['title' => esc_html__('|', 'corpix'), 'settings' => true],
        'delimiter3' => ['title' => esc_html__('|', 'corpix'), 'settings' => true],
        'delimiter4' => ['title' => esc_html__('|', 'corpix'), 'settings' => true],
        'delimiter5' => ['title' => esc_html__('|', 'corpix'), 'settings' => true],
        'delimiter6' => ['title' => esc_html__('|', 'corpix'), 'settings' => true],
        'spacer1' => ['title' => esc_html__('Spacer 1', 'corpix'), 'settings' => true],
        'spacer2' => ['title' => esc_html__('Spacer 2', 'corpix'), 'settings' => true],
        'spacer3' => ['title' => esc_html__('Spacer 3', 'corpix'), 'settings' => true],
        'spacer4' => ['title' => esc_html__('Spacer 4', 'corpix'), 'settings' => true],
        'spacer5' => ['title' => esc_html__('Spacer 5', 'corpix'), 'settings' => true],
        'spacer6' => ['title' => esc_html__('Spacer 6', 'corpix'), 'settings' => true],
        'spacer7' => ['title' => esc_html__('Spacer 7', 'corpix'), 'settings' => true],
        'spacer8' => ['title' => esc_html__('Spacer 8', 'corpix'), 'settings' => true],
        'button1' => ['title' => esc_html__('Button', 'corpix'), 'settings' => true],
        'button2' => ['title' => esc_html__('Button', 'corpix'), 'settings' => true],
        'wpml' => ['title' => esc_html__('WPML', 'corpix'), 'settings' => false],
        'cart' => ['title' => esc_html__('Cart', 'corpix'), 'settings' => true],
        'login' => ['title' => esc_html__('WC Login', 'corpix'), 'settings' => false],
        'sign_in' => ['title' => esc_html__('LP Login', 'corpix'), 'settings' => false],
        'side_panel' => ['title' => esc_html__('Side Panel', 'corpix'), 'settings' => true],
        'login_join' => ['title' => esc_html__('Login/Join Button', 'corpix'), 'settings' => false],
    ],
    'mobile' => [
        'html1' => esc_html__('HTML 1', 'corpix'),
        'html2' => esc_html__('HTML 2', 'corpix'),
        'html3' => esc_html__('HTML 3', 'corpix'),
        'html4' => esc_html__('HTML 4', 'corpix'),
        'html5' => esc_html__('HTML 5', 'corpix'),
        'html6' => esc_html__('HTML 6', 'corpix'),
        'spacer1' => esc_html__('Spacer 1', 'corpix'),
        'spacer2' => esc_html__('Spacer 2', 'corpix'),
        'spacer3' => esc_html__('Spacer 3', 'corpix'),
        'spacer4' => esc_html__('Spacer 4', 'corpix'),
        'spacer5' => esc_html__('Spacer 5', 'corpix'),
        'spacer6' => esc_html__('Spacer 6', 'corpix'),
        'side_panel' => esc_html__('Side Panel', 'corpix'),
        'wpml' => esc_html__('WPML', 'corpix'),
        'cart' => esc_html__('Cart', 'corpix'),
        'login' => esc_html__('WC Login', 'corpix'),
        'sign_in' => esc_html__('LP Login', 'corpix'),
        'login_join' => esc_html__('Login/Join Button', 'corpix'),
    ],
    'mobile_drawer' => [
        'html1' => esc_html__('HTML 1', 'corpix'),
        'html2' => esc_html__('HTML 2', 'corpix'),
        'html3' => esc_html__('HTML 3', 'corpix'),
        'html4' => esc_html__('HTML 4', 'corpix'),
        'html5' => esc_html__('HTML 5', 'corpix'),
        'html6' => esc_html__('HTML 6', 'corpix'),
        'wpml' => esc_html__('WPML', 'corpix'),
        'spacer1' => esc_html__('Spacer 1', 'corpix'),
        'spacer2' => esc_html__('Spacer 2', 'corpix'),
        'spacer3' => esc_html__('Spacer 3', 'corpix'),
        'spacer4' => esc_html__('Spacer 4', 'corpix'),
        'spacer5' => esc_html__('Spacer 5', 'corpix'),
        'spacer6' => esc_html__('Spacer 6', 'corpix'),
    ],
];

Redux::setSection(
    $theme_slug,
    [
        'title' => esc_html__('Header Builder', 'corpix'),
        'id' => 'header-customize',
        'subsection' => true,
        'fields' => [
            [
                'id' => 'header_switch',
                'title' => esc_html__('Header', 'corpix'),
                'type' => 'switch',
                'on' => esc_html__('Use', 'corpix'),
                'off' => esc_html__('Disable', 'corpix'),
                'default' => true,
            ],
            [
                'id' => 'header_type',
                'type' => 'select',
                'title' => esc_html__('Layout Building Tool', 'corpix'),
                'desc' => esc_html__('Custom Builder allows create templates within Elementor environment.', 'corpix'),
                'options' => [
                    'default' => esc_html__('Default Builder', 'corpix'),
                    'custom' => esc_html__('Custom Builder ( Recommended )', 'corpix')
                ],
                'default' => 'default',
                'required' => ['header_switch', '=', '1'],
            ],
            [
                'id' => 'header_page_select',
                'type' => 'select',
                'title' => esc_html__('Header Template', 'corpix'),
                'required' => ['header_type', '=', 'custom'],
                'desc' => sprintf(
                    '%s <a href="%s" target="_blank">%s</a> %s',
                    esc_html__('Selected Template will be used for all pages by default. You can edit/create Header Template in the', 'corpix'),
                    admin_url('edit.php?post_type=header'),
                    esc_html__('Header Templates', 'corpix'),
                    esc_html__('dashboard tab.', 'corpix')
                ),
                'data' => 'posts',
                'args' => [
                    'post_type' => 'header',
                    'posts_per_page' => -1,
                    'orderby' => 'title',
                    'order' => 'ASC',
                ],
            ],
            [
                'id' => 'bottom_header_layout',
                'type' => 'custom_header_builder',
                'title' => esc_html__('Header Builder', 'corpix'),
                'required' => ['header_type', '=', 'default'],
                'compiler' => 'true',
                'full_width' => true,
                'default' => [
                    'items' => $header_builder_items['default'],
                    'Top Left area' => [],
                    'Top Center area' => [],
                    'Top Right area' => [],
                    'Middle Left area' => [
                        'logo' => ['title' => esc_html__('Logo', 'corpix'), 'settings' => false],
                    ],
                    'Middle Center area' => [
                        'menu' => ['title' => esc_html__('Menu', 'corpix'), 'settings' => false],
                    ],
                    'Middle Right area' => [
                        'item_search' => ['title' => esc_html__('Search', 'corpix'), 'settings' => true],
                    ],
                    'Bottom Left area' => [],
                    'Bottom Center area' => [],
                    'Bottom Right area' => [],
                ],
            ],
            [
                'id' => 'bottom_header_spacer1',
                'title' => esc_html__('Header Spacer 1 Width', 'corpix'),
                'type' => 'dimensions',
                'required' => ['header_type', '=', 'default'],
                'width' => true,
                'height' => false,
                'default' => ['width' => 43],
            ],
            [
                'id' => 'bottom_header_spacer2',
                'title' => esc_html__('Header Spacer 2 Width', 'corpix'),
                'type' => 'dimensions',
                'required' => ['header_type', '=', 'default'],
                'width' => true,
                'height' => false,
                'default' => ['width' => 40],
            ],
            [
                'id' => 'bottom_header_spacer3',
                'title' => esc_html__('Header Spacer 3 Width', 'corpix'),
                'type' => 'dimensions',
                'required' => ['header_type', '=', 'default'],
                'height' => false,
                'width' => true,
                'default' => ['width' => 25],
            ],
            [
                'id' => 'bottom_header_spacer4',
                'title' => esc_html__('Header Spacer 4 Width', 'corpix'),
                'type' => 'dimensions',
                'required' => ['header_type', '=', 'default'],
                'height' => false,
                'width' => true,
                'default' => ['width' => 25],
            ],
            [
                'id' => 'bottom_header_spacer5',
                'title' => esc_html__('Header Spacer 5 Width', 'corpix'),
                'type' => 'dimensions',
                'required' => ['header_type', '=', 'default'],
                'height' => false,
                'width' => true,
                'default' => ['width' => 25],
            ],
            [
                'id' => 'bottom_header_spacer6',
                'title' => esc_html__('Header Spacer 6 Width', 'corpix'),
                'type' => 'dimensions',
                'required' => ['header_type', '=', 'default'],
                'height' => false,
                'width' => true,
                'default' => ['width' => 25],
            ],
            [
                'id' => 'bottom_header_spacer7',
                'title' => esc_html__('Header Spacer 7 Width', 'corpix'),
                'type' => 'dimensions',
                'required' => ['header_type', '=', 'default'],
                'height' => false,
                'width' => true,
                'default' => ['width' => 25],
            ],
            [
                'id' => 'bottom_header_spacer8',
                'title' => esc_html__('Header Spacer 8 Width', 'corpix'),
                'type' => 'dimensions',
                'required' => ['header_type', '=', 'default'],
                'width' => true,
                'height' => false,
                'default' => ['width' => 25],
            ],
            [
                'id' => 'bottom_header_item_search_custom',
                'title' => esc_html__('Customize Search', 'corpix'),
                'type' => 'switch',
                'required' => ['header_type', '=', 'default'],
                'default' => false,
            ],
            [
                'id' => 'bottom_header_item_search_color_txt',
                'title' => esc_html__('Icon Color', 'corpix'),
                'type' => 'color_rgba',
                'required' => ['bottom_header_item_search_custom', '=', '1'],
                'mode' => 'background',
                'default' => [
                    'color' => '#333333',
                    'alpha' => '1',
                    'rgba' => 'rgba(30,40,69,1)'
                ],
            ],
            [
                'id' => 'bottom_header_item_search_hover_color_txt',
                'title' => esc_html__('Hover Icon Color', 'corpix'),
                'type' => 'color_rgba',
                'required' => ['bottom_header_item_search_custom', '=', '1'],
                'mode' => 'background',
                'default' => [
                    'color' => '#333333',
                    'alpha' => '1',
                    'rgba' => 'rgba(30,40,69,1)'
                ],
            ],
            [
                'id' => 'bottom_header_cart_custom',
                'title' => esc_html__('Customize cart', 'corpix'),
                'type' => 'switch',
                'required' => ['header_type', '=', 'default'],
                'default' => false,
            ],
            [
                'id' => 'bottom_header_catpc_color_txt',
                'title' => esc_html__('Icon Color', 'corpix'),
                'type' => 'color_rgba',
                'required' => ['bottom_header_cart_custom', '=', '1'],
                'mode' => 'background',
                'default' => [
                    'color' => '#333333',
                    'alpha' => '1',
                    'rgba' => 'rgba(30,40,69,1)',
                ],
            ],
            [
                'id' => 'bottom_header_cart_hover_color_txt',
                'title' => esc_html__('Hover Icon Color', 'corpix'),
                'type' => 'color_rgba',
                'required' => ['bottom_header_cart_custom', '=', '1'],
                'mode' => 'background',
                'default' => [
                    'color' => '#333333',
                    'alpha' => '1',
                    'rgba' => 'rgba(30,40,69,1)'
                ],
            ],
            [
                'id' => 'bottom_header_delimiter1_height',
                'title' => esc_html__('Delimiter Height', 'corpix'),
                'type' => 'dimensions',
                'required' => ['header_type', '=', 'default'],
                'height' => true,
                'width' => false,
                'default' => ['height' => 50],
            ],
            [
                'id' => 'bottom_header_delimiter1_width',
                'title' => esc_html__('Delimiter Width', 'corpix'),
                'type' => 'dimensions',
                'required' => ['header_type', '=', 'default'],
                'height' => false,
                'width' => true,
                'default' => ['width' => 1],
            ],
            [
                'id' => 'bottom_header_delimiter1_bg',
                'title' => esc_html__('Delimiter Background', 'corpix'),
                'type' => 'color_rgba',
                'required' => ['header_type', '=', 'default'],
                'mode' => 'background',
                'default' => [
                    'color' => '#000000',
                    'alpha' => '0.1',
                    'rgba' => 'rgba(0, 0, 0, 0.1)'
                ],
            ],
            [
                'id' => 'bottom_header_delimiter1_margin',
                'title' => esc_html__('Delimiter Spacing', 'corpix'),
                'type' => 'spacing',
                'required' => ['header_type', '=', 'default'],
                'mode' => 'margin',
                'all' => false,
                'bottom' => false,
                'top' => false,
                'left' => true,
                'right' => true,
                'default' => [
                    'margin-left' => '20',
                    'margin-right' => '30',
                ],
            ],
            [
                'id' => 'bottom_header_delimiter2_height',
                'title' => esc_html__('Delimiter Height', 'corpix'),
                'type' => 'dimensions',
                'required' => ['header_type', '=', 'default'],
                'height' => true,
                'width' => false,
                'default' => ['height' => 100],
            ],
            [
                'id' => 'bottom_header_delimiter2_width',
                'title' => esc_html__('Delimiter Width', 'corpix'),
                'type' => 'dimensions',
                'required' => ['header_type', '=', 'default'],
                'height' => false,
                'width' => true,
                'default' => ['width' => 1],
            ],
            [
                'id' => 'bottom_header_delimiter2_bg',
                'title' => esc_html__('Delimiter Background', 'corpix'),
                'type' => 'color_rgba',
                'required' => ['header_type', '=', 'default'],
                'mode' => 'background',
                'default' => [
                    'color' => '#ffffff',
                    'alpha' => '.9',
                    'rgba' => 'rgba(255,255,255,0.9)'
                ],
            ],
            [
                'id' => 'bottom_header_delimiter2_margin',
                'title' => esc_html__('Delimiter Spacing', 'corpix'),
                'type' => 'spacing',
                'required' => ['header_type', '=', 'default'],
                'mode' => 'margin',
                'all' => false,
                'bottom' => false,
                'top' => false,
                'left' => true,
                'right' => true,
                'default' => [
                    'margin-left' => '30',
                    'margin-right' => '30',
                ],
            ],
            [
                'id' => 'bottom_header_delimiter3_height',
                'title' => esc_html__('Delimiter Height', 'corpix'),
                'type' => 'dimensions',
                'required' => ['header_type', '=', 'default'],
                'height' => true,
                'width' => false,
                'default' => ['height' => 100],
            ],
            [
                'id' => 'bottom_header_delimiter3_width',
                'title' => esc_html__('Delimiter Width', 'corpix'),
                'type' => 'dimensions',
                'required' => ['header_type', '=', 'default'],
                'height' => false,
                'width' => true,
                'default' => ['width' => 1],
            ],
            [
                'id' => 'bottom_header_delimiter3_bg',
                'title' => esc_html__('Delimiter Background', 'corpix'),
                'type' => 'color_rgba',
                'required' => ['header_type', '=', 'default'],
                'mode' => 'background',
                'default' => [
                    'color' => '#ffffff',
                    'alpha' => '.9',
                    'rgba' => 'rgba(255,255,255,0.9)'
                ],
            ],
            [
                'id' => 'bottom_header_delimiter3_margin',
                'title' => esc_html__('Delimiter Spacing', 'corpix'),
                'type' => 'spacing',
                'required' => ['header_type', '=', 'default'],
                'mode' => 'margin',
                'all' => false,
                'bottom' => false,
                'top' => false,
                'left' => true,
                'right' => true,
                'default' => [
                    'margin-left' => '30',
                    'margin-right' => '30',
                ],
            ],
            [
                'id' => 'bottom_header_delimiter4_height',
                'title' => esc_html__('Delimiter Height', 'corpix'),
                'type' => 'dimensions',
                'required' => ['header_type', '=', 'default'],
                'height' => true,
                'width' => false,
                'default' => ['height' => 100],
            ],
            [
                'id' => 'bottom_header_delimiter4_width',
                'title' => esc_html__('Delimiter Width', 'corpix'),
                'type' => 'dimensions',
                'required' => ['header_type', '=', 'default'],
                'height' => false,
                'width' => true,
                'default' => ['width' => 1],
            ],
            [
                'id' => 'bottom_header_delimiter4_bg',
                'title' => esc_html__('Delimiter Background', 'corpix'),
                'type' => 'color_rgba',
                'required' => ['header_type', '=', 'default'],
                'mode' => 'background',
                'default' => [
                    'color' => '#ffffff',
                    'alpha' => '.9',
                    'rgba' => 'rgba(255,255,255,0.9)'
                ],
            ],
            [
                'id' => 'bottom_header_delimiter4_margin',
                'title' => esc_html__('Delimiter Spacing', 'corpix'),
                'type' => 'spacing',
                'required' => ['header_type', '=', 'default'],
                'mode' => 'margin',
                'all' => false,
                'bottom' => false,
                'top' => false,
                'left' => true,
                'right' => true,
                'default' => [
                    'margin-left' => '30',
                    'margin-right' => '30',
                ],
            ],
            [
                'id' => 'bottom_header_delimiter5_height',
                'title' => esc_html__('Delimiter Height', 'corpix'),
                'type' => 'dimensions',
                'required' => ['header_type', '=', 'default'],
                'height' => true,
                'width' => false,
                'default' => ['height' => 100],
            ],
            [
                'id' => 'bottom_header_delimiter5_width',
                'title' => esc_html__('Delimiter Width', 'corpix'),
                'type' => 'dimensions',
                'required' => ['header_type', '=', 'default'],
                'height' => false,
                'width' => true,
                'default' => ['width' => 1],
            ],
            [
                'id' => 'bottom_header_delimiter5_bg',
                'title' => esc_html__('Delimiter Background', 'corpix'),
                'type' => 'color_rgba',
                'required' => ['header_type', '=', 'default'],
                'mode' => 'background',
                'default' => [
                    'color' => '#ffffff',
                    'alpha' => '.9',
                    'rgba' => 'rgba(255,255,255,0.9)'
                ],
            ],
            [
                'id' => 'bottom_header_delimiter5_margin',
                'title' => esc_html__('Delimiter Spacing', 'corpix'),
                'type' => 'spacing',
                'required' => ['header_type', '=', 'default'],
                'mode' => 'margin',
                'all' => false,
                'bottom' => false,
                'top' => false,
                'left' => true,
                'right' => true,
                'default' => [
                    'margin-left' => '30',
                    'margin-right' => '30',
                ],
            ],
            [
                'id' => 'bottom_header_delimiter6_height',
                'title' => esc_html__('Delimiter Height', 'corpix'),
                'type' => 'dimensions',
                'required' => ['header_type', '=', 'default'],
                'height' => true,
                'width' => false,
                'default' => ['height' => 100],
            ],
            [
                'id' => 'bottom_header_delimiter6_width',
                'title' => esc_html__('Delimiter Width', 'corpix'),
                'type' => 'dimensions',
                'required' => ['header_type', '=', 'default'],
                'height' => false,
                'width' => true,
                'default' => ['width' => 1],
            ],
            [
                'id' => 'bottom_header_delimiter6_bg',
                'title' => esc_html__('Delimiter Background', 'corpix'),
                'type' => 'color_rgba',
                'required' => ['header_type', '=', 'default'],
                'mode' => 'background',
                'default' => [
                    'color' => '#ffffff',
                    'alpha' => '.9',
                    'rgba' => 'rgba(255,255,255,0.9)'
                ],
            ],
            [
                'id' => 'bottom_header_delimiter6_margin',
                'title' => esc_html__('Delimiter Spacing', 'corpix'),
                'type' => 'spacing',
                'required' => ['header_type', '=', 'default'],
                'mode' => 'margin',
                'all' => false,
                'bottom' => false,
                'top' => false,
                'left' => true,
                'right' => true,
                'default' => [
                    'margin-left' => '30',
                    'margin-right' => '30',
                ],
            ],
            [
                'id' => 'bottom_header_button1_title',
                'title' => esc_html__('Button Text', 'corpix'),
                'type' => 'text',
                'required' => ['header_type', '=', 'default'],
                'default' => esc_html__('Contact Us', 'corpix'),
            ],
            [
                'id' => 'bottom_header_button1_link',
                'title' => esc_html__('Link', 'corpix'),
                'type' => 'text',
                'required' => ['header_type', '=', 'default'],
                'default' => '#',
            ],
            [
                'id' => 'bottom_header_button1_target',
                'title' => esc_html__('Open link in a new tab', 'corpix'),
                'type' => 'switch',
                'required' => ['header_type', '=', 'default'],
                'default' => true,
            ],
            [
                'id' => 'bottom_header_button1_size',
                'title' => esc_html__('Button Size', 'corpix'),
                'type' => 'select',
                'required' => ['header_type', '=', 'default'],
                'options' => [
                    'sm' => esc_html__('Small', 'corpix'),
                    'md' => esc_html__('Medium', 'corpix'),
                    'lg' => esc_html__('Large', 'corpix'),
                    'xl' => esc_html__('Extra Large', 'corpix'),
                ],
                'default' => 'md',
            ],
            [
                'id' => 'bottom_header_button1_radius',
                'title' => esc_html__('Button Border Radius', 'corpix'),
                'type' => 'text',
                'required' => ['header_type', '=', 'default'],
                'desc' => esc_html__('Value in pixels.', 'corpix'),
            ],
            [
                'id' => 'bottom_header_button1_custom',
                'title' => esc_html__('Customize Button', 'corpix'),
                'type' => 'switch',
                'required' => ['header_type', '=', 'default'],
                'default' => false,
            ],
            [
                'id' => 'bottom_header_button1_color_txt',
                'title' => esc_html__('Text Color Idle', 'corpix'),
                'type' => 'color_rgba',
                'required' => ['bottom_header_button1_custom', '=', '1'],
                'mode' => 'background',
                'default' => [
                    'color' => '#ffffff',
                    'alpha' => '1',
                    'rgba' => 'rgba(255,255,255,1)'
                ],
            ],
            [
                'id' => 'bottom_header_button1_hover_color_txt',
                'title' => esc_html__('Text Color Hover', 'corpix'),
                'type' => 'color_rgba',
                'required' => ['bottom_header_button1_custom', '=', '1'],
                'mode' => 'background',
                'default' => [
                    'color' => '#333333',
                    'alpha' => '1',
                    'rgba' => 'rgba(30,40,69,1)'
                ],
            ],
            [
                'id' => 'bottom_header_button1_bg',
                'title' => esc_html__('Background Color', 'corpix'),
                'type' => 'color_rgba',
                'required' => ['bottom_header_button1_custom', '=', '1'],
                'mode' => 'background',
                'default' => [
                    'color' => '#333333',
                    'alpha' => '1',
                    'rgba' => 'rgba(30,40,69,1)'
                ],
            ],
            [
                'id' => 'bottom_header_button1_hover_bg',
                'title' => esc_html__('Hover Background Color', 'corpix'),
                'type' => 'color_rgba',
                'required' => ['bottom_header_button1_custom', '=', '1'],
                'mode' => 'background',
                'default' => [
                    'color' => '#ffffff',
                    'alpha' => '1',
                    'rgba' => 'rgba(255,255,255,1)'
                ],
            ],
            [
                'id' => 'bottom_header_button1_border',
                'title' => esc_html__('Border Color', 'corpix'),
                'type' => 'color_rgba',
                'required' => ['bottom_header_button1_custom', '=', '1'],
                'mode' => 'background',
                'default' => [
                    'color' => '#333333',
                    'alpha' => '1',
                    'rgba' => 'rgba(30,40,69,1)'
                ],
            ],
            [
                'id' => 'bottom_header_button1_hover_border',
                'title' => esc_html__('Hover Border Color', 'corpix'),
                'type' => 'color_rgba',
                'required' => ['bottom_header_button1_custom', '=', '1'],
                'mode' => 'background',
                'default' => [
                    'color' => '#333333',
                    'alpha' => '1',
                    'rgba' => 'rgba(30,40,69,1)'
                ],
            ],
            [
                'id' => 'bottom_header_button2_title',
                'title' => esc_html__('Button Text', 'corpix'),
                'type' => 'text',
                'required' => ['header_type', '=', 'default'],
                'default' => esc_html__('Contact Us', 'corpix'),
            ],
            [
                'id' => 'bottom_header_button2_link',
                'type' => 'text',
                'title' => esc_html__('Link', 'corpix'),
                'required' => ['header_type', '=', 'default'],
            ],
            [
                'id' => 'bottom_header_button2_target',
                'type' => 'switch',
                'title' => esc_html__('Open link in a new tab', 'corpix'),
                'default' => true,
                'required' => ['header_type', '=', 'default'],
            ],
            [
                'id' => 'bottom_header_button2_size',
                'title' => esc_html__('Button Size', 'corpix'),
                'type' => 'select',
                'required' => ['header_type', '=', 'default'],
                'options' => [
                    'sm' => esc_html__('Small', 'corpix'),
                    'md' => esc_html__('Medium', 'corpix'),
                    'lg' => esc_html__('Large', 'corpix'),
                    'xl' => esc_html__('Extra Large', 'corpix'),
                ],
                'default' => 'md',
            ],
            [
                'id' => 'bottom_header_button2_radius',
                'title' => esc_html__('Button Border Radius', 'corpix'),
                'type' => 'text',
                'required' => ['header_type', '=', 'default'],
                'desc' => esc_html__('Value in pixels.', 'corpix'),
            ],
            [
                'id' => 'bottom_header_button2_custom',
                'title' => esc_html__('Customize Button', 'corpix'),
                'type' => 'switch',
                'required' => ['header_type', '=', 'default'],
                'default' => false,
            ],
            [
                'id' => 'bottom_header_button2_color_txt',
                'title' => esc_html__('Text Color Idle', 'corpix'),
                'type' => 'color_rgba',
                'required' => ['bottom_header_button2_custom', '=', '1'],
                'mode' => 'background',
                'default' => [
                    'alpha' => '1',
                    'rgba' => 'rgba(255,255,255,1)',
                    'color' => '#ffffff',
                ],
            ],
            [
                'id' => 'bottom_header_button2_hover_color_txt',
                'title' => esc_html__('Text Color Hover', 'corpix'),
                'type' => 'color_rgba',
                'required' => ['bottom_header_button2_custom', '=', '1'],
                'mode' => 'background',
                'default' => [
                    'alpha' => '1',
                    'rgba' => 'rgba(30,40,69,1)',
                    'color' => '#333333',
                ],
            ],
            [
                'id' => 'bottom_header_button2_bg',
                'title' => esc_html__('Background Color', 'corpix'),
                'type' => 'color_rgba',
                'required' => ['bottom_header_button2_custom', '=', '1'],
                'mode' => 'background',
                'default' => [
                    'alpha' => '1',
                    'rgba' => 'rgba(30,40,69,1)',
                    'color' => '#333333',
                ],
            ],
            [
                'id' => 'bottom_header_button2_hover_bg',
                'title' => esc_html__('Hover Background Color', 'corpix'),
                'type' => 'color_rgba',
                'required' => ['bottom_header_button2_custom', '=', '1'],
                'mode' => 'background',
                'default' => [
                    'alpha' => '1',
                    'rgba' => 'rgba(255,255,255,1)',
                    'color' => '#ffffff',
                ],
            ],
            [
                'id' => 'bottom_header_button2_border',
                'title' => esc_html__('Border Color', 'corpix'),
                'type' => 'color_rgba',
                'required' => ['bottom_header_button2_custom', '=', '1'],
                'mode' => 'background',
                'default' => [
                    'alpha' => '1',
                    'rgba' => 'rgba(30,40,69,1)',
                    'color' => '#333333',
                ],
            ],
            [
                'id' => 'bottom_header_button2_hover_border',
                'title' => esc_html__('Hover Border Color', 'corpix'),
                'type' => 'color_rgba',
                'required' => ['bottom_header_button2_custom', '=', '1'],
                'mode' => 'background',
                'default' => [
                    'alpha' => '1',
                    'rgba' => 'rgba(30,40,69,1)',
                    'color' => '#333333',
                ],
            ],
            [
                'id' => 'bottom_header_bar_html1_editor',
                'title' => esc_html__('HTML Element 1 Editor', 'corpix'),
                'type' => 'ace_editor',
                'required' => ['header_type', '=', 'default'],
                'mode' => 'html',
                'default' => '<span style="font-size: 14px;"><a href="tel:+5074521254">'
                    . '<i class="rt-icon fa fa-phone" style="margin-right: 5px;"></i>'
                    . '+8 (123) 985 789'
                    . '</a></span>',
            ],
            [
                'id' => 'bottom_header_bar_html2_editor',
                'title' => esc_html__('HTML Element 2 Editor', 'corpix'),
                'type' => 'ace_editor',
                'required' => ['header_type', '=', 'default'],
                'mode' => 'html',
                'default' => '<span style="font-size: 14px;"><a href="https://google.com.ua/maps/@40.7798704,-73.975151,15z" target="_blank">'
                    . '<i class="rt-icon fa fa-map-marker-alt" style="margin-right: 5px;"></i>'
                    . '27 Division St, New York, NY 10002'
                    . '</a></span>',
            ],
            [
                'id' => 'bottom_header_bar_html3_editor',
                'title' => esc_html__('HTML Element 3 Editor', 'corpix'),
                'type' => 'ace_editor',
                'required' => ['header_type', '=', 'default'],
                'mode' => 'html',
                'default' => '<span style="font-size: 12px;">'
                    . '<a href="https://twitter.com/"><i class="rt-icon fab fa-twitter" style="padding: 12.5px"></i></a>'
                    . '<a href="https://facebook.com/"><i class="rt-icon fab fa-facebook-f" style="padding: 12.5px"></i></a>'
                    . '<a href="https://linkedin.com/"><i class="rt-icon fab fa-linkedin-in" style="padding: 12.5px"></i></a>'
                    . '<a href="https://instagram.com/"><i class="rt-icon fab fa-instagram" style="padding: 12.5px; margin-right: -10px;"></i></a>'
                    . '</span>',
            ],
            [
                'id' => 'bottom_header_bar_html4_editor',
                'title' => esc_html__('HTML Element 4 Editor', 'corpix'),
                'type' => 'ace_editor',
                'required' => ['header_type', '=', 'default'],
                'mode' => 'html',
            ],
            [
                'id' => 'bottom_header_bar_html5_editor',
                'title' => esc_html__('HTML Element 5 Editor', 'corpix'),
                'type' => 'ace_editor',
                'required' => ['header_type', '=', 'default'],
                'mode' => 'html',
            ],
            [
                'id' => 'bottom_header_bar_html6_editor',
                'title' => esc_html__('HTML Element 6 Editor', 'corpix'),
                'type' => 'ace_editor',
                'required' => ['header_type', '=', 'default'],
                'mode' => 'html',
            ],
            [
                'id' => 'bottom_header_bar_html7_editor',
                'title' => esc_html__('HTML Element 7 Editor', 'corpix'),
                'type' => 'ace_editor',
                'required' => ['header_type', '=', 'default'],
                'mode' => 'html',
            ],
            [
                'id' => 'bottom_header_bar_html8_editor',
                'title' => esc_html__('HTML Element 8 Editor', 'corpix'),
                'type' => 'ace_editor',
                'required' => ['header_type', '=', 'default'],
                'mode' => 'html',
            ],
            [
                'id' => 'bottom_header_side_panel_color',
                'title' => esc_html__('Icon Color', 'corpix'),
                'type' => 'color_rgba',
                'required' => ['header_type', '=', 'default'],
                'mode' => 'background',
                'default' => [
                    'alpha' => '1',
                    'rgba' => 'rgba(255,255,255,1)',
                    'color' => '#ffffff',
                ],
            ],
            [
                'id' => 'bottom_header_side_panel_background',
                'title' => esc_html__('Background Icon', 'corpix'),
                'type' => 'color_rgba',
                'required' => ['header_type', '=', 'default'],
                'mode' => 'background',
                'default' => [
                    'alpha' => '1',
                    'rgba' => 'rgba(30,40,69, 1)',
                    'color' => '#333333',
                ],
            ],
            [
                'id' => 'header_top-start',
                'title' => esc_html__('Header Top Options', 'corpix'),
                'type' => 'section',
                'required' => ['header_type', '=', 'default'],
                'indent' => true,
            ],
            [
                'id' => 'header_top_full_width',
                'title' => esc_html__('Full Width Header', 'corpix'),
                'type' => 'switch',
                'subtitle' => esc_html__('Set header content in full width', 'corpix'),
                'default' => false,
            ],
            [
                'id' => 'header_top_max_width_custom',
                'title' => esc_html__('Limit the Max Width of Container', 'corpix'),
                'type' => 'switch',
                'default' => false,
            ],
            [
                'id' => 'header_top_max_width',
                'title' => esc_html__('Max Width', 'corpix'),
                'type' => 'dimensions',
                'required' => ['header_top_max_width_custom', '=', '1'],
                'width' => true,
                'height' => false,
                'default' => ['width' => 1290],
            ],
            [
                'id' => 'header_top_height',
                'title' => esc_html__('Header Top Height', 'corpix'),
                'type' => 'dimensions',
                'width' => false,
                'height' => true,
                'default' => ['height' => 49]
            ],
            [
                'id' => 'header_top_background_image',
                'type' => 'media',
                'title' => esc_html__('Header Top Background Image', 'corpix'),
            ],
            [
                'id' => 'header_top_background',
                'title' => esc_html__('Header Top Background', 'corpix'),
                'type' => 'color_rgba',
                'mode' => 'background',
                'default' => [
                    'alpha' => '1',
                    'rgba' => 'rgba(255,255,255,1)',
                    'color' => '#ffffff',
                ],
            ],
            [
                'id' => 'header_top_color',
                'title' => esc_html__('Header Top Text Color', 'corpix'),
                'type' => 'color_rgba',
                'mode' => 'background',
                'default' => [
                    'alpha' => '1',
                    'rgba' => 'rgba(162,162,162,1)',
                    'color' => '#a2a2a2',
                ],
            ],
            [
                'id' => 'header_top_bottom_border',
                'type' => 'switch',
                'title' => esc_html__('Set Header Top Bottom Border', 'corpix'),
                'default' => true,
            ],
            [
                'id' => 'header_top_border_height',
                'title' => esc_html__('Header Top Border Width', 'corpix'),
                'type' => 'dimensions',
                'required' => ['header_top_bottom_border', '=', '1'],
                'height' => true,
                'width' => false,
                'default' => ['height' => '1'],
            ],
            [
                'id' => 'header_top_bottom_border_color',
                'title' => esc_html__('Header Top Border Color', 'corpix'),
                'type' => 'color_rgba',
                'required' => ['header_top_bottom_border', '=', '1'],
                'mode' => 'background',
                'default' => [
                    'alpha' => '.2',
                    'rgba' => 'rgba(162,162,162,0.2)',
                    'color' => '#a2a2a2',
                ],
            ],
            [
                'id' => 'header_top-end',
                'type' => 'section',
                'indent' => false,
            ],
            [
                'id' => 'header_middle-start',
                'title' => esc_html__('Header Middle Options', 'corpix'),
                'type' => 'section',
                'required' => ['header_type', '=', 'default'],
                'indent' => true,
            ],
            [
                'id' => 'header_middle_full_width',
                'type' => 'switch',
                'title' => esc_html__('Full Width Middle Header', 'corpix'),
                'subtitle' => esc_html__('Set header content in full width', 'corpix'),
                'default' => false,
            ],
            [
                'id' => 'header_middle_max_width_custom',
                'title' => esc_html__('Limit the Max Width of Container', 'corpix'),
                'type' => 'switch',
                'default' => false,
            ],
            [
                'id' => 'header_middle_max_width',
                'title' => esc_html__('Max Width', 'corpix'),
                'type' => 'dimensions',
                'required' => ['header_middle_max_width_custom', '=', '1'],
                'height' => false,
                'width' => true,
                'default' => ['width' => 1290],
            ],
            [
                'id' => 'header_middle_height',
                'title' => esc_html__('Header Middle Height', 'corpix'),
                'type' => 'dimensions',
                'width' => false,
                'height' => true,
                'default' => ['height' => 98]
            ],
            [
                'id' => 'header_middle_background_image',
                'title' => esc_html__('Header Middle Background Image', 'corpix'),
                'type' => 'media',
            ],
            [
                'id' => 'header_middle_background',
                'title' => esc_html__('Header Middle Background', 'corpix'),
                'type' => 'color_rgba',
                'mode' => 'background',
                'default' => [
                    'color' => '#ffffff',
                    'alpha' => '1',
                    'rgba' => 'rgba(255,255,255,1)'
                ],
            ],
            [
                'id' => 'header_middle_color',
                'title' => esc_html__('Header Middle Text Color', 'corpix'),
                'type' => 'color_rgba',
                'mode' => 'background',
                'default' => [
                    'color' => '#333332',
                    'alpha' => '1',
                    'rgba' => 'rgba(51,51,50,1)'
                ],
            ],
            [
                'id' => 'header_middle_bottom_border',
                'title' => esc_html__('Set Header Middle Bottom Border', 'corpix'),
                'type' => 'switch',
                'default' => false,
            ],
            [
                'id' => 'header_middle_border_height',
                'title' => esc_html__('Header Middle Border Width', 'corpix'),
                'type' => 'dimensions',
                'required' => ['header_middle_bottom_border', '=', '1'],
                'height' => true,
                'width' => false,
                'default' => ['height' => '1'],
            ],
            [
                'id' => 'header_middle_bottom_border_color',
                'title' => esc_html__('Header Middle Border Color', 'corpix'),
                'type' => 'color_rgba',
                'required' => ['header_middle_bottom_border', '=', '1'],
                'mode' => 'background',
                'default' => [
                    'color' => '#f5f5f5',
                    'alpha' => '1',
                    'rgba' => 'rgba(245,245,245,1)'
                ],
            ],
            [
                'id' => 'header_middle-end',
                'type' => 'section',
                'indent' => false,
            ],
            [
                'id' => 'header_bottom-start',
                'type' => 'section',
                'title' => esc_html__('Header Bottom Options', 'corpix'),
                'indent' => true,
                'required' => ['header_type', '=', 'default'],
            ],
            [
                'id' => 'header_bottom_full_width',
                'title' => esc_html__('Full Width Bottom Header', 'corpix'),
                'type' => 'switch',
                'subtitle' => esc_html__('Set header content in full width', 'corpix'),
                'default' => false,
            ],
            [
                'id' => 'header_bottom_max_width_custom',
                'title' => esc_html__('Limit the Max Width of Container', 'corpix'),
                'type' => 'switch',
                'default' => false,
            ],
            [
                'id' => 'header_bottom_max_width',
                'title' => esc_html__('Max Width', 'corpix'),
                'type' => 'dimensions',
                'required' => ['header_bottom_max_width_custom', '=', '1'],
                'width' => true,
                'height' => false,
                'default' => ['width' => 1290],
            ],
            [
                'id' => 'header_bottom_height',
                'title' => esc_html__('Header Bottom Height', 'corpix'),
                'type' => 'dimensions',
                'width' => false,
                'height' => true,
                'default' => ['height' => 100],
            ],
            [
                'id' => 'header_bottom_background_image',
                'title' => esc_html__('Header Bottom Background Image', 'corpix'),
                'type' => 'media',
            ],
            [
                'id' => 'header_bottom_background',
                'title' => esc_html__('Header Bottom Background', 'corpix'),
                'type' => 'color_rgba',
                'mode' => 'background',
                'default' => [
                    'color' => '#ffffff',
                    'alpha' => '.9',
                    'rgba' => 'rgba(255,255,255,0.9)'
                ],
            ],
            [
                'id' => 'header_bottom_color',
                'title' => esc_html__('Header Bottom Text Color', 'corpix'),
                'type' => 'color_rgba',
                'mode' => 'background',
                'default' => [
                    'color' => '#fefefe',
                    'alpha' => '.5',
                    'rgba' => 'rgba(254,254,254,0.5)'
                ],
            ],
            [
                'id' => 'header_bottom_bottom_border',
                'title' => esc_html__('Set Header Bottom Border', 'corpix'),
                'type' => 'switch',
                'default' => true,
            ],
            [
                'id' => 'header_bottom_border_height',
                'title' => esc_html__('Header Bottom Border Width', 'corpix'),
                'type' => 'dimensions',
                'required' => ['header_bottom_bottom_border', '=', '1'],
                'height' => true,
                'width' => false,
                'default' => ['height' => '1'],
            ],
            [
                'id' => 'header_bottom_bottom_border_color',
                'title' => esc_html__('Header Bottom Border Color', 'corpix'),
                'type' => 'color_rgba',
                'required' => ['header_bottom_bottom_border', '=', '1'],
                'mode' => 'background',
                'default' => [
                    'color' => '#ffffff',
                    'alpha' => '1',
                    'rgba' => 'rgba(255,255,255,0.2)'
                ],
            ],
            [
                'id' => 'header_bottom-end',
                'type' => 'section',
                'indent' => false,
            ],
            [
                'id' => 'header_column-top-left-start',
                'title' => esc_html__('Top Left Column Options', 'corpix'),
                'type' => 'section',
                'required' => ['header_type', '=', 'default'],
                'indent' => true,
            ],
            [
                'id' => 'header_column_top_left_horz',
                'type' => 'button_set',
                'title' => esc_html__('Horizontal Align', 'corpix'),
                'options' => [
                    'left' => esc_html__('Left', 'corpix'),
                    'center' => esc_html__('Center', 'corpix'),
                    'right' => esc_html__('Right', 'corpix'),
                ],
                'default' => 'left'
            ],
            [
                'id' => 'header_column_top_left_vert',
                'type' => 'button_set',
                'title' => esc_html__('Vertical Align', 'corpix'),
                'options' => [
                    'top' => esc_html__('Top', 'corpix'),
                    'middle' => esc_html__('Middle', 'corpix'),
                    'bottom' => esc_html__('Bottom', 'corpix'),
                ],
                'default' => 'middle'
            ],
            [
                'id' => 'header_column_top_left_display',
                'type' => 'button_set',
                'title' => esc_html__('Display', 'corpix'),
                'options' => [
                    'normal' => esc_html__('Normal', 'corpix'),
                    'grow' => esc_html__('Grow', 'corpix'),
                ],
                'default' => 'normal'
            ],
            [
                'id' => 'header_column-top-left-end',
                'type' => 'section',
                'indent' => false,
            ],
            [
                'id' => 'header_column-top-center-start',
                'type' => 'section',
                'title' => esc_html__('Top Center Column Options', 'corpix'),
                'indent' => true,
                'required' => ['header_type', '=', 'default'],
            ],
            [
                'id' => 'header_column_top_center_horz',
                'type' => 'button_set',
                'title' => esc_html__('Horizontal Align', 'corpix'),
                'options' => [
                    'left' => esc_html__('Left', 'corpix'),
                    'center' => esc_html__('Center', 'corpix'),
                    'right' => esc_html__('Right', 'corpix'),
                ],
                'default' => 'left'
            ],
            [
                'id' => 'header_column_top_center_vert',
                'type' => 'button_set',
                'title' => esc_html__('Vertical Align', 'corpix'),
                'options' => [
                    'top' => esc_html__('Top', 'corpix'),
                    'middle' => esc_html__('Middle', 'corpix'),
                    'bottom' => esc_html__('Bottom', 'corpix'),
                ],
                'default' => 'middle'
            ],
            [
                'id' => 'header_column_top_center_display',
                'type' => 'button_set',
                'title' => esc_html__('Display', 'corpix'),
                'options' => [
                    'normal' => esc_html__('Normal', 'corpix'),
                    'grow' => esc_html__('Grow', 'corpix'),
                ],
                'default' => 'normal'
            ],
            [
                'id' => 'header_column-top-center-end',
                'type' => 'section',
                'indent' => false,
            ],
            [
                'id' => 'header_column-top-center-start',
                'type' => 'section',
                'title' => esc_html__('Top Center Column Options', 'corpix'),
                'indent' => true,
                'required' => ['header_type', '=', 'default'],
            ],
            [
                'id' => 'header_column_top_center_horz',
                'type' => 'button_set',
                'title' => esc_html__('Horizontal Align', 'corpix'),
                'options' => [
                    'left' => esc_html__('Left', 'corpix'),
                    'center' => esc_html__('Center', 'corpix'),
                    'right' => esc_html__('Right', 'corpix'),
                ],
                'default' => 'left'
            ],
            [
                'id' => 'header_column_top_center_vert',
                'type' => 'button_set',
                'title' => esc_html__('Vertical Align', 'corpix'),
                'options' => [
                    'top' => esc_html__('Top', 'corpix'),
                    'middle' => esc_html__('Middle', 'corpix'),
                    'bottom' => esc_html__('Bottom', 'corpix'),
                ],
                'default' => 'middle'
            ],
            [
                'id' => 'header_column_top_center_display',
                'type' => 'button_set',
                'title' => esc_html__('Display', 'corpix'),
                'options' => [
                    'normal' => esc_html__('Normal', 'corpix'),
                    'grow' => esc_html__('Grow', 'corpix'),
                ],
                'default' => 'normal'
            ],
            [
                'id' => 'header_column-top-center-end',
                'type' => 'section',
                'indent' => false,
            ],
            [
                'id' => 'header_column-top-right-start',
                'type' => 'section',
                'title' => esc_html__('Top Right Column Options', 'corpix'),
                'indent' => true,
                'required' => ['header_type', '=', 'default'],
            ],
            [
                'id' => 'header_column_top_right_horz',
                'type' => 'button_set',
                'title' => esc_html__('Horizontal Align', 'corpix'),
                'options' => [
                    'left' => esc_html__('Left', 'corpix'),
                    'center' => esc_html__('Center', 'corpix'),
                    'right' => esc_html__('Right', 'corpix'),
                ],
                'default' => 'right'
            ],
            [
                'id' => 'header_column_top_right_vert',
                'type' => 'button_set',
                'title' => esc_html__('Vertical Align', 'corpix'),
                'options' => [
                    'top' => esc_html__('Top', 'corpix'),
                    'middle' => esc_html__('Middle', 'corpix'),
                    'bottom' => esc_html__('Bottom', 'corpix'),
                ],
                'default' => 'middle'
            ],
            [
                'id' => 'header_column_top_right_display',
                'type' => 'button_set',
                'title' => esc_html__('Display', 'corpix'),
                'options' => [
                    'normal' => esc_html__('Normal', 'corpix'),
                    'grow' => esc_html__('Grow', 'corpix'),
                ],
                'default' => 'normal'
            ],
            [
                'id' => 'header_column-top-right-end',
                'type' => 'section',
                'indent' => false,
            ],
            [
                'id' => 'header_column-middle-left-start',
                'type' => 'section',
                'title' => esc_html__('Middle Left Column Options', 'corpix'),
                'indent' => true,
                'required' => ['header_type', '=', 'default'],
            ],
            [
                'id' => 'header_column_middle_left_horz',
                'type' => 'button_set',
                'title' => esc_html__('Horizontal Align', 'corpix'),
                'options' => [
                    'left' => esc_html__('Left', 'corpix'),
                    'center' => esc_html__('Center', 'corpix'),
                    'right' => esc_html__('Right', 'corpix'),
                ],
                'default' => 'left'
            ],
            [
                'id' => 'header_column_middle_left_vert',
                'type' => 'button_set',
                'title' => esc_html__('Vertical Align', 'corpix'),
                'options' => [
                    'top' => esc_html__('Top', 'corpix'),
                    'middle' => esc_html__('Middle', 'corpix'),
                    'bottom' => esc_html__('Bottom', 'corpix'),
                ],
                'default' => 'middle'
            ],
            [
                'id' => 'header_column_middle_left_display',
                'type' => 'button_set',
                'title' => esc_html__('Display', 'corpix'),
                'options' => [
                    'normal' => esc_html__('Normal', 'corpix'),
                    'grow' => esc_html__('Grow', 'corpix'),
                ],
                'default' => 'normal'
            ],
            [
                'id' => 'header_column-middle-left-end',
                'type' => 'section',
                'indent' => false,
            ],
            [
                'id' => 'header_column-middle-center-start',
                'type' => 'section',
                'title' => esc_html__('Middle Center Column Options', 'corpix'),
                'indent' => true,
                'required' => ['header_type', '=', 'default'],
            ],
            [
                'id' => 'header_column_middle_center_horz',
                'type' => 'button_set',
                'title' => esc_html__('Horizontal Align', 'corpix'),
                'options' => [
                    'left' => esc_html__('Left', 'corpix'),
                    'center' => esc_html__('Center', 'corpix'),
                    'right' => esc_html__('Right', 'corpix'),
                ],
                'default' => 'center'
            ],
            [
                'id' => 'header_column_middle_center_vert',
                'type' => 'button_set',
                'title' => esc_html__('Vertical Align', 'corpix'),
                'options' => [
                    'top' => esc_html__('Top', 'corpix'),
                    'middle' => esc_html__('Middle', 'corpix'),
                    'bottom' => esc_html__('Bottom', 'corpix'),
                ],
                'default' => 'middle'
            ],
            [
                'id' => 'header_column_middle_center_display',
                'type' => 'button_set',
                'title' => esc_html__('Display', 'corpix'),
                'options' => [
                    'normal' => esc_html__('Normal', 'corpix'),
                    'grow' => esc_html__('Grow', 'corpix'),
                ],
                'default' => 'normal'
            ],
            [
                'id' => 'header_column-middle-center-end',
                'type' => 'section',
                'indent' => false,
            ],
            [
                'id' => 'header_column-middle-right-start',
                'type' => 'section',
                'title' => esc_html__('Middle Right Column Options', 'corpix'),
                'indent' => true,
                'required' => ['header_type', '=', 'default'],
            ],
            [
                'id' => 'header_column_middle_right_horz',
                'type' => 'button_set',
                'title' => esc_html__('Horizontal Align', 'corpix'),
                'options' => [
                    'left' => esc_html__('Left', 'corpix'),
                    'center' => esc_html__('Center', 'corpix'),
                    'right' => esc_html__('Right', 'corpix'),
                ],
                'default' => 'right'
            ],
            [
                'id' => 'header_column_middle_right_vert',
                'type' => 'button_set',
                'title' => esc_html__('Vertical Align', 'corpix'),
                'options' => [
                    'top' => esc_html__('Top', 'corpix'),
                    'middle' => esc_html__('Middle', 'corpix'),
                    'bottom' => esc_html__('Bottom', 'corpix'),
                ],
                'default' => 'middle'
            ],
            [
                'id' => 'header_column_middle_right_display',
                'type' => 'button_set',
                'title' => esc_html__('Display', 'corpix'),
                'options' => [
                    'normal' => esc_html__('Normal', 'corpix'),
                    'grow' => esc_html__('Grow', 'corpix'),
                ],
                'default' => 'normal'
            ],
            [
                'id' => 'header_column-middle-right-end',
                'type' => 'section',
                'indent' => false,
            ],
            [
                'id' => 'header_column-bottom-left-start',
                'type' => 'section',
                'title' => esc_html__('Bottom Left Column Options', 'corpix'),
                'indent' => true,
                'required' => ['header_type', '=', 'default'],
            ],
            [
                'id' => 'header_column_bottom_left_horz',
                'type' => 'button_set',
                'title' => esc_html__('Horizontal Align', 'corpix'),
                'options' => [
                    'left' => esc_html__('Left', 'corpix'),
                    'center' => esc_html__('Center', 'corpix'),
                    'right' => esc_html__('Right', 'corpix'),
                ],
                'default' => 'left'
            ],
            [
                'id' => 'header_column_bottom_left_vert',
                'type' => 'button_set',
                'title' => esc_html__('Vertical Align', 'corpix'),
                'options' => [
                    'top' => esc_html__('Top', 'corpix'),
                    'middle' => esc_html__('Middle', 'corpix'),
                    'bottom' => esc_html__('Bottom', 'corpix'),
                ],
                'default' => 'middle'
            ],
            [
                'id' => 'header_column_bottom_left_display',
                'type' => 'button_set',
                'title' => esc_html__('Display', 'corpix'),
                'options' => [
                    'normal' => esc_html__('Normal', 'corpix'),
                    'grow' => esc_html__('Grow', 'corpix'),
                ],
                'default' => 'normal'
            ],
            [
                'id' => 'header_column-bottom-left-end',
                'type' => 'section',
                'indent' => false,
            ],
            [
                'id' => 'header_column-bottom-center-start',
                'type' => 'section',
                'title' => esc_html__('Bottom Center Column Options', 'corpix'),
                'indent' => true,
                'required' => ['header_type', '=', 'default'],
            ],
            [
                'id' => 'header_column_bottom_center_horz',
                'type' => 'button_set',
                'title' => esc_html__('Horizontal Align', 'corpix'),
                'options' => [
                    'left' => esc_html__('Left', 'corpix'),
                    'center' => esc_html__('Center', 'corpix'),
                    'right' => esc_html__('Right', 'corpix'),
                ],
                'default' => 'left'
            ],
            [
                'id' => 'header_column_bottom_center_vert',
                'type' => 'button_set',
                'title' => esc_html__('Vertical Align', 'corpix'),
                'options' => [
                    'top' => esc_html__('Top', 'corpix'),
                    'middle' => esc_html__('Middle', 'corpix'),
                    'bottom' => esc_html__('Bottom', 'corpix'),
                ],
                'default' => 'middle'
            ],
            [
                'id' => 'header_column_bottom_center_display',
                'type' => 'button_set',
                'title' => esc_html__('Display', 'corpix'),
                'options' => [
                    'normal' => esc_html__('Normal', 'corpix'),
                    'grow' => esc_html__('Grow', 'corpix'),
                ],
                'default' => 'normal'
            ],
            [
                'id' => 'header_column-bottom-center-end',
                'type' => 'section',
                'indent' => false,
            ],
            [
                'id' => 'header_column-bottom-right-start',
                'type' => 'section',
                'title' => esc_html__('Bottom Right Column Options', 'corpix'),
                'indent' => true,
                'required' => ['header_type', '=', 'default'],
            ],
            [
                'id' => 'header_column_bottom_right_horz',
                'type' => 'button_set',
                'title' => esc_html__('Horizontal Align', 'corpix'),
                'options' => [
                    'left' => esc_html__('Left', 'corpix'),
                    'center' => esc_html__('Center', 'corpix'),
                    'right' => esc_html__('Right', 'corpix'),
                ],
                'default' => 'right'
            ],
            [
                'id' => 'header_column_bottom_right_vert',
                'type' => 'button_set',
                'title' => esc_html__('Vertical Align', 'corpix'),
                'options' => [
                    'top' => esc_html__('Top', 'corpix'),
                    'middle' => esc_html__('Middle', 'corpix'),
                    'bottom' => esc_html__('Bottom', 'corpix'),
                ],
                'default' => 'middle'
            ],
            [
                'id' => 'header_column_bottom_right_display',
                'type' => 'button_set',
                'title' => esc_html__('Display', 'corpix'),
                'options' => [
                    'normal' => esc_html__('Normal', 'corpix'),
                    'grow' => esc_html__('Grow', 'corpix'),
                ],
                'default' => 'normal'
            ],
            [
                'id' => 'header_column-bottom-right-end',
                'type' => 'section',
                'indent' => false,
            ],
            [
                'id' => 'header_row_settings-start',
                'type' => 'section',
                'title' => esc_html__('Header Settings', 'corpix'),
                'indent' => true,
                'required' => ['header_type', '=', 'default'],
            ],
            [
                'id' => 'header_shadow',
                'type' => 'switch',
                'title' => esc_html__('Header Bottom Shadow', 'corpix'),
                'default' => false,
            ],
            [
                'id' => 'header_on_bg',
                'type' => 'switch',
                'title' => esc_html__('Over content', 'corpix'),
                'subtitle' => esc_html__('Display header template over the content.', 'corpix'),
                'on' => esc_html__('Yes', 'corpix'),
                'off' => esc_html__('No', 'corpix'),
                'default' => false,
            ],
            [
                'id' => 'lavalamp_active',
                'type' => 'switch',
                'title' => esc_html__('Lavalamp Marker', 'corpix'),
                'on' => esc_html__('Use', 'corpix'),
                'off' => esc_html__('Hide', 'corpix'),
                'default' => false,
            ],
            [
                'id' => 'sub_menu_background',
                'type' => 'color_rgba',
                'title' => esc_html__('Sub Menu Background', 'corpix'),
                'mode' => 'background',
                'default' => [
                    'alpha' => '1',
                    'rgba' => 'rgba(255,255,255,1)',
                    'color' => '#ffffff'
                ],
            ],
            [
                'id' => 'sub_menu_color',
                'type' => 'color',
                'title' => esc_html__('Sub Menu Text Color', 'corpix'),
                'transparent' => false,
                'default' => '#333333',
            ],
            [
                'id' => 'header_sub_menu_bottom_border',
                'type' => 'switch',
                'title' => esc_html__('Sub Menu Bottom Border', 'corpix'),
                'default' => false,
            ],
            [
                'id' => 'header_sub_menu_border_height',
                'type' => 'dimensions',
                'title' => esc_html__('Sub Menu Border Width', 'corpix'),
                'height' => true,
                'width' => false,
                'default' => ['height' => '1'],
                'required' => ['header_sub_menu_bottom_border', '=', '1']
            ],
            [
                'id' => 'header_sub_menu_bottom_border_color',
                'type' => 'color_rgba',
                'title' => esc_html__('Sub Menu Border Color', 'corpix'),
                'default' => [
                    'color' => '#ffffff',
                    'alpha' => '1',
                    'rgba' => 'rgba(0, 0, 0, 0.08)'
                ],
                'mode' => 'background',
                'required' => ['header_sub_menu_bottom_border', '=', '1'],
            ],
            [
                'id' => 'header_mobile_queris',
                'title' => esc_html__('Mobile Header Switch Breakpoint', 'corpix'),
                'type' => 'slider',
                'display_value' => 'text',
                'min' => 400,
                'max' => 1920,
                'default' => 1200,
            ],
            [
                'id' => 'header_row_settings-end',
                'type' => 'section',
                'indent' => false,
            ],
        ]
    ]
);

Redux::setSection(
    $theme_slug,
    [
        'title' => esc_html__('Header Sticky', 'corpix'),
        'id' => 'header_builder_sticky',
        'subsection' => true,
        'fields' => [
            [
                'id' => 'header_sticky',
                'title' => esc_html__('Header Sticky', 'corpix'),
                'type' => 'switch',
                'default' => true,
            ],
            [
                'id' => 'header_sticky-start',
                'title' => esc_html__('Sticky Settings', 'corpix'),
                'type' => 'section',
                'required' => ['header_sticky', '=', '1'],
                'indent' => true,
            ],
            [
                'id' => 'header_sticky_page_select',
                'title' => esc_html__('Header Sticky Template', 'corpix'),
                'type' => 'select',
                'required' => ['header_sticky', '=', '1'],
                'desc' => sprintf(
                    '%s <a href="%s" target="_blank">%s</a> %s',
                    esc_html__('Selected Template will be used for all pages by default. You can edit/create Header Template in the', 'corpix'),
                    admin_url('edit.php?post_type=header'),
                    esc_html__('Header Templates', 'corpix'),
                    esc_html__('dashboard tab.', 'corpix')
                ),
                'data' => 'posts',
                'args' => [
                    'post_type' => 'header',
                    'posts_per_page' => -1,
                    'orderby' => 'title',
                    'order' => 'ASC',
                ],
            ],
            [
                'id' => 'header_sticky_style',
                'type' => 'select',
                'title' => esc_html__('Appearance', 'corpix'),
                'options' => [
                    'standard' => esc_html__('Always Visible', 'corpix'),
                    'scroll_up' => esc_html__('Visible while scrolling upwards', 'corpix'),
                ],
                'default' => 'scroll_up'
            ],
            [
                'id' => 'header_sticky-end',
                'type' => 'section',
                'required' => ['header_sticky', '=', '1'],
                'indent' => false,
            ],
        ]
    ]
);

Redux::setSection(
    $theme_slug,
    [
        'title' => esc_html__('Header Mobile', 'corpix'),
        'id' => 'header_builder_mobile',
        'subsection' => true,
        'fields' => [
            [
                'id' => 'mobile_header',
                'title' => esc_html__('Mobile Header', 'corpix'),
                'type' => 'switch',
                'on' => esc_html__('Custom', 'corpix'),
                'off' => esc_html__('Default', 'corpix'),
                'default' => false,
            ],
            [
                'id' => 'header_mobile_appearance-start',
                'title' => esc_html__('Appearance', 'corpix'),
                'type' => 'section',
                'required' => ['mobile_header', '=', '1'],
                'indent' => true,
            ],
            [
                'id' => 'header_mobile_height',
                'title' => esc_html__('Header Height', 'corpix'),
                'type' => 'dimensions',
                'height' => true,
                'width' => false,
                'default' => ['height' => '50'],
            ],
            [
                'id' => 'header_mobile_full_width',
                'title' => esc_html__('Full Width Header', 'corpix'),
                'type' => 'switch',
                'default' => false,
            ],
            [
                'id' => 'mobile_sticky',
                'title' => esc_html__('Mobile Sticky Header', 'corpix'),
                'type' => 'switch',
                'default' => false,
            ],
            [
                'id' => 'mobile_over_content',
                'title' => esc_html__('Header Over Content', 'corpix'),
                'type' => 'switch',
                'default' => false,
            ],
            [
                'id' => 'mobile_background',
                'title' => esc_html__('Header Background', 'corpix'),
                'type' => 'color_rgba',
                'mode' => 'background',
                'default' => [
                    'alpha' => '1',
                    'rgba' => 'rgba(30,40,69, 1)',
                    'color' => '#333333',
                ],
            ],
            [
                'id' => 'mobile_color',
                'title' => esc_html__('Header Text Color', 'corpix'),
                'type' => 'color',
                'transparent' => false,
                'default' => '#ffffff',
            ],
            [
                'id' => 'header_mobile_appearance-end',
                'type' => 'section',
                'indent' => false,
            ],
            [
                'id' => 'header_mobile_menu-start',
                'title' => esc_html__('Menu', 'corpix'),
                'type' => 'section',
                'required' => ['mobile_header', '=', '1'],
                'indent' => true,
            ],
            [
                'id' => 'mobile_position',
                'title' => esc_html__('Menu Occurrence', 'corpix'),
                'type' => 'button_set',
                'options' => [
                    'left' => esc_html__('Left', 'corpix'),
                    'right' => esc_html__('Right', 'corpix'),
                ],
                'default' => 'left',
            ],
            [
                'id' => 'custom_mobile_menu',
                'type' => 'switch',
                'title' => esc_html__('Custom Mobile Menu', 'corpix'),
                'default' => false,
            ],
            [
                'id' => 'mobile_menu',
                'type' => 'select',
                'title' => esc_html__('Mobile Menu', 'corpix'),
                'required' => ['custom_mobile_menu', '=', '1'],
                'select2' => ['allowClear' => false],
                'options' => $menus = corpix_get_custom_menu(),
                'default' => reset($menus),
            ],
            [
                'id' => 'mobile_sub_menu_color',
                'title' => esc_html__('Menu Text Color', 'corpix'),
                'type' => 'color',
                'transparent' => false,
                'default' => '#ffffff',
            ],
            [
                'id' => 'mobile_sub_menu_background',
                'title' => esc_html__('Menu Background', 'corpix'),
                'type' => 'color_rgba',
                'mode' => 'background',
                'default' => [
                    'alpha' => '1',
                    'rgba' => 'rgba(30,40,69,1)',
                    'color' => '#1e2845',
                ],
            ],
            [
                'id' => 'mobile_sub_menu_overlay',
                'title' => esc_html__('Menu Overlay', 'corpix'),
                'type' => 'color_rgba',
                'mode' => 'background',
                'default' => [
                    'alpha' => '1',
                    'rgba' => 'rgba(30,40,69,0.8)',
                    'color' => '#333333',
                ],
            ],
            [
                'id' => 'header_mobile_menu-end',
                'type' => 'section',
                'indent' => false,
            ],
            [
                'id' => 'header_mobile_login_join-start',
                'title' => esc_html__('Login Join (Mobile)', 'corpix'),
                'type' => 'section',
                'required' => ['mobile_header', '=', '1'],
                'indent' => true,
            ],
            [
                'id' => 'login_page_url_mobile',
                'title' => esc_html__('Login Page URL', 'corpix'),
                'type' => 'text',
            ],
            [
                'id' => 'join_page_url_mobile',
                'title' => esc_html__('Join Page URL', 'corpix'),
                'type' => 'text',
            ],
            [
                'id' => 'login_text_mobile',
                'title' => esc_html__('Login Text', 'corpix'),
                'type' => 'text',
                'default' => esc_html__('Login', 'corpix'),
            ],
            [
                'id' => 'join_text_mobile',
                'title' => esc_html__('Join Text', 'corpix'),
                'type' => 'text',
                'default' => esc_html__('Join', 'corpix'),
            ],
            [
                'id' => 'logout_text_mobile',
                'title' => esc_html__('Logout Text', 'corpix'),
                'type' => 'text',
                'default' => esc_html__('Logout', 'corpix'),
            ],
            [
                'id' => 'header_mobile_login_join-end',
                'type' => 'section',
                'indent' => false,
            ],
            [
                'id' => 'mobile_header_layout',
                'title' => esc_html__('Mobile Header Order', 'corpix'),
                'type' => 'sorter',
                'required' => ['mobile_header', '=', '1'],
                'desc' => esc_html__('Organize the layout of the mobile header', 'corpix'),
                'compiler' => 'true',
                'full_width' => true,
                'options' => [
                    'items' => $header_builder_items['mobile'],
                    'Left align side' => [
                        'menu' => esc_html__('Hamburger Menu', 'corpix'),
                    ],
                    'Center align side' => [
                        'logo' => esc_html__('Logo', 'corpix'),
                    ],
                    'Right align side' => [
                        'item_search' => esc_html__('Search', 'corpix'),
                    ],
                ],
            ],
            [
                'id' => 'mobile_content_header_layout',
                'title' => esc_html__('Mobile Drawer Content', 'corpix'),
                'type' => 'sorter',
                'required' => ['mobile_header', '=', '1'],
                'desc' => esc_html__('Organize the layout of the mobile header', 'corpix'),
                'compiler' => 'true',
                'full_width' => true,
                'options' => [
                    'items' => $header_builder_items['mobile_drawer'],
                    'Left align side' => [
                        'logo' => esc_html__('Logo', 'corpix'),
                        'menu' => esc_html__('Menu', 'corpix'),
                        'item_search' => esc_html__('Search', 'corpix'),
                    ],
                ],
                'default' => [
                    'items' => $header_builder_items['mobile_drawer'],
                    'Left align side' => [
                        'logo' => esc_html__('Logo', 'corpix'),
                        'menu' => esc_html__('Menu', 'corpix'),
                        'item_search' => esc_html__('Search', 'corpix'),
                    ],
                ],
            ],
            [
                'id' => 'mobile_header_bar_html1_editor',
                'title' => esc_html__('HTML Element 1 Editor', 'corpix'),
                'type' => 'ace_editor',
                'required' => ['mobile_header', '=', '1'],
                'mode' => 'html',
                'default' => '',
            ],
            [
                'id' => 'mobile_header_bar_html2_editor',
                'title' => esc_html__('HTML Element 2 Editor', 'corpix'),
                'type' => 'ace_editor',
                'required' => ['mobile_header', '=', '1'],
                'mode' => 'html',
                'default' => '',
            ],
            [
                'id' => 'mobile_header_bar_html3_editor',
                'title' => esc_html__('HTML Element 3 Editor', 'corpix'),
                'type' => 'ace_editor',
                'required' => ['mobile_header', '=', '1'],
                'mode' => 'html',
                'default' => '',
            ],
            [
                'id' => 'mobile_header_bar_html4_editor',
                'title' => esc_html__('HTML Element 4 Editor', 'corpix'),
                'type' => 'ace_editor',
                'required' => ['mobile_header', '=', '1'],
                'mode' => 'html',
                'default' => '',
            ],
            [
                'id' => 'mobile_header_bar_html5_editor',
                'title' => esc_html__('HTML Element 5 Editor', 'corpix'),
                'type' => 'ace_editor',
                'required' => ['mobile_header', '=', '1'],
                'mode' => 'html',
                'default' => '',
            ],
            [
                'id' => 'mobile_header_bar_html6_editor',
                'title' => esc_html__('HTML Element 6 Editor', 'corpix'),
                'type' => 'ace_editor',
                'required' => ['mobile_header', '=', '1'],
                'mode' => 'html',
                'default' => '',
            ],
            [
                'id' => 'mobile_header_spacer1',
                'title' => esc_html__('Spacer 1 Width', 'corpix'),
                'type' => 'dimensions',
                'required' => ['mobile_header', '=', '1'],
                'height' => false,
                'width' => true,
                'default' => ['width' => 25],
            ],
            [
                'id' => 'mobile_header_spacer2',
                'title' => esc_html__('Spacer 2 Width', 'corpix'),
                'type' => 'dimensions',
                'required' => ['mobile_header', '=', '1'],
                'height' => false,
                'width' => true,
                'default' => ['width' => 25],
            ],
            [
                'id' => 'mobile_header_spacer3',
                'title' => esc_html__('Spacer 3 Width', 'corpix'),
                'type' => 'dimensions',
                'required' => ['mobile_header', '=', '1'],
                'height' => false,
                'width' => true,
                'default' => ['width' => 25],
            ],
            [
                'id' => 'mobile_header_spacer4',
                'title' => esc_html__('Spacer 4 Width', 'corpix'),
                'type' => 'dimensions',
                'required' => ['mobile_header', '=', '1'],
                'height' => false,
                'width' => true,
                'default' => ['width' => 25],
            ],
            [
                'id' => 'mobile_header_spacer5',
                'title' => esc_html__('Spacer 5 Width', 'corpix'),
                'type' => 'dimensions',
                'required' => ['mobile_header', '=', '1'],
                'height' => false,
                'width' => true,
                'default' => ['width' => 25],
            ],
            [
                'id' => 'mobile_header_spacer6',
                'title' => esc_html__('Spacer 6 Width', 'corpix'),
                'type' => 'dimensions',
                'required' => ['mobile_header', '=', '1'],
                'height' => false,
                'width' => true,
                'default' => ['width' => 25],
            ],
        ]
    ]
);

Redux::setSection(
    $theme_slug,
    [
        'id' => 'logo',
        'title' => esc_html__('Logo', 'corpix'),
        'subsection' => true,
        'required' => ['header_type', '=', 'custom'],
        'fields' => [
            [
                'id' => 'header_logo',
                'title' => esc_html__('Default Header Logo', 'corpix'),
                'type' => 'media',
            ],
            [
                'id' => 'logo_height_custom',
                'title' => esc_html__('Limit Default Logo Height', 'corpix'),
                'type' => 'switch',
                'required' => ['header_logo', '!=', ''],
                'on' => esc_html__('Yes', 'corpix'),
                'off' => esc_html__('No', 'corpix'),
                'default' => false,
            ],
            [
                'id' => 'logo_height',
                'title' => esc_html__('Default Logo Height', 'corpix'),
                'type' => 'dimensions',
                'required' => ['logo_height_custom', '=', '1'],
                'height' => true,
                'width' => false,
                'default' => ['height' => 90],
            ],
            [
                'id' => 'sticky_header_logo',
                'title' => esc_html__('Sticky Header Logo', 'corpix'),
                'type' => 'media',
            ],
            [
                'id' => 'sticky_logo_height_custom',
                'title' => esc_html__('Limit Sticky Logo Height', 'corpix'),
                'type' => 'switch',
                'required' => ['sticky_header_logo', '!=', ''],
                'on' => esc_html__('Yes', 'corpix'),
                'off' => esc_html__('No', 'corpix'),
                'default' => false,
            ],
            [
                'id' => 'sticky_logo_height',
                'title' => esc_html__('Sticky Header Logo Height', 'corpix'),
                'type' => 'dimensions',
                'required' => ['sticky_logo_height_custom', '=', '1'],
                'height' => true,
                'width' => false,
                'default' => ['height' => 90],
            ],
            [
                'id' => 'logo_mobile',
                'title' => esc_html__('Mobile Header Logo', 'corpix'),
                'type' => 'media',
            ],
            [
                'id' => 'mobile_logo_height_custom',
                'title' => esc_html__('Limit Mobile Logo Height', 'corpix'),
                'type' => 'switch',
                'required' => ['logo_mobile', '!=', ''],
                'on' => esc_html__('Yes', 'corpix'),
                'off' => esc_html__('No', 'corpix'),
                'default' => false,
            ],
            [
                'id' => 'mobile_logo_height',
                'title' => esc_html__('Mobile Logo Height', 'corpix'),
                'type' => 'dimensions',
                'required' => ['mobile_logo_height_custom', '=', '1'],
                'height' => true,
                'width' => false,
                'default' => ['height' => 60],
            ],
            [
                'id' => 'logo_mobile_menu',
                'title' => esc_html__('Mobile Menu Logo', 'corpix'),
                'type' => 'media',
            ],
            [
                'id' => 'mobile_logo_menu_height_custom',
                'title' => esc_html__('Limit Mobile Menu Logo Height', 'corpix'),
                'type' => 'switch',
                'required' => ['logo_mobile_menu', '!=', ''],
                'on' => esc_html__('Yes', 'corpix'),
                'off' => esc_html__('No', 'corpix'),
                'default' => false,
            ],
            [
                'id' => 'mobile_logo_menu_height',
                'title' => esc_html__('Mobile Menu Logo Height', 'corpix'),
                'type' => 'dimensions',
                'required' => ['mobile_logo_menu_height_custom', '=', '1'],
                'height' => true,
                'width' => false,
                'default' => ['height' => 60],
            ],
        ]
    ]
);

Redux::setSection(
    $theme_slug,
    [
        'title' => esc_html__('Page Title', 'corpix'),
        'id' => 'page_title',
        'icon' => 'el el-home-alt',
    ]
);

Redux::setSection(
    $theme_slug,
    [
        'id' => 'page_title_settings',
        'title' => esc_html__('General', 'corpix'),
        'subsection' => true,
        'fields' => [
            [
                'id' => 'page_title_switch',
                'title' => esc_html__('Use Page Titles?', 'corpix'),
                'type' => 'switch',
                'on' => esc_html__('Use', 'corpix'),
                'off' => esc_html__('Hide', 'corpix'),
                'default' => true,
            ],
            [
                'id' => 'page_title-start',
                'title' => esc_html__('Appearance', 'corpix'),
                'type' => 'section',
                'required' => ['page_title_switch', '=', '1'],
                'indent' => true,
            ],
            [
                'id' => 'page_title_bg_switch',
                'title' => esc_html__('Use Background Image/Color?', 'corpix'),
                'type' => 'switch',
                'on' => esc_html__('Use', 'corpix'),
                'off' => esc_html__('Hide', 'corpix'),
                'default' => true,
            ],
            [
                'id' => 'page_title_bg_image',
                'title' => esc_html__('Background Image/Color', 'corpix'),
                'type' => 'background',
                'required' => ['page_title_bg_switch', '=', true],
                'preview' => false,
                'preview_media' => true,
                'background-color' => true,
                'transparent' => false,
                'default' => [
                    'background-image' => '',
                    'background-repeat' => 'no-repeat',
                    'background-size' => 'cover',
                    'background-attachment' => 'scroll',
                    'background-position' => 'center bottom',
                    'background-color' => '#11386480',
                ],
            ],
            [
                'id' => 'page_title_overlay_color',
                'title' => esc_html__('Overlay Color', 'corpix'),
                'type' => 'color_rgba',
                 'required' => ['page_title_bg_switch', '=', true],
                // 'mode' => 'background',
                'default' => [
                    'color' => '#11386480',
                    'alpha' => '1',
                    'rgba' => 'rgba(17, 56, 100, 0.7)'
                ],
            ],
            [
                'id' => 'page_title_height',
                'title' => esc_html__('Min Height', 'corpix'),
                'type' => 'dimensions',
                'required' => ['page_title_bg_switch', '=', true],
                'desc' => esc_html__('Choose `0px` in order to use `min-height: auto;`', 'corpix'),
                'height' => true,
                'width' => false,
                'default' => ['height' => 615],
            ],
            [
                'id' => 'page_title_padding',
                'title' => esc_html__('Paddings Top/Bottom', 'corpix'),
                'type' => 'spacing',
                'mode' => 'padding',
                'all' => false,
                'bottom' => true,
                'top' => true,
                'left' => false,
                'right' => false,
                'default' => [
                    'padding-top' => '40',
                    'padding-bottom' => '50',
                ],
            ],
            [
                'id' => 'page_title_margin',
                'title' => esc_html__('Margin Bottom', 'corpix'),
                'type' => 'spacing',
                'mode' => 'margin',
                'all' => false,
                'bottom' => true,
                'top' => false,
                'left' => false,
                'right' => false,
                'default' => ['margin-bottom' => '100'],
            ],
            [
                'id' => 'page_title_align',
                'title' => esc_html__('Title Alignment', 'corpix'),
                'type' => 'button_set',
                'options' => [
                    'left' => esc_html__('Left', 'corpix'),
                    'center' => esc_html__('Center', 'corpix'),
                    'right' => esc_html__('Right', 'corpix'),
                ],
                'default' => 'center',
            ],
            [
                'id' => 'page_title_breadcrumbs_switch',
                'title' => esc_html__('Breadcrumbs', 'corpix'),
                'type' => 'switch',
                'on' => esc_html__('Use', 'corpix'),
                'off' => esc_html__('Hide', 'corpix'),
                'default' => true,
            ],
            [
                'id' => 'page_title_breadcrumbs_block_switch',
                'title' => esc_html__('Breadcrumbs Full Width', 'corpix'),
                'type' => 'switch',
                'required' => ['page_title_breadcrumbs_switch', '=', true],
                'on' => esc_html__('Yes', 'corpix'),
                'off' => esc_html__('No', 'corpix'),
                'default' => true,
            ],
            [
                'id' => 'page_title_breadcrumbs_align',
                'title' => esc_html__('Breadcrumbs Alignment', 'corpix'),
                'type' => 'button_set',
                'required' => ['page_title_breadcrumbs_block_switch', '=', true],
                'options' => [
                    'left' => esc_html__('Left', 'corpix'),
                    'center' => esc_html__('Center', 'corpix'),
                    'right' => esc_html__('Right', 'corpix'),
                ],
                'default' => 'center',
            ],
            [
                'id' => 'page_title_parallax',
                'title' => esc_html__('Parallax Effect', 'corpix'),
                'type' => 'switch',
                'default' => false,
            ],
            [
                'id' => 'page_title_parallax_speed',
                'title' => esc_html__('Parallax Speed', 'corpix'),
                'type' => 'spinner',
                'required' => ['page_title_parallax', '=', '1'],
                'min' => '-5',
                'max' => '5',
                'step' => '0.1',
                'default' => '0.3',
            ],
            [
                'id' => 'page_title-end',
                'type' => 'section',
                'required' => ['page_title_switch', '=', '1'],
                'indent' => false,
            ],
        ]
    ]
);

Redux::setSection(
    $theme_slug,
    [
        'id' => 'page_title_typography',
        'title' => esc_html__('Typography', 'corpix'),
        'subsection' => true,
        'fields' => [
            [
                'id' => 'page_title_font',
                'title' => esc_html__('Page Title Font', 'corpix'),
                'type' => 'custom_typography',
                'font-size' => true,
                'google' => false,
                'font-weight' => false,
                'font-family' => false,
                'font-style' => false,
                'color' => true,
                'line-height' => true,
                'font-backup' => false,
                'text-align' => false,
                'all_styles' => false,
                'default' => [
                    'font-size' => '60px',
                    'line-height' => '72px',
                    'color' => '#ffffff',
                ],
            ],
            [
                'id' => 'page_title_breadcrumbs_font',
                'title' => esc_html__('Breadcrumbs Font', 'corpix'),
                'type' => 'custom_typography',
                'font-size' => true,
                'google' => false,
                'font-weight' => false,
                'font-family' => false,
                'font-style' => false,
                'color' => true,
                'line-height' => true,
                'font-backup' => false,
                'text-align' => false,
                'all_styles' => false,
                'default' => [
                    'font-size' => '16px',
                    'color' => '#29303b',
                    'line-height' => '27px',
                ],
            ],
        ]
    ]
);

Redux::setSection(
    $theme_slug,
    [
        'title' => esc_html__('Responsive', 'corpix'),
        'id' => 'page_title_responsive',
        'subsection' => true,
        'fields' => [
            [
                'id' => 'page_title_resp_switch',
                'title' => esc_html__('Responsive Settings', 'corpix'),
                'type' => 'switch',
                'default' => true,
            ],
            [
                'id' => 'page_title_resp_resolution',
                'title' => esc_html__('Screen breakpoint', 'corpix'),
                'type' => 'slider',
                'required' => ['page_title_resp_switch', '=', '1'],
                'desc' => esc_html__('Use responsive settings on screens smaller then choosed breakpoint.', 'corpix'),
                'display_value' => 'text',
                'min' => 1,
                'max' => 1700,
                'step' => 1,
                'default' => 1200,
            ],
            [
                'id' => 'page_title_resp_padding',
                'title' => esc_html__('Page Title Paddings', 'corpix'),
                'type' => 'spacing',
                'required' => ['page_title_resp_switch', '=', '1'],
                'mode' => 'padding',
                'all' => false,
                'bottom' => true,
                'top' => true,
                'left' => false,
                'right' => false,
                'default' => [
                    'padding-top' => '90',
                    'padding-bottom' => '90',
                ],
            ],
            [
                'id' => 'page_title_resp_font',
                'title' => esc_html__('Page Title Font', 'corpix'),
                'type' => 'custom_typography',
                'required' => ['page_title_resp_switch', '=', '1'],
                'google' => false,
                'all_styles' => false,
                'font-family' => false,
                'font-style' => false,
                'font-size' => true,
                'font-weight' => false,
                'font-backup' => false,
                'line-height' => true,
                'text-align' => false,
                'color' => true,
                'default' => [
                    'font-size' => '32px',
                    'line-height' => '40px',
                    'color' => '#ffffff',
                ],
            ],
            [
                'id' => 'page_title_resp_breadcrumbs_switch',
                'title' => esc_html__('Breadcrumbs', 'corpix'),
                'type' => 'switch',
                'required' => ['page_title_resp_switch', '=', '1'],
                'default' => true,
            ],
            [
                'id' => 'page_title_resp_breadcrumbs_font',
                'title' => esc_html__('Breadcrumbs Font', 'corpix'),
                'type' => 'custom_typography',
                'required' => ['page_title_resp_breadcrumbs_switch', '=', '1'],
                'google' => false,
                'all_styles' => false,
                'font-family' => false,
                'font-style' => false,
                'font-size' => true,
                'font-weight' => false,
                'font-backup' => false,
                'line-height' => true,
                'text-align' => false,
                'color' => true,
                'default' => [
                    'font-size' => '14',
                    'color' => '#ffffff',
                    'line-height' => '24px',
                ],
            ],

        ]
    ]
);

Redux::setSection(
    $theme_slug,
    [
        'id' => 'footer',
        'title' => esc_html__('Footer', 'corpix'),
        'icon' => 'fas fa-window-maximize el-rotate-180',
    ]
);

Redux::setSection(
    $theme_slug,
    [
        'id' => 'footer-general',
        'title' => esc_html__('General', 'corpix'),
        'subsection' => true,
        'fields' => [
            [
                'id' => 'footer_switch',
                'title' => esc_html__('Footer', 'corpix'),
                'type' => 'switch',
                'on' => esc_html__('Use', 'corpix'),
                'off' => esc_html__('Disable', 'corpix'),
                'default' => true,
            ],
            [
                'id' => 'footer-start',
                'title' => esc_html__('Footer Settings', 'corpix'),
                'type' => 'section',
                'required' => ['footer_switch', '=', '1'],
                'indent' => true,
            ],
            [
                'id' => 'footer_content_type',
                'title' => esc_html__('Content Type', 'corpix'),
                'type' => 'select',
                'options' => [
                    'widgets' => esc_html__('Get Widgets', 'corpix'),
                    'pages' => esc_html__('Get Pages', 'corpix'),
                ],
                'default' => 'widgets',
            ],
            [
                'id' => 'footer_page_select',
                'title' => esc_html__('Page Select', 'corpix'),
                'type' => 'select',
                'required' => ['footer_content_type', '=', 'pages'],
                'data' => 'posts',
                'args' => [
                    'post_type' => 'footer',
                    'posts_per_page' => -1,
                    'orderby' => 'title',
                    'order' => 'ASC',
                ],
            ],
            [
                'id' => 'widget_columns',
                'title' => esc_html__('Columns', 'corpix'),
                'type' => 'button_set',
                'required' => ['footer_content_type', '=', 'widgets'],
                'options' => [
                    '1' => '1',
                    '2' => '2',
                    '3' => '3',
                    '4' => '4',
                ],
                'default' => '4',
            ],
            [
                'id' => 'widget_columns_2',
                'title' => esc_html__('Columns Layout', 'corpix'),
                'type' => 'image_select',
                'required' => ['widget_columns', '=', '2'],
                'options' => [
                    '6-6' => [
                        'alt' => '50-50',
                        'img' => get_template_directory_uri() . '/core/admin/img/options/50-50.png'
                    ],
                    '3-9' => [
                        'alt' => '25-75',
                        'img' => get_template_directory_uri() . '/core/admin/img/options/25-75.png'
                    ],
                    '9-3' => [
                        'alt' => '75-25',
                        'img' => get_template_directory_uri() . '/core/admin/img/options/75-25.png'
                    ],
                    '4-8' => [
                        'alt' => '33-66',
                        'img' => get_template_directory_uri() . '/core/admin/img/options/33-66.png'
                    ],
                    '8-4' => [
                        'alt' => '66-33',
                        'img' => get_template_directory_uri() . '/core/admin/img/options/66-33.png'
                    ]
                ],
                'default' => '6-6',
            ],
            [
                'id' => 'widget_columns_3',
                'title' => esc_html__('Columns Layout', 'corpix'),
                'type' => 'image_select',
                'required' => ['widget_columns', '=', '3'],
                'options' => [
                    '4-4-4' => [
                        'alt' => '33-33-33',
                        'img' => get_template_directory_uri() . '/core/admin/img/options/33-33-33.png'
                    ],
                    '3-3-6' => [
                        'alt' => '25-25-50',
                        'img' => get_template_directory_uri() . '/core/admin/img/options/25-25-50.png'
                    ],
                    '3-6-3' => [
                        'alt' => '25-50-25',
                        'img' => get_template_directory_uri() . '/core/admin/img/options/25-50-25.png'
                    ],
                    '6-3-3' => [
                        'alt' => '50-25-25',
                        'img' => get_template_directory_uri() . '/core/admin/img/options/50-25-25.png'
                    ],
                ],
                'default' => '4-4-4',
            ],
            [
                'id' => 'footer_spacing',
                'title' => esc_html__('Paddings', 'corpix'),
                'type' => 'spacing',
                'required' => ['footer_content_type', '=', 'widgets'],
                'output' => ['.tpc-footer'],
                'all' => false,
                'mode' => 'padding',
                'units' => 'px',
                'default' => [
                    'padding-top' => '50px',
                    'padding-right' => '0px',
                    'padding-bottom' => '0px',
                    'padding-left' => '0px'
                ],
            ],
            [
                'id' => 'footer_full_width',
                'title' => esc_html__('Full Width On/Off', 'corpix'),
                'type' => 'switch',
                'required' => ['footer_content_type', '=', 'widgets'],
                'default' => false,
            ],
            [
                'id' => 'footer-end',
                'type' => 'section',
                'required' => ['footer_switch', '=', '1'],
                'indent' => false,
            ],
            [
                'id' => 'footer-start-styles',
                'title' => esc_html__('Footer Styling', 'corpix'),
                'type' => 'section',
                'required' => [
                    ['footer_switch', '=', '1'],
                    ['footer_content_type', '=', 'widgets'],
                ],
                'indent' => true,
            ],
            [
                'id' => 'footer_bg_image',
                'title' => esc_html__('Background Image', 'corpix'),
                'type' => 'background',
                'required' => [
                    ['footer_switch', '=', '1'],
                    ['footer_content_type', '=', 'widgets'],
                ],
                'preview' => false,
                'preview_media' => true,
                'background-color' => false,
                'default' => [
                    'background-repeat' => 'repeat',
                    'background-size' => 'cover',
                    'background-attachment' => 'scroll',
                    'background-position' => 'center center',
                ],
            ],
            [
                'id' => 'footer_align',
                'title' => esc_html__('Content Align', 'corpix'),
                'type' => 'button_set',
                'required' => [
                    ['footer_switch', '=', '1'],
                    ['footer_content_type', '=', 'widgets'],
                ],
                'options' => [
                    'left' => esc_html__('Left', 'corpix'),
                    'center' => esc_html__('Center', 'corpix'),
                    'right' => esc_html__('Right', 'corpix'),
                ],
                'default' => 'center',
            ],
            [
                'id' => 'footer_bg_color',
                'title' => esc_html__('Background Color', 'corpix'),
                'type' => 'color',
                'required' => [
                    ['footer_switch', '=', '1'],
                    ['footer_content_type', '=', 'widgets'],
                ],
                'transparent' => false,
                'default' => '#1E2845',
            ],
            [
                'id' => 'footer_heading_color',
                'title' => esc_html__('Headings color', 'corpix'),
                'type' => 'color',
                'required' => [
                    ['footer_switch', '=', '1'],
                    ['footer_content_type', '=', 'widgets'],
                ],
                'transparent' => false,
                'default' => '#ffffff',
            ],
            [
                'id' => 'footer_text_color',
                'title' => esc_html__('Content color', 'corpix'),
                'type' => 'color',
                'required' => [
                    ['footer_switch', '=', '1'],
                    ['footer_content_type', '=', 'widgets'],
                ],
                'transparent' => false,
                'default' => '#ffffff',
            ],
            [
                'id' => 'footer_add_border',
                'title' => esc_html__('Add Border Top', 'corpix'),
                'type' => 'switch',
                'required' => [
                    ['footer_switch', '=', '1'],
                    ['footer_content_type', '=', 'widgets'],
                ],
                'default' => false,
            ],
            [
                'id' => 'footer_border_color',
                'title' => esc_html__('Border color', 'corpix'),
                'type' => 'color',
                'required' => ['footer_add_border', '=', '1'],
                'transparent' => false,
                'default' => '#e5e5e5',
            ],
            [
                'id' => 'footer-end-styles',
                'type' => 'section',
                'indent' => false,
            ],
        ]
    ]
);

Redux::setSection(
    $theme_slug,
    [
        'id' => 'footer-copyright',
        'title' => esc_html__('Copyright', 'corpix'),
        'subsection' => true,
        'fields' => [
            [
                'id' => 'copyright_switch',
                'type' => 'switch',
                'title' => esc_html__('Copyright', 'corpix'),
                'on' => esc_html__('Use', 'corpix'),
                'off' => esc_html__('Disable', 'corpix'),
                'default' => true,
            ],
            [
                'id' => 'copyright-start',
                'type' => 'section',
                'title' => esc_html__('Copyright Settings', 'corpix'),
                'indent' => true,
                'required' => ['copyright_switch', '=', '1'],
            ],
            [
                'id' => 'copyright_editor',
                'type' => 'editor',
                'title' => esc_html__('Editor', 'corpix'),
                'default' => '<p>Copyright © 2021 Corpix by <a href="https://themeforest.net/user/pixelcurve" rel="noopener noreferrer" target="_blank">Pixelcurve</a>. All Rights Reserved</p>',
                'args' => [
                    'wpautop' => false,
                    'media_buttons' => false,
                    'textarea_rows' => 2,
                    'teeny' => false,
                    'quicktags' => true,
                ],
                'required' => ['copyright_switch', '=', '1'],
            ],
            [
                'id' => 'copyright_text_color',
                'type' => 'color',
                'title' => esc_html__('Text Color', 'corpix'),
                'default' => '#9f9f9f',
                'transparent' => false,
                'required' => ['copyright_switch', '=', '1'],
            ],
            [
                'id' => 'copyright_bg_color',
                'type' => 'color',
                'title' => esc_html__('Background Color', 'corpix'),
                'default' => '#1E2845',
                'transparent' => false,
                'required' => ['copyright_switch', '=', '1'],
            ],
            [
                'id' => 'copyright_spacing',
                'type' => 'spacing',
                'title' => esc_html__('Paddings', 'corpix'),
                'mode' => 'padding',
                'left' => false,
                'right' => false,
                'all' => false,
                'default' => [
                    'padding-top' => '20',
                    'padding-bottom' => '20',
                ],
                'required' => ['copyright_switch', '=', '1'],
            ],
            [
                'id' => 'copyright-end',
                'type' => 'section',
                'indent' => false,
                'required' => ['footer_switch', '=', '1'],
            ],
        ]
    ]
);


// ==== Modern Event Candler Options Star ====== 

if (class_exists('MEC'))  {
    Redux::setSection(
        $theme_slug,
        [
            'title' => esc_html__('Modern Events Calendar', 'corpix'),
            'id' => 'mec-option',
            'icon' => 'el el-calendar',
        ]
    );

    Redux::setSection(
        $theme_slug,
        [
            'title' => esc_html__('Modern Events Calendar', 'corpix'),
            'id' => 'mec-list-option',
            'subsection' => true,
            'fields' => [

                [
                    'id' => 'enable_mec_theme_color',
                    'type' => 'switch',
                    'title' => esc_html__('Enable Theme/Plugin Color', 'corpix'),
                    'on' => esc_html__('Theme Color', 'corpix'),
                    'off' => esc_html__('Plugin Color', 'corpix'),
                    'default' => true,
                ],
               
                [
                    'id' => 'mec_layout-end',
                    'type' => 'section',
                    'indent' => false,
                ],
            ]
        ]
    );

}


// ==== Blog options start ===

Redux::setSection(
    $theme_slug,
    [
        'id' => 'blog-option',
        'title' => esc_html__('Blog', 'corpix'),
        'icon' => 'el el-bullhorn',
    ]
);

Redux::setSection(
    $theme_slug,
    [
        'id' => 'blog-list-option',
        'title' => esc_html__('Archive', 'corpix'),
        'subsection' => true,
        'fields' => [
            [
                'id' => 'blog_list_page_title-start',
                'title' => esc_html__('Page Title', 'corpix'),
                'type' => 'section',
                'required' => ['page_title_switch', '=', '1'],
                'indent' => true,
            ],
            [
                'id' => 'post_archive__page_title_bg_image',
                'title' => esc_html__('Background Image', 'corpix'),
                'type' => 'background',
                'background-color' => false,
                'preview_media' => true,
                'preview' => false,
                'default' => [
                    'background-repeat' => 'repeat',
                    'background-size' => 'cover',
                    'background-attachment' => 'scroll',
                    'background-position' => 'center center',
                ],
            ],
            [
                'id' => 'blog_list_page_title-end',
                'type' => 'section',
                'required' => ['page_title_switch', '=', '1'],
                'indent' => false,
            ],
            [
                'id' => 'blog_list_sidebar-start',
                'title' => esc_html__('Sidebar', 'corpix'),
                'type' => 'section',
                'indent' => true,
            ],
            [
                'id' => 'blog_list_sidebar_layout',
                'title' => esc_html__('Sidebar Layout', 'corpix'),
                'type' => 'image_select',
                'options' => [
                    'none' => [
                        'alt' => esc_html__('None', 'corpix'),
                        'img' => get_template_directory_uri() . '/core/admin/img/options/1col.png'
                    ],
                    'left' => [
                        'alt' => esc_html__('Left', 'corpix'),
                        'img' => get_template_directory_uri() . '/core/admin/img/options/2cl.png'
                    ],
                    'right' => [
                        'alt' => esc_html__('Right', 'corpix'),
                        'img' => get_template_directory_uri() . '/core/admin/img/options/2cr.png'
                    ]
                ],
                'default' => 'none'
            ],
            [
                'id' => 'blog_list_sidebar_def',
                'title' => esc_html__('Sidebar Template', 'corpix'),
                'type' => 'select',
                'required' => ['blog_list_sidebar_layout', '!=', 'none'],
                'data' => 'sidebars',
            ],
            [
                'id' => 'blog_list_sidebar_def_width',
                'title' => esc_html__('Sidebar Width', 'corpix'),
                'type' => 'button_set',
                'required' => ['blog_list_sidebar_layout', '!=', 'none'],
                'options' => [
                    '9' => '25%',
                    '8' => '33%',
                ],
                'default' => '8',
            ],
            [
                'id' => 'blog_list_sidebar_sticky',
                'title' => esc_html__('Sticky Sidebar', 'corpix'),
                'type' => 'switch',
                'required' => ['blog_list_sidebar_layout', '!=', 'none'],
                'default' => false,
            ],
            [
                'id' => 'blog_list_sidebar_gap',
                'title' => esc_html__('Sidebar Side Gap', 'corpix'),
                'type' => 'select',
                'required' => ['blog_list_sidebar_layout', '!=', 'none'],
                'options' => [
                    'def' => esc_html__('Default', 'corpix'),
                    '0' => '0',
                    '15' => '15',
                    '20' => '20',
                    '25' => '25',
                    '30' => '30',
                    '35' => '35',
                    '40' => '40',
                    '45' => '45',
                    '50' => '50',
                ],
                'default' => '30',
            ],
            [
                'id' => 'blog_list_sidebar-end',
                'type' => 'section',
                'indent' => false,
            ],
            [
                'id' => 'blog_list_appearance-start',
                'title' => esc_html__('Appearance', 'corpix'),
                'type' => 'section',
                'indent' => true,
            ],
            [
                'id' => 'blog_list_columns',
                'title' => esc_html__('Columns in Archive', 'corpix'),
                'type' => 'button_set',
                'options' => [
                    '12' => esc_html__('One', 'corpix'),
                    '6' => esc_html__('Two', 'corpix'),
                    '4' => esc_html__('Three', 'corpix'),
                    '3' => esc_html__('Four', 'corpix'),
                ],
                'default' => '12'
            ],
            [
                'id' => 'blog_list_likes',
                'title' => esc_html__('Likes', 'corpix'),
                'type' => 'switch',
                'on' => esc_html__('Use', 'corpix'),
                'off' => esc_html__('Hide', 'corpix'),
                'default' => false,
            ],
            [
                'id' => 'blog_list_views',
                'title' => esc_html__('Views', 'corpix'),
                'type' => 'switch',
                'on' => esc_html__('Use', 'corpix'),
                'off' => esc_html__('Hide', 'corpix'),
                'default' => false,
            ],
            [
                'id' => 'blog_list_share',
                'title' => esc_html__('Shares', 'corpix'),
                'type' => 'switch',
                'on' => esc_html__('Use', 'corpix'),
                'off' => esc_html__('Hide', 'corpix'),
                'default' => false,
            ],
            [
                'id' => 'blog_list_hide_media',
                'title' => esc_html__('Hide Media?', 'corpix'),
                'type' => 'switch',
                'on' => esc_html__('Yes', 'corpix'),
                'off' => esc_html__('No', 'corpix'),
                'default' => false,
            ],
            [
                'id' => 'blog_list_hide_title',
                'title' => esc_html__('Hide Title?', 'corpix'),
                'type' => 'switch',
                'on' => esc_html__('Yes', 'corpix'),
                'off' => esc_html__('No', 'corpix'),
                'default' => false,
            ],
            [
                'id' => 'blog_list_hide_content',
                'title' => esc_html__('Hide Content?', 'corpix'),
                'type' => 'switch',
                'on' => esc_html__('Yes', 'corpix'),
                'off' => esc_html__('No', 'corpix'),
                'default' => false,
            ],
            [
                'id' => 'blog_post_listing_content',
                'title' => esc_html__('Limit the characters amount in Content?', 'corpix'),
                'type' => 'switch',
                'required' => ['blog_list_hide_content', '=', false],
                'on' => esc_html__('Yes', 'corpix'),
                'off' => esc_html__('No', 'corpix'),
                'default' => false,
            ],
            [
                'id' => 'blog_list_letter_count',
                'title' => esc_html__('Characters amount to be displayed in Content', 'corpix'),
                'type' => 'text',
                'required' => ['blog_post_listing_content', '=', true],
                'default' => '85',
            ],
            [
                'id' => 'blog_list_read_more',
                'title' => esc_html__('Hide Read More Button?', 'corpix'),
                'type' => 'switch',
                'on' => esc_html__('Yes', 'corpix'),
                'off' => esc_html__('No', 'corpix'),
                'default' => false,
            ],
            [
                'id' => 'blog_list_meta',
                'title' => esc_html__('Hide all post-meta?', 'corpix'),
                'type' => 'switch',
                'on' => esc_html__('Yes', 'corpix'),
                'off' => esc_html__('No', 'corpix'),
                'default' => false,
            ],
            [
                'id' => 'blog_list_meta_author',
                'title' => esc_html__('Hide post-meta author?', 'corpix'),
                'type' => 'switch',
                'required' => ['blog_list_meta', '=', false],
                'on' => esc_html__('Yes', 'corpix'),
                'off' => esc_html__('No', 'corpix'),
                'default' => false,
            ],
            [
                'id' => 'blog_list_meta_comments',
                'title' => esc_html__('Hide post-meta comments?', 'corpix'),
                'type' => 'switch',
                'required' => ['blog_list_meta', '=', false],
                'on' => esc_html__('Yes', 'corpix'),
                'off' => esc_html__('No', 'corpix'),
                'default' => true,
            ],
            [
                'id' => 'blog_list_meta_categories',
                'title' => esc_html__('Hide post-meta categories?', 'corpix'),
                'type' => 'switch',
                'required' => ['blog_list_meta', '=', false],
                'on' => esc_html__('Yes', 'corpix'),
                'off' => esc_html__('No', 'corpix'),
                'default' => false,
            ],
            [
                'id' => 'blog_list_meta_date',
                'title' => esc_html__('Hide post-meta date?', 'corpix'),
                'type' => 'switch',
                'required' => ['blog_list_meta', '=', false],
                'on' => esc_html__('Yes', 'corpix'),
                'off' => esc_html__('No', 'corpix'),
                'default' => false,
            ],
            [
                'id' => 'blog_list_appearance-end',
                'type' => 'section',
                'indent' => false,
            ],
        ]
    ]
);

Redux::setSection(
    $theme_slug,
    [
        'id' => 'blog-single-option',
        'title' => esc_html__('Single', 'corpix'),
        'subsection' => true,
        'fields' => [
            [
                'id' => 'single_type_layout',
                'title' => esc_html__('Default Post Layout', 'corpix'),
                'type' => 'button_set',
                'desc' => esc_html__('Note: each Post can be separately customized within its Metaboxes section.', 'corpix'),
                'options' => [
                    '1' => esc_html__('Title First', 'corpix'),
                    '2' => esc_html__('Image First', 'corpix'),
                    '3' => esc_html__('Overlay Image', 'corpix')
                ],
                'default' => '3'
            ],
            [
                'id' => 'blog_single_page_title-start',
                'title' => esc_html__('Page Title', 'corpix'),
                'type' => 'section',
                'indent' => true,
                'required' => ['page_title_switch', '=', '1'],
            ],
            [
                'id' => 'blog_title_conditional',
                'title' => esc_html__('Page Title Text', 'corpix'),
                'type' => 'switch',
                'on' => esc_html__('Post Type Name', 'corpix'),
                'off' => esc_html__('Post Title', 'corpix'),
                'default' => true,
            ],
            [
                'id' => 'blog_single__page_title_breadcrumbs_switch',
                'title' => esc_html__('Breadcrumbs', 'corpix'),
                'type' => 'switch',
                'on' => esc_html__('Use', 'corpix'),
                'off' => esc_html__('Hide', 'corpix'),
                'default' => true,
                // 'required' => ['single_type_layout', '!=', '3'],
            ],
            [
                'id' => 'post_single__page_title_bg_switch',
                'title' => esc_html__('Use Background Image/Color?', 'corpix'),
                'type' => 'switch',
                'required' => ['single_type_layout', '!=', '3'],
                'on' => esc_html__('Use', 'corpix'),
                'off' => esc_html__('Hide', 'corpix'),
                'default' => true,
            ],
            [
                'id' => 'post_single__page_title_bg_image',
                'title' => esc_html__('Background Image/Color', 'corpix'),
                'type' => 'background',
                'required' => ['single_type_layout', '!=', '3'],
                'preview' => false,
                'preview_media' => true,
                'background-color' => true,
                'transparent' => false,
                'default' => [
                    'background-repeat' => 'repeat',
                    'background-size' => 'cover',
                    'background-attachment' => 'scroll',
                    'background-position' => 'center center',
                ],
            ],
	        [
		        'id' => 'post_single_layout_3_bg_image',
		        'type' => 'background',
		        'title' => esc_html__('Default Background', 'corpix'),
		        'preview' => false,
		        'preview_media' => true,
		        'background-color' => true,
		        'transparent' => false,
		        'background-repeat' => false,
		        'background-size' => false,
		        'background-attachment' => false,
		        'background-position' => false,
		        'default' => [
			        'background-color' => '#1E2845',
		        ],
		        'required' => ['single_type_layout', '=', '3'],
		        'desc' => esc_html__('Note: If Featured Image doesn\'t exist.', 'corpix'),
	        ],
            [
                'id' => 'single_padding_layout_3',
                'type' => 'spacing',
                'title' => esc_html__('Padding Top/Bottom', 'corpix'),
                'required' => ['single_type_layout', '=', '3'],
                'mode' => 'padding',
                'all' => false,
                'top' => true,
                'right' => false,
                'bottom' => true,
                'left' => false,
                'default' => [
                    'padding-top' => '235',
                    'padding-bottom' => '235',
                ],
            ],
            [
                'id' => 'blog_single_page_title-end',
                'type' => 'section',
                'indent' => false,
            ],
            [
                'id' => 'blog_single_sidebar-start',
                'type' => 'section',
                'title' => esc_html__('Sidebar', 'corpix'),
                'indent' => true,
            ],
            [
                'id' => 'single_sidebar_layout',
                'type' => 'image_select',
                'title' => esc_html__('Sidebar Layout', 'corpix'),
                'options' => [
                    'none' => [
                        'alt' => esc_html__('None', 'corpix'),
                        'img' => get_template_directory_uri() . '/core/admin/img/options/1col.png'
                    ],
                    'left' => [
                        'alt' => esc_html__('Left', 'corpix'),
                        'img' => get_template_directory_uri() . '/core/admin/img/options/2cl.png'
                    ],
                    'right' => [
                        'alt' => esc_html__('Right', 'corpix'),
                        'img' => get_template_directory_uri() . '/core/admin/img/options/2cr.png'
                    ]
                ],
                'default' => 'right'
            ],
            [
                'id' => 'single_sidebar_def',
                'type' => 'select',
                'title' => esc_html__('Sidebar Template', 'corpix'),
                'data' => 'sidebars',
                'default' => 'sidebar_main-sidebar',
                'required' => ['single_sidebar_layout', '!=', 'none'],
            ],
            [
                'id' => 'single_sidebar_def_width',
                'type' => 'button_set',
                'title' => esc_html__('Sidebar Width', 'corpix'),
                'options' => [
                    '9' => '25%',
                    '8' => '33%',
                ],
                'default' => '8',
                'required' => ['single_sidebar_layout', '!=', 'none'],
            ],
            [
                'id' => 'single_sidebar_sticky',
                'type' => 'switch',
                'title' => esc_html__('Sticky Sidebar', 'corpix'),
                'default' => false,
                'required' => ['single_sidebar_layout', '!=', 'none'],
            ],
            [
                'id' => 'single_sidebar_gap',
                'type' => 'select',
                'title' => esc_html__('Sidebar Side Gap', 'corpix'),
                'options' => [
                    'def' => esc_html__('Default', 'corpix'),
                    '0' => '0',
                    '15' => '15',
                    '20' => '20',
                    '25' => '25',
                    '30' => '30',
                    '35' => '35',
                    '40' => '40',
                    '45' => '45',
                    '50' => '50',
                ],
                'default' => '35',
                'required' => ['single_sidebar_layout', '!=', 'none'],
            ],
            [
                'id' => 'blog_single_sidebar-end',
                'type' => 'section',
                'indent' => false,
            ],
            [
                'id' => 'blog_single_appearance-start',
                'type' => 'section',
                'title' => esc_html__('Appearance', 'corpix'),
                'indent' => true,
            ],
            [
                'id' => 'featured_image_type',
                'type' => 'button_set',
                'title' => esc_html__('Featured Image', 'corpix'),
                'options' => [
                    'default' => esc_html__('Default', 'corpix'),
                    'off' => esc_html__('Off', 'corpix'),
                    'replace' => esc_html__('Replace', 'corpix')
                ],
                'default' => 'default'
            ],
            [
                'id' => 'featured_image_replace',
                'type' => 'media',
                'title' => esc_html__('Image To Replace On', 'corpix'),
                'required' => ['featured_image_type', '=', 'replace'],
            ],
            [
                'id' => 'single_apply_animation',
                'title' => esc_html__('Apply Animation?', 'corpix'),
                'type' => 'switch',
                'on' => esc_html__('Yes', 'corpix'),
                'off' => esc_html__('No', 'corpix'),
                'default' => true,
                'required' => ['single_type_layout', '=', '3'],
            ],
            [
                'id' => 'single_likes',
                'title' => esc_html__('Likes', 'corpix'),
                'type' => 'switch',
                'on' => esc_html__('Use', 'corpix'),
                'off' => esc_html__('Hide', 'corpix'),
                'default' => false,
            ],
            [
                'id' => 'single_views',
                'title' => esc_html__('Views', 'corpix'),
                'type' => 'switch',
                'on' => esc_html__('Use', 'corpix'),
                'off' => esc_html__('Hide', 'corpix'),
                'default' => false,
            ],
            [
                'id' => 'single_share',
                'type' => 'switch',
                'title' => esc_html__('Shares', 'corpix'),
                'on' => esc_html__('Use', 'corpix'),
                'off' => esc_html__('Hide', 'corpix'),
                'default' => false,
            ],
            [
                'id' => 'single_meta_tags',
                'title' => esc_html__('Tags', 'corpix'),
                'type' => 'switch',
                'on' => esc_html__('Use', 'corpix'),
                'off' => esc_html__('Hide', 'corpix'),
                'default' => true,
            ],
            [
                'id' => 'single_author_info',
                'title' => esc_html__('Author Info', 'corpix'),
                'type' => 'switch',
                'on' => esc_html__('Use', 'corpix'),
                'off' => esc_html__('Hide', 'corpix'),
                'default' => false,
            ],
            [
                'id' => 'single_post_navagation',
                'title' => esc_html__('Post Navigation', 'corpix'),
                'type' => 'switch',
                'on' => esc_html__('Use', 'corpix'),
                'off' => esc_html__('Hide', 'corpix'),
                'default' => true,
            ],
            [
                'id' => 'single_meta',
                'title' => esc_html__('Hide all post-meta?', 'corpix'),
                'type' => 'switch',
                'on' => esc_html__('Yes', 'corpix'),
                'off' => esc_html__('No', 'corpix'),
                'default' => false,
            ],
            [
                'id' => 'single_meta_author',
                'title' => esc_html__('Hide post-meta author?', 'corpix'),
                'type' => 'switch',
                'required' => ['single_meta', '=', false],
                'on' => esc_html__('Yes', 'corpix'),
                'off' => esc_html__('No', 'corpix'),
                'default' => false,
            ],
            [
                'id' => 'single_meta_comments',
                'title' => esc_html__('Hide post-meta comments?', 'corpix'),
                'type' => 'switch',
                'required' => ['single_meta', '=', false],
                'on' => esc_html__('Yes', 'corpix'),
                'off' => esc_html__('No', 'corpix'),
                'default' => false,
            ],
            [
                'id' => 'single_meta_categories',
                'title' => esc_html__('Hide post-meta categories?', 'corpix'),
                'type' => 'switch',
                'required' => ['single_meta', '=', false],
                'on' => esc_html__('Yes', 'corpix'),
                'off' => esc_html__('No', 'corpix'),
                'default' => false,
            ],
            [
                'id' => 'single_meta_date',
                'title' => esc_html__('Hide post-meta date?', 'corpix'),
                'type' => 'switch',
                'on' => esc_html__('Yes', 'corpix'),
                'off' => esc_html__('No', 'corpix'),
                'default' => false,
                'required' => ['single_meta', '=', false],
            ],
            [
                'id' => 'blog_single_appearance-end',
                'type' => 'section',
                'indent' => false,
            ],
        ]
    ]
);

Redux::setSection(
    $theme_slug,
    [
        'id' => 'blog-single-related-option',
        'title' => esc_html__('Related', 'corpix'),
        'subsection' => true,
        'fields' => [
            [
                'id' => 'single_related_posts',
                'title' => esc_html__('Related Posts', 'corpix'),
                'type' => 'switch',
                'default' => true,
            ],
            [
                'id' => 'blog_title_r',
                'title' => esc_html__('Related Section Title', 'corpix'),
                'type' => 'text',
                'default' => esc_html__('Related Posts', 'corpix'),
                'required' => ['single_related_posts', '=', '1'],
            ],
            [
                'id' => 'blog_cat_r',
                'title' => esc_html__('Select Categories', 'corpix'),
                'type' => 'select',
                'multi' => true,
                'data' => 'categories',
                'width' => '20%',
                'required' => ['single_related_posts', '=', '1'],
            ],
            [
                'id' => 'blog_column_r',
                'title' => esc_html__('Columns', 'corpix'),
                'type' => 'button_set',
                'options' => [
                    '12' => '1',
                    '6' => '2',
                    '4' => '3',
                    '3' => '4'
                ],
                'default' => '6',
                'required' => ['single_related_posts', '=', '1'],
            ],
            [
                'id' => 'blog_number_r',
                'title' => esc_html__('Number of Related Items', 'corpix'),
                'type' => 'text',
                'default' => '2',
                'required' => ['single_related_posts', '=', '1'],
            ],
            [
                'id' => 'blog_carousel_r',
                'title' => esc_html__('Display items in the carousel', 'corpix'),
                'type' => 'switch',
                'default' => false,
                'required' => ['single_related_posts', '=', '1'],
            ],
        ]
    ]
);


Redux::setSection(
    $theme_slug,
    [
        'title' => esc_html__('Page 404', 'corpix'),
        'id' => '404-option',
        'icon' => 'el el-error',
        'fields' => [
            [
                'id' => '404_page_type',
                'type' => 'select',
                'title' => esc_html__('Layout Building Tool', 'corpix'),
                'desc' => esc_html__('Custom Template allows create templates within Elementor environment.', 'corpix'),
                'options' => [
                    'default' => esc_html__('Default', 'corpix'),
                    'custom' => esc_html__('Custom Template', 'corpix')
                ],
                'default' => 'default',
            ],
            [
                'id' => '404_template_select',
                'type' => 'select',
                'title' => esc_html__('404 Template', 'corpix'),
                'required' => ['404_page_type', '=', 'custom'],
                'data' => 'posts',
                'desc' => sprintf(
                    '%s <a href="%s" target="_blank">%s</a> %s',
                    esc_html__('Selected Template will be used for 404 page by default. You can edit/create Template in the', 'corpix'),
                    admin_url('edit.php?post_type=elementor_library&tabs_group=library'),
                    esc_html__('Saved Templates', 'corpix'),
                    esc_html__('dashboard tab.', 'corpix')
                ),
                'args' => [
                    'post_type' => 'elementor_library',
                    'posts_per_page' => -1,
                    'orderby' => 'title',
                    'order' => 'ASC',
                ],
            ],
            [
                'id' => '404_show_header',
                'type' => 'switch',
                'title' => esc_html__('Header Section', 'corpix'),
                'required' => ['404_page_type', '=', 'default'],
                'on' => esc_html__('Use', 'corpix'),
                'off' => esc_html__('Hide', 'corpix'),
                'default' => true,
            ],
            [
                'id' => '404_page_title_switcher',
                'title' => esc_html__('Page Title Section', 'corpix'),
                'type' => 'switch',
                'required' => ['404_page_type', '=', 'default'],
                'on' => esc_html__('Use', 'corpix'),
                'off' => esc_html__('Hide', 'corpix'),
                'default' => true,
            ],
            [
                'id' => '404_page_title-start',
                'type' => 'section',
                'required' => ['404_page_title_switcher', '=', true],
                'indent' => true,
            ],
            [
                'id' => '404_custom_title_switch',
                'title' => esc_html__('Page Title Text', 'corpix'),
                'type' => 'switch',
                'required' => ['404_page_title_switcher', '=', true],
                'on' => esc_html__('Custom', 'corpix'),
                'off' => esc_html__('Default', 'corpix'),
                'default' => false,
            ],
            [
                'id' => '404_page_title_text',
                'title' => esc_html__('Custom Page Title Text', 'corpix'),
                'type' => 'text',
                'required' => ['404_custom_title_switch', '=', true],
            ],
            [
                'id' => '404_page__page_title_bg_switch',
                'title' => esc_html__('Use Background Image/Color?', 'corpix'),
                'type' => 'switch',
                'required' => ['404_page_title_switcher', '=', true],
                'on' => esc_html__('Use', 'corpix'),
                'off' => esc_html__('Hide', 'corpix'),
                'default' => true,
            ],
            [
                'id' => '404_page__page_title_bg_image',
                'title' => esc_html__('Background Image/Color', 'corpix'),
                'type' => 'background',
                'required' => ['404_page__page_title_bg_switch', '=', true],
                'preview' => false,
                'preview_media' => true,
                'background-color' => true,
                'transparent' => false,
                'default' => [
                    'background-repeat' => 'repeat',
                    'background-size' => 'cover',
                    'background-attachment' => 'scroll',
                    'background-position' => 'center center',
                ],
            ],
            [
                'id' => '404_page__page_title_height',
                'title' => esc_html__('Min Height', 'corpix'),
                'type' => 'dimensions',
                'required' => ['page_title_bg_switch', '=', true],
                'desc' => esc_html__('Choose `0px` in order to use `min-height: auto;`', 'corpix'),
                'height' => true,
                'width' => false,
                'default' => ['height' => 300],
            ],
            [
                'id' => '404_page__page_title_padding',
                'title' => esc_html__('Paddings Top/Bottom', 'corpix'),
                'type' => 'spacing',
                'mode' => 'padding',
                'all' => false,
                'top' => true,
                'bottom' => true,
                'left' => false,
                'right' => false,
            ],
            [
                'id' => '404_page__page_title_margin',
                'title' => esc_html__('Margin Bottom', 'corpix'),
                'type' => 'spacing',
                'mode' => 'margin',
                'all' => false,
                'top' => false,
                'bottom' => true,
                'left' => false,
                'right' => false,
                'default' => ['margin-bottom' => '0'],
            ],
            [
                'id' => '404_page_title-end',
                'type' => 'section',
                'indent' => false,
            ],
            [
                'id' => '404_content-start',
                'title' => esc_html__('Content Section', 'corpix'),
                'type' => 'section',
                'required' => ['404_page_type', '=', 'default'],
                'indent' => true,
            ],
            [
                'id' => '404_page_main_bg_image',
                'title' => esc_html__('Section Background Image/Color', 'corpix'),
                'type' => 'background',
                'preview' => false,
                'preview_media' => true,
                'background-color' => true,
                'transparent' => false,
                'default' => [
                    'background-repeat' => 'no-repeat',
                    'background-size' => 'cover',
                    'background-attachment' => 'scroll',
                    'background-position' => 'right top',
                    'background-color' => '#ffffff',
                ],
            ],
            [
                'id' => '404_particles',
                'title' => esc_html__('Section Particles Animation', 'corpix'),
                'type' => 'switch',
                'on' => esc_html__('Use', 'corpix'),
                'off' => esc_html__('Hide', 'corpix'),
                'default' => false,
            ],
            [
                'id' => '404_content-end',
                'type' => 'section',
                'indent' => false,
            ],
            [
                'id' => '404_show_footer',
                'title' => esc_html__('Footer Section', 'corpix'),
                'type' => 'switch',
                'required' => ['404_page_type', '=', 'default'],
                'on' => esc_html__('Use', 'corpix'),
                'off' => esc_html__('Hide', 'corpix'),
                'default' => true,
            ],
        ]
    ]
);

Redux::setSection(
    $theme_slug,
    [
        'id' => 'side_panel',
        'title' => esc_html__('Side Panel', 'corpix'),
        'icon' => 'el el-indent-left',
        'fields' => [
            [
                'id' => 'side_panel_enable',
                'title' => esc_html__('Side Panel', 'corpix'),
                'type' => 'switch',
                'on' => esc_html__('Use', 'corpix'),
                'off' => esc_html__('Disable', 'corpix'),
                'default' => false,
            ],
            [
                'id' => 'side_panel-start',
                'title' => esc_html__('Side Panel Settings', 'corpix'),
                'type' => 'section',
                'required' => ['side_panel_enable', '=', '1'],
                'indent' => true,
            ],
            [
                'id' => 'side_panel_content_type',
                'title' => esc_html__('Content Type', 'corpix'),
                'type' => 'select',
                'options' => [
                    'widgets' => esc_html__('Get Widgets', 'corpix'),
                    'pages' => esc_html__('Get Pages', 'corpix'),
                ],
                'default' => 'pages',
            ],
            [
                'id' => 'side_panel_page_select',
                'title' => esc_html__('Page Select', 'corpix'),
                'type' => 'select',
                'required' => ['side_panel_content_type', '=', 'pages'],
                'data' => 'posts',
                'args' => [
                    'post_type' => 'side_panel',
                    'posts_per_page' => -1,
                    'orderby' => 'title',
                    'order' => 'ASC',
                ],
            ],
            [
                'id' => 'side_panel_spacing',
                'title' => esc_html__('Paddings', 'corpix'),
                'type' => 'spacing',
                'output' => ['#side-panel .side-panel_sidebar'],
                'mode' => 'padding',
                'units' => 'px',
                'all' => false,
                'default' => [
                    'padding-top' => '40px',
                    'padding-right' => '50px',
                    'padding-bottom' => '40px',
                    'padding-left' => '50px',
                ],
            ],
            [
                'id' => 'side_panel_title_color',
                'title' => esc_html__('Title Color', 'corpix'),
                'type' => 'color_rgba',
                'required' => ['side_panel_content_type', '=', 'widgets'],
                'mode' => 'background',
                'default' => [
                    'color' => '#232323',
                    'alpha' => '1',
                    'rgba' => 'rgba(35,35,35,1)'
                ],
            ],
            [
                'id' => 'side_panel_text_color',
                'title' => esc_html__('Text Color', 'corpix'),
                'type' => 'color_rgba',
                'required' => ['side_panel_content_type', '=', 'widgets'],
                'mode' => 'background',
                'default' => [
                    'color' => '#cccccc',
                    'alpha' => '1',
                    'rgba' => 'rgba(204,204,204,1)'
                ],
            ],
            [
                'id' => 'side_panel_bg',
                'title' => esc_html__('Background', 'corpix'),
                'type' => 'color_rgba',
                'mode' => 'background',
                'default' => [
                    'color' => '#ffffff',
                    'alpha' => '1',
                    'rgba' => 'rgba(255,255,255,1)'
                ],
            ],
            [
                'id' => 'side_panel_text_alignment',
                'title' => esc_html__('Text Align', 'corpix'),
                'type' => 'button_set',
                'options' => [
                    'left' => esc_html__('Left', 'corpix'),
                    'center' => esc_html__('Center', 'corpix'),
                    'right' => esc_html__('Right', 'corpix'),
                ],
                'default' => 'left',
            ],
            [
                'id' => 'side_panel_width',
                'title' => esc_html__('Width', 'corpix'),
                'type' => 'dimensions',
                'width' => true,
                'height' => false,
                'default' => ['width' => 375],
            ],
            [
                'id' => 'side_panel_position',
                'title' => esc_html__('Position', 'corpix'),
                'type' => 'button_set',
                'options' => [
                    'left' => esc_html__('Left', 'corpix'),
                    'right' => esc_html__('Right', 'corpix'),
                ],
                'default' => 'right'
            ],
            [
                'id' => 'side_panel-end',
                'type' => 'section',
                'required' => ['side_panel_enable', '=', '1'],
                'indent' => false,
            ],
        ]
    ]
);

Redux::setSection(
    $theme_slug,
    [
        'id' => 'layout_options',
        'title' => esc_html__('Sidebars', 'corpix'),
        'icon' => 'el el-braille',
        'fields' => [
            [
                'id' => 'sidebars',
                'title' => esc_html__('Register Sidebars', 'corpix'),
                'type' => 'multi_text',
                'validate' => 'no_html',
                'add_text' => esc_html__('Add Sidebar', 'corpix'),
                'default' => ['Main Sidebar'],
            ],
            [
                'id' => 'sidebars-start',
                'title' => esc_html__('Sidebar Settings', 'corpix'),
                'type' => 'section',
                'indent' => true,
            ],
            [
                'id' => 'page_sidebar_layout',
                'title' => esc_html__('Page Sidebar Layout', 'corpix'),
                'type' => 'image_select',
                'options' => [
                    'none' => [
                        'alt' => esc_html__('None', 'corpix'),
                        'img' => get_template_directory_uri() . '/core/admin/img/options/1col.png'
                    ],
                    'left' => [
                        'alt' => esc_html__('Left', 'corpix'),
                        'img' => get_template_directory_uri() . '/core/admin/img/options/2cl.png'
                    ],
                    'right' => [
                        'alt' => esc_html__('Right', 'corpix'),
                        'img' => get_template_directory_uri() . '/core/admin/img/options/2cr.png'
                    ]
                ],
                'default' => 'none'
            ],
            [
                'id' => 'page_sidebar_def',
                'title' => esc_html__('Page Sidebar', 'corpix'),
                'type' => 'select',
                'data' => 'sidebars',
                'required' => ['page_sidebar_layout', '!=', 'none'],
            ],
            [
                'id' => 'page_sidebar_def_width',
                'title' => esc_html__('Page Sidebar Width', 'corpix'),
                'type' => 'button_set',
                'required' => ['page_sidebar_layout', '!=', 'none'],
                'options' => [
                    '9' => '25%',
                    '8' => '33%',
                ],
                'default' => '8',
            ],
            [
                'id' => 'page_sidebar_sticky',
                'title' => esc_html__('Sticky Sidebar', 'corpix'),
                'type' => 'switch',
                'required' => ['page_sidebar_layout', '!=', 'none'],
                'default' => false,
            ],
            [
                'id' => 'page_sidebar_gap',
                'title' => esc_html__('Sidebar Side Gap', 'corpix'),
                'type' => 'select',
                'required' => ['page_sidebar_layout', '!=', 'none'],
                'options' => [
                    'def' => esc_html__('Default', 'corpix'),
                    '0' => '0',
                    '15' => '15',
                    '20' => '20',
                    '25' => '25',
                    '30' => '30',
                    '35' => '35',
                    '40' => '40',
                    '45' => '45',
                    '50' => '50',
                ],
                'default' => '30',
            ],
            [
                'id' => 'sidebars-end',
                'type' => 'section',
                'indent' => false,
            ],
        ]
    ]
);

Redux::setSection(
    $theme_slug,
    [
        'id' => 'soc_shares',
        'title' => esc_html__('Social Shares', 'corpix'),
        'icon' => 'el el-share-alt',
        'fields' => [
            [
                'id' => 'post_shares',
                'title' => esc_html__('Share List', 'corpix'),
                'type' => 'checkbox',
                'desc' => esc_html__('Note: used only on Blog Single, Blog List and Portfolio Single pages', 'corpix'),
                'options' => [
                    'telegram' => esc_html__('Telegram', 'corpix'),
                    'reddit' => esc_html__('Reddit', 'corpix'),
                    'twitter' => esc_html__('Twitter', 'corpix'),
                    'whatsapp' => esc_html__('WhatsApp', 'corpix'),
                    'facebook' => esc_html__('Facebook', 'corpix'),
                    'pinterest' => esc_html__('Pinterest', 'corpix'),
                    'linkedin' => esc_html__('Linkedin', 'corpix'),
                ],
                'default' => [
                    'telegram' => '0',
                    'reddit' => '0',
                    'twitter' => '1',
                    'whatsapp' => '0',
                    'facebook' => '1',
                    'pinterest' => '1',
                    'linkedin' => '1',
                ]
            ],
            [
                'id' => 'page_socials-start',
                'title' => esc_html__('Page Socials', 'corpix'),
                'type' => 'section',
                'indent' => true,
            ],
            [
                'id' => 'show_soc_icon_page',
                'type' => 'switch',
                'title' => esc_html__('Page Social Shares', 'corpix'),
                'desc' => esc_html__('Social buttons are to be rendered on a left side of each page.', 'corpix'),
                'on' => esc_html__('Use', 'corpix'),
                'off' => esc_html__('Hide', 'corpix'),
                'default' => false,
            ],
            [
                'id' => 'soc_icon_style',
                'type' => 'button_set',
                'title' => esc_html__('Socials visibility', 'corpix'),
                'options' => [
                    'standard' => esc_html__('Always', 'corpix'),
                    'hovered' => esc_html__('On Hover', 'corpix'),
                ],
                'default' => 'standard',
                'required' => ['show_soc_icon_page', '=', '1'],
            ],
            [
                'id' => 'soc_icon_offset',
                'title' => esc_html__('Offset Top', 'corpix'),
                'type' => 'spacing',
                'required' => ['show_soc_icon_page', '=', '1'],
                'desc' => esc_html__('If units defined as "%" then socials will be fixed to viewport.', 'corpix'),
                'mode' => 'margin',
                'units' => ['px', '%'],
                'all' => false,
                'bottom' => false,
                'top' => true,
                'left' => false,
                'right' => false,
                'default' => [
                    'margin-top' => '250',
                    'units' => 'px'
                ],
            ],
            [
                'id' => 'soc_icon_facebook',
                'title' => esc_html__('Facebook Button', 'corpix'),
                'type' => 'switch',
                'required' => ['show_soc_icon_page', '=', '1'],
                'default' => false,
            ],
            [
                'id' => 'soc_icon_twitter',
                'title' => esc_html__('Twitter Button', 'corpix'),
                'type' => 'switch',
                'required' => ['show_soc_icon_page', '=', '1'],
                'default' => false,
            ],
            [
                'id' => 'soc_icon_linkedin',
                'title' => esc_html__('Linkedin Button', 'corpix'),
                'type' => 'switch',
                'required' => ['show_soc_icon_page', '=', '1'],
                'default' => false,
            ],
            [
                'id' => 'soc_icon_pinterest',
                'title' => esc_html__('Pinterest Button', 'corpix'),
                'type' => 'switch',
                'required' => ['show_soc_icon_page', '=', '1'],
                'default' => false,
            ],
            [
                'id' => 'soc_icon_tumblr',
                'title' => esc_html__('Tumblr Button', 'corpix'),
                'type' => 'switch',
                'required' => ['show_soc_icon_page', '=', '1'],
                'default' => false,
            ],
            [
                'id' => 'add_custom_share',
                'title' => esc_html__('Need Additional Socials?', 'corpix'),
                'type' => 'switch',
                'required' => ['show_soc_icon_page', '=', '1'],
                'on' => esc_html__('Yes', 'corpix'),
                'off' => esc_html__('No', 'corpix'),
                'default' => false,
            ],
            [
                'id' => 'share_name-1',
                'title' => esc_html__('Social 1 - Name', 'corpix'),
                'type' => 'text',
                'required' => ['add_custom_share', '=', '1'],
            ],
            [
                'id' => 'share_link-1',
                'title' => esc_html__('Social 1 - Link', 'corpix'),
                'type' => 'text',
                'required' => ['add_custom_share', '=', '1'],
            ],
            [
                'id' => 'share_icons-1',
                'title' => esc_html__('Social 1 - Icon', 'corpix'),
                'type' => 'select',
                'required' => ['add_custom_share', '=', '1'],
                'data' => 'elusive-icons',
            ],
            [
                'id' => 'share_name-2',
                'title' => esc_html__('Social 2 - Name', 'corpix'),
                'type' => 'text',
                'required' => ['add_custom_share', '=', '1'],
            ],
            [
                'id' => 'share_link-2',
                'title' => esc_html__('Social 2 - Link', 'corpix'),
                'type' => 'text',
                'required' => ['add_custom_share', '=', '1'],
            ],
            [
                'id' => 'share_icons-2',
                'title' => esc_html__('Social 2 - Icon', 'corpix'),
                'type' => 'select',
                'required' => ['add_custom_share', '=', '1'],
                'data' => 'elusive-icons',
            ],
            [
                'id' => 'share_name-3',
                'title' => esc_html__('Social 3 - Name', 'corpix'),
                'type' => 'text',
                'required' => ['add_custom_share', '=', '1'],
            ],
            [
                'id' => 'share_link-3',
                'title' => esc_html__('Social 3 - Link', 'corpix'),
                'type' => 'text',
                'required' => ['add_custom_share', '=', '1'],
            ],
            [
                'id' => 'share_icons-3',
                'title' => esc_html__('Social 3 - Icon', 'corpix'),
                'type' => 'select',
                'required' => ['add_custom_share', '=', '1'],
                'data' => 'elusive-icons',
            ],
            [
                'id' => 'share_name-4',
                'type' => 'text',
                'title' => esc_html__('Social 4 - Name', 'corpix'),
                'required' => ['add_custom_share', '=', '1'],
            ],
            [
                'id' => 'share_link-4',
                'title' => esc_html__('Social 4 - Link', 'corpix'),
                'type' => 'text',
                'required' => ['add_custom_share', '=', '1'],
            ],
            [
                'id' => 'share_icons-4',
                'type' => 'select',
                'title' => esc_html__('Social 4 - Icon', 'corpix'),
                'required' => ['add_custom_share', '=', '1'],
                'data' => 'elusive-icons',
            ],
            [
                'id' => 'share_name-5',
                'title' => esc_html__('Social 5 - Name', 'corpix'),
                'type' => 'text',
                'required' => ['add_custom_share', '=', '1'],
            ],
            [
                'id' => 'share_link-5',
                'title' => esc_html__('Social 5 - Link', 'corpix'),
                'type' => 'text',
                'required' => ['add_custom_share', '=', '1'],
            ],
            [
                'id' => 'share_icons-5',
                'title' => esc_html__('Social 5 - Icon', 'corpix'),
                'type' => 'select',
                'required' => ['add_custom_share', '=', '1'],
                'data' => 'elusive-icons',
            ],
            [
                'id' => 'share_name-6',
                'title' => esc_html__('Social 6 - Name', 'corpix'),
                'type' => 'text',
                'required' => ['add_custom_share', '=', '1'],
            ],
            [
                'id' => 'share_link-6',
                'title' => esc_html__('Social 6 - Link', 'corpix'),
                'type' => 'text',
                'required' => ['add_custom_share', '=', '1'],
            ],
            [
                'id' => 'share_icons-6',
                'title' => esc_html__('Social 6 - Icon', 'corpix'),
                'type' => 'select',
                'required' => ['add_custom_share', '=', '1'],
                'data' => 'elusive-icons',
            ],
            [
                'id' => 'page_socials-end',
                'type' => 'section',
                'indent' => false,
            ],
        ]
    ]
);

Redux::setSection(
    $theme_slug,
    [
        'id' => 'color_options_color',
        'title' => esc_html__('Color Settings', 'corpix'),
        'icon' => 'el-icon-tint',
        'fields' => [
            [
                'id' => 'theme_colors-start',
                'title' => esc_html__('Main Colors', 'corpix'),
                'type' => 'section',
                'indent' => true,
            ],
            [
                'id' => 'theme-primary-color',
                'title' => esc_html__('Primary Theme Color', 'corpix'),
                'type' => 'color',
                'validate' => 'color',
                'transparent' => false,
                'default' => '#ffa800',
            ],
            [
                'id' => 'theme-secondary-color',
                'title' => esc_html__('Secondary Theme Color', 'corpix'),
                'type' => 'color',
                'validate' => 'color',
                'transparent' => false,
                'default' => '#ffa800',
            ],
            [
                'id' => 'theme-tertiary-color',
                'title' => esc_html__('Tertiary Theme Color', 'corpix'),
                'type' => 'color',
                'validate' => 'color',
                'transparent' => false,
                'default' => '#838383',
            ],
            [
                'id' => 'body-background-color',
                'title' => esc_html__('Body Background Color', 'corpix'),
                'type' => 'color',
                'validate' => 'color',
                'transparent' => false,
                'default' => '#ffffff',
            ],
            [
                'id' => 'theme_colors-end',
                'type' => 'section',
                'indent' => false,
            ],
            [
                'id' => 'button_colors-start',
                'title' => esc_html__('Button Colors', 'corpix'),
                'type' => 'section',
                'indent' => true,
            ],
            [
                'id' => 'button-color-idle',
                'title' => esc_html__('Button Color Idle', 'corpix'),
                'type' => 'color',
                'validate' => 'color',
                'transparent' => false,
                'default' => '#ffa800',
            ],
            [
                'id' => 'button-color-hover',
                'title' => esc_html__('Button Color Hover', 'corpix'),
                'type' => 'color',
                'validate' => 'color',
                'transparent' => false,
                'default' => '#ffa800',
            ],
            [
                'id' => 'button_colors-end',
                'type' => 'section',
                'indent' => false,
            ],
        ]
    ]
);

//* ↓ Typography Config
Redux::setSection(
    $theme_slug,
    [
        'id' => 'Typography',
        'title' => esc_html__('Typography', 'corpix'),
        'icon' => 'el-icon-font',
    ]
);

$typography = [];
$main_typography = [
    [
        'id' => 'main-font',
        'title' => esc_html__('Content Font', 'corpix'),
        'color' => true,
        'line-height' => true,
        'font-size' => true,
        'subsets' => false,
        'all_styles' => true,
        'font-weight-multi' => true,
        'defs' => [
            'font-size' => '16px',
            'line-height' => '30px',
            'color' => '#666666',
            'font-family' => 'Open Sans',
            'font-weight' => '400',
            'font-weight-multi' => '600,700,800',
        ],
    ],
    [
        'id' => 'header-font',
        'title' => esc_html__('Headings Font', 'corpix'),
        'font-size' => false,
        'line-height' => false,
        'color' => true,
        'subsets' => false,
        'all_styles' => true,
        'font-weight-multi' => true,
        'defs' => [
            'google' => true,
            'color' => '#333333',
            'font-family' => 'Antonio',
            'font-weight' => '700',
            'font-weight-multi' => '700,800',
        ],
    ],
	[
		'id' => 'additional-font',
		'title' => esc_html__('Additional Font', 'corpix'),
		'font-size' => false,
		'line-height' => false,
		'subsets' => false,
		'all_styles' => true,
		'font-weight-multi' => true,
		'defs' => [
			'google' => true,
			'font-family' => 'Red Hat Display',
			'font-weight' => '700',
			'font-weight-multi' => '700, 900',
		],
	],
];
foreach ($main_typography as $key => $value) {
    array_push($typography, [
        'id' => $value['id'],
        'type' => 'custom_typography',
        'title' => $value['title'],
        'color' => $value['color'] ?? '',
        'line-height' => $value['line-height'],
        'font-size' => $value['font-size'],
        'subsets' => $value['subsets'],
        'all_styles' => $value['all_styles'],
        'font-weight-multi' => $value['font-weight-multi'] ?? '',
        'subtitle' => $value['subtitle'] ?? '',
        'google' => true,
        'font-style' => true,
        'font-backup' => false,
        'text-align' => false,
        'default' => $value['defs'],
    ]);
}

Redux::setSection(
    $theme_slug,
    [
        'id' => 'main_typography',
        'title' => esc_html__('Main Content', 'corpix'),
        'subsection' => true,
        'fields' => $typography
    ]
);

//* ↓ Menu Typography
$menu_typography = [
    [
        'id' => 'menu-font',
        'title' => esc_html__('Menu Font', 'corpix'),
        'color' => false,
        'line-height' => true,
        'font-size' => true,
        'subsets' => true,
        'defs' => [
            'google' => true,
            'font-family' => 'Antonio',
            'font-size' => '14px',
            'font-weight' => '700',
            'line-height' => '30px'
        ],
    ],
    [
        'id' => 'sub-menu-font',
        'title' => esc_html__('Submenu Font', 'corpix'),
        'color' => false,
        'line-height' => true,
        'font-size' => true,
        'subsets' => true,
        'defs' => [
            'google' => true,
            'font-family' => 'Antonio',
            'font-size' => '16px',
            'font-weight' => '600',
            'line-height' => '30px'
        ],
    ],
];
$menu_typography_array = [];
foreach ($menu_typography as $key => $value) {
    array_push($menu_typography_array, [
        'id' => $value['id'],
        'type' => 'custom_typography',
        'title' => $value['title'],
        'color' => $value['color'],
        'line-height' => $value['line-height'],
        'font-size' => $value['font-size'],
        'subsets' => $value['subsets'],
        'google' => true,
        'font-style' => true,
        'font-backup' => false,
        'text-align' => false,
        'all_styles' => false,
        'default' => $value['defs'],
    ]);
}

Redux::setSection(
    $theme_slug,
    [
        'id' => 'main_menu_typography',
        'title' => esc_html__('Menu', 'corpix'),
        'subsection' => true,
        'fields' => $menu_typography_array
    ]
);
//* ↑ menu typography

//* ↓ Headings Typography
$headings = [
    [
        'id' => 'header-h1',
        'title' => esc_html__('‹h1›', 'corpix'),
        'defs' => [
            'font-family' => 'Antonio',
            'font-size' => '40px',
            'line-height' => '50px',
            'font-weight' => '700',
            'text-transform' => 'none',
        ],
    ],
    [
        'id' => 'header-h2',
        'title' => esc_html__('‹h2›', 'corpix'),
        'defs' => [
            'font-family' => 'Antonio',
            'font-size' => '36px',
            'line-height' => '46px',
            'font-weight' => '700',
            'text-transform' => 'none',
        ],
    ],
    [
        'id' => 'header-h3',
        'title' => esc_html__('‹h3›', 'corpix'),
        'defs' => [
            'font-family' => 'Antonio',
            'font-size' => '30px',
            'line-height' => '40px',
            'font-weight' => '700',
            'text-transform' => 'none',
        ],
    ],
    [
        'id' => 'header-h4',
        'title' => esc_html__('‹h4›', 'corpix'),
        'defs' => [
            'font-family' => 'Antonio',
            'font-size' => '24px',
            'line-height' => '36px',
            'font-weight' => '700',
            'text-transform' => 'none',
        ],
    ],
    [
        'id' => 'header-h5',
        'title' => esc_html__('‹h5›', 'corpix'),
        'defs' => [
            'font-family' => 'Antonio',
            'font-size' => '20px',
            'line-height' => '32px',
            'font-weight' => '700',
            'text-transform' => 'none',
        ],
    ],
    [
        'id' => 'header-h6',
        'title' => esc_html__('‹h6›', 'corpix'),
        'defs' => [
            'font-family' => 'Antonio',
            'font-size' => '18px',
            'line-height' => '30px',
            'font-weight' => '600',
            'text-transform' => 'none',
        ],
    ],
];
$headings_array = [];
foreach ($headings as $key => $heading) {
    array_push($headings_array, [
        'id' => $heading['id'],
        'type' => 'custom_typography',
        'title' => $heading['title'],
        'google' => true,
        'font-backup' => false,
        'font-size' => true,
        'line-height' => true,
        'color' => false,
        'word-spacing' => false,
        'letter-spacing' => true,
        'text-align' => false,
        'text-transform' => true,
        'default' => $heading['defs'],
    ]);
}

Redux::setSection(
    $theme_slug,
    [
        'id' => 'main_headings_typography',
        'title' => esc_html__('Headings', 'corpix'),
        'subsection' => true,
        'fields' => $headings_array
    ]
);

if (class_exists('WooCommerce')) {
    Redux::setSection(
        $theme_slug,
        [
            'id' => 'shop-option',
            'title' => esc_html__('Shop', 'corpix'),
            'icon' => 'el-icon-shopping-cart',
            'fields' => []
        ]
    );

    Redux::setSection(
        $theme_slug,
        [
            'id' => 'shop-catalog-option',
            'title' => esc_html__('Catalog', 'corpix'),
            'subsection' => true,
            'fields' => [
                [
                    'id' => 'shop_catalog__page_title_bg_image',
                    'title' => esc_html__('Page Title Background Image', 'corpix'),
                    'type' => 'background',
                    'required' => ['page_title_switch', '=', true],
                    'preview' => false,
                    'preview_media' => true,
                    'background-color' => false,
                    'default' => [
                        'background-repeat' => 'repeat',
                        'background-size' => 'cover',
                        'background-attachment' => 'scroll',
                        'background-position' => 'center center',
                        'background-color' => '',
                    ]
                ],
                [
                    'id' => 'shop_catalog_sidebar-start',
                    'title' => esc_html__('Sidebar Settings', 'corpix'),
                    'type' => 'section',
                    'indent' => true,
                ],
                [
                    'id' => 'shop_catalog_sidebar_layout',
                    'title' => esc_html__('Sidebar Layout', 'corpix'),
                    'type' => 'image_select',
                    'options' => [
                        'none' => [
                            'alt' => esc_html__('None', 'corpix'),
                            'img' => get_template_directory_uri() . '/core/admin/img/options/1col.png'
                        ],
                        'left' => [
                            'alt' => esc_html__('Left', 'corpix'),
                            'img' => get_template_directory_uri() . '/core/admin/img/options/2cl.png'
                        ],
                        'right' => [
                            'alt' => esc_html__('Right', 'corpix'),
                            'img' => get_template_directory_uri() . '/core/admin/img/options/2cr.png'
                        ],
                    ],
                    'default' => 'left'
                ],
                [
                    'id' => 'shop_catalog_sidebar_def',
                    'title' => esc_html__('Shop Catalog Sidebar', 'corpix'),
                    'type' => 'select',
                    'required' => ['shop_catalog_sidebar_layout', '!=', 'none'],
                    'data' => 'sidebars',
                ],
                [
                    'id' => 'shop_catalog_sidebar_def_width',
                    'title' => esc_html__('Shop Sidebar Width', 'corpix'),
                    'type' => 'button_set',
                    'required' => ['shop_catalog_sidebar_layout', '!=', 'none'],
                    'options' => [
                        '9' => '25%',
                        '8' => '33%',
                    ],
                    'default' => '8',
                ],
                [
                    'id' => 'shop_catalog_sidebar_sticky',
                    'title' => esc_html__('Sticky Sidebar', 'corpix'),
                    'type' => 'switch',
                    'required' => ['shop_catalog_sidebar_layout', '!=', 'none'],
                    'default' => false,
                ],
                [
                    'id' => 'shop_catalog_sidebar_gap',
                    'title' => esc_html__('Sidebar Side Gap', 'corpix'),
                    'type' => 'select',
                    'required' => ['shop_catalog_sidebar_layout', '!=', 'none'],
                    'options' => [
                        'def' => esc_html__('Default', 'corpix'),
                        '0' => '0',
                        '15' => '15',
                        '20' => '20',
                        '25' => '25',
                        '30' => '30',
                        '35' => '35',
                        '40' => '40',
                        '45' => '45',
                        '50' => '50',
                    ],
                    'default' => '30',
                ],
                [
                    'id' => 'shop_catalog_sidebar-end',
                    'type' => 'section',
                    'indent' => false,
                ],
                [
                    'id' => 'shop_column',
                    'title' => esc_html__('Shop Column', 'corpix'),
                    'type' => 'button_set',
                    'options' => [
                        '1' => '1',
                        '2' => '2',
                        '3' => '3',
                        '4' => '4'
                    ],
                    'default' => '3',
                ],
                [
                    'id' => 'shop_products_per_page',
                    'title' => esc_html__('Products per page', 'corpix'),
                    'type' => 'spinner',
                    'min' => '1',
                    'max' => '100',
                    'default' => '12',
                ],
                [
                    'id' => 'use_animation_shop',
                    'title' => esc_html__('Use Animation Shop?', 'corpix'),
                    'type' => 'switch',
                    'default' => true,
                ],
                [
                    'id' => 'shop_catalog_animation_style',
                    'title' => esc_html__('Animation Style', 'corpix'),
                    'type' => 'select',
                    'required' => ['use_animation_shop', '=', true],
                    'select2' => ['allowClear' => false],
                    'options' => [
                        'fade-in' => esc_html__('Fade In', 'corpix'),
                        'slide-top' => esc_html__('Slide Top', 'corpix'),
                        'slide-bottom' => esc_html__('Slide Bottom', 'corpix'),
                        'slide-left' => esc_html__('Slide Left', 'corpix'),
                        'slide-right' => esc_html__('Slide Right', 'corpix'),
                        'zoom' => esc_html__('Zoom', 'corpix'),
                    ],
                    'default' => 'slide-left',
                ],
            ]
        ]
    );

    Redux::setSection(
        $theme_slug,
        [
            'id' => 'shop-single-option',
            'title' => esc_html__('Single', 'corpix'),
            'subsection' => true,
            'fields' => [
                [
                    'id' => 'shop_single_page_title-start',
                    'title' => esc_html__('Page Title Settings', 'corpix'),
                    'type' => 'section',
                    'required' => ['page_title_switch', '=', true],
                    'indent' => true,
                ],
                [
                    'id' => 'shop_title_conditional',
                    'title' => esc_html__('Page Title Text', 'corpix'),
                    'type' => 'switch',
                    'on' => esc_html__('Post Type Name', 'corpix'),
                    'off' => esc_html__('Post Title', 'corpix'),
                    'default' => true,
                ],
                [
                    'id' => 'shop_single_title_align',
                    'title' => esc_html__('Title Alignment', 'corpix'),
                    'type' => 'button_set',
                    'options' => [
                        'left' => esc_html__('Left', 'corpix'),
                        'center' => esc_html__('Center', 'corpix'),
                        'right' => esc_html__('Right', 'corpix'),
                    ],
                    'default' => 'center',
                ],
                [
                    'id' => 'shop_single_breadcrumbs_block_switch',
                    'title' => esc_html__('Breadcrumbs Display', 'corpix'),
                    'type' => 'switch',
                    'required' => ['page_title_breadcrumbs_switch', '=', true],
                    'on' => esc_html__('Block', 'corpix'),
                    'off' => esc_html__('Inline', 'corpix'),
                    'default' => true,
                ],
                [
                    'id' => 'shop_single_breadcrumbs_align',
                    'title' => esc_html__('Title Breadcrumbs Alignment', 'corpix'),
                    'type' => 'button_set',
                    'required' => [
                        ['page_title_breadcrumbs_switch', '=', true],
                        ['shop_single_breadcrumbs_block_switch', '=', true]
                    ],
                    'options' => [
                        'left' => esc_html__('Left', 'corpix'),
                        'center' => esc_html__('Center', 'corpix'),
                        'right' => esc_html__('Right', 'corpix'),
                    ],
                    'default' => 'center',
                ],
                [
                    'id' => 'shop_single__page_title_bg_switch',
                    'title' => esc_html__('Use Background Image/Color?', 'corpix'),
                    'type' => 'switch',
                    'on' => esc_html__('Use', 'corpix'),
                    'off' => esc_html__('Hide', 'corpix'),
                    'default' => true,
                ],
                [
                    'id' => 'shop_single__page_title_bg_image',
                    'title' => esc_html__('Background Image/Color', 'corpix'),
                    'type' => 'background',
                    'required' => ['shop_single__page_title_bg_switch', '=', true],
                    'preview' => false,
                    'preview_media' => true,
                    'background-color' => true,
                    'transparent' => false,
                    'default' => [
                        'background-repeat' => 'repeat',
                        'background-size' => 'cover',
                        'background-attachment' => 'scroll',
                        'background-position' => 'center center',
                        'background-color' => '',
                    ],
                ],
                [
                    'id' => 'shop_single__page_title_padding',
                    'title' => esc_html__('Paddings Top/Bottom', 'corpix'),
                    'type' => 'spacing',
                    'mode' => 'padding',
                    'all' => false,
                    'bottom' => true,
                    'top' => true,
                    'left' => false,
                    'right' => false,
                ],
                [
                    'id' => 'shop_single__page_title_margin',
                    'title' => esc_html__('Margin Bottom', 'corpix'),
                    'type' => 'spacing',
                    'mode' => 'margin',
                    'all' => false,
                    'bottom' => true,
                    'top' => false,
                    'left' => false,
                    'right' => false,
                    'default' => ['margin-bottom' => '47'],
                ],
                [
                    'id' => 'shop_single_page_title-end',
                    'type' => 'section',
                    'indent' => false,
                ],
                [
                    'id' => 'shop_single_sidebar-start',
                    'title' => esc_html__('Sidebar Settings', 'corpix'),
                    'type' => 'section',
                    'indent' => true,
                ],
                [
                    'id' => 'shop_single_sidebar_layout',
                    'title' => esc_html__('Sidebar Layout', 'corpix'),
                    'type' => 'image_select',
                    'options' => [
                        'none' => [
                            'alt' => esc_html__('None', 'corpix'),
                            'img' => get_template_directory_uri() . '/core/admin/img/options/1col.png'
                        ],
                        'left' => [
                            'alt' => esc_html__('Left', 'corpix'),
                            'img' => get_template_directory_uri() . '/core/admin/img/options/2cl.png'
                        ],
                        'right' => [
                            'alt' => esc_html__('Right', 'corpix'),
                            'img' => get_template_directory_uri() . '/core/admin/img/options/2cr.png'
                        ],
                    ],
                    'default' => 'none',
                ],
                [
                    'id' => 'shop_single_sidebar_def',
                    'title' => esc_html__('Sidebar Template', 'corpix'),
                    'type' => 'select',
                    'required' => ['shop_single_sidebar_layout', '!=', 'none'],
                    'data' => 'sidebars',
                ],
                [
                    'id' => 'shop_single_sidebar_def_width',
                    'title' => esc_html__('Sidebar Width', 'corpix'),
                    'type' => 'button_set',
                    'required' => ['shop_single_sidebar_layout', '!=', 'none'],
                    'options' => [
                        '9' => '25%',
                        '8' => '33%',
                    ],
                    'default' => '8',
                ],
                [
                    'id' => 'shop_single_sidebar_sticky',
                    'title' => esc_html__('Sticky Sidebar', 'corpix'),
                    'type' => 'switch',
                    'required' => ['shop_single_sidebar_layout', '!=', 'none'],
                    'default' => false,
                ],
                [
                    'id' => 'shop_single_sidebar_gap',
                    'title' => esc_html__('Sidebar Side Gap', 'corpix'),
                    'type' => 'select',
                    'required' => ['shop_single_sidebar_layout', '!=', 'none'],
                    'options' => [
                        'def' => esc_html__('Default', 'corpix'),
                        '0' => '0',
                        '15' => '15',
                        '20' => '20',
                        '25' => '25',
                        '30' => '30',
                        '35' => '35',
                        '40' => '40',
                        '45' => '45',
                        '50' => '50',
                    ],
                    'default' => '30',
                ],
                [
                    'id' => 'shop_single_sidebar-end',
                    'type' => 'section',
                    'indent' => false,
                ],
            ]
        ]
    );

    Redux::setSection(
        $theme_slug,
        [
            'title' => esc_html__('Related', 'corpix'),
            'id' => 'shop-related-option',
            'subsection' => true,
            'fields' => [
                [
                    'id' => 'shop_related_columns',
                    'title' => esc_html__('Related products column', 'corpix'),
                    'type' => 'button_set',
                    'options' => [
                        '1' => '1',
                        '2' => '2',
                        '3' => '3',
                        '4' => '4'
                    ],
                    'default' => '4',
                ],
                [
                    'id' => 'shop_r_products_per_page',
                    'title' => esc_html__('Related products per page', 'corpix'),
                    'type' => 'spinner',
                    'min' => '1',
                    'max' => '100',
                    'default' => '4',
                ],
            ]
        ]
    );

    Redux::setSection(
        $theme_slug,
        [
            'title' => esc_html__('Cart', 'corpix'),
            'id' => 'shop-cart-option',
            'subsection' => true,
            'fields' => [
                [
                    'id' => 'shop_cart__page_title_bg_image',
                    'title' => esc_html__('Page Title Background Image', 'corpix'),
                    'type' => 'background',
                    'required' => ['page_title_switch', '=', true],
                    'background-color' => false,
                    'preview_media' => true,
                    'preview' => false,
                    'default' => [
                        'background-repeat' => 'repeat',
                        'background-size' => 'cover',
                        'background-attachment' => 'scroll',
                        'background-position' => 'center center',
                        'background-color' => '',
                    ],
                ],
            ]
        ]
    );

    Redux::setSection(
        $theme_slug,
        [
            'id' => 'shop-checkout-option',
            'title' => esc_html__('Checkout', 'corpix'),
            'subsection' => true,
            'fields' => [
                [
                    'id' => 'shop_checkout__page_title_bg_image',
                    'title' => esc_html__('Page Title Background Image', 'corpix'),
                    'type' => 'background',
                    'required' => ['page_title_switch', '=', true],
                    'background-color' => false,
                    'preview_media' => true,
                    'preview' => false,
                    'default' => [
                        'background-repeat' => 'repeat',
                        'background-size' => 'cover',
                        'background-attachment' => 'scroll',
                        'background-position' => 'center center',
                        'background-color' => '',
                    ],
                ],
            ]
        ]
    );
}

$advanced_fields = [
    [
        'id' => 'advanced_warning',
        'title' => esc_html__('Attention! This tab stores functionality that can harm site reliability.', 'corpix'),
        'type' => 'info',
        'desc' => esc_html__('Site troublefree operation is not ensured, if any of the following options is changed.', 'corpix'),
        'style' => 'critical',
        'icon' => 'el el-warning-sign',
    ],
    [
        'id'   =>'advanced_divider',
        'type' => 'divide'
    ],
    [
        'id' => 'advanced-wp-start',
        'title' => esc_html__('WordPress', 'corpix'),
        'type' => 'section',
        'indent' => true,
    ],
    [
        'id' => 'disable_wp_gutenberg',
        'title' => esc_html__('Gutenberg Stylesheet', 'corpix'),
        'type' => 'switch',
        'desc' => esc_html__('Dequeue CSS files.', 'corpix') . corpix_quick_tip(
            strip_tags(__('Eliminates <code>wp-block-library-css</code> stylesheet. <br>Before disabling ensure that Gutenberg editor is not used anywhere throughout the site.', 'corpix'), '<code><br>')
        ),
        'on' => esc_html__('Dequeue', 'corpix'),
        'off' => esc_html__('Default', 'corpix'),
    ],
    [
        'id' => 'advanced-wp-end',
        'type' => 'section',
        'indent' => false,
    ],
];

if (class_exists('Elementor\Plugin')) {
    $advanced_elementor = [
        [
            'id' => 'advanced-elementor-start',
            'title' => esc_html__('Elementor', 'corpix'),
            'type' => 'section',
            'indent' => true,
        ],
        [
            'id' => 'disable_elementor_googlefonts',
            'title' => esc_html__('Google Fonts', 'corpix'),
            'type' => 'switch',
            'desc' => esc_html__('Dequeue font pack.', 'corpix') . corpix_quick_tip(sprintf(
                '%s <a href="%s" target="_blank">%s</a>%s',
                esc_html__('See: ', 'corpix'),
                esc_url('https://docs.elementor.com/article/286-speed-up-a-slow-site'),
                esc_html__('Optimizing a Slow Site w/ Elementor', 'corpix'),
                strip_tags(__('<br>Note: breaks all fonts selected within <code>Group_Control_Typography</code> (if any). Has no affect on <code>Theme Options->Typography</code> fonts.', 'corpix'), '<br><code>')
            )),
            'on' => esc_html__('Disable', 'corpix'),
            'off' => esc_html__('Default', 'corpix'),
        ],
        [
            'id' => 'disable_elementor_fontawesome',
            'title' => esc_html__('Font Awesome Pack', 'corpix'),
            'type' => 'switch',
            'desc' => esc_html__('Dequeue icon pack.', 'corpix')
                . corpix_quick_tip(esc_html__('Note: Font Awesome is essential for Corpix theme. Disable only if it already enqueued by some other plugin.', 'corpix')),
            'on' => esc_html__('Disable', 'corpix'),
            'off' => esc_html__('Default', 'corpix'),
        ],
        [
            'id' => 'advanced-elelemntor-end',
            'type' => 'section',
            'indent' => false,
        ],
    ];
    array_push($advanced_fields, ...$advanced_elementor);
}

Redux::setSection(
    $theme_slug,
    [
        'id' => 'advanced',
        'title' => esc_html__('Advanced', 'corpix'),
        'icon' => 'el el-warning-sign',
        'fields' => $advanced_fields
    ]
);
