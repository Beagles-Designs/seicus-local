<?php
/*
 Template Name: Staff
 *
 * This is your custom page template. You can create as many of these as you need.
 * Simply name is "page-whatever.php" and in add the "Template Name" title at the
 * top, the same way it is here.
 *
 * When you create your page, you can just select the template and viola, you have
 * a custom page template to call your very own. Your mother would be so proud.
 *
 * For more info: http://codex.wordpress.org/Page_Templates
*/
?>



<?php get_header();

include('template-parts/header-background.php');

?>




			<div id="content">

				<div id="inner-content" class="cf">

						<div id="main" class="" role="main">


							<div class="staff-wp">


							<div class="staff-category staff">
									<div class="wrap">
								<h1>Staff</h1>
								<div class="staff-group">
							<?php
								// The Query
								$args = array(
										'post_type'	 =>	'staff_profile',
										'profile_type' => 'staff',
										'orderby' => 'menu_order',
										'posts_per_page'=>-1
									);
								$query1 = new WP_Query( $args );
								// The Loop
								while ( $query1->have_posts() ) {
									$query1->the_post(); ?>

									<div class="individual">
									<div class="profile-image"><?php the_post_thumbnail('full'); ?></div>
									<div class="profile-content">
									<h3><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>
									<p><?php the_field('job_title'); ?></p>
									<?php if (get_field('organization')):?><span><?php the_field('organization'); ?></span><?php endif;?>
									<?php if (get_field('location')):?><span><?php the_field('location'); ?></span><?php endif;?>
								</div>
									</div>
								<?php
								}

								/* Restore original Post Data
								 * NB: Because we are using new WP_Query we aren't stomping on the
								 * original $wp_query and it does not need to be reset with
								 * wp_reset_query(). We just need to set the post data back up with
								 * wp_reset_postdata().
								 */
								wp_reset_postdata();

								?>
							</div>
							<div class="intern-button">
								<?php
								$intern_label = get_field('button_label');
								$intern_link = get_field('button_link');
								?>
								<a href="<?php echo $intern_link;?>" ><?php echo $intern_label;?></a>
							</div>
							</div>
							</div>
							<div class="staff-category board">
									<div class="wrap">
								<h1>Board of Directors</h1>
									<div class="staff-group">
							<?php
								// The Query
								$args = array(
										'post_type'	 =>	'staff_profile',
										'profile_type' => 'board',
										'orderby' => 'menu_order',
										'posts_per_page'=>-1

									);
								$query2 = new WP_Query( $args );
								// The Loop
								while ( $query2->have_posts() ) {
									$query2->the_post(); ?>
									<div class="individual">
									<div class="profile-image"><?php the_post_thumbnail('full'); ?></div>
									<div class="profile-content">
									<h3><?php the_title(); ?></h3>
									<p><?php the_field('job_title'); ?></p>
									<?php if (get_field('organization')):?><span><?php the_field('organization'); ?></span><?php endif;?>
									<?php if (get_field('location')):?><span><?php the_field('location'); ?></span><?php endif;?>
								</div>
									</div>
								<?php
								}

								/* Restore original Post Data
								 * NB: Because we are using new WP_Query we aren't stomping on the
								 * original $wp_query and it does not need to be reset with
								 * wp_reset_query(). We just need to set the post data back up with
								 * wp_reset_postdata().
								 */
								wp_reset_postdata();

								?>
								</div>
							</div>
							</div>



						</div>
	<?php the_content(); ?>

				</div>

			</div>


<?php get_footer(); ?>
