<div class="no-results not-found">
	<header class="page-header">
		<h1 class="post-title"><?php esc_html_e( 'Nothing Found', 'drivic' ); ?></h1>
	</header>
	<div class="page-content">
		<?php
		if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>
			<p><?php printf( esc_html__( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'drivic' ), esc_url( admin_url( 'post-new.php' ) ) ); ?></p>
		<?php else : ?>
			<p><?php esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'drivic' ); ?></p>
			<?php
				get_search_form();
		endif; ?>

		<?php
		wp_link_pages(
			array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'drivic' ),
				'after'  => '</div>',
			)
		);
		?>
	</div>
</div>