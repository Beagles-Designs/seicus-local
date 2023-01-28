<?php
/*
 Template Name: News & Updates
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
include('template-parts/header-background.php');
?>

<div id="content">
    <div id="inner-content" class="wrap cf">
        <div id="main" class="" role="main">
            <?php
      $term_id = $_GET['filter_type'];
			$terms = get_terms([
				'taxonomy' => 'update_type',
				'hide_empty' => false,
			]); ?>
            <div class="float-left w100">
                <div class="filter-wrap">
                    <select name="taxonomy_filter" class="taxonomy_filter news_taxonomy_filter select2">
                        <option value="all">ALL</option>
                        <?php
                        foreach ($terms as $term) { ?>
                            <option value="<?php echo $term->term_id; ?>" <?php echo $term->term_id == $term_id ? 'selected="selected"' : ''; ?>><?php echo $term->name; ?></option>
							<?php
						}
                        ?>
                    </select>
                </div>
            </div>

            <div id="news-wrapper">
              <div class="news-body">
                <?php
                $paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
              //  $term_id = ( get_query_var('term_id') ) ? get_query_var('term_id') : null;
                $args = array(
                    'post_type'	 =>	array('post'),
                    'posts_per_page' => -1,
                    'post_status' => 'publish',
                    'paged' => $paged,
                    'orderby' => 'date',
            'order'   => 'DESC',
                );
                if (!empty($term_id)) {
                  $args['tax_query'] = array(
                array(
                'taxonomy' => 'update_type',
                'field' => 'id',
                'terms' => $term_id,
                )
                );
                }

                $query1 = new WP_Query( $args );

                // The Loop
                while ( $query1->have_posts() ) {
                    $query1->the_post();
                    include( "template-parts/individual-post.php" );
                }

                ?>
              </div>
            </div>

            <input type="hidden" class="paged" value="2">

            <div class="float-left w100 loading-container" <?php echo $query1->max_num_pages > 1 ? '' : 'style="display: none;"'; ?>>
                <div class="loading-wrap">
                    <a href="javascript:void(0);" id="load-more-news">Load More</a>
                    <?php get_template_part('template-parts/loader'); ?>
                </div>
            </div>
			<?php
			wp_reset_postdata();
			?>
        </div>
    </div>

    <?php include('template-parts/custom-follow-us.php'); ?>

	<?php get_footer(); ?>
  <script>
      jQuery(document).ready(function(){
          load_more_posts(jQuery('#news-wrapper .news-body'),jQuery('.news_taxonomy_filter').val());
          /*var uri = window.location.toString();
          if (uri.indexOf("?") > 0) {
              var clean_uri = uri.substring(0, uri.indexOf("?"));
              window.history.replaceState({}, document.title, clean_uri);
          }*/
      })
  </script>
