<div class="resource-box callouts <?php echo !empty($newly_loaded) ? 'newly-loaded' : ''; ?>">
	<div class="post-content">
        <div class="inner">
            <h5>
                <span>
                    <?php the_title()
                      //  $title = get_the_title();
                      //  $max_length = 20;
                      //  echo substr($title, 0, $max_length);
                      //  echo strlen($title) > $max_length ? ' ...' : '';
                    ?>
                </span>
            </h5>
			<p><?php echo wp_trim_words(get_the_excerpt(), 20);// echo get_excerpt(130); ?></p>
            <a href="<?php the_permalink(); ?>" class="lear-more">LEARN MORE</a>
        </div>

    </div>
	<div class="post-thumbnail <?php echo !has_post_thumbnail(get_the_ID()) ? 'no-thumbnail' : ''; ?>" style="background-image: url(<?php echo has_post_thumbnail(get_the_ID()) ? get_the_post_thumbnail_url(get_the_ID(), 'medium-thumbnail') : (get_template_directory_uri().'/library/images/post-placeholder-dark.jpg'); ?>">
	</div>


</div>
