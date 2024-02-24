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
class Drivic_Section_Title extends Widget_Base {

	/**
	 * Retrieve the widget name.
	 * @since 1.0.0
	 * @access public
	 * @return string Widget name.
	**/
	public function get_name() {
		return 'drivic-section-title';
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
		return esc_html__( 'Drivic Section Title', 'drivic' );
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

		$this->add_control(
			'subtitle_line',
			[
				'label' => esc_html__( 'Border Style', 'drivic' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'none',
				'options' => [
					'left-line'  => esc_html__( 'Left Line', 'drivic' ),
					'right-line' => esc_html__( 'Right Line', 'drivic' ),
					'double-line' => esc_html__( 'Double Line', 'drivic' ),
					'none' => esc_html__( 'None', 'drivic' ),
				],
			]
		);

		$this->add_control(
			'sub-title',
			[
				'label' => esc_html__( 'Sub Title', 'drivic' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Add sub title here', 'drivic' ),
			]
		);
		$this->add_control(
			'title',
			[
				'label' => esc_html__( 'Title', 'drivic' ),
				'type' => Controls_Manager::TEXTAREA,
				'default' => __( 'Add Your Title Here', 'drivic' ),
			]
		);
		$this->add_control(
			'content',
			[
				'label' => esc_html__( 'Content', 'drivic' ),
				'type' => Controls_Manager::TEXTAREA,
				'default' => __( 'Add Your Content Here', 'drivic' ),
			]
		);
		$this->add_control(
			'content-2',
			[
				'label' => esc_html__( 'Content 2', 'drivic' ),
				'type' => Controls_Manager::TEXTAREA,
			]
		);
		$this->add_control(
			'small-title',
			[
				'label' => esc_html__( 'Small Title', 'drivic' ),
				'type' => Controls_Manager::TEXTAREA,
				'default' => __( 'We Can Help Develop For Your Driving Skills', 'drivic' ),
			]
		);
		$this->add_control(
			'phone-num',
			[
				'label' => esc_html__( 'Phone Num', 'drivic' ),
				'type' => Controls_Manager::TEXTAREA,
				'default' => __( '+44 - 0184 5698 98a', 'drivic' ),
			]
		);
		$this->add_control(
			'btn-text',
			[
				'label' => esc_html__( 'Btn Text', 'drivic' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'View All Courses', 'drivic' ),
			]
		);
		$this->add_control(
			'btn-url',
			[
				'label' => esc_html__( 'Btn URL', 'drivic' ),
				'type' => Controls_Manager::TEXTAREA,
				'default' => __( '#', 'drivic' ),
			]
		);
		$this->add_control(
			'add-class',
			[
				'label' => esc_html__( 'Add Class', 'drivic' ),
				'type' => Controls_Manager::TEXTAREA,
			]
		);
		$this->add_responsive_control(
			'align',
			[
				'label' => __( 'Alignment', 'drivic' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => __( 'Left', 'drivic' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'drivic' ),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => __( 'Right', 'drivic' ),
						'icon' => 'eicon-text-align-right',
					],
					'justify' => [
						'title' => __( 'Justified', 'drivic' ),
						'icon' => 'eicon-text-align-justify',
					],
				],
				'default' => '',
				'selectors' => [
					'{{WRAPPER}}' => 'text-align: {{VALUE}};',
				],
			]
		);



		$this->end_controls_section();

		$this->start_controls_section(
			'section_style',
			[
				'label' => esc_html__( 'Style', 'drivic'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_responsive_control(
			'bottom_space',
			[
				'label' => __( 'Bottom Spacing', 'drivic'),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .section-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
					'(mobile){{WRAPPER}} .section-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
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
		$settings = $this->get_settings_for_display(); ?>

        <div class="section-title <?php echo esc_attr($settings['add-class']); ?>">
        	<?php if (!empty($settings['sub-title'])) { ?>
        		<h6 class="sub-title <?php echo $settings['subtitle_line']; ?>"><?php echo esc_html( $settings['sub-title']  ); ?></h6>
        	<?php } ?>
        	<?php if (!empty($settings['title'])) { ?>
        		<h2 class="title"><?php echo esc_html( $settings['title']  ); ?></h2>
        	<?php } ?>
        	<?php if (!empty($settings['content'])) { ?>
        		<p class="content"><?php echo esc_html( $settings['content']  ); ?></p>
        	<?php } ?>
        	<?php if (!empty($settings['content-2'])) { ?>
        		<p class="content"><?php echo esc_html( $settings['content-2']  ); ?></p>
        	<?php } ?>
        	<?php if (!empty($settings['small-title'])) { ?>
        		<h4 class="small-title"><?php echo esc_html( $settings['small-title']  ); ?></h4>
        	<?php } ?>
        	<?php if (!empty($settings['phone-num'])) { ?>
        		<h4 class="phone"><i class="la la-phone"></i><?php echo esc_html( $settings['phone-num']  ); ?></h4>
        	<?php } ?>
        	<?php if (!empty($settings['btn-text'])) { ?>
        		<a class="btn btn-base" href="<?php echo esc_url( $settings['btn-url']  ); ?>"><?php echo esc_html( $settings['btn-text']  ); ?></a>
        	<?php } ?>
        	
        </div>
	<?php }
}
