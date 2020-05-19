<?php
/*
* Add SVG/EPS to upload types
*/
function cc_mime_types($mimes) {
  $mimes['svg'] = 'image/svg+xml';
  $mimes['eps'] = 'image/svg+xml';
  return $mimes;
}
add_filter('upload_mimes', 'cc_mime_types');


// show admin bar only for admins
if (!current_user_can('manage_options')) {
    add_filter('show_admin_bar', '__return_false');
}

// show admin bar only for admins and editors
if (!current_user_can('edit_posts')) {
    add_filter('show_admin_bar', '__return_false');
}

// disable block editor on posts and custom post types
add_filter('use_block_editor_for_post', '__return_false', 10);
add_filter('use_block_editor_for_post_type', '__return_false', 10);

add_filter( 'gform_form_tag', 'form_tag', 10, 2 );
function form_tag( $form_tag, $form ) {
	// Turn off autocompletion as described here https://developer.mozilla.org/en-US/docs/Web/Security/Securing_your_site/Turning_off_form_autocompletion
	$form_tag = preg_replace( "|action='|", "autocomplete='off' action='", $form_tag );
	return $form_tag;
}

/* Exclude Multiple Content Types From Yoast SEO Sitemap */
add_filter( 'wpseo_sitemap_exclude_post_type', 'sitemap_exclude_post_type', 10, 2 );
function sitemap_exclude_post_type( $value, $post_type ) {
	$post_type_to_exclude = array('author', 'attachment');
	if( in_array( $post_type, $post_type_to_exclude ) ) return true;
}