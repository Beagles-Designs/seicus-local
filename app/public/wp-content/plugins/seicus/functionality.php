<?php
/*
Plugin Name: Custom Functionality Plugin for Siecus site
Description: Move functions away from functions.php
Author: Rad Campaign
Version: 0.4
Author URI: http://www.radcampaign.com
License: GPL2
*/

//add custom post type
require_once( 'inc/custom-post-types.php' );
//add custom taxonomies
require_once( 'inc/custom-taxonomies.php' );
//resource custom fields
require_once('inc/custom-fields.php');
//add image handling
require_once( 'inc/image-handling.php');
//slider
require_once('inc/widget-slider.php');
//content widget
require_once('inc/widget-content.php');
//callout widget
require_once('inc/widget-callout.php');
//video callout widget
require_once('inc/widget-video.php');
//resource callout widget
require_once('inc/widget-resource.php');
/*
 Some fun default stuff we often use.
*/

/**
 * CHANGE LOGO ON LOGIN PAGE
 */

function custom_login_logo() {
	echo '<style type="text/css">
    h1 a { background-image:url('.get_stylesheet_directory_uri().'library/images/screenshot.png) !important; }
    </style>';
}

add_action('login_head', 'custom_login_logo');

/**
 * ADD GOOGLE ANALYTICS TO THE FOOTER OF EACH PAGE
 * Modify UA-XXXXXXX-1 number
 * Modify yourdomainname.com
 * Commenting out as plugin is available
 */


/*function custom_googleanalytics() {
    ?>
    <script type="text/javascript">

    var _gaq = _gaq || [];
    _gaq.push(['_setAccount', 'UA-XXXXXXX-1']);
    _gaq.push(['_setDomainName', 'yourdomainname.com']);
    _gaq.push(['_setAllowLinker', true]);
    _gaq.push(['_trackPageview']);

    (function() {
        var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
        ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
        var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
    })();

    </script>
    <?php }

    add_action('wp_footer', 'add_googleanalytics');*/
/*
* USE THIS FUNCTION TO ADD CUSTOM CSS TO THE WP ADMIN
*/

function custom_custom_header() {
	echo '<style type="text/css">
   body {border: 1px solid #ccc}
   .dashicons-admin-media:before {content:"\f128"}
   </style>';
}


add_action('admin_head', 'custom_custom_header');

/**
 * REMOVE ADMIN MENU ITEMS FROM USERS WHO ARE NOT SUPER ADMIN FOR WORDPRESS NETWORK SUTES
 * Source: http://justintadlock.com/archives/2011/06/13/removing-menu-pages-from-the-wordpress-admin
 * Commenting out as unneeded.
 **/

/*function tcl_remove_menus() {
    if ( !is_super_admin() ) {
        remove_menu_page( 'plugins.php' );
        remove_menu_page( 'link-manager.php' );
        remove_submenu_page( 'themes.php', 'themes.php' );
        remove_submenu_page( 'tools.php', 'ms-delete-site.php' );
    }
}

add_action( 'admin_menu', 'tcl_remove_menus', 999 );*/


/**
 * CUSTOM POST HIGHLIGHTING BASED ON POST STATUS
 */

function custom_colorcode_poststatus() { ?>
    <style>
        .status-draft{background: #FFFF99 !important;}
        .status-pending{background: #87C5D6 !important;}
        .status-publish{/* no background - keep alternating rows */}
        .status-future{background: #CCFF99 !important;}
        .status-private{background:#FFCC99;}
    </style>
<?php }

add_action('admin_head','custom_colorcode_poststatus');

/**
 * REDIRECT RSS TO FEEDBURNER
 * Commenting out as unnecessary right now
 */

/*function custom_rss_feed_redirect() {
    global $feed;
    $new_feed = 'http://feeds.feedburner.com/wanderingbrit';

    if (!is_feed()) {
        return;
    }
    if (preg_match('/feedburner/i', $_SERVER['HTTP_USER_AGENT'])){
        return;
    }
    if ($feed != 'comments-rss2') {
        if (function_exists('status_header')) status_header( 302 );
        header("Location:" . $new_feed);
        header("HTTP/1.1 302 Temporary Redirect");
        exit();
    }
}

add_action('template_redirect', 'custom_rss_feed_redirect');*/

/**
 * REMOVE WORDPRESS VERSION NUMBER FROM HEADER, RSS FEEDS AND ALL OTHER LOCATIONS.
 */

function custom_remove_wp_version() {
	return '';
}
add_filter('the_generator', 'custom_remove_wp_version');

function custom_remove_footer_admin () {
	echo 'Fueled by <a href="http://www.yourdomain.com" target="_blank">Your Domain</a> | Designed by <a href="http://www.yourdesigner.com" target="_blank">Your Designer Productions</a> | Another Custom Link: <a href="http://www.domain.com" target="_blank">Custom Link</a></p>';
}
add_filter('admin_footer_text', 'custom_remove_footer_admin');


/**
 * CHANGE THE DEFAULT GRAVATAR IN WORDPRESS
 * Upload a custom image to your theme's image folder called gravatar.gif.
 * Once you upload the image, then visit: WP-Admin > Settings > Discussion
 * Commenting out for now as unnecessary
 */

/*function custom_newgravatar ($avatar_defaults) {
    $myavatar = get_bloginfo('template_directory') . '/images/gravatar.gif';
    $avatar_defaults[$myavatar] = "WPBeginner";
    return $avatar_defaults;
}
add_filter( 'avatar_defaults', 'custom_newgravatar' );*/


/**
 * REMOVE ERROR MESSAGE ON THE LOGIN PAGE
 */
add_filter('login_errors',create_function('$a', "return null;"));


/**
 * DELAY RSS PUBLISHING OF NEW POSTS BY A FEW MINUTES
 */
function custom_publish_later_on_feed($where) {
	global $wpdb;

	if ( is_feed() ) {
		// timestamp in WP-format
		$now = gmdate('Y-m-d H:i:s');

		// value for wait; + device
		$wait = 10; // integer

		// http://dev.mysql.com/doc/refman/5.0/en/date-and-time-functions.html#function_timestampdiff
		$device = 'MINUTE'; //MINUTE, HOUR, DAY, WEEK, MONTH, YEAR

		// add SQL-sytax to default $where
		$where .= " AND TIMESTAMPDIFF($device, $wpdb->posts.post_date_gmt, '$now') > $wait ";
	}
	return $where;
}

add_filter('posts_where', 'custom_publish_later_on_feed');

/**
 * DISABLE RSS FEEDS
 * Not needed in this case
 */
/*function custom_disable_feed() {
    wp_die( __('No feed available, please visit our <a href="'. get_bloginfo('url') .'">homepage</a>!') );
}

add_action('do_feed', 'custom_disable_feed', 1);
add_action('do_feed_rdf', 'custom_disable_feed', 1);
add_action('do_feed_rss', 'custom_disable_feed', 1);
add_action('do_feed_rss2', 'custom_disable_feed', 1);
add_action('do_feed_atom', 'custom_disable_feed', 1);*/


/**
 * THEME THE TINYMCE EDITOR
 * Create custom-editor-style.css in your theme folder
 * Not necessary for BT
 */
//add_editor_style('custom-editor-style.css');


/**
 * Set a maximum width for Oembedded objects
 */
if ( ! isset( $content_width ) )
	$content_width = 660;


/**
 * ADD DEFAULT POSTS AND COMMENTS RSS FEED LINKS TO HEAD
 */
add_theme_support( 'automatic-feed-links' );


/**
 * ENABLE ADMIN TO SET CUSTOM BACKGROUND IMAGES IN 'APPEARANCE > BACKGROUND'
 */
//add_custom_background();

/**
 * RANDOMLY CHOSEN PLACEHOLDER TEXT FOR POST/PAGE EDIT SCREEN
 * Commenting out for now
 */
/*function custom_writing_encouragement( $content ) {
    global $post_type;
    if($post_type == "post"){
        $encArray = array(
        // Placeholders for the posts editor
            "Test post message one.",
            "Test post message two.",
            "<h1>Test post heading!</h1>"
            );
        return $encArray[array_rand($encArray)];
    }
    else{ $encArray = array(
        // Placeholders for the pages editor
        "Test page message one.",
        "Test page message two.",
        "<h1>Test Page Heading</h1>"
        );
        return $encArray[array_rand($encArray)];
    }
}
add_filter( 'default_content', 'custom_writing_encouragement' );*/


/**
 * CHANGE AMOUNT OF POSTS ON THE SEARCH PAGE
 */
function custom_search_results_per_page( $query ) {
	global $wp_the_query;
	if ( ( ! is_admin() ) && ( $query === $wp_the_query ) && ( $query->is_search() ) ) {
		$query->set( 'custom_search_results_per_page', 20 );
	}
	return $query;
}
add_action( 'pre_get_posts',  'custom_search_results_per_page'  );


/**
 * CREATE A PERMALINK AFTER THE EXCERPT
 * This can be in theme
 */
/*function custom_replace_excerpt($content) {
    return str_replace('[...]',
        '<a class="readmore" href="'. get_permalink() .'">Continue Reading</a>',
        $content
        );
}
add_filter('the_excerpt', 'custom_replace_excerpt');*/

function custom_excerpt_length( $length ) {
	return 20;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );
function custom_has_sidebar($classes) {
	if (is_active_sidebar('sidebar')) {
		// add 'class-name' to the $classes array
		$classes[] = 'has_sidebar';
	}
	// return the $classes array
	return $classes;
}
add_filter('body_class','custom_has_sidebar');

/**
 * STOP IMAGES GETTING WRAPPED UP IN P TAGS WHEN THEY GET DUMPED OUT WITH THE_CONTENT() FOR EASIER THEME STYLING
 */
function custom_remove_img_ptags($content){
	return preg_replace('/<p>\s*(<a .*>)?\s*(<img .* \/>)\s*(\/a>)?\s*<\/p>/iU', '\1\2\3', $content);
}
add_filter('the_content', 'custom_remove_img_ptags');


/**
 * CALL THE GOOGLE CDN VERSION OF JQUERY FOR THE FRONTEND
 * MAKE SURE YOU USE THIS WITH WP_ENQUEUE_SCRIPT('JQUERY'); IN YOUR HEADER
 */
function custom_jquery_enqueue() {
	wp_deregister_script('jquery');
	wp_register_script('jquery', "//ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js", false, null);
	wp_enqueue_script('jquery');

	//register cycle plugins for sliders
	wp_register_script( 'cycle', plugin_dir_url(__FILE__) . '/js/jquery.cycle2.min.js', array( 'jquery' ), '', true  );
	wp_register_script( 'cycle-swipe', plugin_dir_url(__FILE__) . '/js/jquery.cycle2.swipe.min.js', array( 'jquery' ), '', true  );
}
if (!is_admin()) add_action("wp_enqueue_scripts", "custom_jquery_enqueue", 11);


/**
 * CALL GOOGLES HTML5 SHIM, BUT ONLY FOR USERS ON OLD VERSIONS OF IE
 */
function custom_IEhtml5_shim () {
	global $is_IE;
	if ($is_IE)
		echo '<!--[if lt IE 9]><script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->';
}
add_action('wp_head', 'custom_IEhtml5_shim');


/**
 * REMOVE THE VERSION NUMBER OF WP
 * THIS INFO IS ALSO AVAILABLE IN THE README.HTML FILE IN YOUR ROOT DIRECTORY. SHOULD DELETE THIS FILE.
 */
remove_action('wp_head', 'wp_generator');


/**
 * OBSCURE LOGIN SCREEN ERROR MESSAGES
 */
function custom_login_obscure(){ return '<strong>Sorry</strong>: Think you have gone wrong somwhere!';}
add_filter( 'login_errors', 'custom_login_obscure' );


/**
 * DISABLE THE THEME / PLUGIN TEXT EDITOR IN ADMIN
 */
define('DISALLOW_FILE_EDIT', false);

/**
 * TEMP MAINTENANCE - WITH HTTP RESPONSE 503 (SERVICE TEMPORARILY UNAVAILABLE)
 * THIS WILL ONLY BLOCK USERS WHO ARE NOT AN ADMINISTRATOR FROM VIEWING THE WEBSITE.
 */
/*function wp_maintenance_mode(){
    if(!current_user_can('edit_themes') || !is_user_logged_in()){
        wp_die('Maintenance, please come back soon.', 'Maintenance - please come back soon.', array('response' => '503'));
    }
}
add_action('get_header', 'wp_maintenance_mode');*/


/**
 * CHANGE THE FAILED LOGIN MESSAGE FOR EXTRA WORDPRESS SECRUTY
 */
function failed_login() {
	return 'Incorrect login information.';
}
add_filter('login_errors', 'failed_login');


/**
 * THIS FUNCTION WILL ADD A CLASS OF 'LAST' TO THE VERY LAST POST IN A LOOP.
 */
function last_post_class($classes){
	global $wp_query;
	if(($wp_query->current_post+1) == $wp_query->post_count) $classes[] = 'last';
	return $classes;
}
add_filter('post_class', 'last_post_class');


/**
 * HIDE WORDPRESS UPDATE
 */
function wp_hide_update() {
	remove_action('admin_notices', 'update_nag', 3);
}
add_action('admin_menu','wp_hide_update');

/**
 * OUTPUT A SCREENSHOT OF ANY WEBSITE USING S.WORDPRESS.COM
 * Usage: [snap url="http://google.com/" alt="Nite Site" w="400" h="300"]
 */
function wp_snap($atts, $content = NULL) {
	extract(shortcode_atts(array(
		"snap" => 'http://s.wordpress.com/mshots/v1/',
		"url" => 'http://google.com/',
		"alt" => 'Nice Site',
		"w" => '400', // width
		"h" => '300' // height
	), $atts));

	$img = '<img alt="' . $alt . '" src="' . $snap . '' . urlencode($url) . '?w=' . $w . '&h=' . $h . '" />';
	return $img;
}
add_shortcode("snap", "wp_snap");


/**
 * ADMIN NOTES
 * USE [NOTE]THIS WILL APPEAR ONLY TO ADMINS[/NOTE]
 */
function adminnote($atts, $content = NULL){
	if(current_user_can('edit_themes') || is_user_logged_in()){
		return '</pre>
        <div style="margin-bottom: 22px; font-family: Consolas, Monaco, \'Courier New\', Courier, monospace; font-size: 12px; font-weight: inherit; overflow-x: auto; white-space: -o-pre-wrap; width: 99%; word-wrap: break-word; background: #f3f3f7; border: 1px solid #dedee3; padding: 11px; line-height: 1.3em;"><b>Admin Notice</b>
        ' . $content . '</div>
        <pre>
        ';
	}
}
add_shortcode('note', 'adminnote');


add_filter('pre_get_posts', 'query_post_type');
function query_post_type($query) {
	if(is_category() || is_tag()) {
		$post_type = get_query_var('post_type');
		if($post_type)
			$post_type = $post_type;
		else
			$post_type = array('post','resources'); // replace cpt to your custom post type
		$query->set('post_type',$post_type);
		return $query;
	}
}

function namespace_add_custom_types( $query ) {
	if( is_category() || is_tag() && empty( $query->query_vars['suppress_filters'] ) ) {
		$query->set( 'post_type', array(
			'post', 'nav_menu_item', 'resources'
		));
		return $query;
	}
}
add_filter( 'pre_get_posts', 'namespace_add_custom_types' );

/**
 *
 * ADD ?debug=debug TO A URL TO SEE ERROR MESSAGES
 * http://codex.wordpress.org/Editing_wp-config.php#Debug
 */

if ( isset($_GET['debug']) && $_GET['debug'] == 'debug')
	define('WP_DEBUG', true);

/**
 *
 * ADD ?debug=debug TO A URL TO SEE ERROR MESSAGES
 * http://codex.wordpress.org/Editing_wp-config.php#Debug
 */

if ( isset($_GET['debug']) && $_GET['debug'] == 'debug')
	define('WP_DEBUG', true);
/*
* Now let's get specific to Blue Trails!
*/
function get_excerpt_by_id($post_id){
	$the_post = get_post($post_id); //Gets post ID
	$excerpt = $the_post->post_excerpt;
	$content = $the_post->post_content;
	if ($excerpt) {
		$the_excerpt = strip_tags(strip_shortcodes($excerpt)); //Strips tags and images
	} else {
		$the_excerpt = strip_tags(strip_shortcodes($content)); //Strips tags and images
		$the_excerpt = explode(" ", trim($the_excerpt));
		$the_excerpt = implode(" ", array_slice($the_excerpt,0,30)).'...';
	}
	return $the_excerpt;
}
// let us limit the excerpt to a specific word count on a case by case basis
// e.g.  $excerpt = get_the_excerpt();
// echo string_limit_words($excerpt,25);
function bt_string_limit_words($string, $word_limit)
{
	$words = explode(' ', $string, ($word_limit + 1));
	if(count($words) > $word_limit)
		array_pop($words);
	return implode(' ', $words);
}

?>
