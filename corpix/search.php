<?php

defined('ABSPATH') || exit;

use Corpix_Theme_Helper as Corpix;

/**
 * The template for displaying search result page
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package corpix
 * @since 1.0.0
 */

get_header();

$sb = Corpix::get_sidebar_data('blog_list');
$container_class = $sb['container_class'] ?? '';
$row_class = $sb['row_class'] ?? '';
$column = $sb['column'] ?? '';

?>
<div class="tpc-container<?php echo apply_filters('corpix/container/class', esc_attr( $container_class )); ?>">
<div class="row<?php echo apply_filters('corpix/row/class', esc_attr( $row_class )); ?>">
    <div id='main-content' class="tpc_col-<?php echo apply_filters('corpix/column/class', esc_attr( $column )); ?>">
        <?php
        if (have_posts()) :
            echo '<header class="searсh-header">',
                '<h1 class="page-title">',
                    esc_html__('Search Results for: ', 'corpix'),
                    '<span>', get_search_query(), '</span>',
                '</h1>',
            '</header>';

            global $tpc_blog_atts;
            global $wp_query;

            $tpc_blog_atts = [
                'query' => $wp_query,
                // Layout
                'blog_layout' => 'grid',
                'blog_columns' => Corpix::get_option('blog_list_columns') ?: '12',
                // Appearance
                'hide_media' => Corpix::get_option('blog_list_hide_media'),
                'hide_content' => Corpix::get_option('blog_list_hide_content'),
                'hide_blog_title' => Corpix::get_option('blog_list_hide_title'),
                'hide_all_meta' => Corpix::get_option('blog_list_meta'),
                'meta_author' => Corpix::get_option('blog_list_meta_author'),
                'meta_comments' => Corpix::get_option('blog_list_meta_comments'),
                'meta_categories' => Corpix::get_option('blog_list_meta_categories'),
                'meta_date' => Corpix::get_option('blog_list_meta_date'),
                'hide_likes' => !Corpix::get_option('blog_list_likes'),
                'hide_views' => !Corpix::get_option('blog_list_views'),
                'hide_share' => !Corpix::get_option('blog_list_share'),
                'read_more_hide' => Corpix::get_option('blog_list_read_more'),
                'content_letter_count' => Corpix::get_option('blog_list_letter_count') ?: '85',
                'read_more_text' => esc_html__('READ MORE', 'corpix'),
                'heading_tag' => 'h3',
                'items_load' => 4,
            ];

            // Blog Archive Template
            get_template_part('templates/post/posts-list');
            echo Corpix::pagination();

        else :
            echo '<div class="page_404_wrapper">';
                echo '<header class="searсh-header">',
                    '<h1 class="page-title">',
                    esc_html__('Nothing Found', 'corpix'),
                    '</h1>',
                '</header>';

                echo '<div class="page-content">';
                    if (is_search()) :
                        echo '<p class="banner_404_text">';
                        esc_html_e('Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'corpix');
                        echo '</p>';
                    else : ?>
                        <p class="banner_404_text"><?php esc_html_e('It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'corpix'); ?></p>
                        <?php
                    endif;
                    ?>
                    <div class="search_result_form">
                        <?php get_search_form(); ?>
                    </div>
                    <div class="corpix_404__button">
                        <a class="rt-button btn-size-lg" href="<?php echo esc_url(home_url('/')); ?>">
                            <div class="button-content-wrapper">
                            <?php esc_html_e('Take Me Home', 'corpix'); ?>
                            </div>
                        </a>
                    </div>
                </div>

            </div>
            <?php
        endif;
    echo '</div>';

    if ($sb) {
        Corpix::render_sidebar($sb);
    }

echo '</div>';
echo '</div>';

get_footer();
