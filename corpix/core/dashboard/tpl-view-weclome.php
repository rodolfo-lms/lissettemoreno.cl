<?php
/**
 * Template Welcome
 *
 *
 * @package corpix\core\dashboard
 * @author Pixelcurve <help.pixelcurve@gmail.com>
 * @since 1.0.0
 */

$theme = wp_get_theme();

$allowed_html = [
    'a' => [
        'href' => true,
        'target' => true,
    ],
];

?>
<div class="tpc-welcome_page">
    <div class="tpc-welcome_title">
        <h1><?php esc_html_e('Welcome to', 'corpix');?>
            <?php echo esc_html(wp_get_theme()->get('Name')); ?>
        </h1>
    </div>
    <div class="tpc-version_theme">
        <?php esc_html_e('Version - ', 'corpix');?>
        <?php echo esc_html(wp_get_theme()->get('Version')); ?>
    </div>
    <div class="tpc-welcome_subtitle">
            <?php
                echo sprintf(esc_html__('%s is already installed and ready to use! Let\'s build something impressive.', 'corpix'), esc_html(wp_get_theme()->get('Name'))) ;
            ?>
    </div>

    <div class="tpc-welcome-step_wrap">
        <div class="tpc-welcome_sidebar left_sidebar">
            <div class="theme-screenshot">
                <img src="<?php echo esc_url(get_template_directory_uri() . "/screenshot.png"); ?>">

            </div>
        </div>
        <div class="tpc-welcome_content">
            <div class="step-subtitle">
                <?php
                    echo sprintf(esc_html__('Just complete the steps below and you will be able to use all functionalities of %s theme by Pixelcurve:', 'corpix'), esc_html(wp_get_theme()->get('Name')));
                ?>
            </div>
            <ul>
              <li>
                  <span class="step">
                      <?php esc_html_e('Step 1', 'corpix');?>
                  </span>
                  <?php esc_html_e('Activate your license.', 'corpix');?>
                  <span class="attention-title">
                      <strong>
                          <?php esc_html_e('Important:', 'corpix');?>
                      </strong>
                      <?php esc_html_e('one license  only for one website', 'corpix');?>
                  </span>
              </li>
              <li>
                  <span class="step">
                      <?php esc_html_e('Step 2', 'corpix');?>
                  </span>
                  <?php
                echo sprintf( wp_kses( __( 'Check <a target="_blank" href="%s">requirements</a> to avoid errors with your WordPress.', 'corpix' ), $allowed_html), esc_url( admin_url( 'admin.php?page=corpix-requirements' ) ) );

                  ?>
              </li>
              <li>
                  <span class="step">
                      <?php esc_html_e('Step 3', 'corpix');?>
                  </span>
                  <?php esc_html_e('Install Required and recommended plugins.', 'corpix');?>
              </li>
              <li>
                  <span class="step">
                      <?php esc_html_e('Step 4', 'corpix');?>
                  </span>
                  <?php esc_html_e('Import demo content', 'corpix');?>
              </li>
            </ul>
        </div>

    </div>


</div>
