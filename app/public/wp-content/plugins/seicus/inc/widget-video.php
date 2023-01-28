<?php
//add function to widget_init to load
add_action( 'widgets_init', 'video_widget' );

//register widget
function video_widget() {
    register_widget( 'video_widget' );
}

class video_widget extends WP_Widget
{
    

    function __construct()
    {
        $widget_ops = array(
                'classname'     => 'video-widget',
                'description'   => __( "Adds a video callout widget")
            );
        parent::__construct( 'video_widget', __('Video Widget'), $widget_ops );
    }

    function form( $instance )
    {
        $title      = esc_attr( isset( $instance['title'] ) ? $instance['title'] : '' );
        $headline   = esc_attr( isset( $instance['headline']) ? $instance['headline'] : '' );
        $blurb      = esc_attr( isset( $instance['blurb'] ) ? $instance['blurb'] : '' );
        $video      = esc_attr( isset( $instance['video'] ) ? $instance['video'] : '' );
        $link       = esc_attr( isset( $instance['link']  ) ? $instance['link'] : '' );
        $layout     = esc_attr( isset( $instance['layout'] ) ? $instance['layout'] : '' );
        ?>

            <p>
                <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Widget Title:' ); ?> 
                    <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
                </label>
            </p>
             <p>
                <label for="<?php echo $this->get_field_id( 'headline' ); ?>"><?php _e( 'Headline:' ); ?> 
                    <input class="widefat" id="<?php echo $this->get_field_id( 'headline' ); ?>" name="<?php echo $this->get_field_name( 'headline' ); ?>" value="<?php echo $instance['headline']; ?>" />
                </label>
            </p>
            <p>
                <label for="<?php echo $this->get_field_id( 'blurb' ); ?>"><?php _e( 'Text Blurb:' ); ?>
                    <input class="widefat" id="<?php echo $this->get_field_id( 'blurb' ); ?>" name="<?php echo $this->get_field_name( 'blurb' ); ?>" type="text" value="<?php echo $blurb; ?>" />
                </label>
            </p>
            <p>
                <label for="<?php echo $this->get_field_id( 'video' ); ?>"><?php _e( 'Video URL:' ); ?>
                    <input class="widefat" id="<?php echo $this->get_field_id( 'video' ); ?>" name="<?php echo $this->get_field_name( 'video' ); ?>" type="text" value="<?php echo $video; ?>" />
                </label>
            </p>
            <p>
                <label for="<?php echo $this->get_field_id( 'link' ); ?>"><?php _e( 'Link' ); ?>
                    <input class="widefat" id="<?php echo $this->get_field_id( 'link' ); ?>" name="<?php echo $this->get_field_name( 'link' ); ?>" type="text" value="<?php echo $link; ?>" />
                </label>
            </p>
           <p>
            <label>Alt Layout?
                <input name="<?php echo $this->get_field_name( 'layout' ); ?>" type="checkbox" value="1" <?php checked( '1', $instance['layout'] ); ?>>
            </label>
        </p>
        <?php
    }

    function widget( $args, $instance )
    {
        extract($args);
        $title      = $instance['title'];
        $headline   = $instance['headline'];
        $blurb      = $instance['blurb'];
        $video      = $instance['video'];
        $video_link = $instance['video'];
        $link       = $instance['link'];
        $layout     = $instance['layout'];
        $video = str_replace('https:', '', $video);
         $video = str_replace('watch?v=', 'embed/', $video);
        echo $before_widget;
        if($layout == 1) :
        ?>
        <h2 class="widget-title"><?php echo $title; ?></h2>
         <div class="video-content-alt">
                <div class="video-embed"><iframe width="285" height="225" src="<?php echo $video; ?>" frameborder="0" allowfullscreen></iframe></div>
                 <?php echo '<h3 class="post-title"><a href="'.$link.'">'. $headline . '</a></h3>'; ?>
                <div class="text"><?php echo $blurb; ?></div>
            </div>
        <?php else : ?>
            <h2 class="widget-title"><?php echo $title; ?></h2>
            <div class="video-content">
                <div class="video-embed"><iframe width="285" height="225" src="<?php echo $video; ?>" frameborder="0" allowfullscreen></iframe></div>
                 <?php echo $before_title . '<a href="'.$link.'">'. $headline . '</a>'. $after_title; ?>
                <div class="text"><?php echo $blurb; ?></div>
            </div>
        <?php
        endif;
        echo $after_widget;
    }

    function update( $new_instance, $old_instance )
    {
        $instance = $old_instance;
        $instance['title']               = strip_tags( $new_instance['title'] );
        $instance['headline']               = strip_tags( $new_instance['headline'] );
        $instance['blurb']               = strip_tags( $new_instance['blurb'] );
        $instance['video']               = strip_tags( $new_instance['video'] );
        $instance['link']               = strip_tags( $new_instance['link'] );
        return $instance;
    }
}
?>