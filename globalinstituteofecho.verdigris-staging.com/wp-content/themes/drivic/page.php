<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
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
        <div class="row justify-content-center">
            <?php if(is_active_sidebar( 'blog-sidebar' )) : ?>   
                <div class="col-lg-8">
            <?php else : ?>
                <div class="col-lg-12">
            <?php endif; ?>
				<?php 
					if(have_posts()) : 
						while(have_posts()) : the_post();
                            echo "<div class='dmne-page-content'>";
							    the_content();
                            echo "</div>";
						endwhile; ?>

                        <div class="dmne-page-pagination">
                            <?php

                            wp_link_pages(
                                array(
                                    'before'   => '<nav class="page-links" aria-label="' . esc_attr__( 'Page', 'drivic' ) . '">',
                                    'after'    => '</nav>',
                                    /* translators: %: Page number. */
                                    'pagelink' => esc_html__( 'Page %', 'drivic' ),
                                )
                            );
                            ?>
                        </div><!-- .entry-content -->

                        <?php if ( get_edit_post_link() ) : ?>
                            <footer class="dmne-page-edit">
                                <?php
                                edit_post_link(
                                    sprintf(
                                        esc_html__( 'Edit %s', 'drivic' ),
                                        '<span class="screen-reader-text">' . get_the_title() . '</span>'
                                    ),
                                    '<span class="edit-link">',
                                    '</span>'
                                );
                                ?>
                            </footer><!-- .entry-footer -->
                        <?php endif; 
						
		                if ( comments_open() || get_comments_number() ) :
							comments_template();
						endif;
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

<?php get_footer('two') ?>