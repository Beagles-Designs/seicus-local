<?php
/*
Plugin Name: Blue Trails Content
*/

//add function to widget_init to load
add_action( 'widgets_init', 'bt_content' );

//register widget
function bt_content() {
	register_widget( 'bt_content' );
}

//widget class
class bt_content extends WP_Widget {

	function bt_content() {
		$widget_ops = array(
			'classname' => 'bt_content',
			'description' => 'Blue Trails Content Widget. Add different types of content in different configs.'
		);
		$this->WP_Widget( 'bt_content','Blue Trails Content', $widget_ops );
	}

	function widget( $args, $instance ) {
		//grab post type
		$ptype = $instance['post_type'];
		//grab layout setting
		$layout = $instance['layout'];
		//set the query count
		$count = '';
		switch ($layout) {
			case 'sidebar-list':
				$count = '3';
				break;
			case 'single-2':
				$count = '1';
				break;
			case 'single-full':
				$count = '1';
				break;
			case 'two-column':
				$count = '2';
				break;
			case 'three-column':
				$count = '3';
				break;
			case 'full-loop':
				$count = '30';
				break;
			default:
				$count = '3';
				break;
		}
		//set up an array from the taxonomy selections
		$tax_args = array();
		foreach ($instance as $key => $value){
			if(strpos($key, 'tax-') !== false){
  				$tax_args[str_replace('tax-', '', $key)] = $value;
  			}
		}

		//change post tags array key to just tags
		$tax_args['tag'] = $tax_args['post_tag'];

		unset($tax_args['post_tag']);

		$tax_query = array();

		if (!empty($tax_args)) {
			$tax_query = array(
				'tax_query' => array (
        			'relation' => 'OR',
        		)
			);
			foreach (array_filter($tax_args) as $k => $tax) {
				array_push($tax_query['tax_query'], array(
					'taxonomy' => $k,
	                'field'    => 'name',
	                'terms'    => $tax,
				));
			}
		}

		extract( $args );

		$default_args = array(
			'posts_per_page'  => $count,
            'orderby'         => 'post_date',
			'post_status'         => 'publish',
			'order'           => 'DESC',
			'post_type'       => $ptype,
		);

		global $post;
		//merge arrays into one set of query arguments
		$args = array_merge($default_args,$tax_args, $tax_query);

		//run query
		$bt_posts = get_posts( $args );

		echo $before_widget;

		$widget_title = apply_filters('widget_title', $instance['title'] );
		if ($instance['hide_title'] != 1) :
			echo '<h2 class="widget-title">' . $widget_title . '</h2>';
		endif;

		switch ($layout) {
			case 'sidebar-list':
				echo '<ul class="content-widget sidebar-list">';
						foreach ($bt_posts as $post) :
							setup_postdata( $post );	?>
							<li class="post">
								<?php if ($instance['hide_date']!=1) : ?>
									<div class="post-date"><?php the_date('F Y'); ?></div>
								<?php endif; ?>
								<h3 class="post-title"><a href="<?php the_permalink();?>"><?php the_title();?></a></h3>
								<div class="post-excerpt"><?php the_excerpt();?></div>
							</li>
				  <?php endforeach;
						echo '</ul>';
				break;
			case 'single-2':
				echo '<ul class="content-widget single-2">';
						foreach ($bt_posts as $post) :
							setup_postdata( $post );	?>
							<li class="post">
								<?php if ($instance['hide_date']!=1) : ?>
									<div class="post-date"><?php the_date('F Y'); ?></div>
								<?php endif; ?>
								<h3 class="post-title"><a href="<?php the_permalink();?>"><?php the_title();?></a></h3>
								<div class="post-excerpt"><?php the_excerpt();?></div>
							</li>
				  <?php endforeach;
						echo '</ul>';
				break;
			case 'single-full':
			case 'full-loop':
				echo '<ul class="content-widget single-full">';
						foreach ($bt_posts as $post) :
							setup_postdata( $post );	?>
							<li class="post">

								<?php if ($instance['hide_date'] != 1) : ?>
									<div class="post-date"><?php the_date('F Y'); ?></div>
								<?php endif; ?>

								<?php if ( !empty($instance['enable_social_share']) ) : ?>
							        <h5>SHARE</h5>
							        <span class="sharethis">
							            <span class='st_facebook_large' displayText='Facebook' st_title='<?php the_title(); ?>' st_url='<?php the_permalink(); ?>'></span>
							            <span class='st_twitter_large' displayText='Tweet' st_title='<?php the_title(); ?>' st_url='<?php the_permalink(); ?>'  st_via='SIECUS'></span>
							            <span class='st_email_large' displayText='Email' st_title='<?php the_title(); ?>' st_url='<?php the_permalink(); ?>'></span>
							        </span>
							    <?php endif ?>
								<h3 class="post-title"><a href="<?php the_permalink();?>"><?php the_title();?></a></h3>
								<div class="post-excerpt"><?php the_excerpt();?></div>
							</li>
				  <?php endforeach;
						echo '</ul>';
				break;
			case 'two-column':
				echo '<ul class="content-widget two-column">';
						foreach ($bt_posts as $post) :
							setup_postdata( $post );	?>
							<li class="post">
								<div class="post-image"><a href="<?php the_permalink();?>"><?php the_post_thumbnail('build-single'); ?></a></div>
								<h3 class="post-title"><a href="<?php the_permalink();?>"><?php the_title();?></a></h3>
								<div class="post-excerpt"><?php the_excerpt();?></div>
							</li>
				  <?php endforeach;
						echo '</ul>';
				break;
			case 'three-column':
				echo '<ul class="content-widget three-column">';
						foreach ($bt_posts as $post) :
							setup_postdata( $post );	?>
							<li class="post d-1of3 m-all">
								<div class="post-content">
									<div class="post-image"><a href="<?php the_permalink();?>"><?php the_post_thumbnail('build-single'); ?></a></div>
									<div class="post-date"><?php the_date('F Y'); ?></div>
									<h3 class="post-title"><a href="<?php the_permalink();?>"><?php the_title();?></a></h3>
								</div>
							</li>
				  <?php endforeach;
						echo '</ul>';
				break;
			default:
				echo '<ul class="content-widget sidebar-list">';
						foreach ($bt_posts as $post) :
							setup_postdata( $post );	?>
							<li class="post">
								<?php if ($instance['hide_date']!=1) : ?>
									<div class="post-date"><?php the_date('F Y'); ?></div>
								<?php endif; ?>
								<h3 class="post-title"><a href="<?php the_permalink();?>"><?php the_title();?></a></h3>
								<div class="post-excerpt"><?php the_excerpt();?></div>
							</li>
				  <?php endforeach;
						echo '</ul>';
				break;
		}

		if ($layout == 'single-full' && $instance['enable_view_more'] == 1) {
			echo '
            <div class="float-left w100 loading-container">
				<input type="hidden" class="paged" value="2">
                <div class="loading-wrap">
                    <a href="javascript:void(0);" class="load-more-ptype" ' . ($instance['enable_social_share'] == 1 ? 'data-social-share="true"' : '') . ' ' . ($instance['hide_date'] == 1 ? 'data-hide-date="true"' : '') . ' data-ptype="' . $ptype . '" data-args="' . htmlspecialchars(json_encode($args), ENT_QUOTES, 'UTF-8') . '">View More</a>
                    <div class="loader"><div class="dot dot1"></div><div class="dot dot2"></div><div class="dot dot3"></div><div class="dot dot4"></div>
					</div>
                </div>
            </div>';
		}

		echo $after_widget;

		wp_reset_query();
		wp_reset_postdata();
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		//set up args for get_taxonomies
		$args =  array(
  					'public'   => true,
				);
       	$output = 'objects';
       	$taxonomies=get_taxonomies($args,$output);
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['count'] = $new_instance['count'];
		$instance['layout'] = $new_instance['layout'];
		$instance['hide_date'] = $new_instance['hide_date'];
		$instance['hide_title'] = $new_instance['hide_title'];
		$instance['enable_view_more'] = $new_instance['enable_view_more'];
		$instance['enable_social_share'] = $new_instance['enable_social_share'];
		//add taxonomy items to instance array
		foreach ($taxonomies as $taxonomy) {
			if($taxonomy->name != 'post_format') :
				$instance['tax-'.$taxonomy->name] = $new_instance['tax-'.$taxonomy->name];
			endif;
		}
		return $instance;
	}

	function form( $instance ) {

		$defaults = array(
		);

		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<!-- FORM -->
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>">Title:
				<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
				<span style="font-size:9px;font-style:italic;clear:left;">This can be hidden as needed.</span>
			</label>
		</p>
		 <p>
        	<label>Hide Title?
        		<input name="<?php echo $this->get_field_name( 'hide_title' ); ?>" type="checkbox" value="1" <?php checked( '1', $instance['hide_title'] ); ?>>
        	</label>
        </p>
        <p>
        	<label>Enble "View more" ?
        		<input name="<?php echo $this->get_field_name( 'enable_view_more' ); ?>" type="checkbox" value="1" <?php checked( '1', $instance['enable_view_more'] ); ?>>
        	</label>
        </p>
        <p>
        	<label>Enble "Social share" ?
        		<input name="<?php echo $this->get_field_name( 'enable_social_share' ); ?>" type="checkbox" value="1" <?php checked( '1', $instance['enable_social_share'] ); ?>>
        	</label>
        </p>
		<p>
			<label>Post Type
				<select class="widefat" id="<?php echo $this->get_field_id('post_type'); ?>" name="<?php echo $this->get_field_name('post_type'); ?>">
					<option class="widefat" value="post" <?php if($instance['post_type'] == "post") { echo "selected='selected'"; }else{ echo " "; } ?>>Blog Posts</option>
        			<option class="widefat" value="case_study" <?php if($instance['post_type'] == "staff_profile") { echo "selected='selected'"; }else{ echo " "; }?>>Staff Profile</option>
        			<option class="widefat" value="resources" <?php if($instance['post_type'] == "resources") { echo "selected='selected'"; }else{ echo " "; }?>>Resources</option>
        			<option class="widefat" value="funding_resource" <?php if($instance['post_type'] == "funding_resource"){ echo "selected='selected'"; }else{ echo " "; } ?>>Funding Resources</option>
        			<option class="widefat" value="page" <?php if($instance['post_type'] == "page"){ echo "selected='selected'"; }else{ echo " "; } ?>>Pages</option>
        			<option class="widefat" value="user_story" <?php if($instance['post_type'] == "user_story"){ echo "selected='selected'"; }else{ echo " "; } ?>>User Stories</option>
    			</select>
    		</label>
    	</p>
        <p>
        	<label>Layout
        		<select class="widefat" id="<?php echo $this->get_field_id('layout'); ?>" name="<?php echo $this->get_field_name('layout'); ?>">
        			<option class="widefat" value="sidebar-list" <?php if($instance['layout'] == "sidebar-list") { echo "selected='selected'"; }else{ echo " "; } ?>>Sidebar List (no image)</option>
        			<option class="widefat" value="single-2" <?php if($instance['layout'] == "single-2") { echo "selected='selected'"; }else{ echo " "; }?>>Single Post 2/3 Width (no image)</option>
        			<option class="widefat" value="single-full" <?php if($instance['layout'] == "single-full") { echo "selected='selected'"; }else{ echo " "; }?>>Single Post Full Width</option>
        			<option class="widefat" value="two-column" <?php if($instance['layout'] == "two-column"){ echo "selected='selected'"; }else{ echo " "; } ?>>Two Column (2 posts)</option>
        			<option class="widefat" value="three-column" <?php if($instance['layout'] == "three-column"){ echo "selected='selected'"; }else{ echo " "; } ?>>Three Column (3 posts)</option>
        			<option class="widefat" value="full-loop" <?php if($instance['layout'] == "full-loop"){ echo "selected='selected'"; }else{ echo " "; } ?>>Full width loop (all posts)</option>
        		</select>
        	</label>
        </p>
        <p>
        	<label>Hide Date?
        		<input name="<?php echo $this->get_field_name( 'hide_date' ); ?>" type="checkbox" value="1" <?php checked( '1', $instance['hide_date'] ); ?>>
        	</label>
        </p>
        <?php $args =  array(
  					'public'   => true,
				);
        	  $output = 'objects';
        ?>
        <?php $taxonomies=get_taxonomies($args,$output); ?>
        <?php foreach ($taxonomies as $taxonomy) { ?>
        		<?php if($taxonomy->name != 'post_format') : ?>
	        		<p>
	        			<label><?php echo $taxonomy->label;?>
	        				<select class="widefat" id="<?php echo $this->get_field_id('tax-'.$taxonomy->name);?>" name="<?php echo $this->get_field_name('tax-'.$taxonomy->name);?>">
	        					<option class="widefat" value="" <?php ($instance[$taxonomy->name] == "Any" ? "selected='selected'" : " ") ?>>Any</option>
	        					<?php $terms = get_terms($taxonomy->name);
	        						 foreach($terms as $term){
	        					?>
	        						<option value="<?php echo $term->name; ?>" <?php if($instance['tax-'.$taxonomy->name] == $term->name) { echo 'selected="selected"'; }else{ echo " "; }?>>
	        							<?php echo $term->name; ?>
	        						</option>
	        					<?php } ?>
	        				</select>
	        			</label>
	        		</p>
	        	<?php endif; ?>
        <?php  } ?>


	<?php
	}
}

?>
