<?php
/**
* Template Name: Header Three
*
* @package WordPress
* @subpackage Drivic
* @since 1.0
* @version 1.0
*/
get_header(); ?>

<?php 
    // basic option
    global $drivic_option;
    //main menu field
    $page_title_hide  = (isset($drivic_option['page-title-hide']) ? $drivic_option['page-title-hide'] : '');
    $page_title_bg  = (isset($drivic_option['page-title-bg']) ? $drivic_option['page-title-bg'] : '');
?>

<?php  

    if (empty($page_title_hide)) {
        if (!empty($page_title_bg['url'])) {
            drivic_page_title();
        }else {
            drivic_page_title_2();
        }
    }
?>


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