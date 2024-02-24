<?php
/**
* Template Name: Header Four
*
* @package WordPress
* @subpackage Drivic
* @since 1.0
* @version 1.0
*/
get_header('three'); ?>
	<div class="main-wrap">
		<div class="container">
			<?php
				if(have_posts()){
					while(have_posts()) : the_post();
						the_content();
					endwhile;
				} else {
					get_template_part( 'template-parts/content', 'none' );
				}
			?>
		</div>
	</div>

<?php get_footer(); ?>