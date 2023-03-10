/**
 * Wordpress Admin Area Enhancements.
 *
 * Theme options are hidden / shown so the user only see's what is required.
 */

/* ----------------------------------------------------------------------------------
	ADD MODAL BOX TO CONFIRM DEMO INSTALLATION
---------------------------------------------------------------------------------- */
jQuery(document).ready(function(){
	(function ( $ ) {
		if ( $.isFunction($.fn.confirm) ) {
			$( '.demo-installer .button-install' ).confirm({
				title:'Demo Install',
				text: '<p>Are you sure you want to install the demo content?</p><p>Installer should only be <strong>run once</strong> and should be on a <strong>fresh installation of WordPress</strong>.</p><p style="margin: 0;"><strong><u>IMPORTANT:</u></strong> Running the installer on a live site can override your existing content.</p>',
				confirmButton: 'Yes I am',
				cancelButton: 'No',
			});
		}
	}( jQuery ));
});


/* ----------------------------------------------------------------------------------
	ADD CLASSES TO MAIN THEME OPTIONS
---------------------------------------------------------------------------------- */
jQuery(document).ready(function(){
	jQuery( 'td fieldset' ).each(function() {
		var mainclass = jQuery(this).attr("id");
		jQuery('fieldset[id='+mainclass+']').closest("tr").attr('id', 'section-' + mainclass );
	});
});


/* ----------------------------------------------------------------------------------
	ADD CLASSES TO META THEME OPTIONS - TICKET #29300
---------------------------------------------------------------------------------- */
jQuery(document).ready(function($){
	$( 'th label' ).each(function() {
		var label = $(this),
		metaclass = label.attr( 'for' );
		if ( metaclass !== '' && metaclass !== undefined ) {
			label.closest( 'tr' ).addClass( metaclass );
		}
	});
});


/* ----------------------------------------------------------------------------------
	HIDE / SHOW BLOG OPTIONS PANEL (PAGE POST TYPE)
---------------------------------------------------------------------------------- */

jQuery(document).ready(function(){

	// Hide / show blog options panel on page load
	if ( jQuery( '#page_template option:selected' ).attr( 'value' ) == 'template-blog.php' ) {
		jQuery( '#thinkup_bloginfo' ).slideDown();
	} else if ( jQuery( '#page_template option:selected' ).attr( 'value' ) != 'template-blog.php' ) {
		jQuery( '#thinkup_bloginfo' ).slideUp();
	}

	jQuery( '#page_template' ).change( function() {

		// Hide / show blog options panel when template option is changed
		if ( jQuery( '#page_template option:selected' ).attr( 'value' ) == 'template-blog.php' ) {
			jQuery( '#thinkup_bloginfo' ).slideDown();
		} else if ( jQuery( '#page_template option:selected' ).attr( 'value' ) != 'template-blog.php' ) {
			jQuery( '#thinkup_bloginfo' ).slideUp();
		}
	});

	// Meta Blog Options - Enable Featured Carousel
	if(jQuery('tr._thinkup_meta_blogstyle input[value=option2]').is(":checked")){
		jQuery('tr._thinkup_meta_blogstyle1layout').show();
	}
	else if(jQuery('tr._thinkup_meta_blogstyle input[value=option2]').not(":checked")){
		jQuery('tr._thinkup_meta_blogstyle1layout').hide();
	}
	if(jQuery('tr._thinkup_meta_blogstyle input[value=option3]').is(":checked")){
		jQuery('tr._thinkup_meta_blogstyle2layout').show();
	}
	else if(jQuery('tr._thinkup_meta_blogstyle input[value=option3]').not(":checked")){
		jQuery('tr._thinkup_meta_blogstyle2layout').hide();
	}

	// Meta Blog Options - Hide / Show Option on Check
	jQuery('tr._thinkup_meta_blogstyle input[type=radio]').change(function() {
		if(jQuery('tr._thinkup_meta_blogstyle input[value=option2]').is(":checked")){
			jQuery('tr._thinkup_meta_blogstyle1layout').show();
		}
		else if(jQuery('tr._thinkup_meta_blogstyle input[value=option2]').not(":checked")){
			jQuery('tr._thinkup_meta_blogstyle1layout').hide();
		}
		if(jQuery('tr._thinkup_meta_blogstyle input[value=option3]').is(":checked")){
			jQuery('tr._thinkup_meta_blogstyle2layout').show();
		}
		else if(jQuery('tr._thinkup_meta_blogstyle input[value=option3]').not(":checked")){
			jQuery('tr._thinkup_meta_blogstyle2layout').hide();
		}
	});
});


/* ----------------------------------------------------------------------------------
	HIDE / SHOW PORTFOLIO OPTIONS PANEL (PAGE POST TYPE)
---------------------------------------------------------------------------------- */

jQuery(document).ready(function(){

	// Hide / show portfolio options panel on page load
	if ( jQuery( '#page_template option:selected' ).attr( 'value' ) == 'template-portfolio.php' ) {
		jQuery( '#thinkup_portfolioinfo' ).slideDown();
	} else if ( jQuery( '#page_template option:selected' ).attr( 'value' ) != 'template-portfolio.php' ) {
		jQuery( '#thinkup_portfolioinfo' ).slideUp();
	}

	jQuery( '#page_template' ).change( function() {

		// Hide / show portfolio options panel when template option is changed
		if ( jQuery( '#page_template option:selected' ).attr( 'value' ) == 'template-portfolio.php' ) {
			jQuery( '#thinkup_portfolioinfo' ).slideDown();
		} else if ( jQuery( '#page_template option:selected' ).attr( 'value' ) != 'template-portfolio.php' ) {
			jQuery( '#thinkup_portfolioinfo' ).slideUp();
		}
	});

	// Meta Portfolio Options - Enable Slider
	if(jQuery('tr._thinkup_meta_portfoliosliderswitch input').is(":checked")){
		jQuery('tr._thinkup_meta_portfolioslidercategory').show();
		jQuery('tr._thinkup_meta_portfoliosliderheight').show();
	}
	else if(jQuery('tr._thinkup_meta_portfoliosliderswitch input').not(":checked")){
		jQuery('tr._thinkup_meta_portfolioslidercategory').hide();
		jQuery('tr._thinkup_meta_portfoliosliderheight').hide();
	}

	// Meta Portfolio Options - Enable Featured Carousel
	if(jQuery('tr._thinkup_meta_portfoliofeaturedswitch input').is(":checked")){
		jQuery('tr._thinkup_meta_portfoliofeaturedcategory').show();
		jQuery('tr._thinkup_meta_portfoliofeatureditems').show();
		jQuery('tr._thinkup_meta_portfoliofeaturedscroll').show();
	}
	else if(jQuery('tr._thinkup_meta_portfoliofeaturedswitch input').not(":checked")){
		jQuery('tr._thinkup_meta_portfoliofeaturedcategory').hide();
		jQuery('tr._thinkup_meta_portfoliofeatureditems').hide();
		jQuery('tr._thinkup_meta_portfoliofeaturedscroll').hide();
	}

	// Meta Portfolio Options - Hide / Show Option on Check
	jQuery('input[type=checkbox]').change(function() {

		// Slider
		if(jQuery('tr._thinkup_meta_portfoliosliderswitch input').is(":checked")){
			jQuery('tr._thinkup_meta_portfolioslidercategory').fadeIn();
			jQuery('tr._thinkup_meta_portfoliosliderheight').fadeIn();
		}
		else if(jQuery('tr._thinkup_meta_portfoliosliderswitch input').not(":checked")){
			jQuery('tr._thinkup_meta_portfolioslidercategory').fadeOut();
			jQuery('tr._thinkup_meta_portfoliosliderheight').fadeOut();
		}

		// Featured Carousel
		if(jQuery('tr._thinkup_meta_portfoliofeaturedswitch input').is(":checked")){
			jQuery('tr._thinkup_meta_portfoliofeaturedcategory').fadeIn();
			jQuery('tr._thinkup_meta_portfoliofeatureditems').fadeIn();
			jQuery('tr._thinkup_meta_portfoliofeaturedscroll').fadeIn();
		}
		else if(jQuery('tr._thinkup_meta_portfoliofeaturedswitch input').not(":checked")){
			jQuery('tr._thinkup_meta_portfoliofeaturedcategory').fadeOut();
			jQuery('tr._thinkup_meta_portfoliofeatureditems').fadeOut();
			jQuery('tr._thinkup_meta_portfoliofeaturedscroll').fadeOut();
		}

	});
});


/* ----------------------------------------------------------------------------------
	HIDE / SHOW TEAM OPTIONS PANEL (PAGE POST TYPE)
---------------------------------------------------------------------------------- */

jQuery(document).ready(function(){

	// Hide / show Team options panel on page load
	if ( jQuery( '#page_template option:selected' ).attr( 'value' ) == 'template-team.php' ) {
		jQuery( '#thinkup_teamsettings' ).slideDown();
	} else if ( jQuery( '#page_template option:selected' ).attr( 'value' ) != 'template-team.php' ) {
		jQuery( '#thinkup_teamsettings' ).slideUp();
	}

	jQuery( '#page_template' ).change( function() {

		// Hide / show Team options panel when template option is changed
		if ( jQuery( '#page_template option:selected' ).attr( 'value' ) == 'template-team.php' ) {
			jQuery( '#thinkup_teamsettings' ).slideDown();
		} else if ( jQuery( '#page_template option:selected' ).attr( 'value' ) != 'template-team.php' ) {
			jQuery( '#thinkup_teamsettings' ).slideUp();
		}
	});

	// Meta Team Options - Grid Layout
	if(jQuery('tr._thinkup_meta_teamstyleswitch input[value=option1]').is(":checked")){
		jQuery('tr._thinkup_meta_teamlayout').hide();
	} else if(jQuery('tr._thinkup_meta_teamstyleswitch input[value=option1]').not(":checked")){
		jQuery('tr._thinkup_meta_teamlayout').show();
	}
	
	// Meta Portfolio Options - Hide / Show Option on radio change
	jQuery('input[type=radio]').change(function() {

		if(jQuery('tr._thinkup_meta_teamstyleswitch input[value=option1]').is(":checked")){
			jQuery('tr._thinkup_meta_teamlayout').fadeOut('slow');
		} else if(jQuery('tr._thinkup_meta_teamstyleswitch input[value=option1]').not(":checked")){
			jQuery('tr._thinkup_meta_teamlayout').fadeIn('slow');
		}
	});
});


/* ----------------------------------------------------------------------------------
	HIDE / SHOW TESTIMONIAL OPTIONS PANEL (PAGE POST TYPE)
---------------------------------------------------------------------------------- */

jQuery(document).ready(function(){

	// Hide / show Testimonial options panel on page load
	if ( jQuery( '#page_template option:selected' ).attr( 'value' ) == 'template-testimonial.php' ) {
		jQuery( '#thinkup_testimonialsettings' ).slideDown();
	} else if ( jQuery( '#page_template option:selected' ).attr( 'value' ) != 'template-testimonial.php' ) {
		jQuery( '#thinkup_testimonialsettings' ).slideUp();
	}

	jQuery( '#page_template' ).change( function() {

		// Hide / show Testimonial options panel when template option is changed
		if ( jQuery( '#page_template option:selected' ).attr( 'value' ) == 'template-testimonial.php' ) {
			jQuery( '#thinkup_testimonialsettings' ).slideDown();
		} else if ( jQuery( '#page_template option:selected' ).attr( 'value' ) != 'template-testimonial.php' ) {
			jQuery( '#thinkup_testimonialsettings' ).slideUp();
		}
	});
});


/* ----------------------------------------------------------------------------------
	HIDE / SHOW POST TYPE SPECIFIC OPTIONS PANEL
---------------------------------------------------------------------------------- */

jQuery(document).ready(function(){

	// Blog Post - Enable Author Bio
	if( jQuery( 'body' ).hasClass( 'post-type-post' ) ) {
		jQuery( 'tr._thinkup_meta_authorbio' ).show();
	} else {
		jQuery( 'tr._thinkup_meta_authorbio' ).hide();
	}

});


/* ----------------------------------------------------------------------------------
	HIDE / SHOW OPTIONS ON PAGE LOAD
---------------------------------------------------------------------------------- */
jQuery(document).ready(function(){

	// Meta General Page Options - Header Float & Overflow
	if( jQuery('tr._thinkup_meta_headerstyle input[value=option2]').is(":checked") ){
		jQuery('tr._thinkup_meta_headerfloat').show();
		jQuery('tr._thinkup_meta_headerlogooverflow').show();
	}
	else if( jQuery('tr._thinkup_meta_headerstyle input[value=option2]').not(":checked") ){
		jQuery('tr._thinkup_meta_headerfloat').hide();
		jQuery('tr._thinkup_meta_headerlogooverflow').hide();
	}

	// Meta General Page Options - Header Position
	if( jQuery('tr._thinkup_meta_headerstyle input[value=option3]').is(":checked") ){
		jQuery('tr._thinkup_meta_headerlocation').show();
	}
	else if( jQuery('tr._thinkup_meta_headerstyle input[value=option3]').not(":checked") ){
		jQuery('tr._thinkup_meta_headerlocation').hide();
	}

	// Meta General Page Options - Page Intro
	if( jQuery('tr._thinkup_meta_intro input[value=option2]').is(":checked") ){
		jQuery('tr._thinkup_meta_introbackgroundcolor').show();
		jQuery('tr._thinkup_meta_introbackgroundimage').show();
	}
	else if( jQuery('tr._thinkup_meta_intro input[value=option2]').not(":checked") ){
		jQuery('tr._thinkup_meta_introbackgroundcolor').hide();
		jQuery('tr._thinkup_meta_introbackgroundimage').hide();
	}

	// Meta General Page Options - Enable Slider
	if(jQuery('tr._thinkup_meta_slider input').is(":checked")){
		jQuery('tr._thinkup_meta_slidername').show();
	}
	else if(jQuery('tr._thinkup_meta_slider input').not(":checked")){
		jQuery('tr._thinkup_meta_slidername').hide();
	}

	// Meta General Page Options - Page Layout (Options 3 & 4)
	if(jQuery('tr._thinkup_meta_layout input[value=option3]').is(":checked") || jQuery('tr._thinkup_meta_layout input[value=option4]').is(":checked")){
		jQuery('tr._thinkup_meta_sidebars').show();
	}
	else if(jQuery('tr._thinkup_meta_layout input[value=option3]').not(":checked") || jQuery('tr._thinkup_meta_layout input[value=option4]').not(":checked")){
		jQuery('tr._thinkup_meta_sidebars').hide();
	}
});


/* ----------------------------------------------------------------------------------
	HIDE / SHOW OPTIONS ON RADIO CLICK
---------------------------------------------------------------------------------- */
jQuery(document).ready(function(){
	jQuery('input[type=radio]').change(function() {

		// Meta General Page Options - Header Float & Overflow
		if( jQuery('tr._thinkup_meta_headerstyle input[value=option2]').is(":checked") ){
			jQuery('tr._thinkup_meta_headerfloat').fadeIn();
			jQuery('tr._thinkup_meta_headerlogooverflow').fadeIn();
		}
		else if( jQuery('tr._thinkup_meta_headerstyle input[value=option2]').not(":checked") ){
			jQuery('tr._thinkup_meta_headerfloat').fadeOut();
			jQuery('tr._thinkup_meta_headerlogooverflow').fadeOut();
		}

		// Meta General Page Options - Header Position
		if( jQuery('tr._thinkup_meta_headerstyle input[value=option3]').is(":checked") ){
			jQuery('tr._thinkup_meta_headerlocation').fadeIn();
		}
		else if( jQuery('tr._thinkup_meta_headerstyle input[value=option3]').not(":checked") ){
			jQuery('tr._thinkup_meta_headerlocation').fadeOut();
		}

		// Meta General Page Options - Page Intro
		if( jQuery('tr._thinkup_meta_intro input[value=option2]').is(":checked") ){
			jQuery('tr._thinkup_meta_introbackgroundcolor').fadeIn();
			jQuery('tr._thinkup_meta_introbackgroundimage').fadeIn();
		}
		else if( jQuery('tr._thinkup_meta_intro input[value=option2]').not(":checked") ){
			jQuery('tr._thinkup_meta_introbackgroundcolor').fadeOut();
			jQuery('tr._thinkup_meta_introbackgroundimage').fadeOut();
		}

		/* Meta General Page Options - Page Layout (Options 3 & 4) */
		if(jQuery('tr._thinkup_meta_layout input[value=option3]').is(":checked") || jQuery('tr._thinkup_meta_layout input[value=option4]').is(":checked")){
			jQuery('tr._thinkup_meta_sidebars').fadeIn();
		}
		else if(jQuery('tr._thinkup_meta_layout input[value=option3]').not(":checked") || jQuery('tr._thinkup_meta_layout input[value=option4]').not(":checked")){
			jQuery('tr._thinkup_meta_sidebars').fadeOut();
		}
	});
});


/* ----------------------------------------------------------------------------------
	HIDE / SHOW OPTIONS ON CHECKBOX CLICK
---------------------------------------------------------------------------------- */
jQuery(document).ready(function(){
	jQuery('input[type=checkbox]').change(function() {

		/* Meta General Page Options - Enable Slider */
		if(jQuery('tr._thinkup_meta_slider input').is(":checked")){
			jQuery('tr._thinkup_meta_slidername').show();
		}
		else if(jQuery('tr._thinkup_meta_slider input').not(":checked")){
			jQuery('tr._thinkup_meta_slidername').hide();
		}
	});
});


/* ----------------------------------------------------------------------------------
	HIDE / SHOW OPTIONS ON SIDEBAR IMAGE CLICK - MAIN OPTIONS PANEL
---------------------------------------------------------------------------------- */
jQuery(document).ready(function(){
	jQuery('input[type=radio]').change(function() {
		// Add relevant code if needed
	});
});