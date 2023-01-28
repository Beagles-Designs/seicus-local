<?php
/*
 Template Name: Issues
*/
?>


<?php
get_header();
$hide_large_text_header = true;
include('template-parts/header-background.php');
?>

	<div id="content">
		<div id="inner-content" class="cf">
			<div id="main" role="main">
				<div class="main-tagline wrap">
						<?php
							$large_title = get_field('page_description_large_text');
							echo !empty($large_title) ? ('<h4>' . $large_title . '</h4>') : '';
						?>
						<?php if (get_field('page_description_small_text')):?>
						<p><?php the_field('page_description_small_text'); ?></p>
					<?php endif;?>
				</div>


				<div class="issues-container">
					<div class="wrap">
						<?php
						$args = array(
							'post_type'	 =>	'issue',
							'posts_per_page' => -1
						);
						$query_issues = get_posts( $args );

						if (!empty($query_issues)) {
							foreach (array_chunk($query_issues, (ceil(count($query_issues) / 3))) as $chunk ) { ?>
								<div class="d-1of3">
									<?php
									foreach ($chunk as $issue) {
										?>
										<div class="issue-box">
											<div class="issue-title">
												<?php echo $issue->post_title; ?>
											</div>
											<div class="issue-content">
												<?php echo $issue->post_content; ?>

												<?php
												$related_links = get_field('related_links', $issue->ID);
												if (!empty($related_links)) { ?>
													<div class="related-links">
														<?php
															foreach ($related_links as $link) { ?>
																<a href="<?php echo get_permalink( $link['link_url'] ); ?>">
																	<span><?php echo $link['link_label']; ?></span>
																</a>
															<?php
															}
														?>
													</div>
													<?php
												} ?>
											</div>
										</div>
										<?php
									} ?>
								</div><?php
							}
						} ?>
					</div>
				</div>
			</div>
		</div>
	</div>


<?php get_footer(); ?>
