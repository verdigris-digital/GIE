<?php 

	
// Register and load the widget
function drivic_nav_menu_load_widget() {
    register_widget( 'drivic_nav_menu' );
}
add_action( 'widgets_init', 'drivic_nav_menu_load_widget' );



 
// Creating the widget 
class drivic_nav_menu extends WP_Widget {
 
	function __construct() {
		parent::__construct(
		 
		// Base ID of your widget
		'drivic_nav_menu', 
		 
		// Widget name will appear in UI
		__('drivic Nav Menu', 'drivic'), 
		 
		// Widget description
		array( 'description' => __( 'Add Drivic Nav Menu widget ', 'drivic' ), ) 
		);
	}
	 
	// Creating widget front-end
	 
	public function widget( $args, $instance ) {
		// Get menu.
		$nav_menu = ! empty( $instance['nav_menu'] ) ? wp_get_nav_menu_object( $instance['nav_menu'] ) : false;

		if ( ! $nav_menu ) {
			return;
		}

		$title 		 = ! empty( $instance['title'] ) ? $instance['title'] : '';
		$socialtitle = ! empty( $instance['socialtitle'] ) ? $instance['socialtitle'] : '';
		$facebook    = ! empty( $instance['facebook'] ) ? $instance['facebook'] : '';
		$twitter 	 = ! empty( $instance['twitter'] ) ? $instance['twitter'] : '';
		$instagram 	 = ! empty( $instance['instagram'] ) ? $instance['instagram'] : '';
		$behance     = ! empty( $instance['behance'] ) ? $instance['behance'] : '';
		$linkedin    = ! empty( $instance['linkedin'] ) ? $instance['linkedin'] : '';

		/** This filter is documented in wp-includes/widgets/class-wp-widget-pages.php */
		$title = apply_filters( 'widget_title', $title, $instance, $this->id_base );

		echo $args['before_widget'];

		if ( $title ) {
			echo $args['before_title'] . $title . $args['after_title'];
		}

		$nav_menu_args = array(
			'fallback_cb' => '',
			'menu'        => $nav_menu,
		);

		/**
		 * Filters the arguments for the Navigation Menu widget.
		 *
		 * @since 4.2.0
		 * @since 4.4.0 Added the `$instance` parameter.
		 *
		 * @param array    $nav_menu_args {
		 *     An array of arguments passed to wp_nav_menu() to retrieve a navigation menu.
		 *
		 *     @type callable|bool $fallback_cb Callback to fire if the menu doesn't exist. Default empty.
		 *     @type mixed         $menu        Menu ID, slug, or name.
		 * }
		 * @param WP_Term  $nav_menu      Nav menu object for the current menu.
		 * @param array    $args          Display arguments for the current widget.
		 * @param array    $instance      Array of settings for the current widget.
		 */
		wp_nav_menu( apply_filters( 'widget_nav_menu_args', $nav_menu_args, $nav_menu, $args, $instance ) );

		?>
			
			<?php if (!empty($socialtitle)): ?>
				<h4 class="widget-title mt-5 mb-3"><?php echo $socialtitle ?></h4>
			<?php endif ?>
			<ul class="social-area mb-5 mb-lg-0">
				<?php if (!empty($facebook)): ?>
					<li>
	                    <a href="<?php echo $facebook ?>"><i class="fa fa-facebook"></i></a>
	                </li>
				<?php endif ?>
				<?php if (!empty($twitter)): ?>
					<li>
	                    <a href="<?php echo $twitter ?>"><i class="fa fa-twitter"></i></a>
	                </li>
				<?php endif ?>
				<?php if (!empty($instagram)): ?>
					<li>
	                    <a href="<?php echo $instagram ?>"><i class="fa fa-instagram"></i></a>
	                </li>
				<?php endif ?>
				<?php if (!empty($behance)): ?>
					<li>
	                    <a href="<?php echo $behance ?>"><i class="fa fa-behance"></i></a>
	                </li>
				<?php endif ?>
				<?php if (!empty($linkedin)): ?>
					<li>
	                    <a href="<?php echo $linkedin ?>"><i class="fa fa-linkedin"></i></a>
	                </li>
				<?php endif ?>
            </ul>
		<?php

		echo $args['after_widget'];
	}
	         
	public function form( $instance ) {
		global $wp_customize;
		$title    		= isset( $instance['title'] ) ? $instance['title'] : '';
		$socialtitle    = isset( $instance['socialtitle'] ) ? $instance['socialtitle'] : '';
		$facebook    	= isset( $instance['facebook'] ) ? $instance['facebook'] : '';
		$twitter    	= isset( $instance['twitter'] ) ? $instance['twitter'] : '';
		$instagram    	= isset( $instance['instagram'] ) ? $instance['instagram'] : '';
		$behance    	= isset( $instance['behance'] ) ? $instance['behance'] : '';
		$linkedin    	= isset( $instance['linkedin'] ) ? $instance['linkedin'] : '';
		$nav_menu 		= isset( $instance['nav_menu'] ) ? $instance['nav_menu'] : '';

		// Get menus.
		$menus = wp_get_nav_menus();

		$empty_menus_style     = '';
		$not_empty_menus_style = '';
		if ( empty( $menus ) ) {
			$empty_menus_style = ' style="display:none" ';
		} else {
			$not_empty_menus_style = ' style="display:none" ';
		}

		$nav_menu_style = '';
		if ( ! $nav_menu ) {
			$nav_menu_style = 'display: none;';
		}

		// If no menus exists, direct the user to go and create some.
		?>
		<p class="nav-menu-widget-no-menus-message" <?php echo $not_empty_menus_style; ?>>
			<?php
			if ( $wp_customize instanceof WP_Customize_Manager ) {
				$url = 'javascript: wp.customize.panel( "nav_menus" ).focus();';
			} else {
				$url = admin_url( 'nav-menus.php' );
			}

			/* translators: %s: URL to create a new menu. */
			printf( __( 'No menus have been created yet. <a href="%s">Create some</a>.' ), esc_attr( $url ) );
			?>
		</p>
		<div class="nav-menu-widget-form-controls" <?php echo $empty_menus_style; ?>>
			<p>
				<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
				<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo esc_attr( $title ); ?>"/>
			</p>
			<p>
				<label for="<?php echo $this->get_field_id( 'nav_menu' ); ?>"><?php _e( 'Select Menu:' ); ?></label>
				<select id="<?php echo $this->get_field_id( 'nav_menu' ); ?>" name="<?php echo $this->get_field_name( 'nav_menu' ); ?>">
					<option value="0"><?php _e( '&mdash; Select &mdash;' ); ?></option>
					<?php foreach ( $menus as $menu ) : ?>
						<option value="<?php echo esc_attr( $menu->term_id ); ?>" <?php selected( $nav_menu, $menu->term_id ); ?>>
							<?php echo esc_html( $menu->name ); ?>
						</option>
					<?php endforeach; ?>
				</select>
			</p>
			<p>
				<label for="<?php echo $this->get_field_id( 'socialtitle' ); ?>"><?php _e( 'Social Title:' ); ?></label>
				<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'socialtitle' ); ?>" name="<?php echo $this->get_field_name( 'socialtitle' ); ?>" value="<?php echo esc_attr( $socialtitle ); ?>"/>
			</p>
			<p>
				<label for="<?php echo $this->get_field_id( 'facebook' ); ?>"><?php _e( 'Facebook Url:' ); ?></label>
				<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'facebook' ); ?>" name="<?php echo $this->get_field_name( 'facebook' ); ?>" value="<?php echo esc_attr( $facebook ); ?>"/>
			</p>
			<p>
				<label for="<?php echo $this->get_field_id( 'twitter' ); ?>"><?php _e( 'Twitter Url:' ); ?></label>
				<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'twitter' ); ?>" name="<?php echo $this->get_field_name( 'twitter' ); ?>" value="<?php echo esc_attr( $twitter ); ?>"/>
			</p>
			<p>
				<label for="<?php echo $this->get_field_id( 'instagram' ); ?>"><?php _e( 'Instagram Url:' ); ?></label>
				<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'instagram' ); ?>" name="<?php echo $this->get_field_name( 'instagram' ); ?>" value="<?php echo esc_attr( $instagram ); ?>"/>
			</p>
			<p>
				<label for="<?php echo $this->get_field_id( 'behance' ); ?>"><?php _e( 'Behance Url:' ); ?></label>
				<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'behance' ); ?>" name="<?php echo $this->get_field_name( 'behance' ); ?>" value="<?php echo esc_attr( $behance ); ?>"/>
			</p>
			<p>
				<label for="<?php echo $this->get_field_id( 'linkedin' ); ?>"><?php _e( 'Linkedin Url:' ); ?></label>
				<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'linkedin' ); ?>" name="<?php echo $this->get_field_name( 'linkedin' ); ?>" value="<?php echo esc_attr( $linkedin ); ?>"/>
			</p>
			<?php if ( $wp_customize instanceof WP_Customize_Manager ) : ?>
				<p class="edit-selected-nav-menu" style="<?php echo $nav_menu_style; ?>">
					<button type="button" class="button"><?php _e( 'Edit Menu' ); ?></button>
				</p>
			<?php endif; ?>
		</div>
		<?php
	}


	     
	// Updating widget replacing old instances with new
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		if ( ! empty( $new_instance['title'] ) ) {
			$instance['title'] = sanitize_text_field( $new_instance['title'] );
			$instance['socialtitle'] = ( ! empty( $new_instance['socialtitle'] ) ) ? strip_tags( $new_instance['socialtitle'] ) : '';
			$instance['facebook'] = ( ! empty( $new_instance['facebook'] ) ) ? strip_tags( $new_instance['facebook'] ) : '';
			$instance['twitter'] = ( ! empty( $new_instance['twitter'] ) ) ? strip_tags( $new_instance['twitter'] ) : '';
			$instance['instagram'] = ( ! empty( $new_instance['instagram'] ) ) ? strip_tags( $new_instance['instagram'] ) : '';
			$instance['behance'] = ( ! empty( $new_instance['behance'] ) ) ? strip_tags( $new_instance['behance'] ) : '';
			$instance['linkedin'] = ( ! empty( $new_instance['linkedin'] ) ) ? strip_tags( $new_instance['linkedin'] ) : '';
		}
		if ( ! empty( $new_instance['nav_menu'] ) ) {
			$instance['nav_menu'] = (int) $new_instance['nav_menu'];
		}
		return $instance;
	}

} // Class wpb_widget ends here


?>