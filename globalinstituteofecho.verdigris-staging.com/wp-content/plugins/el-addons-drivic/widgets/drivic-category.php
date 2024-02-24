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
class Drivic_Category extends Widget_Base {

	/**
	 * Retrieve the widget name.
	 * @since 1.0.0
	 * @access public
	 * @return string Widget name.
	**/
	public function get_name() {
		return 'drivic-category';
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
		return esc_html__( 'Drivic Category', 'drivic' );
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
		return 'eicon-product-categories';
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
			'category-style',
			[
				'label' => __( 'Category Style', 'drivic' ),
				'type' => Controls_Manager::SELECT,
				'default' => '1',
				'options' => [
					'1' => __( 'Category ', 'drivic' ),
					'2' => __( 'Category 2', 'drivic' ),
					'3' => __( 'Category 3', 'drivic' ),
				],
			]
		);

		$this->add_control(
			'category-column',
			[
				'label' => __( 'Category Column Style', 'drivic' ),
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
		$course_column  = (isset($settings['category-column']) ? $settings['category-column'] : 'col-lg-4');  ?>

		<div class="category-area">

			<?php global $post; 
			$course_query = new \WP_Query(array('post_type'=> 'courses', 'order'=> $settings['post-order'], 'posts_per_page' => $settings['post-limit'], 'offset' => $settings['post-offset'] ));

			if($settings['category-style'] == 2){ ?>
				<div class="row">
					<?php if($course_query->have_posts()) : 
						while($course_query->have_posts()) : $course_query->the_post(); 
							$image_url = get_the_post_thumbnail_url();

							?>
							<div class="<?php echo $course_column ?> col-sm-6">
			                    <div class="single-category-inner style-two text-center" style="background: url( <?php echo esc_url( $image_url ); ?> );">
			                    	<?php 
		                        		$categories = get_the_terms( $post->ID, 'course-category' );
		                        		if(!empty($categories)){
											foreach( $categories as $category ) {
											    $allCategorys[$category->slug] = $category->name;
											}
											foreach ($allCategorys as $catSlug => $catName) { ?>
												
											<?php }
										}
		                        	?>
		                        	<?php
		                        		if(!empty($catName)){ 
									        $course_categories = get_tutor_course_categories();
									        if(!empty($course_categories) && is_array($course_categories ) && count($course_categories)){
									            ?>
									            <?php
									            foreach ($course_categories as $course_category){
									                $category_name = $course_category->name;
									                $category_link = get_term_link($course_category->term_id); ?>
									                <a class="d-block" href="<?php echo $category_link ?>">
									                	<h4><?php echo $catName ?></h4>
									                	<h6><?php echo tutor_utils()->count_enrolled_users_by_course() . esc_html__(' students', 'drivic') ?></h6>
									                </a>
									            <?php }
									        }
		                        		}
		                        	?>
			                    </div>
			                </div>
	                	<?php endwhile;
					endif; ?>
				</div>
			<?php } elseif($settings['category-style'] == 3){ ?>

				<?php if($course_query->have_posts()) : 
					while($course_query->have_posts()) : $course_query->the_post(); ?> 
						<div class="widget widget-select-inner">
	                		<ul>
		                    	<?php 
	                        		$categories = get_the_terms( $post->ID, 'course-category' );
	                        		if(!empty($categories)){
										foreach( $categories as $category ) {
										    $allCategorys[$category->slug] = $category->name;
										}
										foreach ($allCategorys as $catSlug => $catName) { ?>
											
										<?php }
									}
	                        	?>
		                        <?php
	                        		if(!empty($catName)){ 
								        $course_categories = get_tutor_course_categories();
								        if(!empty($course_categories) && is_array($course_categories ) && count($course_categories)){
								            ?>
								            <?php
								            foreach ($course_categories as $course_category){
								                $category_name = $course_category->name;
								                $category_link = get_term_link($course_category->term_id); ?>
								                <li>
							                        <a href="<?php echo $category_link ?>" class="single-select-inner">
							                            <span class="fa fa-check"></span>
							                            <?php echo $catName ?>
							                        </a>
							                    </li>
								            <?php }
								        }
	                        		}
	                        	?>
		                    </ul>
		                </div>
	               <?php endwhile;
				endif; ?>
			<?php } else { ?>
				<div class="row">
					<?php if($course_query->have_posts()) : 
						while($course_query->have_posts()) : $course_query->the_post(); ?> 
							<div class="<?php echo $course_column ?> col-sm-6">
			                    <div class="single-category-inner text-center">
			                    	<?php 
		                        		$categories = get_the_terms( $post->ID, 'course-category' );
		                        		if(!empty($categories)){
											foreach( $categories as $category ) {
											    $allCategorys[$category->slug] = $category->name;
											}
											foreach ($allCategorys as $catSlug => $catName) { ?>
												
											<?php }
										}
		                        	?>
			                        <?php
		                        		if(!empty($catName)){ 
									        $course_categories = get_tutor_course_categories();
									        if(!empty($course_categories) && is_array($course_categories ) && count($course_categories)){
									            ?>
									            <?php
									            foreach ($course_categories as $course_category){
									                $category_name = $course_category->name;
									                $category_link = get_term_link($course_category->term_id); ?>
									                <a class="d-block" href="<?php echo $category_link ?>">
									                	<h4><?php echo $catName ?></h4>
									                	<h6><?php echo tutor_utils()->count_enrolled_users_by_course() . esc_html__(' students', 'drivic') ?></h6>
									                </a>
									            <?php }
									        }
		                        		}
		                        	?>
			                    </div>
			                </div>
		               <?php endwhile;
					endif; ?>
                </div>
			<?php } ?>

		</div>
	<?php }
}