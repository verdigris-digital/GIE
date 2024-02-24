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
class Drivic_Banner extends Widget_Base {

	/**
	 * Retrieve the widget name.
	 * @since 1.0.0
	 * @access public
	 * @return string Widget name.
	**/
	public function get_name() {
		return 'drivic-banner';
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
		return esc_html__( 'Drivic Banner', 'drivic' );
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

		// $this->add_control(
		// 	'banner-style',
		// 	[
		// 		'label' => __( 'Banner Style', 'drivic' ),
		// 		'type' => Controls_Manager::SELECT,
		// 		'default' => '1',
		// 		'options' => [
		// 			'1' => __( 'Banner 1', 'drivic' ),
		// 			'2' => __( 'Banner 2', 'drivic' ),
		// 			'3' => __( 'Banner 3', 'drivic' ),
		// 			'4' => __( 'Banner 4', 'drivic' ),
		// 		],
		// 	]
		// );
		$this->add_control(
			'banner-sub-title',
			[
				'label' => esc_html__( 'Banner Sub Title', 'drivic' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Driving School', 'drivic' ),
			]
		);
		$this->add_control(
			'banner-title',
			[
				'label' => esc_html__( 'Banner Title', 'drivic' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Developing your Driving Skills', 'drivic' ),
			]
		);
		$this->add_control(
			'banner-content',
			[
				'label' => esc_html__( 'Banner Content', 'drivic' ),
				'type' => Controls_Manager::TEXTAREA,
				'default' => __( 'Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'drivic' ),
			]
		);
		$this->add_control(
			'banner-read-more',
			[
				'label' => esc_html__( 'Banner Read More', 'drivic' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Discover More', 'drivic' ),
			]
		);
		$this->add_control(
			'banner-read-more-url',
			[
				'label' => esc_html__( 'Banner Read More Url', 'drivic' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( '#', 'drivic' ),
			]
		);
		$this->add_control(
	   		'image',
	      	[
	          'label' => esc_html__( 'Banner Background Image', 'drivic' ),
	          'type'  => Controls_Manager::MEDIA,
				'dynamic' => [
				'active' => true,
			   ],
	    	]
	    );
	    $this->add_control(
	   		'right-image',
	      	[
	          'label' => esc_html__( 'Banner Right Image', 'drivic' ),
	          'type'  => Controls_Manager::MEDIA,
				'dynamic' => [
				'active' => true,
			   ],
	    	]
	    );
	    $this->add_control(
            'normal-image',
            [
                'label' => esc_html__('Normal Image show', 'caller-core'),
                'type' => Controls_Manager::SWITCHER,
                'description' => esc_html__('you can set yes/no to enable/disable', 'caller-core'),
                'default' => 'yes'
            ]
        );
	    $this->add_control(
	   		'right-image-normal',
	      	[
	          'label' => esc_html__( 'Banner Right Image Normal', 'drivic' ),
	          'type'  => Controls_Manager::MEDIA,
				'dynamic' => [
				'active' => true,
			   ],
			   'condition' => ['normal-image' => 'yes']
	    	]
	    );
	    $this->add_control(
	   		'animate-image',
	      	[
	          'label' => esc_html__( 'Banner Animate Image', 'drivic' ),
	          'type'  => Controls_Manager::MEDIA,
				'dynamic' => [
				'active' => true,
			   ],
	    	]
	    );

	    $this->add_control(
			'banner-add-class',
			[
				'label' => esc_html__( 'Banner Add Class', 'drivic' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'banner-area-1', 'drivic' ),
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

		//bg image
		$images = $settings['image'];
		$image_id = $settings['image']['id'];
		$image_url = wp_get_attachment_image_src( $image_id, 'full', false );

		//main right side image
		$right_images = $settings['right-image'];
		$right_image_id = $settings['right-image']['id'];
		$right_image_url = wp_get_attachment_image_src( $right_image_id, 'full', false );

		//main right side image
		$right_images_normal = $settings['right-image-normal'];
		$right_image_normal_id = $settings['right-image-normal']['id'];
		$right_image_normal_url = wp_get_attachment_image_src( $right_image_normal_id, 'full', false );

		//animate image
		$animate_images = $settings['animate-image'];
		$animate_image_id = $settings['animate-image']['id'];
		$animate_image_url = wp_get_attachment_image_src( $animate_image_id, 'full', false ); ?>

	    <!-- banner start -->
	    <div class="banner-area <?php echo esc_attr($settings['banner-add-class']); ?>" style="background: url( <?php echo esc_url( $image_url[0] ); ?> );">
	        <div class="banner-bg"></div>
	        <div class="container">
	            <div class="row">
	            	<?php if(!empty($right_image_url)) : ?>
			            <div class="col-xl-5 col-lg-5 col-md-7 offset-xl-1 order-lg-12">
			                <div class="mask-bg-wrap mask-bg-img-3">
			                    <div class="thumb">
			                        <img src="<?php echo esc_url( $right_image_url[0] ); ?>" alt="<?php echo esc_attr('img', 'drivic'); ?>">
			                    </div>
			                </div>
			            </div>
			        <?php else : ?>
			        	<?php if(!empty($right_image_normal_url)) : ?>
				        	<div class="col-xl-5 col-lg-5 col-md-7 offset-xl-1 order-lg-12">
			                    <div class="thumb">
			                        <img src="<?php echo esc_url( $right_image_normal_url[0] ); ?>" alt="<?php echo esc_attr('img', 'drivic'); ?>">
			                    </div>
				            </div>
			            <?php endif; ?>
			        <?php endif; ?>

	                <div class="col-xl-6 col-lg-7 align-self-center">
	                    <div class="banner-inner style-white text-center text-lg-left">
	                    	<?php if(!empty($animate_image_url)){ ?>
	                    		<img class="animate-img-1 top_image_bounce" src="<?php echo esc_url( $animate_image_url[0] ); ?>" alt="<?php echo esc_attr('img', 'drivic'); ?>">
	                    	<?php } ?>
	                        <?php if (!empty($settings['banner-sub-title'])) { ?>
				        		<h6 class="b-animate-1 sub-title"><?php echo esc_html( $settings['banner-sub-title']  ); ?></h6>
				        	<?php } ?>
	                        <?php if (!empty($settings['banner-title'])) { ?>
				        		<h1 class="b-animate-2 title"><?php echo esc_html( $settings['banner-title']  ); ?></h1>
				        	<?php } ?>
				        	<?php if (!empty($settings['banner-content'])) { ?>
				        		<p class="content b-animate-3"><?php echo esc_html( $settings['banner-content']  ); ?></p>
				        	<?php } ?>
				        	<?php if (!empty($settings['banner-read-more'])) { ?>
				        		<div class="btn-wrap">
		                            <a class="btn btn-base b-animate-4 mr-3" href="<?php echo esc_html( $settings['banner-read-more-url']  ); ?>"><?php echo esc_html( $settings['banner-read-more']  ); ?></a>
		                        </div>
				        	<?php } ?>
	                    </div>
	                </div>
	            </div>
	        </div>
	    </div>
	    <!-- banner end -->

	<?php }
}
