<?php
/*
 Template Name: Resources filtered by taxonomy
*/
 ?>


<?php
get_header();
include('template-parts/header-background.php');
?>

<div id="content">
	<div id="inner-content" class="wrap cf">
		<div id="main" class="" role="main">
			<?php
			$term_id = $_GET['filter_type'];
			$terms = get_terms([
				'taxonomy' => 'resource_type',
				'hide_empty' => false,
			]);
			?>

			<div class="float-left w100">
                <div class="filter-wrap">
                    <select name="taxonomy_filter" class="resources_taxonomy_filter select2">
                        <option value="all">ALL</option>
                        <?php
                        foreach ($terms as $term) { ?>
                            <option value="<?php echo $term->term_id; ?>" <?php echo $term->term_id == $term_id ? 'selected="selected"' : ''; ?>><?php echo $term->name; ?></option>
							<?php
						} ?>
                    </select>
                </div>
            </div>

            <div id="resources-wrapper" class="resource-list-box">
            	<div class="resource-body">
	                <?php
	                $args = array(
	                    'post_type'	 =>	array('resources'),
                        'posts_per_page' => -1,
	                    'post_status' => 'publish',
	                    'paged' => $paged,
	                );

	                if (!empty($term_id)) {
	                	$args['tax_query'] = array(
							array(
								'taxonomy' => 'resource_type',
								'field' => 'id',
								'terms' => $term_id,
							)
						);
	                }

	                $query1 = new WP_Query( $args );

	                /*// The Loop
	                while ( $query1->have_posts() ) {
	                    $query1->the_post();
	                    include(locate_template( 'template-parts/individual-resource-box.php'));
	                }
	                wp_reset_postdata();*/
	                ?>
            	</div>
            </div>

            <input type="hidden" class="paged" value="1">

           <div class="float-left w100 loading-container" style="display: none;">
               <div class="loading-wrap">
                   <a href="javascript:void(0);" id="load-more-resources">Load More</a>
                   <?php get_template_part('template-parts/loader'); ?>
               </div>
           </div>

			<?php
			wp_reset_postdata();
			?>

	    </div>
	</div>

	<?php get_footer(); ?>
    <script>
        jQuery(document).ready(function(){
            filter_resources(jQuery('#resources-wrapper .resource-body'),jQuery('.resources_taxonomy_filter').val());
            /*var uri = window.location.toString();
            if (uri.indexOf("?") > 0) {
                var clean_uri = uri.substring(0, uri.indexOf("?"));
                window.history.replaceState({}, document.title, clean_uri);
            }*/
        })
    </script>
