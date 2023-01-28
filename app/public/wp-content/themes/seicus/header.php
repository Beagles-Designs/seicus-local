<!doctype html>

<!--[if lt IE 7]><html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie8 lt-ie7"><![endif]-->
<!--[if (IE 7)&!(IEMobile)]><html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie8"><![endif]-->
<!--[if (IE 8)&!(IEMobile)]><html <?php language_attributes(); ?> class="no-js lt-ie9"><![endif]-->
<!--[if gt IE 8]><!--> <html <?php language_attributes(); ?> class="no-js"><!--<![endif]-->

<head>
    <meta charset="utf-8">

	<?php // force Internet Explorer to use the latest rendering engine available ?>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title><?php wp_title(''); ?></title>

	<?php // mobile meta (hooray!) ?>
    <meta name="HandheldFriendly" content="True">
    <meta name="MobileOptimized" content="320">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

	<?php // icons & favicons (for more: http://www.jonathantneal.com/blog/understand-the-favicon/) ?>
    <link rel="apple-touch-icon" href="<?php echo get_template_directory_uri(); ?>/favicon.png">
    <link rel="icon" href="<?php echo get_template_directory_uri(); ?>/favicon.png">
    <!--[if IE]>
    <link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/favicon.ico">
    <![endif]-->
	<?php // or, set /favicon.ico for IE10 win ?>
    <meta name="msapplication-TileColor" content="#f01d4f">
    <meta name="msapplication-TileImage" content="<?php echo get_template_directory_uri(); ?>/favicon.png">
    <link href='https://fonts.googleapis.com/css?family=Oswald:400,700' rel='stylesheet' type='text/css'>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,400i,600,600i,700,700i" rel="stylesheet">
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
    <script type="text/javascript">var switchTo5x=true;</script>
    <script type="text/javascript" src="http://w.sharethis.com/button/buttons.js"></script>
    <script type="text/javascript">stLight.options({publisher: "15cda5b8-eb43-4617-a193-70ba0c1af7ac", doNotHash: false, doNotCopy: false, hashAddressBar: false});</script>
	<?php // wordpress head functions ?>
	<?php wp_head(); ?>
	<?php // end of wordpress head ?>

	<?php // drop Google Analytics Here ?>
	<?php // end analytics ?>
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/style.css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">

    <script>
        var siteUrl = '<?php echo site_url(); ?>';

        jQuery(document).ready(function(){
            jQuery('a[href^="#"]').on('click',function (e) {
                e.preventDefault();

                var target = this.hash,
                    jQuerytarget = jQuery(target);

                jQuery('html, body').stop().animate({
                    'scrollTop': jQuerytarget.offset().top-0
                }, 900, 'swing', function () {
                    window.location.hash = target;
                });
            });
        });
    </script>
</head>
<body <?php body_class(); ?>>

<div id="container">

    <header class="header" role="banner">

        <div id="inner-header" class="wrap cf">

			<?php // to use a image just replace the bloginfo('name') with your img src and remove the surrounding <p> ?>
            <div id="logo">
                <a href="<?php echo home_url(); ?>" rel="nofollow">
                    <img width="158" src="<?php echo get_template_directory_uri(); ?>/library/images/new-logo.svg" class="desktop desktop-only" />
                    <img width="120" src="<?php echo get_template_directory_uri(); ?>/library/images/new-logo.svg" class="mobile mobile-only" style="display:none" />
                </a>
            </div>
            <div class="mobile-only float-right">
                <div class="hamburger hamburger--squeeze js-hamburger">
                    <div class="hamburger-box">
                        <div class="hamburger-inner"></div>
                    </div>
                </div>
            </div>

            <div class="top-widgets desktop-only">
				<?php
				if(is_active_sidebar('topsidebar')){
					dynamic_sidebar('topsidebar');
				}
				?>
            </div>
        </div>

        <div id="mobile-nav" class="main-nav mobile-only">
			<?php echo get_template_part('template-parts/main-menu'); ?>
        </div>


        <!-- <div class="top-widgets mobile-only">
                    <?php
                    if(is_active_sidebar('topsidebar')){
                        dynamic_sidebar('topsidebar');
                    }
                    ?>
        </div> -->

        <div id="main-nav" class="main-nav desktop-only">
            <?php echo get_template_part('template-parts/main-menu'); ?>
        </div>
    </header>
