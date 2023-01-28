<?php
/*
Plugin Name: Recent News
*/

//add function to widget_init to load
add_action( 'widgets_init', 'slider' );

//register widget
function slider() {
	register_widget( 'slider' );
}

//widget class
class slider extends WP_Widget {

	function slider() {

		$widget_ops = array( 'classname' => 'slider', 'description' => 'Slider Widget' );
		$this->WP_Widget( 'slider','Slider', $widget_ops );
	}

	function widget( $args, $instance ) {
		if($instance['category_name'] == 'Any') :
			$cat ='';
		else:
			$cat = $instance['category_name'];
		endif;
		$img_size = $instance['image_size'];
		extract( $args );
		$args = array(
		'posts_per_page'  => $instance['count'],
		'orderby'         => 'post_date',
		'order'           => 'DESC',
		'post_type'       => 'slide',
		'slide_cats'	  => $cat,
		);
		wp_reset_query();
		wp_reset_postdata();
		$slides = get_posts( $args );


		echo $before_widget;

		echo '<ul class="slides cycle-slideshow" data-cycle-fx="fade" data-cycle-timeout="10000" data-cycle-slides="> li" data-cycle-swipe="true" data-cycle-prev=".cycle-prev" data-cycle-next=".cycle-next" >';
		echo '<div class="cycle-prev image-replacement">Prev</div>';
		foreach ($slides as $slide) :
			$id = $slide->ID;
			$headline = $slide->post_title;
			$link = get_field('slide_link',$id);
			$text = get_field('slide_text',$id);

			echo '<li class="slide ' . $img_size . '">';

			echo '<div class="slide-image"><div class="no-rotate"><a href="'.$link.'">'.get_the_post_thumbnail($id, $img_size).'</a></div><div class="rotate grayscale">'.get_the_post_thumbnail($id, $img_size).'</div></div>';
			echo '<div class="slide-overlay">';
			echo '<h3 class="slide-headline"><a href="'.$link.'">'.$headline.'</a></h3>';
			echo '<div class="slide-text"><a href="'.$link.'">'.$text.'</a><span><a href="'.$link.'">We\'ve Rebranded</a></span></div>';
			echo '</div>';

			echo '</li>';
		endforeach;
		echo '<div class="cycle-next image-replacement">Next</div>';
		echo '</ul>';



		echo $after_widget;
		wp_enqueue_script( 'cycle' );
		wp_enqueue_script( 'cycle-swipe' );
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['count'] = $new_instance['count'];
		$instance['image_size'] = $new_instance['image_size'];
		$instance['category_name'] = $new_instance['category_name'];
		return $instance;
	}

	function form( $instance ) {

		$defaults = array(
		'count' => 5,
		);

		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<!-- FORM -->
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>">Title:
				<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
				<span style="font-size:9px;font-style:italic;clear:left;">This is not shown on the front-end, just add something descriptive.</span>
			</label>
		</p>

        <p>
        <label>Max number of slides to show
        	<input name="<?php echo $this->get_field_name( 'count' ); ?>" value="<?php echo $instance['count']; ?>" />
        </label>
        </p>

        <p>
        	<label>Image size
        		<select class="widefat" id="<?php echo $this->get_field_id('image_size'); ?>" name="<?php echo $this->get_field_name('image_size'); ?>">
        			<option class="widefat" value="home-slide" <?php if($instance['image_size'] == "home-slide") { echo "selected='selected'"; }else{ echo " "; } ?>>Home Slide (940x420)</option>
        			<option class="widefat" value="interior-slide" <?php if($instance['image_size'] == "interior-slide") { echo "selected='selected'"; }else{ echo " "; }?>>Interior Slide (940x370)</option>
        		</select>
        	</label>
        </p>

        <p>
	        <label for="<?php echo $this->get_field_id('category_name'); ?>"><?php _e('Select a Slide Category:'); ?></label>
	        <select class="widefat" id="<?php echo $this->get_field_id('category_name'); ?>" name="<?php echo $this->get_field_name('category_name'); ?>">
	        <option class="widefat" value="Any" <?php ($instance['category_name'] == "Any" ? "selected='selected'" : " ") ?>>Any</option>
	        <?php

	        $categories = get_terms('slide_cats');
	        foreach($categories as $category){
	        ?>

	        <option class="widefat" value="<?php echo $category->name; ?>" <?php if( $instance['category_name'] == $category->name ) { echo "selected='selected'
	        "; }else{ echo " "; }?>>
	        <?php echo $category->name; ?>
	        </option>

	        <?php

	        }
	        ?>
	        </select>
    	</p>

	<?php
	}
}

?>
