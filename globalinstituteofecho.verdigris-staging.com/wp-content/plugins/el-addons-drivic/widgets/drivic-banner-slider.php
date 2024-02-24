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
class Drivic_Banner_Slider extends Widget_Base {

	/**
	 * Retrieve the widget name.
	 * @since 1.0.0
	 * @access public
	 * @return string Widget name.
	**/
	public function get_name() {
		return 'drivic-banner-slider';
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
		return esc_html__( 'Drivic Banner Slider', 'drivic' );
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
		return ' eicon-post-title';
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

		$this->add_control( 'sliderItems', [
			'label'       => esc_html__( 'Slider', 'drivic' ),
			'type'        => Controls_Manager::REPEATER,
			'fields'      => [
				[
					'name'        => 'banner-sub-title',
					'label'       => esc_html__( 'Add Title', 'drivic' ),
					'type'        => Controls_Manager::TEXT,
					'description' => esc_html__( 'Enter Title', 'drivic' )
				],
				[
					'name'        => 'banner-title',
					'label'       => esc_html__( 'Add Content', 'drivic' ),
					'type'        => Controls_Manager::TEXTAREA,
					'description' => esc_html__( 'Enter Content Here', 'drivic' )
				],
				[
					'name'        => 'banner-content',
					'label'       => esc_html__( 'Add Content', 'drivic' ),
					'type'        => Controls_Manager::TEXTAREA,
					'description' => esc_html__( 'Enter Content Here', 'drivic' )
				],
				[
					'name'        => 'banner-read-more',
					'label'       => esc_html__( 'Button Text', 'drivic' ),
					'type'        => Controls_Manager::TEXT,
					'description' => esc_html__( 'Enter Button Text', 'drivic' )
				],
				[
					'name'        => 'banner-read-more-url',
					'label'       => esc_html__( 'Button Url', 'drivic' ),
					'type'        => Controls_Manager::URL,
					'default'     => array(
						'url' => '#'
					),
				],
			],
			'title_field' => "{{name}}"
		] );
		$this->add_control(
	   		'bg_image',
	      	[
	          'label' => esc_html__( 'Banner Background Image', 'drivic' ),
	          'type'  => Controls_Manager::MEDIA,
				'dynamic' => [
				'active' => true,
			   ],
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
		$sliderItems = $settings['sliderItems']; ?>

	    <!-- banner start -->
	    <div class="banner-area banner-area-slider" style="background: url('<?php echo $settings['bg_image']['url']; ?>')">
	        <div class="banner-bg"></div>
	        <div class="container">
	        	<div class="banner-slider owl-carousel slider-control-square">
	        		<?php
	        		foreach ($sliderItems as $slider_items) { ?>
		        		<div class="item">
							<div class="row">
		        			<div class="col-xl-6 col-lg-7 align-self-center">
			                    <div class="banner-inner style-white">
			                        <?php if (!empty($slider_items['banner-sub-title'])) { ?>
						        		<h6 class="b-animate-1 sub-title"><?php echo esc_html( $slider_items['banner-sub-title']  ); ?></h6>
						        	<?php } ?>
			                        <?php if (!empty($slider_items['banner-title'])) { ?>
						        		<h1 class="b-animate-2 title"><?php echo esc_html( $slider_items['banner-title']  ); ?></h1>
						        	<?php } ?>
						        	<?php if (!empty($slider_items['banner-content'])) { ?>
						        		<p class="content b-animate-3"><?php echo esc_html( $slider_items['banner-content']  ); ?></p>
						        	<?php } ?>
						        	<?php if (!empty($slider_items['banner-read-more'])) { ?>
						        		<div class="btn-wrap">
				                            <a class="btn btn-base b-animate-4 mr-3" href="<?php echo esc_html( $slider_items['banner-read-more-url']  ); ?>"><?php echo esc_html( $slider_items['banner-read-more']  ); ?></a>
				                        </div>
						        	<?php } ?>
			                    </div>
			                </div>
							</div>
		        		</div>
	        		<?php }
		        	?>
	        	</div>
	        </div>
	    </div>
	    <!-- banner end -->

	<?php }
}
