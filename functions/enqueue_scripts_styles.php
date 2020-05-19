<?php

function add_scripts() {
    $day = date('z');
    //de-register jquery version and then add one from google cdn
    wp_deregister_script('jquery');
    //wp_register_script('jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/3.0.0/jquery.min.js', false, '3.0.0'); // v3.x
    wp_register_script('jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js', false, '2.2.4'); // v2.x
    wp_enqueue_script('jquery');
    wp_enqueue_script('blazy', get_stylesheet_directory_uri() . '/assets/js/blazy.min.js', array(), null, true);
    wp_enqueue_script('slick', get_stylesheet_directory_uri() . '/assets/js/slick.min.js', array('jquery'), null, true);

    wp_dequeue_style( 'wp-block-library' );

    if (WP_ENV === 'production') {
        wp_enqueue_script('main', get_stylesheet_directory_uri() . "/assets/js/bundle.min.js?v={$day}", array('jquery', 'slick'), null, true);
        wp_enqueue_style('style', get_stylesheet_directory_uri() . "/assets/css/style.min.css?v={$day}");
    } else {
        wp_enqueue_script('main', get_stylesheet_directory_uri() . "/assets/js/bundle.js?v={$day}", array('jquery', 'slick'), null, true);
        wp_enqueue_style('style', get_stylesheet_directory_uri() . "/assets/css/style.css?v={$day}");
    }
}

add_action( 'init', function() {

    // Remove the REST API endpoint.
    remove_action('rest_api_init', 'wp_oembed_register_route');

    // Turn off oEmbed auto discovery.
    // Don't filter oEmbed results.
    remove_filter('oembed_dataparse', 'wp_filter_oembed_result', 10);

    // Remove oEmbed discovery links.
    remove_action('wp_head', 'wp_oembed_add_discovery_links');

    // Remove oEmbed-specific JavaScript from the front-end and back-end.
    remove_action('wp_head', 'wp_oembed_add_host_js');
}, PHP_INT_MAX - 1 );


add_action('get_header', 'remove_admin_login_header');
function remove_admin_login_header() {
    remove_action('wp_head', '_admin_bar_bump_cb');
}