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
