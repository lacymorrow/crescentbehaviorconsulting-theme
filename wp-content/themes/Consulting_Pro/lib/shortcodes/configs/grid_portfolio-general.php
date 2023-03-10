<?php
/**
*
* fieldconfig for thinkupshortcodes/General
*
* @package Thinkupshortcodes
* @author Think Up Themes Ltd contact@thinkupthemes.com
* @license GPL-2.0+
* @link www.thinkupthemes.com
* @copyright 2018 Think Up Themes Ltd
*/


$group = array(
	'label' => __('General','thinkupshortcodes'),
	'id' => '5139957',
	'master' => 'items',
	'fields' => array(
		'items'	=>	array(
			'label'		=> 	__('Items','thinkupshortcodes'),
			'caption'	=>	__('Number of projects to show','thinkupshortcodes'),
			'type'		=>	'dropdown',
			'default'	=> 	'*2||2,3||3,4||4,5||5,6||6,7||7,8||8,9||9,10||10,11||11,12||12,13||13,14||14,15||15,16||16,17||17,18||18,19||19,20||20,21||21,22||22,23||23,24||24',
		),
		'columns'	=>	array(
			'label'		=> 	__('Columns','thinkupshortcodes'),
			'caption'	=>	__('Number of projects per row','thinkupshortcodes'),
			'type'		=>	'dropdown',
			'default'	=> 	'*2||2,3||3,4||4,5||5,6||6',
		),
		'order'	=>	array(
			'label'		=> 	__('Order','thinkupshortcodes'),
			'caption'	=>	__('Projects order','thinkupshortcodes'),
			'type'		=>	'dropdown',
			'default'	=> 	'*asc||asc,desc||desc',
		),
		'link_icon'	=>	array(
			'label'		=> 	__('Link Icon','thinkupshortcodes'),
			'caption'	=>	__('Show link icon?','thinkupshortcodes'),
			'type'		=>	'onoff',
			'default'	=> 	'*on||on,off||off',
			'inline'	=> 	true,
		),
		'lightbox_icon'	=>	array(
			'label'		=> 	__('Lightbox Icon','thinkupshortcodes'),
			'caption'	=>	__('Show lightbox icon?','thinkupshortcodes'),
			'type'		=>	'onoff',
			'default'	=> 	'*on||on,off||off',
			'inline'	=> 	true,
		),
		'wide'	=>	array(
			'label'		=> 	__('Screen Wide?','thinkupshortcodes'),
			'caption'	=>	__('Only works with Parallax Page Template','thinkupshortcodes'),
			'type'		=>	'onoff',
			'default'	=> 	'on||on,*off||off',
			'inline'	=> 	true,
		),
		'mobile_hide'	=>	array(
			'label'		=> 	__('Mobile Hide?','thinkupshortcodes'),
			'caption'	=>	__('Hide on mobile device?','thinkupshortcodes'),
			'type'		=>	'onoff',
			'default'	=> 	'*yes||yes,no||no',
			'inline'	=> 	true,
		),
		'category'	=>	array(
			'label'		=> 	__('Category','thinkupshortcodes'),
			'caption'	=>	__('Show projects from a specific category.','thinkupshortcodes'),
			'type'		=>	'smalltextfield',
			'default'	=> 	'',
		),
		'animate'	=>	array(
			'label'		=> 	__('Animate','thinkupshortcodes'),
			'caption'	=>	__('Add an animation style.','thinkupshortcodes'),
			'type'		=>	'dropdown',
			'default'	=> 	'*none,bounceIn,bounceInDown,bounceInUp,bounceInLeft,bounceInRight,bounceOut,bounceOutDown,bounceOutUp,bounceOutLeft,bounceOutRight,flipInX,flipOutX,flipInY,flipOutY,fadeIn,fadeInUp,fadeInDown,fadeInLeft,fadeInRight,fadeInUpBig,fadeInDownBig,fadeInLeftBig,fadeInRightBig,fadeOut,fadeOutUp,fadeOutDown,fadeOutLeft,fadeOutRight,fadeOutUpBig,fadeOutDownBig,fadeOutLeftBig,fadeOutRightBig,hinge,lightSpeedIn,lightSpeedOut,rollIn,rollOut,rotateIn,rotateInDownLeft,rotateInDownRight,rotateInUpLeft,rotateInUpRight,rotateOut,rotateOutDownLeft,rotateOutDownRight,rotateOutUpLeft,rotateOutUpRight,slideInDown,slideInLeft,slideInRight,slideOutUp,slideOutLeft,slideOutRight',
		),
		'delay'	=>	array(
			'label'		=> 	__('Delay','thinkupshortcodes'),
			'caption'	=>	__('Add a delay to the animation effect (ms)','thinkupshortcodes'),
			'type'		=>	'smalltextfield',
			'default'	=> 	'',
		),
		'delay_item'	=>	array(
			'label'		=> 	__('Delay (per item)','thinkupshortcodes'),
			'caption'	=>	__('Delay between individual projects (ms)','thinkupshortcodes'),
			'type'		=>	'smalltextfield',
			'default'	=> 	'',
		),
	),
	'styles'	=> array(
		'toggles.css',
	),
	'scripts'	=> array(
		'toggles.min.js',
	),
	'multiple'	=> false,
);

