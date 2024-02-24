<?php if(is_single()) : ?>
<div id="<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="single-blog-inner">
        <?php if(has_post_thumbnail()): ?>
            <div class="thumb">
                <?php the_post_thumbnail('full', array('class' => 'img-fluid')); ?>
            </div>
        <?php endif ?>
        <div class="details">
            <ul class="blog-meta">
                <li>
                    <i class="fa fa-user-circle-o"></i>
                    <?php the_author() ?>
                </li>
                <?php if(get_comments_number() > 0) : ?>
                    <li>
                        <i class="fa fa-comments-o"></i>
                        <?php print get_comments_number(); ?>
                        <?php echo esc_html__('Comment', 'drivic'); ?>
                    </li>
                <?php endif; ?>
                <?php if(has_tag()) : ?>
                    <li>
                        <i class="fa fa-tags"></i>
                        <?php the_tags( '', ', ' ); ?>
                    </li>
                <?php endif; ?>
            </ul>
            <p><?php the_content() ?></p>
            <?php 
                wp_link_pages( array(
                    'before'      => '<div class="page-links">' . esc_html__( 'Pages:', 'drivic' ),
                    'after'       => '</div>',
                    'link_before' => '<span class="page-number">',
                    'link_after'  => '</span>',
                ) );
            ?>
            <?php if(!empty(has_tag())) :  ?>
                <div class="tag-and-share">
                    <div class="row">
                        <?php if(has_tag()) : ?>

                        <?php if (function_exists( 'social_icons_hook' ) ) : ?>
                            <div class="col-md-7 align-self-center">
                        <?php else: ?>
                            <div class="col-md-12 align-self-center">
                        <?php endif; ?>
                                <div class="tags d-inline-block">
                                    <strong><?php esc_html_e('Tags: ', 'drivic'); ?> </strong>
                                    <?php the_tags( '', ' ' ); ?>
                                </div>
                            </div>
                        <?php  endif; ?>

                        <?php if ( function_exists( 'social_icons_hook' ) ) : ?>
                            <div class="col-md-5 text-md-right mt-3 mt-md-0">
                                <div class="blog-share">
                                    <?php do_action('social_icons_action'); ?>
                                </div>
                            </div>
                        <?php  endif; ?>
                    </div>
                </div>
            <?php endif;  ?>
        </div>
    </div>
</div>
<?php else: ?>
<div id="<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="thumb">
        <?php if(has_post_thumbnail()) : ?>
            <a href="<?php the_permalink(); ?>">
                <?php the_post_thumbnail('full', array('class' => 'img-fluid')); ?>
            </a>
        <?php endif ?>
    </div>
    <div class="details">
        <ul class="blog-meta">
            <li>
                <i class="fa fa-user-circle-o"></i>
                <?php the_author() ?>
            </li>
            <?php if(get_comments_number() > 0) : ?>
                <li>
                    <i class="fa fa-comments-o"></i>
                    <?php print get_comments_number(); ?>
                    <?php echo esc_html__('Comment', 'drivic'); ?>
                </li>
            <?php endif; ?>
            <?php if(has_tag()) : ?>
                <li>
                    <i class="fa fa-tags"></i>
                    <?php the_tags( '', ', ' ); ?>
                </li>
            <?php endif; ?>
        </ul>
        <h3><a href="<?php the_permalink(); ?>"><?php the_title() ?></a></h3>
        <p><?php print wp_trim_words( get_the_content(), 25, null ); ?></p>
        <a class="read-more-text" href="<?php the_permalink() ?>"><?php esc_html_e( 'Read More', 'drivic' ); ?> <i class="la la-long-arrow-right"></i></a>
    </div>
</div>
<?php endif;  ?>