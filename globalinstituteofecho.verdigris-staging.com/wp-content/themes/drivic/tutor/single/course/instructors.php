<?php
/**
 * Template for displaying course instructors/ instructor
 *
 * @since v.1.0.0
 *
 * @author Themeum
 * @url https://themeum.com
 *
 * @package TutorLMS/Templates
 * @version 1.4.3
 */



do_action('tutor_course/single/enrolled/before/instructors');

$instructors = tutor_utils()->get_instructors_by_course();
if ($instructors){
	?>

	<div class="tutor-course-instructors-wrap tutor-single-course-segment" id="single-course-ratings">
		<?php
		foreach ($instructors as $instructor){
		    $profile_url = tutor_utils()->profile_url($instructor->ID);
			?>
			<div class="widget widget-author-inner">
				<div class="media mb-0">
                    <div class="media-left instructor-avatar">
                        <a href="<?php echo esc_html($profile_url); ?>">
                            <?php echo tutor_utils()->get_tutor_avatar($instructor->ID); ?>
                        </a>
                    </div>

                    <div class="media-body align-self-center">
                        <h5><a href="<?php echo esc_html($profile_url); ?>"><?php echo esc_html($instructor->display_name); ?></a> </h5>
                        <?php
                        if ( ! empty($instructor->tutor_profile_job_title)){
                            echo "<p>{$instructor->tutor_profile_job_title}</p>";
                        }
                        ?>
                        <?php
		                $instructor_rating = tutor_utils()->get_instructor_ratings($instructor->ID);
		                ?>

						<div class="single-instructor-bottom">
							<div class="ratings">
								<span class="rating-generated">
									<?php tutor_utils()->star_rating_generator($instructor_rating->rating_avg); ?>
								</span>
							</div>
						</div>
                    </div>
				</div>
			</div>
			<?php
		}
		?>
	</div>
	<?php
}

do_action('tutor_course/single/enrolled/after/instructors');
