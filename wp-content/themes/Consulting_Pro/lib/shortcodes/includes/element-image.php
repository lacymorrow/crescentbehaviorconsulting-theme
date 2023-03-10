<?php
$image   = NULL;
$thumb   = NULL;
$title   = NULL;
$details = NULL;

$title_input   = NULL;
$details_input = NULL;

$image   = $atts['image'];
$thumb   = $atts['thumb'];
$title   = $atts['title'];
$details = $atts['details'];


if (!empty($title)) {
	$title_input = ' alt="' . esc_attr( $title ) . '"';
}
if (!empty($details)) {
	$details_input = ' title="' . esc_attr( $details ) . '"';
}
if (empty($thumb)) {
	$thumb = $image;
}

echo	'<div class="sc-lightbox image">',
		'<span><img class="lightbox" src="' . esc_url( $thumb ) . '"' . $title_input . '></span>',
		'<div class="image-overlay style2">',
		'<div class="image-overlay-inner">',
		'<div class="hover-icons"><a class="hover-zoom prettyPhoto" href="' . esc_url( $image ) . '"></a></div>',
		'</div>',
		'</div>',
		'</div>';
?>