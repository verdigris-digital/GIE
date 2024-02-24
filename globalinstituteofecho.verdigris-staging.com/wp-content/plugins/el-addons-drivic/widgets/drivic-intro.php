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
class Drivic_Intro extends Widget_Base {

	/**
	 * Retrieve the widget name.
	 * @since 1.0.0
	 * @access public
	 * @return string Widget name.
	**/
	public function get_name() {
		return 'drivic-intro';
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
		return esc_html__( 'Drivic Intro', 'drivic' );
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
		return 'eicon-archive-posts';
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
            'icon_selector',
            [
                'label' => esc_html__('Icon Selector', 'drivic'),
                'type' => Controls_Manager::SELECT,
                'default' => 'image',
                'options' => [
                    'text_icon' => esc_html__('Text Icon', 'drivic'),
                    'icon' => esc_html__('Icon', 'drivic'),
                    'image' => esc_html__('Image', 'drivic'),
                ],
            ]
        );
        $this->add_control(
            'text_icon',
            [
                'label' => esc_html__('Text Number', 'drivic'),
                'type' => Controls_Manager::TEXT,
                'description' => esc_html__('enter number.', 'drivic'),
                'default' => esc_html__('1', 'exgrid-core'),
                'condition' => ['icon_selector' => 'text_icon']
            ]
        );
		$this->add_control(
            'icon',
            [
                'label' => esc_html__('Icon', 'drivic'),
                'type' => \Elementor\Controls_Manager::ICONS,
                'description' => esc_html__('select Icon.', 'drivic'),
                'default' => [
                    'value' => 'fas fa-phone-alt',
                    'library' => 'solid',
                ],
                'condition' => ['icon_selector' => 'icon']
            ]
        );
        $this->add_control(
            'image',
            [
                'label' => esc_html__('Image', 'exgrid-core'),
                'type'  => Controls_Manager::MEDIA,
				'dynamic' => [
				'active' => true,
			   ],
                'description' => esc_html__('select Icon.', 'drivic'),
                'condition' => ['icon_selector' => 'image']
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
			'add_class',
			[
				'label' => esc_html__( 'Extra Class', 'drivic' ),
				'type' => Controls_Manager::TEXT,
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
		$icon_selector = $settings['icon_selector'];
		
		?>

		<div class="single-intro-inner media <?php echo esc_attr($settings['add_class']); ?>">
            <div class="media-left thumb">
				<?php if($icon_selector == 'text_icon'){ ?>
					<h2><?php echo $settings['text_icon']; ?></h2>
				<?php }elseif($icon_selector == 'icon') { ?>
				
					<?php
						if (!empty($settings['icon'])) {
							\Elementor\Icons_Manager::render_icon( $settings['icon'], [ 'aria-hidden' => 'true' ] ); 
						}
					?>
					
				<?php }else { ?>
					<?php if (!empty($settings['image']['url'])) { ?>
						<img src="<?php echo $settings['image']['url']; ?>" alt="img">
					<?php } ?>
				<?php } ?>
			</div>
            <div class="details media-body">
                <?php if (!empty($settings['title'])) { ?>
	        		<h4 class="title"><?php echo esc_html( $settings['title']  ); ?></h4>
	        	<?php } ?>
                <?php if (!empty($settings['content'])) { ?>
	        		<p><?php echo esc_html( $settings['content']  ); ?></p>
	        	<?php } ?>
            </div>
        </div>
	<?php }
}