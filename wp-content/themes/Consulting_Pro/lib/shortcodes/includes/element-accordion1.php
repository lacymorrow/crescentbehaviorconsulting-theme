<?php
$toggle = NULL;
$input0 = NULL;
$input1 = NULL;
$input2 = NULL;
$increment = NULL;


	echo '<div id="accordion-' . $instanceID . '" class="accordion style1">';

	?><?php foreach((array) $groups['title'] as $increment=>$context){ ?><?php

	$toggle = $context['toggle'];
	$title  = $context['title'];
	$tab    = $context['tab'];

	if ( $toggle == 'on' ) {
		$input0 = ' accordion-open';		
		$input1 = '';		
		$input2 = ' in'; 
	} else {
		$input0 = '';		
		$input1 = ' collapsed';
		$input2 = ''; 
	}

	echo '<div class="accordion-group' . $input0 . '">',
		 '<div class="accordion-heading">',
		 '<a class="accordion-toggle' . $input1 . '" data-toggle="collapse" data-parent="#accordion-' . $instanceID . '" href="#' . $instanceID . '-' . $increment . '">' . $title . '</a>',
		 '</div>',
		 '<div id="' . $instanceID . '-' . $increment . '" class="accordion-body collapse' . $input2 . '">',
		 '<div class="accordion-inner">' . $tab . '</div>',
		 '</div>',
		 '</div>';

		$increment = $increment + 1;
		?><?php } ?><?php
		$increment = NULL;
	echo '</div>';



?>