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
class Drivic_Course_Details extends Widget_Base {

	/**
	 * Retrieve the widget name.
	 * @since 1.0.0
	 * @access public
	 * @return string Widget name.
	**/
	public function get_name() {
		return 'drivic-course-details';
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
		return esc_html__( 'drivic Course Details', 'drivic' );
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
		return ' eicon-tabs';
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

		//about section 
		$this->start_controls_section(
			'overview_content',
			[
				'label' => esc_html__( 'Overview', 'drivic' ),
			]
		);
	    $this->add_control(
			'course_overview',
			[
				'label' => esc_html__( 'Course Overview', 'drivic' ),
				'type' => Controls_Manager::WYSIWYG,
			]
		);
		$this->end_controls_section();

		//Photo Section
		$this->start_controls_section(
			'discussions_content',
			[
				'label' => esc_html__( 'Discussions', 'drivic' ),
			]
		);
		$this->add_control(
			'course_discussions',
			[
				'label' => esc_html__( 'Course Discussions', 'drivic' ),
				'type' => Controls_Manager::WYSIWYG,
			]
		);
		$this->end_controls_section();

		//movie Section
		$this->start_controls_section(
			'course_list_content',
			[
				'label' => esc_html__( 'Course List', 'drivic' ),
			]
		);
		$this->add_control(
			'course-column',
			[
				'label' => __( 'Course Column Style', 'drivic' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'col-lg-6',
				'options' => [
					'col-lg-4' => __( 'col-lg-4', 'drivic' ),
					'col-lg-6' => __( 'col-lg-6', 'drivic' ),
					'col-lg-3' => __( 'col-lg-3', 'drivic' ),
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
			'additional_services_content',
			[
				'label' => esc_html__( 'Additional Services', 'drivic' ),
			]
		);
		$this->add_control( 'additionalservicesItems', [
			'label'       => esc_html__( 'Additional Services', 'drivic' ),
			'type'        => Controls_Manager::REPEATER,
			'fields'      => [
				[
					'name'        => 'title',
					'label'       => esc_html__( 'Add Title', 'drivic' ),
					'type'        => Controls_Manager::TEXT,
					'default'	  => esc_html__('Pre-Licensing Course', 'drivic'),
				],
				[
					'name'        => 'sub_title',
					'label'       => esc_html__( 'Add Sub Title', 'drivic' ),
					'type'        => Controls_Manager::TEXT,
					'default'	  => esc_html__('WITH EXPERIENCED TEACHERS', 'drivic'),
				],
				[
					'name'        => 'content',
					'label'       => esc_html__( 'Add Content', 'drivic' ),
					'type'        => Controls_Manager::TEXTAREA,
					'default'	  => esc_html__('Kaoreet efficitur leo. Aliquam volp lobortis sem consequat consequat imperdiets nulla sed viver ..', 'drivic'),
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
		$additionalservicesItems = $settings['additionalservicesItems'] ?>

		<div class="single-about-info-inner">
			<div class="course-details-nav-tab text-center">
				<ul class="nav nav-tabs" id="myTab" role="tablist">
					<li class="nav-item">
						<a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">
							<i class="fa fa-book"></i>
							<?php echo esc_html('Overview', 'drivic') ?>
						</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">
							<i class="fa fa-file-text-o"></i>
							<?php echo esc_html('Discussions', 'drivic') ?>
						</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">
							<i class="fa fa-graduation-cap"></i>
							<?php echo esc_html('Courses', 'drivic') ?>
						</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" id="tab-4-tab" data-toggle="tab" href="#tab-4" role="tab" aria-controls="tab-4" aria-selected="false">
							<i class="fa fa-star"></i>
							<?php echo esc_html('Additional Services', 'drivic') ?>
						</a>
					</li>
				</ul>
			</div>
			<div class="tab-content" id="myTabContent">
				<div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
					<div class="course-details-content">
						<div class="info">
							<?php echo $settings['course_overview']; ?>
						</div>
					</div>
				</div>
				<div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
					<div class="course-details-content">
						<div class="info">
							<?php echo $settings['course_discussions']; ?>
						</div>
					</div>
				</div>
				<div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
					<?php 
					$course_column  = (isset($settings['course-column']) ? $settings['course-column'] : 'col-lg-4');  ?>
					<div class="course-area">

						<?php global $post; 
						$course_query = new \WP_Query(array('post_type'=> 'courses', 'order'=> $settings['post-order'], 'posts_per_page' => $settings['post-limit'], 'offset' => $settings['post-offset'] )); ?>

						<div class="row justify-content-center">
							<?php if($course_query->have_posts()) : 
								while($course_query->have_posts()) : $course_query->the_post(); ?>

									<div class="<?php echo $course_column ?> col-md-6">
					                    <div class="single-course-inner">
					                        <div class="thumb">
					                            <?php
					                            $course_id = get_the_ID();
												echo get_the_post_thumbnail( null, 'drivic-blog-thumbnail-2', array('class'=> 'img-responsive') );	

												$price_html = '<div><span class="price">'.__('Free', 'tutor').'</span></div>';
												if (tutor_utils()->is_course_purchasable()) {

												    $product_id = tutor_utils()->get_course_product_id($course_id);
												    $product    = wc_get_product( $product_id );

												    if ( $product ) {
													    $price_html = '<div class="course-header-meta"><span class="price">'.$product->get_price_html().'</span></div>';
												    }
												}
												echo $price_html; 
												?>				
												
												<?php
													$course_rating = tutor_utils()->get_course_rating();
												    if (!empty($course_rating)) { ?>
														<?php 
															if ($course_rating->rating_avg > 0) { ?>
																<div class="rating">
											        				<?php echo  apply_filters('tutor_course_rating_average', $course_rating->rating_avg);
											        				echo '/5 <i class="fa fa-star"></i>'; ?>
											        			</div>
															<?php } 
														?>
													<?php }
												?>
					                        </div>
					                        <div class="details-inner">
					                            <div class="course-meta">
					                                <div class="row">
					                                    <div class="col-6">
					                                        <img src="<?php echo get_template_directory_uri().'/assets/img/course/1.png' ?>" alt="img">
					                                        <?php echo get_tutor_course_level(); ?>
					                                    </div>
					                                    <div class="col-6 text-right">
					                                        <img src="<?php echo get_template_directory_uri().'/assets/img/course/2.png' ?>" alt="img">
					                                        <?php print get_tutor_course_duration_context() ?>
					                                    </div>
					                                </div>
					                            </div>
					                            <h4>
					                            	<a href="<?php echo get_the_permalink(); ?>"><?php echo get_the_title(); ?></a>
					                            </h4>
					                            <p><?php print wp_trim_words( get_the_content(), 8, null ); ?></p>
					                            <div class="course-footer">
					                                <div class="row">
					                                    <div class="col-6">
					                                        <div class="course-author">
					                                        	<?php tutor_course_instructors_html(); ?>
					                                        </div>
					                                    </div>
					                                    <div class="col-6 align-self-center text-right">
					                                        <a class="read-more-text" href="<?php echo get_the_permalink(); ?>"><?php echo esc_html('Read More', 'drivic'); ?> <i class="la la-arrow-right"></i></a>
					                                    </div>
					                                </div>
					                            </div>
					                        </div>
					                    </div>
					                </div>
					                
								<?php endwhile;
								wp_reset_postdata();
							endif; ?>
						</div>
					</div>
				</div>
				<div class="tab-pane fade" id="tab-4" role="tabpanel" aria-labelledby="tab-4-tab">
					<div class="row">
						<?php foreach ($additionalservicesItems as $additionalservices_Items) { ?>
							<div class="col-md-6">
								<div class="additional-services-inner">
									<div class="aditional-services-head">
										<h4><?php echo $additionalservices_Items['title']; ?></h4>
										<p><?php echo $additionalservices_Items['sub_title']; ?></p>
									</div>
									<div class="aditional-services-body">
										<p><?php echo $additionalservices_Items['content']; ?></p>
									</div>
								</div>
							</div>
						<?php } ?>
					</div>
				</div>
			</div>
		</div>
	<?php }
}
