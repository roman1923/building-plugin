<?php
// Enqueue parent theme styles
function understrap_child_enqueue_styles()
{
	// Enqueue the parent theme style
	wp_enqueue_style('parent-style', get_template_directory_uri() . '/style.css');
	wp_enqueue_style('child-style', get_stylesheet_directory_uri() . 'src/assets/style.css');
}
add_action('wp_enqueue_scripts', 'understrap_child_enqueue_styles');

function my_child_theme_setup() {
    // Register Primary Menu
    register_nav_menus(array(
        'primary' => __('Primary Menu', 'understrap_child'),
    ));
}
add_action('after_setup_theme', 'my_child_theme_setup');

