<?php
$thumb_url = get_field('single_header_background_image');
if (empty($thumb_url)&&is_singular('staff_profile')) {
	$thumb_url =  get_template_directory_uri() . '/library/images/siecus-staff-placeholder.jpg';
}
elseif (empty($thumb_url)&&is_singular('resources')) {
	$thumb_url =  site_url() . '/wp-content/uploads/2018/07/andrew-pons-6488-unsplash.jpg';
}
elseif (empty($thumb_url)&&is_singular('state_profile')) {
	$thumb_url =  site_url() . '/wp-content/uploads/2018/07/image1.jpg';
}
elseif (is_singular('resources')&& has_term('standards-guidelines', 'resource-type')) {
	$thumb_url =  site_url() . '/wp-content/uploads/2018/07/andrew-pons-6488-unsplash.jpg';
}
?>
	<div class="header-background" <?php echo !empty($thumb_url) ? 'style="background-image: url(\'' . $thumb_url . '\');' : ''; ?>');">
		<div class="header-wp">
			<div class="wrap">
				<h2 itemprop="headline"><?php echo $header_title; ?></h2>
				<?php
					if (empty($hide_large_text_header )) {
						$large_title = get_field('page_description_large_text');
						echo !empty($large_title) ? ('<p>' . $large_title . '</p>') : '';
					}
				?>
			</div>
		</div>
	</div> <?php // end article header ?>
