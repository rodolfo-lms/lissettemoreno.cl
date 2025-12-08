<?php

defined('ABSPATH') || exit;

use Corpix_Theme_Helper as Corpix;

/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package corpix
 * @since 1.0.0
 */

get_header();
the_post();

$sb = Corpix::get_sidebar_data();
$row_class = $sb['row_class'] ?? '';
$column = $sb['column'] ?? '';
$container_class = $sb['container_class'] ?? '';

// Render
echo '<div class="tpc-container', apply_filters('corpix/container/class', esc_attr( $container_class )), '">';
echo '<div class="row ', apply_filters('corpix/row/class', esc_attr( $row_class )), '">';

    echo '<div id="main-content" class="tpc_col-', apply_filters('corpix/column/class', esc_attr( $column )), '">';

        the_content(esc_html__('Read more!', 'corpix'));

        // Pagination
        wp_link_pages(Corpix::pagination_wrapper());

        // Comments
        if (comments_open() || get_comments_number()) {
            comments_template();
        }

    echo '</div>';

    if ($sb) {
        Corpix::render_sidebar($sb);
    }

echo '</div>';
echo '</div>';

get_footer();
