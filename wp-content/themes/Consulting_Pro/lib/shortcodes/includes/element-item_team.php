<?php
$id              = NULL;
$size            = NULL;
$show_link       = NULL;
$show_name       = NULL;
$show_position   = NULL;
$show_excerpt    = NULL;
$show_social     = NULL;
$center          = NULL;
$style           = NULL;

$class_style     = NULL;
$class_overlay   = NULL;

$output_image    = NULL;
$output_overlay  = NULL;
$output_name     = NULL;
$output_position = NULL;
$output_excerpt	 = NULL;
$output_social   = NULL;
$output_button   = NULL;
$center_start    = NULL;
$center_end      = NULL;

$id              = $atts['id'];
$size            = $atts['size'];
$show_link       = $atts['show_link'];
$show_name       = $atts['show_name'];
$show_position   = $atts['show_position'];
$show_excerpt    = $atts['show_excerpt'];
$show_social     = $atts['show_social'];
$center          = $atts['center'];
$style           = $atts['style'];

if ( empty( $size ) ) { $size = 'column2-2/3'; }

$post_id        = get_post_thumbnail_id( $id );
$post_img_full  = wp_get_attachment_image_src($post_id, 'full', true);

// Determine which style to output
if ( empty( $style ) or $style == 'style1' ) {
	$post_img       = wp_get_attachment_image_src($post_id, $size, true);
	$output_image   = $post_img[0];
	$class_style    = ' style1';
	$class_overlay  = '';
} else {
	$post_img       = wp_get_attachment_image_src($post_id, $size, true);
	$output_image   = $post_img[0];
	$class_style    = ' style2';
	$class_overlay  = '';
}

// Output team member name if set
if( $show_name == 'on' ) {
	$output_name .= '<h4><a href="' . esc_url( get_permalink( $id ) ) . '">' . get_the_title( $id ) . '</a></h4>';
}

// Output team position if set
if( $show_position == 'on' ) {
	$_thinkup_meta_teamposition  = get_post_meta( $id, '_thinkup_meta_teamposition', true );
	$output_position .= '<h5>' . $_thinkup_meta_teamposition . '</h5>';
}
	
// Output excerpt if set
if ( thinkup_input_excerptbyid( $id ) !== '' and $show_excerpt == 'on' ) {
	$output_excerpt .= thinkup_input_excerptbyid( $id );
}

// Output social media icons if set
if ( $show_social == 'on' ) {
	
	// Output excerpt if set
	if( $show_social == 'on' ) {
		$_thinkup_meta_teamfacebook  = get_post_meta( $id, '_thinkup_meta_teamfacebook', true );
		$_thinkup_meta_teamtwitter   = get_post_meta( $id, '_thinkup_meta_teamtwitter', true );
		$_thinkup_meta_teamgoogle    = get_post_meta( $id, '_thinkup_meta_teamgoogle', true );
		$_thinkup_meta_teamlinkedin  = get_post_meta( $id, '_thinkup_meta_teamlinkedin', true );
		$_thinkup_meta_teaminstagram = get_post_meta( $id, '_thinkup_meta_teaminstagram', true );
		$_thinkup_meta_teamdribbble  = get_post_meta( $id, '_thinkup_meta_teamdribbble', true );
		$_thinkup_meta_teamflickr    = get_post_meta( $id, '_thinkup_meta_teamflickr', true );
	
		// Reset count values used in foreach loop
		$i = 0;
		$j = 0;
	
		// Assign social media link to an array
		$social_links = array( 
			array( 'social' => 'Facebook',    'link' => $_thinkup_meta_teamfacebook ),
			array( 'social' => 'Twitter',     'link' => $_thinkup_meta_teamtwitter ),
			array( 'social' => 'Google-plus', 'link' => $_thinkup_meta_teamgoogle ),
			array( 'social' => 'LinkedIn',    'link' => $_thinkup_meta_teamlinkedin ),
			array( 'social' => 'Instagram',   'link' => $_thinkup_meta_teaminstagram ),
			array( 'social' => 'Dribbble',    'link' => $_thinkup_meta_teamdribbble ),
			array( 'social' => 'Flickr',      'link' => $_thinkup_meta_teamflickr ),
		);
	
		// Output social media links if any link is set
		
			foreach( $social_links as $social ) {	
				if ( ! empty( $social['link'] ) and $j == 0 ) { 
					$output_social .= '<div class="team-social"><ul>'; $j = 1; 
				}
		
				if ( ! empty( $social['link'] ) ) {
					$output_social .= '<li class="social ' . strtolower( $social['social'] ) . '">';
					$output_social .= '<a href="' . esc_url( $social['link'] ) . '">';
					$output_social .= '<i class="fa fa-' . strtolower( $social['social'] ) . '"></i>';
					$output_social .= '</a>';
					$output_social .= '</li>';
				}
			}
	
			// Close list output of social media links if any link is set
			if ( $j == 1 ) { 
				$output_social .= '</ul></div>'; 
			}
	}
}

// Output team button
$output_button .= '<div class="team-button">';
$output_button .= '<a class="themebutton" href="' . esc_url( get_permalink( $recent["ID"] ) ) . '">' . __( 'View Profile', 'consulting' ) . '</a>';
$output_button .= '</div>';

// Output overlay link to team page if set
if ( $show_link !== 'off' ) {
	$output_overlay .= '<div class="image-overlay style2' . $class_overlay . '">';
	$output_overlay .= '<div class="image-overlay-inner">';
	$output_overlay .= '<div class="hover-icons">';
	$output_overlay .= '<a class="themebutton" href="' . esc_url( get_permalink( $id ) ) . '">';
	$output_overlay .= __( 'View Profile', 'consulting' );
	$output_overlay .= '</a>';
	$output_overlay .= '</div>';
	$output_overlay .= '</div>';
	$output_overlay .= '</div>';
}

// Add extra div to align text in center
if ( $center == 'on' ) {
	$center_start = '<div id="' . $instanceID . '">';
	$center_end   = '</div>';
}


	echo $center_start;

	echo '<div class="sc-carousel carousel-team sc-postitem' . $class_style . '">';

	echo '<div class="entry-header"><div class="team-thumb">',
		 '<a href="' . esc_url( get_permalink( $id ) ) . '"><img src="' . esc_url( $output_image ) . '" /></a>',
			$output_overlay,
		 '</div></div>';

	if ( ! empty( $output_name ) or ! empty( $output_position ) or ! empty( $output_excerpt ) or ! empty( $output_social ) ) {

		echo '<div class="entry-content">';

			echo $output_name;
			echo $output_position;
			echo $output_excerpt;
			echo $output_social;
			echo $output_button;

		echo '</div>';

	}

	echo '<div class="clearboth"></div></div>';

	echo $center_end;

//====================================================================
// Output custom styling if set
//====================================================================

if ( $center  == 'on' ) {
	echo '<style>';
		echo '#' . $instanceID . ' { text-align: center; }';
		echo '#' . $instanceID . ' .team-social ul { margin: 0 auto; }';
	echo '</style>';
}

?>