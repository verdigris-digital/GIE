<?php
namespace Drivic\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
* Elementor Widget
* Elementor widget for drivic.
* @since 1.0.0
**/
class Drivic_Slider extends Widget_Base {

	/**
	 * Retrieve the widget name.
	 * @since 1.0.0
	 * @access public
	 * @return string Widget name.
	**/
	public function get_name() {
		return 'drivic-slider';
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
		return esc_html__( 'Drivic Slider', 'drivic' );
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
					'name'        => 'title',
					'label'       => esc_html__( 'Add Title', 'drivic' ),
					'type'        => Controls_Manager::TEXT,
					'description' => esc_html__( 'Enter Title', 'drivic' )
				],
				[
					'name'        => 'content',
					'label'       => esc_html__( 'Add Content', 'drivic' ),
					'type'        => Controls_Manager::TEXTAREA,
					'description' => esc_html__( 'Enter Content Here', 'drivic' )
				],
				[
					'name'        => 'btn-txt',
					'label'       => esc_html__( 'Button Text', 'drivic' ),
					'type'        => Controls_Manager::TEXT,
					'description' => esc_html__( 'Enter Button Text', 'drivic' )
				],
				[
					'name'        => 'btn-link',
					'label'       => esc_html__( 'Button Url', 'drivic' ),
					'type'        => Controls_Manager::URL,
					'default'     => array(
						'url' => '#'
					),
				],
				[
					'name'        => 'image',
					'label'       => esc_html__( 'Slider Image', 'drivic' ),
					'type'        => Controls_Manager::MEDIA,
				],


			],
			'title_field' => "{{name}}"
		] );
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
		$sliderItems = $settings['sliderItems'] ?>
		<div class="exp-area user-exp-area">
	        <div class="exp-slider owl-carousel">
	        	<?php
	        		foreach ($sliderItems as $slider_items) { ?>
	        			<div class="item">
				            <div class="row">
				                <div class="col-xl-7 col-lg-6 order-lg-last">
				                    <div class="thumb mb-4 mb-lg-0">
				                        <img src="<?php echo $slider_items['image']['url']; ?>" alt="img">
				                    </div>
				                </div>
				                <div class="col-xl-5 col-lg-6 order-lg-first align-self-center">
				                    <div class="banner-inner">
				                        <h2><?php echo $slider_items['title']; ?></h2>
				                        <p><?php echo $slider_items['content']; ?></p>
				                        <div class="btn-wrap mt-5">
				                            <a class="btn btn-base" href="<?php echo esc_url(  $slider_items['btn-link']['url'] ); ?>"><?php echo $slider_items['btn-txt']; ?></a>
				                        </div>
				                    </div>
				                </div>
				            </div>
				        </div>
	        		<?php }
	        	?>
	        </div>
        </div>
	<?php }
}
