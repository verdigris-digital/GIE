<?php
	/**
	 * drivic About Widget
	 */
	add_action('widgets_init', 'drivic_about_widget');
	function drivic_about_widget() {
		register_widget('drivic_about_widget');
	}
	
	
	class drivic_about_widget  extends WP_Widget{
		
		const VERSION = '4.2.2';
        
		const CUSTOM_IMAGE_SIZE_SLUG = 'tribe_image_widget_custom';
		
		public function __construct(){
			parent::__construct('drivic_about_widget',esc_html__('Drivic About','drivic'),array(
				'description' => esc_html__('add logo and information','drivic'),
			));
			
			add_action( 'sidebar_admin_setup', array( $this, 'admin_setup' ) );
			add_action( 'admin_head-widgets.php', array( $this, 'admin_head' ) );
		}
		public function admin_setup() {
			wp_enqueue_media();
			wp_enqueue_script( 'drivic-image-widget', plugin_dir_url( __FILE__ ).'js/image-widget.js', array( 'jquery', 'media-upload', 'media-views' ), self::VERSION );
			wp_localize_script( 'drivic-image-widget', 'TribeImageWidget', array(
				'frame_title' => esc_html__( 'Upload Logo', 'drivic' ),
				'button_title' => esc_html__( 'Insert Into Widget', 'drivic' ),
			) );
		}
		
		
		public function widget($args,$instance){
			
			$attachment_id = !empty($instance['attachment_id'])?$instance['attachment_id']:'';
			$imageurl = !empty($instance['imageurl'])?$instance['imageurl']:'';
			$phone  = !empty($instance['phone'])? $instance['phone']:' ';
			$s_desc  = !empty($instance['s_desc'])? $instance['s_desc']:' ';
			$image = '';
			if(!empty($attachment_id)){
				$url = wp_get_attachment_image_src( $attachment_id, array(181,55) );
				$image = $url[0];
			}elseif(!empty($imageurl)){
				$image = $imageurl;
			}
			
			$facebook  = !empty($instance['facebook'])?$instance['facebook']:'';
			$twitter   = !empty($instance['twitter'])?$instance['twitter']:'';
			$youtube   = !empty($instance['youtube'])?$instance['youtube']:'';
			$instagram = !empty($instance['instagram'])?$instance['instagram']:'';


			$widget = $args['before_widget'];
				$widget .='<div class="widget widget_about">';
					$widget .='<div class="thumb">';
						$widget .='<a href="'.esc_url(home_url('/')).'"><img src="'.$image.'" alt="'.esc_html__('logo','drivic').'"></a>';
					$widget .='</div>';
					$widget .='<div class="details">';
						if(!empty($phone)) :
			            	$widget .='<p>'.$phone.'</p>';
						endif;
			            if(!empty($s_desc)) :
			            	$widget .='<p>'.$s_desc.'</p>';
						endif;
						$widget .='<ul class="social-media">';
			                if(!empty($facebook)) :
			                	$widget .='<li><a href="'.esc_url($facebook).'"><i class="fa fa-facebook"></i></a></li>';
							endif;
							if(!empty($twitter)) :
			                	$widget .='<li><a href="'.esc_url($twitter).'"><i class="fa fa-twitter"></i></a></li>';
							endif;
							if(!empty($youtube)) :
			                	$widget .='<li><a href="'.esc_url($youtube).'"><i class="fa fa-youtube"></i></a></li>';
							endif;
							if(!empty($instagram)) :
			                	$widget .='<li><a href="'.esc_url($instagram).'"><i class="fa fa-instagram"></i></a></li>';
							endif;
			            $widget .='</ul>';
					$widget .='</div>';
				$widget .='</div>';
			$widget .= $args['after_widget'];
			print $widget;
		}
		
		/**
		 * widget function.
		 *
		 * @see WP_Widget
		 * @access public
		 * @param array $instance
		 * @return void
		 */
		public function form($instance){
			$instance = wp_parse_args( (array) $instance, self::get_defaults() );
			$id_prefix = $this->get_field_id('');
			$phone  = isset($instance['phone'])? $instance['phone']:'';
			$s_desc  = isset($instance['s_desc'])? $instance['s_desc']:'';
			$facebook = !empty($instance['facebook'])?$instance['facebook']:'';
			$twitter   = !empty($instance['twitter'])?$instance['twitter']:'';
			$youtube   = !empty($instance['youtube'])?$instance['youtube']:'';
			$instagram = !empty($instance['instagram'])?$instance['instagram']:'';
		
			?>
			<div class="uploader">
				<input type="submit" class="button" name="<?php print $this->get_field_name('uploader_button'); ?>" id="<?php print $this->get_field_id('uploader_button'); ?>" value="<?php esc_html_e('Upload Logo', 'drivic'); ?>" onclick="rianaWidget.uploader( '<?php print $this->id; ?>', '<?php print $id_prefix; ?>' ); return false;" />
				<div class="tribe_preview" id="<?php print $this->get_field_id('preview'); ?>">
					<?php print $this->get_image_html($instance, false); ?>
				</div>
				<input type="hidden" id="<?php print $this->get_field_id('attachment_id'); ?>" name="<?php print $this->get_field_name('attachment_id'); ?>" value="<?php echo abs($instance['attachment_id']); ?>" />
				<input type="hidden" id="<?php print $this->get_field_id('imageurl'); ?>" name="<?php print $this->get_field_name('imageurl'); ?>" value="<?php print $instance['imageurl']; ?>" />
			</div>

			<p>
				<label for="<?php echo $this->get_field_id( 'phone' ); ?>"><?php esc_html_e( 'Phone Number', 'drivic' ); ?></label> 
				<input class="widefat" id="<?php echo $this->get_field_id( 'phone' ); ?>" name="<?php echo $this->get_field_name( 'phone' ); ?>" type="text" value="<?php echo esc_attr( $phone ); ?>" />
			</p>
			<p>
				<label for="title"><?php esc_html_e('Short Description:','drivic'); ?></label>
			</p>
			<textarea class="widefat" rows="5" cols="10" id="<?php echo esc_attr($this->get_field_id('s_desc')); ?>" value="<?php echo esc_attr($s_desc); ?>" name="<?php echo esc_attr($this->get_field_name('s_desc')); ?>"><?php echo esc_attr($s_desc); ?></textarea>
			<!-- social media -->
			<p>
			<p>
				<label for="<?php echo $this->get_field_id( 'facebook' ); ?>"><?php esc_html_e( 'Facebook URL', 'drivic' ); ?></label> 
				<input class="widefat" id="<?php echo $this->get_field_id( 'facebook' ); ?>" name="<?php echo $this->get_field_name( 'facebook' ); ?>" type="text" value="<?php echo esc_attr( $facebook ); ?>" />
			</p>
			<p>
				<label for="<?php echo $this->get_field_id( 'twitter' ); ?>"><?php esc_html_e( 'Twitter URL', 'drivic' ); ?></label> 
				<input class="widefat" id="<?php echo $this->get_field_id( 'twitter' ); ?>" name="<?php echo $this->get_field_name( 'twitter' ); ?>" type="text" value="<?php echo esc_attr( $twitter ); ?>" />
			</p>
			<p>
				<label for="<?php echo $this->get_field_id( 'youtube' ); ?>"><?php esc_html_e( 'Youtube URL', 'drivic' ); ?></label> 
				<input class="widefat" id="<?php echo $this->get_field_id( 'youtube' ); ?>" name="<?php echo $this->get_field_name( 'youtube' ); ?>" type="text" value="<?php echo esc_attr( $youtube ); ?>" />
			</p>
			<p>
				<label for="<?php echo $this->get_field_id( 'instagram' ); ?>"><?php esc_html_e( 'Instagram URL', 'drivic' ); ?></label> 
				<input class="widefat" id="<?php echo $this->get_field_id( 'instagram' ); ?>" name="<?php echo $this->get_field_name( 'instagram' ); ?>" type="text" value="<?php echo esc_attr( $instagram ); ?>" />
			</p>
			<?php
		}
				
		public function update( $new_instance, $old_instance ) {
			//$instance = $old_instance;
			$new_instance = wp_parse_args( (array) $new_instance, self::get_defaults() );
			$instance['phone'] 	= strip_tags($new_instance['phone']);
			$instance['s_desc'] 	= strip_tags($new_instance['s_desc']);
			$instance['facebook']	= strip_tags($new_instance['facebook']);
			$instance['twitter'] 	= strip_tags($new_instance['twitter']);
			$instance['youtube'] 	= strip_tags($new_instance['youtube']);
			$instance['instagram']  = strip_tags($new_instance['instagram']);
			
			// Reverse compatibility with $image, now called $attachement_id
			if ( $new_instance['attachment_id'] > 0 ) {
				$instance['attachment_id'] = abs( $new_instance['attachment_id'] );
			} elseif ( $new_instance['image'] > 0 ) {
				$instance['attachment_id'] = $instance['image'] = abs( $new_instance['image'] );
			}
			$instance['imageurl'] = $new_instance['imageurl']; // deprecated
			return $instance;
		}
				
		public function admin_head() {
				?>
			<style type="text/css">
				.uploader input.button {
					width: 100%;
					height: 34px;
					line-height: 33px;
					margin-top: 15px;
				}
				.tribe_preview .aligncenter {
					display: block;
					margin-left: auto !important;
					margin-right: auto !important;
				}
				.tribe_preview {
					overflow: hidden;
					max-height: auto;
				}
				.tribe_preview img {
					margin: 10px 0;
					height: auto;
					width: auto !important;
				}
			</style>
			<?php
		}
		private function get_image_html( $instance, $include_link = true ) {
			// Backwards compatible image display.
			if ( $instance['attachment_id'] == 0 && $instance['image'] > 0 ) {
				$instance['attachment_id'] = $instance['image'];
			}
			$output = '';
			if ( !empty( $instance['imageurl'] ) ) {
				// If all we have is an image src url we can still render an image.
				$src = $instance['imageurl'];
				$output = '<img width="100" height="100" src="'.$src.'" alt="'.esc_html__('img','drivic').'" />';
			} elseif( abs( $instance['attachment_id'] ) > 0 ) {
				$output = wp_get_attachment_image($instance['attachment_id'],array(100,100));
			}
			return $output;
		}
		private static function get_defaults() {

			$defaults = array(
				'title' => '',
				'image' => 0, // reverse compatible - now attachement_id
				'imageurl' => '', // reverse compatible.
				'attachment_id' => 0, // reverse compatible.
			);
			return $defaults;
		}
	}