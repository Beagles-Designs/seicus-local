<?php
/*
 Template Name: Resources
 *
 * This is your custom page template. You can create as many of these as you need.
 * Simply name is "page-whatever.php" and in add the "Template Name" title at the
 * top, the same way it is here.
 *
 * When you create your page, you can just select the template and viola, you have
 * a custom page template to call your very own. Your mother would be so proud.
 *
 * For more info: http://codex.wordpress.org/Page_Templates
*/
?>



<?php get_header(); ?>
<div class="header-background">
		<div class="wrap">
			<h1 itemprop="headline"><?php the_title(); ?></h1>
			<div class="cycle-slideshow" data-cycle-fx="fade" data-cycle-timeout="10000" data-cycle-slides="> div" >

			
			<?php
								
								// The Query
								
								
								
								
								$args = array(
										'post_type'	 =>	'resources',
										'category_name' => 'Featured Resource',
										'posts_per_page' => 5
									);
								$queryfeatured = new WP_Query( $args );
								
								
								// The Loop
								while ( $queryfeatured->have_posts() ) {
									$queryfeatured->the_post(); ?>
									
									<div>
									<p class="featured-meta"><span class="featured-category"><?php $terms_as_text = get_the_term_list( $post->ID, 'resource_type', '', ', ', '' ) ; echo strip_tags($terms_as_text); ?></span> &#8211 <span class="featured-posted"><?php the_time('F j, Y') ?></span></p>
									<h3 style="margin-top:0px"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>

									<p><?php the_excerpt(); ?></p>
									
									<?php 

										$files = get_field('files');
										
										if( !empty($files) ): ?>
									
									
									<p><a href="<?php the_field('files'); ?>">Download the PDF</a></p>
									<?php endif; ?>
									    <span class='st_facebook_large' displayText='Facebook' st_url='<?php the_permalink(); ?>'></span>
										<span class='st_twitter_large' displayText='Tweet' st_title='<?php the_title(); ?>' st_url='<?php the_permalink(); ?>'  st_via='SIECUS'></span>
										<span class='st_email_large' displayText='Email' st_url='<?php the_permalink(); ?>'></span> 
									</div>
									
								<?php
								}
								
								/* Restore original Post Data 
								 * NB: Because we are using new WP_Query we aren't stomping on the 
								 * original $wp_query and it does not need to be reset with 
								 * wp_reset_query(). We just need to set the post data back up with
								 * wp_reset_postdata().
								 */
								wp_reset_postdata();
								
								?>

			 

		</div>
		</div>
			
	</div> <?php // end article header ?>
								

 
			<div id="content">

				<div id="inner-content" class="wrap cf">

						<div id="main" role="main">
							
							<div class="cycle-slideshow" data-cycle-fx="scrollHorz"  data-cycle-timeout="0"   data-cycle-prev="#prev"  data-cycle-next="#next"   data-cycle-speed="200" data-cycle-slides="> div">
							    
							</div>							
							<div id="tabs">
								<ul>
								    <li><a href="#tabs-1">Guidelines & Standards</a></li>
								    <li><a href="#tabs-2">State Profiles</a></li>
								    <li><a href="#tabs-3">Controversy Reports</a></li>
								    <li><a href="#tabs-4">Fact Sheets</a></li>
								    <li><a href="#tabs-5">Publications</a></li>							    
								</ul>
							
							<div id="tabs-1">
							<?php
								
								// The Query
								
								
								
								
								$args1 = array(
										'post_type'	 =>	'resources',
										'resource_type'	=> 'guidelines-standards',
									);
								$query1 = new WP_Query( $args1 );
								
								
								// The Loop
								while ( $query1->have_posts() ) {
									$query1->the_post(); ?>
									
									<div class="individual">
									<h3><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>
									<p><?php the_excerpt(); ?></p>
									
									<?php 

										$files = get_field('files');
										
										if( !empty($files) ): ?>
									
									
									<a href="<?php the_field('files'); ?>" class="download">Download the PDF</a>
									<?php endif; ?>
									  <div class="sharethis">
									  	<span class='st_facebook_large' displayText='Facebook' st_url='<?php the_permalink(); ?>'></span>
										<span class='st_twitter_large' displayText='Tweet' st_title='<?php the_title(); ?>' st_url='<?php the_permalink(); ?>'  st_via='SIECUS'>
										<span class='st_email_large' displayText='Email' st_url='<?php the_permalink(); ?>'></span> 
									  </div>
									</div>
								<?php
								}
								
								/* Restore original Post Data 
								 * NB: Because we are using new WP_Query we aren't stomping on the 
								 * original $wp_query and it does not need to be reset with 
								 * wp_reset_query(). We just need to set the post data back up with
								 * wp_reset_postdata().
								 */
								wp_reset_postdata();
								
								?>
							</div>
							<div id="tabs-2">
								<div class="individual">
								<?php echo do_shortcode('[imagemap id="365"]') ?>
								<?php
								/* The 2nd Query (without global var) */
								
								$args2 = array(
										'post_type'	 =>	'resources',
										'resource_type'	=> 'state-profiles',
										'orderby' => 'title',
										'order'   => 'ASC',
									);
								$query2 = new WP_Query( $args2 );
								
								// The 2nd Loop
								while ( $query2->have_posts() ) {
									$query2->next_post();?>
									
									<h3><a href="<?php echo get_permalink($query2->post->ID); ?>"><?php echo get_the_title( $query2->post->ID ); ?></a></h3>
									
									
								<?php
								}
								

								// Restore original Post Data
								wp_reset_postdata();
								
								?>
									</div>
								</div>
							<div id="tabs-3">
								<?php
								
								$args3 = array(
										'post_type'	 =>	'resources',
										'resource_type'	=> 'controversy-reports',
									);
								$query3 = new WP_Query( $args3 );
								
								// The 3rdLoop
								while ( $query3->have_posts() ) {
									$query3->next_post(); ?>
									
									<div class="individual">
									<h3><a href="<?php echo get_permalink($query3->post->ID); ?>"><?php echo get_the_title( $query3->post->ID ); ?></a></h3>
									<p><?php echo get_the_excerpt( $query3->post->ID); ?></p>
									
									<?php 

										$files = get_field('files');
										
										if( !empty($files) ): ?>
									
									
									<a href="<?php the_field('files'); ?>" class="download">Download the PDF</a>
									<?php endif; ?>
									  <div class="sharethis">
									  	<span class='st_facebook_large' displayText='Facebook' st_url='<?php the_permalink(); ?>'></span>
										<span class='st_twitter_large' displayText='Tweet' st_url='<?php the_permalink(); ?>'></span>
										<span class='st_email_large' displayText='Email' st_url='<?php the_permalink(); ?>'></span> 
									  </div>
									</div>

									
									
								<?php
								}
								
								// Restore original Post Data
								wp_reset_postdata();
								
								?>
							</div>
							<div id="tabs-4">
								<?php
								
								$args4 = array(
										'post_type'	 =>	'resources',
										'resource_type'	=> 'fact-sheets',
									);
								$query4 = new WP_Query( $args4 );
								
								// The 2nd Loop
								while ( $query4->have_posts() ) {
									$query4->next_post(); ?>
									
									<div class="individual">
									<h3><a href="<?php echo get_permalink($query4->post->ID); ?>"><?php echo get_the_title( $query4->post->ID ); ?></a></h3>
									<p><?php echo get_the_excerpt( $query4->post->ID); ?></p>
									
									<?php 

										$files = get_field('files');
										
										if( !empty($files) ): ?>
									
									
									<a href="<?php the_field('files'); ?>" class="download">Download the PDF</a>
									<?php endif; ?>
									  <div class="sharethis">
									  	<span class='st_facebook_large' displayText='Facebook' st_url='<?php the_permalink(); ?>'></span>
										<span class='st_twitter_large' displayText='Tweet' st_url='<?php the_permalink(); ?>'></span>
										<span class='st_email_large' displayText='Email' st_url='<?php the_permalink(); ?>'></span> 
									  </div>
									</div>

									
									
								<?php
								}
								
								// Restore original Post Data
								wp_reset_postdata();
								
								?>
							</div>
							
							
						</div>


				</div>

			</div>


<?php get_footer(); ?>
