<?php get_header(); ?>

	<div class="header-background" style="background-image: url('/wp-content/uploads/2018/05/siecus-home-1200px-rd3-v1-1_01.jpg');">
	<div class="header-wp">
	<div class="wrap">

		<?php if (is_category()) { ?>
	<?php
	$category = get_the_category();
	$parent = get_cat_name($category[0]->category_parent);
	if (!empty($parent)) {
	echo $parent;
	} else {
	}
	?>

<h1 itemprop="headline">
		<span><?php _e( '', 'bonestheme' ); ?></span> <?php single_cat_title(); ?>
	</h1>
<?php } elseif (is_tag()) { ?>


	<h1 itemprop="headline">
		<span><?php _e( 'Posts Tagged:', 'bonestheme' ); ?></span> <?php single_tag_title(); ?>
	</h1>

<?php } elseif (is_author()) {
	global $post;
	$author_id = $post->post_author;
?>
	<h1 itemprop="headline">

		<span><?php _e( 'Posts By:', 'bonestheme' ); ?></span> <?php the_author_meta('display_name', $author_id); ?>

	</h1>
<?php } elseif (is_day()) { ?>
	<h1 itemprop="headline">
		<span><?php _e( 'Daily Archives:', 'bonestheme' ); ?></span> <?php the_time('l, F j, Y'); ?>
	</h1>

<?php } elseif (is_month()) { ?>
		<h1 itemprop="headline">
			<span><?php _e( 'Monthly Archives:', 'bonestheme' ); ?></span> <?php the_time('F Y'); ?>
		</h1>

<?php } elseif (is_year()) { ?>
		<h1 itemprop="headline">
		<span><?php _e( 'Yearly Archives:', 'bonestheme' ); ?></span> <?php the_time('Y'); ?>
	</h1>
<?php } ?>
</div>
	</div>

</div> <?php // end article header ?>



<div id="content">

	<div id="inner-content" class="wrap clearfix">

		<div id="main" class="twelvecol first clearfix" role="main">

			<div id="news-wrapper">

			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

		<?php include( "template-parts/individual-post.php" );?>

				<?php endwhile; ?>

						<?php if (function_exists('bones_page_navi')) { ?>
								<?php bones_page_navi(); ?>
						<?php } else { ?>
								<nav class="wp-prev-next">
										<ul class="clearfix">
											<li class="prev-link"><?php next_posts_link(__('&laquo; Older Entries', "bonestheme")) ?></li>
											<li class="next-link"><?php previous_posts_link(__('Newer Entries &raquo;', "bonestheme")) ?></li>
										</ul>
								</nav>
						<?php } ?>

				<?php else : ?>

						<article id="post-not-found" class="hentry clearfix">
							<header class="article-header">
								<h1><?php _e("Oops, Post Not Found!", "bonestheme"); ?></h1>
							</header>
							<section class="entry-content">
								<p><?php _e("Uh Oh. Something is missing. Try double checking things.", "bonestheme"); ?></p>
							</section>
							<footer class="article-footer">
									<p><?php _e("This is the error message in the custom posty type archive template.", "bonestheme"); ?></p>
							</footer>
						</article>

				<?php endif; ?>
			</div>

			</div> <!-- end #main -->


		</div> <!-- end #inner-content -->

</div> <!-- end #content -->

<?php get_footer(); ?>
