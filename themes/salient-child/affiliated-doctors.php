<?php
/**
 * Template Name: Affiliated Doctors
 */
get_header();

?>

	<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri() . '/css/affiliated-doctors.css'; ?>" />

	<!-- Google Map API -->
	<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDxEHMDmErex6FF9RnbYwotnOM9-cGXPtA"></script>
	<!-- jQuery Extensions -->
	<script type="text/javascript" src="<?php echo get_template_directory_uri() . '/js/lib/jquery/jquery-mousewheel.min.js'; ?>"></script>
	<script type="text/javascript" src="<?php echo get_template_directory_uri() . '/js/lib/jquery/jquery-ui.min.js'; ?>"></script>
	<!-- JS Functionality -->
	<script type="text/javascript" src="<?php echo get_template_directory_uri() . '/js/affiliated-doctors.js'; ?>"></script>

  <div class="container-wrap">

	<div class="<?php if($page_full_screen_rows != 'on') echo 'container'; ?> main-content">

		<div class="row">

			<?php

			//breadcrumbs
			if ( function_exists( 'yoast_breadcrumb' ) && !is_home() && !is_front_page() ){ yoast_breadcrumb('<p id="breadcrumbs">','</p>'); }

			 //buddypress
			 global $bp;
			 if($bp && !bp_is_blog_page()) echo '<h1>' . get_the_title() . '</h1>';

			 //fullscreen rows
			 if($page_full_screen_rows == 'on') echo '<div id="nectar_fullscreen_rows" data-animation="'.$page_full_screen_rows_animation.'" data-row-bg-animation="'.$page_full_screen_rows_bg_img_animation.'" data-animation-speed="'.$page_full_screen_rows_animation_speed.'" data-content-overflow="'.$page_full_screen_rows_content_overflow.'" data-mobile-disable="'.$page_full_screen_rows_mobile_disable.'" data-dot-navigation="'.$page_full_screen_rows_dot_navigation.'" data-footer="'.$page_full_screen_rows_footer.'" data-anchors="'.$page_full_screen_rows_anchors.'">';


				 if(have_posts()) : while(have_posts()) : the_post();

					 the_content();

				 endwhile; endif;

			if($page_full_screen_rows == 'on') echo '</div>'; ?>

  

	<div class="affiliated-doctors-container">
		<div class="search-kit">
			<form method="POST" enctype="multipart/form-data">
                <label class="searchby">
                    <span class="filter">Search By:</span>
                    <select id="affiliated-doctors-searchby-input">
                        <option value="zip" selected="selected">Zip Code</option>
                        <option value="name">Name</option>
                    </select>
                </label>
                <input id="affiliated-doctors-zip-input" type="text" placeholder="Enter Here" value="Enter Here" />

					<span class="radius-bg"><span>Radius</span>
					<select id="affiliated-doctors-radius-input">
						<option value="5">5</option>
						<option value="10">10</option>
						<option value="15">15</option>
						<option value="25">25</option>
						<option value="50">50</option>
					</select>
					<span>miles</span></span>

                <button type="submit" class="btn search">
                    Search
                </button>
				<button type="button" class="btn refresh" style="margin-left: 3px;">
					<i class="fa fa-refresh"></i>
				</button>
                <button type="button" class="btn print-directions-button inactive">
                    <span>Print Directions</span>
                </button>
			</form>
		</div>
		<div class="map">
			<div id="map-canvas" data-marker="<?php echo get_template_directory_uri(); ?>/img/map-marker.png"></div>
			<div class="listing">
				<div class="scroll-container" style="margin-top: 0;">
					<?php
						$doctors = get_posts(array(
							'post_type' => 'affiliated_doctor',
							'posts_per_page' => -1,
							'meta_key' => 'first_name',
							'order' => 'ASC',
							'orderby' => 'meta_value'
						));
						foreach ($doctors as $doctor) {
							$doctor_name = get_field('first_name', $doctor->ID) . ' ' . get_field('last_name', $doctor->ID);
							$practice_name = get_field('practice_name', $doctor->ID);
							$doctor_location = get_field('address', $doctor->ID) . '<br />' . get_field('city', $doctor->ID) . ', ' . get_field('state', $doctor->ID) . ', ' . get_field('zip_code', $doctor->ID);
							$doctor_number = get_field('phone_number', $doctor->ID);
							$doctor_uri = get_field('website', $doctor->ID);
							?>
							<div class="doctor" data-id="<?php echo $doctor->ID; ?>" data-name="<?php echo $doctor_name; ?>" data-practice="<?php echo $practice_name; ?>" data-location="<?php echo $doctor_location; ?>" data-number="<?php echo $doctor_number; ?>" data-uri="<?php echo $doctor_uri; ?>" data-latitude="<?php echo get_post_meta($doctor->ID, 'latitude', true); ?>" data-longitude="<?php echo get_post_meta($doctor->ID, 'longitude', true); ?>">
								<h4><?php echo $doctor_name; ?></h4>
								<p><?php echo $practice_name; ?></p>
								<p><?php echo $doctor_location; ?></p>
								<p><?php echo $doctor_number; ?></p>
								<p><?php echo $doctor_uri; ?></p>
							</div>
						<?php }
					?>
				</div>
			</div>
			<div class="destination-info"></div>
			<div class="directions-panel"></div>
		</div>
	</div>

</div><!--/row-->

</div><!--/container-->

</div><!--/container-wrap-->
<script>
    $("#affiliated-doctors-zip-input").attr("placeholder","Enter Here");
</script>

<?php get_footer(); ?>
