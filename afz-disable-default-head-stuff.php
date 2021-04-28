<?php

/**
* Plugin Name: Disable default head stuff
* Description: Disable some meta stuff that's not necessary.
* Version: 1.0.0
* Author: Álvaro Franz
* GitHub Plugin URI: https://github.com/alvarofranz/afz-disable-default-head-stuff
**/

remove_action('wp_head', 'rsd_link'); // remove really simple discovery link
remove_action('wp_head', 'wp_generator'); // remove wordpress version

remove_action('wp_head', 'feed_links', 2); // remove rss feed links
remove_action('wp_head', 'feed_links_extra', 3); // remove all extra rss feed links

remove_action('wp_head', 'index_rel_link'); // remove link to index page
remove_action('wp_head', 'wlwmanifest_link'); // remove wlwmanifest.xml

remove_action('wp_head', 'start_post_rel_link', 10, 0); // remove random post link
remove_action('wp_head', 'parent_post_rel_link', 10, 0); // remove parent post link
remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0); // remove the next and previous post links
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );
      
remove_action('wp_head', 'print_emoji_detection_script', 7); // remove emojis
remove_action('wp_print_styles', 'print_emoji_styles'); // remove emojis
      
remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0); // Remove shortlink

// Remove JSON API links in header html
function remove_json_and_rest_api(){

    // Remove the REST API lines from the HTML Header
    remove_action( 'wp_head', 'rest_output_link_wp_head', 10 );
    remove_action( 'wp_head', 'wp_oembed_add_discovery_links', 10 );

    // Turn off oEmbed auto discovery.
    add_filter( 'embed_oembed_discover', '__return_false' );

    // Don't filter oEmbed results.
    remove_filter( 'oembed_dataparse', 'wp_filter_oembed_result', 10 );

    // Remove oEmbed discovery links.
    remove_action( 'wp_head', 'wp_oembed_add_discovery_links' );

    // Remove oEmbed-specific JavaScript from the front-end and back-end.
    remove_action( 'wp_head', 'wp_oembed_add_host_js' );

    // Filters for WP-API version 1.x
    add_filter('json_enabled', '__return_false');
    add_filter('json_jsonp_enabled', '__return_false');

}
add_action('after_setup_theme', 'remove_json_and_rest_api');

// Remove login header in top causing 32px margin
function remove_admin_login_header() {
    remove_action('wp_head', '_admin_bar_bump_cb');
}
add_action('get_header', 'remove_admin_login_header');



// Remove gutenberg blocks CSS
function remove_wp_block_library_css(){
    wp_dequeue_style('wp-block-library');
    wp_dequeue_style('wp-block-library-theme');
    wp_dequeue_style('wc-block-style');
}
add_action( 'wp_enqueue_scripts', 'remove_wp_block_library_css', 100 );