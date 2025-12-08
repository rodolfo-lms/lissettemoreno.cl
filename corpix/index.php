<?php

defined('ABSPATH') || exit;

use Corpix_Theme_Helper as Corpix;

/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package corpix
 * @since 1.0.0
 */

get_header();

$sb = Corpix::get_sidebar_data();
$container_class = $sb['container_class'] ?? '';
$row_class = $sb['row_class'] ?? '';
$column = $sb['column'] ?? '';

// Render
echo '<div class="tpc-container', apply_filters('corpix/container/class', esc_attr( $container_class )), '">';
echo '<div class="row', apply_filters('corpix/row/class', esc_attr( $row_class )), '">';

    echo '<div id="main-content" class="tpc_col-', apply_filters('corpix/column/class', esc_attr( $column )), '">';

        // Blog Archive Template
        get_template_part('templates/post/posts-list');

        // Pagination
        echo Corpix::pagination();

    echo '</div>';

    if ($sb) {
        Corpix::render_sidebar($sb);
    }

echo '</div>';
echo '</div>';

get_footer();
