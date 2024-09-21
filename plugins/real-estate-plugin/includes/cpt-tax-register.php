<?php 

// Hook into the 'init' action to register post type and taxonomy
add_action('init', 'register_real_estate_post_type_and_taxonomy');

function register_real_estate_post_type_and_taxonomy()
{
	// Register Custom Post Type: Об'єкт нерухомості
	$labels = array(
		'name' => 'Об\'єкти нерухомості',
		'singular_name' => 'Об\'єкт нерухомості',
		'menu_name' => 'Нерухомість',
		'name_admin_bar' => 'Об\'єкт нерухомості',
		'add_new' => 'Додати новий',
		'add_new_item' => 'Додати новий Об\'єкт нерухомості',
		'edit_item' => 'Редагувати Об\'єкт нерухомості',
		'new_item' => 'Новий Об\'єкт нерухомості',
		'view_item' => 'Переглянути Об\'єкт нерухомості',
		'search_items' => 'Шукати Об\'єкт нерухомості',
	);

	$args = array(
		'labels' => $labels,
		'public' => true,
		'has_archive' => true,
		'rewrite' => array('slug' => 'real-estate'),
		'supports' => array('title', 'editor', 'thumbnail', 'excerpt'),
		'menu_icon' => 'dashicons-building',
		'show_in_rest' => true,
	);

	register_post_type('real_estate_object', $args);

	// Register Taxonomy: Район
	$labels = array(
		'name' => 'Райони',
		'singular_name' => 'Район',
		'search_items' => 'Шукати Райони',
		'all_items' => 'Всі Райони',
		'edit_item' => 'Редагувати Район',
		'update_item' => 'Оновити Район',
		'add_new_item' => 'Додати новий Район',
		'new_item_name' => 'Нова назва Району',
	);

	$args = array(
		'labels' => $labels,
		'hierarchical' => true,
		'public' => true,
		'rewrite' => array('slug' => 'district'),
		'show_in_rest' => true,
	);

	register_taxonomy('district', array('real_estate_object'), $args);
}
