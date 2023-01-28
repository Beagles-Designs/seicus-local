<?php
// Our include
define('WP_USE_THEMES', false);
require_once('../../../wp-load.php');

// Our variables
$offset = (isset($_GET['offset'])) ? $_GET['offset'] : 0;
$type =  (isset($_GET['posttype'])) ? $_GET['posttype'] : 0;
$resourcetype =	(isset($_GET['resourcetype'])) ? $_GET['resourcetype'] : 0;
$args = array(
		'post_type'	 =>	$type,
		'posts_per_page' => 5,
		'offset' =>$offset,
		'resource_type'	=> $resourcetype,
	);
$query1 = new WP_Query( $args );


	// The Loop
	while ( $query1->have_posts() ) {
	$query1->the_post(); ?>

	<div class="individual">
	<p><?php if(get_post_type() == 'post') : ?>News - <?php the_time( get_option( 'date_format' ) ); ?><?php else: ?>Events - <?php the_field('event_date'); ?><?php endif; ?></p>
	<h3><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>
	<p><?php the_excerpt(); ?></p>

	<?php

		$files = get_field('files');

		if( !empty($files) ): ?>


	<a href="<?php the_field('files'); ?>" class="download">Download the PDF</a>
	<?php endif; ?>
	  <div class="sharethis">
	  	<span class='st_facebook_large' displayText='Facebook' st_title='<?php the_title(); ?>' st_url='<?php the_permalink(); ?>'></span>
		<span class='st_twitter_large' displayText='Tweet' st_title='<?php the_title(); ?>' st_url='<?php the_permalink(); ?>'  st_via='SIECUS'>													<span class='st_email_large' displayText='Email' st_title='<?php the_title(); ?>' st_url='<?php the_permalink(); ?>'></span>
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
	?>

	<?php wp_reset_postdata();?>

<div></div>
