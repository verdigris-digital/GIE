<?php
/**
 * Template for displaying single course
 *
 * @since v.1.0.0
 *
 * @author Themeum
 * @url https://themeum.com
 *
 * @package TutorLMS/Templates
 * @version 1.4.3
 */

get_header();

do_action('tutor_course/single/enrolled/before/wrap');
?>

<div <?php tutor_post_class('tutor-full-width-course-top tutor-course-top-info tutor-page-wrap'); ?>>
    <?php tutor_course_enrolled_lead_info(); ?>
    <div class="tutor-container">
        <div class="tutor-row">
            <div class="tutor-col-8 tutor-col-md-100 mt-5">
                <?php do_action('tutor_course/single/enrolled/before/inner-wrap'); ?>
                
                <?php tutor_course_content(); ?>
                <?php tutor_course_benefits_html(); ?>
                <?php tutor_course_enrolled_nav(); ?>
                <?php tutor_course_target_reviews_html(); ?>
                <?php tutor_course_target_review_form_html(); ?>
		        <?php do_action('tutor_course/single/enrolled/after/inner-wrap'); ?>
            </div>
            <div class="tutor-col-4">
                <div class="tutor-single-course-sidebar course-view-sitebar">
                    <?php do_action('tutor_course/single/enrolled/before/sidebar'); ?>
                    <div class="widget widget-video-inner">
                        <?php tutor_course_enroll_box(); ?>
                    </div>
                    <div class="widget widget-accordion-inner">
                        <?php tutor_course_topics(); ?>
                    </div>
                    <?php tutor_course_instructors_html(); ?>
                    <?php do_action('tutor_course/single/enrolled/after/sidebar'); ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php do_action('tutor_course/single/enrolled/after/wrap'); ?>

<?php
get_footer();
