<?php
/**
 * Plugin Name: Real Estate Plugin
 * Description: Plugin core file
 * Version: 1.0
 * Author: Roman Zhurakivskyi
 */


include_once plugin_dir_path(__FILE__) . 'includes/cpt-tax-register.php';

include_once plugin_dir_path(__FILE__) . 'includes/register-acf-fields.php';

include_once plugin_dir_path(__FILE__) . 'includes/mock-posts.php';
register_activation_hook(__FILE__, 'create_mock_real_estate_posts_on_activation');

include_once plugin_dir_path(__FILE__) . 'includes/shortcodes.php';

include_once plugin_dir_path(__FILE__) . 'includes/ajax-handler.php';

include_once plugin_dir_path(__FILE__) . 'includes/widgets.php';

include_once plugin_dir_path(__FILE__) . 'includes/new-admin.php';
register_activation_hook(__FILE__, 'create_admin_user_on_activation');
