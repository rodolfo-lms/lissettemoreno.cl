<?php

if (!class_exists('RWMB_Loader')) return;

use TPCAddons\Corpix_Global_Variables as Corpix_Globals;

class Corpix_Metaboxes
{
    public function __construct()
    {

        // Blog Fields Metaboxes
        add_filter('rwmb_meta_boxes', [$this, 'blog_settings_meta_boxes']);
        add_filter('rwmb_meta_boxes', [$this, 'blog_meta_boxes']);
        add_filter('rwmb_meta_boxes', [$this, 'blog_related_meta_boxes']);

        // Page Fields Metaboxes
        add_filter('rwmb_meta_boxes', [$this, 'page_layout_meta_boxes']);
        // Colors Fields Metaboxes
        add_filter('rwmb_meta_boxes', [$this, 'page_color_meta_boxes']);
        // Header Builder Fields Metaboxes
        add_filter('rwmb_meta_boxes', [$this, 'page_header_meta_boxes']);
        // Title Fields Metaboxes
        add_filter('rwmb_meta_boxes', [$this, 'page_title_meta_boxes']);
        // Side Panel Fields Metaboxes
        add_filter('rwmb_meta_boxes', [$this, 'page_side_panel_meta_boxes']);

        // Social Shares Fields Metaboxes
        add_filter('rwmb_meta_boxes', [$this, 'page_soc_icons_meta_boxes']);
        // Footer Fields Metaboxes
        add_filter('rwmb_meta_boxes', [$this, 'page_footer_meta_boxes']);
        // Copyright Fields Metaboxes
        add_filter('rwmb_meta_boxes', [$this, 'page_copyright_meta_boxes']);

    }

    public function blog_settings_meta_boxes($meta_boxes)
    {
        $meta_boxes[] = [
            'title' => esc_html__('Post Settings', 'corpix'),
            'post_types' => ['post', 'courses', 'lp_course', 'sfwd-courses'],
            'context' => 'advanced',
            'priority' => 'low',
            'fields' => [
                [
                    'name' => esc_html__('Post Layout Settings', 'corpix'),
                    'type' => 'tpc_heading',
                ],
                [
                    'id' => 'mb_post_layout_conditional',
                    'name' => esc_html__('Post Layout', 'corpix'),
                    'type' => 'button_group',
                    'multiple' => false,
                    'options' => [
                        'default' => esc_html__('Default', 'corpix'),
                        'custom' => esc_html__('Custom', 'corpix'),
                    ],
                    'std' => 'default',
                ],
                [
                    'id' => 'mb_single_type_layout',
                    'name' => esc_html__('Post Layout Type', 'corpix'),
                    'type' => 'button_group',
                    'attributes' => [
                        'data-conditional-logic' => [[
                            ['mb_post_layout_conditional', '=', 'custom']
                        ]],
                    ],
                    'multiple' => false,
                    'options' => [
                        '1' => esc_html__('Title First', 'corpix'),
                        '2' => esc_html__('Image First', 'corpix'),
                        '3' => esc_html__('Overlay Image', 'corpix'),
                    ],
                    'std' => '1',
                ],
                [
                    'id' => 'mb_single_padding_layout_3',
                    'name' => esc_html__('Padding Top/Bottom', 'corpix'),
                    'type' => 'tpc_offset',
                    'attributes' => [
                        'data-conditional-logic' => [[
                            ['mb_post_layout_conditional', '=', 'custom'],
                            ['mb_single_type_layout', '=', '3'],
                        ]],
                    ],
                    'options' => [
                        'mode' => 'padding',
                        'top' => true,
                        'right' => false,
                        'bottom' => true,
                        'left' => false,
                    ],
                    'std' => [
                        'padding-top' => esc_attr(\Corpix_Theme_Helper::get_option('single_padding_layout_3')['padding-top']),
                        'padding-bottom' => esc_attr(\Corpix_Theme_Helper::get_option('single_padding_layout_3')['padding-bottom']),
                    ],
                ],
                [
                    'id' => 'mb_single_apply_animation',
                    'name' => esc_html__('Apply Animation', 'corpix'),
                    'type' => 'switch',
                    'attributes' => [
                        'data-conditional-logic' => [[
                            ['mb_post_layout_conditional', '=', 'custom'],
                            ['mb_single_type_layout', '=', '3'],
                        ]],
                    ],
                    'std' => 1,
                ],
                [
                    'name' => esc_html__('Featured Image Settings', 'corpix'),
                    'type' => 'tpc_heading',
                ],
                [
                    'id' => 'mb_featured_image_conditional',
                    'name' => esc_html__('Featured Image', 'corpix'),
                    'type' => 'button_group',
                    'multiple' => false,
                    'options' => [
                        'default' => esc_html__('Default', 'corpix'),
                        'custom' => esc_html__('Custom', 'corpix'),
                    ],
                    'std' => 'default',
                ],
                [
                    'id' => 'mb_featured_image_type',
                    'name' => esc_html__('Featured Image Settings', 'corpix'),
                    'type' => 'button_group',
                    'attributes' => [
                        'data-conditional-logic' => [[
                            ['mb_featured_image_conditional', '=', 'custom']
                        ]],
                    ],
                    'multiple' => false,
                    'options' => [
                        'off' => esc_html__('Off', 'corpix'),
                        'replace' => esc_html__('Replace', 'corpix'),
                    ],
                    'std' => 'off',
                ],
                [
                    'id' => 'mb_featured_image_replace',
                    'name' => esc_html__('Featured Image Replace', 'corpix'),
                    'type' => 'image_advanced',
                    'attributes' => [
                        'data-conditional-logic' => [[
                            ['mb_featured_image_conditional', '=', 'custom'],
                            ['mb_featured_image_type', '=', 'replace'],
                        ]],
                    ],
                    'max_file_uploads' => 1,
                ],
            ],
        ];
        return $meta_boxes;
    }

    public function blog_meta_boxes($meta_boxes)
    {
        $meta_boxes[] = [
            'title' => esc_html__('Post Format Layout', 'corpix'),
            'post_types' => ['post'],
            'context' => 'advanced',
            'fields' => [
                // Standard Post Format
                [
                    'id' => 'post_format_standard',
                    'name' => esc_html__('Standard Post( Enabled only Featured Image for this post format)', 'corpix'),
                    'type' => 'static-text',
                    'attributes' => [
                        'data-conditional-logic' => [[
                            ['formatdiv', '=', '0']
                        ]],
                    ],
                ],
                // Gallery Post Format
                [
                    'name' => esc_html__('Gallery Settings', 'corpix'),
                    'type' => 'tpc_heading',
                ],
                [
                    'id' => 'post_format_gallery',
                    'name' => esc_html__('Add Images', 'corpix'),
                    'type' => 'image_advanced',
                    'max_file_uploads' => '',
                ],
                // Video Post Format
                [
                    'name' => esc_html__('Video Settings', 'corpix'),
                    'type' => 'tpc_heading',
                ],
                [
                    'id' => 'post_format_video_style',
                    'name' => esc_html__('Video Style', 'corpix'),
                    'type' => 'select',
                    'multiple' => false,
                    'options' => [
                        'bg_video' => esc_html__('Background Video', 'corpix'),
                        'popup' => esc_html__('Popup', 'corpix'),
                    ],
                    'std' => 'bg_video',
                ],
                [
                    'id' => 'start_video',
                    'name' => esc_html__('Start Video', 'corpix'),
                    'type' => 'number',
                    'attributes' => [
                        'data-conditional-logic' => [[
                            ['post_format_video_style', '=', 'bg_video'],
                        ]],
                    ],
                    'std' => '0',
                ],
                [
                    'id' => 'end_video',
                    'name' => esc_html__('End Video', 'corpix'),
                    'type' => 'number',
                    'attributes' => [
                        'data-conditional-logic' => [[
                            ['post_format_video_style', '=', 'bg_video'],
                        ]],
                    ],
                ],
                [
                    'id' => 'post_format_video_url',
                    'name' => esc_html__('oEmbed URL', 'corpix'),
                    'type' => 'oembed',
                ],
                // Quote Post Format
                [
                    'name' => esc_html__('Quote Settings', 'corpix'),
                    'type' => 'tpc_heading',
                ],
                [
                    'id' => 'post_format_qoute_text',
                    'name' => esc_html__('Quote Text', 'corpix'),
                    'type' => 'textarea',
                ],
                [
                    'id' => 'post_format_qoute_name',
                    'name' => esc_html__('Author Name', 'corpix'),
                    'type' => 'text',
                ],
                [
                    'id' => 'post_format_qoute_position',
                    'name' => esc_html__('Author Position', 'corpix'),
                    'type' => 'text',
                ],
                [
                    'id' => 'post_format_qoute_avatar',
                    'name' => esc_html__('Author Avatar', 'corpix'),
                    'type' => 'image_advanced',
                    'max_file_uploads' => 1,
                ],
                // Audio Post Format
                [
                    'name' => esc_html__('Audio Settings', 'corpix'),
                    'type' => 'tpc_heading',
                ],
                [
                    'id' => 'post_format_audio_url',
                    'name' => esc_html__('oEmbed URL', 'corpix'),
                    'type' => 'oembed',
                ],
                // Link Post Format
                [
                    'name' => esc_html__('Link Settings', 'corpix'),
                    'type' => 'tpc_heading',
                ],
                [
                    'id' => 'post_format_link_url',
                    'name' => esc_html__('URL', 'corpix'),
                    'type' => 'url',
                ],
                [
                    'id' => 'post_format_link_text',
                    'name' => esc_html__('Text', 'corpix'),
                    'type' => 'text',
                ],
            ]
        ];
        return $meta_boxes;
    }

    public function blog_related_meta_boxes($meta_boxes)
    {
        $meta_boxes[] = [
            'title' => esc_html__('Related Blog Post', 'corpix'),
            'post_types' => ['post'],
            'context' => 'advanced',
            'priority' => 'low',
            'fields' => [
                [
                    'id' => 'mb_blog_show_r',
                    'name' => esc_html__('Related Options', 'corpix'),
                    'type' => 'button_group',
                    'multiple' => false,
                    'options' => [
                        'default' => esc_html__('Default', 'corpix'),
                        'custom' => esc_html__('Custom', 'corpix'),
                        'off' => esc_html__('Off', 'corpix'),
                    ],
                    'std' => 'default',
                ],
                [
                    'name' => esc_html__('Related Settings', 'corpix'),
                    'type' => 'tpc_heading',
                    'attributes' => [
                        'data-conditional-logic' => [[
                            ['mb_blog_show_r', '=', 'custom']
                        ]],
                    ],
                ],
                [
                    'id' => 'mb_blog_title_r',
                    'name' => esc_html__('Title', 'corpix'),
                    'type' => 'text',
                    'attributes' => [
                        'data-conditional-logic' => [[
                            ['mb_blog_show_r', '=', 'custom']
                        ], ],
                    ],
                    'std' => esc_html__('Related Posts', 'corpix'),
                ],
                [
                    'id' => 'mb_blog_cat_r',
                    'name' => esc_html__('Categories', 'corpix'),
                    'type' => 'taxonomy_advanced',
                    'attributes' => [
                        'data-conditional-logic' => [[
                            ['mb_blog_show_r', '=', 'custom']
                        ]],
                    ],
                    'multiple' => true,
                    'taxonomy' => 'category',
                ],
                [
                    'id' => 'mb_blog_column_r',
                    'name' => esc_html__('Columns', 'corpix'),
                    'type' => 'button_group',
                    'attributes' => [
                        'data-conditional-logic' => [[
                            ['mb_blog_show_r', '=', 'custom']
                        ]],
                    ],
                    'multiple' => false,
                    'options' => [
                        '12' => esc_html__('1', 'corpix'),
                        '6' => esc_html__('2', 'corpix'),
                        '4' => esc_html__('3', 'corpix'),
                        '3' => esc_html__('4', 'corpix'),
                    ],
                    'std' => '6',
                ],
                [
                    'name' => esc_html__('Number of Related Items', 'corpix'),
                    'id' => 'mb_blog_number_r',
                    'type' => 'number',
                    'attributes' => [
                        'data-conditional-logic' => [[
                            ['mb_blog_show_r', '=', 'custom']
                        ]],
                    ],
                    'min' => 0,
                    'std' => 2,
                ],
                [
                    'id' => 'mb_blog_carousel_r',
                    'name' => esc_html__('Display items carousel for this blog post', 'corpix'),
                    'type' => 'switch',
                    'attributes' => [
                        'data-conditional-logic' => [[
                            ['mb_blog_show_r', '=', 'custom']
                        ]],
                    ],
                    'std' => 1,
                ],
            ],
        ];
        return $meta_boxes;
    }

    public function page_layout_meta_boxes($meta_boxes)
    {
        $meta_boxes[] = [
            'title' => esc_html__('Page Sidebar Layout', 'corpix'),
            'post_types' => ['page' , 'post', 'courses', 'lp_course', 'product'],
            'context' => 'advanced',
            'priority' => 'low',
            'fields' => [
                [
                    'name' => esc_html__('Page Sidebar Layout', 'corpix'),
                    'id' => 'mb_page_sidebar_layout',
                    'type' => 'tpc_image_select',
                    'options' => [
                        'default' => get_template_directory_uri() . '/core/admin/img/options/1c.png',
                        'none' => get_template_directory_uri() . '/core/admin/img/options/none.png',
                        'left' => get_template_directory_uri() . '/core/admin/img/options/2cl.png',
                        'right' => get_template_directory_uri() . '/core/admin/img/options/2cr.png',
                    ],
                    'std' => 'default',
                ],
                [
                    'name' => esc_html__('Sidebar Settings', 'corpix'),
                    'type' => 'tpc_heading',
                    'attributes' => [
                        'data-conditional-logic' => [[
                            ['mb_page_sidebar_layout', '!=', 'default'],
                            ['mb_page_sidebar_layout', '!=', 'none'],
                        ]],
                    ],
                ],
                [
                    'id' => 'mb_page_sidebar_def',
                    'name' => esc_html__('Page Sidebar', 'corpix'),
                    'type' => 'select',
                    'attributes' => [
                        'data-conditional-logic' => [[
                            ['mb_page_sidebar_layout', '!=', 'default'],
                            ['mb_page_sidebar_layout', '!=', 'none'],
                        ]],
                    ],
                    'placeholder' => esc_html__('Select a Sidebar', 'corpix'),
                    'multiple' => false,
                    'options' => corpix_get_all_sidebars(),
                ],
                [
                    'id' => 'mb_page_sidebar_def_width',
                    'name' => esc_html__('Page Sidebar Width', 'corpix'),
                    'type' => 'button_group',
                    'attributes' => [
                        'data-conditional-logic' => [[
                            ['mb_page_sidebar_layout', '!=', 'default'],
                            ['mb_page_sidebar_layout', '!=', 'none'],
                        ]],
                    ],
                    'multiple' => false,
                    'options' => [
                        '9' => esc_html('25%'),
                        '8' => esc_html('33%'),
                    ],
                    'std' => '8',
                ],
                [
                    'id' => 'mb_sticky_sidebar',
                    'name' => esc_html__('Sticky Sidebar On?', 'corpix'),
                    'type' => 'switch',
                    'attributes' => [
                        'data-conditional-logic' => [[
                            ['mb_page_sidebar_layout', '!=', 'default'],
                            ['mb_page_sidebar_layout', '!=', 'none'],
                        ]],
                    ],
                ],
                [
                    'id' => 'mb_sidebar_gap',
                    'name' => esc_html__('Sidebar Side Gap', 'corpix'),
                    'type' => 'select',
                    'attributes' => [
                        'data-conditional-logic' => [[
                            ['mb_page_sidebar_layout', '!=', 'default'],
                            ['mb_page_sidebar_layout', '!=', 'none'],
                        ]],
                    ],
                    'multiple' => false,
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
                    'std' => '30',
                ],
            ]
        ];
        return $meta_boxes;
    }

    public function page_color_meta_boxes($meta_boxes)
    {
        $meta_boxes[] = [
            'title' => esc_html__('Page Colors', 'corpix'),
            'post_types' => ['page' , 'post', 'practice', 'courses'],
            'context' => 'advanced',
            'priority' => 'low',
            'fields' => [
                [
                    'id' => 'mb_page_colors_switch',
                    'name' => esc_html__('Page Colors', 'corpix'),
                    'type' => 'button_group',
                    'inline' => true,
                    'multiple' => false,
                    'options' => [
                        'default' => esc_html__('Default', 'corpix'),
                        'custom' => esc_html__('Custom', 'corpix'),
                    ],
                    'std' => 'default',
                ],
                [
                    'name' => esc_html__('Color Settings', 'corpix'),
                    'type' => 'tpc_heading',
                    'attributes' => [
                        'data-conditional-logic' => [[
                            ['mb_page_colors_switch', '=', 'custom']
                        ]],
                    ],
                ],
                [
                    'id' => 'mb_theme-primary-color',
                    'name' => esc_html__('Primary Theme Color', 'corpix'),
                    'type' => 'color',
                    'attributes' => [
                        'data-conditional-logic' => [[
                            ['mb_page_colors_switch', '=', 'custom'],
                        ]],
                    ],
                    'validate' => 'color',
                    'js_options' => [
                        'defaultColor' => Corpix_Globals::get_primary_color()
                    ],
                    'std' => Corpix_Globals::get_primary_color(),
                ],
                [
                    'id' => 'mb_theme-secondary-color',
                    'name' => esc_html__('Secondary Theme Color', 'corpix'),
                    'type' => 'color',
                    'attributes' => [
                        'data-conditional-logic' => [[
                            ['mb_page_colors_switch', '=', 'custom'],
                        ]],
                    ],
                    'validate' => 'color',
                    'js_options' => [
                        'defaultColor' => Corpix_Globals::get_secondary_color()
                    ],
                    'std' => Corpix_Globals::get_secondary_color(),
                ],
                [
                    'id' => 'mb_theme-tertiary-color',
                    'name' => esc_html__('Tertiary Theme Color', 'corpix'),
                    'type' => 'color',
                    'attributes' => [
                        'data-conditional-logic' => [[
                            ['mb_page_colors_switch', '=', 'custom'],
                        ]],
                    ],
                    'validate' => 'color',
                    'js_options' => [
                        'defaultColor' => Corpix_Globals::get_tertiary_color()
                    ],
                    'std' => Corpix_Globals::get_tertiary_color(),
                ],
                [
                    'id' => 'mb_body_background_color',
                    'name' => esc_html__('Body Background Color', 'corpix'),
                    'type' => 'color',
                    'attributes' => [
                        'data-conditional-logic' => [[
                            ['mb_page_colors_switch', '=', 'custom'],
                        ]],
                    ],
                    'validate' => 'color',
                    'js_options' => ['defaultColor' => '#ffffff'],
                    'std' => '#ffffff',
                ],
                [
                    'id' => 'mb_button-color-idle',
                    'name' => esc_html__('Button Idle Color', 'corpix'),
                    'type' => 'color',
                    'attributes' => [
                        'data-conditional-logic' => [[
                            ['mb_page_colors_switch', '=', 'custom'],
                        ]],
                    ],
                    'validate' => 'color',
                    'js_options' => [
                        'defaultColor' => esc_attr(\Corpix_Theme_Helper::get_option('button-color-idle'))
                    ],
                    'std' => esc_attr(\Corpix_Theme_Helper::get_option('button-color-idle')),
                ],
                [
                    'id' => 'mb_button-color-hover',
                    'name' => esc_html__('Button Hover Color', 'corpix'),
                    'type' => 'color',
                    'attributes' => [
                        'data-conditional-logic' => [[
                            ['mb_page_colors_switch', '=', 'custom'],
                        ]],
                    ],
                    'validate' => 'color',
                    'js_options' => [
                        'defaultColor' => esc_attr(\Corpix_Theme_Helper::get_option('button-color-hover'))
                    ],
                    'std' => esc_attr(\Corpix_Theme_Helper::get_option('button-color-hover')),
                ],
                [
                    'name' => esc_html__('Scroll Up Settings', 'corpix'),
                    'type' => 'tpc_heading',
                    'attributes' => [
                        'data-conditional-logic' => [[
                            ['mb_page_colors_switch', '=', 'custom']
                        ]],
                    ],
                ],
                [
                    'id' => 'mb_scroll_up_bg_color',
                    'name' => esc_html__('Button Background Color', 'corpix'),
                    'type' => 'color',
                    'attributes' => [
                        'data-conditional-logic' => [[
                            ['mb_page_colors_switch', '=', 'custom'],
                        ]],
                    ],
                    'validate' => 'color',
                    'js_options' => ['defaultColor' => '#ff9e21'],
                    'std' => '#ff9e21',
                ],
                [
                    'id' => 'mb_scroll_up_arrow_color',
                    'name' => esc_html__('Button Arrow Color', 'corpix'),
                    'type' => 'color',
                    'attributes' => [
                        'data-conditional-logic' => [[
                            ['mb_page_colors_switch', '=', 'custom'],
                        ]],
                    ],
                    'validate' => 'color',
                    'js_options' => ['defaultColor' => '#ffffff'],
                    'std' => '#ffffff',
                ],
            ]
        ];
        return $meta_boxes;
    }

    public function page_header_meta_boxes($meta_boxes)
    {
        $meta_boxes[] = [
            'title' => esc_html__('Header', 'corpix'),
            'post_types' => ['page', 'post', 'courses', 'lp_course', 'sfwd-courses', 'product'],
            'context' => 'advanced',
            'priority' => 'low',
            'fields' => [
                [
                    'id' => 'mb_customize_header_layout',
                    'name' => esc_html__('Header Settings', 'corpix'),
                    'type' => 'button_group',
                    'multiple' => false,
                    'options' => [
                        'default' => esc_html__('default', 'corpix'),
                        'custom' => esc_html__('custom', 'corpix'),
                        'hide' => esc_html__('hide', 'corpix'),
                    ],
                    'std' => 'default',
                ],
                [
                    'id' => 'mb_header_content_type',
                    'name' => esc_html__('Header Template', 'corpix'),
                    'type' => 'button_group',
                    'attributes' => [
                        'data-conditional-logic' => [[
                            ['mb_customize_header_layout', '=', 'custom']
                        ]],
                    ],
                    'multiple' => false,
                    'options' => [
                        'default' => esc_html__('Default', 'corpix'),
                        'custom' => esc_html__('Custom', 'corpix')
                    ],
                    'std' => 'default',
                ],
                [
                    'id' => 'mb_customize_header',
                    'name' => esc_html__('Template', 'corpix'),
                    'type' => 'post',
                    'attributes' => [
                        'data-conditional-logic' => [[
                            ['mb_customize_header_layout', '=', 'custom'],
                            ['mb_header_content_type', '=', 'custom'],
                        ]],
                    ],
                    'post_type' => 'header',
                    'multiple' => false,
                    'query_args' => [
                        'post_status' => 'publish',
                        'posts_per_page' => - 1,
                    ],
                    'std' => 'default',
                ],
                [
                    'id' => 'mb_header_sticky',
                    'name' => esc_html__('Sticky Header', 'corpix'),
                    'type' => 'switch',
                    'attributes' => [
                        'data-conditional-logic' => [[
                            ['mb_customize_header_layout', '=', 'custom']
                        ]],
                    ],
                    'std' => 1,
                ],
                [
                    'id' => 'mb_sticky_header_content_type',
                    'name' => esc_html__('Sticky Header Template', 'corpix'),
                    'type' => 'button_group',
                    'attributes' => [
                        'data-conditional-logic' => [[
                            ['mb_customize_header_layout', '=', 'custom'],
                            ['mb_header_sticky', '=', '1'],
                        ]],
                    ],
                    'multiple' => false,
                    'options' => [
                        'default' => esc_html__('Default', 'corpix'),
                        'custom' => esc_html__('Custom', 'corpix')
                    ],
                    'std' => 'default',
                ],
                [
                    'id' => 'mb_customize_sticky_header',
                    'name' => esc_html__('Template', 'corpix'),
                    'type' => 'post',
                    'attributes' => [
                        'data-conditional-logic' => [[
                            ['mb_customize_header_layout', '=', 'custom'],
                            ['mb_sticky_header_content_type', '=', 'custom'],
                            ['mb_header_sticky', '=', '1'],
                        ]],
                    ],
                    'multiple' => false,
                    'post_type' => 'header',
                    'query_args' => [
                        'post_status' => 'publish',
                        'posts_per_page' => - 1,
                    ],
                    'std' => 'default',
                ],
                [
                    'id' => 'mb_mobile_menu_custom',
                    'name' => esc_html__('Mobile Menu Template', 'corpix'),
                    'type' => 'button_group',
                    'attributes' => [
                        'data-conditional-logic' => [[
                            ['mb_customize_header_layout', '=', 'custom']
                        ]],
                    ],
                    'multiple' => false,
                    'options' => [
                        'default' => esc_html__('Default', 'corpix'),
                        'custom' => esc_html__('Custom', 'corpix')
                    ],
                    'std' => 'default',
                ],
                [
                    'id' => 'mb_mobile_menu_header',
                    'name' => esc_html__('Mobile Menu ', 'corpix'),
                    'type' => 'select',
                    'attributes' => [
                        'data-conditional-logic'  =>  [[
                            ['mb_customize_header_layout', '=', 'custom'],
                            ['mb_mobile_menu_custom', '=', 'custom']
                        ]],
                    ],
                    'multiple' => false,
                    'options' => $menus = corpix_get_custom_menu(),
                    'default' => reset($menus),
                ],
            ]
        ];
        return $meta_boxes;
    }

    public function page_title_meta_boxes($meta_boxes)
    {
        $meta_boxes[] = [
            'title' => esc_html__('Page Title', 'corpix'),
            'post_types' => ['page', 'post', 'courses', 'lp_course', 'sfwd-courses', 'product'],
            'context' => 'advanced',
            'priority' => 'low',
            'fields' => [
                [
                    'id' => 'mb_page_title_switch',
                    'name' => esc_html__('Page Title', 'corpix'),
                    'type' => 'button_group',
                    'inline' => true,
                    'multiple' => false,
                    'options' => [
                        'default' => esc_html__('Default', 'corpix'),
                        'on' => esc_html__('On', 'corpix'),
                        'off' => esc_html__('Off', 'corpix'),
                    ],
                    'std' => 'default',
                ],
                [
                    'name' => esc_html__('Page Title Settings', 'corpix'),
                    'type' => 'tpc_heading',
                    'attributes' => [
                        'data-conditional-logic' => [[
                            ['mb_page_title_switch', '=', 'on']
                        ]],
                    ],
                ],
                [
                    'id' => 'mb_page_title_bg_switch',
                    'name' => esc_html__('Use Background?', 'corpix'),
                    'type' => 'switch',
                    'attributes' => [
                        'data-conditional-logic' => [[
                            ['mb_page_title_switch', '=' , 'on']
                        ]],
                    ],
                    'std' => true,
                ],
                [
                    'id' => 'mb_page_title_bg',
                    'name' => esc_html__('Background', 'corpix'),
                    'type' => 'tpc_background',
                    'attributes' => [
                        'data-conditional-logic' => [[
                            ['mb_page_title_switch', '=', 'on'],
                            ['mb_page_title_bg_switch', '=', true ],
                        ]],
                    ],
                    'image' => '',
                    'position' => 'bottom center',
                    'attachment' => 'scroll',
                    'size' => 'cover',
                    'repeat' => 'no-repeat',
                    'color' => '#eff7fa',
                ],
                [
                    'id' => 'mb_page_title_height',
                    'name' => esc_html__('Min Height', 'corpix'),
                    'type' => 'number',
                    'attributes' => [
                        'data-conditional-logic' => [[
                            ['mb_page_title_switch', '=', 'on'],
                            ['mb_page_title_bg_switch', '=', true],
                        ]],
                    ],
                    'desc' => esc_html__('Choose `0px` in order to use `min-height: auto;`', 'corpix'),
                    'min' => 0,
                    'std' => esc_attr((int) \Corpix_Theme_Helper::get_option('page_title_height')['height']),
                ],
                [
                    'id' => 'mb_page_title_align',
                    'name' => esc_html__('Title Alignment', 'corpix'),
                    'type' => 'button_group',
                    'attributes' => [
                        'data-conditional-logic' => [[
                            ['mb_page_title_switch', '=' , 'on']
                        ]],
                    ],
                    'multiple' => false,
                    'options' => [
                        'left' => esc_html__('left', 'corpix'),
                        'center' => esc_html__('center', 'corpix'),
                        'right' => esc_html__('right', 'corpix'),
                    ],
                    'std' => 'center',
                ],
                [
                    'id' => 'mb_page_title_padding',
                    'name' => esc_html__('Paddings Top/Bottom', 'corpix'),
                    'type' => 'tpc_offset',
                    'attributes' => [
                        'data-conditional-logic' => [[
                            ['mb_page_title_switch', '=' , 'on']
                        ]],
                    ],
                    'options' => [
                        'mode' => 'padding',
                        'top' => true,
                        'right' => false,
                        'bottom' => true,
                        'left' => false,
                    ],
                    'std' => [
                        'padding-top' => '76',
                        'padding-bottom' => '80',
                    ],
                ],
                [
                    'id' => 'mb_page_title_margin',
                    'name' => esc_html__('Margin Bottom', 'corpix'),
                    'type' => 'tpc_offset',
                    'attributes' => [
                        'data-conditional-logic' => [[
                            ['mb_page_title_switch', '=', 'on']
                        ]],
                    ],
                    'options' => [
                        'mode' => 'margin',
                        'top' => false,
                        'right' => false,
                        'bottom' => true,
                        'left' => false,
                    ],
                    'std' => ['margin-bottom' => '40'],
                ],
                [
                    'id' => 'mb_page_title_parallax',
                    'name' => esc_html__('Parallax Switch', 'corpix'),
                    'type' => 'switch',
                    'attributes' => [
                        'data-conditional-logic' => [[
                            ['mb_page_title_switch', '=', 'on']
                        ]],
                    ],
                ],
                [
                    'id' => 'mb_page_title_parallax_speed',
                    'name' => esc_html__('Prallax Speed', 'corpix'),
                    'type' => 'number',
                    'attributes' => [
                        'data-conditional-logic' => [[
                            ['mb_page_title_parallax', '=',true ],
                            ['mb_page_title_switch', '=', 'on'],
                        ]],
                    ],
                    'step' => 0.1,
                    'std' => 0.3,
                ],
                [
                    'id' => 'mb_page_title_breadcrumbs_switch',
                    'name' => esc_html__('Show Breadcrumbs', 'corpix'),
                    'type' => 'switch',
                    'attributes' => [
                        'data-conditional-logic' => [[
                            ['mb_page_title_switch', '=', 'on']
                        ]],
                    ],
                    'std' => 1,
                ],
                [
                    'id' => 'mb_page_title_breadcrumbs_align',
                    'name' => esc_html__('Breadcrumbs Alignment', 'corpix'),
                    'type' => 'button_group',
                    'attributes' => [
                        'data-conditional-logic' => [[
                            ['mb_page_title_switch', '=', 'on'],
                            ['mb_page_title_breadcrumbs_switch', '=', '1']
                        ]],
                    ],
                    'multiple' => false,
                    'options' => [
                        'left' => esc_html__('left', 'corpix'),
                        'center' => esc_html__('center', 'corpix'),
                        'right' => esc_html__('right', 'corpix'),
                    ],
                    'std' => 'center',
                ],
                [
                    'id' => 'mb_page_title_breadcrumbs_block_switch',
                    'name' => esc_html__('Breadcrumbs Full Width', 'corpix'),
                    'type' => 'switch',
                    'attributes' => [
                        'data-conditional-logic' => [[
                            ['mb_page_title_switch', '=', 'on'],
                            ['mb_page_title_breadcrumbs_switch', '=', '1']
                        ]],
                    ],
                    'std' => true,
                ],
                [
                    'name' => esc_html__('Page Title Typography', 'corpix'),
                    'type' => 'tpc_heading',
                    'attributes' => [
                        'data-conditional-logic' => [[
                            ['mb_page_title_switch', '=', 'on']
                        ]],
                    ],
                ],
                [
                    'id' => 'mb_page_title_font',
                    'name' => esc_html__('Page Title Font', 'corpix'),
                    'type' => 'tpc_font',
                    'attributes' => [
                        'data-conditional-logic' => [[
                            ['mb_page_title_switch', '=', 'on']
                        ]],
                    ],
                    'options' => [
                        'font-size' => true,
                        'line-height' => true,
                        'font-weight' => false,
                        'color' => true,
                    ],
                    'std' => [
                        'font-size' => '40',
                        'line-height' => '48',
                        'color' => '#ffffff',
                    ],
                ],
                [
                    'id' => 'mb_page_title_breadcrumbs_font',
                    'name' => esc_html__('Page Title Breadcrumbs Font', 'corpix'),
                    'type' => 'tpc_font',
                    'attributes' => [
                        'data-conditional-logic' => [[
                            ['mb_page_title_switch', '=', 'on']
                        ]],
                    ],
                    'options' => [
                        'font-size' => true,
                        'line-height' => true,
                        'font-weight' => false,
                        'color' => true,
                    ],
                    'std' => [
                        'font-size' => esc_attr((int) \Corpix_Theme_Helper::get_option('page_title_breadcrumbs_font')['font-size']),
                        'line-height' => esc_attr((int) \Corpix_Theme_Helper::get_option('page_title_breadcrumbs_font')['line-height']),
                        'color' => esc_attr(\Corpix_Theme_Helper::get_option('page_title_breadcrumbs_font')['color']),
                    ],
                ],
                [
                    'name' => esc_html__('Responsive Layout', 'corpix'),
                    'type' => 'tpc_heading',
                    'attributes' => [
                        'data-conditional-logic' => [[
                            ['mb_page_title_switch', '=', 'on']
                        ]],
                    ],
                ],
                [
                    'id' => 'mb_page_title_resp_switch',
                    'name' => esc_html__('Responsive Layout On/Off', 'corpix'),
                    'type' => 'switch',
                    'attributes' => [
                        'data-conditional-logic' => [[
                            ['mb_page_title_switch', '=', 'on']
                        ]],
                    ],
                ],
                [
                    'id' => 'mb_page_title_resp_resolution',
                    'name' => esc_html__('Screen breakpoint', 'corpix'),
                    'type' => 'number',
                    'attributes' => [
                        'data-conditional-logic' => [[
                            ['mb_page_title_switch', '=', 'on'],
                            ['mb_page_title_resp_switch', '=', '1'],
                        ]],
                    ],
                    'min' => 1,
                    'std' => esc_attr(\Corpix_Theme_Helper::get_option('page_title_resp_resolution')),
                ],
                [
                    'id' => 'mb_page_title_resp_padding',
                    'name' => esc_html__('Padding Top/Bottom', 'corpix'),
                    'type' => 'tpc_offset',
                    'attributes' => [
                        'data-conditional-logic' => [[
                            ['mb_page_title_switch', '=', 'on'],
                            ['mb_page_title_resp_switch', '=', '1'],
                        ]],
                    ],
                    'options' => [
                        'mode' => 'padding',
                        'top' => true,
                        'right' => false,
                        'bottom' => true,
                        'left' => false,
                    ],
                    'std' => [
                        'padding-top' => esc_attr(\Corpix_Theme_Helper::get_option('page_title_resp_padding')['padding-top']),
                        'padding-bottom' => esc_attr(\Corpix_Theme_Helper::get_option('page_title_resp_padding')['padding-bottom']),
                    ],
                ],
                [
                    'id' => 'mb_page_title_resp_font',
                    'name' => esc_html__('Page Title Font', 'corpix'),
                    'type' => 'tpc_font',
                    'attributes' => [
                        'data-conditional-logic' => [[
                            ['mb_page_title_switch', '=', 'on'],
                            ['mb_page_title_resp_switch', '=', '1'],
                        ]],
                    ],
                    'options' => [
                        'font-size' => true,
                        'line-height' => true,
                        'font-weight' => false,
                        'color' => true,
                    ],
                    'std' => [
                        'font-size' => '32',
                        'line-height' => '40',
                        'color' => '#333333',
                    ],
                ],
                [
                    'id' => 'mb_page_title_resp_breadcrumbs_switch',
                    'name' => esc_html__('Show Breadcrumbs', 'corpix'),
                    'type' => 'switch',
                    'attributes' => [
                        'data-conditional-logic' => [[
                            ['mb_page_title_switch', '=', 'on'],
                            ['mb_page_title_resp_switch', '=', '1'],
                        ]],
                    ],
                    'std' => 1,
                ],
                [
                    'id' => 'mb_page_title_resp_breadcrumbs_font',
                    'name' => esc_html__('Page Title Breadcrumbs Font', 'corpix'),
                    'type' => 'tpc_font',
                    'attributes' => [
                        'data-conditional-logic' => [[
                            ['mb_page_title_switch', '=', 'on'],
                            ['mb_page_title_resp_switch', '=', '1'],
                            ['mb_page_title_resp_breadcrumbs_switch', '=', '1'],
                        ]],
                    ],
                    'options' => [
                        'font-size' => true,
                        'line-height' => true,
                        'font-weight' => false,
                        'color' => true,
                    ],
                    'std' => [
                        'font-size' => esc_attr((int) \Corpix_Theme_Helper::get_option('page_title_breadcrumbs_font')['font-size']),
                        'line-height' => esc_attr((int) \Corpix_Theme_Helper::get_option('page_title_breadcrumbs_font')['line-height']),
                        'color' => esc_attr(\Corpix_Theme_Helper::get_option('page_title_breadcrumbs_font')['color']),
                    ],
                ],
            ],
        ];
        return $meta_boxes;
    }

    public function page_side_panel_meta_boxes($meta_boxes)
    {
        $meta_boxes[] = [
            'title' => esc_html__('Side Panel', 'corpix'),
            'post_types' => ['page'],
            'context' => 'advanced',
            'fields' => [
                [
                    'id' => 'mb_customize_side_panel',
                    'name' => esc_html__('Side Panel', 'corpix'),
                    'type' => 'button_group',
                    'multiple' => false,
                    'inline' => true,
                    'options' => [
                        'default' => esc_html__('Default', 'corpix'),
                        'custom' => esc_html__('Custom', 'corpix'),
                    ],
                    'std' => 'default',
                ],
                [
                    'name' => esc_html__('Side Panel Settings', 'corpix'),
                    'type' => 'tpc_heading',
                    'attributes' => [
                        'data-conditional-logic' => [[
                            ['mb_customize_side_panel', '=', 'custom']
                        ]],
                    ],
                ],
                [
                    'id' => 'mb_side_panel_content_type',
                    'name' => esc_html__('Content Type', 'corpix'),
                    'type' => 'button_group',
                    'attributes' => [
                        'data-conditional-logic' => [[
                            ['mb_customize_side_panel', '=', 'custom']
                        ]],
                    ],
                    'multiple' => false,
                    'options' => [
                        'widgets' => esc_html__('Widgets', 'corpix'),
                        'pages' => esc_html__('Page', 'corpix')
                    ],
                    'std' => 'widgets',
                ],
                [
                    'id' => 'mb_side_panel_page_select',
                    'name' => esc_html__('Select a page', 'corpix'),
                    'type' => 'post',
                    'attributes' => [
                        'data-conditional-logic' => [[
                            ['mb_customize_side_panel', '=', 'custom'],
                            ['mb_side_panel_content_type', '=', 'pages']
                        ]],
                    ],
                    'post_type' => 'side_panel',
                    'field_type' => 'select_advanced',
                    'placeholder' => esc_html__('Select a page', 'corpix'),
                    'query_args' => [
                        'post_status' => 'publish',
                        'posts_per_page' => - 1,
                    ],
                ],
                [
                    'id' => 'mb_side_panel_spacing',
                    'name' => esc_html__('Paddings', 'corpix'),
                    'type' => 'tpc_offset',
                    'attributes' => [
                        'data-conditional-logic' => [[
                            ['mb_customize_side_panel', '=', 'custom']
                        ]],
                    ],
                    'options' => [
                        'mode' => 'padding',
                        'top' => true,
                        'right' => true,
                        'bottom' => true,
                        'left' => true,
                    ],
                    'std' => [
                        'padding-top' => '105',
                        'padding-right' => '90',
                        'padding-bottom' => '105',
                        'padding-left' => '90'
                    ],
                ],
                [
                    'id' => 'mb_side_panel_title_color',
                    'name' => esc_html__('Title Color', 'corpix'),
                    'type' => 'color',
                    'attributes' => [
                        'data-conditional-logic' => [[
                            ['mb_customize_side_panel', '=', 'custom']
                        ]],
                    ],
                    'js_options' => ['defaultColor' => '#ffffff'],
                    'std' => '#ffffff',
                ],
                [
                    'id' => 'mb_side_panel_text_color',
                    'name' => esc_html__('Text Color', 'corpix'),
                    'type' => 'color',
                    'attributes' => [
                        'data-conditional-logic' => [[
                            ['mb_customize_side_panel', '=', 'custom']
                        ]],
                    ],
                    'js_options' => [
                        'defaultColor' => esc_attr(\Corpix_Theme_Helper::get_option('header-font')['color'])
                    ],
                    'std' => esc_attr(\Corpix_Theme_Helper::get_option('header-font')['color']),
                ],
                [
                    'id' => 'mb_side_panel_bg',
                    'name' => esc_html__('Background Color', 'corpix'),
                    'type' => 'color',
                    'attributes' => [
                        'data-conditional-logic' => [[
                            ['mb_customize_side_panel', '=', 'custom']
                        ]],
                    ],
                    'alpha_channel' => true,
                    'js_options' => [
                        'defaultColor' => esc_attr(\Corpix_Theme_Helper::get_option('body-background-color'))
                    ],
                    'std' => esc_attr(\Corpix_Theme_Helper::get_option('body-background-color')),
                ],
                [
                    'id' => 'mb_side_panel_text_alignment',
                    'name' => esc_html__('Text Align', 'corpix'),
                    'type' => 'button_group',
                    'attributes' => [
                        'data-conditional-logic' => [[
                            ['mb_customize_side_panel', '=', 'custom']
                        ], ],
                    ],
                    'multiple' => false,
                    'options' => [
                        'left' => esc_html__('Left', 'corpix'),
                        'center' => esc_html__('Center', 'corpix'),
                        'right' => esc_html__('Right', 'corpix'),
                    ],
                    'std' => 'center',
                ],
                [
                    'id' => 'mb_side_panel_width',
                    'name' => esc_html__('Width', 'corpix'),
                    'type' => 'number',
                    'attributes' => [
                        'data-conditional-logic' => [[
                            ['mb_customize_side_panel', '=', 'custom']
                        ]],
                    ],
                    'min' => 0,
                    'std' => 480,
                ],
                [
                    'id' => 'mb_side_panel_position',
                    'name' => esc_html__('Position', 'corpix'),
                    'type' => 'button_group',
                    'attributes' => [
                        'data-conditional-logic' => [[
                                ['mb_customize_side_panel', '=', 'custom']
                        ]],
                    ],
                    'multiple' => false,
                    'options' => [
                        'left' => esc_html__('Left', 'corpix'),
                        'right' => esc_html__('Right', 'corpix'),
                    ],
                    'std' => 'right',
                ],
            ]
        ];
        return $meta_boxes;
    }

    public function page_soc_icons_meta_boxes($meta_boxes)
    {
        $meta_boxes[] = [
            'title' => esc_html__('Social Shares', 'corpix'),
            'post_types' => ['page'],
            'context' => 'advanced',
            'fields' => [
                [
                    'id' => 'mb_customize_soc_shares',
                    'name' => esc_html__('Social Shares', 'corpix'),
                    'type' => 'button_group',
                    'inline' => true,
                    'multiple' => false,
                    'options' => [
                        'default' => esc_html__('Default', 'corpix'),
                        'on' => esc_html__('On', 'corpix'),
                        'off' => esc_html__('Off', 'corpix'),
                    ],
                    'std' => 'default',
                ],
                [
                    'id' => 'mb_soc_icon_style',
                    'name' => esc_html__('Socials visibility', 'corpix'),
                    'type' => 'button_group',
                    'attributes' => [
                        'data-conditional-logic' => [[
                            ['mb_customize_soc_shares', '=', 'on']
                        ]],
                    ],
                    'multiple' => false,
                    'options' => [
                        'standard' => esc_html__('Always', 'corpix'),
                        'hovered' => esc_html__('On Hover', 'corpix'),
                    ],
                    'std' => 'standard',
                ],
                [
                    'id' => 'mb_soc_icon_offset',
                    'name' => esc_html__('Offset Top', 'corpix'),
                    'type' => 'number',
                    'attributes' => [
                        'data-conditional-logic' => [[
                            ['mb_customize_soc_shares', '=', 'on']
                        ]],
                    ],
                    'min' => 0,
                    'std' => 250,
                ],
                [
                    'id' => 'mb_soc_icon_offset_units',
                    'name' => esc_html__('Offset Top Units', 'corpix'),
                    'type' => 'button_group',
                    'attributes' => [
                        'data-conditional-logic' => [[
                            ['mb_customize_soc_shares', '=', 'on']
                        ]],
                    ],
                    'desc' => esc_html__('If measurement units defined as "%" then social buttons will be fixed relative to viewport.', 'corpix'),
                    'multiple' => false,
                    'options' => [
                        'pixel' => esc_html__('pixels (px)', 'corpix'),
                        'percent' => esc_html__('percents (%)', 'corpix'),
                    ],
                    'std' => 'pixel',
                ],
                [
                    'id' => 'mb_soc_icon_facebook',
                    'name' => esc_html__('Facebook Button', 'corpix'),
                    'type' => 'switch',
                    'attributes' => [
                        'data-conditional-logic' => [[
                            ['mb_customize_soc_shares', '=', 'on']
                        ]],
                    ],
                ],
                [
                    'id' => 'mb_soc_icon_twitter',
                    'name' => esc_html__('Twitter Button', 'corpix'),
                    'type' => 'switch',
                    'attributes' => [
                        'data-conditional-logic' => [[
                            ['mb_customize_soc_shares', '=', 'on']
                        ]],
                    ],
                ],
                [
                    'id' => 'mb_soc_icon_linkedin',
                    'name' => esc_html__('Linkedin Button', 'corpix'),
                    'type' => 'switch',
                    'attributes' => [
                        'data-conditional-logic' => [[
                            ['mb_customize_soc_shares', '=', 'on']
                        ]],
                    ],
                ],
                [
                    'id' => 'mb_soc_icon_pinterest',
                    'name' => esc_html__('Pinterest Button', 'corpix'),
                    'type' => 'switch',
                    'attributes' => [
                        'data-conditional-logic' => [[
                            ['mb_customize_soc_shares', '=', 'on']
                        ]],
                    ],
                ],
                [
                    'id' => 'mb_soc_icon_tumblr',
                    'name' => esc_html__('Tumblr Button', 'corpix'),
                    'type' => 'switch',
                    'attributes' => [
                        'data-conditional-logic' => [[
                            ['mb_customize_soc_shares', '=', 'on']
                        ]],
                    ],
                ],

            ]
        ];
        return $meta_boxes;
    }

    public function page_footer_meta_boxes($meta_boxes)
    {
        $meta_boxes[] = [
            'title' => esc_html__('Footer', 'corpix'),
            'post_types' => ['page'],
            'context' => 'advanced',
            'fields' => [
                [
                    'id' => 'mb_footer_switch',
                    'name' => esc_html__('Footer', 'corpix'),
                    'type' => 'button_group',
                    'multiple' => false,
                    'options' => [
                        'default' => esc_html__('Default', 'corpix'),
                        'on' => esc_html__('On', 'corpix'),
                        'off' => esc_html__('Off', 'corpix'),
                    ],
                    'std' => 'default',
                ],
                [
                    'name' => esc_html__('Footer Settings', 'corpix'),
                    'type' => 'tpc_heading',
                    'attributes' => [
                        'data-conditional-logic' => [[
                            ['mb_footer_switch', '=', 'on']
                        ]],
                    ],
                ],
                [
                    'id' => 'mb_footer_content_type',
                    'name' => esc_html__('Content Type', 'corpix'),
                    'type' => 'button_group',
                    'attributes' => [
                        'data-conditional-logic' => [[
                            ['mb_footer_switch', '=', 'on']
                        ]],
                    ],
                    'multiple' => false,
                    'options' => [
                        'widgets' => esc_html__('Widgets', 'corpix'),
                        'pages' => esc_html__('Page', 'corpix')
                    ],
                    'std' => 'pages',
                ],
                [
                    'id' => 'mb_footer_page_select',
                    'name' => esc_html__('Select a page', 'corpix'),
                    'type' => 'post',
                    'attributes' => [
                        'data-conditional-logic' => [[
                            ['mb_footer_switch', '=', 'on'],
                            ['mb_footer_content_type', '=', 'pages']
                        ]],
                    ],
                    'post_type' => 'footer',
                    'field_type' => 'select_advanced',
                    'placeholder' => esc_html__('Select a page', 'corpix'),
                    'query_args' => [
                        'post_status' => 'publish',
                        'posts_per_page' => - 1,
                    ],
                ],
                [
                    'id' => 'mb_footer_spacing',
                    'name' => esc_html__('Paddings', 'corpix'),
                    'type' => 'tpc_offset',
                    'attributes' => [
                        'data-conditional-logic' => [[
                            ['mb_footer_switch', '=', 'on'],
                            ['mb_footer_content_type', '=', 'widgets'],
                        ]],
                    ],
                    'options' => [
                        'mode' => 'padding',
                        'top' => true,
                        'right' => true,
                        'bottom' => true,
                        'left' => true,
                    ],
                    'std' => [
                        'padding-top' => '0',
                        'padding-right' => '0',
                        'padding-bottom' => '0',
                        'padding-left' => '0'
                    ],
                ],
                [
                    'id' => 'mb_footer_bg',
                    'name' => esc_html__('Background', 'corpix'),
                    'type' => 'tpc_background',
                    'attributes' => [
                        'data-conditional-logic' => [[
                            ['mb_footer_switch', '=', 'on'],
                            ['mb_footer_content_type', '=', 'widgets'],
                        ]],
                    ],
                    'image' => '',
                    'position' => 'center center',
                    'attachment' => 'scroll',
                    'size' => 'cover',
                    'repeat' => 'no-repeat',
                    'color' => '#ffffff',
                ],
                [
                    'id' => 'mb_footer_add_border',
                    'name' => esc_html__('Add Border Top', 'corpix'),
                    'type' => 'switch',
                    'attributes' => [
                        'data-conditional-logic' => [[
                            ['mb_footer_switch', '=', 'on'],
                            ['mb_footer_content_type', '=', 'widgets'],
                        ]],
                    ],
                ],
                [
                    'id' => 'mb_footer_border_color',
                    'name' => esc_html__('Border Color', 'corpix'),
                    'type' => 'color',
                    'attributes' => [
                        'data-conditional-logic' => [[
                            ['mb_footer_switch', '=', 'on'],
                            ['mb_footer_add_border', '=', '1'],
                        ]],
                    ],
                    'alpha_channel' => true,
                    'js_options' => ['defaultColor' => '#e5e5e5'],
                    'std' => '#e5e5e5',
                ],
            ],
        ];
        return $meta_boxes;
    }

    public function page_copyright_meta_boxes($meta_boxes)
    {
        $meta_boxes[] = [
            'title' => esc_html__('Copyright', 'corpix'),
            'post_types' => ['page'],
            'context' => 'advanced',
            'fields' => [
                [
                    'id' => 'mb_copyright_switch',
                    'name' => esc_html__('Copyright', 'corpix'),
                    'type' => 'button_group',
                    'multiple' => false,
                    'options' => [
                        'default' => esc_html__('Default', 'corpix'),
                        'on' => esc_html__('On', 'corpix'),
                        'off' => esc_html__('Off', 'corpix'),
                    ],
                    'std' => 'default',
                ],
                [
                    'name' => esc_html__('Copyright Settings', 'corpix'),
                    'type' => 'tpc_heading',
                    'attributes' => [
                        'data-conditional-logic' => [[
                            ['mb_copyright_switch', '=', 'on']
                        ]],
                    ],
                ],
                [
                    'id' => 'mb_copyright_editor',
                    'name' => esc_html__('Editor', 'corpix'),
                    'type' => 'textarea',
                    'attributes' => [
                        'data-conditional-logic' => [[
                            ['mb_copyright_switch', '=', 'on']
                        ]],
                    ],
                    'cols' => 20,
                    'rows' => 3,
                    'std' => esc_html__('Copyright © 2021 Corpix by Pixelcurve. All Rights Reserved', 'corpix')
                ],
                [
                    'id' => 'mb_copyright_text_color',
                    'name' => esc_html__('Text Color', 'corpix'),
                    'type' => 'color',
                    'attributes' => [
                        'data-conditional-logic' => [[
                            ['mb_copyright_switch', '=', 'on']
                        ]],
                    ],
                    'js_options' => ['defaultColor' => '#838383'],
                    'std' => '#838383',
                ],
                [
                    'id' => 'mb_copyright_bg_color',
                    'name' => esc_html__('Background Color', 'corpix'),
                    'type' => 'color',
                    'attributes' => [
                        'data-conditional-logic' => [[
                            ['mb_copyright_switch', '=', 'on']
                        ]],
                    ],
                    'js_options' => ['defaultColor' => '#171a1e'],
                    'std' => '#171a1e',
                ],
                [
                    'id' => 'mb_copyright_spacing',
                    'name' => esc_html__('Paddings', 'corpix'),
                    'type' => 'tpc_offset',
                    'attributes' => [
                        'data-conditional-logic' => [[
                            ['mb_copyright_switch', '=', 'on']
                        ]],
                    ],
                    'options' => [
                        'mode' => 'padding',
                        'top' => true,
                        'right' => false,
                        'bottom' => true,
                        'left' => false,
                    ],
                    'std' => [
                        'padding-top' => '10',
                        'padding-bottom' => '10',
                    ],
                ],
            ],
        ];
        return $meta_boxes;
    }
}

new Corpix_Metaboxes();
