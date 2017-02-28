<?php
/**
 * Plugin Name: Autologin
 * Plugin URI: https://jasonlawton.com
 * Description: Automatically log in a user depending on the referring url
 * Version: 1.0.0
 * Author: Jason Lawton
 * Author URI: https://jasonlawton.com
 * License: GPL2
 */

add_action( 'plugins_loaded' , 'jlal_autologin' );

function jlal_autologin () {
    if ( is_user_logged_in() ) {
        return;
    }

    $url = $_SERVER['HTTP_REFERER'];
    $host = parse_url($url, PHP_URL_HOST);

    if ($host == 'SomeDomain.com') {
        $user_login = 'username'; 
        $user = get_userdatabylogin($user_login);
        $user_id = $user->ID; 
        wp_set_current_user($user_id, $user_login);
        wp_set_auth_cookie($user_id); 
        do_action('wp_login', $user_login); 
    }
}