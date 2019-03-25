<?php

	class DoctorsImport {

		private $doctors;

		public function __construct() {
			$this->delete_doctors();
			$this->collect_doctors();
		}

		private function delete_doctors() {
			$doctors = get_posts(array(
				'post_type' => 'affiliated_doctor',
				'posts_per_page' => -1
			));
			foreach ($doctors as $doctor) {
				wp_delete_post($doctor->ID, true);
			}
		}

		private function collect_doctors() {
			$doctors = array_map('str_getcsv', file(get_template_directory() . '/doctors.csv'));
			array_splice($doctors, 0, 1);
			foreach ($doctors as $data) {
				$doctor = array(
					'practice_name' => $data[0],
					'last_name' => $data[1],
					'first_name' => $data[2],
					'address' => $data[3],
					'city' => $data[4],
					'state' => $data[5],
					'zip_code' => $data[6],
					'phone_number' => $data[7],
					'website' => $data[8]
				);
				$post_title = (!empty($doctor['practice_name'])) ? $doctor['practice_name'] : $doctor['first_name'].' '.$doctor['last_name'];
				$post_name = preg_replace('/[^\w]/', '-', $post_title);
				$post_name = preg_replace('/--+/', '-', strtolower($post_name));
				$post = array(
					'post_content' => '',
					'post_name' => $post_name,
					'post_title' => $post_title,
					'post_status' => 'publish',
					'post_type' => 'affiliated_doctor',
					'ping_status' => 'closed',
					'post_excerpt' => '',
					'post_date' => date('Y-m-d H:i:s'),
					'post_date_gmt' => date('Y-m-d H:i:s'),
					'comment_status' => 'closed'
				);
				$post_id = wp_insert_post($post, true);
				if (is_numeric($post_id)) {
					global $post; $post = get_post($post_id);
					update_field('field_54dd0595a3891', $doctor['practice_name'], $post_id);
					update_field('field_54dcdf1deb9b6', $doctor['first_name'], $post_id);
					update_field('field_54dcdf38eb9b7', $doctor['last_name'], $post_id);
					update_field('field_54dcdf44eb9b8', $doctor['address'], $post_id);
					update_field('field_54dcdf50eb9b9', $doctor['city'], $post_id);
					update_field('field_54dcdf5deb9ba', $doctor['state'], $post_id);
					update_field('field_54dcdf68eb9bb', $doctor['zip_code'], $post_id);
					update_field('field_54dcdf73eb9bc', $doctor['phone_number'], $post_id);
					update_field('field_54dd05bca3892', $doctor['website'], $post_id);
					update_doctor(); // Sets the doctor's latitude and longitude
					sleep(2);
				} else {
					trigger_error($post_id);
					exit;
				}
			}
		}

	}

	new DoctorsImport();

?>