<?php
namespace Drivic\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
* Elementor Widget
* Elementor widget for Drivic.
* @since 1.0.0
**/
class Drivic_Instructor extends Widget_Base {

	/**
	 * Retrieve the widget name.
	 * @since 1.0.0
	 * @access public
	 * @return string Widget name.
	**/
	public function get_name() {
		return 'drivic-instructor';
	}

	/**
	 * Retrieve the widget title.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return esc_html__( 'Drivic Instructor', 'drivic' );
	}

	/**
	 * Retrieve the widget icon.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-posts-group';
	}

	/**
	 * Retrieve the list of categories the widget belongs to.
	 *
	 * Used to determine where to display the widget in the editor.
	 *
	 * Note that currently Elementor supports only one category.
	 * When multiple categories passed, Elementor uses the first one.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return [ 'drivic_widgets' ];
	}

	/**
	 * Retrieve the list of scripts the widget depended on.
	 *
	 * Used to set scripts dependencies required to run the widget.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return array Widget scripts dependencies.
	 */
	public function get_script_depends() {
		return [ 'drivic' ];
	}

	/**
	 * Register the widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 *
	 * @access protected
	 */
	protected function register_controls() {
		$this->start_controls_section(
			'section_content',
			[
				'label' => esc_html__( 'Content', 'drivic' ),
			]
		);

		$this->add_control(
			'instructor-column',
			[
				'label' => __( 'Course Column Style', 'drivic' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'col-lg-3',
				'options' => [
					'col-lg-3' => __( 'col-lg-3', 'drivic' ),
					'col-lg-4' => __( 'col-lg-4', 'drivic' ),
					'col-lg-6' => __( 'col-lg-6', 'drivic' ),
				],
			]
		);

		$this->add_control(
			'post-order',
			[
				'label' => __( 'Post Order', 'drivic' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'ASC',
				'options' => [
					'ASC' => __( 'ASC', 'drivic' ),
					'DSC' => __( 'DSC', 'drivic' ),
				],
			]
		);
		$this->add_control(
			'post-limit',
			[
				'label'       => esc_html__( 'Post Limit', 'drivic' ),
				'type'        => Controls_Manager::TEXT,
				'description' => esc_html__( 'How Many Post You Display', 'drivic' ),
				'default'     => esc_html__('-1','drivic')
			]
		);
		$this->add_control(
			'post-offset',
			[
				'label'       => esc_html__( 'Post Offset', 'drivic' ),
				'type'        => Controls_Manager::TEXT,
				'description' => esc_html__( 'How Many Post You Offset', 'drivic' ),
				'default'     => esc_html__('0','drivic')
			]
		);



		$this->end_controls_section();

		$this->start_controls_section(
			'section_style',
			[
				'label' => esc_html__( 'Style', 'drivic' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'text_transform',
			[
				'label' => esc_html__( 'Text Transform', 'drivic' ),
				'type' => Controls_Manager::SELECT,
				'default' => '',
				'options' => [
					'' => esc_html__( 'None', 'drivic' ),
					'uppercase' => esc_html__( 'UPPERCASE', 'drivic' ),
					'lowercase' => esc_html__( 'lowercase', 'drivic' ),
					'capitalize' => esc_html__( 'Capitalize', 'drivic' ),
				],
				'selectors' => [
					'{{WRAPPER}} .title' => 'text-transform: {{VALUE}};',
				],
			]
		);
		$this->end_controls_section();
	}

	/**
	 * Render the widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 *
	 * @access protected
	*/
	protected function render() {
		$settings = $this->get_settings_for_display(); 
		$instructor_column  = (isset($settings['instructor-column']) ? $settings['instructor-column'] : 'col-lg-3');  

		global $post; 
		$team_query = new \WP_Query(array('post_type'=> 'team', 'order'=> $settings['post-order'], 'posts_per_page' => $settings['post-limit'], 'offset' => $settings['post-offset'] )); ?>

		<div class="row">
			<?php if($team_query->have_posts()) : 
				while($team_query->have_posts()) : $team_query->the_post();  ?>
					<div class="col-lg-4 col-md-6">
	                    <div class="single-team-inner style-overlay">
	                    	<?php
	                    		$designation = get_post_meta( get_the_ID(), '__drivic__designation', true );
	                    		$facebook = get_post_meta( get_the_ID(), '__drivic__facebook', true );
	                    		$twitter = get_post_meta( get_the_ID(), '__drivic__twitter', true );
	                    		$linkedin = get_post_meta( get_the_ID(), '__drivic__linkedin', true );
	                    		$pinterest = get_post_meta( get_the_ID(), '__drivic__pinterest', true );
	                    		$instagram = get_post_meta( get_the_ID(), '__drivic__instagram', true );
	                    	?>
	                        <div class="thumb">
	                            <?php echo get_the_post_thumbnail( null, 'drivic-team-thumbnail', array('class'=> 'img-responsive') ) ?>                      
	                            <ul class="social-media">
	                            	<?php if(!empty($facebook)){ ?>
	                            		<li>
					                		<a href="<?php echo $facebook; ?>"><i class="fa fa-facebook"></i></a>
					                	</li>
				                	<?php }  ?>
	                                <?php if(!empty($twitter)){ ?>
	                            		<li>
					                		<a href="<?php echo $twitter; ?>"><i class="fa fa-twitter"></i></a>
					                	</li>
				                	<?php }  ?>
	                                <?php if(!empty($linkedin)){ ?>
	                            		<li>
					                		<a href="<?php echo $linkedin; ?>"><i class="fa fa-linkedin"></i></a>
					                	</li>
				                	<?php }  ?>
				                	<?php if(!empty($instagram)){ ?>
	                            		<li>
					                		<a href="<?php echo $instagram; ?>"><i class="fa fa-instagram"></i></a>
					                	</li>
				                	<?php }  ?>
	                            </ul>
	                        </div> 
	                        <div class="details">
	                            <h4><a href="<?php echo get_the_permalink(); ?>"><?php echo get_the_title(); ?></a></h4>
	                            <?php if(!empty($designation)){ ?>
	                            	<span><?php echo $designation; ?></span>
			                	<?php }  ?>
	                        </div>
	                    </div>
	                </div>
            	<?php endwhile;
			endif; ?>
		</div>
	<?php }
}