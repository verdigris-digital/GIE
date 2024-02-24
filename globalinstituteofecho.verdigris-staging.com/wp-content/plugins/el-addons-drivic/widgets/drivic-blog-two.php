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
class Drivic_Blog_Two extends Widget_Base {

	/**
	 * Retrieve the widget name.
	 * @since 1.0.0
	 * @access public
	 * @return string Widget name.
	**/
	public function get_name() {
		return 'drivic-blog-two';
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
		return esc_html__( 'Drivic Blog Two', 'drivic' );
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
		return 'eicon-menu-card';
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
			'blog-column',
			[
				'label' => __( 'Blog Column Style', 'drivic' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'col-lg-4',
				'options' => [
					'col-lg-4' => __( 'col-lg-4', 'drivic' ),
					'col-lg-6' => __( 'col-lg-6', 'drivic' ),
					'col-lg-3' => __( 'col-lg-3', 'drivic' ),
					'col-lg-12' => __( 'col-lg-12', 'drivic' ),
				],
			]
		);

		$this->add_control(
			'post-order',
			[
				'label' => __( 'Post Order', 'drivic' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'DSC',
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
		$course_column  = (isset($settings['blog-column']) ? $settings['blog-column'] : 'col-lg-4');  ?>


		<div class="blog-area">

			<?php $blog_query = new \WP_Query(array('post_type'=> 'post', 'order'=> $settings['post-order'], 'posts_per_page' => $settings['post-limit'], 'offset' => $settings['post-offset'] )); ?>
			<div class="row justify-content-center">
				<?php if($blog_query->have_posts()) : 
					while($blog_query->have_posts()) : $blog_query->the_post(); ?>
						<div class="<?php echo $course_column ?> col-md-6">
							<div class="single-blog-inner style-four">
		                        <div class="thumb">
		                            <?php echo get_the_post_thumbnail( null, 'drivic-blog-thumbnail-2', array('class'=> 'img-responsive') ) ?>
		                            <div class="date"><?php echo get_the_date('d F') ?></div>
		                        </div>
		                        <div class="details">
		                            <ul class="blog-meta">
		                                <li><i class="fa fa-user-circle-o"></i> <?php the_author(); ?></li>
					                    <li>
					                        <i class="fa fa-comments-o"></i>
					                        <?php print get_comments_number(); ?>
					                        <?php echo esc_html__('Comment', 'drivic'); ?>
					                    </li>
		                            </ul>
		                            <h4><a href="<?php echo get_the_permalink(); ?>"><?php echo get_the_title(); ?></a></h4>
		                            <p class="content"><?php print wp_trim_words( get_the_content(), 10, null ); ?></p>
		                            <a class="read-more-text ml-0" href="<?php echo get_the_permalink(); ?>">
		                            	<?php echo esc_html('Read More', 'drivic'); ?> 
		                            	 <i class="la la-arrow-right"></i>
		                            </a>
		                        </div>
		                    </div>
		                </div>
					<?php endwhile;
					wp_reset_postdata();
				endif; ?>
			</div>
		</div>
	<?php }
}