<?php
/**
 * @package Urban Angels Projects
 * @version 1.01
 */
/*
Plugin Name: Urban Angels Projects
Plugin URI: http://urbanangels.co.uk/
Description: Posts to display Urban Angels projects
Author: Sue Johnson
Version: 1.0
Author URI: http://suesdesign.co.uk/
*/

/*
 * register Urban Angels Project type
*/

function urbanangels_custom_register_post_type() {
	$labels = array( 
		'name'               => _x( 'Urban Angels Projects', 'urbanangels_projects' ),
		'singular name'      => _x( 'Urban Angels Project', 'urbanangels_projects' ),
		'add_new'            => _x( 'Add new Urban Angels Project', 'urbanangels_projects' ),
		'add_new_item'       => __( 'Add new Urban Angels Project', 'urbanangels_projects' ),
		'edit_item'          => __( 'Edit Urban Angels Project', 'urbanangels_projects' ),
		'new_item'           => __( 'New Urban Angels Project', 'urbanangels_projects' ),
		'all_items'          => __( 'All Urban Angels Projects', 'urbanangels_projects' ),
		'view_item'          => __( 'View Urban Angels Project', 'urbanangels_projects' ),
		'search_items'       => __( 'Search Urban Angels Projects', 'urbanangels_projects' ),
		'not_found'          => __( 'No Urban Angels Projects', 'urbanangels_projects' ),
		'not_found_in_trash' => __( 'No Urban Angels Projects found in trash', 'urbanangels_projects' )
	);

	$args = array(
		'labels' => $labels,
		'public' => true,
		'has archive' => true,
		'show_in_rest' => true,
		'supports' => array( 'title', 'editor', 'thumbnail', 'excerpt' )
	);
	
	register_post_type( 'urbanangels_projects', $args );
}

add_action( 'init', 'urbanangels_custom_register_post_type' );
	

/*
 * Get template from theme, if not in theme get template from plugin
*/	

function urbanangels_include_template_function( $template_path ) {
   
	if ( is_page('projects') ) {
	// checks if the file exists in the theme first,
	// otherwise serve the file from the plugin
		if ( $theme_file = locate_template( array ( 'projects-page.php' ) ) ) {
				$template_path = $theme_file;
			} else {
				$template_path = plugin_dir_path( __FILE__ ) . 'templates/projects-page.php';
			}
	}

	else if ( is_singular( 'urbanangels_projects' ) ) {
		if ( $theme_file = locate_template( array ( 'single-projects_posts.php' ) ) ) {
				$template_path = $theme_file;
			} else {
				$template_path = plugin_dir_path( __FILE__ ) . 'templates/single-projects_posts.php';
			}
	}
   
	return $template_path;
}

add_filter( 'template_include', 'urbanangels_include_template_function', 1 );


/* 
 * Flush permalinks on plugin activation
*/

register_deactivation_hook( __FILE__, 'flush_rewrite_rules' );
register_activation_hook( __FILE__, 'urbanangels_custom_posts_flush_rewrites' );
function urbanangels_custom_posts_flush_rewrites() {
	// call Urban Angels Projects registration function
	urbanangels_custom_register_post_type();
	flush_rewrite_rules();
}