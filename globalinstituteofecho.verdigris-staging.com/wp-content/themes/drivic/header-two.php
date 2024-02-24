<?php
/**
 * The header for our theme
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Drivic
 * @since 1.0
 * @version 1.0
*/

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
    <?php endif; ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
    <?php 
        // basic option
        global $current_user, $listio_settings, $drivic_option;
        $current_user = wp_get_current_user();

        //header top field
        $header_phone  = (isset($drivic_option['header-phone']) ? $drivic_option['header-phone'] : '');
        $header_email  = (isset($drivic_option['header-email']) ? $drivic_option['header-email'] : '');
        $header_location  = (isset($drivic_option['header-location']) ? $drivic_option['header-location'] : '');

        //header main field
        $preloader_show  = (isset($drivic_option['preloader-show']) ? $drivic_option['preloader-show'] : '');
        $main_logo  = (isset($drivic_option['main-logo']) ? $drivic_option['main-logo'] : '');
        $main_logo_id = isset($main_logo['id']) && !empty($main_logo['id']) ? $main_logo['id'] : '';
        $main_alt = get_post_meta($main_logo_id,'_wp_attachment_image_alt',true);
        $search_icon_show  = (isset($drivic_option['search-icon-show']) ? $drivic_option['search-icon-show'] : '');
        $hamberger_menu_show  = (isset($drivic_option['hamberger-menu-show']) ? $drivic_option['hamberger-menu-show'] : '');

        //header main field
        $right_content  = (isset($drivic_option['right-content']) ? $drivic_option['right-content'] : '');
        $right_content_2  = (isset($drivic_option['right-content-2']) ? $drivic_option['right-content-2'] : '');
        $right_subscribe  = (isset($drivic_option['right-subscribe']) ? $drivic_option['right-subscribe'] : '');

        //social field
        $facebook  = (isset($drivic_option['facebook']) ? $drivic_option['facebook'] : '');
        $twitter  = (isset($drivic_option['twitter']) ? $drivic_option['twitter'] : '');
        $instagram  = (isset($drivic_option['instagram']) ? $drivic_option['instagram'] : '');
        $linkedin  = (isset($drivic_option['linkedin']) ? $drivic_option['linkedin'] : '');
        $pinterest  = (isset($drivic_option['pinterest']) ? $drivic_option['pinterest'] : '');
        $youtube  = (isset($drivic_option['youtube']) ? $drivic_option['youtube'] : '');
        $skype  = (isset($drivic_option['skype']) ? $drivic_option['skype'] : '');
        $dribble  = (isset($drivic_option['dribble']) ? $drivic_option['dribble'] : '');
    ?>

    <?php
        if(!empty($preloader_show)){ ?>
            <!-- preloader area start -->
            <div class="preloader" id="preloader">
                <div class="preloader-inner">
                    <div class="loading-scr">
                        <div class="loading-animation">
                            <img src="<?php (isset($main_logo['url']) ? print esc_url($main_logo['url']) : print get_template_directory_uri() . '/assets/img/logo.svg' ); ?>" alt="<?php echo esc_attr($main_alt); ?>">
                            <div class="load-bar"></div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- preloader area end -->
        <?php }
    ?>

    <!-- search popup start-->
    <div class="body-overlay" id="body-overlay"></div>
    <div class="td-search-popup" id="td-search-popup">
        <form role="search" method="get" class="search-form" action="<?php print esc_url( home_url( '/courses/' ) ); ?>">
            <div class="form-group">
                <input type="search" class="form-control" placeholder="<?php print esc_attr__( 'Search...', 'drivic' ); ?>" value="<?php get_search_query() ?>" name="s" />
            </div>
            <button type="submit" class="submit-btn"><i class="fa fa-search"></i></button>
        </form>
    </div>
    <!-- search popup end-->

    <!--sidebar menu start-->
    <div class="sidebar-menu" id="sidebar-menu">
        <button class="sidebar-menu-close"><i class="fa fa-times"></i></button>
        <div class="sidebar-inner">
            <div class="thumb">
                <a class="main-logo" href="<?php echo esc_url( home_url( '/' ) ); ?>">
                    <img src="<?php (isset($main_logo['url']) ? print esc_url($main_logo['url']) : print get_template_directory_uri() . '/assets/img/logo.svg' ); ?>"  alt="<?php echo esc_attr($main_alt); ?>">
                </a>
            </div>
            <?php if(!empty($right_content)){ ?>
                <p><?php echo esc_html($right_content); ?></p>
            <?php } ?>
            <?php if(!empty($right_content_2)){ ?>
                <p><?php echo esc_html($right_content_2); ?></p>
            <?php } ?>
            <?php if(!empty($header_location || $header_email || $header_phone)){ ?>
                <div class="sidebar-address">
                    <h4 class="mb-3"><?php echo esc_html__('Contact Us', 'drivic') ?></h4>
                    <ul>
                        <?php if(!empty($header_location)){ ?>
                            <li><i class="fa fa-map-marker"></i><?php echo esc_html($header_location); ?></li>
                        <?php } ?>
                        <?php if(!empty($header_email)){ ?>
                            <li><i class="fa fa-envelope"></i><?php echo esc_html($header_email); ?></li>
                        <?php } ?>
                        <?php if(!empty($header_phone)){ ?>
                            <li><i class="fa fa-phone"></i><?php echo esc_html($header_phone); ?></li>
                        <?php } ?>
                    </ul>
                </div>
            <?php } ?>
            <?php 
                if(!empty($right_subscribe)){
                    echo do_shortcode($right_subscribe);
                }
            ?>
            <?php if(!empty($facebook || $twitter || $instagram || $pinterest || $linkedin || $youtube || $skype || $dribble)){ ?>
                <ul class="social-media">
                    <?php
                        if(!empty($facebook)){ ?>
                           <li><a href="<?php echo esc_url($facebook); ?>"><i class="fa fa-facebook-f"></i></a></li> 
                        <?php }
                    ?>
                    <?php
                        if(!empty($twitter)){ ?>
                           <li><a href="<?php echo esc_url($twitter); ?>"><i class="fa fa-twitter"></i></a></li> 
                        <?php }
                    ?>
                    <?php
                        if(!empty($instagram)){ ?>
                           <li><a href="<?php echo esc_url($instagram); ?>"><i class="fa fa-instagram"></i></a></li> 
                        <?php }
                    ?>
                    <?php
                        if(!empty($pinterest)){ ?>
                           <li><a href="<?php echo esc_url($pinterest); ?>"><i class="fa fa-pinterest"></i></a></li> 
                        <?php }
                    ?>
                    <?php
                        if(!empty($linkedin)){ ?>
                           <li><a href="<?php echo esc_url($linkedin); ?>"><i class="fa fa-linkedin"></i></a></li> 
                        <?php }
                    ?>
                    <?php
                        if(!empty($youtube)){ ?>
                           <li><a href="<?php echo esc_url($youtube); ?>"><i class="fa fa-youtube"></i></a></li> 
                        <?php }
                    ?>
                    <?php
                        if(!empty($skype)){ ?>
                           <li><a href="<?php echo esc_url($skype); ?>"><i class="fa fa-skype"></i></a></li> 
                        <?php }
                    ?>
                    <?php
                        if(!empty($dribble)){ ?>
                           <li><a href="<?php echo esc_url($dribble); ?>"><i class="fa fa-dribble"></i></a></li> 
                        <?php }
                    ?>
                </ul>
            <?php } ?>
        </div>
    </div>
    <!--sidebar menu end-->

    <!-- navbar start -->
    <div class="navbar-area style-four">
        <!-- navbar top start -->
        <?php if(!empty($header_phone || $header_email || $facebook || $twitter || $instagram || $pinterest || $linkedin || $youtube || $skype || $dribble)){ ?>
            <div class="navbar-top bg-gray">
                <div class="container">
                    <div class="row">
                        <div class="col-md-8 text-md-left text-center">
                            <ul>
                                <?php if(!empty($header_phone)){ ?>
                                    <li><p><i class="fa fa-map-marker"></i> <?php echo esc_html($header_phone) ?></p></li>
                                <?php } ?>
                                <?php if(!empty($header_email)){ ?>
                                    <li><p><i class="fa fa-envelope-o"></i> <?php echo esc_html($header_email) ?></p></li>
                                <?php } ?>
                            </ul>
                        </div>
                        <?php if(!empty($facebook || $twitter || $instagram || $pinterest || $linkedin || $youtube || $skype || $dribble)){ ?>
                            <div class="col-md-4">
                                <ul class="topbar-right text-md-right text-center">
                                    <li class="social-area">
                                        <?php if(!empty($facebook)){ ?>
                                           <a href="<?php echo esc_url($facebook); ?>"><i class="fa fa-facebook-f"></i></a>
                                        <?php } ?>
                                        <?php if(!empty($twitter)){ ?>
                                            <a href="<?php echo esc_url($twitter); ?>"><i class="fa fa-twitter"></i></a>
                                            <?php } ?>
                                        <?php if(!empty($instagram)){ ?>
                                            <a href="<?php echo esc_url($instagram); ?>"><i class="fa fa-instagram"></i></a>
                                            <?php } ?>
                                        <?php if(!empty($pinterest)){ ?>
                                            <a href="<?php echo esc_url($pinterest); ?>"><i class="fa fa-pinterest"></i></a>
                                            <?php } ?>
                                        <?php if(!empty($linkedin)){ ?>
                                            <a href="<?php echo esc_url($linkedin); ?>"><i class="fa fa-linkedin"></i></a>
                                            <?php } ?>
                                        <?php if(!empty($youtube)){ ?>
                                            <a href="<?php echo esc_url($youtube); ?>"><i class="fa fa-youtube"></i></a>
                                            <?php } ?>
                                        <?php if(!empty($skype)){ ?>
                                            <a href="<?php echo esc_url($skype); ?>"><i class="fa fa-skype"></i></a> 
                                        <?php } ?>
                                        <?php if(!empty($dribble)){ ?>
                                            <a href="<?php echo esc_url($dribble); ?>"><i class="fa fa-dribble"></i></a> 
                                        <?php } ?>
                                    </li>
                                </ul>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        <?php } ?>
        <nav class="navbar navbar-area navbar-expand-lg">
            <div class="container nav-container">
                <div class="responsive-mobile-menu">
                    <button class="menu toggle-btn d-block d-lg-none" data-target="#drivic_main_menu" 
                    aria-expanded="false" aria-label="Toggle navigation">
                        <span class="icon-left"></span>
                        <span class="icon-right"></span>
                    </button>
                </div>
                <div class="logo">
                    <a class="main-logo" href="<?php echo esc_url( home_url( '/' ) ); ?>">
                        <img src="<?php (isset($main_logo['url']) ? print esc_url($main_logo['url']) : print get_template_directory_uri() . '/assets/img/logo.svg' ); ?>"   alt="<?php echo esc_attr($main_alt); ?>">
                    </a>
                </div>
                <?php if(!empty($search_icon_show)){ ?>
                    <div class="nav-right-part nav-right-part-mobile">
                        <a class="search-bar-btn" href="#"><i class="fa fa-search"></i></a>
                    </div>
                <?php } ?>
                <div class="collapse navbar-collapse" id="drivic_main_menu">
                    <?php
                        if ( has_nav_menu( 'main_menu' ) ){  
                            wp_nav_menu( array(
                                'theme_location'  => 'main_menu',
                                'items_wrap'      => '<ul class="navbar-nav menu-open text-right">%3$s</ul>',
                                'container'      =>'',
                                'container_class' => '',
                                'menu_class'      => 'menu',
                            ) ); 
                        }else{
                            wp_nav_menu( array(
                                'menu_id'        => 'primary-menu',
                                'menu_class'        => 'navbar-nav menu-open navbar-nav-primary text-right',
                                'container'        => false,
                            ) );
                        } 
                    ?>
                </div>
                <?php if(!empty($search_icon_show || $hamberger_menu_show)){ ?>
                    <div class="nav-right-part nav-right-part-desktop">
                        <?php if(!empty($search_icon_show)){ ?>
                            <a class="search-bar-btn" href="#"><i class="fa fa-search"></i></a>
                        <?php } ?>
                        <?php if(!empty($hamberger_menu_show)){ ?>
                            <a class="btn btn-base menubar pt-1" id="navigation-button" href="#">
                                <svg width="20" height="18" viewBox="0 0 20 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M0.714286 3.21429H19.2857C19.6802 3.21429 20 2.89451 20 2.5V0.714286C20 0.319777 19.6802 0 19.2857 0H0.714286C0.319777 0 0 0.319777 0 0.714286V2.5C0 2.89451 0.319777 3.21429 0.714286 3.21429ZM0.714286 10.3571H19.2857C19.6802 10.3571 20 10.0374 20 9.64286V7.85714C20 7.46263 19.6802 7.14286 19.2857 7.14286H0.714286C0.319777 7.14286 0 7.46263 0 7.85714V9.64286C0 10.0374 0.319777 10.3571 0.714286 10.3571ZM0.714286 17.5H19.2857C19.6802 17.5 20 17.1802 20 16.7857V15C20 14.6055 19.6802 14.2857 19.2857 14.2857H0.714286C0.319777 14.2857 0 14.6055 0 15V16.7857C0 17.1802 0.319777 17.5 0.714286 17.5Z" fill="white"/>
                                </svg>
                            </a>
                        <?php } ?>
                    </div>
                <?php } ?>
            </div>
        </nav>
    </div>
    <!-- navbar end -->