<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up until id="main-core".
 *
 * @package ThinkUpThemes
 */
?><!DOCTYPE html>

<html <?php language_attributes(); ?>>
<head>
<?php thinkup_hook_header(); ?>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width" />
<link rel="profile" href="//gmpg.org/xfn/11" />
<link rel="pingback" href="<?php esc_url( bloginfo( 'pingback_url' ) ); ?>" />

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?><?php thinkup_bodystyle(); ?>>
<?php /* Body hook */ thinkup_hook_bodyhtml(); ?>
<?php /* Notification Bar */ thinkup_input_notification(); ?>
<?php /* Header Image */ thinkup_input_headerimage(); ?>
<div id="body-core" class="hfeed site">

	<header>
	<div id="site-header">

		<?php if ( get_header_image() ) : ?>
		
			<div class="custom-header">
				<a href="/">
					
					<img src="<?php header_image(); ?>" width="<?php echo esc_attr( get_custom_header()->width ); ?>" height="<?php echo esc_attr( get_custom_header()->height ); ?>" alt="Crescent Behavior Consulting logo, with leaves growing naturally from the logo." draggable="false" />
				
				</a>
		
			</div>

		<?php endif; // End header image check. ?>

		<div id="pre-header">
		<div class="wrap-safari">
		<div id="pre-header-core" class="main-navigation">

			<?php /* Pre Header Search */ thinkup_input_preheadersearch(); ?>

			<?php /* Social Media Icons */ thinkup_input_socialmediaheaderpre(); ?>

			<?php if ( has_nav_menu( 'pre_header_menu' ) ) : ?>
			<?php wp_nav_menu( array( 'container_class' => 'header-links', 'container_id' => 'pre-header-links-inner', 'theme_location' => 'pre_header_menu' ) ); ?>
			<?php endif; ?>

		</div>
		</div>
		</div>
		<!-- #pre-header -->

		<?php /* Add header - above slider */ thinkup_input_headerlocationabove(); ?>

		<?php /* Add responsive header menu */ thinkup_input_responsivehtml2_above(); ?>

		<?php /* Add sticky header */ thinkup_input_headersticky(); ?>

		<?php /* Custom Slider */ thinkup_input_sliderhome(); ?>

		<?php /* Custom Intro - Above */ thinkup_custom_introabove(); ?>

		<?php /* Custom Slider */ thinkup_input_sliderpage(); ?>

		<?php /* Add header - above slider */ thinkup_input_headerlocationbelow(); ?>

		<?php /* Add responsive header menu */ thinkup_input_responsivehtml2_below(); ?>

		<?php /* Custom Intro - Below */ thinkup_custom_introbelow(); ?>

	</div>


	</header>
	<!-- header -->

	<?php /*  Call To Action - Intro */ thinkup_input_ctaintro(); ?>
	<?php /*  Pre-Designed HomePage Content */ thinkup_input_homepagesection(); ?>

	<div id="content">
	<div id="content-core">

		<div id="main">
		<div id="main-core">