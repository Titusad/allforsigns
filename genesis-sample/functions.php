<?php
/**
 * Genesis Sample.
 *
 * This file adds functions to the Genesis Sample Theme.
 *
 * @package Genesis Sample
 * @author  StudioPress
 * @license GPL-2.0+
 * @link    http://www.studiopress.com/
 */
// Start the engine.
include_once( get_template_directory() . '/lib/init.php' );
// Setup Theme.
include_once( get_stylesheet_directory() . '/lib/theme-defaults.php' );
// Set Localization (do not remove).
add_action( 'after_setup_theme', 'genesis_sample_localization_setup' );
function genesis_sample_localization_setup(){
	load_child_theme_textdomain( 'genesis-sample', get_stylesheet_directory() . '/languages' );
}
// Add the helper functions.
include_once( get_stylesheet_directory() . '/lib/helper-functions.php' );
// Add Image upload and Color select to WordPress Theme Customizer.
require_once( get_stylesheet_directory() . '/lib/customize.php' );
// Include Customizer CSS.
include_once( get_stylesheet_directory() . '/lib/output.php' );
// Add WooCommerce support.
include_once( get_stylesheet_directory() . '/lib/woocommerce/woocommerce-setup.php' );
// Add the required WooCommerce styles and Customizer CSS.
include_once( get_stylesheet_directory() . '/lib/woocommerce/woocommerce-output.php' );
// Add the Genesis Connect WooCommerce notice.
include_once( get_stylesheet_directory() . '/lib/woocommerce/woocommerce-notice.php' );
// Child theme (do not remove).
define( 'CHILD_THEME_NAME', 'Genesis Sample' );
define( 'CHILD_THEME_URL', 'http://www.studiopress.com/' );
define( 'CHILD_THEME_VERSION', '2.3.0' );
// Enqueue Scripts and Styles.
add_action( 'wp_enqueue_scripts', 'genesis_sample_enqueue_scripts_styles' );
function genesis_sample_enqueue_scripts_styles() {
	wp_enqueue_style( 'genesis-sample-fonts', '//fonts.googleapis.com/css?family=Source+Sans+Pro:400,600,700', array(), CHILD_THEME_VERSION );
	wp_enqueue_style( 'dashicons' );
	$suffix = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';
	wp_enqueue_script( 'genesis-sample-responsive-menu', get_stylesheet_directory_uri() . "/js/responsive-menus{$suffix}.js", array( 'jquery' ), CHILD_THEME_VERSION, true );
	wp_localize_script(
		'genesis-sample-responsive-menu',
		'genesis_responsive_menu',
		genesis_sample_responsive_menu_settings()
	);
}
// Define our responsive menu settings.
function genesis_sample_responsive_menu_settings() {
	$settings = array(
		'mainMenu'          => __( 'Menu', 'genesis-sample' ),
		'menuIconClass'     => 'dashicons-before dashicons-menu',
		'subMenu'           => __( 'Submenu', 'genesis-sample' ),
		'subMenuIconsClass' => 'dashicons-before dashicons-arrow-down-alt2',
		'menuClasses'       => array(
			'combine' => array(
				'.nav-primary',
				'.nav-header',
			),
			'others'  => array(),
		),
	);
	return $settings;
}
// Add HTML5 markup structure.
add_theme_support( 'html5', array( 'caption', 'comment-form', 'comment-list', 'gallery', 'search-form' ) );
// Add Accessibility support.
add_theme_support( 'genesis-accessibility', array( '404-page', 'drop-down-menu', 'headings', 'rems', 'search-form', 'skip-links' ) );
// Add viewport meta tag for mobile browsers.
add_theme_support( 'genesis-responsive-viewport' );
// Add support for custom header.
add_theme_support( 'custom-header', array(
	'width'           => 600,
	'height'          => 160,
	'header-selector' => '.site-title a',
	'header-text'     => false,
	'flex-height'     => true,
) );
// Add support for custom background.
add_theme_support( 'custom-background' );
// Add support for after entry widget.
add_theme_support( 'genesis-after-entry-widget-area' );
// Add support for 3-column footer widgets.
add_theme_support( 'genesis-footer-widgets', 3 );
// Add Image Sizes.
add_image_size( 'featured-image', 720, 400, TRUE );
// Rename primary and secondary navigation menus.
add_theme_support( 'genesis-menus', array( 'primary' => __( 'After Header Menu', 'genesis-sample' ), 'secondary' => __( 'Footer Menu', 'genesis-sample' ) ) );

//* Reposition the primary navigation menu
remove_action( 'genesis_after_header', 'genesis_do_nav' );
add_action( 'genesis_header_right', 'genesis_do_nav', 12 );

// Reposition the secondary navigation menu.
remove_action( 'genesis_after_header', 'genesis_do_subnav' );
add_action( 'genesis_footer', 'genesis_do_subnav', 5 );

// Reduce the secondary navigation menu to one level depth.
add_filter( 'wp_nav_menu_args', 'genesis_sample_secondary_menu_args' );
function genesis_sample_secondary_menu_args( $args ) {
	if ( 'secondary' != $args['theme_location'] ) {
		return $args;
	}
	$args['depth'] = 1;
	return $args;
}
// Modify size of the Gravatar in the author box.
add_filter( 'genesis_author_box_gravatar_size', 'genesis_sample_author_box_gravatar' );
function genesis_sample_author_box_gravatar( $size ) {
	return 90;
}
// Modify size of the Gravatar in the entry comments.
add_filter( 'genesis_comment_list_args', 'genesis_sample_comments_gravatar' );
function genesis_sample_comments_gravatar( $args ) {
	$args['avatar_size'] = 60;
	return $args;
}

//* Make Font Awesome available
add_action( 'wp_enqueue_scripts', 'enqueue_font_awesome' );
function enqueue_font_awesome() {

	wp_enqueue_style( 'font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css' );

}

/**
 * Place a cart icon with number of items and total cost in the menu bar.
 *
 * Source: http://wordpress.org/plugins/woocommerce-menu-bar-cart/
 */
add_filter('wp_nav_menu_items','sk_wcmenucart', 10, 2);
function sk_wcmenucart($menu, $args) {

	// Check if WooCommerce is active and add a new item to a menu assigned to Primary Navigation Menu location
	if ( !in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) || 'primary' !== $args->theme_location )
		return $menu;

	ob_start();
		global $woocommerce;
		$viewing_cart = __('View your shopping cart', 'your-theme-slug');
		$start_shopping = __('Start shopping', 'your-theme-slug');
		$cart_url = $woocommerce->cart->get_cart_url();
		$shop_page_url = get_permalink( woocommerce_get_page_id( 'shop' ) );
		$cart_contents_count = $woocommerce->cart->cart_contents_count;
		//$cart_contents = sprintf(_n('%d item', '%d items', $cart_contents_count, 'your-theme-slug'), $cart_contents_count);
		$cart_contents = sprintf(_n('%d', '%d', $cart_contents_count, 'your-theme-slug'), $cart_contents_count);
		$cart_total = $woocommerce->cart->get_cart_total();
		// Uncomment the line below to hide nav menu cart item when there are no items in the cart
		// if ( $cart_contents_count > 0 ) {
			if ($cart_contents_count == 0) {
				$menu_item = '<li class="float-cart"><a class="wcmenucart-contents" href="'. $shop_page_url .'" title="'. $start_shopping .'">';
			} else {
				$menu_item = '<li class="float-cart"><a class="wcmenucart-contents" href="'. $cart_url .'" title="'. $viewing_cart .'">';
			}

			$menu_item .= '<i class="fa fa-shopping-cart"></i> ';

			//$menu_item .= $cart_contents.' - '. $cart_total;
			$menu_item .= $cart_contents;
			$menu_item .= '</a></li>';
		// Uncomment the line below to hide nav menu cart item when there are no items in the cart
		// }
		echo $menu_item;
	$social = ob_get_clean();
	return $menu . $social;

}

add_action( 'genesis_before', 'prefix_remove_entry_header' );
/**
 * Remove Entry Header
 */
function prefix_remove_entry_header()
{

	if ( ! is_front_page() ) { return; }

	//* Remove the entry header markup (requires HTML5 theme support)
	remove_action( 'genesis_entry_header', 'genesis_entry_header_markup_open', 5 );
	remove_action( 'genesis_entry_header', 'genesis_entry_header_markup_close', 15 );

	//* Remove the entry title (requires HTML5 theme support)
	remove_action( 'genesis_entry_header', 'genesis_do_post_title' );

	//* Remove the entry meta in the entry header (requires HTML5 theme support)
	remove_action( 'genesis_entry_header', 'genesis_post_info', 12 );

	//* Remove the post format image (requires HTML5 theme support)
	remove_action( 'genesis_entry_header', 'genesis_do_post_format_image', 4 );
}


/* Switch Sidebar Order */

// Add custom styling to sidebar-content-sidebar layout
function vr_sidebar_content_sidebar_css() {
	$site_layout = genesis_site_layout();
	if ( 'sidebar-content-sidebar' == $site_layout ) {
			?>
				<style>
				.sidebar-content-sidebar .content-sidebar-wrap {
					width: auto;
				}

				.sidebar-content-sidebar .sidebar-primary {
					float:left;
					margin-right:auto;
				}

				.sidebar-content-sidebar .sidebar-secondary {
					float:right;
					margin-left:9px;
					border-left: 1px solid #d0d2d3;
					padding-left: 10px;
				}
				</style>
			<?php
	}
}
add_action('wp_head', 'vr_sidebar_content_sidebar_css', 99);
	
add_action( 'genesis_after_header', 'vr_change_sidebar_order' );
function vr_change_sidebar_order() {
	$site_layout = genesis_site_layout();
	if ( 'sidebar-content-sidebar' == $site_layout ) {
		
		// reposition sidebars
		remove_action( 'genesis_sidebar', 'genesis_do_sidebar' );
		remove_action( 'genesis_sidebar_alt', 'genesis_do_sidebar_alt' );
		add_action( 'genesis_sidebar', 'genesis_do_sidebar_alt' );
		add_action( 'genesis_sidebar_alt', 'genesis_do_sidebar' );

		// Add 'sidebar-secondary' class to, and remove 'sidebar-primary' class from, the left-hand <aside> sidebar
		function vr_add_left_sidebar_class( $attributes ) {
			$attributes['class'] = str_replace( 'sidebar-primary', 'sidebar-secondary', $attributes['class'] );
			// Next line commented out but left available in case needed later
			/* $attributes['class'] = $attributes['class']. ' sidebar-secondary'; */
			return $attributes;
		}
		add_filter( 'genesis_attr_sidebar-primary', 'vr_add_left_sidebar_class' );
		
		// Add 'sidebar-primary' class to, and remove 'sidebar-secondary' class from, the right-hand <aside> sidebar
		function vr_add_right_sidebar_class( $attributes ) {
			$attributes['class'] = str_replace( 'sidebar-secondary', 'sidebar-primary', $attributes['class'] );
			// Next line commented out but left available in case needed later
			/* $attributes['class'] = $attributes['class']. ' sidebar-primary'; */
			return $attributes;
		}
		add_filter( 'genesis_attr_sidebar-secondary', 'vr_add_right_sidebar_class' );
		
	}
}


//* Add Dashicon to search form button 

add_action( 'wp_enqueue_scripts', 'load_dashicons_front_end' );
function load_dashicons_front_end() {
wp_enqueue_style( 'dashicons' );
}

add_filter( 'genesis_search_button_text', 'wpsites_search_button_icon' );
function wpsites_search_button_icon( $text ) {
	return esc_attr( '&#xf179;' );
}


//* Add extrafields to populate the calculator measurements
function add_extra_fields_on_measurement_calculator() {
  
}

add_action( 'woocommerce_before_add_to_cart_form', 'add_extra_fields_on_measurement_calculator' );


//* Add quote request shortcode
function add_quote_request_shortcode() {
  
  echo '<p class="request-text">Need a custom product?</p>';
  echo '<a href="#popmake-1451" class="quote-button">Request a Quote</a>	';
}

add_action( 'woocommerce_after_add_to_cart_button', 'add_quote_request_shortcode' );



//* Reposition Product Title
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );
add_action( 'woocommerce_before_single_product_summary', 'woocommerce_template_single_title', 5 );


//* Reposition Product Price
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
add_action( 'woocommerce_before_single_product_summary', 'woocommerce_template_single_price', 10 );


//* Reposition Product Price
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20 );
add_action( 'woocommerce_before_single_product_summary', 'woocommerce_template_single_excerpt', 20 );


//* Remove Aditional Info
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10 );

//* Reposition Related Products
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );
add_action( 'woocommerce_after_single_product', 'woocommerce_output_related_products', 20 );


