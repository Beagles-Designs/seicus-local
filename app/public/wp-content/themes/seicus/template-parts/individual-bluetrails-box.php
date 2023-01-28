
<li class="post newly-loaded" id="post-<?php the_ID(); ?>">
    <?php if ( empty($hide_date) ) : ?>
        <div class="post-date"><?php the_date('F Y'); ?></div>
    <?php endif; ?>

    <?php if ( !empty($social_share) ) : ?>
        <h5>SHARE</h5>
	<?php echo do_shortcode('[addtoany buttons="facebook,twitter,linkedin"]');?>
    <?php endif ?>

    <h3 class="post-title"><a href="<?php the_permalink();?>"><?php the_title();?></a></h3>
    <div class="post-excerpt"><?php the_excerpt();?></div>
</li>
