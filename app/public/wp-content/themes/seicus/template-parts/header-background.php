<?php
$thumb_id = get_post_thumbnail_id();
$thumb_url_array = wp_get_attachment_image_src($thumb_id, 'full', true);
$thumb_url = $thumb_url_array[0];

?>
	<div class="header-background" style="background-image: url('<?php echo $thumb_url; ?>');">
		<div class="header-wp">
			<div class="wrap">
				<h1 itemprop="headline">
					<?php
					the_title();
					?>
				</h1>
				<?php
					if (empty($hide_large_text_header )) {
						$large_title = get_field('page_description_large_text');
						echo !empty($large_title) ? ('<h3>' . $large_title . '</h3>') : '';
					}
				?>
			</div>
		</div>
	</div> <?php // end article header ?>
