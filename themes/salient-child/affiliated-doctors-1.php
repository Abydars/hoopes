<?php
/**
 * Template Name: Affiliated Doctors 1
 */
?>


	<!-- Google Map API -->		<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDxEHMDmErex6FF9RnbYwotnOM9-cGXPtA"></script>

	<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri() . '/css/affiliated-doctors.css'; ?>" />
	<link rel='stylesheet' id='less-css'  href='/wp-content/themes/salient-child/css/less.css' type='text/css' media='all' />
	<script type="stylesheet" href="https://code.jquery.com/jquery-3.3.1.js"></script>
	<script type="text/javascript" src="/wp-content/themes/salient-child/js/lib/jquery/jquery-ui.min.js"></script>
	<script type="text/javascript" src="/wp-content/themes/salient-child/js/main.js"></script>
	<script type="text/javascript" src="/wp-content/themes/salient-child/js/input.js"></script>
	    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
	

	<!-- jQuery Extensions -->
	<script type="text/javascript" src="<?php echo get_template_directory_uri() . '/js/lib/jquery/jquery-mousewheel.min.js'; ?>"></script>
	<!-- JS Functionality -->
	<script type="text/javascript" src="<?php echo get_template_directory_uri() . '/js/affiliated-doctors.js'; ?>"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery.validation/1.13.1/jquery.validate.min.js"></script>

    <section class="item-list row container">
        
        <div class="row spaced">
            <div class="col dw-100">
                <div class="content boxed">
                    <?php
                    if ( have_posts() ) {
                        while ( have_posts() ) {
                            the_post();
                            the_content();
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </section>

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
				<div class="abc" style="display:block">
                <label class="no-pad"><input id="affiliated-doctors-zip-input" type="text" placeholder="Enter Here" value="" /></label>
				<label class="radius">
					<span>Radius</span>
					<select id="affiliated-doctors-radius-input">
						<option value="5">5</option>
						<option value="10">10</option>
						<option value="15">15</option>
						<option value="25">25</option>
						<option value="50">50</option>
					</select>
					<span>miles</span>
				</label>
				</div>
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
<script>





</script>
<?php get_footer(); ?>
