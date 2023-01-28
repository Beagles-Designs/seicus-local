<?php

// we can only use this Widget if the plugin is active
if( class_exists( 'WidgetImageField' ) )
    add_action( 'widgets_init', create_function( '', "register_widget( 'callout_widget' );" ) );


class callout_widget extends WP_Widget
{
    var $image_field = 'image';  // the image field ID

    function __construct()
    {
        $widget_ops = array(
                'classname'     => 'callout-widget',
                'description'   => __( "Add image callouts")
            );
        parent::__construct( 'callout_widget', __('Image Callout Widget'), $widget_ops );
    }

    function form( $instance )
    {
        $title      = esc_attr( isset( $instance['title'] ) ? $instance['title'] : '' );
        $headline   = esc_attr( isset( $instance['headline'] ) ? $instance['headline'] : '' );
        $image_id   = esc_attr( isset( $instance[$this->image_field] ) ? $instance[$this->image_field] : 0 );
        $blurb      = esc_attr( isset( $instance['blurb'] ) ? $instance['blurb'] : '' );
        $link       = esc_attr( isset( $instance['url'] ) ? $instance['url'] : '' );

        $image      = new WidgetImageField( $this, $image_id );
        ?>

            <p>
                <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?> 
                    <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
                </label>
            </p>
            <p>
                <label for="<?php echo $this->get_field_id( 'headline' ); ?>"><?php _e( 'Sub-headline:' ); ?>
                    <input class="widefat" id="<?php echo $this->get_field_id( 'headline' ); ?>" name="<?php echo $this->get_field_name( 'headline' ); ?>" type="text" value="<?php echo $headline; ?>" />
                </label>
            </p>
            <div>
                <label><?php _e( 'Image:' ); ?></label>
                <?php echo $image->get_widget_field(); ?>
            </div>
            <p>
                <label for="<?php echo $this->get_field_id( 'blurb' ); ?>"><?php _e( 'Caption:' ); ?>
                    <input class="widefat" id="<?php echo $this->get_field_id( 'blurb' ); ?>" name="<?php echo $this->get_field_name( 'blurb' ); ?>" type="text" value="<?php echo $blurb; ?>" />
                </label>
            </p>
            <p>
                <label for="<?php echo $this->get_field_id( 'url' ); ?>"><?php _e( 'Link:' ); ?>
                    <input class="widefat" id="<?php echo $this->get_field_id( 'url' ); ?>" name="<?php echo $this->get_field_name( 'url' ); ?>" type="text" value="<?php echo $link; ?>" />
                </label>
            </p>
        <?php
    }

    function widget( $args, $instance )
    {
        extract($args);
        $title      = $instance['title'];
        $headline   = $instance['headline'];
        $image_id   = $instance[$this->image_field];
        $blurb      = $instance['blurb'];
        $link       = $instance['url'];
        $image      = new WidgetImageField( $this, $image_id );

        echo $before_widget;
        echo $before_title . $title . $after_title;

        ?>
            <div class="callout-content">
                <?php if( !empty( $headline ) ) : ?>
                    <h4 class="sub-headline"><?php if(!empty($link)) : ?><a href="<?php echo $link;?>"><?php endif; ?><?php echo $headline; ?><?php if(!empty($link)) : ?></a><?php endif; ?></h4>
                <?php endif; ?>
                <?php if( !empty( $image_id ) ) : ?>
                    <?php if(!empty($link)) : ?><a href="<?php echo $link;?>"><?php endif; ?><img src="<?php echo $image->get_image_src( 'sidebar' ); ?>" width="<?php echo $image->get_image_width( 'sidebar' ); ?>" height="<?php echo $image->get_image_height( 'sidebar' ); ?>" /><?php if(!empty($link)) : ?></a><?php endif; ?>
                <?php endif; ?>
                <?php if( !empty( $blurb ) ) : ?>
                    <div class="caption"><?php if(!empty($link)) : ?><a href="<?php echo $link;?>"><?php endif; ?><?php echo $blurb; ?><?php if(!empty($link)) : ?></a><?php endif; ?></div>
                <?php endif; ?>
            </div>
        <?php

        echo $after_widget;
    }

    function update( $new_instance, $old_instance )
    {
        $instance = $old_instance;
        $instance['title']               = strip_tags( $new_instance['title'] );
        $instance['headline']            = strip_tags( $new_instance['headline'] );
        $instance[$this->image_field]    = intval( strip_tags( $new_instance[$this->image_field] ) );
        $instance['blurb']               = strip_tags( $new_instance['blurb'] );
        $instance['url']                 = strip_tags( $new_instance['url'] );

        return $instance;
    }
}
?>