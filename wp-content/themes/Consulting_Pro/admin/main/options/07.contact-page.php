<?php
/**
 * Special pages functions.
 *
 * @package ThinkUpThemes
 */

/* ----------------------------------------------------------------------------------
	GOOGLE MAP SHORTCODE
---------------------------------------------------------------------------------- */

/* Used in function thinkup_input_contact() */
function thinkup_contact_map() {
global 	$thinkup_contact_map;

$output = NULL;

	if( ! empty( $thinkup_contact_map ) ) {
	
		if ( strpos( $thinkup_contact_map, '[' ) !== false and strpos( $thinkup_contact_map, ']' ) !== false ) {

			$output = do_shortcode( $thinkup_contact_map );

		} else {

			$thinkup_contact_map = str_replace( ' ', '+', $thinkup_contact_map );

			$output .= '<iframe width="1800" ';
			$output .= 'height="350" ';
			$output .= 'frameborder="0" ';
			$output .= 'scrolling="no" ';
			$output .= 'marginheight="0" ';
			$output .= 'marginwidth="0" ';
			$output .= 'src="https://maps.google.com/maps?f=q&';
			$output .= 'source=s_q&';
			$output .= 'hl=en&';                                  // Language control
			$output .= 'geocode=&';
			$output .= 'q=' . $thinkup_contact_map . '&';         // Location address
			$output .= 'ie=UTF8&';                                // Set character encoding
			$output .= 't=m&';                                    // The type of map being used
			$output .= 'z=15&';                                   // The level of zoom
			$output .= 'output=embed">';
			$output .= '</iframe>';
		}

		return $output;

	}
}


/* ----------------------------------------------------------------------------------
	CONTACT FORM SHORTCODE
---------------------------------------------------------------------------------- */

/* Used in function thinkup_input_contact() */
function thinkup_contact_form() {
global $thinkup_contact_form;

	return do_shortcode( $thinkup_contact_form );
}


/* ----------------------------------------------------------------------------------
	COMPANY INFORMATION / ADDRESS DETAILS / CONTACT DETAIL
---------------------------------------------------------------------------------- */

/* Company Information - Used in function thinkup_input_contact() */
function thinkup_contact_info() {
global $thinkup_contact_info;

	return do_shortcode( wpautop( $thinkup_contact_info ) );
}

/* Contact Details - Used in function thinkup_input_contact() */
function thinkup_contact_details() {
global $thinkup_contact_iconswitch;
global $thinkup_contact_address;
global $thinkup_contact_phone;
global $thinkup_contact_email;
global $thinkup_contact_website;

	$output = NULL;
	$thinkup_input_addressicon = NULL;
	$thinkup_input_phoneicon   = NULL;
	$thinkup_input_emailicon   = NULL;
	$thinkup_input_websiteicon = NULL;

	// Determin whether icon should be displayed.
	if ( $thinkup_contact_iconswitch == '1' ) {
		$thinkup_input_addressicon = '<i class="fa fa-map-marker"></i>';
		$thinkup_input_phoneicon   = '<i class="fa fa-phone"></i>';
		$thinkup_input_emailicon   = '<i class="fa fa-envelope"></i>';
		$thinkup_input_websiteicon = '<i class="fa fa-globe"></i>';
	} else {
		$thinkup_input_addressicon = '<h5>Address:</h5>';
		$thinkup_input_phoneicon   = '<h5>Phone:</h5>';
		$thinkup_input_emailicon   = '<h5>Email:</h5>';
		$thinkup_input_websiteicon = '<h5>Website:</h5>';
	}

	if ( ! empty( $thinkup_contact_address ) ) {
		$output .= '<div class="contact-details">' . $thinkup_input_addressicon . '<span>' . $thinkup_contact_address . '</span></div>';
	}
	if ( ! empty( $thinkup_contact_phone ) ) {
		$output .= '<div class="contact-details">' . $thinkup_input_phoneicon . '<span>' . $thinkup_contact_phone . '</span></div>';
	}
	if ( ! empty( $thinkup_contact_email ) ) {
		$output .= '<div class="contact-details">' . $thinkup_input_emailicon . '<span><a href="mailto:' . $thinkup_contact_email . '">' . $thinkup_contact_email . '</a></span></div>';
	}
	if ( ! empty( $thinkup_contact_website ) ) {
		$output .= '<div class="contact-details">' . $thinkup_input_websiteicon . '<span><a href="' . esc_url( $thinkup_contact_website ) . '" target="_blank">' . str_replace( 'http://', '', $thinkup_contact_website ) . '</a></span></div>';
	}

	return do_shortcode( $output );
}


/* ----------------------------------------------------------------------------------
	OUTPUT CONTACT PAGE
---------------------------------------------------------------------------------- */

function thinkup_input_contact() {
global 	$thinkup_contact_mapposition;

// Translation variables
global $thinkup_translate_contactformtitle;
global $thinkup_translate_contactabouttitle;

$output = NULL;

	if( empty( $thinkup_translate_contactformtitle ) ) {
		$thinkup_translate_contactformtitle = __( 'Send us a message', 'consulting' );
	}
	if( empty( $thinkup_translate_contactabouttitle ) ) {
		$thinkup_translate_contactabouttitle = __( 'About us', 'consulting' );
	}

	// Input Google Map if shortcode specified
	if ( empty( $thinkup_contact_mapposition ) or $thinkup_contact_mapposition == 'option1' ) {

		$output .= '<div class="margin20"></div>';

		$output .= '<div class="panel-grid"><div class="panel-grid-core">';
		
			$output .= '<div class="shadow-box">';
			$output .= thinkup_contact_map();
			$output .= '<div class="shadow-box-core">';
			$output .= '<div class="margin10"></div>';
			$output .= do_shortcode( '[divider]' );
			$output .= thinkup_contact_info();
			$output .= thinkup_contact_details();
			$output .= '</div>';
			$output .= '<div class="margin20"></div>';
			$output .= '</div>';

			$output .= '<div class="margin60"></div>';
			
			$output .= '<h4>' .  $thinkup_translate_contactformtitle . '</h4>';
			$output .= thinkup_contact_form();

			$output .= '<div style="clear: both;"></div>';

		$output .= '</div></div>';

		$output .= '<div class="margin20"></div>';
		
	} else if ( $thinkup_contact_mapposition == 'option2' ) {

		$output .= '<div class="margin20"></div>';

		$output .= '<div class="panel-grid"><div class="panel-grid-core">';
		
			$output .= '<h4>' .  $thinkup_translate_contactformtitle . '</h4>';
			$output .= thinkup_contact_form();

			$output .= '<div class="margin40"></div>';

			$output .= '<div class="shadow-box">';
			$output .= '<div class="margin20"></div>';
			$output .= '<div class="shadow-box-core">';
			$output .= thinkup_contact_info();
			$output .= thinkup_contact_details();
			$output .= do_shortcode( '[divider]' );
			$output .= '<div class="margin10"></div>';
			$output .= '</div>';
			$output .= thinkup_contact_map();
			$output .= '</div>';

			$output .= '<div style="clear: both;"></div>';

		$output .= '</div></div>';

		$output .= '<div class="margin20"></div>';

	}

	echo $output;
}


?>