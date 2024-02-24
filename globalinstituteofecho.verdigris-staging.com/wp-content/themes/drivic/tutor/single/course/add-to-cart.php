<?php

/**
 * Display single course add to cart
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
$isLoggedIn = is_user_logged_in();

$monetize_by = tutils()->get_option('monetize_by');
$enable_guest_course_cart = tutor_utils()->get_option('enable_guest_course_cart');

$is_purchasable = tutor_utils()->is_course_purchasable();

$required_loggedin_class = '';
if ( ! $isLoggedIn){
	$required_loggedin_class = apply_filters('tutor_enroll_required_login_class', 'cart-required-login');
}
if ($is_purchasable && $monetize_by === 'wc' && $enable_guest_course_cart){
	$required_loggedin_class = '';
}

$tutor_form_class = apply_filters( 'tutor_enroll_form_classes', array(
	'tutor-enroll-form',
) );

$tutor_course_sell_by = apply_filters('tutor_course_sell_by', null);

do_action('tutor_course/single/add-to-cart/before');

$is_tutor_login_disabled = tutils()->get_option('disable_tutor_native_login');
//$auth_url = $is_tutor_login_disabled ? wp_login_url($_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']) : '';
global $wp;
$auth_url = $is_tutor_login_disabled ? wp_login_url($wp->request) : '';


?>

<div class="tutor-single-add-to-cart-box <?php echo esc_html($required_loggedin_class); ?> " data-login_page_url="<?php echo esc_url($auth_url); ?>">
	<?php
	if ($is_purchasable && $tutor_course_sell_by){
	    tutor_load_template('single.course.add-to-cart-'.$tutor_course_sell_by);
	}else{
		?>
		<form class="<?php echo implode( ' ', $tutor_form_class ); ?>" method="post">
			<?php wp_nonce_field( tutor()->nonce_action, tutor()->nonce ); ?>
			<input type="hidden" name="tutor_course_id" value="<?php echo get_the_ID(); ?>">
			<input type="hidden" name="tutor_course_action" value="_tutor_course_enroll_now">

			<div class=" tutor-course-enroll-wrap">
				<button type="submit" class="btn btn-base mb-3">
					<?php _e('Enroll Now', 'drivic'); ?>
				</button>
			</div>
		</form>

	<?php } ?>
</div>

<?php do_action('tutor_course/single/add-to-cart/after'); ?>
