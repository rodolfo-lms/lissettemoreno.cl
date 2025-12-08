<?php
/**
 * Show messages
 *
 * This template is overridden by Pixelcurve team.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 8.5.0
 */

if ( ! defined( 'ABSPATH' ) ) { 
	exit; // Exit if accessed directly.
}

if ( ! $messages ) {
	return;
}

?>
 
<?php foreach ( $messages as $message ) : ?>
	<div class="woocommerce-info corpix_module_message_box type_info closable"<?php echo wc_get_notice_data_attr( $message ); ?>>
		<div class="message_icon_wrap"><i class="message_icon "></i></div>
		<div class="message_content">
			<div class="message_text">
				<?php echo wc_kses_notice( $message ); ?>
			</div>
		</div>
		<span class="message_close_button"></span>
	</div>
<?php endforeach; ?>
