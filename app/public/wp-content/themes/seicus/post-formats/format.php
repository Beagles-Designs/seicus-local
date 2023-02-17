
<article id="post-<?php the_ID(); ?>" <?php post_class('cf'); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">
	<section class="article-sidebar m-1of3">
		<div class="stbundle">
			<div class="share">
				<h3>Share</h3>
	<?php echo do_shortcode('[addtoany buttons="facebook,twitter,linkedin"]');?>
			</div>
			<div class="print">
				<h3>Print</h3>
	<?php echo do_shortcode('[addtoany buttons="print"]');?>
			</div>
	  	</div>
	  	<!-- <div class="divider">
	  				<h3>Type</h3>
	  				<div class="">
	  					<a href="<?php echo site_url() . '/news-and-updates' ?>" >Press Release</a>
	  				</div>
	  			</div>
	  	<div class="divider">
	  				<h3>Date</h3>
	  				<div class="">
	  					<span><?php the_date('F d, Y'); ?></span>
	  				</div>
	  			</div> -->
	  	<?php
	  	if ( get_field( "files" ) ): ?>
			<div class="divider <?php if (get_field("enable_read_more") ): ?>hidden<?php endif; ?>">
				<h3>Additional Resources</h3>
				<a id="link-field" href="<?php the_field('files'); ?>">Download files</a>
				<!-- <div class="pdf-icon">
					<a href="<?php the_field('files'); ?>" ><?php the_field('file_title'); ?></a>
				</div> -->
			</div>
		<?php endif; ?>
		<?php
		if( has_category() ): ?>
		<div class="divider">
			<h3>Issues</h3>
			<?php
				$categories = get_the_category();
				$separator = ' ';
				$output = '';
				if ($categories) {
					foreach($categories as $category) {
						echo get_category_parents( $category, true, ' <br/>' );
					}
					echo trim($output, $separator);
				} ?>
		</div>
		<?php endif; ?>
		<?php
		if( has_tag() ): ?>
			<div class="divider">
				<?php the_tags( '<h3>' . __( 'Tags', 'bonestheme' ) . '</h3> ', ', ', '' ); ?>
			</div>
		<?php endif; ?>
	</section>

	<section class="cf m-2of3 article-body" itemprop="articleBody">
		<h1><?php the_title(); ?></h2>
		<?php
		// the content (pretty self explanatory huh)


		the_content();
		wp_link_pages( array(
		  'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'bonestheme' ) . '</span>',
		  'after'       => '</div>',
		  'link_before' => '<span>',
		  'link_after'  => '</span>',
		) );
		?>
		<?php if (get_field("enable_read_more") ): ?>
			<div class="resource-rm-container">
				<p>Want to read the full report?<p>
				<button class="rm-btn">Sign up to read more!</button>
				<button id="clear-storage">Clear Local Storage</button>
			</div>
		<?php endif; ?>
	</section> <?php // end article section ?>


</article> <?php // end article ?>
