<?php
$id            = NULL;
$link_icon     = NULL;
$lightbox_icon = NULL;
$title         = NULL;
$details       = NULL;
$style         = NULL;
$size          = NULL;
	
$link_input           = NULL;
$lightbox_input       = NULL;
$overlay_class        = NULL;
$overlay_input        = NULL;
$portfolio_hoverclass = NULL;
$portfolio_styleclass = NULL;

$id            = $atts['id'];
$link_icon     = $atts['link_icon'];
$lightbox_icon = $atts['lightbox_icon'];
$title         = $atts['title'];
$details       = $atts['details'];
$style         = $atts['style'];
$size          = $atts['size'];

if ( empty( $size ) ) $size = 'full';

?>

	<div class="sc-carousel carousel-portfolio sc-postitem">
		<ul class="sc-carousel port-thumb">
			<li class="entry-header">
				<a href="<?php echo esc_url( get_permalink( $id ) ) ?>"><?php thinkup_inputpbitem_portfoliosize( $id, $link_icon, $lightbox_icon, $title, $details, $style, $size ); ?></a><?php
				/* Hover Content */ thinkup_inputpbitem_portfoliohover( $id, $link_icon, $lightbox_icon, $title, $details, $style, $size ); ?>
			</li><div class="clearboth"></div>
		</ul><?php
	/* Title & Tags */ thinkup_inputpbitem_portfoliocontent1( $id, $link_icon, $lightbox_icon, $title, $details, $style, $size ); ?>
	</div>