<?php
/*
Plugin Name: Custom Tutor Modifications
Description: Custom modifications for Tutor LMS.
Version: 1.0
Author: Your Name
*/

// Add your customizations here.

add_filter('tutor_dashboard/nav_items', 'add_some_links_dashboard');
function add_some_links_dashboard($links){
    $links['google-meet-link-student'] = [
        'title' => __('Google Meet', 'tutor'),
        'icon' => 'tutor-icon-brand-google-meet',
    ];
    return $links;
}

/*add_filter('template_include', 'load_custom_dashboard_template');

function load_custom_dashboard_template($template) {
    if (is_page('google-meet-link-student')) {
        $custom_template = plugin_dir_path(__FILE__) . 'google-meet-link-student.php';
        if (file_exists($custom_template)) {
            return $custom_template;
        }
    }
    return $template;
}
*/


add_filter('tutor_dashboard/instructor_nav_items', 'add_instructor_links_to_dashboard');

function add_instructor_links_to_dashboard($links){
    $links['students'] = array(
        'title' => __('Students', 'tutor'),
        'url' => 'https://globalinstituteofecho.verdigris-staging.com/dashboard-page/analytics/students/',
        'icon' => 'tutor-icon-mortarboard-o',
		'auth_cap' => tutor()->instructor_role);

    return $links;
}