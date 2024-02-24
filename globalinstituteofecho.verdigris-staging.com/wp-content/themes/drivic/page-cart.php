<?php
/**
 * Template Name: Page Checkout
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
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

<div class="main-blog-area pd-top-120">
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

<?php get_footer() ?>