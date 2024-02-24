<?php
namespace Drivic;

/**
 * Class Plugin
 * Main Plugin class
 * @since 1.2.0
 */
class Plugin {

	/**
	 * Instance
	 *
	 * @since 1.2.0
	 * @access private
	 * @static
	 *
	 * @var Plugin The single instance of the class.
	 */
	private static $_instance = null;

	/**
	 * Instance
	 *
	 * Ensures only one instance of the class is loaded or can be loaded.
	 *
	 * @since 1.2.0
	 * @access public
	 *
	 * @return Plugin An instance of the class.
	 */
	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	/**
		 * _widget_categories()
		 * @since 1.0.0
		 * */
		public function _widget_categories($elements_manager){
			$elements_manager->add_category(
				'drivic_widgets',
				[
					'title' => __( 'Drivic Widgets', 'drivic' ),
					'icon' => 'fa fa-plug',
				]
			);
		}

	/**
	 * widget_scripts
	 *
	 * Load required plugin core files.
	 *
	 * @since 1.2.0
	 * @access public
	 */
	public function widget_scripts() {
		wp_register_script( 'drivic', plugins_url( '/assets/js/hello-world.js', __FILE__ ), [ 'jquery' ], false, true );
	}

	/**
	 * Include Widgets files
	 *
	 * Load widgets files
	 *
	 * @since 1.2.0
	 * @access private
	 */
	private function include_widgets_files() {
		require_once( __DIR__ . '/widgets/drivic-section-title.php' );
		require_once( __DIR__ . '/widgets/drivic-banner.php' );
		require_once( __DIR__ . '/widgets/drivic-banner-slider.php' );
		require_once( __DIR__ . '/widgets/drivic-client.php' );
		require_once( __DIR__ . '/widgets/drivic-blog.php' );
		require_once( __DIR__ . '/widgets/drivic-blog-two.php' );
		require_once( __DIR__ . '/widgets/drivic-testimonial.php' );
		require_once( __DIR__ . '/widgets/drivic-intro.php' );
		require_once( __DIR__ . '/widgets/drivic-counter.php' );
		require_once( __DIR__ . '/widgets/drivic-course.php' );
		require_once( __DIR__ . '/widgets/drivic-course-two.php' );
		require_once( __DIR__ . '/widgets/drivic-category.php' );
		require_once( __DIR__ . '/widgets/drivic-slider.php' );
		require_once( __DIR__ . '/widgets/drivic-instructor.php' );
		require_once( __DIR__ . '/widgets/drivic-instructor-two.php' );
		require_once( __DIR__ . '/widgets/drivic-course-details.php' );
	}

	/**
	 * Register Widgets
	 *
	 * Register new Elementor widgets.
	 *
	 * @since 1.2.0
	 * @access public
	 */
	public function register_widgets() {
		// Its is now safe to include Widgets files
		$this->include_widgets_files();

		// Register Widgets
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\Drivic_Section_Title() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\Drivic_Banner() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\Drivic_Banner_slider() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\Drivic_Client() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\Drivic_Blog() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\Drivic_Blog_Two() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\Drivic_Testimonial() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\Drivic_Intro() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\Drivic_Counter() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\Drivic_Course() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\Drivic_Course_Two() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\Drivic_Category() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\Drivic_Slider() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\Drivic_Instructor() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\Drivic_Instructor_Two() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\Drivic_Course_Details() );
	}

	/**
	 *  Plugin class constructor
	 *
	 * Register plugin action hooks and filters
	 *
	 * @since 1.2.0
	 * @access public
	 */
	public function __construct() {
		add_action( 'elementor/elements/categories_registered', array($this,'_widget_categories') );

		// Register widget scripts
		add_action( 'elementor/frontend/after_register_scripts', [ $this, 'widget_scripts' ] );

		// Register widgets
		add_action( 'elementor/widgets/widgets_registered', [ $this, 'register_widgets' ] );
	}
}

// Instantiate Plugin Class
Plugin::instance();
