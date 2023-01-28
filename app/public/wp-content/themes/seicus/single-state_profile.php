<?php
get_header();
$header_title = 'State Profiles';
include('template-parts/single-header-background.php');
?>

<div id="content">
    <div id="inner-content" class="wrap cf">
        <div id="main" role="main" style="margin-top:20px">
            <?php
            if (have_posts()) :
                while (have_posts()) : the_post(); ?>

                    <section class="article-sidebar m-1of3">
						<p class="modified-date">Last updated on: <?php echo get_the_modified_date(); ?></p>
                      <h1 class="post-title"><?php the_title(); ?></h1>
                      <div class="stbundle">
                        <div class="share">
                          <h3>Share</h3>
                    <?php echo do_shortcode('[addtoany buttons="facebook,twitter,linkedin"]');?>
                        </div>
                       <!-- <div class="print">
                          <h3>Print</h3>
                    <?php //echo do_shortcode('[addtoany buttons="print"]');?>
                        </div>-->
                        <?php
                        $pdf_button_link = get_field('pdf_button_link');

                        if(!empty($pdf_button_link)):?>

                        <div class="download">
							<?php if( function_exists( 'pf_current_page_button' ) ) { echo pf_current_page_button(); } ?>
                    
                  </div><?php endif;?>
						  
                        </div>
                    </section>

                    <section class="cf m-2of3 article-body" itemprop="articleBody">
                        <article id="post-<?php the_ID(); ?>" <?php post_class('cf'); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">
                            <section class="cf" itemprop="articleBody">

                                <?php the_content(); ?>
                                <?php

                                global $post;
                                $years = wp_get_post_terms( $post->ID, 'state_year');
                                 ?>
                                 <?php
                                 foreach ($years as $year) { ?>
                                   <a class="back-link" href="/state-profiles-<?php echo $year->slug; ?>">Back to the SIECUS State Profiles</a>
                                   <?php
                                   }
                                             ?>
                            </section>
                        </article>
                    </section>
                <?php
                endwhile;
            else : ?>
                <article id="post-not-found" class="hentry cf">
                    <header class="article-header">
                        <h1><?php _e( 'Oops, Post Not Found!', 'bonestheme' ); ?></h1>
                    </header>
                    <section class="entry-content">
                        <p><?php _e( 'Uh Oh. Something is missing. Try double checking things.', 'bonestheme' ); ?></p>
                    </section>
                    <footer class="article-footer">
                            <p><?php _e( 'This is the error message in the single.php template.', 'bonestheme' ); ?></p>
                    </footer>
                </article>
        <?php endif; ?>
    </div>
</div>
<?php get_footer(); ?>
