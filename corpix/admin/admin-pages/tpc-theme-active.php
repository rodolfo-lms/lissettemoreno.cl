


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
	
	
	<div class="corpix-section nav-tab-active" id="activate-theme">

	<?php corpix_tv_options_page(); ?>

	</div>

