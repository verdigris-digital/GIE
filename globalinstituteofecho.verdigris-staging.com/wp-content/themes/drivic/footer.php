<?php
/**
 * The template for displaying the footer
 *
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Drivic
 * @since 1.0
 * @version 1.0
*/ 
?>

<?php 
    // basic option
    global $drivic_option;

    //Footer field
    $subscribe_title  = (isset($drivic_option['subscribe-title']) ? $drivic_option['subscribe-title'] : '');
    $subscribe_content  = (isset($drivic_option['subscribe-content']) ? $drivic_option['subscribe-content'] : '');
    $subscribe_shortcode  = (isset($drivic_option['subscribe-shortcode']) ? $drivic_option['subscribe-shortcode'] : '');
    $footer_bg  = (isset($drivic_option['footer-bg']) ? $drivic_option['footer-bg'] : '');
    $copyright  = (isset($drivic_option['copyright']) ? $drivic_option['copyright'] : '');

?>

<!-- footer area start -->
<?php if(!empty($footer_bg['url'])){ ?>
    <footer class="footer-area bg-overlay mg-top-90" style="background-image: url(<?php echo esc_attr($footer_bg['url']) ?> ); ">
<?php }else { ?>
    <footer class="footer-area bg-overlay mg-top-90">
<?php } ?>
    <div class="container">
        <?php if(!empty($subscribe_shortcode) || is_active_sidebar( 'footer-sidebar' )){ ?>
            <div class="footer-area-padding">    
                <?php if (!empty($subscribe_shortcode)) { ?>
                    <div class="subscribe-area-inner style-white pl-0 pr-0 pt-0">
                        <div class="row">
                            <div class="col-xl-7 col-lg-6 align-self-center mb-4 mb-lg-0">
                                <?php
                                    if (!empty($subscribe_title)) { ?>
                                        <h3><?php print esc_html( $subscribe_title ); ?></h3>
                                    <?php }
                                    if (!empty($subscribe_content)) { ?>
                                        <p><?php print  esc_html( $subscribe_content ); ?></p>
                                    <?php }
                                ?>
                            </div>
                            <div class="col-xl-5 col-lg-6 align-self-center">
                                <?php
                                    if (!empty($subscribe_shortcode)) { 
                                        print do_shortcode($subscribe_shortcode);
                                    }
                                ?>
                            </div>
                        </div>
                    </div>
                <?php } ?>
                <?php if(is_active_sidebar( 'footer-sidebar' )) : ?>
                    <div class="row">
                        <?php 
                            dynamic_sidebar( 'footer-sidebar' );
                        ?>
                    </div>
                <?php endif; ?>
            </div>
        <?php } ?>
    </div>
    <div class="footer-bottom text-center">
        <div class="container">
            <div class="row">
                <div class="col-md-12 align-self-center">
                    <?php if(!empty($copyright)){ ?>
                        <p> <?php print esc_html( $copyright ); ?> </p>
                    <?php }else { ?>
                        <p><?php print esc_html__( 'Copyright © 2022 Drivic. All Right reserved.', 'drivic' ) ?></p>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- footer area end -->

<!-- back to top area start -->
<div class="back-to-top">
    <span class="back-top"><i class="fa fa-angle-up"></i></span>
</div>
<!-- back to top area end -->


<?php wp_footer(); ?>
</body> 
</html>