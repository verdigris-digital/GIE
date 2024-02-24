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


// basic option
global $drivic_option;
//main menu field
$page_title_hide  = (isset($drivic_option['page-title-hide']) ? $drivic_option['page-title-hide'] : '');
$page_title_bg  = (isset($drivic_option['page-title-bg']) ? $drivic_option['page-title-bg'] : '');

if (empty($page_title_hide)) {
    if (!empty($page_title_bg['url'])) {
        drivic_page_title();
    }else {
        drivic_page_title_2();
    }
}

?>

<?php do_action('tutor_course/single/before/wrap'); ?>

<div <?php tutor_post_class('tutor-full-width-course-top tutor-course-top-info tutor-page-wrap'); ?>>
    <!-- banner end -->
    <div class="tutor-container">
        <div class="course-single-area pd-top-120">
            <div class="row">
                <?php if(is_active_sidebar( 'course-sidebar' )) : ?> 
                    <div class="col-lg-8">
                <?php else : ?>
                    <div class="col-lg-12">
                <?php endif; ?> 
                    <?php
                        $img_id = get_post_thumbnail_id(get_the_ID()) ? get_post_thumbnail_id(get_the_ID()) : false;
                        $img_url_val = $img_id ? wp_get_attachment_image_src($img_id, 'large-image', false) : '';
                        $img_url = is_array($img_url_val) && !empty($img_url_val) ? $img_url_val[0] : '';
                        $img_alt = $img_id ? get_post_meta($img_id, '_wp_attachment_image_alt', true) : '';
                    ?>

                    <?php if(!empty($img_url)) : ?>
        	            <div class="thumb">
                            <img src="<?php echo esc_url($img_url); ?>" alt="<?php echo esc_attr($img_alt); ?>">
                        </div>
                    <?php endif; ?>
                    <div class="course-course-details-inner">
                        <?php
                            the_content();
                        ?>
                    </div>
                </div>
                
                <?php if(is_active_sidebar( 'course-sidebar' )) : ?>     
                    <div class="col-lg-4">
                        <div class="td-sidebar">
                            <?php dynamic_sidebar('course-sidebar'); ?>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<?php do_action('tutor_course/single/after/wrap'); ?>

<?php
get_footer();
