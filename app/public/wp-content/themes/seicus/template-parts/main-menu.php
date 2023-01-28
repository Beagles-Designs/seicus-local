<div class="mobile-only mobile-search">
	<?php get_search_form(true); ?>
</div>

<div id="inner-main-nav" class="wrap cf">
    <nav role="navigation">
		<?php wp_nav_menu(array(
			'container'             => false,                           // remove nav container
			'container_class'       => 'menu cf',                 // class of container (should you choose to use it)
			'menu'                  => __( 'The Main Menu', 'bonestheme' ),  // nav name
			'menu_class'            => 'nav top-nav cf',               // adding custom nav class
			'theme_location'        => 'main-nav',                 // where it's located in the theme
			'before'                => '',                                 // before the menu
			'after'                 => '<span class="opener"></span>',
            'link_before'           => '',                            // before each link
			'link_after'            => '',                             // after each link
			'depth'                 => 0,                                   // limit the depth of the nav
			'fallback_cb'           => ''                             // fallback function (if there is one)
		)); ?>
        <div class="social-links">
					<a href="https://www.instagram.com/siecus/" class="it" target="_blank">
							<img height="24" src="<?php echo get_template_directory_uri(); ?>/library/images/instagram-blue.svg" />
					</a>
						<a href="http://www.facebook.com/SIECUS" class="fb" target="_blank">
                <img height="24" src="<?php echo get_template_directory_uri(); ?>/library/images/facebook-blue.svg" />
            </a>
            <a href="http://twitter.com/siecus" class="tw" target="_blank">
                <img height="20" src="<?php echo get_template_directory_uri(); ?>/library/images/twitter-blue.svg" />
            </a>
            <a href="https://www.linkedin.com/company/siecus/" class="tw" target="_blank">
                <img height="24" src="<?php echo get_template_directory_uri(); ?>/library/images/linkedin-blue.svg" />
            </a>
        </div>
        <a class="search-button desktop-only">Search</a>
        <div class="top-widgets mobile-only" id="mobile-menu-newsletter">
            <?php
            if(is_active_sidebar('topsidebar')){
                dynamic_sidebar('topsidebar');
            } ?>
        </div>
    </nav>
</div>
<div class="desktop-only desktop-search">
	<?php get_search_form(true); ?>
</div>
