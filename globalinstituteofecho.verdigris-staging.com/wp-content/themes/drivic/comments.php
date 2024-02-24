<?php
/**
 * The template for displaying comments
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Drivic
 * @since 1.0
 * @version 1.0
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * 
 */
 
	if(post_password_required()){
		return;
	} 
?>
<?php if(number_format_i18n( get_comments_number() ) != 0) : ?>
<div class="comments-area blog-comment">
	<div class="section-title style-small">
    	<h3 class="title"><?php comments_number( esc_html__( 'No Comment', 'drivic' ), esc_html__( 'One Comment', 'drivic' ), esc_html__( '% Comments', 'drivic' ) ); ?></h3>
    </div>

    <ul class="comment-list">
        <?php 
			if( number_format_i18n( get_comments_number() ) > 0 ) {
				wp_list_comments(array(
            		'style'			=> 'ul',
            		'callback'		=> 'drivic_comment_list',
            		'short_ping'	=> true
				));
			}
		?>
    </ul>
	<?php 
	 	the_comments_navigation( array(
	 		'screen_reader_text' => ' '
		) ); 
	?>
</div>
<?php endif; ?>

<!-- Comments Form -->
<?php 
	$commenter = wp_get_current_commenter();
	$req = get_option( 'require_name_email' );
	$aria_req = ($req ? " aria-required='true' " : '');
	$required_text = ' ';
	$args = array(
		'class_form'	=> 'comment-form-wrap',
		'title_reply'	=> esc_html__( 'Leave A Comment', 'drivic' ),
		'submit_button'	=> '<button type="submit" class="btn btn-base">'.esc_html__( 'Post Comment', 'drivic' ).'</button>',
		'fields'		=> apply_filters( 'comment_form_default_fields', array(
			'author'    => '<div class="row">
				<div class="col-md-6">
					<div class="single-input-inner style-bg">
						<input placeholder="'.esc_attr__('Your Name', 'drivic').'" type="text" class="single-input" name="author" value="'.esc_attr( $commenter['comment_author'] ).'" '.$aria_req.'>
					</div>
				</div>',
				'email'	=> '<div class="col-md-6">
					<div class="single-input-inner style-bg">
						<input  placeholder="'.esc_attr__('Your Email', 'drivic').'" type="email" class="single-input" name="email" value="'.esc_attr( $commenter['comment_author_email'] ).'" '.$aria_req.'>
					</div>
				</div>
			</div>'
		)),

		'comment_field'	=> '
		<div class="row">
			<div class="col-12">
				<div class="single-input-inner style-bg">
					<textarea  placeholder="'.esc_attr__('Leave a comment...', 'drivic').'" class="single-input textarea" name="comment" '.$aria_req.' rows="4"></textarea>
				</div>
			</div>
		</div>',
		'label_submit'	=> esc_html__( 'Submit', 'drivic' ),
	);
	comment_form( $args );
?>

