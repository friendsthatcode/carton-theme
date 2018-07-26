<?php
/**
 * Setup all functions.
 * Uncomment the required functionality and see specific function file
 * for addition configuration.
 *
 * @since FTC 1.0
 * @return void
 */

add_action('after_switch_theme', 'setup_carton_theme');
function setup_carton_theme () {
	$plugins = array(
		'timber-library/timber.php',
		'advanced-custom-fields-pro/acf.php',
		'discourage-search-engines-by-url/discourage-search-engines-by-url.php'
	);
	foreach ($plugins as $key => $plugin) {
		$current = get_option( 'active_plugins' );
		$plugin = plugin_basename(trim($plugin));
		if ( !in_array( $plugin, $current ) ) {
			$current[] = $plugin;
			sort( $current );
			do_action( 'activate_plugin', trim( $plugin ) );
			update_option( 'active_plugins', $current );
			do_action( 'activate_' . trim( $plugin ) );
			do_action( 'activated_plugin', trim( $plugin) );
		}
	}
	update_option('dseburl_url', WP_HOME);
	update_option('dseburl_hide_icon', '');
	update_option('show_on_front', 'page');
	update_option('page_on_front', 2);
	update_option('blogdescription', 'Another WP site build with Juicebox!');
	update_option('permalink_structure', '/%postname%/');
	update_option('blog_public', 1); // this might seem odd, but it is needed for the dsbburl options to work.

	// Rename the sample page to Home, and clearout the content we don't need. We like Timber & ACF, not default WP WYSIWYG.
	$samplePage = array(
		'ID' => 2,
		'post_title' => 'Home',
		'post_name' => 'home',
		'post_content' => '',
	);
	wp_update_post($samplePage);

	return null;
}

//Add support for post thmbnaiils
add_theme_support('post-thumbnails');
add_theme_support('menus');

//Use this to add data that will be added and provided by all the context when calling Timber::get_context();
add_filter('timber_context','add_to_context');

function add_to_context($data) {
	// $data['menu'] = new TimberMenu('menu');
	$data['env'] = WP_ENV;
	$data['options'] = get_fields('option');

	$data['admin_bar'] = is_admin_bar_showing();

	$data['main_menu'] = new TimberMenu('main-menu');

	return $data;
}

if (function_exists('acf_add_options_page')) {
	if (is_user_logged_in()) {
		$current_user = wp_get_current_user();
		if(isset($current_user->roles) && in_array('administrator', $current_user->roles)){
			acf_add_options_page();
		}
	}
}

add_action('after_setup_theme', 'theme_setup');
function theme_setup() {

	// Setup Custom Post types.
	add_action('init', 'custom_post_type');

	// Setup Custom Taxonomies.
	add_action('init', 'custom_taxonomy');

	// Setup enqueue scripts
	add_action('wp_enqueue_scripts', 'add_scripts');

    register_nav_menu('main', 'Main Nav');
}

// Disable support for comments and trackbacks in post types
function df_disable_comments_post_types_support() {
	$post_types = get_post_types();
	foreach ($post_types as $post_type) {
		if(post_type_supports($post_type, 'comments')) {
			remove_post_type_support($post_type, 'comments');
			remove_post_type_support($post_type, 'trackbacks');
		}
	}
}
add_action('admin_init', 'df_disable_comments_post_types_support');

// Close comments on the front-end
function df_disable_comments_status() {
	return false;
}
add_filter('comments_open', 'df_disable_comments_status', 20, 2);
add_filter('pings_open', 'df_disable_comments_status', 20, 2);

// Hide existing comments
function df_disable_comments_hide_existing_comments($comments) {
	$comments = array();
	return $comments;
}
add_filter('comments_array', 'df_disable_comments_hide_existing_comments', 10, 2);

// Remove comments page in menu
function df_disable_comments_admin_menu() {
	remove_menu_page('edit-comments.php');
}
add_action('admin_menu', 'df_disable_comments_admin_menu');

// Redirect any user trying to access comments page
function df_disable_comments_admin_menu_redirect() {
	global $pagenow;
	if ($pagenow === 'edit-comments.php') {
		wp_redirect(admin_url()); exit;
	}
}
add_action('admin_init', 'df_disable_comments_admin_menu_redirect');

// Remove comments metabox from dashboard
function df_disable_comments_dashboard() {
	remove_meta_box('dashboard_recent_comments', 'dashboard', 'normal');
}
add_action('admin_init', 'df_disable_comments_dashboard');

// Remove comments links from admin bar
function df_disable_comments_admin_bar() {
	if (is_admin_bar_showing()) {
		remove_action('admin_bar_menu', 'wp_admin_bar_comments_menu', 60);
	}
}
add_action('init', 'df_disable_comments_admin_bar');

// Allow editors edit menus
$role_object = get_role( 'editor' );
$role_object->add_cap( 'edit_theme_options' );
