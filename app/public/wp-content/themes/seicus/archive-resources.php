<?php get_header(); ?>

	<div class="header-background">
	
		<div class="wrap">
	
			<h1><?php post_type_archive_title(); ?></h1>
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
									    <span class='st_facebook_large' displayText='Facebook' st_title='<?php the_title(); ?>' st_url='<?php the_permalink(); ?>'></span>
										<span class='st_twitter_large' displayText='Tweet' st_title='<?php the_title(); ?>' st_url='<?php the_permalink(); ?>'  st_via='SIECUS'></span>
										<span class='st_email_large' displayText='Email' st_title='<?php the_title(); ?>' st_url='<?php the_permalink(); ?>'></span> 
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
								<nav>
									<ul>
									    
									    <li><a href="#guidelines-standards">Guidelines &<br>Standards</a></li>
									    <li><a href="#state-profiles">State Profiles</a></li>
									    <li><a href="#controversy-reports">Controversy<br> Reports</a></li>
									    <li><a href="#fact-sheets">Fact Sheets</a></li>
									    <li><a href="#publications">Publications<br>A - Z</a></li>							    
									</ul>
								</nav>
							<div id="guidelines-standards">
								<div id="guidelines-standards-content">
									<?php
										// The Query
										$args1 = array(
												'post_type'	 =>	'resources',
												'posts_per_page' => 5,
												'resource_type'	=> 'childhood-sexuality-guidelines-standards',
											);
										$query1 = new WP_Query( $args1 );
										$found = $query1->found_posts;
																				
										// The Loop
										while ( $query1->have_posts() ) {
											$query1->the_post(); 
											?>
											<div class="individual">
											<h3><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>
											<p><?php the_excerpt(); ?></p>
											
											<?php 		
												$files = get_field('files');
												
												if( !empty($files) ): ?>
											
											
											<a href="<?php the_field('files'); ?>" class="download">Download the PDF</a>
											<?php endif; ?>
											  <div class="sharethis">
											  	<span class='st_facebook_large' displayText='Facebook' st_title='<?php the_title(); ?>' st_url='<?php the_permalink(); ?>'></span>
												<span class='st_twitter_large' displayText='Tweet' st_title='<?php the_title(); ?>' st_url='<?php the_permalink(); ?>' st_via='SIECUS'></span>
												<span class='st_email_large' displayText='Email' st_title='<?php the_title(); ?>' st_url='<?php the_permalink(); ?>'></span> 
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
								<?php if ($found > 5): ?> 
									<nav class="prev-next-posts">
										<div class="prev-posts-link">
											<a href="" id="load-guidelines">Load More</a>    
										</div>
									</nav>								
								<?php endif; ?>
							</div>
							<div id="state-profiles">
								<div class="individual" style="padding:10px 0px">
								<div style="float:left;width:204px;"><?php echo do_shortcode('[imagemap id="5486"]') ?></div>
								 <div style="float:left;width:706px"><?php echo do_shortcode('[imagemap id="5423"]') ?></div>
								<div class="state-names">
								
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
								
								?></div>
									</div>
								</div>
							<div id="controversy-reports">
								<div id="controversy-reports-content">
								<?php
								
								$args3 = array(
										'post_type'	 =>	'resources',
										'posts_per_page' => 5,
										'resource_type'	=> 'controversy-reports',
									);
								$query3 = new WP_Query( $args3 );
								$found = $query3->found_posts;
								
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
									  	<span class='st_facebook_large' displayText='Facebook' st_title='<?php the_title(); ?>' st_url='<?php the_permalink(); ?>'></span>
										<span class='st_twitter_large' displayText='Tweet' st_title='<?php the_title(); ?>' st_url='<?php the_permalink(); ?>'  st_via='SIECUS'></span>
										<span class='st_email_large' displayText='Email' st_title='<?php the_title(); ?>' st_url='<?php the_permalink(); ?>'></span> 
									  </div>
									</div>

									
									
								<?php
								}
								
								// Restore original Post Data
								wp_reset_postdata();
								
								?>
								</div>
								<?php if ($found > 5): ?> 
									<nav class="prev-next-posts">
										<div class="prev-posts-link">
											<a href="" id="load-controversy">Load More</a>    
										</div>
									</nav>
								<?php endif; ?>
							</div>
							<div id="fact-sheets">
								<div id="fact-sheets-content">
								<?php
								
								$args4 = array(
										'post_type'	 =>	'resources',
										'posts_per_page' => 5,
										'resource_type'	=> 'fact-sheets',
									);
								$query4 = new WP_Query( $args4 );
								$found = $query4->found_posts;
								
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
									  	<span class='st_facebook_large' displayText='Facebook' st_title='<?php the_title(); ?>' st_url='<?php the_permalink(); ?>'></span>
										<span class='st_twitter_large' displayText='Tweet' st_title='<?php the_title(); ?>' st_url='<?php the_permalink(); ?>'  st_via='SIECUS'></span>
										<span class='st_email_large' displayText='Email' st_title='<?php the_title(); ?>' st_url='<?php the_permalink(); ?>'></span> 
									  </div>
									</div>

									
									
								<?php
								}
								
								// Restore original Post Data
								wp_reset_postdata();
								
								?>
								</div>
								<?php if ($found > 5): ?> 
									<nav class="prev-next-posts">
										<div class="prev-posts-link">
											<a href="" id="load-facts">Load More</a>    
										</div>
									</nav>
								<?php endif; ?>
							</div>
							<div id="publications">
								<div id="publications-content">
								<?php
								
								$args5 = array(
										'post_type'	 =>	'resources',
										'posts_per_page' => 5,
										'resource_type'	=> 'fact-sheets,controversy-reports,childhood-sexuality-guidelines-standards',
									);
								$query5 = new WP_Query( $args5 );
								$found = $query5->found_posts;
								
								if ( $query5->have_posts() ) :
								while ( $query5->have_posts() ) {
									$query5->next_post(); ?>
									
									<div class="individual">
									<h3><a href="<?php echo get_permalink($query5->post->ID); ?>"><?php echo get_the_title( $query5->post->ID ); ?></a></h3>
									<p><?php echo get_the_excerpt( $query5->post->ID); ?></p>
									
									<?php 

										$files = get_field('files');
										
										if( !empty($files) ): ?>
									
									
									<a href="<?php the_field('files'); ?>" class="download">Download the PDF</a>
									<?php endif; ?>
									  <div class="sharethis">
									  	<span class='st_facebook_large' displayText='Facebook' st_title='<?php the_title(); ?>' st_url='<?php the_permalink(); ?>'></span>
										<span class='st_twitter_large' displayText='Tweet' st_title='<?php the_title(); ?>' st_url='<?php the_permalink(); ?>'  st_via='SIECUS'></span>
										<span class='st_email_large' displayText='Email' st_title='<?php the_title(); ?>' st_url='<?php the_permalink(); ?>'></span> 
									  </div>
									</div>

									
									
								<?php
								}
								else: ?> 
								
								<p>No resources currently featured</p>
								<?php endif;
								// Restore original Post Data
								wp_reset_postdata();
								
								?>
								</div>
								<?php if ($found > 5): ?> 
									<nav class="prev-next-posts">
										<div class="prev-posts-link">
											<a href="" id="load-publications">Load More</a>    
										</div>
									</nav>
								<?php endif; ?>
							</div>

							
						</div>


				</div>

			</div>


<?php get_footer(); ?>