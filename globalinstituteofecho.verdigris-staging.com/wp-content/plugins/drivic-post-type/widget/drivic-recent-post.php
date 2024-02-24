<?php 

	
// Register and load the widget
function drivic_recent_post_load_widget() {
    register_widget( 'drivic_recent_post' );
}
add_action( 'widgets_init', 'drivic_recent_post_load_widget' );



 
// Creating the widget 
class drivic_recent_post extends WP_Widget {
 
	function __construct() {
		parent::__construct(
		 
		// Base ID of your widget
		'drivic_recent_post', 
		 
		// Widget name will appear in UI
		__('drivic Recent Post', 'drivic'), 
		 
		// Widget description
		array( 'description' => __( 'Add Drivic Recent Post widget ', 'drivic' ), ) 
		);
	}
	 
	// Creating widget front-end
	 
	public function widget( $args, $instance ) {
		$title 		= (isset($instance['title']) ? $instance['title'] : '');
		$order 		= (isset($instance['order']) ? $instance['order'] : '');
		$post_limit = (isset($instance['post_limit']) ? $instance['post_limit'] : '');
		 
		// before and after widget arguments are defined by themes
		print $args['before_widget'];
		print $args['before_title'] . $title . $args['after_title']; 
		 
		// This is where you run the code and display the output
		$output = '';
			$output .='<div class="widget-recent-post">
                <ul>';
					$rpost_query = new WP_Query(array('post_type'=> 'post', 'order'=> $order , 'posts_per_page'=> $post_limit));
            		if($rpost_query->have_posts()) :
						while($rpost_query->have_posts()) : $rpost_query->the_post();
							$output .='<li>
					            <div class="media">
					                <div class="media-left">
					                    '.get_the_post_thumbnail( null, 'drivic-widget-recent-post-thumb', array('class'=> 'img-responsive') ).'
					                </div>
					                <div class="media-body">
					                    <h6><a href="'.esc_url(get_the_permalink()).'">'.get_the_title().'</a></h6>
					                    <span class="post-date">'.get_the_time(get_option( 'date_format' )).'</span>
					                </div>
					            </div>
					        </li>';	
						
						endwhile;
					endif;
                $output .='</ul>
            </div>';
		print $output;
		

		print $args['after_widget'];
	}
	         
	// Widget Backend 
	public function form( $instance ) {
		$title 		= (isset($instance['title']) ? $instance['title'] : '');
		$order 		= (isset($instance['order']) ? $instance['order'] : '');
		$post_limit = (isset($instance['post_limit']) ? $instance['post_limit'] : '');


		// Widget admin form
		?>
		<p>
			<label for="<?php print $this->get_field_id('title'); ?>"><?php esc_html_e( 'Title:', 'drivic' ); ?></label>
			<input class="widefat" type="text" id="<?php print $this->get_field_id('title'); ?>" name="<?php print $this->get_field_name('title'); ?>" value="<?php print esc_attr($title); ?>">
		</p>
		<p>
			<label for="<?php print $this->get_field_id('order'); ?>"><?php esc_html_e( 'Order:', 'drivic' ); ?></label>
			<input class="widefat" type="text" id="<?php print $this->get_field_id('order'); ?>" name="<?php print $this->get_field_name('order'); ?>" value="<?php print esc_attr($order); ?>">
		</p>
		<p>
			<label for="<?php print $this->get_field_id('post_limit'); ?>"><?php esc_html_e( 'Post limit:', 'drivic' ); ?></label>
			<input class="widefat" type="text" id="<?php print $this->get_field_id('post_limit'); ?>" name="<?php print $this->get_field_name('post_limit'); ?>" value="<?php print esc_attr($post_limit); ?>">
		</p>



		<?php 
	}


	     
	// Updating widget replacing old instances with new
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		$instance['order'] = ( ! empty( $new_instance['order'] ) ) ? strip_tags( $new_instance['order'] ) : '';
		$instance['post_limit'] = ( ! empty( $new_instance['post_limit'] ) ) ? strip_tags( $new_instance['post_limit'] ) : '';
		return $instance;
	}

} // Class wpb_widget ends here


?>