<div class="individual-news-post <?php echo !empty($newly_loaded) ? 'newly-loaded' : ''; ?>">

     <?php
        if (has_post_thumbnail(get_the_ID())) {
            $thumb_url = get_the_post_thumbnail_url(get_the_ID(), 'home-slide');
        } else {
             $thumb_url = get_template_directory_uri().'/library/images/post-placeholder-dark.jpg';
        }
    ?>
    <div class="thumb-container" style="background: url('<?php echo $thumb_url; ?>') no-repeat center center transparent; background-size: cover;">
        <span class="tag">
            <?php
            $term = null;
            $terms = wp_get_post_terms(get_the_ID(), 'update_type');
            if (!empty($terms)) {
                $term = $terms[0]->name;
            }
            echo $term;
            ?>
        </span>
    </div>
    <div class="post-info">
        <div class="float-left text-left w100">
            <span class="date float-left">
                <?php
                    if(get_post_type() == 'post') :
                        the_time( get_option( 'date_format' ) );
                    else:
                        the_field('event_date');
                    endif;
                ?>
            </span>

            <span class="sharethis float-right">
                	<?php echo do_shortcode('[addtoany buttons="facebook,twitter,linkedin"]');?>
            </span>
        </div>

        <h4>
            <a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>">
                <?php echo max_title_length(get_the_title(), 50); ?>
            </a>
        </h4>
    </div>
</div>
