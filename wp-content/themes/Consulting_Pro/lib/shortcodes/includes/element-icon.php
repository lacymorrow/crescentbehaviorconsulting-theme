<?php
$icon = NULL;

$icon = $atts['icon'];

if ( empty( $icon ) ) {
	$icon = 'No';	
}

echo '<img class="icon iconimage" src="' . esc_url( get_template_directory_uri() ) . '/images/icons/color/' . $icon . '.png" alt="">';


?>