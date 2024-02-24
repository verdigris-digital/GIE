<?php
/**
 * Template for displaying lead info
 *
 * @since v.1.0.0
 *
 * @author Themeum
 * @url https://themeum.com
 *
 * @package TutorLMS/Templates
 * @version 1.4.3
 */

if ( ! defined( 'ABSPATH' ) )
	exit;

global $post, $authordata;
$profile_url = tutor_utils()->profile_url($authordata->ID);
?>

<div class="banner-area style-two style-five">
    <div class="container">
        <div class="banner-area-inner">
            <div class="row">
                <div class="col-xl-8 col-lg-10">
                    <div class="banner-inner">
                        <h2><?php the_title(); ?></h2>
                        <p><?php echo wp_trim_words( get_the_content(), 38, null ); ?></p>
                        <div class="row mt-5">
                            <?php
                                $disable_course_duration = get_tutor_option('disable_course_duration');
                                $disable_total_enrolled = get_tutor_option('disable_course_total_enrolled');
                                $disable_update_date = get_tutor_option('disable_course_update_date');
                                $course_duration = get_tutor_course_duration_context();
                                $disable_course_author = get_tutor_option('disable_course_author');
                                $disable_course_level = get_tutor_option('disable_course_level');
                                $disable_course_share = get_tutor_option('disable_course_share');
                                $disable = get_tutor_option('disable_course_review');
                            ?>
                            <?php if ( ! $disable){ ?>
                                <div class="col-md-3 col-sm-6 mb-3 mb-md-0">
                                    <span class="tutor-single-course-rating">
                                        <p><?php esc_html_e('Web Development', 'drivic') ?></p>
                                        <span class="rating-inner">
                                            <?php $course_rating = tutor_utils()->get_course_rating();
                                            tutor_utils()->star_rating_generator($course_rating->rating_avg);
                                            echo '<span class="rating-count">('.$course_rating->rating_count.')</span>';
                                            ?>
                                        </span>
                                    </span>
                                </div>
                            <?php } 
                            if ( !$disable_course_level){ ?>
                                <div class="col-lg-2 col-md-3 col-sm-6 mb-3 mb-md-0">
                                    <p><?php _e('Course level', 'drivic'); ?></p>
                                    <p><?php echo get_tutor_course_level(); ?></p>
                                </div>
                            <?php }
                            if( !$disable_total_enrolled){ ?>
                                <div class="col-md-2 col-sm-6 mb-3 mb-md-0">
                                    <p><?php esc_html_e('Enrolled', 'drivic') ?></p>
                                    <p><?php echo (int) tutor_utils()->count_enrolled_users_by_course(); ?></p>
                                </div>
                            <?php } 
                            if( !empty($course_duration) && !$disable_course_duration){ ?>
                                <div class="col-md-2 col-sm-6 mb-3 mb-md-0">
                                    <p><?php esc_html_e('Total Hour', 'drivic') ?></p>
                                    <p><?php echo esc_html($course_duration); ?></p>
                                </div>
                            <?php } 
                            if( !$disable_update_date){ ?>
                                <div class="col-md-3 col-sm-6">
                                    <p><?php esc_html_e('Last Update', 'drivic') ?></p>
                                    <p><?php echo esc_html(get_the_modified_date()); ?></p>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>