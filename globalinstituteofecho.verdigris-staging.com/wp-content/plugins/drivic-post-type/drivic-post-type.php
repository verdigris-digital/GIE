<?php 

if( !defined( 'ABSPATH' ) ) exit;

/*
* Plugin Name: Drivic Custom Post
* Description: Creates shortcodes, register custom taxonomies and post types
* Version: 1.0.0
* Author: drivic
* Author URI: http://drivic.net
*/

define('DRIVIC_CMB2_ACTIVED', in_array('cmb2/init.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) )));

if(DRIVIC_CMB2_ACTIVED){
	require_once plugin_dir_path( __FILE__ ) . 'drivic_metabox.php';
}

/*-----------------------------------------------------
	## Custom widget types
------------------------------------------------------*/
require_once plugin_dir_path( __FILE__ ) . 'widget/drivic-about-widget.php';
require_once plugin_dir_path( __FILE__ ) . 'widget/drivic-recent-post.php';
require_once plugin_dir_path( __FILE__ ) . 'widget/drivic-nav-menu-widget.php';


/*------------------------------------------------ 
	Team Post Type
-------------------------------------------------*/
if(!function_exists('drivic_team_post_type')){
	function drivic_team_post_type(){
		$labels = array(
			'name'  				=> esc_html__( 'Team', 'drivic' ),
			'singular_name'			=> esc_html__( 'Team', 'drivic' ),
			'menu_name'				=> esc_html__( 'Team', 'drivic' ),
			'parent_item_colon'		=> esc_html__( 'Parent team', 'drivic' ),
			'all_items'				=> esc_html__( 'All team', 'drivic' ),
			'view_item'				=> esc_html__( 'View team', 'drivic' ),
			'add_new_item'        	=> esc_html__( 'Add New team', 'drivic' ),
			'add_new'             	=> esc_html__( 'New team', 'drivic' ),
			'edit_item'           	=> esc_html__( 'Edit team', 'drivic' ),
			'update_item'         	=> esc_html__( 'Update team', 'drivic' ),
			'search_items'        	=> esc_html__( 'Search team', 'drivic' ),
			'not_found'           	=> esc_html__( 'No team found', 'drivic' ),
			'not_found_in_trash'  	=> esc_html__( 'No team found in Trash', 'drivic' )
		);
		$args = array(
			'labels'			=> $labels,
			'public'			=> true,
			'publicly_queryable'=> true,
			'show_in_menu'		=> true,
			'show_in_admin_bar'	=> true,
			'can_export'		=> true,
			'has_archive'		=> false,
			'hierarchical'		=> false,
			'menu_icon'			=> 'dashicons-clipboard',
			'supports'			=> array('title', 'editor', 'thumbnail'),
			'taxonomies'        => array( 'category', 'post_tag'),
		);

		register_post_type( 'team', $args );
	}
}
add_action( 'init', 'drivic_team_post_type');



/*------------------------------------------------ 
	Single page template for team
-------------------------------------------------*/
if(!function_exists('drivic_team_post_template')){
	function drivic_team_post_template($single_template){
		global $post;
		if($post->post_type == 'team'){
			$single_template = plugin_dir_path( __FILE__ ) . 'single/single-team.php';
		}
		return $single_template;
	}
}
add_filter( 'single_template', 'drivic_team_post_template' );
/*-----------------------------------------------------
	## Custom post share single post
------------------------------------------------------*/
function social_icons_hook() {
	global $post;
	// Get current page URL 
	$crunchifyURL = get_permalink();
 
	// Get current page title
	$crunchifyTitle = str_replace( ' ', '%20', get_the_title());
	$twitterURL = 'https://twitter.com/intent/tweet?text='.$crunchifyTitle.'&amp;url='.$crunchifyURL.'&amp;via=Crunchify';
	$facebookURL = 'https://facebook.com/sharer/sharer.php?u='.$crunchifyURL;
	$linkedinURL = 'https://linkedin.com/share?url='.$crunchifyURL;
	$pinterest = 'http://pinterest.com/pin/create/button/?url='.$crunchifyURL;
	?>
	<strong><?php echo esc_html__('Share :', 'drivic'); ?></strong>
	<ul class="social-area">
		<li>
			<a href="<?php print esc_url($facebookURL); ?>" target="_blank"><i class="fa fa-facebook"></i></a>
		</li>
		<li>
			<a href="<?php print esc_url($twitterURL); ?>" target="_blank"><i class="fa fa-twitter"></i></a>
		</li>
		<li>
			<a href="<?php print esc_url($linkedinURL); ?>" target="_blank"><i class="fa fa-linkedin"></i></a>
		</li>
		<li>
			<a href="<?php print esc_url($pinterest); ?>" target="_blank"><i class="fa fa-pinterest"></i></a>
		</li>
	</ul>
	<?php
}
add_action( 'social_icons_action', 'social_icons_hook', 10, 2 );