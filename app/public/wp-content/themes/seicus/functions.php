<?php
/*
Author: Eddie Machado
URL: htp://themble.com/bones/

This is where you can drop your custom functions or
just edit things like thumbnail sizes, header images,
sidebars, comments, ect.
*/

// LOAD BONES CORE (if you remove this, the theme will break)
require_once( 'library/bones.php' );

require_once( 'includes/body-class.php' );


// CUSTOMIZE THE WORDPRESS ADMIN (off by default)
// require_once( 'library/admin.php' );

/*********************
LAUNCH BONES
Let's get everything up and running.
*********************/

function bones_ahoy() {

	add_filter('show_admin_bar', '__return_false');

	//Allow editor style.
  add_editor_style();

  // let's get language support going, if you need it
  load_theme_textdomain( 'bonestheme', get_template_directory() . '/library/translation' );

  // launching operation cleanup
  add_action( 'init', 'bones_head_cleanup' );
  // A better title
  add_filter( 'wp_title', 'rw_title', 10, 3 );
  // remove WP version from RSS
  add_filter( 'the_generator', 'bones_rss_version' );
  // remove pesky injected css for recent comments widget
  add_filter( 'wp_head', 'bones_remove_wp_widget_recent_comments_style', 1 );
  // clean up comment styles in the head
  add_action( 'wp_head', 'bones_remove_recent_comments_style', 1 );
  // clean up gallery output in wp
  add_filter( 'gallery_style', 'bones_gallery_style' );

  // enqueue base scripts and styles
  add_action( 'wp_enqueue_scripts', 'bones_scripts_and_styles', 999 );
  // ie conditional wrapper

  // launching this stuff after theme setup
  bones_theme_support();

  // adding sidebars to Wordpress (these are created in functions.php)
  add_action( 'widgets_init', 'bones_register_sidebars' );

  // cleaning up random code around images
  add_filter( 'the_content', 'bones_filter_ptags_on_images' );
  // cleaning up excerpt
  add_filter( 'excerpt_more', 'bones_excerpt_more' );

} /* end bones ahoy */

// let's get this party started
add_action( 'after_setup_theme', 'bones_ahoy' );


/************* OEMBED SIZE OPTIONS *************/

if ( ! isset( $content_width ) ) {
	$content_width = 640;
}

/************* THUMBNAIL SIZE OPTIONS *************/

// Thumbnail sizes
add_image_size( 'bones-thumb-600', 600, 150, true );
add_image_size( 'profile-image', 270, 200, true );
add_image_size( 'medium-thumbnail', 400, 400, true );

/*
to add more sizes, simply copy a line from above
and change the dimensions & name. As long as you
upload a "featured image" as large as the biggest
set width or height, all the other sizes will be
auto-cropped.

To call a different size, simply change the text
inside the thumbnail function.

For example, to call the 300 x 100 sized image,
we would use the function:
<?php the_post_thumbnail( 'bones-thumb-300' ); ?>
for the 600 x 150 image:
<?php the_post_thumbnail( 'bones-thumb-600' ); ?>

You can change the names and dimensions to whatever
you like. Enjoy!
*/

add_filter( 'image_size_names_choose', 'bones_custom_image_sizes' );

function bones_custom_image_sizes( $sizes ) {
    return array_merge( $sizes, array(
        'bones-thumb-600' => __('600px by 150px'),
        'bones-thumb-300' => __('300px by 100px'),
    ) );
}

/*
The function above adds the ability to use the dropdown menu to select
the new images sizes you have just created from within the media manager
when you add media to your content blocks. If you add more image sizes,
duplicate one of the lines in the array and name it according to your
new image size.
*/

function siecus_row_styles($styles) {
	$styles['homeslider'] = __('Home Slider', 'siecus');
	$styles['center'] = __('Centered', 'siecus');
	$styles['colors'] = __('Colors', 'siecus');
	return $styles;
}
add_filter('siteorigin_panels_row_styles', 'siecus_row_styles');


/************* ACTIVE SIDEBARS ********************/

// Sidebars & Widgetizes Areas


function bones_register_sidebars() {
	register_sidebar(array(
		'id' => 'topsidebar',
		'name' => __( 'Top Sidebar', 'bonestheme' ),
		'description' => __( '', 'bonestheme' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="widgettitle">',
		'after_title' => '</h4>',
	));
		register_sidebar(array(
		'id' => 'rightsidebar',
		'name' => __( 'Right Sidebar', 'bonestheme' ),
		'description' => __( '', 'bonestheme' ),
		'before_widget' => '<div id="%1$s" class="widget panel %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="widgettitle">',
		'after_title' => '</h4>',
	));
	register_sidebar(array(
		'id' => 'footer',
		'name' => __( 'Footer', 'bonestheme' ),
		'description' => __( '', 'bonestheme' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="widgettitle">',
		'after_title' => '</h4>',
	));
  register_sidebar(array(
		'id' => 'beforefooter',
		'name' => __( 'Before Footer', 'bonestheme' ),
		'description' => __( '', 'bonestheme' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="widgettitle">',
		'after_title' => '</h4>',
	));

	register_sidebar(array(
		'id' => 'stateprofiles_2016',
		'name' => __( 'State Profile 2016 Nav', 'bonestheme' ),
		'description' => __( '', 'bonestheme' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="widgettitle">',
		'after_title' => '</h4>',
	));
	register_sidebar(array(
		'id' => 'stateprofiles',
		'name' => __( 'State Profile 2017 Nav', 'bonestheme' ),
		'description' => __( '', 'bonestheme' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="widgettitle">',
		'after_title' => '</h4>',
	));
	register_sidebar(array(
		'id' => 'stateprofiles_2018',
		'name' => __( 'State Profile 2018 Nav', 'bonestheme' ),
		'description' => __( '', 'bonestheme' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="widgettitle">',
		'after_title' => '</h4>',
	));
	register_sidebar(array(
		'id' => 'stateprofiles_2019',
		'name' => __( 'State Profile 2019 Nav', 'bonestheme' ),
		'description' => __( '', 'bonestheme' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="widgettitle">',
		'after_title' => '</h4>',
	));
	/*
	to add more sidebars or widgetized areas, just copy
	and edit the above sidebar code. In order to call
	your new sidebar just use the following code:

	Just change the name to whatever your new
	sidebar's id is, for example:

	register_sidebar(array(
		'id' => 'sidebar2',
		'name' => __( 'Sidebar 2', 'bonestheme' ),
		'description' => __( 'The second (secondary) sidebar.', 'bonestheme' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="widgettitle">',
		'after_title' => '</h4>',
	));

	To call the sidebar in your template, you can just copy
	the sidebar.php file and rename it to your sidebar's name.
	So using the above example, it would be:
	sidebar-sidebar2.php

	*/
} // don't remove this bracket!


/************* COMMENT LAYOUT *********************/

// Comment Layout
function bones_comments( $comment, $args, $depth ) {
   $GLOBALS['comment'] = $comment; ?>
  <div id="comment-<?php comment_ID(); ?>" <?php comment_class('cf'); ?>>
    <article  class="cf">
      <header class="comment-author vcard">
        <?php
        /*
          this is the new responsive optimized comment image. It used the new HTML5 data-attribute to display comment gravatars on larger screens only. What this means is that on larger posts, mobile sites don't have a ton of requests for comment images. This makes load time incredibly fast! If you'd like to change it back, just replace it with the regular wordpress gravatar call:
          echo get_avatar($comment,$size='32',$default='<path_to_url>' );
        */
        ?>
        <?php // custom gravatar call ?>
        <?php
          // create variable
          $bgauthemail = get_comment_author_email();
        ?>
        <img data-gravatar="http://www.gravatar.com/avatar/<?php echo md5( $bgauthemail ); ?>?s=40" class="load-gravatar avatar avatar-48 photo" height="40" width="40" src="<?php echo get_template_directory_uri(); ?>/library/images/nothing.gif" />
        <?php // end custom gravatar call ?>
        <?php printf(__( '<cite class="fn">%1$s</cite> %2$s', 'bonestheme' ), get_comment_author_link(), edit_comment_link(__( '(Edit)', 'bonestheme' ),'  ','') ) ?>
        <time datetime="<?php echo comment_time('Y-m-j'); ?>"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>"><?php comment_time(__( 'F jS, Y', 'bonestheme' )); ?> </a></time>

      </header>
      <?php if ($comment->comment_approved == '0') : ?>
        <div class="alert alert-info">
          <p><?php _e( 'Your comment is awaiting moderation.', 'bonestheme' ) ?></p>
        </div>
      <?php endif; ?>
      <section class="comment_content cf">
        <?php comment_text() ?>
      </section>
      <?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
    </article>
  <?php // </li> is added by WordPress automatically ?>
<?php
} // don't remove this bracket!


/*
This is a modification of a function found in the
twentythirteen theme where we can declare some
external fonts. If you're using Google Fonts, you
can replace these fonts, change it in your scss files
and be up and running in seconds.
*/
function bones_fonts() {
  wp_register_style('googleFonts', 'http://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic');
  wp_enqueue_style( 'googleFonts');
}

add_action('wp_print_styles', 'bones_fonts');


function siecus_menu_classes($classes, $item) {
  if(is_singular('staff_profile') && $item->title == 'About Us') {
    $classes[] = 'current-menu-item';
  }
  if(is_singular('resources') && $item->title == 'Resources') {
    $classes[] = 'current-menu-item';
  }
  if(is_singular('post') && $item->title == 'News & Updates') {
    $classes[] = 'current-menu-item';
  }

  return $classes;
}
add_filter('nav_menu_css_class' , 'siecus_menu_classes' , 10 , 2);

add_action( 'wp_ajax_nopriv_load_more_posts', 'load_more_posts' );
add_action( 'wp_ajax_load_more_posts', 'load_more_posts' );

function load_more_posts() {
	// Our variables
	$term_id        = ( isset( $_GET['term_id'] ) ) ? $_GET['term_id'] : 0;
	$type           = ( isset( $_GET['posttype'] ) ) ? $_GET['posttype'] : 0;
	$resourcetype   = ( isset( $_GET['resourcetype'] ) ) ? $_GET['resourcetype'] : 0;
	$paged          = ( isset( $_GET['paged'] ) ) ? $_GET['paged'] : 1;

	$args         = array(
		'post_type'      => $type,
		'posts_per_page' => -1,
        'paged'          => $paged,
		'post_status'         => 'publish',
		'resource_type'  => $resourcetype,
	);
	if ( !empty($term_id)) {
		$args['tax_query'] =
			array (
				array (
					'taxonomy' => 'update_type',
					'field' => 'id',
					'terms' => $term_id
				)
			);
	}

	$query1       = new WP_Query( $args );

	$html = '';
	if ($query1->have_posts()) {
		while ( $query1->have_posts() ) {
			$query1->the_post();
			$html .= render( 'individual-post.php', array( 'newly_loaded' => true ) );
		}
	} else {
		$html = 'No posts were found.';
    }

	wp_reset_postdata();

	echo json_encode(array(
	    'html' => mb_convert_encoding($html, 'UTF-8', 'auto'),
        'show_next_page' => ($query1->max_num_pages > $paged)
    ));
	die();
}

add_action( 'wp_ajax_nopriv_load_more_resources', 'load_more_resources' );
add_action( 'wp_ajax_load_more_resources', 'load_more_resources' );

function load_more_resources() {
	$term_id        = ( isset( $_GET['term_id'] ) ) ? $_GET['term_id'] : 0;
	$paged          = ( isset( $_GET['paged'] ) ) ? $_GET['paged'] : 1;

	$args         = array(
        'post_type'      => 'resources',
		'post_status'         => 'publish',
		'posts_per_page' => -1,
		'paged'          => $paged
	);
	if ( !empty($term_id) && $term_id != 'all') {
		$args['tax_query'] =
			array (
				array (
					'taxonomy' => 'resource_type',
					'field' => 'id',
					'terms' => $term_id
				)
			);
	}

	$query       = new WP_Query( $args );

	$html = '';
	if ($query->have_posts()) {
		while ( $query->have_posts() ) {
			$query->the_post();
			$html .= render( 'individual-resource-box.php', array( 'newly_loaded' => true ) );
		}
	} else {
		$html = 'No posts were found.';
	}

	wp_reset_postdata();

	echo json_encode(array(
		'html' => mb_convert_encoding($html, 'UTF-8', 'auto'),
		'show_next_page' => ($query->max_num_pages > $paged)
	));
	die();
}


add_action( 'wp_ajax_nopriv_load_more_ptype', 'load_more_ptype' );
add_action( 'wp_ajax_load_more_ptype', 'load_more_ptype' );

function load_more_ptype() {
    $paged          = ( isset( $_GET['paged'] ) ) ? $_GET['paged'] : 1;
    $hide_date      = ( isset( $_GET['hide_date'] ) ) ? $_GET['hide_date'] : null;
    $social_share   = ( isset( $_GET['enable_social_share'] ) ) ? $_GET['enable_social_share'] : null;
    $args           = ( isset( $_GET['args'] ) ) ? json_decode(str_replace("\\", "", $_GET['args']), true) : array();

    $args['paged'] = $paged;
    $args['post_status'] = 'publish';
    $query = new WP_Query( $args );

    $html = '';
    if ($query->have_posts()) {
        while ( $query->have_posts() ) {
            $query->the_post();
            $html .= render( 'individual-bluetrails-box.php', array(
                'newly_loaded'  => true,
                'hide_date'     => $hide_date,
                'social_share'  => $social_share,
            ) );
        }
    } else {
        $html = 'No posts were found.';
    }

    wp_reset_postdata();

    echo json_encode(array(
        'html' => mb_convert_encoding($html, 'UTF-8', 'auto'),
        'show_next_page' => ($query->max_num_pages > $paged)
    ));
    die();
}


function render( $template, $data ) {
    extract( $data );
    ob_start();
    include( "template-parts/{$template}" );
    $content = ob_get_contents();
    ob_end_clean();
    return $content;
}

function max_title_length( $title, $max = 20) {
	if( strlen( $title ) > $max ) {
		return substr( $title, 0, $max ). " &hellip;";
	} else {
		return $title;
	}
}
add_filter( 'get_the_title', 'max_title_length');

add_action('acf/init', 'siecus_acf_init');
function siecus_acf_init() {
	if( function_exists('acf_add_options_page') ) {
		$option_page = acf_add_options_page(array(
			'page_title' 	=> __('Theme General Settings', 'siecus'),
			'menu_title' 	=> __('Theme Settings', 'siecus'),
			'menu_slug' 	=> 'theme-general-settings',
		));
	}
}

function get_excerpt($limit, $source = null){

	if($source == "content" ? ($excerpt = get_the_content()) : ($excerpt = get_the_excerpt()));
	$excerpt = preg_replace(" (\[.*?\])",'',$excerpt);
	$excerpt = strip_shortcodes($excerpt);
	$excerpt = strip_tags($excerpt);
	$excerpt = substr($excerpt, 0, $limit);
	$excerpt = substr($excerpt, 0, strripos($excerpt, " "));
	$excerpt = trim(preg_replace( '/\s+/', ' ', $excerpt));
	$excerpt = $excerpt . ' ...';
	return $excerpt;
}

function rewrite_post_class( $classes, $class, $post_id ) {
    // Remove a class
    if ( (get_post_type( $post_id ) == 'state_profile') && $index = array_search( 'hentry', $classes ) ) {
        unset( $classes[ $index ] );
    }

	return $classes;
}
add_filter( 'post_class', 'rewrite_post_class', 10, 3 );
