<?php
$args = array(
    'post_type' => 'resources',
    'post_status' => 'publish',
    'posts_per_page' => 3,
	'tax_query' => array(
		array(
			'taxonomy' => 'resource_type',
			'field' => 'id',
			'terms' => $term->term_id,
		),
	),
    'paged'=> !empty($_REQUEST['paged']) ? $_REQUEST['paged'] : 1
);
$resources_query = new WP_Query($args);

if ($resources_query->have_posts()) {
    ?>
    <div class="resource-list-box" id="resource-<?php echo $term->term_id; ?>">
        <div class="inner">
            <div class="resource-title">
                <h4><?php echo $term->name; ?></h4>
            </div>
            <div class="resource-body">
                <?php
                while ( $resources_query->have_posts() ) {
                    $resources_query->the_post();
                    include(locate_template( 'template-parts/individual-resource-box.php'));
                }
                wp_reset_postdata();
                ?>

            </div>
            <input type="hidden" class="paged" value="2">
            <div class="float-left w100 loading-container" <?php echo $resources_query->max_num_pages > 1 ? '' : 'style="display: none;"'; ?>>
                <div class="loading-wrap">
                    <a href="<?php echo site_url('filtered-resources') . '?filter_type=' . $term->term_id; ?>" class="" >View More</a>
                </div>
            </div>
        </div>
    </div>
    <?php
}
?>
