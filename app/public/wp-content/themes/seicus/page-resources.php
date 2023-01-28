<?php
/*
 Template Name: Resources By Taxonomy
*/
 ?>


<?php
get_header();
include('template-parts/header-background.php');
?>

<div id="content">
	<div id="inner-content" class="cf">
		<div id="main" class="" role="main">
			<?php
			$terms = get_field('resources_taxonomy');
			if (!empty($terms)) {
			    foreach ($terms as $term) {
					include(locate_template('template-parts/resources-list-box.php'));
                }
			} ?>

	    </div>
	</div>

	<?php get_footer(); ?>
