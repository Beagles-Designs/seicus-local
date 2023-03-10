<?php
/*
 Template Name: No Sidebar
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




<?php
get_header();
$hide_large_text_header = true;
include('template-parts/header-background.php');
?>

<div id="content">
	<div id="inner-content" class="wrapx cf">
		<div id="main" role="main">
			<?php 
			if (have_posts()) : 
				while (have_posts()) : the_post(); ?>
					<article id="post-<?php the_ID(); ?>" <?php post_class( 'cf' ); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">
						<section class="entry-content cf" itemprop="articleBody">
							<?php
							// the content (pretty self explanatory huh)
							the_content();
							
							wp_link_pages( array(
								'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'bonestheme' ) . '</span>',
								'after'       => '</div>',
								'link_before' => '<span>',
								'link_after'  => '</span>',
							));
							?>
						</section> <?php // end article section ?>
						<footer class="article-footer cf"></footer>
					</article><?php 
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
							<p><?php _e( 'This is the error message in the page.php template.', 'bonestheme' ); ?></p>
					</footer>
				</article><?php 
			endif; ?>
		</div>
		<?php include('template-parts/custom-follow-us.php'); ?>
	</div>
</div>

<?php get_footer(); ?>
