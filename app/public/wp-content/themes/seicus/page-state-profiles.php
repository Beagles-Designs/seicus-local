<?php
/*
 Template Name: State Profiles 2017
*/
 ?>


<?php
get_header();
include('template-parts/header-background.php');
?>

<div id="content">
	<div id="inner-content" class="cf">
		<div id="main" class="" role="main">
            <div class="state-profile-title">
                <h4><?php the_field('state_profile_title') ?></h4>
			</div>
<div class="sp-mobile-nav">
  <?php dynamic_sidebar('stateprofiles');?>
</div>
			<div class="main-map cf wrap">
				<?php
				$main_map = get_field('image_map_shortcode');
				if (!empty($main_map)) {
					echo do_shortcode( $main_map);
				}
				?>
			</div>

			<div class="boxes-map cf wrap" style="max-width: 970px;">
				<?php
				$main_map = get_field('image_map_boxes_shortcode');
				if (!empty($main_map)) {
					echo do_shortcode( $main_map);
				}
				?>
			</div>

			<div class="main-content cf wrap mt-80" style="max-width: 900px;">
				<div class="page-content">
					<?php
					if( have_posts() ): while( have_posts() ): the_post();
						the_content();
					endwhile; endif;
					?>
				</div>
				<div class="download-sidebar">
					<?php
					$downloads = get_field('right_download_sidebar');
					if (!empty($downloads)) {
						foreach ($downloads as $download) { ?>
							<div class="download-box">
								<a href="<?php echo $download['download_file']; ?>" target="_blank">
									<?php echo $download['download_label']; ?>
								</a>
							</div>
						<?php
						}
					}
					?>
				</div>
			</div>

			<?php
			$related_pages = get_field('related_pages');
			if (!empty($related_pages[0]['page'])) {
				?>
				<div class="related-pages mt-80">
					<div class="state-profile-title">
						<h4>OTHER STATE PROFILE EDITIONS</h4>
					</div>
					<div class="related-pages-wrapper cf wrap">
						<?php
						foreach ($related_pages[0]['page'] as $page) { ?>
							<div class="related-page">
								<a href="<?php echo get_permalink($page->ID); ?>">
									<?php echo $page->post_title; ?>
								</a>
							</div>
						<?php
						} ?>
					</div>
				</div><?php
			} ?>
	    </div>
	</div>
</div>

	<?php get_footer(); ?>
