<?php

add_filter('admin_body_class', 'corpix_admin_body_class');

function corpix_admin_body_class($classes)
{

    if (corpix_check_tvc()) {
        return "$classes no_corpix_unlock";
    } else {
        return "$classes corpix_unlock";
    }
}

function corpix_tvf_register_settings()
{
    add_option('corpix_tv_option', '');
    register_setting('corpix_tv_options_group', 'corpix_tv_option', 'corpix_tv_callback');
}
add_action('admin_init', 'corpix_tvf_register_settings');

function corpix_tvf_register_options_page()
{
    add_options_page('Theme Verify', 'Theme Verify', 'manage_options', 'corpix_tvf', 'corpix_tv_options_page');
}
add_action('admin_menu', 'corpix_tvf_register_options_page');

function corpix_tv_options_page()
{
    ?>
<div class="corpix-activation-theme_form">
    <div class="container-form">
<form method="post" action="options.php">
      <?php settings_fields('corpix_tv_options_group');?>

        <h1 class="corpix-title"><?php esc_html_e('Activate Your License', 'corpix');?></h1>
        <div class="corpix-content">
            <p class="corpix-content_subtitle">
                <?php echo sprintf(esc_html__('Welcome and thank you for Choosing %s Theme!', 'corpix'), esc_html(wp_get_theme()->get('Name'))); ?>
                <br/>
                <?php echo sprintf(esc_html__('The %s theme needs to be activated to enable demo import installation and customer support service.', 'corpix'), esc_html(wp_get_theme()->get('Name'))); ?>
            </p>
        </div>

        <?php if (corpix_check_tvc() == false): ?>
        <div class="help-description">
            <a href="https://www.youtube.com/watch?v=yTScONNFnZ8&feature=emb_title&ab_channel=Envato" target="_blank"><?php esc_html_e('How to find purchase code?', 'corpix');?></a>
        </div>

        <input type="text" placeholder="Enter Your Purchase Code"  id="corpix_tv_option" name="corpix_tv_option" value="<?php echo get_option('corpix_tv_option'); ?>" />

           <div class="licnese-active-button">
                <?php submit_button(__('Activate', 'corpix'), 'primary');?>
           </div>
        <?php endif;?>

        <div class="form-group hidden_group">
            <input type="hidden" name="deactivate_theme" value=" " class="form-control">
        </div>

        <?php
            $theme_fv_code = get_option('corpix_tv_option');
            if (!empty($theme_fv_code)) {
                ?>
                        <input type="hidden" name="corpix_tv_option" value=" " class="form-control">
                    <?php
            }
        ?>

        <?php wp_nonce_field('purchase-activation', 'security');?>

        <?php if (corpix_check_tvc()): ?>
            <button type="submit" class="button button-primary deactivate_theme-license" value="submit">
                <span class="text-btn"><?php esc_html_e('Deactivate', 'corpix');?></span>
                <span class="loading-icon"></span>
            </button>
        <?php endif;?>

      </form>


        <?php
            if (corpix_check_tvc()) {
        ?>

        <div class="corpix-activation-theme_congratulations">
            <h1 class="corpix-title">
                <?php esc_html_e('Thank you!', 'corpix');?>
            </h1>
            <span><?php esc_html_e('Your theme\'s license is activated successfully.', 'corpix');?></span>

        </div>
            <a href="<?php echo admin_url('themes.php?page=pt-one-click-demo-import'); ?>" class="button button-primary button-large button-next import-demo-next"><?php esc_html_e('Import Demo', 'corpix');?></a>
        <?php

    } else {

        $theme_fv_code = get_option('corpix_tv_option');?>

        <?php if (!empty($theme_fv_code)): ?>
             <div class="corpix-activation-theme_congratulations invalid">
                <h1 class="corpix-title">
                   <?php esc_html_e('Invalid Purchase Code', 'corpix');?>
                </h1>
            </div>
        <?php endif?>

        <?php }?>

    </div>
</div>
 <?php
}

class CorpixxEnvatoApi
{
    // Bearer, no need for OAUTH token, change this to your bearer string
    // https://build.envato.com/api/#token

    private static $bearer = "uYJt07Y0Wz9Eum0mX3hsUJtTotYhU"."v"."e"."y"; //

    public static function getPurchaseData($code)
    {

        //setting the header for the rest of the api
        $bearer   = 'bearer ' . self::$bearer;
        $header   = array();
        $header[] = 'Content-length: 0';
        $header[] = 'Content-type: application/json; charset=utf-8';
        $header[] = 'Authorization: ' .$bearer;

        $verify_url = 'https://api.envato.com/v3/market/author/sale/';
        $ch_verify  = curl_init($verify_url . '?code=' . $code);

        curl_setopt($ch_verify, CURLOPT_HTTPHEADER, $header);
        curl_setopt($ch_verify, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch_verify, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch_verify, CURLOPT_CONNECTTIMEOUT, 5);
        curl_setopt($ch_verify, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13');

        $cinit_verify_data = curl_exec($ch_verify);
        curl_close($ch_verify);

        if ($cinit_verify_data != "") {
            return json_decode($cinit_verify_data);
        } else {
            return false;
        }

    }

    public static function verifyPurchase($code)
    {
        $verify_obj = self::getPurchaseData($code);

        // Check for correct verify code
        if (
            (false === $verify_obj) ||
            !is_object($verify_obj) ||
            isset($verify_obj->error) ||
            !isset($verify_obj->sold_at)
        ) {
            return -1;
        }

        // If empty or date present, then it's valid
        if (
            $verify_obj->supported_until == "" ||
            $verify_obj->supported_until != null
        ) {
            return $verify_obj;
        }

        // Null or something non-string value, thus support period over
        return 0;

    }
}

function corpix_check_tvc()
{
    $theme_fv_code = get_option('corpix_tv_option');
    $obj_get_id = CorpixxEnvatoApi::verifyPurchase($theme_fv_code);
    
    if (is_object($obj_get_id)) {
        $tid = $obj_get_id->item->id;
    }
     else{
        $tid = '';
    }
    if (isset($theme_fv_code) && strlen($theme_fv_code) == '36' && $tid == '49052941') {
        $purchase_code = htmlspecialchars($theme_fv_code);
        $obj = CorpixxEnvatoApi::verifyPurchase($theme_fv_code);
        if (is_object($obj)) {
            return true;
        }
    }
}
function corpix_import_files()
{
    return array(

        array(
            'import_file_name'             => 'Home V1',
            'categories'                   => array('Business', 'Technology'),
            'import_file_url'            => 'https://raw.githubusercontent.com/websumon/dtf/main/49052941/content.xml',
            'import_widget_file_url'     => 'https://raw.githubusercontent.com/websumon/dtf/main/49052941/widget_data.wie',
            'import_redux'           => array(
                array(
                    'file_url'   => 'https://raw.githubusercontent.com/websumon/dtf/main/49052941/redux.json',
                    'option_name' => 'corpix_set',
                ),
            ),
            'import_preview_image_url'     => trailingslashit(get_template_directory_uri()) . 'admin/demo/screenshots/home_v1.jpg',
            'preview_url'                  => 'https://thepixelcurve.com/wp/corpix/home-v1/',
            'import_notice'                => __("<p style='color:#e44941'>Images do not include in demo import. If you want to use images from demo content, you should check the license for every image.</p>", 'corpix'),
        ),

        array(
            'import_file_name'             => 'Home V2',
            'categories'                   => array('Business', 'Technology'),
            'import_file_url'            => 'https://raw.githubusercontent.com/websumon/dtf/main/49052941/content.xml',
            'import_widget_file_url'     => 'https://raw.githubusercontent.com/websumon/dtf/main/49052941/widget_data.wie',
            'import_redux'           => array(
                array(
                    'file_url'   => 'https://raw.githubusercontent.com/websumon/dtf/main/49052941/redux.json',
                    'option_name' => 'corpix_set',
                ),
            ),
            'import_preview_image_url'     => trailingslashit(get_template_directory_uri()) . 'admin/demo/screenshots/home_v2.jpg',
            'preview_url'                  => 'https://thepixelcurve.com/wp/corpix/home-v2/',
            'import_notice'                => __("<p style='color:#e44941'>Images do not include in demo import. If you want to use images from demo content, you should check the license for every image.</p>", 'corpix'),
        ),

        array(
            'import_file_name'             => 'Home V3',
            'categories'                   => array('Business', 'Technology'),
            'import_file_url'            => 'https://raw.githubusercontent.com/websumon/dtf/main/49052941/content.xml',
            'import_widget_file_url'     => 'https://raw.githubusercontent.com/websumon/dtf/main/49052941/widget_data.wie',
            'import_redux'           => array(
                array(
                    'file_url'   => 'https://raw.githubusercontent.com/websumon/dtf/main/49052941/redux.json',
                    'option_name' => 'corpix_set',
                ),
            ),
            'import_preview_image_url'     => trailingslashit(get_template_directory_uri()) . 'admin/demo/screenshots/home_v3.jpg',
            'preview_url'                  => 'https://thepixelcurve.com/wp/corpix/home-v3/',
            'import_notice'                => __("<p style='color:#e44941'>Images do not include in demo import. If you want to use images from demo content, you should check the license for every image.</p>", 'corpix'),
        ),

        array(
            'import_file_name'             => 'Home V4',
            'categories'                   => array('Business', 'Technology'),
            'import_file_url'            => 'https://raw.githubusercontent.com/websumon/dtf/main/49052941/content.xml',
            'import_widget_file_url'     => 'https://raw.githubusercontent.com/websumon/dtf/main/49052941/widget_data.wie',
            'import_redux'           => array(
                array(
                    'file_url'   => 'https://raw.githubusercontent.com/websumon/dtf/main/49052941/redux.json',
                    'option_name' => 'corpix_set',
                ),
            ),
            'import_preview_image_url'     => trailingslashit(get_template_directory_uri()) . 'admin/demo/screenshots/home_v4.jpg',
            'preview_url'                  => 'https://thepixelcurve.com/wp/corpix/home-v4/',
            'import_notice'                => __("<p style='color:#e44941'>Images do not include in demo import. If you want to use images from demo content, you should check the license for every image.</p>", 'corpix'),
        ),

        array(
            'import_file_name'             => 'Home V5',
            'categories'                   => array('Business', 'Technology'),
            'import_file_url'            => 'https://raw.githubusercontent.com/websumon/dtf/main/49052941/content.xml',
            'import_widget_file_url'     => 'https://raw.githubusercontent.com/websumon/dtf/main/49052941/widget_data.wie',
            'import_redux'           => array(
                array(
                    'file_url'   => 'https://raw.githubusercontent.com/websumon/dtf/main/49052941/redux.json',
                    'option_name' => 'corpix_set',
                ),
            ),
            'import_preview_image_url'     => trailingslashit(get_template_directory_uri()) . 'admin/demo/screenshots/home_v5.jpg',
            'preview_url'                  => 'https://thepixelcurve.com/wp/corpix/home-v5/',
            'import_notice'                => __("<p style='color:#e44941'>Images do not include in demo import. If you want to use images from demo content, you should check the license for every image.</p>", 'corpix'),
        ),

        array(
            'import_file_name'             => 'Home V6',
            'categories'                   => array('Business', 'Technology'),
            'import_file_url'            => 'https://raw.githubusercontent.com/websumon/dtf/main/49052941/content.xml',
            'import_widget_file_url'     => 'https://raw.githubusercontent.com/websumon/dtf/main/49052941/widget_data.wie',
            'import_redux'           => array(
                array(
                    'file_url'   => 'https://raw.githubusercontent.com/websumon/dtf/main/49052941/redux.json',
                    'option_name' => 'corpix_set',
                ),
            ),
            'import_preview_image_url'     => trailingslashit(get_template_directory_uri()) . 'admin/demo/screenshots/home_v6.jpg',
            'preview_url'                  => 'https://thepixelcurve.com/wp/corpix/home-v6/',
            'import_notice'                => __("<p style='color:#e44941'>Images do not include in demo import. If you want to use images from demo content, you should check the license for every image.</p>", 'corpix'),
        ),

       
    );
}

function corpix_import_flies()
{
    return array(

         array(
            'import_file_name'             => 'Home V1',
            'categories'                   => array('Business', 'Technology'),
            'import_preview_image_url'     => trailingslashit(get_template_directory_uri()) . 'admin/demo/screenshots/home_v1.jpg',
            'local_import_redux'           => array(
                array(
                    'file_path'   => trailingslashit(get_template_directory()) . 'admin/demo/redux.json',
                    'option_name' => 'corpix_set',
                ),
            ),
            'preview_url'                  => 'https://thepixelcurve.com/wp/corpix/home-v1/',
            'import_notice'                => __("<p style='color:#e44941'>Images do not include in demo import. If you want to use images from demo content, you should check the license for every image.</p>", 'corpix'),
        ),

        array(
            'import_file_name'             => 'Home V2',
            'categories'                   => array('Business', 'Technology'),
            'import_preview_image_url'     => trailingslashit(get_template_directory_uri()) . 'admin/demo/screenshots/home_v2.jpg',
            'local_import_redux'           => array(
                array(
                    'file_path'   => trailingslashit(get_template_directory()) . 'admin/demo/redux.json',
                    'option_name' => 'corpix_set',
                ),
            ),
            'preview_url'                  => 'https://thepixelcurve.com/wp/corpix/home-v2/',
            'import_notice'                => __("<p style='color:#e44941'>Images do not include in demo import. If you want to use images from demo content, you should check the license for every image.</p>", 'corpix'),
        ),

        array(
            'import_file_name'             => 'Home V3',
            'categories'                   => array('Business', 'Technology'),
            'import_preview_image_url'     => trailingslashit(get_template_directory_uri()) . 'admin/demo/screenshots/home_v3.jpg',
            'local_import_redux'           => array(
                array(
                    'file_path'   => trailingslashit(get_template_directory()) . 'admin/demo/redux.json',
                    'option_name' => 'corpix_set',
                ),
            ),
            'preview_url'                  => 'https://thepixelcurve.com/wp/corpix/home-v3/',
            'import_notice'                => __("<p style='color:#e44941'>Images do not include in demo import. If you want to use images from demo content, you should check the license for every image.</p>", 'corpix'),
        ),

        array(
            'import_file_name'             => 'Home V4',
            'categories'                   => array('Business', 'Technology'),
            'import_preview_image_url'     => trailingslashit(get_template_directory_uri()) . 'admin/demo/screenshots/home_v4.jpg',
            'local_import_redux'           => array(
                array(
                    'file_path'   => trailingslashit(get_template_directory()) . 'admin/demo/redux.json',
                    'option_name' => 'corpix_set',
                ),
            ),
            'preview_url'                  => 'https://thepixelcurve.com/wp/corpix/home-v4/',
            'import_notice'                => __("<p style='color:#e44941'>Images do not include in demo import. If you want to use images from demo content, you should check the license for every image.</p>", 'corpix'),
        ),

        array(
            'import_file_name'             => 'Home V5',
            'categories'                   => array('Business', 'Technology'),
            'import_preview_image_url'     => trailingslashit(get_template_directory_uri()) . 'admin/demo/screenshots/home_v5.jpg',
            'local_import_redux'           => array(
                array(
                    'file_path'   => trailingslashit(get_template_directory()) . 'admin/demo/redux.json',
                    'option_name' => 'corpix_set',
                ),
            ),
            'preview_url'                  => 'https://thepixelcurve.com/wp/corpix/home-v5/',
            'import_notice'                => __("<p style='color:#e44941'>Images do not include in demo import. If you want to use images from demo content, you should check the license for every image.</p>", 'corpix'),
        ),

        array(
            'import_file_name'             => 'Home V6',
            'categories'                   => array('Business', 'Technology'),
            'import_preview_image_url'     => trailingslashit(get_template_directory_uri()) . 'admin/demo/screenshots/home_v6.jpg',
            'local_import_redux'           => array(
                array(
                    'file_path'   => trailingslashit(get_template_directory()) . 'admin/demo/redux.json',
                    'option_name' => 'corpix_set',
                ),
            ),
            'preview_url'                  => 'https://thepixelcurve.com/wp/corpix/home-v6/',
            'import_notice'                => __("<p style='color:#e44941'>Images do not include in demo import. If you want to use images from demo content, you should check the license for every image.</p>", 'corpix'),
        ),
        
    );
}

if (corpix_check_tvc()) {
    $corpix_tvfi = "corpix_import_files";
} else {
    $corpix_tvfi = "corpix_import_flies";
}
add_filter('pt-ocdi/import_files', $corpix_tvfi);

function corpix_dialog_options($options)
{
    return array_merge($options, array(
        'width'       => 300,
        'dialogClass' => 'wp-dialog',
        'resizable'   => false,
        'height'      => 'auto',
        'modal'       => true,
    ));
}
add_filter('pt-ocdi/confirmation_dialog_options', 'corpix_dialog_options', 10, 1);
add_filter('pt-ocdi/disable_pt_branding', '__return_true');

function corpix_after_import_setup($selected_import)
{
    // Assign menus to their locations.
    $main_menu = get_term_by('name', 'Main', 'nav_menu');

    set_theme_mod('nav_menu_locations', array(
        'main_menu' => $main_menu->term_id,
    )
    );

    // Set home page
    if ('Home V1' === $selected_import['import_file_name']) {
        $front_page_id = get_page_by_path('home-v1');
    } elseif ('Home V2' === $selected_import['import_file_name']) {
        $front_page_id = get_page_by_path('home-v2');
    } elseif ('Home V3' === $selected_import['import_file_name']) {
        $front_page_id = get_page_by_path('home-v3');
    } elseif ('Home V4' === $selected_import['import_file_name']) {
        $front_page_id = get_page_by_path('home-v4');
    } elseif ('Home V5' === $selected_import['import_file_name']) {
        $front_page_id = get_page_by_path('home-v5');
    } elseif ('Home V6' === $selected_import['import_file_name']) {
        $front_page_id = get_page_by_path('home-v6');
    }
   

    //$blog_page_id = get_page_by_title('Blog');
    update_option('show_on_front', 'page');
    update_option('page_on_front', $front_page_id->ID);
    //update_option('page_for_posts', $blog_page_id->ID);

    // Reset site permalink
    global $wp_rewrite;
    $wp_rewrite->set_permalink_structure('/%postname%/');

}
add_action('pt-ocdi/after_import', 'corpix_after_import_setup');

function ocdi_before_content_import($selected_import)
{
    // Customizer reset
    delete_option('theme_mods_' . get_option('stylesheet'));
    // Old style.
    $theme_name = get_option('current_theme');
    if (false === $theme_name) {
        $theme_name = wp_get_theme()->get('corpix');
    }
    delete_option('mods_' . $theme_name);

    // Activate/Deactivate plugins
    // Check LearnPress LMS
    if ('Home V1' === $selected_import['import_file_name']) {
        global $wp_rewrite;
        $wp_rewrite->set_permalink_structure('/%postname%/');
    } 
    elseif ('Home V2' === $selected_import['import_file_name']) {
        global $wp_rewrite;
        $wp_rewrite->set_permalink_structure('/%postname%/');
    } 
    elseif ('Home V3' === $selected_import['import_file_name']) {
        global $wp_rewrite;
        $wp_rewrite->set_permalink_structure('/%postname%/');
    } 
    elseif ('Home V4' === $selected_import['import_file_name']) {
        global $wp_rewrite;
        $wp_rewrite->set_permalink_structure('/%postname%/');
    } 
    elseif ('Home V5' === $selected_import['import_file_name']) {
        global $wp_rewrite;
        $wp_rewrite->set_permalink_structure('/%postname%/');
    } 
    elseif ('Home V6' === $selected_import['import_file_name']) {
        global $wp_rewrite;
        $wp_rewrite->set_permalink_structure('/%postname%/');
    }    


}
add_action('pt-ocdi/before_content_import', 'ocdi_before_content_import');

