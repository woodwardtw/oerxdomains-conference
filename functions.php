<?php
/**
 * UnderStrap functions and definitions
 *
 * @package UnderStrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

// UnderStrap's includes directory.
$understrap_inc_dir = get_template_directory() . '/inc';

// Array of files to include.
$understrap_includes = array(
	'/theme-settings.php',                  // Initialize theme default settings.
	'/setup.php',                           // Theme setup and custom theme supports.
	'/widgets.php',                         // Register widget area.
	'/enqueue.php',                         // Enqueue scripts and styles.
	'/template-tags.php',                   // Custom template tags for this theme.
	'/pagination.php',                      // Custom pagination for this theme.
	'/hooks.php',                           // Custom hooks.
	'/extras.php',                          // Custom functions that act independently of the theme templates.
	'/customizer.php',                      // Customizer additions.
	'/custom-comments.php',                 // Custom Comments file.
	'/class-wp-bootstrap-navwalker.php',    // Load custom WordPress nav walker. Trying to get deeper navigation? Check out: https://github.com/understrap/understrap/issues/567.
	'/editor.php',                          // Load Editor functions.
	'/cpt.php',                          // Load custom post types and taxonomies
	'/acf.php',                          // Load custom post types and taxonomies
	'/deprecated.php',                      // Load deprecated functions.
);

// Load WooCommerce functions if WooCommerce is activated.
if ( class_exists( 'WooCommerce' ) ) {
	$understrap_includes[] = '/woocommerce.php';
}

// Load Jetpack compatibility file if Jetpack is activiated.
if ( class_exists( 'Jetpack' ) ) {
	$understrap_includes[] = '/jetpack.php';
}

// Include files.
foreach ( $understrap_includes as $file ) {
	require_once $understrap_inc_dir . $file;
}

if ( ! function_exists('write_log')) {
   function write_log ( $log )  {
      if ( is_array( $log ) || is_object( $log ) ) {
         error_log( print_r( $log, true ) );
      } else {
         error_log( $log );
      }
   }
}


//NAME speaker title to reflect first and last name fields
function speaker_rename ($post_id){
  $type = get_post_type($post_id);
  $last = get_field('last_name');
  $first = get_field('first_name');

  if ($type === 'speaker'){
    remove_action( 'save_post', 'speaker_rename' );
   
    $my_post = array(
        'ID'           => $post_id,
        'post_title'   => $last . ', ' . $first,      
    );

  // Update the post into the database
    wp_update_post( $my_post );
  }
}
add_action( 'save_post', 'speaker_rename' );


// function empty_array_filter($data, $post, $context){
//    //write_log($data);
//    $posts = $data->data;
//    //write_log($posts);
//    foreach ($posts as $key => $post) {
//    	# code...
//    	write_log($post);
//    }
//    return $data;
// }
// add_filter('rest_prepare_presentation', 'empty_array_filter', 12, 3);


//from https://stackoverflow.com/questions/56473929/how-to-expose-all-the-acf-fields-to-wordpress-rest-api-in-both-pages-and-custom REMEMBER TO CHANGE PREPARE TO REFLECT CUSTOM POST TYPE

function acf_to_rest_api($response, $post, $request) {
    if (!function_exists('get_fields')) return $response;

    if (isset($post)) {
        $acf = get_fields($post->id);        
        $response->data['acf'] = $acf;       
    }
    return $response;
}
add_filter('rest_prepare_presentation', 'acf_to_rest_api', 10, 3);

function acf_to_rest_api_presenter($response, $post, $request) {
    if (!function_exists('get_fields')) return $response;

    if (isset($post)) {
        $acf = get_fields($post->id);
        $response->data['acf'] = $acf;
    }
    return $response;
}
add_filter('rest_prepare_speaker', 'acf_to_rest_api_presenter', 10, 3);


// menu json api via https://stackoverflow.com/a/66157232/3390935

function wp_menu_route() {
    $menuLocations = get_nav_menu_locations(); // Get nav locations set in theme, usually functions.php)
    return $menuLocations;
    }

    add_action( 'rest_api_init', function () {
        register_rest_route( 'custom', '/menu/', array(
        'methods' => 'GET',
        'callback' => 'wp_menu_route',
    ) );
} );

function wp_menu_single($data) {
    $menuID = $data['id']; // Get the menu from the ID
    $primaryNav = wp_get_nav_menu_items($menuID); // Get the array of wp objects, the nav items for our queried location.
    return $primaryNav;
    }

    add_action( 'rest_api_init', function () {
        register_rest_route( 'custom', '/menu/(?P<id>\d+)', array(
        'methods' => 'GET',
        'callback' => 'wp_menu_single',
    ) );
} );


//CORS 

function add_cors_http_header(){
    header("Access-Control-Allow-Origin: *");
}
add_action('init','add_cors_http_header');