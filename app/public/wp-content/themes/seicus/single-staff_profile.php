<?php
get_header();
$header_title = 'Staff & Board';
include('template-parts/single-header-background.php');
?>
	<div id="content">
		<div id="inner-content" class="wrap cf">
			<div class="go-back">
				<a href="<?php echo site_url( $path = '/about-siecus/staff-and-board/'); ?>">
					<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 444.097 444.097" width="512" height="512"><path fill="#1f3557" d="M444.097 201.833H77.425L181.706 97.551l-28.604-28.604L0 222.048 153.094 375.15l28.62-28.564L77.417 242.264h366.68z"/></svg>
				 Back to List</a>
			</div>
			<div id="main" role="main">
					<?php
					if (have_posts()) :
						while (have_posts()) : the_post(); ?>
							<section class="article-sidebar m-1of3">
								<div class="profile-image">
									<?php the_post_thumbnail('medium-thumbnail'); ?>
								</div>
							</section>

							<section class="cf m-2of3 article-body" itemprop="articleBody">
								<h3><?php the_title(); ?></h3>
								<p style="margin: 0;"><em><?php the_field('job_title'); ?></em></p>
								<?php if (get_field('organization')):?><span><?php the_field('organization'); ?></span><?php endif;?>
								<?php if (get_field('location')):?><span><?php the_field('location'); ?></span><?php endif;?>
								<p><?php the_content(); ?></p>
							</section>
				<?php endwhile; ?>

				<?php else : ?>

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
	</div>
<?php get_footer(); ?>
