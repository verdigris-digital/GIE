<?php get_header(); ?>
<?php drivic_page_title(); ?>

<div class="single-product-main-content mg-top-120">
    <div class="container">
        <?php if(have_posts()) : 
            while(have_posts()) : the_post();
        ?>
        <div class="team-area-wrap pl-2 ml-1 pr-2 mr-1">
            <div class="row">
				<div class="col-lg-4">
					<div class="img-wrapper">
						<?php
							$img_id = get_post_thumbnail_id(get_the_ID()) ? get_post_thumbnail_id(get_the_ID()) : false;
							$img_url_val = $img_id ? wp_get_attachment_image_src($img_id, 'medium', false) : '';
							$img_url = is_array($img_url_val) && !empty($img_url_val) ? $img_url_val[0] : '';
							$img_alt = $img_id ? get_post_meta($img_id, '_wp_attachment_image_alt', true) : '';

							$designation = get_post_meta( get_the_ID(), '__drivic__designation', true );
							$description = get_post_meta( get_the_ID(), '__drivic__description', true );
							$email = get_post_meta( get_the_ID(), '__drivic__email', true );
							$number = get_post_meta( get_the_ID(), '__drivic__number', true );
							$facebook = get_post_meta( get_the_ID(), '__drivic__facebook', true );
							$twitter = get_post_meta( get_the_ID(), '__drivic__twitter', true );
							$linkedin = get_post_meta( get_the_ID(), '__drivic__linkedin', true );
							$pinterest = get_post_meta( get_the_ID(), '__drivic__pinterest', true );
						?>
						<img class="w-100" src="<?php echo esc_url($img_url); ?>" alt="<?php echo esc_attr($img_alt); ?>">
					</div>
				</div>
				<div class="col-lg-8 pl-lg-5 align-self-center">
					<div class="details-inner">
						<p class="designation"><?php echo esc_html($designation); ?></p>
						<h2 class="title"><?php echo get_the_title(); ?></h2>
						<p class="content"><?php echo esc_html($description); ?></p>
						<div class="contact-info">
							<div class="row">
								<div class="col-lg-7">
									<div class="team-contact-list">
										<h4><?php echo esc_html__('CONTACT', 'drivic') ?></h4>
										<ul>
											<li><i class="fa fa-envelope"></i><?php echo esc_html($email); ?></li>
											<li><i class="fa fa-phone"></i><?php echo esc_html($number); ?></li>
										</ul>
									</div>
									<div class="team-social-list">
										<ul>
											<li><a href="<?php echo esc_html($facebook); ?>"><i class="fa fa-facebook"></i></a></li>
											<li><a href="<?php echo esc_html($twitter); ?>"><i class="fa fa-twitter"></i></a></li>
											<li><a href="<?php echo esc_html($linkedin); ?>"><i class="fa fa-linkedin"></i></a></li>
											<li><a href="<?php echo esc_html($pinterest); ?>"><i class="fa fa-pinterest"></i></a></li>
										</ul>
									</div>
								</div>       
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
        <?php 
            endwhile;
            wp_reset_postdata();
        endif; ?>
        <?php
	        the_content();
        ?>
    </div>
</div>

<?php get_footer() ?>