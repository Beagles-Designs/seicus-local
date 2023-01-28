<?php

	add_theme_support( 'post-thumbnails' );

	// default thumb size
	set_post_thumbnail_size(125, 125, true);


	/************* THUMBNAIL SIZE OPTIONS *************/

// Thumbnail sizes
add_image_size( 'home-slide', 436, 311, true );
add_image_size( 'landing-thumb', 285, 135, true );
add_image_size( 'search-result-thumb', 180, 115, true );

//add sizes to media library

add_filter('image_size_names_choose', 'blue_trails_sizes');
function blue_trails_sizes($sizes) {
$addsizes = array(
'build-single' => __( 'Single Page Size'),
'blog-feature' => __( 'Blog Feature Size'),
'page-highlight' => __('Page Hero Image'),
);
$newsizes = array_merge($sizes, $addsizes);
return $newsizes;
}

?>