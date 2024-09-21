<?php
// Function works only once on first plugin activation, if we don't need mock posts we can just delete them
function create_mock_real_estate_posts_on_activation()
{
	if (get_option('real_estate_mock_posts_created')) {
		return; // Exit if mock posts were already created
	}

	// Function to upload the image once and return the attachment ID
	function get_image_attachment_id($image_name)
	{
		// Define the image path in the plugin folder
		$image_path = plugin_dir_path(__FILE__) . '../src/assets/' . $image_name;

		// Check if the image already exists in the media library
		$attachment = get_page_by_title(sanitize_file_name($image_name), OBJECT, 'attachment');
		if ($attachment) {
			return $attachment->ID;
		}

		// Upload the image if it doesn't already exist
		if (file_exists($image_path)) {
			$upload_file = wp_upload_bits($image_name, null, file_get_contents($image_path));
			if (!$upload_file['error']) {
				$wp_filetype = wp_check_filetype($upload_file['file'], null);
				$attachment = array(
					'post_mime_type' => $wp_filetype['type'],
					'post_title' => sanitize_file_name($image_name),
					'post_content' => '',
					'post_status' => 'inherit'
				);
				$attachment_id = wp_insert_attachment($attachment, $upload_file['file']);
				require_once(ABSPATH . 'wp-admin/includes/image.php');
				$attachment_data = wp_generate_attachment_metadata($attachment_id, $upload_file['file']);
				wp_update_attachment_metadata($attachment_id, $attachment_data);
				return $attachment_id;
			}
		}

		return false;
	}

	// Upload the image once and get its attachment ID
	$image_id = get_image_attachment_id('mock-img.jpg');

	if (!$image_id) {
		return; // Exit if image failed to upload or retrieve
	}

	// Define 7 sets of mock data
	$mock_data = array(
		array(
			'title' => 'Об\'єкт нерухомості 1',
			'excerpt' => 'Це короткий опис для об\'єкта нерухомості 1.',
			'building_name' => 'Будинок Сонячний 1',
			'coordinates' => '50.4501,30.5234',
			'number_of_floors' => 10,
			'building_type' => 'brick',
			'environmental_rating' => 4,
			'building_image' => $image_id,
			'premises' => array(
				array('premise_area' => '60m²', 'number_of_rooms' => 3, 'balcony' => 'yes', 'bathroom' => 'yes', 'premise_image' => $image_id),
				array('premise_area' => '45m²', 'number_of_rooms' => 2, 'balcony' => 'no', 'bathroom' => 'yes', 'premise_image' => $image_id)
			)
		),
		array(
			'title' => 'Об\'єкт нерухомості 2',
			'excerpt' => 'Це короткий опис для об\'єкта нерухомості 2.',
			'building_name' => 'Будинок Затишний 2',
			'coordinates' => '50.4502,30.5235',
			'number_of_floors' => 15,
			'building_type' => 'panel',
			'environmental_rating' => 3,
			'building_image' => $image_id,
			'premises' => array(
				array('premise_area' => '70m²', 'number_of_rooms' => 4, 'balcony' => 'yes', 'bathroom' => 'no', 'premise_image' => $image_id),
				array('premise_area' => '55m²', 'number_of_rooms' => 2, 'balcony' => 'yes', 'bathroom' => 'yes', 'premise_image' => $image_id)
			)
		),
		array(
			'title' => 'Об\'єкт нерухомості 3',
			'excerpt' => 'Це короткий опис для об\'єкта нерухомості 3.',
			'building_name' => 'Будинок Зелений 3',
			'coordinates' => '50.4503,30.5236',
			'number_of_floors' => 20,
			'building_type' => 'foam_block',
			'environmental_rating' => 5,
			'building_image' => $image_id,
			'premises' => array(
				array('premise_area' => '80m²', 'number_of_rooms' => 5, 'balcony' => 'yes', 'bathroom' => 'yes', 'premise_image' => $image_id),
				array('premise_area' => '40m²', 'number_of_rooms' => 1, 'balcony' => 'no', 'bathroom' => 'yes', 'premise_image' => $image_id)
			)
		),
		array(
			'title' => 'Об\'єкт нерухомості 4',
			'excerpt' => 'Це короткий опис для об\'єкта нерухомості 4.',
			'building_name' => 'Будинок Південний 4',
			'coordinates' => '50.4504,30.5237',
			'number_of_floors' => 8,
			'building_type' => 'panel',
			'environmental_rating' => 3,
			'building_image' => $image_id,
			'premises' => array(
				array('premise_area' => '65m²', 'number_of_rooms' => 3, 'balcony' => 'yes', 'bathroom' => 'yes', 'premise_image' => $image_id),
				array('premise_area' => '55m²', 'number_of_rooms' => 2, 'balcony' => 'no', 'bathroom' => 'no', 'premise_image' => $image_id)
			)
		),
		array(
			'title' => 'Об\'єкт нерухомості 5',
			'excerpt' => 'Це короткий опис для об\'єкта нерухомості 5.',
			'building_name' => 'Будинок Зірковий 5',
			'coordinates' => '50.4505,30.5238',
			'number_of_floors' => 6,
			'building_type' => 'brick',
			'environmental_rating' => 4,
			'building_image' => $image_id,
			'premises' => array(
				array('premise_area' => '50m²', 'number_of_rooms' => 2, 'balcony' => 'yes', 'bathroom' => 'yes', 'premise_image' => $image_id),
				array('premise_area' => '30m²', 'number_of_rooms' => 1, 'balcony' => 'no', 'bathroom' => 'yes', 'premise_image' => $image_id)
			)
		),
		array(
			'title' => 'Об\'єкт нерухомості 6',
			'excerpt' => 'Це короткий опис для об\'єкта нерухомості 6.',
			'building_name' => 'Будинок Світлий 6',
			'coordinates' => '50.4506,30.5239',
			'number_of_floors' => 12,
			'building_type' => 'foam_block',
			'environmental_rating' => 5,
			'building_image' => $image_id,
			'premises' => array(
				array('premise_area' => '90m²', 'number_of_rooms' => 5, 'balcony' => 'yes', 'bathroom' => 'yes', 'premise_image' => $image_id),
				array('premise_area' => '35m²', 'number_of_rooms' => 1, 'balcony' => 'no', 'bathroom' => 'yes', 'premise_image' => $image_id)
			)
		),
		array(
			'title' => 'Об\'єкт нерухомості 7',
			'excerpt' => 'Це короткий опис для об\'єкта нерухомості 7.',
			'building_name' => 'Будинок Східний 7',
			'coordinates' => '50.4507,30.5240',
			'number_of_floors' => 18,
			'building_type' => 'brick',
			'environmental_rating' => 4,
			'building_image' => $image_id,
			'premises' => array(
				array('premise_area' => '100m²', 'number_of_rooms' => 6, 'balcony' => 'yes', 'bathroom' => 'yes', 'premise_image' => $image_id),
				array('premise_area' => '60m²', 'number_of_rooms' => 3, 'balcony' => 'no', 'bathroom' => 'yes', 'premise_image' => $image_id)
			)
		)
	);

	foreach ($mock_data as $data) {
		// Create a new post
		$post_id = wp_insert_post(array(
			'post_title' => $data['title'],
			'post_type' => 'real_estate_object',
			'post_status' => 'publish',
			'post_excerpt' => $data['excerpt'], // Add excerpt
		));

		// Add ACF fields to the post
		if ($post_id) {
			// Main post fields
			update_field('building_name', $data['building_name'], $post_id);
			update_field('location_coordinates', $data['coordinates'], $post_id);
			update_field('number_of_floors', $data['number_of_floors'], $post_id);
			update_field('building_type', $data['building_type'], $post_id);
			update_field('environmental_rating', $data['environmental_rating'], $post_id);
			update_field('building_image', $data['building_image'], $post_id); // Set the main building image

			// Add the post thumbnail (featured image)
			set_post_thumbnail($post_id, $data['building_image']); // Add featured image

			// Add repeater data for premises
			if (!empty($data['premises'])) {
				$count = 0;
				foreach ($data['premises'] as $premise) {
					// Add a row to the repeater field
					$row_key = 'premises_' . $count;

					// Manually add each sub-field value
					update_post_meta($post_id, "{$row_key}_premise_area", $premise['premise_area']);
					update_post_meta($post_id, "{$row_key}_number_of_rooms", $premise['number_of_rooms']);
					update_post_meta($post_id, "{$row_key}_balcony", $premise['balcony']);
					update_post_meta($post_id, "{$row_key}_bathroom", $premise['bathroom']);
					update_post_meta($post_id, "{$row_key}_premise_image", $premise['premise_image']);

					// Manually add the ACF field keys
					update_post_meta($post_id, "_{$row_key}_premise_area", 'field_premise_area');
					update_post_meta($post_id, "_{$row_key}_number_of_rooms", 'field_number_of_rooms');
					update_post_meta($post_id, "_{$row_key}_balcony", 'field_balcony');
					update_post_meta($post_id, "_{$row_key}_bathroom", 'field_bathroom');
					update_post_meta($post_id, "_{$row_key}_premise_image", 'field_premise_image');

					$count++;
				}
				// Finally, update the repeater count
				update_post_meta($post_id, 'premises', $count);
				update_post_meta($post_id, '_premises', 'field_premises');
			}
		}
	}

	// Set an option to prevent duplicate post creation
	update_option('real_estate_mock_posts_created', 1);
}

