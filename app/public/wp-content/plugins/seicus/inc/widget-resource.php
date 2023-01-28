<?php
//add function to widget_init to load
add_action( 'widgets_init', 'resource_widget' );

//register widget
function resource_widget() {
    register_widget( 'resource_widget' );
}

class resource_widget extends WP_Widget
{
    

    function __construct()
    {
        $widget_ops = array(
                'classname'     => 'resource-widget',
                'description'   => __( "Adds a resource callout widget")
            );
        parent::__construct( 'resource_widget', __('Resource Callout Widget'), $widget_ops );
    }

    function form( $instance )
    {
        
        $wtitle      = esc_attr( isset( $instance['wtitle'] ) ? $instance['wtitle'] : '' );
        $second_line      = esc_attr( isset( $instance['second_line'] ) ? $instance['second_line'] : '' );
        $link = esc_attr( isset( $instance['link'] ) ? $instance['link'] : '' );
        $imglink = esc_attr( isset( $instance['imglink'] ) ? $instance['imglink'] : '' );
        $buttontext = esc_attr( isset( $instance['buttontext'] ) ? $instance['buttontext'] : '' );      
        
        ?>

            <p>
                <label for="<?php echo $this->get_field_id( 'wtitle' ); ?>"><?php _e( 'Title:' ); ?> 
                    <input class="widefat" id="<?php echo $this->get_field_id( 'wtitle' ); ?>" name="<?php echo $this->get_field_name( 'wtitle' ); ?>" value="<?php echo $instance['wtitle']; ?>" />
                </label>
            </p>
            <p>
                <label for="<?php echo $this->get_field_id( 'imglink' ); ?>"><?php _e( 'Link to Background Image:' ); ?>
                    <input class="widefat" id="<?php echo $this->get_field_id( 'imglink' ); ?>" name="<?php echo $this->get_field_name( 'imglink' ); ?>" type="text" value="<?php echo $imglink; ?>" />
                </label>
            </p>            
            <p>
                <label for="<?php echo $this->get_field_id( 'second_line' ); ?>"><?php _e( 'Second Line:' ); ?>
                    <input class="widefat" id="<?php echo $this->get_field_id( 'second_line' ); ?>" name="<?php echo $this->get_field_name( 'second_line' ); ?>" type="text" value="<?php echo $second_line; ?>" />
                </label>
            </p>
            <p>
                <label for="<?php echo $this->get_field_id( 'buttontext' ); ?>"><?php _e( 'Button Text:' ); ?>
                    <input class="widefat" id="<?php echo $this->get_field_id( 'buttontext' ); ?>" name="<?php echo $this->get_field_name( 'buttontext' ); ?>" type="text" value="<?php echo $buttontext; ?>" />
                </label>
            </p>
            <p>
                <label for="<?php echo $this->get_field_id( 'link' ); ?>"><?php _e( 'Link:' ); ?>
                    <input class="widefat" id="<?php echo $this->get_field_id( 'link' ); ?>" name="<?php echo $this->get_field_name( 'link' ); ?>" type="text" value="<?php echo $link; ?>" />
                </label>
            </p>
            
           
        <?php
    }

    function widget( $args, $instance )
    {
        extract($args);
        $wtitle      = $instance['wtitle'];
        $second_line      = $instance['second_line'];
        $link      = $instance['link'];
        $imglink      = $instance['imglink'];
        $buttontext      = $instance['buttontext'];
        echo $before_widget;
       

        ?>
            <div class="resource-callout">
                
                <div class="text">
                	<h3><?php echo $wtitle; ?></h3>
	                <div class="second-line"><?php echo $second_line; ?></div>
                </div>
				<div class="button"><a href="<?php echo $link; ?>"><?php echo $buttontext; ?></a></div>
                <div class="image"><img src="<?php echo $imglink; ?>" /></div>
            </div>
        <?php

        echo $after_widget;
    }

    function update( $new_instance, $old_instance )
    {
        $instance = $old_instance;
        $instance['wtitle']               = strip_tags( $new_instance['wtitle'] );
        $instance['second_line']               = strip_tags( $new_instance['second_line'] );
        $instance['link']                 = strip_tags( $new_instance['link'] );
        $instance['buttontext']                 = strip_tags( $new_instance['buttontext'] );
        $instance['imglink']                 = strip_tags( $new_instance['imglink'] );

        return $instance;
    }
}
?>