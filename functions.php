<?php
/**
 * NS Custom Theme functions and definitions
 *
 * Set up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 *
 * When using a child theme you can override certain functions (those wrapped
 * in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before
 * the parent theme's file, so the child theme functions would be used.
 *
 * @link https://codex.wordpress.org/Theme_Development
 * @link https://codex.wordpress.org/Child_Themes
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are
 * instead attached to a filter or action hook.
 *
 * For more information on hooks, actions, and filters,
 * {@link https://codex.wordpress.org/Plugin_API}
 *
 * @package WordPress
 * @subpackage NS_Custom_Theme
 * @since NS Custom Theme 1.0
 */

/**
 * NS Custom Theme only works in WordPress 4.4 or later.
 */
if ( version_compare( $GLOBALS['wp_version'], '4.4-alpha', '<' ) ) {
	require get_template_directory() . '/inc/back-compat.php';
}

if ( ! function_exists( 'ns_custom_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 *
 * Create your own ns_custom_setup() function to override in a child theme.
 *
 * @since NS Custom Theme 1.0
 */
function ns_custom_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed at WordPress.org. See: https://translate.wordpress.org/projects/wp-themes/ns_custom
	 * If you're building a theme based on NS Custom Theme, use a find and replace
	 * to change 'ns_custom' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'ns_custom' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for custom logo.
	 *
	 *  @since NS Custom Theme 1.2
	 */
	add_theme_support( 'custom-logo', array(
		'height'      => 240,
		'width'       => 240,
		'flex-height' => true,
	) );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 1200, 9999 );

	// This theme uses wp_nav_menu() in two locations.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'ns_custom' ),
		'social'  => __( 'Social Links Menu', 'ns_custom' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 *
	 * See: https://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside',
		'image',
		'video',
		'quote',
		'link',
		'gallery',
		'status',
		'audio',
		'chat',
	) );

	/*
	 * This theme styles the visual editor to resemble the theme style,
	 * specifically font, colors, icons, and column width.
	 */
	add_editor_style( array( 'css/editor-style.css' ) );

	// Indicate widget sidebars can use selective refresh in the Customizer.
	add_theme_support( 'customize-selective-refresh-widgets' );
}
endif; // ns_custom_setup
add_action( 'after_setup_theme', 'ns_custom_setup' );

/**
 * Sets the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 *
 * @since NS Custom Theme 1.0
 */
function ns_custom_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'ns_custom_content_width', 840 );
}
add_action( 'after_setup_theme', 'ns_custom_content_width', 0 );

/**
 * Registers a widget area.
 *
 * @link https://developer.wordpress.org/reference/functions/register_sidebar/
 *
 * @since NS Custom Theme 1.0
 */
function ns_custom_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'ns_custom' ),
		'id'            => 'sidebar-1',
		'description'   => __( 'Add widgets here to appear in your sidebar.', 'ns_custom' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => __( 'Content Bottom 1', 'ns_custom' ),
		'id'            => 'sidebar-2',
		'description'   => __( 'Appears at the bottom of the content on posts and pages.', 'ns_custom' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => __( 'Content Bottom 2', 'ns_custom' ),
		'id'            => 'sidebar-3',
		'description'   => __( 'Appears at the bottom of the content on posts and pages.', 'ns_custom' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'ns_custom_widgets_init' );


/**
 * Handles JavaScript detection.
 *
 * Adds a `js` class to the root `<html>` element when JavaScript is detected.
 *
 * @since NS Custom Theme 1.0
 */
function ns_custom_javascript_detection() {
	echo "<script>(function(html){html.className = html.className.replace(/\bno-js\b/,'js')})(document.documentElement);</script>\n";
}
add_action( 'wp_head', 'ns_custom_javascript_detection', 0 );

/**
 * Enqueues scripts and styles.
 *
 * @since NS Custom Theme 1.0
 */
function ns_custom_scripts() {
	// Add Fonts, used in the main stylesheet.
	wp_enqueue_style( 'fonts', get_template_directory_uri() . '/fonts/fonts.css', array(), '1.0.0' );
	
	// Add Genericons, used in the main stylesheet.
	wp_enqueue_style( 'genericons', get_template_directory_uri() . '/genericons/genericons.css', array(), '3.4.1' );
	
	// Add BlueImp Gallery stylesheet.
	wp_enqueue_style( 'bi-gallery-css', get_template_directory_uri() . '/lib/blueimp/css/blueimp-gallery.min.css' );

	// Theme stylesheet.
	wp_enqueue_style( 'ns_custom-style', get_stylesheet_uri() );

	// Load the Internet Explorer specific stylesheet.
	wp_enqueue_style( 'ns_custom-ie', get_template_directory_uri() . '/css/ie.css', array( 'ns_custom-style' ), '20160816' );
	wp_style_add_data( 'ns_custom-ie', 'conditional', 'lt IE 10' );

	// Load the Internet Explorer 8 specific stylesheet.
	wp_enqueue_style( 'ns_custom-ie8', get_template_directory_uri() . '/css/ie8.css', array( 'ns_custom-style' ), '20160816' );
	wp_style_add_data( 'ns_custom-ie8', 'conditional', 'lt IE 9' );

	// Load the Internet Explorer 7 specific stylesheet.
	wp_enqueue_style( 'ns_custom-ie7', get_template_directory_uri() . '/css/ie7.css', array( 'ns_custom-style' ), '20160816' );
	wp_style_add_data( 'ns_custom-ie7', 'conditional', 'lt IE 8' );

	// Load the html5 shiv.
	wp_enqueue_script( 'ns_custom-html5', get_template_directory_uri() . '/js/html5.js', array(), '3.7.3' );
	wp_script_add_data( 'ns_custom-html5', 'conditional', 'lt IE 9' );

	wp_enqueue_script( 'ns_custom-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20160816', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	if ( is_singular() && wp_attachment_is_image() ) {
		wp_enqueue_script( 'ns_custom-keyboard-image-navigation', get_template_directory_uri() . '/js/keyboard-image-navigation.js', array( 'jquery' ), '20160816' );
	}
	
	// Add BlueImp Gallery javascript.
	wp_enqueue_script( 'bi-gallery-js', get_template_directory_uri() . '/lib/blueimp/js/jquery.blueimp-gallery.min.js', array('jquery'), '', true);

	wp_enqueue_script( 'ns_custom-script', get_template_directory_uri() . '/js/functions.js', array( 'jquery' ), '20160816', true );

	wp_localize_script( 'ns_custom-script', 'screenReaderText', array(
		'expand'   => __( 'expand child menu', 'ns_custom' ),
		'collapse' => __( 'collapse child menu', 'ns_custom' ),
	) );
}
add_action( 'wp_enqueue_scripts', 'ns_custom_scripts' );

/**
 * Adds custom classes to the array of body classes.
 *
 * @since NS Custom Theme 1.0
 *
 * @param array $classes Classes for the body element.
 * @return array (Maybe) filtered body classes.
 */
function ns_custom_body_classes( $classes ) {
	// Adds a class of custom-background-image to sites with a custom background image.
	if ( get_background_image() ) {
		$classes[] = 'custom-background-image';
	}

	// Adds a class of group-blog to sites with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	// Adds a class of no-sidebar to sites without active sidebar.
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	}

	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	return $classes;
}
add_filter( 'body_class', 'ns_custom_body_classes' );

/**
 * Converts a HEX value to RGB.
 *
 * @since NS Custom Theme 1.0
 *
 * @param string $color The original color, in 3- or 6-digit hexadecimal form.
 * @return array Array containing RGB (red, green, and blue) values for the given
 *               HEX code, empty array otherwise.
 */
function ns_custom_hex2rgb( $color ) {
	$color = trim( $color, '#' );

	if ( strlen( $color ) === 3 ) {
		$r = hexdec( substr( $color, 0, 1 ).substr( $color, 0, 1 ) );
		$g = hexdec( substr( $color, 1, 1 ).substr( $color, 1, 1 ) );
		$b = hexdec( substr( $color, 2, 1 ).substr( $color, 2, 1 ) );
	} else if ( strlen( $color ) === 6 ) {
		$r = hexdec( substr( $color, 0, 2 ) );
		$g = hexdec( substr( $color, 2, 2 ) );
		$b = hexdec( substr( $color, 4, 2 ) );
	} else {
		return array();
	}

	return array( 'red' => $r, 'green' => $g, 'blue' => $b );
}

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Add custom image sizes attribute to enhance responsive image functionality
 * for content images
 *
 * @since NS Custom Theme 1.0
 *
 * @param string $sizes A source size value for use in a 'sizes' attribute.
 * @param array  $size  Image size. Accepts an array of width and height
 *                      values in pixels (in that order).
 * @return string A source size value for use in a content image 'sizes' attribute.
 */
function ns_custom_content_image_sizes_attr( $sizes, $size ) {
	$width = $size[0];

	840 <= $width && $sizes = '(max-width: 709px) 85vw, (max-width: 909px) 67vw, (max-width: 1362px) 62vw, 840px';

	if ( 'page' === get_post_type() ) {
		840 > $width && $sizes = '(max-width: ' . $width . 'px) 85vw, ' . $width . 'px';
	} else {
		840 > $width && 600 <= $width && $sizes = '(max-width: 709px) 85vw, (max-width: 909px) 67vw, (max-width: 984px) 61vw, (max-width: 1362px) 45vw, 600px';
		600 > $width && $sizes = '(max-width: ' . $width . 'px) 85vw, ' . $width . 'px';
	}

	return $sizes;
}
add_filter( 'wp_calculate_image_sizes', 'ns_custom_content_image_sizes_attr', 10 , 2 );

/**
 * Add custom image sizes attribute to enhance responsive image functionality
 * for post thumbnails
 *
 * @since NS Custom Theme 1.0
 *
 * @param array $attr Attributes for the image markup.
 * @param int   $attachment Image attachment ID.
 * @param array $size Registered image size or flat array of height and width dimensions.
 * @return string A source size value for use in a post thumbnail 'sizes' attribute.
 */
function ns_custom_post_thumbnail_sizes_attr( $attr, $attachment, $size ) {
	if ( 'post-thumbnail' === $size ) {
		is_active_sidebar( 'sidebar-1' ) && $attr['sizes'] = '(max-width: 709px) 85vw, (max-width: 909px) 67vw, (max-width: 984px) 60vw, (max-width: 1362px) 62vw, 840px';
		! is_active_sidebar( 'sidebar-1' ) && $attr['sizes'] = '(max-width: 709px) 85vw, (max-width: 909px) 67vw, (max-width: 1362px) 88vw, 1200px';
	}
	return $attr;
}
add_filter( 'wp_get_attachment_image_attributes', 'ns_custom_post_thumbnail_sizes_attr', 10 , 3 );

/**
 * Modifies tag cloud widget arguments to have all tags in the widget same font size.
 *
 * @since NS Custom Theme 1.1
 *
 * @param array $args Arguments for tag cloud widget.
 * @return array A new modified arguments.
 */
function ns_custom_widget_tag_cloud_args( $args ) {
	$args['largest'] = 1;
	$args['smallest'] = 1;
	$args['unit'] = 'em';
	return $args;
}
add_filter( 'widget_tag_cloud_args', 'ns_custom_widget_tag_cloud_args' );


/*//////////////////////////////////////////////////////////////////////////
GLOBAL CUSTOM FUNCTIONS:
/*//////////////////////////////////////////////////////////////////////////


// REMOVE WP EMOJI
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');
remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
remove_action( 'admin_print_styles', 'print_emoji_styles' );

// Register PORTFOLIO custom post type
if ( ! function_exists( 'portfolio_post_type' ) ) :
	function portfolio_post_type() {
		$labels = array(
			'name'                  => _x( 'Portfolio Items', 'Post Type General Name', 'text_domain' ),
			'singular_name'         => _x( 'Portfolio Entry', 'Post Type Singular Name', 'text_domain' ),
			'menu_name'             => __( 'Portfolio', 'text_domain' ),
			'name_admin_bar'        => __( 'Portfolio Entry', 'text_domain' ),
			'archives'              => __( 'Item Archives', 'text_domain' ),
			'attributes'            => __( 'Item Attributes', 'text_domain' ),
			'parent_item_colon'     => __( 'Parent Portfolio Entry:', 'text_domain' ),
			'all_items'             => __( 'All Portfolio Items', 'text_domain' ),
			'add_new_item'          => __( 'Add New Portfolio Entry', 'text_domain' ),
			'add_new'               => __( 'New Portfolio Entry', 'text_domain' ),
			'new_item'              => __( 'New Item', 'text_domain' ),
			'edit_item'             => __( 'Edit Portfolio Entry', 'text_domain' ),
			'update_item'           => __( 'Update Portfolio Entry', 'text_domain' ),
			'view_item'             => __( 'View Portfolio Entry', 'text_domain' ),
			'view_items'            => __( 'View Items', 'text_domain' ),
			'search_items'          => __( 'Search portfolio items', 'text_domain' ),
			'not_found'             => __( 'No portfolio items found', 'text_domain' ),
			'not_found_in_trash'    => __( 'No portfolio items found in Trash', 'text_domain' ),
			'featured_image'        => __( 'Featured Image', 'text_domain' ),
			'set_featured_image'    => __( 'Set featured image', 'text_domain' ),
			'remove_featured_image' => __( 'Remove featured image', 'text_domain' ),
			'use_featured_image'    => __( 'Use as featured image', 'text_domain' ),
			'insert_into_item'      => __( 'Insert into item', 'text_domain' ),
			'uploaded_to_this_item' => __( 'Uploaded to this item', 'text_domain' ),
			'items_list'            => __( 'Items list', 'text_domain' ),
			'items_list_navigation' => __( 'Items list navigation', 'text_domain' ),
			'filter_items_list'     => __( 'Filter items list', 'text_domain' ),
		);
		
		$permalinks = get_option('avia_permalink_settings');
		if(!$permalinks) $permalinks = array();    

		$permalinks['portfolio_permalink_base'] = empty($permalinks['portfolio_permalink_base']) ? __('portfolio-item', 'text_domain') : $permalinks['portfolio_permalink_base'];
		$permalinks['portfolio_entries_taxonomy_base'] = empty($permalinks['portfolio_entries_taxonomy_base']) ? __('portfolio_entries', 'text_domain') : $permalinks['portfolio_entries_taxonomy_base'];
		
		$args = array(
			'label'                 => __( 'Portfolio entry', 'text_domain' ),
			'description'           => __( 'Portfolio entry information pages.', 'text_domain' ),
			'labels'                => $labels,
			'supports'              => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'custom-fields', ),
			'taxonomies'            => array( 'portfolio_entries', 'post_tag' ),
			'hierarchical'          => false,
			'rewrite' => array('slug'=>_x($permalinks['portfolio_permalink_base'],'URL slug','text_domain'), 'with_front'=>true),
			'public'                => true,
			'show_ui'               => true,
			'query_var' => true,
			'show_in_menu'          => true,
			'menu_position'         => 25,
			'show_in_admin_bar'     => true,
			'show_in_nav_menus'     => true,
			'can_export'            => true,
			'has_archive'           => true,		
			'exclude_from_search'   => false,
			'publicly_queryable'    => true,
			'capability_type'       => 'post',
		);
			
		register_post_type( 'portfolio', $args );
		
		$tax_args = array(	
			"hierarchical" => true,
			"label" => "Portfolio Categories",
			"singular_label" => "Portfolio Category",
			"rewrite" => array('slug'=>_x($permalinks['portfolio_entries_taxonomy_base'],'URL slug','text_domain'), 'with_front'=>true),
			"query_var" => true
		);
		register_taxonomy("portfolio_entries", array("portfolio"), $tax_args);
	}
	add_action( 'init', 'portfolio_post_type', 0 );
endif;


// Breadcrumb
if ( ! function_exists( 'breadcrumb' ) ) :
function breadcrumb() {
  $separator = '<span class="sep">&rsaquo;</span>';
	echo '<div class="breadcrumb"><p><span class="breadcrumb_info">' . __( 'You are here') . ':</span> ';
	if ( !is_front_page() ) {
		echo '<a href="';
		echo get_option('home');
		echo '">';
		bloginfo('name');
		echo "</a>".$separator;
		}

	if(is_single()) {
		$category = get_the_category();
		if (is_attachment()){
			$my_query = get_post($der_post->post_parent);
			$category = get_the_category($my_query->ID);
			if(isset($category[0])) {
				$ID = $category[0]->cat_ID;
				$parents = get_category_parents($ID, TRUE, $separator, FALSE );
				if(!is_object($parents)) echo $parents  . ' parents';
				previous_post_link("%link $separator");
			}
		} else {
			$postType = get_post_type();
			if($postType == 'post') {
				$ID = $category[0]->cat_ID;
				echo get_category_parents($ID, TRUE, $separator, FALSE );
			}
			elseif($postType == 'portfolio') {
				$parentLinkID = 0; // set custom parent page or post of projects if no parent project category is present
				if ($parentLink < 1) { $parentLink = '<a href="'.get_permalink($parentLinkID).'">'.get_the_title($parentLinkID).'</a>'; } else { $parentLink = '';}
				$terms = get_the_term_list( $post->ID, 'portfolio_entries', '', '$$$', '' );
				$terms = explode('$$$',$terms);
				foreach($terms as $term) $trail .= $term.$separator;
				echo $parentLink.$trail;
			}
		}
	}
	
	if (is_page()){
		$trail = '';
		global $post;
		if($post->post_parent) {
			$parent_id = $post->post_parent;
			while ($parent_id) {
				$page = get_page($parent_id);
				$crumbs[] = '<a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a>' . $separator;
				$parent_id = $page->post_parent;
			}
			$crumbs = array_reverse($crumbs);
			foreach($crumbs as $crumb) $trail .= $crumb;
		}
		echo $trail;
	}
	
	if (is_tax()) {
		$tag = single_tag_title('', false);
		$tag = get_tag_id($tag);
		$term = get_term_parents($tag, get_query_var('taxonomy'), true, $separator);
		// remove last &gt;
		echo preg_replace('/'.$separator.'\s$|'.$separator.'$/', '', $term);
	}

	if(is_category()){
		$category = get_the_category();
		$i = $category[0]->cat_ID;
		$parent = $category[0]-> category_parent;
		if($parent > 0 && $category[0]->cat_name == single_cat_title("", false)){
			echo get_category_parents($parent, TRUE, $markup, FALSE);
		}
		echo single_cat_title('',FALSE);
	}
	
	// last title (current)
	if(is_single() || is_page()) {the_title();}
	if(is_tag()){ echo "Tag: ".single_tag_title('',FALSE); }
	if(is_404()){ echo "404 - Page not Found"; }
	if(is_search()){ echo "Search"; }
	if(is_year()){ echo get_the_time('Y'); }

	echo "</p></div>";
}
endif;

// helper function for breadcrumb
function get_term_parents($id, $taxonomy, $link = false, $separator = '/', $nicename = false, $visited = array()) {
		$chain = '';
		$parent = &get_term($id, $taxonomy);
		try {
				if (is_wp_error($parent)) {
						throw new Exception('is_wp_error($parent) has throw error ' . $parent->get_error_message());
				}
		}
		catch (exception $e) {
				echo 'Caught exception: ', $e->getMessage(), "\n";
				// use something less drastic than die() in production code
				//die();
		}
		if ($nicename) {
				$name = $parent->slug;
		} else {
				$name = htmlspecialchars($parent->name, ENT_QUOTES, 'UTF-8');
		}
		if ($parent->parent && ($parent->parent != $parent->term_id) && !in_array($parent->parent, $visited)) {
				$visited[] = $parent->parent;
				$chain .= get_term_parents($parent->parent, $taxonomy, $link, $separator, $nicename, $visited);
		}
		if ($link) {
				$chain .= '<a href="' . get_term_link($parent->slug, $taxonomy) . '">' . $name . '</a>' . $separator;
		} else {
				$chain .= $parent->name . $separator;
		}
		return $chain;
}

// helper function for breadcrumb
function get_tag_id($tag) {
		global $wpdb;
		$link_id = $wpdb->get_var($wpdb->prepare("SELECT term_id FROM $wpdb->terms WHERE name =  %s", $tag));
		return $link_id;
}

	
// Custom gallery shortcode with blueImp gallery impelemented
/**
 * Builds the Gallery shortcode output. (originally in .\wp-includes\media.php)
 *
 * This implements the functionality of the Gallery Shortcode for displaying
 * WordPress images on a post.
 *
 * @since 2.5.0
 *
 * @staticvar int $instance
 *
 * @param array $attr {
 *     Attributes of the gallery shortcode.
 *
 *     @type string       $order      Order of the images in the gallery. Default 'ASC'. Accepts 'ASC', 'DESC'.
 *     @type string       $orderby    The field to use when ordering the images. Default 'menu_order ID'.
 *                                    Accepts any valid SQL ORDERBY statement.
 *     @type int          $id         Post ID.
 *     @type string       $itemtag    HTML tag to use for each image in the gallery.
 *                                    Default 'dl', or 'figure' when the theme registers HTML5 gallery support.
 *     @type string       $icontag    HTML tag to use for each image's icon.
 *                                    Default 'dt', or 'div' when the theme registers HTML5 gallery support.
 *     @type string       $captiontag HTML tag to use for each image's caption.
 *                                    Default 'dd', or 'figcaption' when the theme registers HTML5 gallery support.
 *     @type int          $columns    Number of columns of images to display. Default 3.
 *     @type string|array $size       Size of the images to display. Accepts any valid image size, or an array of width
 *                                    and height values in pixels (in that order). Default 'thumbnail'.
 *     @type string       $ids        A comma-separated list of IDs of attachments to display. Default empty.
 *     @type string       $include    A comma-separated list of IDs of attachments to include. Default empty.
 *     @type string       $exclude    A comma-separated list of IDs of attachments to exclude. Default empty.
 *     @type string       $link       What to link each image to. Default empty (links to the attachment page).
 *                                    Accepts 'file', 'none'.
 * }
 * @return string HTML content to display gallery.
 */
function custom_gallery_shortcode( $attr ) {
	$post = get_post();

	static $instance = 0;
	$instance++;

	if ( ! empty( $attr['ids'] ) ) {
		// 'ids' is explicitly ordered, unless you specify otherwise.
		if ( empty( $attr['orderby'] ) ) {
			$attr['orderby'] = 'post__in';
		}
		$attr['include'] = $attr['ids'];
	}

	/**
	 * Filters the default gallery shortcode output.
	 *
	 * If the filtered output isn't empty, it will be used instead of generating
	 * the default gallery template.
	 *
	 * @since 2.5.0
	 * @since 4.2.0 The `$instance` parameter was added.
	 *
	 * @see gallery_shortcode()
	 *
	 * @param string $output   The gallery output. Default empty.
	 * @param array  $attr     Attributes of the gallery shortcode.
	 * @param int    $instance Unique numeric ID of this gallery shortcode instance.
	 */
	$output = apply_filters( 'post_gallery', '', $attr, $instance );
	if ( $output != '' ) {
		return $output;
	}

	$html5 = current_theme_supports( 'html5', 'gallery' );
	$atts = shortcode_atts( array(
		'order'      => 'ASC',
		'orderby'    => 'menu_order ID',
		'id'         => $post ? $post->ID : 0,
		'itemtag'    => $html5 ? 'figure'     : 'dl',
		'icontag'    => $html5 ? 'div'        : 'dt',
		'captiontag' => $html5 ? 'figcaption' : 'dd',
		'columns'    => 3,
		'size'       => 'thumbnail',
		'include'    => '',
		'exclude'    => '',
		'link'       => ''
	), $attr, 'gallery' );

	$id = intval( $atts['id'] );

	if ( ! empty( $atts['include'] ) ) {
		$_attachments = get_posts( array( 'include' => $atts['include'], 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $atts['order'], 'orderby' => $atts['orderby'] ) );

		$attachments = array();
		foreach ( $_attachments as $key => $val ) {
			$attachments[$val->ID] = $_attachments[$key];
		}
	} elseif ( ! empty( $atts['exclude'] ) ) {
		$attachments = get_children( array( 'post_parent' => $id, 'exclude' => $atts['exclude'], 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $atts['order'], 'orderby' => $atts['orderby'] ) );
	} else {
		$attachments = get_children( array( 'post_parent' => $id, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $atts['order'], 'orderby' => $atts['orderby'] ) );
	}

	if ( empty( $attachments ) ) {
		return '';
	}

	if ( is_feed() ) {
		$output = "\n";
		foreach ( $attachments as $att_id => $attachment ) {
			$output .= wp_get_attachment_link( $att_id, $atts['size'], true ) . "\n";
		}
		return $output;
	}

	$itemtag = tag_escape( $atts['itemtag'] );
	$captiontag = tag_escape( $atts['captiontag'] );
	$icontag = tag_escape( $atts['icontag'] );
	$valid_tags = wp_kses_allowed_html( 'post' );
	if ( ! isset( $valid_tags[ $itemtag ] ) ) {
		$itemtag = 'dl';
	}
	if ( ! isset( $valid_tags[ $captiontag ] ) ) {
		$captiontag = 'dd';
	}
	if ( ! isset( $valid_tags[ $icontag ] ) ) {
		$icontag = 'dt';
	}

	$columns = intval( $atts['columns'] );
	$itemwidth = $columns > 0 ? floor(100/$columns) : 100;
	$float = is_rtl() ? 'right' : 'left';

	$selector = "gallery-{$instance}";

	$gallery_style = '';

	/**
	 * Filters whether to print default gallery styles.
	 *
	 * @since 3.1.0
	 *
	 * @param bool $print Whether to print default gallery styles.
	 *                    Defaults to false if the theme supports HTML5 galleries.
	 *                    Otherwise, defaults to true.
	 */
	if ( apply_filters( 'use_default_gallery_style', ! $html5 ) ) {
		$gallery_style = "
		<style type='text/css'>
			#{$selector} {
				margin: auto;
			}
			#{$selector} .gallery-item {
				float: {$float};
				margin-top: 10px;
				text-align: center;
				width: {$itemwidth}%;
			}
			#{$selector} img {
				border: 2px solid #cfcfcf;
			}
			#{$selector} .gallery-caption {
				margin-left: 0;
			}
			/* see gallery_shortcode() in wp-includes/media.php */
		</style>\n\t\t";
	}

	$size_class = sanitize_html_class( $atts['size'] );
	$gallery_div = "
	<div id=\"blueimp-gallery\" class=\"blueimp-gallery blueimp-gallery-controls\">
		<div class=\"slides\"></div>
		<h3 class=\"title\"></h3>
		<a class=\"prev\">&lsaquo;</a>
		<a class=\"next\">&rsaquo;</a>
		<a class=\"close\">×</a>
		<ol class=\"indicator\"></ol>
	</div>
	<div id='$selector' class='gallery galleryid-{$id} gallery-columns-{$columns} gallery-size-{$size_class}'>";

	/**
	 * Filters the default gallery shortcode CSS styles.
	 *
	 * @since 2.5.0
	 *
	 * @param string $gallery_style Default CSS styles and opening HTML div container
	 *                              for the gallery shortcode output.
	 */
	$output = apply_filters( 'gallery_style', $gallery_style . $gallery_div );

	$i = 0;
	foreach ( $attachments as $id => $attachment ) {

		$attr = ( trim( $attachment->post_excerpt ) ) ? array( 'aria-describedby' => "$selector-$id" ) : '';
		if ( ! empty( $atts['link'] ) && 'file' === $atts['link'] ) {
			$image_output = wp_get_attachment_link( $id, $atts['size'], false, false, false, $attr );
		} elseif ( ! empty( $atts['link'] ) && 'none' === $atts['link'] ) {
			$image_output = wp_get_attachment_image( $id, $atts['size'], false, $attr );
		} else {
			$image_output = wp_get_attachment_link( $id, $atts['size'], true, false, false, $attr );
		}
		$image_meta  = wp_get_attachment_metadata( $id );

		$orientation = '';
		if ( isset( $image_meta['height'], $image_meta['width'] ) ) {
			$orientation = ( $image_meta['height'] > $image_meta['width'] ) ? 'portrait' : 'landscape';
		}
		$output .= "<{$itemtag} class='gallery-item'>";
		$output .= "
			<{$icontag} class='gallery-icon {$orientation}'>
				$image_output
			</{$icontag}>";
		if ( $captiontag && trim($attachment->post_excerpt) ) {
			$output .= "
				<{$captiontag} class='wp-caption-text gallery-caption' id='$selector-$id'>
				" . wptexturize($attachment->post_excerpt) . "
				</{$captiontag}>";
		}
		$output .= "</{$itemtag}>";
		if ( ! $html5 && $columns > 0 && ++$i % $columns == 0 ) {
			$output .= '<br style="clear: both" />';
		}
	}

	if ( ! $html5 && $columns > 0 && $i % $columns !== 0 ) {
		$output .= "
			<br style='clear: both' />";
	}

	$output .= "
		</div>\n";

	return $output;
}

// Init hook for new gallery shortcode replaced
remove_shortcode('gallery');
add_shortcode('gallery', 'custom_gallery_shortcode');


// Custom carousel gallery shortcode with blueImp gallery impelemented
function custom_carousel_shortcode( $attr ) {
	$post = get_post();

	static $instance = 0;
	$instance++;

	if ( ! empty( $attr['ids'] ) ) {
		// 'ids' is explicitly ordered, unless you specify otherwise.
		if ( empty( $attr['orderby'] ) ) {
			$attr['orderby'] = 'post__in';
		}
		$attr['include'] = $attr['ids'];
	}

	/**
	 * Filters the default carousel shortcode output.
	 *
	 * If the filtered output isn't empty, it will be used instead of generating
	 * the default carousel template.
	 *
	 * @since 2.5.0
	 * @since 4.2.0 The `$instance` parameter was added.
	 *
	 * @see carousel_shortcode()
	 *
	 * @param string $output   The carousel output. Default empty.
	 * @param array  $attr     Attributes of the carousel shortcode.
	 * @param int    $instance Unique numeric ID of this carousel shortcode instance.
	 */
	$output = apply_filters( 'post_gallery', '', $attr, $instance );
	if ( $output != '' ) {
		return $output;
	}

	$html5 = current_theme_supports( 'html5', 'gallery' );
	$atts = shortcode_atts( array(
		'order'      => 'ASC',
		'orderby'    => 'menu_order ID',
		'id'         => $post ? $post->ID : 0,
		'itemtag'    => $html5 ? 'figure'     : 'dl',
		'icontag'    => $html5 ? 'div'        : 'dt',
		'captiontag' => $html5 ? 'figcaption' : 'dd',
		'columns'    => 3,
		'size'       => 'thumbnail',
		'include'    => '',
		'exclude'    => '',
		'link'       => ''
	), $attr, 'carousel' );

	$id = intval( $atts['id'] );

	if ( ! empty( $atts['include'] ) ) {
		$_attachments = get_posts( array( 'include' => $atts['include'], 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $atts['order'], 'orderby' => $atts['orderby'] ) );

		$attachments = array();
		foreach ( $_attachments as $key => $val ) {
			$attachments[$val->ID] = $_attachments[$key];
		}
	} elseif ( ! empty( $atts['exclude'] ) ) {
		$attachments = get_children( array( 'post_parent' => $id, 'exclude' => $atts['exclude'], 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $atts['order'], 'orderby' => $atts['orderby'] ) );
	} else {
		$attachments = get_children( array( 'post_parent' => $id, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $atts['order'], 'orderby' => $atts['orderby'] ) );
	}

	if ( empty( $attachments ) ) {
		return '';
	}

	if ( is_feed() ) {
		$output = "\n";
		foreach ( $attachments as $att_id => $attachment ) {
			$output .= wp_get_attachment_link( $att_id, $atts['size'], true ) . "\n";
		}
		return $output;
	}

	$itemtag = tag_escape( $atts['itemtag'] );
	$captiontag = tag_escape( $atts['captiontag'] );
	$icontag = tag_escape( $atts['icontag'] );
	$valid_tags = wp_kses_allowed_html( 'post' );
	if ( ! isset( $valid_tags[ $itemtag ] ) ) {
		$itemtag = 'dl';
	}
	if ( ! isset( $valid_tags[ $captiontag ] ) ) {
		$captiontag = 'dd';
	}
	if ( ! isset( $valid_tags[ $icontag ] ) ) {
		$icontag = 'dt';
	}

	$columns = intval( $atts['columns'] );
	$itemwidth = $columns > 0 ? floor(100/$columns) : 100;
	$float = is_rtl() ? 'right' : 'left';

	$selector = "carousel-{$instance}";

	$carousel_style = '';

	/**
	 * Filters whether to print default carousel styles.
	 *
	 * @since 3.1.0
	 *
	 * @param bool $print Whether to print default carousel styles.
	 *                    Defaults to false if the theme supports HTML5 galleries.
	 *                    Otherwise, defaults to true.
	 */
	if ( apply_filters( 'use_default_gallery_style', ! $html5 ) ) {
		$carousel_style = "
		<style type='text/css'>
			#{$selector} {
				margin: auto;
			}
			#{$selector} .carousel-item {
				float: {$float};
				margin-top: 10px;
				text-align: center;
				width: {$itemwidth}%;
			}
			#{$selector} img {
				border: 2px solid #cfcfcf;
			}
			#{$selector} .carousel-caption {
				margin-left: 0;
			}
		</style>\n\t\t";
	} else {
		$carousel_style = "
		<style type='text/css'>
			#{$selector} {
				display:none;
			}
		</style>\n\t\t";
	}

	$size_class = sanitize_html_class( $atts['size'] );
	$carousel_div = "
	<div id=\"blueimp-gallery-carousel\" class=\"blueimp-gallery blueimp-gallery-carousel blueimp-gallery-controls\">
		<div class=\"slides\"></div>
		<h3 class=\"title\"></h3>
		<a class=\"prev\">&lsaquo;</a>
		<a class=\"next\">&rsaquo;</a>
		<ol class=\"indicator\"></ol>
	</div>
	<div id='$selector' class='carousel carouselid-{$id} carousel-columns-{$columns} carousel-size-{$size_class}'>";

	/**
	 * Filters the default carousel shortcode CSS styles.
	 *
	 * @since 2.5.0
	 *
	 * @param string $carousel_style Default CSS styles and opening HTML div container
	 *                              for the carousel shortcode output.
	 */
	$output = apply_filters( 'gallery_style', $carousel_style . $carousel_div );

	$i = 0;
	foreach ( $attachments as $id => $attachment ) {

		$attr = ( trim( $attachment->post_excerpt ) ) ? array( 'aria-describedby' => "$selector-$id" ) : '';
		if ( ! empty( $atts['link'] ) && 'file' === $atts['link'] ) {
			$image_output = wp_get_attachment_link( $id, $atts['size'], false, false, false, $attr );
		} elseif ( ! empty( $atts['link'] ) && 'none' === $atts['link'] ) {
			$image_output = wp_get_attachment_image( $id, $atts['size'], false, $attr );
		} else {
			$image_output = wp_get_attachment_link( $id, $atts['size'], true, false, false, $attr );
		}
		$image_meta  = wp_get_attachment_metadata( $id );

		$orientation = '';
		if ( isset( $image_meta['height'], $image_meta['width'] ) ) {
			$orientation = ( $image_meta['height'] > $image_meta['width'] ) ? 'portrait' : 'landscape';
		}
		$output .= "<{$itemtag} class='carousel-item'>";
		$output .= "
			<{$icontag} class='carousel-icon {$orientation}'>
				$image_output
			</{$icontag}>";
		if ( $captiontag && trim($attachment->post_excerpt) ) {
			$output .= "
				<{$captiontag} class='wp-caption-text carousel-caption' id='$selector-$id'>
				" . wptexturize($attachment->post_excerpt) . "
				</{$captiontag}>";
		}
		$output .= "</{$itemtag}>";
		if ( ! $html5 && $columns > 0 && ++$i % $columns == 0 ) {
			$output .= '<br style="clear: both" />';
		}
	}

	if ( ! $html5 && $columns > 0 && $i % $columns !== 0 ) {
		$output .= "
			<br style='clear: both' />";
	}

	$output .= "
		</div>\n";

	return $output;
}

// Init hook for new carousel shortcode
add_shortcode('carousel', 'custom_carousel_shortcode');

// Register button for shortcode [carousel]
function register_carousel_button( $buttons ) {
   array_push( $buttons, "|", "carousel" );
   return $buttons;
}

function add_carousel_plugin( $plugin_array ) {
   $plugin_array['carousel'] = get_template_directory_uri() . '/js/rte-carousel.js';
   return $plugin_array;
}

function carousel_button() {
   if ( ! current_user_can('edit_posts') && ! current_user_can('edit_pages') ) {
      return;
   }
   if ( get_user_option('rich_editing') == 'true' ) {
      add_filter( 'mce_external_plugins', 'add_carousel_plugin' );
      add_filter( 'mce_buttons', 'register_carousel_button' );
   }
}

add_action('init', 'carousel_button');


// footer widget hooks
if ( ! function_exists( 'footer_widgets_init' ) ) :
	function footer_widgets_init() {
		register_sidebar( array(
		'name' => 'Footer 1',
		'id' => 'footer-sidebar-1',
		'description' => 'Appears in the footer area',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
		) );
		register_sidebar( array(
		'name' => 'Footer 2',
		'id' => 'footer-sidebar-2',
		'description' => 'Appears in the footer area',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
		) );
		register_sidebar( array(
		'name' => 'Footer 3',
		'id' => 'footer-sidebar-3',
		'description' => 'Appears in the footer area',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
		) );
		register_sidebar( array(
		'name' => 'Footer 4',
		'id' => 'footer-sidebar-4',
		'description' => 'Appears in the footer area',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
		) );
		register_sidebar( array(
		'name' => 'Footer 5',
		'id' => 'footer-sidebar-5',
		'description' => 'Appears in the footer area',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
		) );
	}
endif; // footer widget hooks
add_action('widgets_init', 'footer_widgets_init');




// Widget Custom post type menu - for any used types (without taxonomy hierarchy)
class widget_custom_post_menu extends WP_Widget {

	function __construct() {
		parent::__construct(
		// Base ID of your widget
		'widget_custom_post_menu', 

		// Widget name will appear in UI
		__('Custom post type menu', 'widget_custom_post_menu_domain'), 

		// Widget description
		array( 'description' => __( 'Displays custom post type menu.', 'widget_custom_post_menu_domain' ), ) 
		);
	}

	// Creating widget front-end
	// This is where the action happens
	public function widget( $args, $instance ) {
		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );
		$widget_post_type = ! empty( $instance['custom_post_type'] ) ? $instance['custom_post_type'] : '';
		$custom_post_type = apply_filters( 'custom_post_type', $widget_post_type, $instance, $this );
		// before and after widget arguments are defined by themes
		echo $args['before_widget'];
				if ( ! empty( $title ) ) {
					echo $args['before_title'] . $title . $args['after_title'];
				} ?>
					<div class="menu-submenu-<?php echo $custom_post_type; ?>-container">
					<?php
		$args = array(
			'post_type' => $custom_post_type,
			'posts_per_page' => -1,
			'orderby'=> 'title',
			'order' => 'ASC'
		);
		$output = '';
		global $post;
		$current_post_id = get_the_ID();
		$query = new WP_Query( $args );
		if ($query->have_posts()) {
			$output .= '<ul id="menu-submenu-'.$custom_post_type.'" class="menu">'."\n";
			while ( $query->have_posts() ) : $query->the_post();
				($current_post_id == get_the_ID()) ? $current_class = ' current-menu-item' : $current_class = '';
				$output .= '<li id="menu-item-'.get_the_ID().'" class="menu-item menu-item-type-post_type menu-item-object-'.$custom_post_type.$current_class.' menu-item-'.get_the_ID().'">';
				$output .= '<a href="'.get_permalink().'">'.get_the_title().'</a>
				</li>'."\n";
			endwhile;
		$output .= '</ul>'."\n";
		}
		wp_reset_postdata();
		echo $output;
		?>
				</div>
			<?php
			echo $args['after_widget'];
	}
			
	// Widget Backend 
	public function form( $instance ) {
		if ( isset( $instance[ 'title' ] ) ) {
		$title = $instance[ 'title' ];
		}
		else {
		$title = __( 'Custom menu', 'widget_custom_post_menu_domain' );
		}
		if ( isset( $instance[ 'custom_post_type' ] ) ) {
		$custom_post_type = $instance[ 'custom_post_type' ];
		}
		else {
		$custom_post_type = __( 'post', 'widget_custom_post_menu_domain' );
		}
		// Widget admin form
		?>
		<p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
		<p>
		<label for="<?php echo $this->get_field_id( 'custom_post_type' ); ?>"><?php _e( 'Custom post type:' ); ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id( 'custom_post_type' ); ?>" name="<?php echo $this->get_field_name( 'custom_post_type' ); ?>" type="text" value="<?php echo esc_attr( $custom_post_type ); ?>" />
		</p>
		<?php 
	}
		
	// Updating widget replacing old instances with new
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		$instance['custom_post_type'] = ( ! empty( $new_instance['custom_post_type'] ) ) ? strip_tags( $new_instance['custom_post_type'] ) : '';
		return $instance;
	}
} // Class widget_custom_post_menu ends here

// Register and load the widget
function cpt_load_widget() {
	register_widget( 'widget_custom_post_menu' );
}
add_action( 'widgets_init', 'cpt_load_widget' );









