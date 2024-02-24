<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
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

<div class="error-page-area pd-top-100 pb-4">
    <div class="container">
        <div class="error-text text-center pb-2">
            <h1>404</h1>
            <h4><?php print esc_html__( 'Oops! That page can&rsquo;t be found.', 'drivic' ) ?></h4>
            <p>
            	<?php print esc_html__( 'It looks like nothing was found at this location. Maybe try a search?', 'drivic' ) ?>
            </p>
            <a href="<?php print esc_url(home_url('/')); ?>" class="btn btn-base"><?php esc_html_e( 'Back to hompage', 'drivic' ); ?></a>
        </div>
    </div>
</div>

<?php get_footer() ?>