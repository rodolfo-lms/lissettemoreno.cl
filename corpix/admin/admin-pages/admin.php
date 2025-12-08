<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}
global $pagenow;

function corpix_welcome_page(){
   require_once 'tpc-welcome.php';
}

function corpix_theme_active_page(){
   require_once 'tpc-theme-active.php';
}

// function corpix_theme_plugins_page(){
//    require_once 'tpc-theme-plugins.php';
// }

function corpix_help_center_page(){
   require_once 'tpc-help-center.php';
}

function corpix_requirements_page(){
   require_once 'tpc-requirements.php';
}

function corpix_admin_menu(){
    if ( current_user_can( 'edit_theme_options' ) ) {

        add_menu_page( 'Corpix', 'Corpix', 'administrator', 'corpix-admin-menu', 'corpix_welcome_page', get_template_directory_uri() . '/img/admin_icon.png', 2 );

        add_submenu_page( 'corpix-admin-menu', 'corpix', esc_html__('Welcome','corpix'), 'administrator', 'corpix-admin-menu', 'corpix_welcome_page' );

        add_submenu_page( 'corpix-admin-menu', 'corpix', esc_html__('Activate Theme','corpix'), 'administrator', 'corpix-theme-active', 'corpix_theme_active_page' );

        add_submenu_page('corpix-admin-menu', '', 'Theme Options', 'manage_options', 'admin.php?page=tpc-theme-options-panel' );

        if (class_exists('OCDI_Plugin')):
           add_submenu_page( 'corpix-admin-menu', esc_html__( 'Demo Import', 'corpix' ), esc_html__( 'Demo Import', 'corpix' ), 'administrator', 'demo_install', 'demo_install_function' );
       endif;
      // add_submenu_page( 'corpix-admin-menu', 'corpix', esc_html__('Theme Plugins','corpix'), 'administrator', 'corpix-theme-plugins', 'corpix_theme_plugins_page' );      

      add_submenu_page( 'corpix-admin-menu', 'corpix', esc_html__('Requirements','corpix'), 'administrator', 'corpix-requirements', 'corpix_requirements_page' );

      add_submenu_page( 'corpix-admin-menu', 'corpix', esc_html__('Help Center','corpix'), 'administrator', 'corpix-help-center', 'corpix_help_center_page' );

   }

}

add_action( 'admin_menu', 'corpix_admin_menu' );

function demo_install_function(){
    ?>
    <script>location.href='<?php echo esc_url(admin_url().'themes.php?page=pt-one-click-demo-import');?>';</script>
    <?php
}

if ( is_admin() && 'themes.php' == $pagenow && isset( $_GET['activated'] ) ) {

  wp_redirect(admin_url("admin.php?page=corpix-admin-menu"));
  
}









