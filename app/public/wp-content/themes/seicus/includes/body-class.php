<?php
function user_client_detection_body_class($classes) {
    require_once 'Mobile_Detect.php';
    global $is_lynx, $is_gecko, $is_IE, $is_opera, $is_NS4, $is_safari, $is_chrome, $is_iphone;

    global $detect;
    $detect = new Mobile_Detect;
    
    if($is_lynx)            $classes[] = 'lynx';    
    else if($is_gecko)      $classes[] = 'gecko';
    else if($is_opera)      $classes[] = 'opera';
    else if($is_NS4)        $classes[] = 'ns4';
    else if($is_safari)     $classes[] = 'safari';
    else if($is_chrome)     $classes[] = 'chrome';
    else if($is_IE)         $classes[] = 'ie';
    else                    $classes[] = 'unknown';

    if($is_IE &&
       preg_match('/MSIE ([0-9]+)([a-zA-Z0-9.]+)/', $_SERVER['HTTP_USER_AGENT'], $browser_version))
    {
        $classes[] = 'ie'.$browser_version[1];
    }

    $isMobile = $detect->isMobile();
    $isTablet = $detect->isTablet();

    if ( $isMobile ) {
        $classes[] = 'mobile-device';
    } else {
        $classes[] = 'desktop-device';
    }

    if ( $isTablet ) {
        $classes[] = 'tablet-device';
    }

    if ( $detect->version('iPad') ) $classes[] = 'ipad';
    if ( $detect->version('iPhone') ) $classes[] = 'iphone';
    if ( $detect->version('Android') ) $classes[] = 'android';

    if ( stristr( $_SERVER['HTTP_USER_AGENT'],'mac') ) $classes[] = 'osx';
    else if ( stristr( $_SERVER['HTTP_USER_AGENT'],'linux') ) $classes[] = 'linux';
    else if ( stristr( $_SERVER['HTTP_USER_AGENT'],'windows') ) $classes[] = 'windows';

    return $classes;
}

add_filter('body_class','user_client_detection_body_class');
?>
