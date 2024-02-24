<?php
/**
 * Display attachments
 *
 * @since v.1.0.0
 * @author themeum
 * @url https://themeum.com
 *
 * @package TutorLMS/Templates
 * @version 1.4.3
 */

if ( ! defined( 'ABSPATH' ) )
	exit;


do_action('tutor_course/single/before/complete_form');

$is_completed_course = tutor_utils()->is_completed_course();
if ( ! $is_completed_course) {
	?>
    <div class="tutor-course-compelte-form-wraps mt-2">

        <form method="post">
			<?php wp_nonce_field( tutor()->nonce_action, tutor()->nonce ); ?>

            <input type="hidden" value="<?php echo get_the_ID(); ?>" name="course_id"/>
            <input type="hidden" value="tutor_complete_course" name="tutor_action"/>

            <button type="submit" class="btn btn-white w-100" name="complete_course_btn" value="complete_course"><?php _e( 'Complete Course', 'drivic' ); ?></button>
        </form>
    </div>
	<?php
}
do_action('tutor_course/single/after/complete_form'); ?>