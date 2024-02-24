<?php
/**
 * Template for displaying student Public Profile
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

$user_name = sanitize_text_field(get_query_var('tutor_student_username'));
$sub_page = sanitize_text_field(get_query_var('profile_sub_page'));
$get_user = tutor_utils()->get_user_by_login($user_name);
$user_id = $get_user->ID;


global $wp_query;

$profile_sub_page = '';
if (isset($wp_query->query_vars['profile_sub_page']) && $wp_query->query_vars['profile_sub_page']) {
    $profile_sub_page = $wp_query->query_vars['profile_sub_page'];
}


?>

<div class="instructor-area pd-top-195">
    <div class="container">

        <?php $main_avt_alt = get_avatar_url(); ?>

        <div class="rows">
            <div class="col-lg-4-4 instructor-single-left">
                <div class="instructor-single-thumb text-center">
                    
                    <img src="<?php echo get_avatar_url($user_id, array('size' => 330)); ?>" alt="<?php echo esc_attr($main_avt_alt); ?>" />

                    <div class="tutor-dashboard-header-info text-left">
                        <div class="tutor-dashboard-header-display-name">
                            <h4><?php echo esc_html($get_user->display_name); ?></h4>
                        </div>
                        <?php
                        if (user_can($user_id, tutor()->instructor_role)){
                            $instructor_rating = tutor_utils()->get_instructor_ratings($get_user->ID);
                            ?>
                            <div class="tutor-dashboard-header-stats">
                                <div class="tutor-dashboard-header-ratings">
                                    <?php tutor_utils()->star_rating_generator($instructor_rating->rating_avg); ?>
                                    <span><?php echo esc_html($instructor_rating->rating_avg);  ?></span>
                                    <span> (<?php echo sprintf(__('%d Ratings', 'drivic'), $instructor_rating->rating_count); ?>) </span>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                    <?php
                        $tutor_user_social_icons = tutor_utils()->tutor_user_social_icons();
                        if(count($tutor_user_social_icons)){
                            ?>
                                <div class="tutor-dashboard-social-icons">
                                    <?php
                                        $i=0;
                                        foreach ($tutor_user_social_icons as $key => $social_icon){
                                            $icon_url = get_user_meta($user_id,$key,true);
                                            if($icon_url){
                                                if($i==0){
                                                    ?>
                                                        <h4><?php esc_html_e("Follow me", "drivic"); ?></h4>
                                                    <?php
                                                }
                                                echo "<a href='".esc_url($icon_url)."' target='_blank' class='".$social_icon['icon_classes']."'></a>";
                                            }
                                            $i++;
                                        }
                                    ?>
                                </div>
                            <?php
                        }
                    ?>
                </div>
                <div class="tutor-instractor-tab">
                    <?php
                    $permalinks = tutor_utils()->user_profile_permalinks();
                    $student_profile_url = tutor_utils()->profile_url($user_id);
                    ?>
                    <ul class="tutor-dashboard-permalinks mb-0 pb-0">
                        <li class="tutor-dashboard-menu-bio <?php echo esc_html($profile_sub_page) == '' ? 'active' : ''; ?>"><a href="<?php echo tutor_utils()->profile_url($user_id); ?>"><?php echo esc_html('Bio', 'drivic'); ?></a></li>
                        <?php
                        if (is_array($permalinks) && count($permalinks)){
                            foreach ($permalinks as $permalink_key => $permalink){
                                $li_class = "tutor-dashboard-menu-{$permalink_key}";
                                $active_class = $profile_sub_page == $permalink_key ? "active" : "";
                                echo '<li class="'. $active_class . ' ' . $li_class .'"><a href="'.trailingslashit($student_profile_url).$permalink_key.'"> '.$permalink.' </a> </li>';
                            }
                        }
                        ?>
                    </ul>
                </div>
            </div>
            <div class="col-lg-8-8 instructor-single-right">
                <div class="tutor-dashboard-content tutor-dashboard-content-inner">
                    <?php
                        if ($sub_page){
                            tutor_load_template('profile.'.$sub_page);
                        }else{
                            tutor_load_template('profile.bio');
                        }
                    ?>
                </div>
            </div>
        </div>

    </div>
</div>

<?php
get_footer();
