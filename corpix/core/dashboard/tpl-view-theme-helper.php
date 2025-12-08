<?php
/**
 * Template Activate Theme
 *
 *
 * @package corpix\core\dashboard
 * @author Pixelcurve <help.pixelcurve@gmail.com>
 * @since 1.0.0
 */

$allowed_html = [
    'a' => [ 'href' => true, 'target' => true ],
];

?>
<div class="tpc-theme-helper">
    <div class="container-form">
        <h1 class="tpc-title">
            <?php echo esc_html__('Need Help? Pixelcurve Help Center Here', 'corpix');?>
        </h1>
        <div class="tpc-content">
            <p class="tpc-content_subtitle">
                <?php
                    echo wp_kses( __( 'Please read a <a target="_blank" href="https://themeforest.net/page/item_support_policy">Support Policy</a> before submitting a ticket and make sure that your question related to our product issues.', 'corpix' ), $allowed_html);
                ?>
                <br/>
                    <?php
                    echo esc_html__('If you did not find an answer to your question, feel free to contact us.', 'corpix');
                    ?>
            </p>
        </div>
        <div class="tpc-row">
            <div class="tpc-col tpc-col-4">
                <div class="tpc-col_inner">
                    <div class="tpc-info-box_wrapper">
                        <div class="tpc-info-box">
                            <div class="tpc-info-box_icon-wrapper">
                                <div class="tpc-info-box_icon">
                                    <img src="<?php echo esc_url(get_template_directory_uri()) . '/core/admin/img/dashboard/document_icon.png'?>">
                                </div>
                            </div>
                            <div class="tpc-info-box_content-wrapper">
                                <div class="tpc-info-box_title">
                                    <h3 class="tpc-info-box_icon-heading">
                                        <?php
                                            esc_html_e('Documentation', 'corpix');
                                        ?>
                                    </h3>
                                </div>
                                <div class="tpc-info-box_content">
                                    <p>
                                        <?php
                                        esc_html_e('Before submitting a ticket, please read the documentation. Probably, your issue already described.', 'corpix');
                                        ?>
                                    </p>
                                </div>
                                <div class="tpc-info-box_btn">
                                    <a target="_blank" href="http://thepixelcurve.com/docs/corpix/">
                                        <?php
                                            esc_html_e('Visit Documentation', 'corpix');
                                        ?>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tpc-col tpc-col-4">
                <div class="tpc-col_inner">
                    <div class="tpc-info-box_wrapper">
                        <div class="tpc-info-box">
                            <div class="tpc-info-box_icon-wrapper">
                                <div class="tpc-info-box_icon">
                                    <img src="<?php echo esc_url(get_template_directory_uri()) . '/core/admin/img/dashboard/video_icon.png'?>">
                                </div>
                            </div>
                            <div class="tpc-info-box_content-wrapper">
                                <div class="tpc-info-box_title">
                                    <h3 class="tpc-info-box_icon-heading">
                                        <?php
                                            esc_html_e('Video Tutorials', 'corpix');
                                        ?>
                                    </h3>
                                </div>
                                <div class="tpc-info-box_content">
                                    <p>
                                        <?php
                                            esc_html_e('There you can watch tutorial for main issues. How to import demo content? How to create a Mega Menu? etc..', 'corpix');
                                        ?>
                                    </p>
                                </div>
                                <div class="tpc-info-box_btn">
                                    <a target="_blank" href="#">
                                        <?php
                                            esc_html_e('Watch Tutorials', 'corpix');
                                        ?>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tpc-col tpc-col-4">
                <div class="tpc-col_inner">
                    <div class="tpc-info-box_wrapper">
                        <div class="tpc-info-box">
                            <div class="tpc-info-box_icon-wrapper">
                                <div class="tpc-info-box_icon">
                                    <img src="<?php echo esc_url(get_template_directory_uri()) . '/core/admin/img/dashboard/support_icon.png'?>">
                                </div>
                            </div>
                            <div class="tpc-info-box_content-wrapper">
                                <div class="tpc-info-box_title">
                                    <h3 class="tpc-info-box_icon-heading">
                                        <?php
                                            esc_html_e('Support forum', 'corpix');
                                        ?>
                                    </h3>
                                </div>
                                <div class="tpc-info-box_content">
                                    <p>
                                        <?php
                                            esc_html_e('If you did not find an answer to your question, submit a ticket with well describe your issue.', 'corpix');
                                        ?>
                                    </p>
                                </div>
                                <div class="tpc-info-box_btn">
                                    <a target="_blank" href="https://thepixelcurve.com/support/">
                                        <?php
                                            esc_html_e('Create a ticket', 'corpix');
                                        ?>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="theme-helper_desc">
            <?php
                echo wp_kses( __( 'Do You have some other questions? Need Customization? Pre-purchase questions? Ask it <a  target="_blank"  href="mailto:help.pixelcurve@gmail.com">there!</a>', 'corpix' ), $allowed_html);
            ?>
        </div>

    </div>
</div>

