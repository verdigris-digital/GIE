<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
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
        <div class="row justify-content-center">
            <?php if(is_active_sidebar( 'blog-sidebar' )) : ?>   
                <div class="col-lg-8">
            <?php else : ?>
                <div class="col-lg-12">
            <?php endif; ?>
                <?php 
                    if(have_posts()) : 
                        while(have_posts()) : the_post();
                            get_template_part( 'template-parts/content', get_post_format() );
                        endwhile;
                        the_posts_pagination(array(
                            'prev_text'             => '<i class="fa fa-angle-left"></i>',
                            'next_text'             => '<i class="fa fa-angle-right"></i>',
                            'mid_size'              => 2,
                            'screen_reader_text'    => ' '
                        ));
                    else:
                        get_template_part( 'template-parts/content', 'none' );
                    endif;
                ?>
            </div>
            <?php if(is_active_sidebar( 'blog-sidebar' )) : ?>     
                <div class="col-lg-4">
                    <?php get_sidebar(); ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php get_footer() ?>