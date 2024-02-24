<?php 
// basic option
global $drivic_option;
$page_title_bg  = (isset($drivic_option['page-title-bg']) ? $drivic_option['page-title-bg'] : '');

/*------------------------------------------------ 
	drivic Page Title 
-------------------------------------------------*/
if(!function_exists('drivic_page_title')){
	function drivic_page_title(){ ?>
		<!-- start page title -->
		<div class="breadcrumb-area" style="background-image: url('<?php (isset($page_title_bg['url']) ? print esc_url($page_title_bg['url']) : print get_template_directory_uri() . '/assets/img/header.png' ); ?>">
		    <div class="container">
		        <div class="row">
		            <div class="col-xl-8 col-lg-10">
		                <div class="breadcrumb-inner">
		                	<div class="section-title mb-0">
		                		<?php if (  class_exists( 'WooCommerce' ) && is_product_category() ) { ?>
									<h2 class="woocommerce-products-header__title page-title"><?php woocommerce_page_title(); ?></h2>
								<?php }else { ?>
									<h2 class="page-title"><?php (is_home() && is_front_page()) ? esc_html_e('Blog','drivic') : wp_title($sep = ''); ?></h2>
								<?php } ?>		
			                    <ul class="page-list">
			                        <?php print drivic_breadcrumbs(); ?>
			                    </ul>
			                </div>
		                </div>
		            </div>
		        </div>
		    </div>
		</div>
		<!-- end page title -->
	<?php }
}
if(!function_exists('drivic_page_title_2')){
	function drivic_page_title_2(){ ?>
		<!-- start page title -->
		<div class="breadcrumb-area">
		    <div class="container">
		        <div class="row">
	                <div class="col-xl-8 col-lg-10">
	                	<div class="breadcrumb-inner">
	                		<div class="section-title mb-0">
			                	<?php if (  class_exists( 'WooCommerce' ) && is_product_category() ) { ?>
									<h2 class="woocommerce-products-header__title page-title"><?php woocommerce_page_title(); ?></h2>
								<?php }else { ?>
									<h2 class="page-title"><?php (is_home() && is_front_page()) ? esc_html_e('Blog','drivic') : wp_title($sep = ''); ?></h2>
								<?php } ?>		
			                    <ul class="page-list">
			                        <?php print drivic_breadcrumbs(); ?>
			                    </ul>
			                </div>
		                </div>
	                </div>
		        </div>
		    </div>
		</div>
		<!-- end page title -->
	<?php }
}

/*------------------------------------------------ 
	drivic Archive Page Title 
-------------------------------------------------*/
if(!function_exists('drivic_archive_page_title')){
	function drivic_archive_page_title(){
	?>
		<div class="breadcrumb-area text-md-center">
		    <div class="container">
		        <div class="row">
		            <div class="col-lg-12">
		                <div class="breadcrumb-inner">
		                	<div class="section-title mb-0">
		                        <?php if (  class_exists( 'WooCommerce' ) && is_product_category() ) { ?>
									<h2 class="woocommerce-products-header__title page-title"><?php woocommerce_page_title(); ?></h2>
								<?php }else { ?>
									<h2 class="page-title"><?php (is_home() && is_front_page()) ? esc_html_e('Blog','drivic') : wp_title($sep = ''); ?></h2>
								<?php } ?>		
			                    <ul class="page-list">
			                        <?php print drivic_breadcrumbs(); ?>
			                    </ul>
			                </div>
		                </div>
		            </div>
		        </div>
		    </div>
		</div>
		<!-- end page title -->
	<?php
	}
}

/*------------------------------------------------ 
	drivic Breadcrumbs 
-------------------------------------------------*/
if ( ! function_exists( 'drivic_breadcrumbs' ) ) :
	function drivic_breadcrumbs() {
		
		$home = '<li><a href="'.esc_url(home_url()).'" title="'.esc_html__('Home','drivic').'">'.esc_html__('Home','drivic').'</a></li>';
		$showCurrent = 1;				
		global $post;
		$homeLink = esc_url(home_url());
		if ( is_front_page() ) { return; }	// don't display breadcrumbs on the homepage (yet)
	  
		echo wp_kses('<li><a href="'.esc_url(home_url()).'">Home</a></li>', 'drivic');
		

	    if ( is_category() ) {
			// category section
			$thisCat = get_category(get_query_var('cat'), false);
			if (!empty($thisCat->parent)) echo get_category_parents($thisCat->parent, TRUE, ' ' . '/' . ' ');
			echo '<li>'. esc_html__('Archive for category','drivic').' "' . single_cat_title('', false) . '"' . '</li>';
	    } elseif ( is_search() ) {
			// search section
			echo '<li>' . esc_html__('Search results for','drivic').' "' . get_search_query() . '"' .'</li>';
	    } elseif ( is_day() ) {
			echo '<li><a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a></li>';
			echo '<li><a href="' . get_month_link(get_the_time('Y'),get_the_time('m')) . '">' . get_the_time('F') . '</a> </li>';
			echo '<li>' . get_the_time('d') .'</li>';
	    } elseif ( is_month() ) {
			// monthly archive
			echo '<li><a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> </li>';
			echo '<li>' . get_the_time('F') .'</li>';
	    } elseif ( is_year() ) {
			// yearly archive
			echo '<li>'. get_the_time('Y') .'</li>';
	    } elseif ( is_single() && !is_attachment() ) {
			// single post or page
			if ( get_post_type() != 'post' ) {
				$post_type = get_post_type_object(get_post_type());
				$slug = $post_type->rewrite;
				echo '<li><a href="' . $homeLink . ' ' . $slug['slug'] . '">' . $post_type->labels->singular_name . '</a></li>';
				if ($showCurrent) echo ' <li>'. get_the_title() .'</li>';
			} else {
				$cat = get_the_category(); if (isset($cat[0])) {$cat = $cat[0];} else {$cat = false;}
				if ($cat) {$cats = get_category_parents($cat, TRUE, ' ' .' ' . ' ');} else {$cats=false;}
				if (!$showCurrent && $cats) $cats = preg_replace("#^(.+)\s\s$#", "$1", $cats);
				echo '<li>' .$cats.'</li>';
				if ($showCurrent) echo '<li>' . get_the_title() .'</li>';
			}
	    } elseif ( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ) {
			// some other single item
			$post_type = get_post_type_object(get_post_type());
			echo '<li>' . $post_type->labels->singular_name .'</li>';
		} elseif ( is_attachment() ) {
			// attachment section
			$parent = get_post($post->post_parent);
			$cat = get_the_category($parent->ID); if (isset($cat[0])) {$cat = $cat[0];} else {$cat=false;}
			if ($cat) echo get_category_parents($cat, TRUE, ' ' . ' ' . ' ');
			echo '<li><a href="' . get_permalink($parent) . '">' . $parent->post_title . '</a></li>';
			if ($showCurrent) echo  '<li>' . get_the_title() . '</li>';
	    } elseif ( is_page() && !$post->post_parent ) {
			if ($showCurrent) echo '<li>' . get_the_title() . '</li>';
	    } elseif ( is_page() && $post->post_parent ) {
			// child page
			$parent_id  = $post->post_parent;
			$breadcrumbs = array();
			while ($parent_id) {
				$page = get_page($parent_id);
				$breadcrumbs[] = '<li><a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a></li>';
				$parent_id  = $page->post_parent;
			}
			$breadcrumbs = array_reverse($breadcrumbs);
			for ($i = 0; $i < count($breadcrumbs); $i++) {
				print wp_kses_post($breadcrumbs[$i], 'drivic');
				if ($i != count($breadcrumbs)-1);
			}
			if ($showCurrent) echo '<li>' . get_the_title() . '</li>';
	    } elseif ( is_tag() ) {
			// tags archive
			echo '<li>' . esc_html__('Posts tagged','drivic').' "' . single_tag_title('', false) . '"' . '</li>';
	    } elseif ( is_author() ) {
			// author archive 
			global $author;
			$userdata = get_userdata($author);
			echo '<li>' . esc_html__('Articles posted by','drivic'). ' ' . $userdata->display_name . '</li>';
	    } elseif ( is_404() ) {
			// 404
			echo '<li>' . esc_html__('Not Found','drivic') .'</li>';
	    }elseif( (function_exists( 'is_cart' ) && is_cart() ) || (function_exists( 'is_checkout' ) && is_checkout()) ) {
			if( $page_id = get_option( 'woocommerce_shop_page_id' ) )
			$items[] = sprintf( $item_tpl, esc_url(get_permalink( $page_id )), get_the_title( $page_id ) );

		}
	  
	    if ( get_query_var('paged') ) {
	      if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo '<li> (';
				echo '<li>'.esc_html__('Page','drivic') . ' ' . get_query_var('paged').'</li>';
	      if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ')</li>';
	    }
	  
	  
	}
endif;


/*------------------------------------------------ 
	drivic Comment List 
-------------------------------------------------*/
if(!function_exists('drivic_comment_list')){
	function drivic_comment_list($comment, $args, $depth){
		$GLOBALS['comment'] = $comment;
		extract($args, EXTR_SKIP);
		$avatar = get_avatar( $comment,70,null,null,array('class'=>array('media-object')));
	?>
		<li id="comment-<?php comment_ID(); ?>" class="Block-Comment media">
			<?php if($avatar != null) : ?>
				<?php echo get_avatar($comment, 70 ); ?>
			<?php endif; ?>
			<div class="media-body">
				<h6><?php print get_comment_author_link(); ?></h6>
				<span class="time">
					<?php comment_date( get_option( 'date_format' ) ); ?>
				</span>
				<?php comment_text(); ?>
				<div class="reply">
					<?php comment_reply_link( array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth'],'reply_text'=> '' . esc_html__('Reply','drivic') ) ) ); ?>
				</div>
			</div>
		</li>
	<?php
	}
}



/* -------------------------------------------- *
* TGM for Plugin activation
* -------------------------------------------- */
add_action( 'tgmpa_register', 'drivic_plugins_include');

if(!function_exists('drivic_plugins_include')):
    function drivic_plugins_include(){
        $plugins = array(
            array(
                'name'                  => esc_html__( 'Drivic Post Type', 'drivic' ),
                'slug'                  => 'drivic-post-type',
                'required'              => false,
                'version'               => '',
                'force_activation'      => false,
                'force_deactivation'    => false,
                'source'          		=> get_template_directory_uri().'/inc/demo/drivic-post-type.zip',
            ),
            array(
                'name'                  => esc_html__( 'drivic Elementor Addons', 'drivic' ),
                'slug'                  => 'el-addons-drivic',
                'required'              => false,
                'version'               => '',
                'force_activation'      => false,
                'force_deactivation'    => false,
                'source'          		=> get_template_directory_uri().'/inc/demo/el-addons-drivic.zip',
            ),
            array(
                'name'                  => esc_html__( 'Redux', 'drivic' ),
                'slug'                  => 'redux-framework',
                'required'              => false,
                'version'               => '',
                'force_activation'      => false,
                'force_deactivation'    => false,
                'source'          		=> get_template_directory_uri().'/inc/demo/redux-framework.zip',
            ),
            array(
                'name'                  => esc_html__( 'Elementor', 'drivic' ),
                'slug'                  => 'elementor',
                'required'              => false,
            ),
            array(
                'name'                  => esc_html__( 'Cmb2', 'drivic' ),
                'slug'                  => 'cmb2',
                'required'              => false,
            ),
            array(
                'name'                  => esc_html__( 'Contact Form 7', 'drivic' ),
                'slug'                  => 'contact-form-7',
                'required'              => false,
            ),
            array(
                'name'                  => esc_html__( 'mailchimp for wp', 'drivic' ),
                'slug'                  => 'mailchimp-for-wp',
                'required'              => false,
            ),
            array(
                'name'                  => esc_html__( 'Tutor', 'drivic' ),
                'slug'                  => 'tutor',
                'required'              => false,
            ),
            array(
                'name'                  => esc_html__( 'woocommerce', 'drivic' ),
                'slug'                  => 'woocommerce',
                'required'              => false,
            ),
            array(
                'name'                  => esc_html__( 'One Click Demo Import', 'drivic' ),
                'slug'                  => 'one-click-demo-import',
                'required'              => false,
            ),    
        );

        $config = array(
            'domain'            => 'drivic',
            'default_path'      => '',
            'menu'              => 'install-required-plugins',
            'has_notices'       => true,
            'dismissable'       => true, 
            'dismiss_msg'       => '', 
            'is_automatic'      => false,
            'message'           => ''
        );

        tgmpa( $plugins, $config );
    }

endif;


/**
 * [drivic_import_files description]
 * @return [type] [description]
 */
function drivic_import_files() {
    return array(
        array(
            'import_file_name'           => esc_html__('Drivic Demo Data', 'drivic'),
            'local_import_file'            => trailingslashit( get_template_directory() ) . 'inc/demo/content.xml',
			'local_import_widget_file'     => trailingslashit( get_template_directory() ) . 'inc/demo/widgets.wie',
			'local_import_redux' => trailingslashit( get_template_directory() ) . 'inc/demo/redux.json',
            'import_notice'              => esc_html__( 'After you import this demo, you will have to setup the slider separately.', 'drivic' ),
        ),
    );
}
add_filter( 'pt-ocdi/import_files', 'drivic_import_files' );

/**
 * [ocdi_after_import_setup description]
 * @return [type] [description]
 */
function ocdi_after_import_setup() {
    // Assign menus to their locations.
    $main_menu = get_term_by( 'name', 'Main Menu', 'nav_menu' );

    set_theme_mod( 'nav_menu_locations', array(
            'main-menu' => $main_menu->term_id,
        )
    );

    // Assign front page and posts page (blog page).
    $front_page_id = get_page_by_title( 'Home' );
    $blog_page_id  = get_page_by_title( 'Blog' );

    update_option( 'show_on_front', 'page' );
    update_option( 'page_on_front', $front_page_id->ID );
    update_option( 'page_for_posts', $blog_page_id->ID );

}
add_action( 'pt-ocdi/after_import', 'ocdi_after_import_setup' );