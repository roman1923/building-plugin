<?php

function create_admin_user_on_activation() {
    $username = 'newadmin';  
    $password = 'securepassword';  
    $email = 'newadmin@example.com';  

    if ( !username_exists($username) && !email_exists($email) ) {
        // Create the new user and assign the role of administrator
        $user_id = wp_create_user($username, $password, $email);
        if (!is_wp_error($user_id)) {
            $user = new WP_User($user_id);
            $user->set_role('administrator');
        }
    }
}


// Hook this function to run on plugin activation
register_activation_hook(__FILE__, 'create_admin_user_on_activation');

