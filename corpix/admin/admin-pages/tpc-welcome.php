<?php
function corpix_let_to_num( $size ) {
	$l   = substr( $size, -1 );
	$ret = substr( $size, 0, -1 );
	switch ( strtoupper( $l ) ) {
		case 'P':
		$ret *= 1024;
		case 'T':
		$ret *= 1024;
		case 'G':
		$ret *= 1024;
		case 'M':
		$ret *= 1024;
		case 'K':
		$ret *= 1024;
	}
	return $ret;
}
$ssl_check = 'https' === substr( get_home_url('/'), 0, 5 );
$green_mark = '<mark class="green"><span class="dashicons dashicons-yes"></span></mark>';

$corpixtheme = wp_get_theme();

$plugins_counts = (array) get_option( 'active_plugins', array() );

if ( is_multisite() ) {
	$network_activated_plugins = array_keys( get_site_option( 'active_sitewide_plugins', array() ) );
	$plugins_counts            = array_merge( $plugins_counts, $network_activated_plugins );
}
?>

	<h2 class="nav-tab-wrapper">
		<?php

		printf( '<a href="%s" class="nav-tab">%s</a>', admin_url( 'admin.php?page=corpix-admin-menu' ), esc_html__( 'Welcome', 'corpix' ) );

		printf( '<a href="%s" class="nav-tab">%s</a>', admin_url( 'admin.php?page=corpix-theme-active' ), esc_html__( 'Activate Theme', 'corpix' ) );

		printf( '<a href="%s" class="nav-tab">%s</a>', admin_url( 'admin.php?page=tpc-theme-options-panel' ), esc_html__( 'Theme Options', 'corpix' ) );

		if (class_exists('OCDI_Plugin')):
			printf( '<a href="%s" class="nav-tab">%s</a>', admin_url( 'themes.php?page=pt-one-click-demo-import' ), esc_html__( 'Demo Import', 'corpix' ) );
		endif;

        // printf( '<a href="%s" class="nav-tab">%s</a>', admin_url( 'admin.php?page=corpix-theme-plugins' ), esc_html__( 'Theme Plugins', 'corpix' ) );
		
        printf( '<a href="%s" class="nav-tab">%s</a>', admin_url( 'admin.php?page=corpix-requirements' ), esc_html__( 'Requirements', 'corpix' ) );
		
		printf( '<a href="%s" class="nav-tab">%s</a>', admin_url( 'admin.php?page=corpix-help-center' ), esc_html__( 'Help Center', 'corpix' ) );

		?>
	</h2>
	
	

		<div class="corpix-getting-started">
				<div class="corpix-getting-started__box">

					<div class="corpix-getting-started__content">
						<div class="corpix-getting-started__content--narrow">
							<h2><?php echo __( 'Welcome to Corpix', 'corpix' ); ?></h2>
							<p><?php echo __( 'Just complete the steps below and you will be able to use all functionalities of Corpix theme by Pixelcurve:', 'corpix' ); ?></p>
						</div>

	

						<div class="corpix-getting-started__actions corpix-getting-started__content--narrow">
	
							<a href="<?php echo admin_url( 'admin.php?page=corpix-setup' ); ?>" class="button-primary button-large button-next"><?php echo __( 'Getting Started', 'corpix' ); ?></a>
						</div>
					</div>
				</div>
			</div>


	


