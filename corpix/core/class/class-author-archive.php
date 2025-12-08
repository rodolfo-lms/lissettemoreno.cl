<?php
defined( 'ABSPATH' ) || exit;
use Corpix_Theme_Helper as Corpix;
if ( ! class_exists( 'Corpix_Author_archive' ) ) {
class Corpix_Author_archive {
     public function __construct() {
          add_action( 'pre_get_posts', [ $this, 'corpix_add_cpt_author' ] );
     }
    public function corpix_add_cpt_author( $query ) {


        //$corpix_author_archive_posts = Corpix_Theme_Helper::get_mb_option('corpix_author_archive_posts');
        $corpix_author_archive_posts_type = Corpix_Theme_Helper::get_mb_option('corpix_author_archive_posts_type');

    

            if ( !is_admin() && $query->is_author() && $query->is_main_query() ) {
                $query->set( 'post_type', 'sfwd-courses'  );
            }
    

     }
}
$var = new Corpix_Author_archive();
}

