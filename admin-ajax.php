<?php
/**
 * WordPress AJAX Process Execution.
 *
 * @package WordPress
 * @subpackage Administration
 *
 * @link https://codex.wordpress.org/AJAX_in_Plugins
 */

/**
 * Executing AJAX process.
 *
 * @since 2.1.0
 */
define( 'DOING_AJAX', true );
if ( ! defined( 'WP_ADMIN' ) ) {
	define( 'WP_ADMIN', true );
}

/** Load WordPress Bootstrap */
require_once( dirname( dirname( __FILE__ ) ) . '/wp-load.php' );

/** Allow for cross-domain requests (from the frontend). */
send_origin_headers();

// Require an action parameter
if ( empty( $_REQUEST['action'] ) )
	die( '0' );

/** Load WordPress Administration APIs */
require_once( ABSPATH . 'wp-admin/includes/admin.php' );

/** Load Ajax Handlers for WordPress Core */
require_once( ABSPATH . 'wp-admin/includes/ajax-actions.php' );

@header( 'Content-Type: text/html; charset=' . get_option( 'blog_charset' ) );
@header( 'X-Robots-Tag: noindex' );

send_nosniff_header();
nocache_headers();

/** This action is documented in wp-admin/admin.php */
do_action( 'admin_init' );

$core_actions_get = array(
	'fetch-list', 'ajax-tag-search', 'wp-compression-test', 'imgedit-preview', 'oembed-cache',
	'autocomplete-user', 'dashboard-widgets', 'logged-in',
);

$core_actions_post = array(
	'oembed-cache', 'image-editor', 'delete-comment', 'delete-tag', 'delete-link',
	'delete-meta', 'delete-post', 'trash-post', 'untrash-post', 'delete-page', 'dim-comment',
	'add-link-category', 'add-tag', 'get-tagcloud', 'get-comments', 'replyto-comment',
	'edit-comment', 'add-menu-item', 'add-meta', 'add-user', 'closed-postboxes',
	'hidden-columns', 'update-welcome-panel', 'menu-get-metabox', 'wp-link-ajax',
	'menu-locations-save', 'menu-quick-search', 'meta-box-order', 'get-permalink',
	'sample-permalink', 'inline-save', 'inline-save-tax', 'find_posts', 'widgets-order',
	'save-widget', 'set-post-thumbnail', 'date_format', 'time_format', 'wp-fullscreen-save-post',
	'wp-remove-post-lock', 'dismiss-wp-pointer', 'upload-attachment', 'get-attachment',
	'query-attachments', 'save-attachment', 'save-attachment-compat', 'send-link-to-editor',
	'send-attachment-to-editor', 'save-attachment-order', 'heartbeat', 'get-revision-diffs',
	'save-user-color-scheme', 'update-widget', 'query-themes', 'parse-embed', 'set-attachment-thumbnail',
	'parse-media-shortcode', 'destroy-sessions', 'install-plugin', 'update-plugin', 'press-this-save-post',
	'press-this-add-category',
);

// Register core Ajax calls.
if ( ! empty( $_GET['action'] ) && in_array( $_GET['action'], $core_actions_get ) )
	add_action( 'wp_ajax_' . $_GET['action'], 'wp_ajax_' . str_replace( '-', '_', $_GET['action'] ), 1 );

if ( ! empty( $_POST['action'] ) && in_array( $_POST['action'], $core_actions_post ) )
	add_action( 'wp_ajax_' . $_POST['action'], 'wp_ajax_' . str_replace( '-', '_', $_POST['action'] ), 1 );

add_action( 'wp_ajax_nopriv_heartbeat', 'wp_ajax_nopriv_heartbeat', 1 );

add_action('wp_ajax_trending_pagination', 'trending_pagination' );
add_action('wp_ajax_nopriv_trending_pagination', 'trending_pagination' );

if ( is_user_logged_in() ) {
	/**
	 * Fires authenticated AJAX actions for logged-in users.
	 *
	 * The dynamic portion of the hook name, `$_REQUEST['action']`,
	 * refers to the name of the AJAX action callback being fired.
	 *
	 * @since 2.1.0
	 */
	do_action( 'wp_ajax_' . $_REQUEST['action'] );
} else {
	/**
	 * Fires non-authenticated AJAX actions for logged-out users.
	 *
	 * The dynamic portion of the hook name, `$_REQUEST['action']`,
	 * refers to the name of the AJAX action callback being fired.
	 *
	 * @since 2.8.0
	 */
	do_action( 'wp_ajax_nopriv_' . $_REQUEST['action'] );
}



function trending_pagination() {
	global $wpdb;
require( Get_theme_root()."/rampo/functions.php" );
require( Get_theme_root()."/rampo/Mobile_Detect.php" );
	$counts 	= 1;
	$shareCount	= array();
	$r_post_ids = array();
	$posts		= array();
	$offSet		= $_POST[ 'page' ];
	$post_id	= $_POST[ 'post_id' ];
	// Get Primary Category
	$primary_cat= get_field( "_primary_category", $post_id );
	$primary_cat= get_field( $primary_cat, $post_id );
	$q_arg 		= array(
                                'cat' => $primary_cat, 
                                'post__not_in' 	=> array( $post_id ),
                                'posts_per_page'=> 4,
                                'orderby'		=> 'date',
                                'order'			=> 'DESC',
                                'offset'		=> $offSet );
        $categories = get_categories($args);
        $categories = orderCategories($categories, $args);
        global $categoryColors;
         foreach ($categories as $category) {
            $customFields = $category['colors'];
            $customFieldsImage = $category['imageUrls'];
            $categoryColors[$category['object']->cat_ID] = $customFields;
            $categoryImageUrls[$category['object']->cat_ID] = $customFieldsImage;
         }
         
	query_posts($q_arg);
	while( have_posts()):
		the_post();
		$post = get_post();
		$posts[] = $post;
	endwhile;
	// RenderPosts
   	if ( count($posts) )
   	{
		//Start the loop.
		foreach($posts as $singlePost)
		{
  
			$shareCount = getShareCount( $singlePost->ID ); // Get FB share count
			if( $counts > 4 ) {
				break;
			}
			$counts++;
			
			require( Get_theme_root()."/rampo/content.php" );
			$content_file && require( Get_theme_root()."/rampo/" . $content_file );
			$singlePost = null;
   		}
   	} else {
		get_template_part( 'content', 'none' );
   	}
	die();
}

// Default status
die( '0' );
