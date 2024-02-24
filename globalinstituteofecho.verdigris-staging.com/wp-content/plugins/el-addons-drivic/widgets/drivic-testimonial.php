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
class Drivic_Testimonial extends Widget_Base {

	/**
	 * Retrieve the widget name.
	 * @since 1.0.0
	 * @access public
	 * @return string Widget name.
	**/
	public function get_name() {
		return 'drivic-testimonial';
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
		return esc_html__( 'Drivic testimonial', 'drivic' );
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
		$this->add_control( 'testimonialItems', [
			'label'       => esc_html__( 'testimonial', 'drivic' ),
			'type'        => Controls_Manager::REPEATER,
			'fields'      => [
				[
					'name'        => 'content',
					'label'       => esc_html__( 'Add Content', 'drivic' ),
					'type'        => Controls_Manager::TEXTAREA,
					'default'	  => esc_html__('Eurtugul Freeman dolor sit amet, elitr ipscing sad consetetur diam nonumy eirmod invidunt tempor ut elitr labore', 'drivic'),
					'description' => esc_html__( 'Enter Content Here', 'drivic' ),
				],
				[
					'name'        => 'name',
					'label'       => esc_html__( 'Add Title', 'drivic' ),
					'type'        => Controls_Manager::TEXT,
					'default'	  => esc_html__('Abigail Barbara', 'drivic'),
					'description' => esc_html__( 'Enter Title', 'drivic' )
				],
				[
					'name'        => 'designation',
					'label'       => esc_html__( 'Add Title', 'drivic' ),
					'type'        => Controls_Manager::TEXT,
					'default'	  => esc_html__('Ceo', 'drivic'),
					'description' => esc_html__( 'Enter Title', 'drivic' )
				],
				[
					'name'        => 'image',
					'label'       => esc_html__( 'testimonial Image', 'drivic' ),
					'type'        => Controls_Manager::MEDIA,
				],
				[
					'name'        => 'quote_image',
					'label'       => esc_html__( 'quote Image', 'drivic' ),
					'type'        => Controls_Manager::MEDIA,
				],


			],
			'title_field' => "{{name}}"
		] );
		$this->end_controls_section();
		
		$this->start_controls_section(
            'style_settings_section',
            [
                'label' => esc_html__('Style Settings', 'drivic'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control('background', [
            'label' => esc_html__('bg Color', 'drivic'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                "{{WRAPPER}} .single-testimonial-inner" => "background: {{VALUE}}"
            ]
        ]);
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
		$testimonialItems = $settings['testimonialItems'] ?>

        <div class="testimonial-slider slider-control-dots owl-carousel">
        	<?php foreach ($testimonialItems as $testimonial_items) { ?>
	            <div class="item">
	                <div class="single-testimonial-inner">
	                	<?php if(!empty($testimonial_items['quote_image'])){ ?>
	                		<img class="side-icon" src="<?php echo $testimonial_items['quote_image']['url']; ?>" alt="img">
                		<?php } ?>
	                    <p><?php echo $testimonial_items['content']; ?></p>
	                    <div class="media">
	                    	<?php if(!empty($testimonial_items['image'])){ ?>
		                        <div class="media-left">
		                            <img src="<?php echo $testimonial_items['image']['url']; ?>" alt="img">
		                        </div>
	                    	<?php } ?>
	                        <div class="media-body align-self-center">
	                            <h6><?php echo $testimonial_items['name']; ?></h6>
	                            <span><?php echo $testimonial_items['designation']; ?></span>
	                        </div>
	                    </div>
	                </div>
	            </div>
        	<?php } ?>
        </div>
	<?php }
}
