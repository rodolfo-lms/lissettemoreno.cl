<?php

/**
 * Load Theme Dependencies
 */
require_once get_theme_file_path('/core/class/theme-dependencies.php');

/**
 * Sequence of theme specific actions
 */

add_action('after_setup_theme', function() {
    $content_width = $content_width ?? 940;
}, 0);

add_action('after_setup_theme', function() {
    add_theme_support('title-tag');
});

add_action('init', function() {
    add_post_type_support('page', 'excerpt');
});

/** Add a pingback url auto-discovery for single posts, pages or attachments. */
add_action('wp_head', function() {
    if (is_singular() && pings_open()) {
        echo '<link rel="pingback" href="', esc_url(get_bloginfo('pingback_url')), '">';
    }
});

/**
 * Sequence of theme specific filters
 */

add_filter('corpix/header/enable', 'corpix_header_enable');

add_filter('corpix/page_title/enable', 'corpix_page_title_enable');

add_filter('corpix/footer/enable', 'corpix_footer_enable');

add_action('corpix/preloader', 'Corpix_Theme_Helper::preloader');

add_action('corpix/after_main_content', 'corpix_after_main_content');

add_filter('comment_form_fields', 'corpix_comment_form_fields');

add_filter('mce_buttons_2', function($buttons) {
	array_unshift($buttons, 'styleselect');
    return $buttons;
});

add_filter('tiny_mce_before_init', 'corpix_tiny_mce_before_init');

add_action('current_screen', function() {
    add_editor_style('css/font-awesome-5.min.css');
});

add_filter('wp_list_categories', 'corpix_categories_postcount_filter');
add_filter('woocommerce_layered_nav_term_html', 'corpix_categories_postcount_filter');

add_filter('get_archives_link', 'corpix_render_archive_widgets', 10, 6);

add_filter('corpix/enqueue_shortcode_css', function($styles) {
    global $corpix_dynamic_css;
    if (!isset($corpix_dynamic_css['style'])) {
        $corpix_dynamic_css = [];
        $corpix_dynamic_css['style'] = $styles;
    } else {
        $corpix_dynamic_css['style'] .= $styles;
    }
});

/* Add Custom Image Link field to media uploader for TPC Gallery module */
add_filter('attachment_fields_to_edit', function($form_fields, $post) {
    $form_fields['custom_image_link'] = array(
        'label' => esc_html__('Custom Image Link','corpix'),
        'input' => 'text',
        'value' => get_post_meta($post->ID, 'custom_image_link', true),
        'helps' => esc_html__('This option works only for the TPC Gallery module.','corpix'),
    );

    return $form_fields;
}, 10, 2);

/* Save values of Custom Image Link in media uploader */
add_filter('attachment_fields_to_save', function ($post, $attachment) {
    if (isset($attachment['custom_image_link']))
    update_post_meta($post['ID'], 'custom_image_link', $attachment['custom_image_link']);

    return $post;
}, 10, 2);


