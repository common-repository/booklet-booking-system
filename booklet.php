<?php 
/**
 * Plugin Name: Booklet - Hotel booking system by user email 
 * Plugin URI:  http://unitetheme.com/plugins/
 * Description: Booklet Wordpress booking system plugin
 * Version:     1.1.1
 * Author: 	 Themeatelier
 * Author URI:  http://unitetheme.com/
 * License:     GPL2
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Domain Path: /languages
 * Text Domain: booklet
 *
 */

// Direct access block 
if( !defined('ABSPATH') )exit();

// load textdomain
load_plugin_textdomain( 'booklet', false, basename( dirname( __FILE__ ) ) . '/languages' );

// Include File
require_once( dirname( __FILE__ ). '/inc/classes/Booklet-Enqueue.php' );
require_once( dirname( __FILE__ ). '/inc/classes/Booklet-Mail.php' );
require_once( dirname( __FILE__ ). '/inc/classes/Booklet-BookingForm.php' );
require_once( dirname( __FILE__ ). '/inc/classes/Booklet-PostType.php' );
require_once( dirname( __FILE__ ). '/inc/classes/Booklet-RestaurantMeta.php' );
require_once( dirname( __FILE__ ). '/inc/classes/Booklet-RestBookingFormdata.php' );

require_once( dirname( __FILE__ ). '/admin/Booklet-Admin.php' );


// register post type and meta
$titles = array(
	'pular' 	=> 'Restaurant Booking',
	'singular'  => 'Booking',
);

$booktype = new Booklet_PostType('restaurant-booking', $titles );

$bookmeta = new Booklet_RestaurantMeta('restaurant-booking');

// Booking Form Shortcode
add_shortcode( 'booklet-form', 'booklet_booking_form' );
function booklet_booking_form(){
	
	$title = get_option('booklet_option_name');

	if( $title['booklet_form_title'] ){
		$ftitle = $title['booklet_form_title'];
	}else{
		$ftitle = 'Restaurant Booking Form';
	}
	
	if( $title['booklet_form_subtitle'] ){
		$subtitle = $title['booklet_form_subtitle'];
	}else{
		$subtitle = '';
	}

	$form = new Booklet_BookingForm( $ftitle, $subtitle );
	
	$form->booklet_frontbooking_form();
}


// Publish button text change
add_filter( 'gettext', 'booklet_publish_button', 10, 2 );

function booklet_publish_button( $translation, $text ) {

	if( get_post_type() == 'restaurant-booking' ){
			if ( $text == 'Publish' ){
			return 'Approve';
		}

	}
	return $translation;

}
