<?php

// If prefer widget instead shortcode
class Real_Estate_Filter_Widget extends WP_Widget {

public function __construct() {
	parent::__construct(
		'real_estate_filter_widget', 
		__('Real Estate Filter Widget', 'real-estate'), 
		array('description' => __('A widget to display real estate filter', 'real-estate'))
	);
}

public function widget($args, $instance) {
	echo $args['before_widget'];
	echo do_shortcode('[real_estate_filter]'); // Use the shortcode within the widget
	echo $args['after_widget'];
}

public function form($instance) {
	// Optional: Add fields for widget options in admin if needed
}

public function update($new_instance, $old_instance) {
	return $new_instance;
}
}

// Register widget
function register_real_estate_filter_widget() {
register_widget('Real_Estate_Filter_Widget');
}
add_action('widgets_init', 'register_real_estate_filter_widget');
