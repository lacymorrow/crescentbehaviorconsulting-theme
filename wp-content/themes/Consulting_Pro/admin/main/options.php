<?php
    /**
     * ReduxFramework Sample Config File
     * For full documentation, please visit: http://docs.reduxframework.com/
     */

    if ( ! class_exists( 'Redux' ) ) {
        return;
    }


    // This is your option name where all the Redux data is stored.
    $opt_name = "thinkup_redux_variables";

    // This line is adding in extensions.
//    Redux::setExtensions( $opt_name, dirname(__FILE__).'/../main-extensions');

    /*
     *
     * --> Used within different fields. Simply examples. Search for ACTUAL DECLARATION for field examples
     *
     */

    $sampleHTML = '';
    if ( file_exists( dirname( __FILE__ ) . '/info-html.html' ) ) {
        Redux_Functions::initWpFilesystem();

        global $wp_filesystem;

        $sampleHTML = $wp_filesystem->get_contents( dirname( __FILE__ ) . '/info-html.html' );
    }

    // Background Patterns Reader
    $sample_patterns_path = ReduxFramework::$_dir . '../sample/patterns/';
    $sample_patterns_url  = ReduxFramework::$_url . '../sample/patterns/';
    $sample_patterns      = array();

    if ( is_dir( $sample_patterns_path ) ) {

        if ( $sample_patterns_dir = opendir( $sample_patterns_path ) ) {
            $sample_patterns = array();

            while ( ( $sample_patterns_file = readdir( $sample_patterns_dir ) ) !== false ) {

                if ( stristr( $sample_patterns_file, '.png' ) !== false || stristr( $sample_patterns_file, '.jpg' ) !== false ) {
                    $name              = explode( '.', $sample_patterns_file );
                    $name              = str_replace( '.' . end( $name ), '', $sample_patterns_file );
                    $sample_patterns[] = array(
                        'alt' => $name,
                        'img' => $sample_patterns_url . $sample_patterns_file
                    );
                }
            }
        }
    }

    /**
     * ---> SET ARGUMENTS
     * All the possible arguments for Redux.
     * For full documentation on arguments, please refer to: https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments
     * */

    $theme = wp_get_theme(); // For use with some settings. Not necessary.

    $args = array(
        // TYPICAL -> Change these values as you need/desire
        'opt_name'             => $opt_name,
        // This is where your data is stored in the database and also becomes your global variable name.
        'display_name'         => $theme->get( 'Name' ),
        // Name that appears at the top of your panel
        'display_version'      => $theme->get( 'Version' ),
        // Version that appears at the top of your panel
        'menu_type'            => 'menu',
        //Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
        'allow_sub_menu'       => false,
        // Show the sections below the admin menu item or not
        'menu_title'           => __( 'Theme Options', 'consulting' ),
        'page_title'           => __( 'Theme Options', 'consulting' ),
        // You will need to generate a Google API key to use this feature.
        // Please visit: https://developers.google.com/fonts/docs/developer_api#Auth
        'google_api_key'       => '',
        // Set it you want google fonts to update weekly. A google_api_key value is required.
        'google_update_weekly' => false,
        // Must be defined to add google fonts to the typography module
        'async_typography'     => false,
        // Use a asynchronous font on the front end or font string
        //'disable_google_fonts_link' => true,                    // Disable this in case you want to create your own google fonts loader
        'admin_bar'            => true,
        // Show the panel pages on the admin bar
        'admin_bar_icon'       => 'dashicons-portfolio',
        // Choose an icon for the admin bar menu
        'admin_bar_priority'   => 50,
        // Choose an priority for the admin bar menu
        'global_variable'      => '',
        // Set a different name for your global variable other than the opt_name
        'dev_mode'             => false,
        // Show the time the page took to load, etc
        'update_notice'        => false,
        // If dev_mode is enabled, will notify developer of updated versions available in the GitHub Repo
        'customizer_only'      => false,
        'customizer'           => true,
        // Enable basic customizer support
        //'open_expanded'     => true,                    // Allow you to start the panel in an expanded way initially.
        //'disable_save_warn' => true,                    // Disable the save warning when a user changes a field

        // OPTIONAL -> Give you extra features
        'page_priority'        => null,
        // Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
        'page_parent'          => 'themes.php',
        // For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
        'page_permissions'     => 'manage_options',
        // Permissions needed to access the options panel.
        'menu_icon'            => '',
        // Specify a custom URL to an icon
        'last_tab'             => '',
        // Force your panel to always open to a specific tab (by id)
        'page_icon'            => 'icon-themes',
        // Icon displayed in the admin panel next to your menu_title
        'page_slug'            => '',
        // Page slug used to denote the panel, will be based off page title then menu title then opt_name if not provided
        'save_defaults'        => false,
        // On load save the defaults to DB before user clicks save or not
        'default_show'         => false,
        // If true, shows the default value next to each field that is not the default value.
        'default_mark'         => '',
        // What to print by the field's title if the value shown is default. Suggested: *
        'show_import_export'   => true,
        // Shows the Import/Export panel when not used as a field.

        // CAREFUL -> These options are for advanced use only
        'transient_time'       => 60 * MINUTE_IN_SECONDS,
        'output'               => true,
        // Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
        'output_tag'           => true,
        // Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head
        // 'footer_credit'     => '',                   // Disable the footer credit of Redux. Please leave if you can help it.

        // FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
        'database'             => '',
        // possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
        'use_cdn'              => true,
        // If you prefer not to use the CDN for Select2, Ace Editor, and others, you may download the Redux Vendor Support plugin yourself and run locally or embed it in your code.

        // HINTS
        'hints'                => array(
            'icon'          => 'el el-question-sign',
            'icon_position' => 'right',
            'icon_color'    => 'lightgray',
            'icon_size'     => 'normal',
            'tip_style'     => array(
                'color'   => 'red',
                'shadow'  => true,
                'rounded' => false,
                'style'   => '',
            ),
            'tip_position'  => array(
                'my' => 'top left',
                'at' => 'bottom right',
            ),
            'tip_effect'    => array(
                'show' => array(
                    'effect'   => 'slide',
                    'duration' => '500',
                    'event'    => 'mouseover',
                ),
                'hide' => array(
                    'effect'   => 'slide',
                    'duration' => '500',
                    'event'    => 'click mouseleave',
                ),
            ),
        )
    );

    // ADMIN BAR LINKS -> Setup custom links in the admin bar menu as external items.
//    $args['admin_bar_links'][] = array(
//        'id'    => 'redux-docs',
//        'href'  => 'http://docs.reduxframework.com/',
//        'title' => __( 'Documentation', 'consulting' ),
//    );

//    $args['admin_bar_links'][] = array(
//        //'id'    => 'redux-support',
//        'href'  => 'https://github.com/ReduxFramework/redux-framework/issues',
//        'title' => __( 'Support', 'consulting' ),
//    );

//    $args['admin_bar_links'][] = array(
//        'id'    => 'redux-extensions',
//        'href'  => 'reduxframework.com/extensions',
//        'title' => __( 'Extensions', 'consulting' ),
//    );

    // SOCIAL ICONS -> Setup custom links in the footer for quick links in your panel footer icons.
//    $args['share_icons'][] = array(
//        'url'   => 'https://github.com/',
//        'title' => 'Visit us on GitHub',
//        'icon'  => 'el el-github'
//        //'img'   => '', // You can use icon OR img. IMG needs to be a full URL.
//    );
    $args['share_icons'][] = array(
        'url'   => 'https://www.facebook.com/thinkupthemes',
        'title' => 'Like us on Facebook',
        'icon'  => 'el el-facebook'
    );
    $args['share_icons'][] = array(
        'url'   => 'http://www.twitter.com/thinkupthemes',
        'title' => 'Follow us on Twitter',
        'icon'  => 'el el-twitter'
    );
//    $args['share_icons'][] = array(
//        'url'   => 'http://www.linkedin.com/',
//        'title' => 'Find us on LinkedIn',
//        'icon'  => 'el el-linkedin'
//    );

    // Panel Intro text -> before the form
    if ( ! isset( $args['global_variable'] ) || $args['global_variable'] !== false ) {
        if ( ! empty( $args['global_variable'] ) ) {
            $v = $args['global_variable'];
        } else {
            $v = str_replace( '-', '_', $args['opt_name'] );
        }
//        $args['intro_text'] = sprintf( __( '<p>Did you know that Redux sets a global variable for you? To access any of your saved options from within your code you can use your global variable: <strong>$%1$s</strong></p>', 'consulting' ), $v );
    } else {
//        $args['intro_text'] = __( '<p>This text is displayed above the options panel. It isn\'t required, but more info is always better! The intro_text field accepts all HTML.</p>', 'consulting' );
    }

    // Add content after the form.
//    $args['footer_text'] = __( '<p>This text is displayed below the options panel. It isn\'t required, but more info is always better! The footer_text field accepts all HTML.</p>', 'consulting' );

    Redux::setArgs( $opt_name, $args );

    /*
     * ---> END ARGUMENTS
     */


    /*
     * ---> START HELP TABS
     */

//    $tabs = array(
//        array(
//            'id'      => 'redux-help-tab-1',
//            'title'   => __( 'Theme Information 1', 'consulting' ),
//            'content' => __( '<p>This is the tab content, HTML is allowed.</p>', 'consulting' )
//        ),
//        array(
//            'id'      => 'redux-help-tab-2',
//            'title'   => __( 'Theme Information 2', 'consulting' ),
//            'content' => __( '<p>This is the tab content, HTML is allowed.</p>', 'consulting' )
//        )
//    );
//    Redux::setHelpTab( $opt_name, $tabs );

    // Set the help sidebar
//    $content = __( '<p>This is the sidebar content, HTML is allowed.</p>', 'consulting' );
//    Redux::setHelpSidebar( $opt_name, $content );


    /*
     * <--- END HELP TABS
     */


    /*
     *
     * ---> START SECTIONS
     *
     */

    /*

        As of Redux 3.5+, there is an extensive API. This API can be used in a mix/match mode allowing for


     */

	// -----------------------------------------------------------------------------------
	//	0.	Customizer - Set subsections
	// -----------------------------------------------------------------------------------

	if ( is_customize_preview() ) {

		// Change subtitle text in customizer / options panel
		$thinkup_subtitle_customizer   = 'subtitle';
		$thinkup_subtitle_panel        = NULL;

		// Change section field used in customizer / options panel
		$thinkup_section_field         = 'thinkup_section';

		// Enable sub-sections in customizer
		$thinkup_customizer_subsection = true;

		Redux::setSection( $opt_name, array(
			'title'            => __( 'Theme Options', 'consulting' ),
			'id'               => 'thinkup_theme_options',
			'desc'             => __( 'Use the options below to customize your theme!', 'consulting' ),
			'customizer_width' => '400px',
			'icon'             => 'el el-home',
			'customizer'       => true,
		) );

	} else {

		// Disable sub-sections in theme options panel
		$thinkup_customizer_subsection = false;

		// Change subtitle text in customizer / options panel
		$thinkup_subtitle_customizer   = NULL;
		$thinkup_subtitle_panel        = 'subtitle';

		// Change section field used in customizer / options panel
		$thinkup_section_field         = 'section';

	}
	

	// -----------------------------------------------------------------------------------
	//	1.	General Settings
	// -----------------------------------------------------------------------------------

	Redux::setSection( $opt_name, array(
		'title'      => __('General Settings', 'consulting'),
		'header'     => __('Welcome to the Simple Options Framework Demo', 'consulting'),
		'desc'       => __('<span class="redux-title">Logo & Favicon Settings</span>', 'consulting'),
		'icon_class' => '',
		'icon'       => 'el el-wrench',
        'subsection' => $thinkup_customizer_subsection,
        'customizer' => true,
		'fields'     => array(

			array(
				'title'                      => __('Enable Theme Logo Settings', 'consulting'), 
				$thinkup_subtitle_panel      => __('Switch on to control logo settings from theme options panel. Leave off to control using antive WP options', 'consulting'),
				$thinkup_subtitle_customizer => __('Switch on to control logo settings from theme options panel. Leave off to control using antive WP options', 'consulting'),
				'id'                         => 'thinkup_general_logosetting',
				'type'                       => 'switch',
			),

			array(
				'title'                      => __('Logo Settings', 'consulting'), 
				$thinkup_subtitle_panel      => __('If you have an image logo you can upload it, otherwise you can display a text site title', 'consulting'),
				$thinkup_subtitle_customizer => __('If you have an image logo you can upload it, otherwise you can display a text site title', 'consulting'),
				'id'                         => 'thinkup_general_logoswitch',
				'type'                       => 'radio',
				'options'                    => array( 
					'option1' => 'Custom Image Logo', 
					'option2' => 'Display Site Title',
				),
				'default'                    => '' 
			),

			array(
				'title'                      => __('Custom Image Logo', 'consulting'),
				$thinkup_subtitle_panel      => __('Upload image logo or specify the image url.<br />Name the logo image logo.png.', 'consulting'),
				$thinkup_subtitle_customizer => __('Upload image logo or specify the image url.<br />Name the logo image logo.png.', 'consulting'),
				'id'                         => 'thinkup_general_logolink',
				'type'                       => 'media',
				'url'                        => true,
				'required'                   => array( 
					array( 'thinkup_general_logoswitch', '=', 
						array( 'option1' ),
					), 
				)
			),

			array(
				'title'                      => __('Custom Image Logo (Retina display)', 'consulting'),
				$thinkup_subtitle_panel      => __('Upload a logo image twice the size of logo.png. Name the logo image logo@2x.png.', 'consulting'),
				$thinkup_subtitle_customizer => __('Upload a logo image twice the size of logo.png. Name the logo image logo@2x.png.', 'consulting'),
				'id'                         => 'thinkup_general_logolinkretina',
				'type'                       => 'media',
				'url'                        => true,
				'required'                   => array( 
					array( 'thinkup_general_logoswitch', '=', 
						array( 'option1' ),
					), 
				)
			),

			array(
				'title'                      => __('Custom Image Logo (Sticky header)', 'consulting'),
				$thinkup_subtitle_panel      => __('Upload a logo to use in the sticky header.<br />Leave empty to use default logo set above.', 'consulting'),
				$thinkup_subtitle_customizer => __('Upload a logo to use in the sticky header.<br />Leave empty to use default logo set above.', 'consulting'),
				'id'                         => 'thinkup_general_logolinksticky',
				'type'                       => 'media',
				'url'                        => true,
				'required'                   => array( 
					array( 'thinkup_general_logoswitch', '=', 
						array( 'option1' ),
					), 
				)
			),

			array(
				'title'                      => __('Site Title', 'consulting'),
				$thinkup_subtitle_panel      => __('Input a message to display as your site title. Leave blank to display your default site title.', 'consulting'),
				$thinkup_subtitle_customizer => __('Input a message to display as your site title. Leave blank to display your default site title.', 'consulting'),
				'id'                         => 'thinkup_general_sitetitle',
				'type'                       => 'text',
				'validate'                   => 'html',
				'required'                   => array( 
					array( 'thinkup_general_logoswitch', '=', 
						array( 'option2' ),
					), 
				)
			),

			array(
				'title'                      => __('Site Description', 'consulting'),
				$thinkup_subtitle_panel      => __('Input a message to display as site description. Leave blank to display default site description.', 'consulting'),
				$thinkup_subtitle_customizer => __('Input a message to display as site description. Leave blank to display default site description.', 'consulting'),
				'id'                         => 'thinkup_general_sitedescription',
				'type'                       => 'text',
				'validate'                   => 'html',
				'required'                   => array( 
					array( 'thinkup_general_logoswitch', '=', 
						array( 'option2' ),
					), 
				)
			),

			array(
				'title'                      => __('Custom Favicon', 'consulting'),
				$thinkup_subtitle_panel      => __('Uploads favicon or specify the favicon url.', 'consulting'),
				$thinkup_subtitle_customizer => __('Uploads favicon or specify the favicon url.', 'consulting'),
				'id'                         => 'thinkup_general_faviconlink',
				'type'                       => 'media',
				'url'                        => true,
			),

            array(
                'id'       => 'thinkup_section_general_page',
                'type'     => $thinkup_section_field,
                'title'    => __( ' ', 'consulting' ),
                'subtitle' => __( '<span class="redux-title">Page Structure</span>', 'consulting' ),
                'indent'   => false,
            ),

			array(
				'title'                      => __('Page Layout', 'consulting'), 
				$thinkup_subtitle_panel      => __('Select page layout. This will only be applied to published Pages (I.e. Not posts, blog or home).', 'consulting'),
				$thinkup_subtitle_customizer => __('Select page layout. This will only be applied to published Pages (I.e. Not posts, blog or home).', 'consulting'),
				'id'                         => 'thinkup_general_layout',
				'type'                       => 'image_select',
				'compiler'                   => true,
				'default'                    => '0',
				'options'                    => array(
					'option1' => trailingslashit( get_template_directory_uri() ) . 'admin/main/assets/img/layout/blog/option01.png',
					'option2' => trailingslashit( get_template_directory_uri() ) . 'admin/main/assets/img/layout/blog/option02.png',
					'option3' => trailingslashit( get_template_directory_uri() ) . 'admin/main/assets/img/layout/blog/option03.png',
				),
			),

			array(
				'title'                      => __('Select a Sidebar', 'consulting'), 
				$thinkup_subtitle_panel      => __('Choose a sidebar to use with the page layout.', 'consulting'),
				$thinkup_subtitle_customizer => __('Choose a sidebar to use with the page layout.', 'consulting'),
				'id'                         => 'thinkup_general_sidebars',
				'type'                       => 'select',
				'data'                       => 'sidebars',
				'required'                   => array( 
					array( 'thinkup_general_layout', '=', 
						array( 'option2', 'option3' ),
					), 
				)
			),

			array(
				'title'                      => __('Enable Fixed Layout', 'consulting'), 
				$thinkup_subtitle_panel      => __('Check to enable fixed layout.<br />(i.e. Disable responsive layout)', 'consulting'),
				$thinkup_subtitle_customizer => __('Check to enable fixed layout.<br />(i.e. Disable responsive layout)', 'consulting'),
				'id'                         => 'thinkup_general_fixedlayoutswitch',
				'type'                       => 'switch',
			),

			array(
				'title'                      => __('Enable Boxed Layout', 'consulting'), 
				$thinkup_subtitle_panel      => __('Switch on to enable boxed layout.', 'consulting'),
				$thinkup_subtitle_customizer => __('Switch on to enable boxed layout.', 'consulting'),
				'id'                         => 'thinkup_general_boxlayout',
				'type'                       => 'switch',
			),

			array(
				'title'                      => __('Background Color For Boxed Layout', 'consulting'), 
				$thinkup_subtitle_panel      => __('Select a custom color to use as background.', 'consulting'),
				$thinkup_subtitle_customizer => __('Select a custom color to use as background.', 'consulting'),
				'id'                         => 'thinkup_general_boxbackgroundcolor',
				'type'                       => 'color',
				'validate'                   => 'color',
				'default'                    => '#F1F1F1',
				'required'                   => array( 
					array( 'thinkup_general_boxlayout', '=', 
						array( '1' ),
					), 
				)
			),

			array(
				'title'                      => __('Background Image For Boxed Layout', 'consulting'),
				$thinkup_subtitle_panel      => __('Upload an image to use as background.<br />Leave blank to use custom color.', 'consulting'),
				$thinkup_subtitle_customizer => __('Upload an image to use as background.<br />Leave blank to use custom color.', 'consulting'),
				'id'                         => 'thinkup_general_boxbackgroundimage',
				'type'                       => 'media',
				'url'                        => true,
				'required'                   => array( 
					array( 'thinkup_general_boxlayout', '=', 
						array( '1' ),
					), 
				)
			),

			array(
				$thinkup_subtitle_panel      => __('Background Position. Find out more <a href="http://www.w3schools.com/cssref/pr_background-position.asp">here</a>.', 'consulting'),
				$thinkup_subtitle_customizer => __('Background Position. Find out more <a href="http://www.w3schools.com/cssref/pr_background-position.asp">here</a>.', 'consulting'),
				'id'                         => 'thinkup_general_boxedposition',
				'type'                       => 'select',
				'options'                    => array( 
					'left top'      => 'left top',
					'left center'   => 'left center',
					'left bottom'   => 'left bottom',
					'right top'     => 'right top',
					'right center'  => 'right center',
					'right bottom'  => 'right bottom',
					'center top'    => 'center top',
					'center center' => 'center center',
					'center bottom' => 'center bottom'
				),
				'required'                   => array( 
					array( 'thinkup_general_boxlayout', '=', 
						array( '1' ),
					), 
				)
			),

			array(
				$thinkup_subtitle_panel      => __('Background Repeat. Find out more <a href="http://www.w3schools.com/cssref/pr_background-repeat.asp">here</a>.', 'consulting'),
				$thinkup_subtitle_customizer => __('Background Repeat. Find out more <a href="http://www.w3schools.com/cssref/pr_background-repeat.asp">here</a>.', 'consulting'),
				'id'                         => 'thinkup_general_boxedrepeat',
				'type'                       => 'select',
				'options'                    => array( 
					"repeat"    => "repeat",
					"repeat-x"  => "repeat-x",
					"repeat-y"  => "repeat-y",
					"no-repeat" => "no-repeat"
				),
				'required'                   => array( 
					array( 'thinkup_general_boxlayout', '=', 
						array( '1' ),
					), 
				)
			),

			array(
				$thinkup_subtitle_panel      => __('Background Size? Find out more <a href="http://www.w3schools.com/cssref/css3_pr_background-size.asp">here</a>.', 'consulting'),
				$thinkup_subtitle_customizer => __('Background Size? Find out more <a href="http://www.w3schools.com/cssref/css3_pr_background-size.asp">here</a>.', 'consulting'),
				'id'                         => 'thinkup_general_boxedsize',
				'type'                       => 'select',
				'options'                    => array( 
					"auto"      => "auto",
					"cover"     => "cover",
					"constrain" => "constrain"
				),
				'required'                   => array( 
					array( 'thinkup_general_boxlayout', '=', 
						array( '1' ),
					), 
				)
			),

			array(
				$thinkup_subtitle_panel      => __('Fix background or scroll? Find out more <a href="http://www.w3schools.com/cssref/pr_background-attachment.asp">here</a>.', 'consulting'),
				$thinkup_subtitle_customizer => __('Fix background or scroll? Find out more <a href="http://www.w3schools.com/cssref/pr_background-attachment.asp">here</a>.', 'consulting'),
				'id'                         => 'thinkup_general_boxedattachment',
				'type'                       => 'select',
				'options'                    => array( 
					"scroll" => "scroll",
					"fixed"  => "fixed"
				),
				'required'                   => array( 
					array( 'thinkup_general_boxlayout', '=', 
						array( '1' ),
					), 
				)
			),

			array(
				'title'                      => __('Enable Intro', 'consulting'), 
				$thinkup_subtitle_panel      => __('Switch on to enable intro.', 'consulting'),
				$thinkup_subtitle_customizer => __('Switch on to enable intro.', 'consulting'),
				'id'                         => 'thinkup_general_introswitch',
				'type'                       => 'switch',
				'default'                    => '1',
			),

			array(
				'title'                      => __('Choose Intro Style', 'consulting'), 
				$thinkup_subtitle_panel      => __('Specify the intro layout.', 'consulting'),
				$thinkup_subtitle_customizer => __('Specify the intro layout.', 'consulting'),
				'id'                         => 'thinkup_general_introstyle',
				'type'                       => 'radio',
				'options'                    => array( 
					'option1' => 'Style 1 (traditional)',
					'option2' => 'Style 2 (modern)',
				),
				'default'                    => '',
				'required'                   => array( 
					array( 'thinkup_general_introswitch', '=', 
						array( '1' ),
					), 
				)
			),

			array(
				'title'                      => __('Intro - Background Color', 'consulting'), 
				$thinkup_subtitle_panel      => __('Select a custom color to use as background.', 'consulting'),
				$thinkup_subtitle_customizer => __('Select a custom color to use as background.', 'consulting'),
				'id'                         => 'thinkup_general_introbackgroundcolor',
				'type'                       => 'color',
				'validate'                   => 'color',
				'default'                    => '',
				'required'                   => array( 
					array( 'thinkup_general_introswitch', '=', 
						array( '1' ),
					), 
				)
			),

			array(
				'title'                      => __('Intro - Background Image', 'consulting'),
				$thinkup_subtitle_panel      => __('Upload an image to use as background.<br />Leave blank to use custom color.', 'consulting'),
				$thinkup_subtitle_customizer => __('Upload an image to use as background.<br />Leave blank to use custom color.', 'consulting'),
				'id'                         => 'thinkup_general_introbackgroundimage',
				'type'                       => 'media',
				'url'                        => true,
				'required'                   => array( 
					array( 'thinkup_general_introswitch', '=', 
						array( '1' ),
					), 
				)
			),

			array(
				'title'                      => __('Enable Breadcrumbs', 'consulting'), 
				$thinkup_subtitle_panel      => __('Switch on to enable breadcrumbs.', 'consulting'),
				$thinkup_subtitle_customizer => __('Switch on to enable breadcrumbs.', 'consulting'),
				'id'                         => 'thinkup_general_breadcrumbswitch',
				'type'                       => 'switch',
				'default'                    => '1', 
				'required'                   => array( 
					array( 'thinkup_general_introswitch', '=', 
						array( '1' ),
					), 
				)
			),

			array(
				'title'                      => __('Breadcrumb Delimiter', 'consulting'),
				$thinkup_subtitle_panel      => __('Specify a custom delimiter to use instead of the default &#40; / &#41; when displaying breadcrumbs.', 'consulting'),
				$thinkup_subtitle_customizer => __('Specify a custom delimiter to use instead of the default &#40; / &#41; when displaying breadcrumbs.', 'consulting'),
				'default'                    => '/',
				'id'                         => 'thinkup_general_breadcrumbdelimeter',
				'type'                       => 'text',
				'validate'                   => 'html',
				'required'                   => array( 
					array( 'thinkup_general_breadcrumbswitch', '=', 
						array( '1' ),
					), 
				)
			),

            array(
                'id'       => 'thinkup_section_general_code',
                'type'     => $thinkup_section_field,
                'title'    => __( ' ', 'consulting' ),
                'subtitle' => __( '<span class="redux-title">Custom Code</span>', 'consulting' ),
                'indent'   => false,
            ),

			array(
				'title'                      => __('Google Analytics Code', 'consulting'),
				$thinkup_subtitle_panel      => __('Copy and paste your Google Analytics code here to apply it to all pages on your website.', 'consulting'),
				$thinkup_subtitle_customizer => __('Copy and paste your Google Analytics code here to apply it to all pages on your website.', 'consulting'),
				'id'                         => 'thinkup_general_analyticscode',
				'type'                       => 'textarea',
			),

			array(
				'title'                      => __('Custom CSS', 'consulting'), 
				$thinkup_subtitle_panel      => __('Developers can use this to apply custom css. Use this to control, by styling of any element on the webpage by targeting id&#39;s and classes.', 'consulting'),
				$thinkup_subtitle_customizer => __('Developers can use this to apply custom css. Use this to control, by styling of any element on the webpage by targeting id&#39;s and classes.', 'consulting'),
				'id'                         => 'thinkup_general_customcss',
				'type'                       => 'textarea',
				'validate'                   => 'css',
			),

			array(
				'title'                      => __('Custom jQuery - Front End', 'consulting'),
				$thinkup_subtitle_panel      => __('Developers can use this to apply custom jQuery which will only affect the front end of the website.<br /><br />Use this to control your site by adding great jQuery features.', 'consulting'),
				$thinkup_subtitle_customizer => __('Developers can use this to apply custom jQuery which will only affect the front end of the website.<br /><br />Use this to control your site by adding great jQuery features.', 'consulting'),
				'id'                         => 'thinkup_general_customjavafront',
				'type'                       => 'textarea',
			),

			// Ensures ThinkUpThemes custom code is output
			array(
				'title'    => __('Custom Code', 'consulting'), 
				'subtitle' => __('Custom Code', 'consulting'),
				'id'       => 'thinkup_customization',
				'type'     => 'thinkup_custom_code',
			),
		)
	) );

	Redux::setSection( $opt_name, array(
		'type' => 'divide',
	) );


	// -----------------------------------------------------------------------------------
	//	2.1.	Home Settings				
	// -----------------------------------------------------------------------------------

	Redux::setSection( $opt_name, array(
		'title'      => __('Homepage', 'consulting'),
		'desc'       => __('<span class="redux-title">Control Homepage Layout</span>', 'consulting'),
		'icon_class' => '',
		'icon'       => 'el el-home',
        'subsection' => $thinkup_customizer_subsection,
        'customizer' => true,
		'fields'     => array(

			array(
				'title'                      => __('Homepage Layout', 'consulting'), 
				$thinkup_subtitle_panel      => __('Select page layout. This will only be applied to static homepages (front page) and not to homepage blogs.', 'consulting'),
				$thinkup_subtitle_customizer => __('Select page layout. This will only be applied to static homepages (front page) and not to homepage blogs.', 'consulting'),
				'id'                         => 'thinkup_homepage_layout',
				'type'                       => 'image_select',
				'compiler'                   => true,
				'default'                    => '0',
				'options'                    => array(
					'option1' => trailingslashit( get_template_directory_uri() ) . 'admin/main/assets/img/layout/blog/option01.png',
					'option2' => trailingslashit( get_template_directory_uri() ) . 'admin/main/assets/img/layout/blog/option02.png',
					'option3' => trailingslashit( get_template_directory_uri() ) . 'admin/main/assets/img/layout/blog/option03.png',
				),
			),

			array(
				'title'                      => __('Select a Sidebar', 'consulting'), 
				$thinkup_subtitle_panel      => __('Choose a sidebar to use with the layout.', 'consulting'),
				$thinkup_subtitle_customizer => __('Choose a sidebar to use with the layout.', 'consulting'),
				'id'                         => 'thinkup_homepage_sidebars',
				'type'                       => 'select',
				'data'                       => 'sidebars',
				'required'                   => array( 
					array( 'thinkup_homepage_layout', '=', 
						array( 'option2', 'option3' ),
					), 
				)
			),

            array(
                'id'       => 'thinkup_section_homepage_slider',
                'type'     => $thinkup_section_field,
                'title'    => __( ' ', 'consulting' ),
                'subtitle' => __( '<span class="redux-title">Homepage Slider</span>', 'consulting' ),
                'indent'   => false,
            ),

			array(
				'title'                      => __('Choose Homepage Slider', 'consulting'), 
				$thinkup_subtitle_panel      => __('Switch on to enable home page slider.', 'consulting'),
				$thinkup_subtitle_customizer => __('Switch on to enable home page slider.', 'consulting'),
				'id'                         => 'thinkup_homepage_sliderswitch',
				'type'                       => 'button_set',
				'options'                    => array(
					'option1' => __( 'ThinkUpSlider', 'consulting' ),
					'option4' => __( 'Image Slider', 'consulting' ),
					'option2' => __( 'Custom Slider', 'consulting' ),
					'option3' => __( 'Disable', 'consulting' ),
				),
				'default' => 'option1'
			),

			array(
				'title'                      => __('Homepage Slider Shortcode', 'consulting'), 
				$thinkup_subtitle_panel      => __('Input the shortcode of the slider you want to display. I.e. [shortcode_name].', 'consulting'),
				$thinkup_subtitle_customizer => __('Input the shortcode of the slider you want to display. I.e. [shortcode_name].', 'consulting'),
				'id'                         => 'thinkup_homepage_slidername',
				'type'                       => 'text',
				'validate'                   => 'html',
				'required'                   => array( 
					array( 'thinkup_homepage_sliderswitch', '=', 
						array( 'option2' ),
					), 
				)
			),

			array(
				'title'                      => __('Built-In Slider', 'consulting'),
				$thinkup_subtitle_panel      => __('Unlimited slides with drag and drop sortings.', 'consulting'),
				$thinkup_subtitle_customizer => __('Unlimited slides with drag and drop sortings.', 'consulting'),
				'id'                         => 'thinkup_homepage_sliderpreset',
				'type'                       => 'thinkup_slider_v3',
				'required'                   => array( 
					array( 'thinkup_homepage_sliderswitch', '=', 
						array( 'option1' ),
					), 
				)
			),

			array(
				'title'                      => __('Slider Style', 'consulting'), 
				$thinkup_subtitle_panel      => __('Choose a slider style. HTML, YouTube and Vimeo urls are supported for video layouts.', 'consulting'),
				$thinkup_subtitle_customizer => __('Choose a slider style. HTML, YouTube and Vimeo urls are supported for video layouts.', 'consulting'),
				'id'                         => 'thinkup_homepage_sliderstyle',
				'type'                       => 'select',
				'options'                    => array(
					'option1' => 'Standard',
					'option2' => 'Video on left',
					'option3' => 'Video on right'
				),
				'required'                   => array( 
					array( 'thinkup_homepage_sliderswitch', '=', 
						array( 'option1' ),
					), 
				)
			),

			// Add Image Slide 1 - Info
			array(
				'title'                      => __('Slide 1', 'consulting'),
				'id'                         => 'thinkup_homepage_sliderimage1_info',
				'type'                       => 'raw',
				'content'                    => '',
				'default'                    => '' 
			),

			// Add Image Slide 1 - Image
			array(
				$thinkup_subtitle_panel      => __('Image', 'consulting'),
				$thinkup_subtitle_customizer => __('Image', 'consulting'),
				'id'                         => 'thinkup_homepage_sliderimage1_image',
				'type'                       => 'media',
				'url'                        => true,
				'required'                   => array( 
					array( 'thinkup_homepage_sliderswitch', '=', 
						array( 'option4' ),
					), 
				)
			),

			// Add Image Slide 1 - Title
			array(
				$thinkup_subtitle_panel      => __('Title', 'consulting'),
				$thinkup_subtitle_customizer => __('Title', 'consulting'),
				'id'                         => 'thinkup_homepage_sliderimage1_title',
				'type'                       => 'text',
				'validate'                   => 'html',
				'required'                   => array( 
					array( 'thinkup_homepage_sliderswitch', '=', 
						array( 'option4' ),
					), 
				)
			),

			// Add Image Slide 1 - Description
			array(
				$thinkup_subtitle_panel      => __('Description', 'consulting'),
				$thinkup_subtitle_customizer => __('Description', 'consulting'),
				'id'                         => 'thinkup_homepage_sliderimage1_desc',
				'type'                       => 'text',
				'validate'                   => 'html',
				'required'                   => array( 
					array( 'thinkup_homepage_sliderswitch', '=', 
						array( 'option4' ),
					), 
				)
			),

			// Add Slide 1 - Page Link
			array(
				$thinkup_subtitle_panel      => __('URL', 'consulting'),
				$thinkup_subtitle_customizer => __('URL', 'consulting'),
				'id'                         => 'thinkup_homepage_sliderimage1_link',
				'type'                       => 'select',
				'data'                       => 'pages',
				'required'                   => array( 
					array( 'thinkup_homepage_sliderswitch', '=', 
						array( 'option4' ),
					), 
				)
			),

			// Add Image Slide 1 - Info
			array(
				'title'                      => __('Slide 2', 'consulting'),
				'id'                         => 'thinkup_homepage_sliderimage2_info',
				'type'                       => 'raw',
				'content'                    => '',
				'default'                    => '' 
			),

			// Add Image Slide 2 - Image
			array(
				$thinkup_subtitle_panel      => __('Image', 'consulting'),
				$thinkup_subtitle_customizer => __('Image', 'consulting'),
				'id'                         => 'thinkup_homepage_sliderimage2_image',
				'type'                       => 'media',
				'url'                        => true,
				'required'                   => array( 
					array( 'thinkup_homepage_sliderswitch', '=', 
						array( 'option4' ),
					), 
				)
			),

			// Add Image Slide 2 - Title
			array(
				$thinkup_subtitle_panel      => __('Title', 'consulting'),
				$thinkup_subtitle_customizer => __('Title', 'consulting'),
				'id'                         => 'thinkup_homepage_sliderimage2_title',
				'type'                       => 'text',
				'validate'                   => 'html',
				'required'                   => array( 
					array( 'thinkup_homepage_sliderswitch', '=', 
						array( 'option4' ),
					), 
				)
			),

			// Add Image Slide 2 - Description
			array(
				$thinkup_subtitle_panel      => __('Description', 'consulting'),
				$thinkup_subtitle_customizer => __('Description', 'consulting'),
				'id'                         => 'thinkup_homepage_sliderimage2_desc',
				'type'                       => 'text',
				'validate'                   => 'html',
				'required'                   => array( 
					array( 'thinkup_homepage_sliderswitch', '=', 
						array( 'option4' ),
					), 
				)
			),

			// Add Slide 2 - Page Link
			array(
				$thinkup_subtitle_panel      => __('URL', 'consulting'),
				$thinkup_subtitle_customizer => __('URL', 'consulting'),
				'id'                         => 'thinkup_homepage_sliderimage2_link',
				'type'                       => 'select',
				'data'                       => 'pages',
				'required'                   => array( 
					array( 'thinkup_homepage_sliderswitch', '=', 
						array( 'option4' ),
					), 
				)
			),

			// Add Image Slide 1 - Info
			array(
				'title'                      => __('Slide 3', 'consulting'),
				'id'                         => 'thinkup_homepage_sliderimage3_info',
				'type'                       => 'raw',
				'content'                    => '',
				'default'                    => '' 
			),

			// Add Image Slide 3 - Image
			array(
				$thinkup_subtitle_panel      => __('Image', 'consulting'),
				$thinkup_subtitle_customizer => __('Image', 'consulting'),
				'id'                         => 'thinkup_homepage_sliderimage3_image',
				'type'                       => 'media',
				'url'                        => true,
				'required'                   => array( 
					array( 'thinkup_homepage_sliderswitch', '=', 
						array( 'option4' ),
					), 
				)
			),

			// Add Image Slide 3 - Title
			array(
				$thinkup_subtitle_panel      => __('Title', 'consulting'),
				$thinkup_subtitle_customizer => __('Title', 'consulting'),
				'id'                         => 'thinkup_homepage_sliderimage3_title',
				'type'                       => 'text',
				'validate'                   => 'html',
				'required'                   => array( 
					array( 'thinkup_homepage_sliderswitch', '=', 
						array( 'option4' ),
					), 
				)
			),

			// Add Image Slide 3 - Description
			array(
				$thinkup_subtitle_panel      => __('Description', 'consulting'),
				$thinkup_subtitle_customizer => __('Description', 'consulting'),
				'id'                         => 'thinkup_homepage_sliderimage3_desc',
				'type'                       => 'text',
				'validate'                   => 'html',
				'required'                   => array( 
					array( 'thinkup_homepage_sliderswitch', '=', 
						array( 'option4' ),
					), 
				)
			),

			// Add Slide 3 - Page Link
			array(
				$thinkup_subtitle_panel      => __('URL', 'consulting'),
				$thinkup_subtitle_customizer => __('URL', 'consulting'),
				'id'                         => 'thinkup_homepage_sliderimage3_link',
				'type'                       => 'select',
				'data'                       => 'pages',
				'required'                   => array( 
					array( 'thinkup_homepage_sliderswitch', '=', 
						array( 'option4' ),
					), 
				)
			),

			array(
				'title'                      => __('Slider Speed', 'consulting'),
				$thinkup_subtitle_panel      => __('Specify the time it takes to move to the next slide.<br />Tip: Set to 0 to disable automatic transitions.', 'consulting'),
				$thinkup_subtitle_customizer => __('Specify the time it takes to move to the next slide.<br />Tip: Set to 0 to disable automatic transitions.', 'consulting'),
				'id'                         => 'thinkup_homepage_sliderspeed',
				'type'                       => 'slider', 
				"default"                    => "6",
				"min"                        => "0",
				"step"                       => "1",
				"max"                        => "30",
				'required'                   => array( 
					array( 'thinkup_homepage_sliderswitch', '=', 
						array( 'option1', 'option4' ),
					), 
				)
			),

			array(
				'id'                         => 'thinkup_homepage_sliderpresetheight',
				'type'                       => 'slider', 
				'title'                      => __('Slider Height (Max)', 'consulting'),
				$thinkup_subtitle_panel      => __('Specify the maximum slider height (px).', 'consulting'),
				$thinkup_subtitle_customizer => __('Specify the maximum slider height (px).', 'consulting'),
				"default"                    => "350",
				"min"                        => "200",
				"step"                       => "5",
				"max"                        => "1000",
				'required'                   => array( 
					array( 'thinkup_homepage_sliderswitch', '=', 
						array( 'option1', 'option4' ),
					), 
				)
			),

			array(
				'title'                      => __('Enable Full-Width Slider', 'consulting'),
				$thinkup_subtitle_panel      => __('Switch on to enable full-width slider.', 'consulting'),
				$thinkup_subtitle_customizer => __('Switch on to enable full-width slider.', 'consulting'),
				'id'                         => 'thinkup_homepage_sliderpresetwidth',
				'type'                       => 'switch',
				'default'                    => '1',
				'required'                   => array( 
					array( 'thinkup_homepage_sliderswitch', '=', 
						array( 'option1', 'option4' ),
					), 
				)
			),

            array(
                'id'       => 'thinkup_section_homepage_ctaintro',
                'type'     => $thinkup_section_field,
                'title'    => __( ' ', 'consulting' ),
                'subtitle' => __( '<span class="redux-title">Call To Action - Intro</span>', 'consulting' ),
                'indent'   => false,
            ),			

			array(
				'title'   => __('Message', 'consulting'), 
				'desc'    => __('Check to enable intro on home page.', 'consulting'),
				'id'      => 'thinkup_homepage_introswitch',
				'type'    => 'checkbox',
				'default' => '1',
			),

			array(
				$thinkup_subtitle_panel      => __('Enter a <strong>title</strong> message.<br /><br />This will be one of the first messages your visitors see. Use this to get their attention.', 'consulting'),
				$thinkup_subtitle_customizer => __('Enter a <strong>title</strong> message.<br /><br />This will be one of the first messages your visitors see. Use this to get their attention.', 'consulting'),
				'id'                         => 'thinkup_homepage_introaction',
				'type'                       => 'textarea',
				'validate'                   => 'html',
			),

			array(
				$thinkup_subtitle_panel      => __('Enter a <strong>teaser</strong> message.<br /><br />Use this to provide more details about what you offer.', 'consulting'),
				$thinkup_subtitle_customizer => __('Enter a <strong>teaser</strong> message.<br /><br />Use this to provide more details about what you offer.', 'consulting'),
				'id'                         => 'thinkup_homepage_introactionteaser',
				'type'                       => 'textarea',
				'validate'                   => 'html',
			),

			array(
				'title'                      => __('Button - Text', 'consulting'), 
				$thinkup_subtitle_panel      => __('Specify a text for button 1.', 'consulting'),
				$thinkup_subtitle_customizer => __('Specify a text for button 1.', 'consulting'),
				'id'                         => 'thinkup_homepage_introactiontext1',
				'type'                       => 'text',
				'validate'                   => 'html',
			),

			array(
				'title'                      => __('Button - Link', 'consulting'), 
				$thinkup_subtitle_panel      => __('Specify whether the action button should link to a page on your site, out to external webpage or disable the link altogether.', 'consulting'),
				$thinkup_subtitle_customizer => __('Specify whether the action button should link to a page on your site, out to external webpage or disable the link altogether.', 'consulting'),
				'id'                         => 'thinkup_homepage_introactionlink1',
				'type'                       => 'radio',
				'options'                    => array( 
					'option1' => 'Link to a Page',
					'option2' => 'Specify Custom link',
					'option3' => 'Disable Link'
				),
			),

			array(
				'title'                      => __('Button - Link to a page', 'consulting'), 
				$thinkup_subtitle_panel      => __('Select a target page for action button link.', 'consulting'),
				$thinkup_subtitle_customizer => __('Select a target page for action button link.', 'consulting'),
				'id'                         => 'thinkup_homepage_introactionpage1',
				'type'                       => 'select',
				'data'                       => 'pages',
				'required'                   => array( 
					array( 'thinkup_homepage_introactionlink1', '=', 
						array( 'option1' ),
					), 
				)
			),

			array(
				'title'                      => __('Button - Custom link', 'consulting'),
				$thinkup_subtitle_panel      => __('Input a custom url for the action button link.<br>Add http:// if linking to an external webpage.', 'consulting'),
				$thinkup_subtitle_customizer => __('Input a custom url for the action button link.<br>Add http:// if linking to an external webpage.', 'consulting'),
				'id'                         => 'thinkup_homepage_introactioncustom1',
				'type'                       => 'text',
				'validate'                   => 'html',
				'required'                   => array( 
					array( 'thinkup_homepage_introactionlink1', '=', 
						array( 'option2' ),
					), 
				)
			),

            array(
                'id'       => 'thinkup_section_homepage_ctaoutro',
                'type'     => $thinkup_section_field,
                'title'    => __( ' ', 'consulting' ),
                'subtitle' => __( '<span class="redux-title">Call To Action - Outro</span>', 'consulting' ),
                'indent'   => false,
            ),		

			array(
				'title'   => __('Message', 'consulting'), 
				'desc'    => __('Check to enable outro on home page.', 'consulting'),
				'id'      => 'thinkup_homepage_outroswitch',
				'type'    => 'checkbox',
				'default' => '0',
			),

			array(
				$thinkup_subtitle_panel      => __('Enter a <strong>title</strong> message.<br /><br />This will be one of the first messages your visitors see. Use this to get their attention.', 'consulting'),
				$thinkup_subtitle_customizer => __('Enter a <strong>title</strong> message.<br /><br />This will be one of the first messages your visitors see. Use this to get their attention.', 'consulting'),
				'id'                         => 'thinkup_homepage_outroaction',
				'type'                       => 'textarea',
				'validate'                   => 'html',
			),

			array(
				$thinkup_subtitle_panel      => __('Enter a <strong>teaser</strong> message.<br /><br />Use this to provide more details about what you offer.', 'consulting'),
				$thinkup_subtitle_customizer => __('Enter a <strong>teaser</strong> message.<br /><br />Use this to provide more details about what you offer.', 'consulting'),
				'id'                         => 'thinkup_homepage_outroactionteaser',
				'type'                       => 'textarea',
				'validate'                   => 'html',
			),

			array(
				'title'                      => __('Button - Text', 'consulting'), 
				$thinkup_subtitle_panel      => __('Specify a text for button 1.', 'consulting'),
				$thinkup_subtitle_customizer => __('Specify a text for button 1.', 'consulting'),
				'id'                         => 'thinkup_homepage_outroactiontext1',
				'type'                       => 'text',
				'validate'                   => 'html',
			),

			array(
				'title'                      => __('Button - Link', 'consulting'), 
				$thinkup_subtitle_panel      => __('Specify whether the action button should link to a page on your site, out to external webpage or disable the link altogether.', 'consulting'),
				$thinkup_subtitle_customizer => __('Specify whether the action button should link to a page on your site, out to external webpage or disable the link altogether.', 'consulting'),
				'id'                         => 'thinkup_homepage_outroactionlink1',
				'type'                       => 'radio',
				'options'                    => array( 
					'option1' => 'Link to a Page',
					'option2' => 'Specify Custom link',
					'option3' => 'Disable Link'
				),
			),

			array(
				'title'                      => __('Button - Link to a page', 'consulting'), 
				$thinkup_subtitle_panel      => __('Select a target page for action button link.', 'consulting'),
				$thinkup_subtitle_customizer => __('Select a target page for action button link.', 'consulting'),
				'id'                         => 'thinkup_homepage_outroactionpage1',
				'type'                       => 'select',
				'data'                       => 'pages',
				'required'                   => array( 
					array( 'thinkup_homepage_outroactionlink1', '=', 
						array( 'option1' ),
					), 
				)
			),

			array(
				'title'                      => __('Button - Custom link', 'consulting'),
				$thinkup_subtitle_panel      => __('Input a custom url for the action button link.<br>Add http:// if linking to an external webpage.', 'consulting'),
				$thinkup_subtitle_customizer => __('Input a custom url for the action button link.<br>Add http:// if linking to an external webpage.', 'consulting'),
				'id'                         => 'thinkup_homepage_outroactioncustom1',
				'type'                       => 'text',
				'validate'                   => 'html',
				'required'                   => array( 
					array( 'thinkup_homepage_outroactionlink1', '=', 
						array( 'option2' ),
					), 
				)
			),
		)
	) );


	// -----------------------------------------------------------------------------------
	//	2.2.	Homepage (Featured)		
	// -----------------------------------------------------------------------------------

	Redux::setSection( $opt_name, array(
		'title'      => __('Homepage (Featured)', 'consulting'),
		'desc'       => __('<span class="redux-title">Display Pre-Designed Homepage Layout</span>', 'consulting'),
		'icon_class' => '',
		'icon'       => 'el el-pencil',
        'subsection' => $thinkup_customizer_subsection,
        'customizer' => true,
		'fields'     => array(

			array(
				'title'                      => __('Enable Pre-Made Homepage ', 'consulting'), 
				$thinkup_subtitle_panel      => __('switch on to enable pre-designed homepage layout.', 'consulting'),
				$thinkup_subtitle_customizer => __('switch on to enable pre-designed homepage layout.', 'consulting'),
				'id'                         => 'thinkup_homepage_sectionswitch',
				'type'                       => 'switch',
				'default'                    => '1',
			),

			array(
				'id'       => 'thinkup_homepage_section1_icon',
				'title'    => __('Content Area 1', 'consulting'),
				'desc'     => __('Choose an icon for the section background.', 'consulting'),
				'type'     => 'select',
				'data'     => 'elusive-icons',
			),

			array(
				'id'       => 'thinkup_homepage_section1_title',
				'desc'     => __('Add a title to the section.', 'consulting'),
				'type'     => 'text',
				'validate' => 'html',
			),

			array(
				'id'       => 'thinkup_homepage_section1_desc',
				'desc'     => __('Add some text to featured section 1.', 'consulting'),
				'type'     => 'textarea',
				'validate' => 'html',
			),

			array(
				'id'       => 'thinkup_homepage_section1_link',
				'desc'     => __('Link to a page', 'consulting'), 
				'type'     => 'select',
				'data'     => 'pages',
			),
			
			array(
				'id'       => 'thinkup_homepage_section1_url',
				'desc'     => __('Link to a custom page.', 'consulting'), 
				'type'     => 'text',
				'validate' => 'html',
			),

			array(
				'id'       => 'thinkup_homepage_section1_button',
				'desc'     => __('Add a custom button text.', 'consulting'), 
				'type'     => 'text',
				'validate' => 'html',
			),

			array(
				'id'       => 'thinkup_homepage_section1_target',
				'desc'     => __('Link target', 'consulting'), 
				'type'     => 'select',
				'options'  => array( 
					'option1' => 'Current tab',
					'option2' => 'New tab',
				),
			),

			array(
				'id'       => 'thinkup_homepage_section2_icon',
				'title'    => __('Content Area 2', 'consulting'),
				'desc'     => __('Choose an icon for the section background.', 'consulting'),
				'type'     => 'select',
				'data'     => 'elusive-icons',
			),

			array(
				'id'       => 'thinkup_homepage_section2_title',
				'desc'     => __('Add a title to the section.', 'consulting'),
				'type'     => 'text',
				'validate' => 'html',
			),

			array(
				'id'       => 'thinkup_homepage_section2_desc',
				'desc'     => __('Add some text to featured section 2.', 'consulting'),
				'type'     => 'textarea',
				'validate' => 'html',
			),

			array(
				'id'       => 'thinkup_homepage_section2_link',
				'desc'     => __('Link to a page', 'consulting'), 
				'type'     => 'select',
				'data'     => 'pages',
			),

			array(
				'id'       => 'thinkup_homepage_section2_url',
				'desc'     => __('Link to a custom page.', 'consulting'), 
				'type'     => 'text',
				'validate' => 'html',
			),

			array(
				'id'       => 'thinkup_homepage_section2_button',
				'desc'     => __('Add a custom button text.', 'consulting'), 
				'type'     => 'text',
				'validate' => 'html',
			),

			array(
				'id'       => 'thinkup_homepage_section2_target',
				'desc'     => __('Link target', 'consulting'), 
				'type'     => 'select',
				'options'  => array( 
					'option1' => 'Current tab',
					'option2' => 'New tab',
				),
			),

			array(
				'id'       => 'thinkup_homepage_section3_icon',
				'title'    => __('Content Area 3', 'consulting'),
				'desc'     => __('Choose an icon for the section background.', 'consulting'),
				'type'     => 'select',
				'data'     => 'elusive-icons',
			),

			array(
				'id'       => 'thinkup_homepage_section3_title',
				'desc'     => __('Add a title to the section.', 'consulting'),
				'type'     => 'text',
				'validate' => 'html',
			),

			array(
				'id'       => 'thinkup_homepage_section3_desc',
				'desc'     => __('Add some text to featured section 3.', 'consulting'),
				'type'     => 'textarea',
				'validate' => 'html',
			),

			array(
				'id'       => 'thinkup_homepage_section3_link',
				'desc'     => __('Link to a page', 'consulting'), 
				'type'     => 'select',
				'data'     => 'pages',
			),

			array(
				'id'       => 'thinkup_homepage_section3_url',
				'desc'     => __('Link to a custom page.', 'consulting'), 
				'type'     => 'text',
				'validate' => 'html',
			),

			array(
				'id'       => 'thinkup_homepage_section3_button',
				'desc'     => __('Add a custom button text.', 'consulting'), 
				'type'     => 'text',
				'validate' => 'html',
			),

			array(
				'id'       => 'thinkup_homepage_section3_target',
				'desc'     => __('Link target', 'consulting'), 
				'type'     => 'select',
				'options'  => array( 
					'option1' => 'Current tab',
					'option2' => 'New tab',
				),
			),
		)
	) );


	// -----------------------------------------------------------------------------------
	//	3.	Header
	// -----------------------------------------------------------------------------------

	Redux::setSection( $opt_name, array(
		'title'      => __('Header', 'consulting'),
		'desc'       => __('<span class="redux-title">Header Style</span>', 'consulting'),
		'icon'       => 'el el-chevron-up',
		'icon_class' => '',
        'subsection' => $thinkup_customizer_subsection,
        'customizer' => true,
		'fields'     => array(

/*			array(
				'title'                      => __('Choose Pre Header Style', 'consulting'), 
				$thinkup_subtitle_panel      => __('Specify the pre header style.', 'consulting'),
				$thinkup_subtitle_customizer => __('Specify the pre header style.', 'consulting'),
				'id'                         => 'thinkup_header_styleswitchpre',
				'type'                       => 'radio',
				'options'                    => array(
					'option1' => 'Style 1 (Light)',
					'option2' => 'Style 2 (Dark)',
				),
			),

            array(
                'id'       => 'thinkup_section_header_style',
                'type'     => $thinkup_section_field,
                'title'    => __( ' ', 'consulting' ),
                'subtitle' => __( '<span class="redux-title">Header Style</span>', 'consulting' ),
                'indent'   => false,
            ),
*/
			array(
				'title'                      => __('Choose Header Style', 'consulting'), 
				$thinkup_subtitle_panel      => __('Specify the header layout.', 'consulting'),
				$thinkup_subtitle_customizer => __('Specify the header layout.', 'consulting'),
				'id'                         => 'thinkup_header_styleswitch',
				'type'                       => 'radio',
				'options'                    => array( 
					'option1' => 'Style 1',
					'option2' => 'Style 2',
					'option3' => 'Style 3',
				),
				'default'                    => '',
			),

			array(
				'title'   => __('Float Header', 'consulting'), 
				'desc'    => __('Check to enable floating header.<br /><strong>Note:</strong> Only works with full-width slider or intro style 2..', 'consulting'),
				'id'      => 'thinkup_header_float',
				'type'    => 'checkbox',
				'default' => '0',
				'required'                   => array( 
					array( 'thinkup_header_styleswitch', '=', 
						array( 'option1' ),
					), 
				)
			),

			array(
				'title'   => __('Logo Overflow', 'consulting'), 
				'desc'    => __('Check to let logo overflow the header container.', 'consulting'),
				'id'      => 'thinkup_header_logooverflow',
				'type'    => 'checkbox',
				'default' => '0',
				'required'                   => array( 
					array( 'thinkup_header_styleswitch', '=', 
						array( 'option1' ),
					), 
				)
			),

			array(
				'title'                      => __('Choose Header Location', 'consulting'), 
				$thinkup_subtitle_panel      => __('Specify the header location.<br />Feature only works with header style 2.', 'consulting'),
				$thinkup_subtitle_customizer => __('Specify the header location.<br />Feature only works with header style 2.', 'consulting'),
				'id'                         => 'thinkup_header_locationswitch',
				'type'                       => 'radio',
				'options'                    => array( 
					'option1' => 'Above Slider',
					'option2' => 'Below Slider',
				),
				'required'                   => array( 
					array( 'thinkup_header_styleswitch', '=', 
						array( 'option2' ),
					), 
				)
			),

            array(
                'id'       => 'thinkup_section_header_content',
                'type'     => $thinkup_section_field,
                'title'    => __( ' ', 'consulting' ),
                'subtitle' => __( '<span class="redux-title">Control Header Content</span>', 'consulting' ),
                'indent'   => false,
            ),

			array(
				'title'                      => __('Sticky Header', 'consulting'), 
				$thinkup_subtitle_panel      => __('Switch on to fix header to top of page.', 'consulting'),
				$thinkup_subtitle_customizer => __('Switch on to fix header to top of page.', 'consulting'),
				'id'                         => 'thinkup_header_stickyswitch',
				'type'                       => 'switch',
				'default'                    => '0',
			),

			array(
				'title'                      => __('Header Image', 'ryan'), 
				$thinkup_subtitle_panel      => __('Switch on to add image above header.<br />Note: Image will be centered in the header area.', 'ryan'),
				$thinkup_subtitle_customizer => __('Switch on to add image above header.<br />Note: Image will be centered in the header area.', 'ryan'),
				'id'                         => 'thinkup_header_imageswitch',
				'type'                       => 'switch',
				'default'                    => '0',
			),

			array(
				$thinkup_subtitle_panel      => __('Choose header image. <strong>Tip:</strong> Remember you can always crop your images directly from the media library so your image shows only what you want.', 'ryan'),
				$thinkup_subtitle_customizer => __('Choose header image. <strong>Tip:</strong> Remember you can always crop your images directly from the media library so your image shows only what you want.', 'ryan'),
				'id'                         => 'thinkup_header_imagelink',
				'type'                       => 'media',
				'url'                        => true,
				'required'                   => array( 
					array( 'thinkup_header_imageswitch', '=', 
						array( '1' ),
					), 
				)
			),

			array(
				$thinkup_subtitle_panel      => __('Link header image.<br />Add http:// as the url is an external link.', 'ryan'),
				$thinkup_subtitle_customizer => __('Link header image.<br />Add http:// as the url is an external link.', 'ryan'),
				'id'                         => 'thinkup_header_imageurl',
				'type'                       => 'text',
				'validate'                   => 'html',
				'required'                   => array( 
					array( 'thinkup_header_imageswitch', '=', 
						array( '1' ),
					), 
				)
			),

			array(
				$thinkup_subtitle_panel      => __('Header image width', 'ryan'),
				$thinkup_subtitle_customizer => __('Header image width', 'ryan'),
				'desc'                       => __('Check to restrict header image width to 1170px', 'ryan'),
				'id'                         => 'thinkup_header_imagewidth',
				'type'                       => 'checkbox',
				'default'                    => '0',
				'required'                   => array( 
					array( 'thinkup_header_imageswitch', '=', 
						array( '1' ),
					), 
				)
			),

			array(
				'title'                      => __('Enable Search (Pre Header)', 'consulting'), 
				$thinkup_subtitle_panel      => __('Switch on to enable pre header search.', 'consulting'),
				$thinkup_subtitle_customizer => __('Switch on to enable pre header search.', 'consulting'),
				'id'                         => 'thinkup_header_searchswitchpre',
				'type'                       => 'switch',
				'default'                    => '0',
			),

			array(
				'title'                      => __('Enable Search (Main Header)', 'consulting'), 
				$thinkup_subtitle_panel      => __('Switch on to enable header search.', 'consulting'),
				$thinkup_subtitle_customizer => __('Switch on to enable header search.', 'consulting'),
				'id'                         => 'thinkup_header_searchswitch',
				'type'                       => 'switch',
				'default'                    => '0',
			),
		)
	) );
	
	
	// -----------------------------------------------------------------------------------
	//	4.	Footer
	// -----------------------------------------------------------------------------------

	Redux::setSection( $opt_name, array(
		'title'      => __('Footer', 'consulting'),
		'desc'       => __('<span class="redux-title">Control Footer Content</span>', 'consulting'),
		'icon'       => 'el el-chevron-down',
		'icon_class' => '',
        'subsection' => $thinkup_customizer_subsection,
        'customizer' => true,
		'fields'     => array(

			array(
				'title'                      => __('Footer Widgets Layout', 'consulting'), 
				$thinkup_subtitle_panel      => __('Select footer layout. Take complete control of the footer content by adding widgets.', 'consulting'),
				$thinkup_subtitle_customizer => __('Select footer layout. Take complete control of the footer content by adding widgets.', 'consulting'),
				'id'                         => 'thinkup_footer_layout',
				'type'                       => 'image_select',
				'compiler'                   => true,
				'default'                    => '0',
				'options'                    => array(
					'option1' => trailingslashit( get_template_directory_uri() ) . 'admin/main/assets/img/layout/footer/option01.png',
					'option2' => trailingslashit( get_template_directory_uri() ) . 'admin/main/assets/img/layout/footer/option02.png',
					'option3' => trailingslashit( get_template_directory_uri() ) . 'admin/main/assets/img/layout/footer/option03.png',
					'option4' => trailingslashit( get_template_directory_uri() ) . 'admin/main/assets/img/layout/footer/option04.png',
					'option5' => trailingslashit( get_template_directory_uri() ) . 'admin/main/assets/img/layout/footer/option05.png',
					'option6' => trailingslashit( get_template_directory_uri() ) . 'admin/main/assets/img/layout/footer/option06.png',
					'option7' => trailingslashit( get_template_directory_uri() ) . 'admin/main/assets/img/layout/footer/option07.png',
					'option8' => trailingslashit( get_template_directory_uri() ) . 'admin/main/assets/img/layout/footer/option08.png',
					'option9' => trailingslashit( get_template_directory_uri() ) . 'admin/main/assets/img/layout/footer/option09.png',
					'option10' => trailingslashit( get_template_directory_uri() ) . 'admin/main/assets/img/layout/footer/option10.png',
					'option11' => trailingslashit( get_template_directory_uri() ) . 'admin/main/assets/img/layout/footer/option11.png',
					'option12' => trailingslashit( get_template_directory_uri() ) . 'admin/main/assets/img/layout/footer/option12.png',
					'option13' => trailingslashit( get_template_directory_uri() ) . 'admin/main/assets/img/layout/footer/option13.png',
					'option14' => trailingslashit( get_template_directory_uri() ) . 'admin/main/assets/img/layout/footer/option14.png',
					'option15' => trailingslashit( get_template_directory_uri() ) . 'admin/main/assets/img/layout/footer/option15.png',
					'option16' => trailingslashit( get_template_directory_uri() ) . 'admin/main/assets/img/layout/footer/option16.png',
					'option17' => trailingslashit( get_template_directory_uri() ) . 'admin/main/assets/img/layout/footer/option17.png',
					'option18' => trailingslashit( get_template_directory_uri() ) . 'admin/main/assets/img/layout/footer/option18.png',
				),
			),

			array(
				'title'   => __('Disable Footer Widgets', 'consulting'), 
				'desc'    => __('Check to disable footer widgets.', 'consulting'),
				'id'      => 'thinkup_footer_widgetswitch',
				'type'    => 'checkbox',
				'default' => '0',
			),

			array(
				'title'                      => __('Enable Scroll To Top', 'consulting'), 
				$thinkup_subtitle_panel      => __('Check to enable scroll to top.', 'consulting'),
				$thinkup_subtitle_customizer => __('Check to enable scroll to top.', 'consulting'),
				'id'                         => 'thinkup_footer_scroll',
				'type'                       => 'switch',
				'default'                    => '0',
			),

			array(
				'title'                      => __('Copyright Text', 'consulting'), 
				$thinkup_subtitle_panel      => __('Add custom copyright text.<br />Leave blank to display default message.', 'consulting'),
				$thinkup_subtitle_customizer => __('Add custom copyright text.<br />Leave blank to display default message.', 'consulting'),
				'id'                         => 'thinkup_footer_copyright',
				'type'                       => 'text',
				'validate'                   => 'html',
			),

            array(
                'id'       => 'thinkup_section_subfooter',
                'type'     => $thinkup_section_field,
                'title'    => __( ' ', 'consulting' ),
                'subtitle' => __( '<span class="redux-title">Control Sub-Footer Content</span>', 'consulting' ),
                'indent'   => false,
            ),

			array(
				'title'                      => __('Post-Footer Widgets Layout', 'consulting'), 
				$thinkup_subtitle_panel      => __('Select post-footer layout. Take complete control of the post-footer content by adding widgets.', 'consulting'),
				$thinkup_subtitle_customizer => __('Select post-footer layout. Take complete control of the post-footer content by adding widgets.', 'consulting'),
				'id'                         => 'thinkup_subfooter_layout',
				'type'                       => 'image_select',
				'compiler'                   => true,
				'default'                    => '0',
				'options'                    => array(
					'option1' => trailingslashit( get_template_directory_uri() ) . 'admin/main/assets/img/layout/sub-footer/option01.png',
					'option2' => trailingslashit( get_template_directory_uri() ) . 'admin/main/assets/img/layout/sub-footer/option02.png',
					'option3' => trailingslashit( get_template_directory_uri() ) . 'admin/main/assets/img/layout/sub-footer/option03.png',
					'option4' => trailingslashit( get_template_directory_uri() ) . 'admin/main/assets/img/layout/sub-footer/option04.png',
					'option5' => trailingslashit( get_template_directory_uri() ) . 'admin/main/assets/img/layout/sub-footer/option05.png',
					'option6' => trailingslashit( get_template_directory_uri() ) . 'admin/main/assets/img/layout/sub-footer/option06.png',
					'option7' => trailingslashit( get_template_directory_uri() ) . 'admin/main/assets/img/layout/sub-footer/option07.png',
					'option8' => trailingslashit( get_template_directory_uri() ) . 'admin/main/assets/img/layout/sub-footer/option08.png',
				),
			),

			array(
				'title'   => __('Disable Post-Footer Widgets', 'consulting'), 
				'desc'    => __('Check to disable post-footer widgets.', 'consulting'),
				'id'      => 'thinkup_subfooter_widgetswitch',
				'type'    => 'checkbox',
				'default' => '0',
			),

			array(
				'title'                      => __('Enable Widget Close Button', 'consulting'), 
				$thinkup_subtitle_panel      => __('Switch on to enable button to hide post-footer widgets.', 'consulting'),
				$thinkup_subtitle_customizer => __('Switch on to enable button to hide post-footer widgets.', 'consulting'),
				'id'                         => 'thinkup_subfooter_widgetclose',
				'type'                       => 'switch',
				'default'                    => '0',
			),

            array(
                'id'       => 'thinkup_section_footer_ctaoutro',
                'type'     => $thinkup_section_field,
                'title'    => __( ' ', 'consulting' ),
                'subtitle' => __( '<span class="redux-title">Call To Action - Outro Inner Pages</span>', 'consulting' ),
                'indent'   => false,
            ),	

			array(
				'title'   => __('Message', 'consulting'), 
				'desc'    => __('Check to enable outro on all inner pages.', 'consulting'),
				'id'      => 'thinkup_footer_outroswitch',
				'type'    => 'checkbox',
				'default' => '0',
			),

			array(
				$thinkup_subtitle_panel      => __('Enter a <strong>title</strong> message.<br /><br />This will be one of the first messages your visitors see. Use this to get their attention.', 'consulting'),
				$thinkup_subtitle_customizer => __('Enter a <strong>title</strong> message.<br /><br />This will be one of the first messages your visitors see. Use this to get their attention.', 'consulting'),
				'id'                         => 'thinkup_footer_outroaction',
				'type'                       => 'textarea',
				'validate'                   => 'html',
			),

			array(
				$thinkup_subtitle_panel      => __('Enter a <strong>teaser</strong> message.<br /><br />Use this to provide more details about what you offer.', 'consulting'),
				$thinkup_subtitle_customizer => __('Enter a <strong>teaser</strong> message.<br /><br />Use this to provide more details about what you offer.', 'consulting'),
				'id'                         => 'thinkup_footer_outroactionteaser',
				'type'                       => 'textarea',
				'validate'                   => 'html',
			),

			array(
				'title'                      => __('Button - Text', 'consulting'), 
				$thinkup_subtitle_panel      => __('Specify a text for button 1.', 'consulting'),
				$thinkup_subtitle_customizer => __('Specify a text for button 1.', 'consulting'),
				'id'                         => 'thinkup_footer_outroactiontext1',
				'type'                       => 'text',
				'validate'                   => 'html',
			),

			array(
				'title'                      => __('Button - Link', 'consulting'), 
				$thinkup_subtitle_panel      => __('Specify whether the action button should link to a page on your site, out to external webpage or disable the link altogether.', 'consulting'),
				$thinkup_subtitle_customizer => __('Specify whether the action button should link to a page on your site, out to external webpage or disable the link altogether.', 'consulting'),
				'id'                         => 'thinkup_footer_outroactionlink1',
				'type'                       => 'radio',
				'options'                    => array( 
					'option1' => 'Link to a Page',
					'option2' => 'Specify Custom link',
					'option3' => 'Disable Link'
				),
			),

			array(
				'title'                      => __('Button - Link to a page', 'consulting'), 
				$thinkup_subtitle_panel      => __('Select a target page for action button link.', 'consulting'),
				$thinkup_subtitle_customizer => __('Select a target page for action button link.', 'consulting'),
				'id'                         => 'thinkup_footer_outroactionpage1',
				'type'                       => 'select',
				'data'                       => 'pages',
				'required'                   => array( 
					array( 'thinkup_footer_outroactionlink1', '=', 
						array( 'option1' ),
					), 
				)
			),

			array(
				'title'                      => __('Button - Custom link', 'consulting'),
				$thinkup_subtitle_panel      => __('Input a custom url for the action button link.<br>Add http:// if linking to an external webpage.', 'consulting'),
				$thinkup_subtitle_customizer => __('Input a custom url for the action button link.<br>Add http:// if linking to an external webpage.', 'consulting'),
				'id'                         => 'thinkup_footer_outroactioncustom1',
				'type'                       => 'text',
				'validate'                   => 'html',
				'required'                   => array( 
					array( 'thinkup_footer_outroactionlink1', '=', 
						array( 'option2' ),
					), 
				)
			),
		)
	) );


	// -----------------------------------------------------------------------------------
	//	3 & 4.	Social Media
	// -----------------------------------------------------------------------------------

	Redux::setSection( $opt_name, array(
		'title'      => __('Social Media', 'consulting'),
		'desc'       => __('<span class="redux-title">Social Media Control</span>', 'consulting'),
		'icon'       => 'el el-facebook',
		'icon_class' => '',
        'subsection' => $thinkup_customizer_subsection,
        'customizer' => true,
		'fields'     => array(

			array(
				'title'                      => __('Enable Social Media Links (Pre Header)', 'consulting'), 
				$thinkup_subtitle_panel      => __('Switch on to enable links to social media pages.', 'consulting'),
				$thinkup_subtitle_customizer => __('Switch on to enable links to social media pages.', 'consulting'),
				'id'                         => 'thinkup_header_socialswitchpre',
				'type'                       => 'switch',
				'default'                    => '0',
			),

//			array(
//				'title'                      => __('Enable Social Media Links (Main Header)', 'consulting'), 
//				$thinkup_subtitle_panel      => __('Switch on to enable links to social media pages.', 'consulting'),
//				$thinkup_subtitle_customizer => __('Switch on to enable links to social media pages.', 'consulting'),
//				'id'                         => 'thinkup_header_socialswitchmain',
//				'type'                       => 'switch',
//				'default'                    => '0',
//			),

			array(
				'title'                      => __('Enable Social Media Links (footer)', 'consulting'), 
				$thinkup_subtitle_panel      => __('Switch on to enable links to social media pages.', 'consulting'),
				$thinkup_subtitle_customizer => __('Switch on to enable links to social media pages.', 'consulting'),
				'id'                         => 'thinkup_header_socialswitchfooter',
				'type'                       => 'switch',
				'default'                    => '0',
			),

            array(
                'id'       => 'thinkup_section_header_social',
                'type'     => $thinkup_section_field,
                'title'    => __( ' ', 'consulting' ),
                'subtitle' => __( '<span class="redux-title">Social Media Content</span>', 'consulting' ),
                'indent'   => false,
            ),

			array(
				'title'                      => __('Display Message', 'consulting'), 
				$thinkup_subtitle_panel      => __('Add a message here. E.g. &#34;Follow Us&#34;.<br />(Only shown in header)', 'consulting'),
				$thinkup_subtitle_customizer => __('Add a message here. E.g. &#34;Follow Us&#34;.<br />(Only shown in header)', 'consulting'),
				'id'                         => 'thinkup_header_socialmessage',
				'type'                       => 'text',
				'validate'                   => 'html',
			),

			// Facebook social settings
			array(
				'title'                      => __('Facebook', 'consulting'), 
				$thinkup_subtitle_panel      => __('Enable link to Facebook profile.', 'consulting'),
				$thinkup_subtitle_customizer => __('Enable link to Facebook profile.', 'consulting'),
				'id'                         => 'thinkup_header_facebookswitch',
				'type'                       => 'switch',
				'default'                    => '0',
			),

			array(
				'desc'     => __('Input the url to your Facebook page. <strong>Note:</strong> Add http:// as the url is an external link.', 'consulting'),
				'id'       => 'thinkup_header_facebooklink',
				'type'     => 'text',
				'validate' => 'html',
				'required' => array( 
					array( 'thinkup_header_facebookswitch', '=', 
						array( '1' ),
					), 
				)
			),

			array(
				'desc'     => __('Use Custom Facebook Icon', 'consulting'),
				'id'       => 'thinkup_header_facebookiconswitch',
				'type'     => 'checkbox',
				'default'  => '0',
				'required' => array( 
					array( 'thinkup_header_facebookswitch', '=', 
						array( '1' ),
					), 
				)
			),

			array(
				'desc'     => __('Add a link to the image or upload one from your desktop. The image will be resized.', 'consulting'),
				'id'       => 'thinkup_header_facebookcustomicon',
				'type'     => 'media',
				'url'      => true,
				'required' => array( 
					array( 'thinkup_header_facebookswitch', '=', 
						array( '1' ),
					), 
				)
			),

			// Twitter social settings
			array(
				'title'                      => __('Twitter', 'consulting'), 
				$thinkup_subtitle_panel      => __('Enable link to Twitter profile.', 'consulting'),
				$thinkup_subtitle_customizer => __('Enable link to Twitter profile.', 'consulting'),
				'id'                         => 'thinkup_header_twitterswitch',
				'type'                       => 'switch',
				'default'                    => '0',
			),

			array(
				'desc'     => __('Input the url to your Twitter page. <strong>Note:</strong> Add http:// as the url is an external link.', 'consulting'),
				'id'       => 'thinkup_header_twitterlink',
				'type'     => 'text',
				'validate' => 'html',
				'required' => array( 
					array( 'thinkup_header_twitterswitch', '=', 
						array( '1' ),
					), 
				)
			),

			array(
				'desc'     => __('Use Custom Twitter Icon', 'consulting'),
				'id'       => 'thinkup_header_twittericonswitch',
				'type'     => 'checkbox',
				'default'  => '0',
				'required' => array( 
					array( 'thinkup_header_twitterswitch', '=', 
						array( '1' ),
					), 
				)
			),

			array(
				'desc'     => __('Add a link to the image or upload one from your desktop. The image will be resized.', 'consulting'),
				'id'       => 'thinkup_header_twittercustomicon',
				'type'     => 'media',
				'url'      => true,
				'required' => array( 
					array( 'thinkup_header_twitterswitch', '=', 
						array( '1' ),
					), 
				)
			),

			// Google+ social settings
			array(
				'title'                      => __('Google+', 'consulting'), 
				$thinkup_subtitle_panel      => __('Enable link to Google+ profile.', 'consulting'),
				$thinkup_subtitle_customizer => __('Enable link to Google+ profile.', 'consulting'),
				'id'                         => 'thinkup_header_googleswitch',
				'type'                       => 'switch',
				'default'                    => '0',
			),

			array(
				'desc'     => __('Input the url to your Google+ page. <strong>Note:</strong> Add http:// as the url is an external link.', 'consulting'),
				'id'       => 'thinkup_header_googlelink',
				'type'     => 'text',
				'validate' => 'html',
				'required' => array( 
					array( 'thinkup_header_googleswitch', '=', 
						array( '1' ),
					), 
				)
			),

			array(
				'desc'     => __('Use Custom Google+ Icon', 'consulting'),
				'id'       => 'thinkup_header_googleiconswitch',
				'type'     => 'checkbox',
				'default'  => '0',
				'required' => array( 
					array( 'thinkup_header_googleswitch', '=', 
						array( '1' ),
					), 
				)
			),

			array(
				'desc'     => __('Add a link to the image or upload one from your desktop. The image will be resized.', 'consulting'),
				'id'       => 'thinkup_header_googlecustomicon',
				'type'     => 'media',
				'url'      => true,
				'required' => array( 
					array( 'thinkup_header_googleswitch', '=', 
						array( '1' ),
					), 
				)
			),

			// Instagram social settings
			array(
				'title'                      => __('Instagram', 'consulting'), 
				$thinkup_subtitle_panel      => __('Enable link to Instagram profile.', 'consulting'),
				$thinkup_subtitle_customizer => __('Enable link to Instagram profile.', 'consulting'),
				'id'                         => 'thinkup_header_instagramswitch',
				'type'                       => 'switch',
				'default'                    => '0',
			),

			array(
				'desc'     => __('Input the url to your Instagram page. <strong>Note:</strong> Add http:// as the url is an external link.', 'consulting'),
				'id'       => 'thinkup_header_instagramlink',
				'type'     => 'text',
				'validate' => 'html',
				'required' => array( 
					array( 'thinkup_header_instagramswitch', '=', 
						array( '1' ),
					), 
				)
			),

			array(
				'desc'     => __('Use Custom Instagram Icon', 'consulting'),
				'id'       => 'thinkup_header_instagramiconswitch',
				'type'     => 'checkbox',
				'default'  => '0',
				'required' => array( 
					array( 'thinkup_header_instagramswitch', '=', 
						array( '1' ),
					), 
				)
			),

			array(
				'desc'     => __('Add a link to the image or upload one from your desktop. The image will be resized.', 'consulting'),
				'id'       => 'thinkup_header_instagramcustomicon',
				'type'     => 'media',
				'url'      => true,
				'required' => array( 
					array( 'thinkup_header_instagramswitch', '=', 
						array( '1' ),
					), 
				)
			),

			// Tumblr social settings
			array(
				'title'                      => __('Tumblr', 'consulting'), 
				$thinkup_subtitle_panel      => __('Enable link to Tumblr profile.', 'consulting'),
				$thinkup_subtitle_customizer => __('Enable link to Tumblr profile.', 'consulting'),
				'id'                         => 'thinkup_header_tumblrswitch',
				'type'                       => 'switch',
				'default'                    => '0',
			),

			array(
				'desc'     => __('Input the url to your Tumblr page. <strong>Note:</strong> Add http:// as the url is an external link.', 'consulting'),
				'id'       => 'thinkup_header_tumblrlink',
				'type'     => 'text',
				'validate' => 'html',
				'required' => array( 
					array( 'thinkup_header_tumblrswitch', '=', 
						array( '1' ),
					), 
				)
			),

			array(
				'desc'     => __('Use Custom Tumblr Icon', 'consulting'),
				'id'       => 'thinkup_header_tumblriconswitch',
				'type'     => 'checkbox',
				'default'  => '0',
				'required' => array( 
					array( 'thinkup_header_tumblrswitch', '=', 
						array( '1' ),
					), 
				)
			),

			array(
				'desc'     => __('Add a link to the image or upload one from your desktop. The image will be resized.', 'consulting'),
				'id'       => 'thinkup_header_tumblrcustomicon',
				'type'     => 'media',
				'url'      => true,
				'required' => array( 
					array( 'thinkup_header_tumblrswitch', '=', 
						array( '1' ),
					), 
				)
			),

			// LinkedIn social settings
			array(
				'title'                      => __('LinkedIn', 'consulting'), 
				$thinkup_subtitle_panel      => __('Enable link to LinkedIn profile.', 'consulting'),
				$thinkup_subtitle_customizer => __('Enable link to LinkedIn profile.', 'consulting'),
				'id'                         => 'thinkup_header_linkedinswitch',
				'type'                       => 'switch',
				'default'                    => '0',
			),

			array(
				'desc'     => __('Input the url to your LinkedIn page. <strong>Note:</strong> Add http:// as the url is an external link.', 'consulting'),
				'id'       => 'thinkup_header_linkedinlink',
				'type'     => 'text',
				'validate' => 'html',
				'required' => array( 
					array( 'thinkup_header_linkedinswitch', '=', 
						array( '1' ),
					), 
				)
			),

			array(
				'desc'     => __('Use Custom LinkedIn Icon', 'consulting'),
				'id'       => 'thinkup_header_linkediniconswitch',
				'type'     => 'checkbox',
				'default'  => '0',
				'required' => array( 
					array( 'thinkup_header_linkedinswitch', '=', 
						array( '1' ),
					), 
				)
			),

			array(
				'desc'     => __('Add a link to the image or upload one from your desktop. The image will be resized.', 'consulting'),
				'id'       => 'thinkup_header_linkedincustomicon',
				'type'     => 'media',
				'url'      => true,
				'required' => array( 
					array( 'thinkup_header_linkedinswitch', '=', 
						array( '1' ),
					), 
				)
			),

			// Flickr social settings
			array(
				'title'                      => __('Flickr', 'consulting'), 
				$thinkup_subtitle_panel      => __('Enable link to Flickr profile.', 'consulting'),
				$thinkup_subtitle_customizer => __('Enable link to Flickr profile.', 'consulting'),
				'id'                         => 'thinkup_header_flickrswitch',
				'type'                       => 'switch',
				'default'                    => '0',
			),

			array(
				'desc'     => __('Input the url to your Flickr page. <strong>Note:</strong> Add http:// as the url is an external link.', 'consulting'),
				'id'       => 'thinkup_header_flickrlink',
				'type'     => 'text',
				'validate' => 'html',
				'required' => array( 
					array( 'thinkup_header_flickrswitch', '=', 
						array( '1' ),
					), 
				)
			),

			array(
				'desc'     => __('Use Custom Flickr Icon', 'consulting'),
				'id'       => 'thinkup_header_flickriconswitch',
				'type'     => 'checkbox',
				'default'  => '0',
				'required' => array( 
					array( 'thinkup_header_flickrswitch', '=', 
						array( '1' ),
					), 
				)
			),

			array(
				'desc'     => __('Add a link to the image or upload one from your desktop. The image will be resized.', 'consulting'),
				'id'       => 'thinkup_header_flickrcustomicon',
				'type'     => 'media',
				'url'      => true,
				'required' => array( 
					array( 'thinkup_header_flickrswitch', '=', 
						array( '1' ),
					), 
				)
			),

			// Pinterest social settings
			array(
				'title'                      => __('Pinterest', 'consulting'), 
				$thinkup_subtitle_panel      => __('Enable link to Pinterest profile.', 'consulting'),
				$thinkup_subtitle_customizer => __('Enable link to Pinterest profile.', 'consulting'),
				'id'                         => 'thinkup_header_pinterestswitch',
				'type'                       => 'switch',
				'default'                    => '0',
			),

			array(
				'desc'     => __('Input the url to your Pinterest page. <strong>Note:</strong> Add http:// as the url is an external link.', 'consulting'),
				'id'       => 'thinkup_header_pinterestlink',
				'type'     => 'text',
				'validate' => 'html',
				'required' => array( 
					array( 'thinkup_header_pinterestswitch', '=', 
						array( '1' ),
					), 
				)
			),

			array(
				'desc'     => __('Use Custom Pinterest Icon', 'consulting'),
				'id'       => 'thinkup_header_pinteresticonswitch',
				'type'     => 'checkbox',
				'default'  => '0',
				'required' => array( 
					array( 'thinkup_header_pinterestswitch', '=', 
						array( '1' ),
					), 
				)
			),

			array(
				'desc'     => __('Add a link to the image or upload one from your desktop. The image will be resized.', 'consulting'),
				'id'       => 'thinkup_header_pinterestcustomicon',
				'type'     => 'media',
				'url'      => true,
				'required' => array( 
					array( 'thinkup_header_pinterestswitch', '=', 
						array( '1' ),
					), 
				)
			),

			// Xing social settings
			array(
				'title'                      => __('Xing', 'consulting'), 
				$thinkup_subtitle_panel      => __('Enable link to Xing profile.', 'consulting'),
				$thinkup_subtitle_customizer => __('Enable link to Xing profile.', 'consulting'),
				'id'                         => 'thinkup_header_xingswitch',
				'type'                       => 'switch',
				'default'                    => '0',
			),

			array(
				'desc'     => __('Input the url to your Xing page. <strong>Note:</strong> Add http:// as the url is an external link.', 'consulting'),
				'id'       => 'thinkup_header_xinglink',
				'type'     => 'text',
				'validate' => 'html',
				'required' => array( 
					array( 'thinkup_header_xingswitch', '=', 
						array( '1' ),
					), 
				)
			),				

			array(
				'desc'     => __('Use Custom Xing Icon', 'consulting'),
				'id'       => 'thinkup_header_xingiconswitch',
				'type'     => 'checkbox',
				'default'  => '0',
				'required' => array( 
					array( 'thinkup_header_xingswitch', '=', 
						array( '1' ),
					), 
				)
			),

			array(
				'desc'     => __('Add a link to the image or upload one from your desktop. The image will be resized.', 'consulting'),
				'id'       => 'thinkup_header_xingcustomicon',
				'type'     => 'media',
				'url'      => true,
				'required' => array( 
					array( 'thinkup_header_xingswitch', '=', 
						array( '1' ),
					), 
				)
			),

			// PayPal social settings
			array(
				'title'                      => __('PayPal', 'consulting'), 
				$thinkup_subtitle_panel      => __('Enable link to PayPal profile.', 'consulting'),
				$thinkup_subtitle_customizer => __('Enable link to PayPal profile.', 'consulting'),
				'id'                         => 'thinkup_header_paypalswitch',
				'type'                       => 'switch',
				'default'                    => '0',
			),

			array(
				'desc'     => __('Input the url to your PayPal page. <strong>Note:</strong> Add http:// as the url is an external link.', 'consulting'),
				'id'       => 'thinkup_header_paypallink',
				'type'     => 'text',
				'validate' => 'html',
				'required' => array( 
					array( 'thinkup_header_paypalswitch', '=', 
						array( '1' ),
					), 
				)
			),

			array(
				'desc'     => __('Use Custom PayPal Icon', 'consulting'),
				'id'       => 'thinkup_header_paypaliconswitch',
				'type'     => 'checkbox',
				'default'  => '0',
				'required' => array( 
					array( 'thinkup_header_paypalswitch', '=', 
						array( '1' ),
					), 
				)
			),

			array(
				'desc'     => __('Add a link to the image or upload one from your desktop. The image will be resized.', 'consulting'),
				'id'       => 'thinkup_header_paypalcustomicon',
				'type'     => 'media',
				'url'      => true,
				'required' => array( 
					array( 'thinkup_header_paypalswitch', '=', 
						array( '1' ),
					), 
				)
			),

			// YouTube social settings
			array(
				'title'                      => __('YouTube', 'consulting'), 
				$thinkup_subtitle_panel      => __('Enable link to YouTube profile.', 'consulting'),
				$thinkup_subtitle_customizer => __('Enable link to YouTube profile.', 'consulting'),
				'id'                         => 'thinkup_header_youtubeswitch',
				'type'                       => 'switch',
				'default'                    => '0',
			),

			array(
				'desc'     => __('Input the url to your YouTube page. <strong>Note:</strong> Add http:// as the url is an external link.', 'consulting'),
				'id'       => 'thinkup_header_youtubelink',
				'type'     => 'text',
				'validate' => 'html',
				'required' => array( 
					array( 'thinkup_header_youtubeswitch', '=', 
						array( '1' ),
					), 
				)
			),

			array(
				'desc'     => __('Use Custom YouTube Icon', 'consulting'),
				'id'       => 'thinkup_header_youtubeiconswitch',
				'type'     => 'checkbox',
				'default'  => '0',
				'required' => array( 
					array( 'thinkup_header_youtubeswitch', '=', 
						array( '1' ),
					), 
				)
			),

			array(
				'desc'     => __('Add a link to the image or upload one from your desktop. The image will be resized.', 'consulting'),
				'id'       => 'thinkup_header_youtubecustomicon',
				'type'     => 'media',
				'url'      => true,
				'required' => array( 
					array( 'thinkup_header_youtubeswitch', '=', 
						array( '1' ),
					), 
				)
			),

			// Vimeo social settings
			array(
				'title'                      => __('Vimeo', 'consulting'), 
				$thinkup_subtitle_panel      => __('Enable link to Vimeo profile.', 'consulting'),
				$thinkup_subtitle_customizer => __('Enable link to Vimeo profile.', 'consulting'),
				'id'                         => 'thinkup_header_vimeoswitch',
				'type'                       => 'switch',
				'default'                    => '0',
			),

			array(
				'desc'     => __('Input the url to your Vimeo page. <strong>Note:</strong> Add http:// as the url is an external link.', 'consulting'),
				'id'       => 'thinkup_header_vimeolink',
				'type'     => 'text',
				'validate' => 'html',
				'required' => array( 
					array( 'thinkup_header_vimeoswitch', '=', 
						array( '1' ),
					), 
				)
			),

			array(
				'desc'     => __('Use Custom Vimeo Icon', 'consulting'),
				'id'       => 'thinkup_header_vimeoiconswitch',
				'type'     => 'checkbox',
				'default'  => '0',
				'required' => array( 
					array( 'thinkup_header_vimeoswitch', '=', 
						array( '1' ),
					), 
				)
			),

			array(
				'desc'     => __('Add a link to the image or upload one from your desktop. The image will be resized.', 'consulting'),
				'id'       => 'thinkup_header_vimeocustomicon',
				'type'     => 'media',
				'url'      => true,
				'required' => array( 
					array( 'thinkup_header_vimeoswitch', '=', 
						array( '1' ),
					),
				)
			),

			// RSS social settings
			array(
				'title'                      => __('RSS', 'consulting'), 
				$thinkup_subtitle_panel      => __('Enable link to RSS profile.', 'consulting'),
				$thinkup_subtitle_customizer => __('Enable link to RSS profile.', 'consulting'),
				'id'                         => 'thinkup_header_rssswitch',
				'type'                       => 'switch',
				'default'                    => '0',
			),

			array(
				'desc'     => __('Input the url to your RSS page. <strong>Note:</strong> Add http:// as the url is an external link.', 'consulting'),
				'id'       => 'thinkup_header_rsslink',
				'type'     => 'text',
				'validate' => 'html',
				'required' => array( 
					array( 'thinkup_header_rssswitch', '=', 
						array( '1' ),
					), 
				)
			),				

			array(
				'desc'     => __('Use Custom RSS Icon', 'consulting'),
				'id'       => 'thinkup_header_rssiconswitch',
				'type'     => 'checkbox',
				'default'  => '0',
				'required' => array( 
					array( 'thinkup_header_rssswitch', '=', 
						array( '1' ),
					), 
				)
			),

			array(
				'desc'     => __('Add a link to the image or upload one from your desktop. The image will be resized.', 'consulting'),
				'id'       => 'thinkup_header_rsscustomicon',
				'type'     => 'media',
				'url'      => true,
				'required' => array( 
					array( 'thinkup_header_rssswitch', '=', 
						array( '1' ),
					), 
				)
			),

			// Email social settings
			array(
				'title'                      => __('Email', 'consulting'), 
				$thinkup_subtitle_panel      => __('Enable link to Email.', 'consulting'),
				$thinkup_subtitle_customizer => __('Enable link to Email.', 'consulting'),
				'id'                         => 'thinkup_header_emailswitch',
				'type'                       => 'switch',
				'default'                    => '0',
			),

			array(
				'desc'     => __('Input your email address. <strong>Note:</strong> Add mailto: as prefix to open link as email.', 'consulting'),
				'id'       => 'thinkup_header_emaillink',
				'type'     => 'text',
				'validate' => 'html',
				'required' => array( 
					array( 'thinkup_header_emailswitch', '=', 
						array( '1' ),
					), 
				)
			),

			array(
				'desc'     => __('Use Custom Email Icon', 'consulting'),
				'id'       => 'thinkup_header_emailiconswitch',
				'type'     => 'checkbox',
				'default'  => '0',
				'required' => array( 
					array( 'thinkup_header_emailswitch', '=', 
						array( '1' ),
					), 
				)
			),

			array(
				'desc'     => __('Add a link to the image or upload one from your desktop. The image will be resized.', 'consulting'),
				'id'       => 'thinkup_header_emailcustomicon',
				'type'     => 'media',
				'url'      => true,
				'required' => array( 
					array( 'thinkup_header_emailswitch', '=', 
						array( '1' ),
					), 
				)
			),
		)
	) );


	// -----------------------------------------------------------------------------------
	//	5.	Blog
	// -----------------------------------------------------------------------------------

	Redux::setSection( $opt_name, array(
		'title'      => __('Blog', 'consulting'),
		'desc'       => __('<span class="redux-title">Control Blog (Archive) Pages</span>', 'consulting'),
		'icon'       => 'el el-comment',
		'icon_class' => '',
        'subsection' => $thinkup_customizer_subsection,
        'customizer' => true,
		'fields'     => array(

			array(
				'title'                      => __('Blog Layout', 'consulting'), 
				$thinkup_subtitle_panel      => __('Select blog page layout. Only applied to the main blog page and not individual posts.', 'consulting'),
				$thinkup_subtitle_customizer => __('Select blog page layout. Only applied to the main blog page and not individual posts.', 'consulting'),
				'id'                         => 'thinkup_blog_layout',
				'type'                       => 'image_select',
				'compiler'                   => true,
				'options'                    => array(
					'option1' => trailingslashit( get_template_directory_uri() ) . 'admin/main/assets/img/layout/blog/option01.png',
					'option2' => trailingslashit( get_template_directory_uri() ) . 'admin/main/assets/img/layout/blog/option02.png',
					'option3' => trailingslashit( get_template_directory_uri() ) . 'admin/main/assets/img/layout/blog/option03.png',
				),
			),

			array(
				'title'                      => __('Select a Sidebar', 'consulting'), 
				$thinkup_subtitle_panel      => __('<strong>Note:</strong> Sidebars will not be applied to homepage Blog. Control sidebars on the homepage from the &#39;Home Settings&#39; option.', 'consulting'),
				$thinkup_subtitle_customizer => __('<strong>Note:</strong> Sidebars will not be applied to homepage Blog. Control sidebars on the homepage from the &#39;Home Settings&#39; option.', 'consulting'),
				'id'                         => 'thinkup_blog_sidebars',
				'type'                       => 'select',
				'data'                       => 'sidebars',
				'required'                   => array( 
					array( 'thinkup_blog_layout', '=', 
						array( 'option2', 'option3' ),
					), 
				)
			),

			array(
				'title'                      => __('Blog Style', 'consulting'), 
				$thinkup_subtitle_panel      => __('Select a style for the blog page. This will also be applied to all pages set using the blog template.', 'consulting'),
				$thinkup_subtitle_customizer => __('Select a style for the blog page. This will also be applied to all pages set using the blog template.', 'consulting'),
				'id'                         => 'thinkup_blog_style',
				'type'                       => 'radio',
				'options'                    => array( 
					'option1' => 'Style 1',
					'option2' => 'Style 2',
				),
				'default'                    => 'option2',
			),

			array(
				'title'                      => __('Blog Traditional Layout', 'consulting'), 
				$thinkup_subtitle_panel      => __('Select a layout for your blog page. This will also be applied to all pages set using the blog template.', 'consulting'),
				$thinkup_subtitle_customizer => __('Select a layout for your blog page. This will also be applied to all pages set using the blog template.', 'consulting'),
				'id'                         => 'thinkup_blog_style1layout',
				'type'                       => 'radio',
				'options'                    => array( 
					'option1' => 'Style 1 (Quarter Width)',
					'option2' => 'Style 2 (Full Width)',
				),
				'required'                   => array( 
					array( 'thinkup_blog_style', '=', 
						array( 'option1' ),
					), 
				)
			),

			array(
				'title'                      => __('Blog Grid Layout', 'consulting'), 
				$thinkup_subtitle_panel      => __('Select a column layout for your blog page. This will also be applied to all pages set using the blog template.', 'consulting'),
				$thinkup_subtitle_customizer => __('Select a column layout for your blog page. This will also be applied to all pages set using the blog template.', 'consulting'),
				'id'                         => 'thinkup_blog_style2layout',
				'type'                       => 'radio',
				'options'                    => array( 
					'option1' => '1 column',
					'option2' => '2 column',
					'option3' => '3 column',
					'option4' => '4 column',
				),
				'required'                   => array( 
					array( 'thinkup_blog_style', '=', 
						array( 'option2' ),
					), 
				),
				'default'                    => 'option3',
			),

			array(
				'title'                      => __('Blog Links', 'consulting'),
				$thinkup_subtitle_panel      => __('Choose which links to show on the post hover.', 'consulting'),
				$thinkup_subtitle_customizer => __('Choose which links to show on the post hover.', 'consulting'),
				'id'                         => 'thinkup_blog_hovercheck',
				'type'                       => 'checkbox',
				'options'                    => array(
					'option1' => 'Check to show lightbox link',
					'option2' => 'Check to show project link',
				),
				'default'                   => array(
					'option1' => '1', 
					'option2' => '1', 
				),
			),

			array(
				'title'   => __('Hide Post Title', 'consulting'), 
				'desc'    => __('Check to disable post title on blog page.', 'consulting'),
				'id'      => 'thinkup_blog_title',
				'type'    => 'checkbox',
				'default' => '0',
			),

			array(
				'title'   => __('Blog Meta Content', 'consulting'), 
				'id'      => 'thinkup_blog_contentcheck',
				'type'    => 'checkbox',
				'options' => array(
					'option1' => 'Hide date posted.',
					'option2' => 'Hide post author.',
					'option3' => 'Hide total comments.',
					'option4' => 'Hide post categories.',
					'option5' => 'Hide post tags.'
				),
			),

			array(
				'title'                      => __('Post Content', 'consulting'), 
				$thinkup_subtitle_panel      => __('Control how much content you want to show from each post on the main blog page. Remember to control the full article content by using the Wordpress <a href="http://en.support.wordpress.com/splitting-content/more-tag/">more</a> tag in your post.', 'consulting'),
				$thinkup_subtitle_customizer => __('Control how much content you want to show from each post on the main blog page. Remember to control the full article content by using the Wordpress <a href="http://en.support.wordpress.com/splitting-content/more-tag/">more</a> tag in your post.', 'consulting'),
				'id'                         => 'thinkup_blog_postswitch',
				'type'                       => 'radio',
				'options'                    => array( 
					'option1' => 'Show excerpt',
					'option2' => 'Show full article',
					'option3' => 'Hide article',
				),
			),

			array(
				'title'                      => __('Excerpt Length', 'consulting'), 
				$thinkup_subtitle_panel      => __('Specify number of words in post excerpt.<br />Default = 55.', 'consulting'),
				$thinkup_subtitle_customizer => __('Specify number of words in post excerpt.<br />Default = 55.', 'consulting'),
				'id'                         => 'thinkup_blog_postexcerpt',
				'type'                       => 'select',
				'data'                       => 'excerpt',
				'required'                   => array( 
					array( 'thinkup_blog_postswitch', '=', 
						array( 'option1' ),
					), 
				)
			),

            array(
                'id'       => 'thinkup_section_post_layout',
                'type'     => $thinkup_section_field,
                'title'    => __( ' ', 'consulting' ),
                'subtitle' => __( '<span class="redux-title">Control Single Post Page</span>', 'consulting' ),
                'indent'   => false,
            ),

			array(
				'title'                      => __('Post Layout', 'consulting'), 
				$thinkup_subtitle_panel      => __('Select blog page layout. This will only be applied to individual posts and not the main blog page.', 'consulting'),
				$thinkup_subtitle_customizer => __('Select blog page layout. This will only be applied to individual posts and not the main blog page.', 'consulting'),
				'id'                         => 'thinkup_post_layout',
				'type'                       => 'image_select',
				'compiler'                   => true,
				'options'                    => array(
					'option1' => trailingslashit( get_template_directory_uri() ) . 'admin/main/assets/img/layout/blog/option01.png',
					'option2' => trailingslashit( get_template_directory_uri() ) . 'admin/main/assets/img/layout/blog/option02.png',
					'option3' => trailingslashit( get_template_directory_uri() ) . 'admin/main/assets/img/layout/blog/option03.png',
				),
			),

			array(
				'title'                      => __('Select a Sidebar', 'consulting'), 
				$thinkup_subtitle_panel      => __('Choose a sidebar to use with the layout.', 'consulting'),
				$thinkup_subtitle_customizer => __('Choose a sidebar to use with the layout.', 'consulting'),
				'id'                         => 'thinkup_post_sidebars',
				'type'                       => 'select',
				'data'                       => 'sidebars',
				'required'                   => array( 
					array( 'thinkup_post_layout', '=', 
						array( 'option2', 'option3' ),
					), 
				)
			),

			array(
				'title'   => __('Post Meta Content', 'consulting'), 
				'id'      => 'thinkup_post_contentcheck',
				'type'    => 'checkbox',
				'options' => array(
					'option1' => 'Hide date posted.',
					'option2' => 'Hide post author.',
					'option3' => 'Hide total comments.',
					'option4' => 'Hide post categories.',
					'option5' => 'Hide post tags.',
					'option6' => 'Hide post title.',
				),
			),			

			array(
				'title'                      => __('Show Author Bio', 'consulting'), 
				$thinkup_subtitle_panel      => __('Check to enable the author biography.', 'consulting'),
				$thinkup_subtitle_customizer => __('Check to enable the author biography.', 'consulting'),
				'id'                         => 'thinkup_post_authorbio',
				'type'                       => 'switch',
				'default'                    => '0',
			),

			array(
				'title'                      => __('Show Social Sharing', 'consulting'), 
				$thinkup_subtitle_panel      => __('Check to enable social media sharing.', 'consulting'),
				$thinkup_subtitle_customizer => __('Check to enable social media sharing.', 'consulting'),
				'id'                         => 'thinkup_post_share',
				'type'                       => 'switch',
				'default'                    => '0',
			),							

			array(
				'title'                      => __('Sharing Message', 'consulting'), 
				$thinkup_subtitle_panel      => __('Specify a message to encourage sharing.<br />Leave blank to display the default message.', 'consulting'),
				$thinkup_subtitle_customizer => __('Specify a message to encourage sharing.<br />Leave blank to display the default message.', 'consulting'),
				'id'                         => 'thinkup_post_sharemessage',
				'type'                       => 'text',
				'validate'                   => 'html',
				'required'                   => array( 
					array( 'thinkup_post_share', '=', 
						array( '1' ),
					), 
				)
			),

			array(
				'id'      => 'thinkup_post_sharecheck',
				'type'    => 'checkbox',
				'options' => array(
					'option1' => 'Enable sharing on Facebook',
					'option2' => 'Enable sharing on Twitter',
					'option3' => 'Enable sharing on Google+',
					'option4' => 'Enable sharing on LinkedIn',
					'option5' => 'Enable sharing on Tumblr',
					'option6' => 'Enable sharing on Pinterest',
					'option7' => 'Enable sharing on email',
				),
				'required' => array( 
					array( 'thinkup_post_share', '=', 
						array( '1' ),
					), 
				)
			),	
		)
	) );


	// -----------------------------------------------------------------------------------
	//	6.	Portfolio
	// -----------------------------------------------------------------------------------

	Redux::setSection( $opt_name, array(
		'title'      => __('Portfolio', 'consulting'),
		'desc'       => __('<span class="redux-title">Portfolio Settings</span>', 'consulting'),
		'icon'       => 'el el-th',
		'icon_class' => '',
        'subsection' => $thinkup_customizer_subsection,
        'customizer' => false,
		'fields'     => array(

			array(
				'title'                      => __('Portfolio Layout', 'consulting'), 
				$thinkup_subtitle_panel      => __('Select Portfolio page layout. This will only be applied to the main portfolio page and not individual projects.', 'consulting'),
				$thinkup_subtitle_customizer => __('Select Portfolio page layout. This will only be applied to the main portfolio page and not individual projects.', 'consulting'),
				'id'                         => 'thinkup_portfolio_layout',
				'type'                       => 'image_select',
				'compiler'                   => true,
				'options'                    => array(
					'option1' => trailingslashit( get_template_directory_uri() ) . 'admin/main/assets/img/layout/portfolio/option01.png',
					'option2' => trailingslashit( get_template_directory_uri() ) . 'admin/main/assets/img/layout/portfolio/option02.png',
					'option3' => trailingslashit( get_template_directory_uri() ) . 'admin/main/assets/img/layout/portfolio/option03.png',
					'option4' => trailingslashit( get_template_directory_uri() ) . 'admin/main/assets/img/layout/portfolio/option04.png',
					'option5' => trailingslashit( get_template_directory_uri() ) . 'admin/main/assets/img/layout/portfolio/option05.png',
					'option6' => trailingslashit( get_template_directory_uri() ) . 'admin/main/assets/img/layout/portfolio/option06.png',
					'option7' => trailingslashit( get_template_directory_uri() ) . 'admin/main/assets/img/layout/portfolio/option07.png',
					'option8' => trailingslashit( get_template_directory_uri() ) . 'admin/main/assets/img/layout/portfolio/option08.png',
				),
			),

			array(
				'title'                      => __('Select a Sidebar', 'consulting'), 
				$thinkup_subtitle_panel      => __('Choose a sidebar to use with the layout.', 'consulting'),
				$thinkup_subtitle_customizer => __('Choose a sidebar to use with the layout.', 'consulting'),
				'id'                         => 'thinkup_portfolio_sidebars',
				'type'                       => 'select',
				'data'                       => 'sidebars',
				'required'                   => array( 
					array( 'thinkup_portfolio_layout', '=', 
						array( 'option5', 'option6', 'option7', 'option8' ),
					), 
				)
			),

			array(
				'title'                      => __('Portfolio Filter Style', 'consulting'), 
				$thinkup_subtitle_panel      => __('Choose which filter style to use.', 'consulting'),
				$thinkup_subtitle_customizer => __('Choose which filter style to use.', 'consulting'),
				'id'                         => 'thinkup_portfolio_filter',
				'type'                       => 'radio',
				'options'                    => array( 
					'option1' => 'Style 1 (underline)',
					'option2' => 'Style 2 (button)',
				),
			),

			array(
				'title'                      => __('Portfolio Content Style', 'consulting'), 
				$thinkup_subtitle_panel      => __('Choose a style for the portfolio content area.', 'consulting'),
				$thinkup_subtitle_customizer => __('Choose a style for the portfolio content area.', 'consulting'),
				'id'                         => 'thinkup_portfolio_contentstyleswitch',
				'type'                       => 'radio',
				'options'                    => array( 
					'option1' => 'Style 1',
					'option2' => 'Style 2',
				),
			),

			array(
				'title'                      => __('Portfolio Links', 'consulting'),
				$thinkup_subtitle_panel      => __('Choose which links to show on the project hover.', 'consulting'),
				$thinkup_subtitle_customizer => __('Choose which links to show on the project hover.', 'consulting'),
				'id'                         => 'thinkup_portfolio_hovercheck',
				'type'                       => 'checkbox',
				'options'                    => array(
					'option1' => 'Check to show lightbox link',
					'option2' => 'Check to show project link',
				),
				'default' => array(
					'option1' => '1', 
					'option2' => '1', 
				),
			),

			array(
				'title'                      => __('Portfolio Content', 'consulting'),
				$thinkup_subtitle_panel      => __('Choose which content to display below the project image.', 'consulting'),
				$thinkup_subtitle_customizer => __('Choose which content to display below the project image.', 'consulting'),
				'id'                         => 'thinkup_portfolio_check',
				'type'                       => 'checkbox',
				'options'                    => array(
					'option1' => 'Check to show project title',
					'option2' => 'Check to show project excerpt',
				),
			),

			array(
				'title'                      => __('Excerpt Length', 'consulting'), 
				$thinkup_subtitle_panel      => __('Specify number of words in project excerpt.<br />Default = Full excerpt.', 'consulting'),
				$thinkup_subtitle_customizer => __('Specify number of words in project excerpt.<br />Default = Full excerpt.', 'consulting'),
				'id'                         => 'thinkup_portfolio_excerptlength',
				'type'                       => 'select',
				'data'                       => 'excerpt',
//				'required'                   => array( 
//					array( 'thinkup_portfolio_check', '=', 
//						array( 'option2' ),
//					), 
//				)
			),

			array(
				'title'                      => __('Enable Portfolio Slider', 'consulting'), 
				$thinkup_subtitle_panel      => __('Switch on to enable portfolio slider.', 'consulting'),
				$thinkup_subtitle_customizer => __('Switch on to enable portfolio slider.', 'consulting'),
				'id'                         => 'thinkup_portfolio_sliderswitch',
				'type'                       => 'switch',
				'default' 		             => 0,
			),

			array(
				'title'                      => __('Slider Categories', 'consulting'), 
				$thinkup_subtitle_panel      => __('Select the project category for slides.<br />(Leave blank for all).', 'consulting'),
				$thinkup_subtitle_customizer => __('Select the project category for slides.<br />(Leave blank for all).', 'consulting'),
				'id'                         => 'thinkup_portfolio_slidercategory',
				'type'                       => 'select',
				'data'                       => 'category',
				'required'                   => array( 
					array( 'thinkup_portfolio_sliderswitch', '=', 
						array( '1' ),
					), 
				)
			),

			array(
				'id'                         => 'thinkup_portfolio_sliderheight',
				'type'                       => 'slider', 
				'title'                      => __('Slider Height (Max)', 'consulting'),
				$thinkup_subtitle_panel      => __('Specify the maximum slider height (px).', 'consulting'),
				$thinkup_subtitle_customizer => __('Specify the maximum slider height (px).', 'consulting'),
				"default"                    => "300",
				"min"                        => "200",
				"step"                       => "5",
				"max"                        => "600",
				'required' => array( 
					array( 'thinkup_portfolio_sliderswitch', '=', 
						array( '1' ),
					), 
				)
			),

			array(
				'title'                      => __('Enable Featured Projects', 'consulting'), 
				$thinkup_subtitle_panel      => __('Switch on to enable featured projects.', 'consulting'),
				$thinkup_subtitle_customizer => __('Switch on to enable featured projects.', 'consulting'),
				'id'                         => 'thinkup_portfolio_featuredswitch',
				'type'                       => 'switch',
				'default' 		             => 0,
			),

			array(
				'title'                      => __('Featured Category', 'consulting'), 
				$thinkup_subtitle_panel      => __('Select the project category for carousel.<br />(Leave blank for all).', 'consulting'),
				$thinkup_subtitle_customizer => __('Select the project category for carousel.<br />(Leave blank for all).', 'consulting'),
				'id'                         => 'thinkup_portfolio_featuredcategory',
				'type'                       => 'select',
				'data'                       => 'category',
				'required'                   => array( 
					array( 'thinkup_portfolio_featuredswitch', '=', 
						array( '1' ),
					), 
				)
			),

			array(
				'title'                      => __('Visible Projects', 'consulting'), 
				$thinkup_subtitle_panel      => __('Specify number of visible projects in carousel.', 'consulting'),
				$thinkup_subtitle_customizer => __('Specify number of visible projects in carousel.', 'consulting'),
				'id'                         => 'thinkup_portfolio_featuredcategoryitems',
				'type'                       => 'select',
				'options'                    => array(
					'2' => '2',
					'3' => '3',
					'4' => '4',
					'5' => '5',
				),
				'default'                    => '2',
				'required'                   => array( 
					array( 'thinkup_portfolio_featuredswitch', '=', 
						array( '1' ),
					), 
				)
			),

			array(
				'title'                      => __('Scroll Projects', 'consulting'), 
				$thinkup_subtitle_panel      => __('Specify number of projects to scroll on navigation.', 'consulting'),
				$thinkup_subtitle_customizer => __('Specify number of projects to scroll on navigation.', 'consulting'),
				'id'                         => 'thinkup_portfolio_featuredcategoryscroll',
				'type'                       => 'select',
				'options'                    => array(
					'1' => '1',
					'2' => '2',
					'3' => '3',
					'4' => '4'
				),
				'default'                     => '1',
				'required'                    => array( 
					array( 'thinkup_portfolio_featuredswitch', '=', 
						array( '1' ),
					), 
				)
			),

			array(
				'title'                      => __('Portolio Redirect', 'consulting'), 
				$thinkup_subtitle_panel      => __('Redirect all project pages to the main portfolio page (www.your-site.com/portfolio)', 'consulting'),
				$thinkup_subtitle_customizer => __('Redirect all project pages to the main portfolio page (www.your-site.com/portfolio)', 'consulting'),
				'desc'                       => __('Check to disable individual project pages.', 'consulting'),
				'id'                         => 'thinkup_portfolio_redirect',
				'type'                       => 'checkbox',
				'default'                    => '0',
			),

            array(
                'id'       => 'thinkup_section_project_layout',
                'type'     => $thinkup_section_field,
                'title'    => __( ' ', 'consulting' ),
                'subtitle' => __( '<span class="redux-title">Project Settings</span>', 'consulting' ),
                'indent'   => false,
            ),

			array(
				'title'                      => __('Project Layout', 'consulting'), 
				$thinkup_subtitle_panel      => __('Select project layout. This will only be applied to individual project pages (I.e. Not portfolio page).', 'consulting'),
				$thinkup_subtitle_customizer => __('Select project layout. This will only be applied to individual project pages (I.e. Not portfolio page).', 'consulting'),
				'id'                         => 'thinkup_project_layout',
				'type'                       => 'image_select',
				'compiler'                   => true,
				'default'                    => 'option1',
				'options'                    => array(
					'option1' => trailingslashit( get_template_directory_uri() ) . 'admin/main/assets/img/layout/blog/option01.png',
					'option2' => trailingslashit( get_template_directory_uri() ) . 'admin/main/assets/img/layout/blog/option02.png',
					'option3' => trailingslashit( get_template_directory_uri() ) . 'admin/main/assets/img/layout/blog/option03.png',
				),
			),					

			array(
				'title'                      => __('Select a Sidebar', 'consulting'), 
				$thinkup_subtitle_panel      => __('Choose a sidebar to use with the layout.', 'consulting'),
				$thinkup_subtitle_customizer => __('Choose a sidebar to use with the layout.', 'consulting'),
				'id'                         => 'thinkup_project_sidebars',
				'type'                       => 'select',
				'data'                       => 'sidebars',
				'required'                   => array( 
					array( 'thinkup_project_layout', '=', 
						array( 'option2', 'option3' ),
					), 
				)
			),

			array(
				'title'                      => __('Project Navigation', 'consulting'), 
				$thinkup_subtitle_panel      => __('Switch on to allow navigation between projects.', 'consulting'),
				$thinkup_subtitle_customizer => __('Switch on to allow navigation between projects.', 'consulting'),
				'id'                         => 'thinkup_project_navigationswitch',
				'type'                       => 'switch',
				'default' 		             => 0,
			),
		)
	) );


	// -----------------------------------------------------------------------------------
	//	7.	Contact Page
	// -----------------------------------------------------------------------------------

	Redux::setSection( $opt_name, array(
		'title'      => __('Contact Page', 'consulting'),
		'desc'       => __('<span class="redux-title">Contact Us Page</span>', 'consulting'),
		'icon'       => 'el el-envelope',
		'icon_class' => '',
        'subsection' => $thinkup_customizer_subsection,
        'customizer' => false,
		'fields'     => array(

			array(
				'title'                      => __('Map Address', 'consulting'), 
				$thinkup_subtitle_panel      => __('Enter the address for the map position.<br><br>You can also add a shortcode from any Maps plugin you like. Alternatively get the embed code from <a href="https://maps.google.com/" target="_blank" style="text-decoration: none;">Google Maps</a>.', 'consulting'),
				$thinkup_subtitle_customizer => __('Enter the address for the map position.<br><br>You can also add a shortcode from any Maps plugin you like. Alternatively get the embed code from <a href="https://maps.google.com/" target="_blank" style="text-decoration: none;">Google Maps</a>.', 'consulting'),
				'id'                         => 'thinkup_contact_map',
				'type'                       => 'textarea',
				'validate'                   => 'html',
			),

			array(
				'title'   => __('Map Position', 'consulting'), 
				'id'      => 'thinkup_contact_mapposition',
				'type'    => 'select',
				'options' => array( 
					'option1' => 'Top.',
					'option2' => 'Bottom.',
				),
			),

			array(
				'title'                      => __('Contact Form Shortcode', 'consulting'), 
				$thinkup_subtitle_panel      => __('Insert contact form shortcode.', 'consulting'),
				$thinkup_subtitle_customizer => __('Insert contact form shortcode.', 'consulting'),
				'id'                         => 'thinkup_contact_form',
				'type'                       => 'textarea',
				'validate'                   => 'html',
			),

			array(
				'title'                      => __('Company Information', 'consulting'), 
				$thinkup_subtitle_panel      => __('Add more details about your company.<br />Give more information about what you do.', 'consulting'),
				$thinkup_subtitle_customizer => __('Add more details about your company.<br />Give more information about what you do.', 'consulting'),
				'id'                         => 'thinkup_contact_info',
				'type'                       => 'textarea',
				'validate'                   => 'html',
			),

            array(
                'id'       => 'thinkup_section_contact_address',
                'type'     => $thinkup_section_field,
                'title'    => __( ' ', 'consulting' ),
                'subtitle' => __( '<span class="redux-title">Contact Details</span>', 'consulting' ),
                'indent'   => false,
            ),

			array(
				$thinkup_subtitle_panel      => __('Address.', 'consulting'),
				$thinkup_subtitle_customizer => __('Address.', 'consulting'),
				'id'                         => 'thinkup_contact_address',
				'type'                       => 'text',
				'validate'                   => 'html',
			),

			array(
				$thinkup_subtitle_panel      => __('Phone.', 'consulting'),
				$thinkup_subtitle_customizer => __('Phone.', 'consulting'),
				'id'                         => 'thinkup_contact_phone',
				'type'                       => 'text',
				'validate'                   => 'html',
			),

			array(
				$thinkup_subtitle_panel      => __('Email.', 'consulting'),
				$thinkup_subtitle_customizer => __('Email.', 'consulting'),
				'msg'                        => 'Check email address is correct.',
				'id'                         => 'thinkup_contact_email',
				'type'                       => 'text',
				'validate'                   => 'email',
			),

			array(
				$thinkup_subtitle_panel      => __('Website.', 'consulting'),
				$thinkup_subtitle_customizer => __('Website.', 'consulting'),
				'id'                         => 'thinkup_contact_website',
				'type'                       => 'text',
				'validate'                   => 'html',
			),

			array(
				'title'                      => __('Enable Icons', 'consulting'), 
				$thinkup_subtitle_panel      => __('Switch on to enable contact details icons.', 'consulting'),
				$thinkup_subtitle_customizer => __('Switch on to enable contact details icons.', 'consulting'),
				'id'                         => 'thinkup_contact_iconswitch',
				'type'                       => 'switch',
				'default' 		             => 0,
			),
		)
	) );


	// -----------------------------------------------------------------------------------
	//	8.	Special Page
	// -----------------------------------------------------------------------------------

	Redux::setSection( $opt_name, array(
		'title'      => __('Special Pages', 'consulting'),
		'desc'       => __('<span class="redux-title">Clients</span>', 'consulting'),
		'icon'       => 'el el-star',
		'icon_class' => '',
        'subsection' => $thinkup_customizer_subsection,
        'customizer' => false,
		'fields'     => array(

			array(
				'title'   => __('Client Redirect', 'consulting'), 
				'desc'    => __('Check to disable individual client pages.', 'consulting'),
				'id'      => 'thinkup_client_redirect',
				'type'    => 'checkbox',
				'default' => '0',
			),

			array(
				'title'                      => __('Client Categories', 'consulting'), 
				$thinkup_subtitle_panel      => __('Display clients in specified categories number only, comma separated. (e.g. 21,37,41&hellip;)', 'consulting'),
				$thinkup_subtitle_customizer => __('Display clients in specified categories number only, comma separated. (e.g. 21,37,41&hellip;)', 'consulting'),
				'id'                         => 'thinkup_client_category',
				'type'                       => 'text',
				'validate'                   => 'html',
			),

            array(
                'id'       => 'thinkup_section_special_team',
                'type'     => $thinkup_section_field,
                'title'    => __( ' ', 'consulting' ),
                'subtitle' => __( '<span class="redux-title">Team</span>', 'consulting' ),
                'indent'   => false,
            ),

			array(
				'title'                      => __('Team Style', 'consulting'), 
				$thinkup_subtitle_panel      => __('Choose a style for the team page.', 'consulting'),
				$thinkup_subtitle_customizer => __('Choose a style for the team page.', 'consulting'),
				'id'                         => 'thinkup_team_styleswitch',
				'type'                       => 'radio',
				'options'                    => array( 
					'option1' => 'Style 1',
					'option2' => 'Style 2',
				),
			),

			array(
				'title'                      => __('Team Layout', 'consulting'), 
				$thinkup_subtitle_panel      => __('Select a layout for the grid style team page.', 'consulting'),
				$thinkup_subtitle_customizer => __('Select a layout for the grid style team page.', 'consulting'),
				'id'                         => 'thinkup_team_layout',
				'type'                       => 'image_select',
				'compiler'                   => true,
				'options'                    => array(
					'option1' => trailingslashit( get_template_directory_uri() ) . 'admin/main/assets/img/layout/portfolio/option01.png',
					'option2' => trailingslashit( get_template_directory_uri() ) . 'admin/main/assets/img/layout/portfolio/option02.png',
					'option3' => trailingslashit( get_template_directory_uri() ) . 'admin/main/assets/img/layout/portfolio/option03.png',
					'option4' => trailingslashit( get_template_directory_uri() ) . 'admin/main/assets/img/layout/portfolio/option04.png',
				),
			),

			array(
				'title'                      => __('Team Links Style', 'consulting'), 
				$thinkup_subtitle_panel      => __('Choose a style for the team hover area.<br />Style 2 takes the theme color scheme.', 'consulting'),
				$thinkup_subtitle_customizer => __('Choose a style for the team hover area.<br />Style 2 takes the theme color scheme.', 'consulting'),
				'id'                         => 'thinkup_team_hoverstyleswitch',
				'type'                       => 'radio',
				'options'                    => array( 
					'option1' => 'Style 1 (color overlay)',
					'option2' => 'Style 2 (dark overlay)',
				),
			),

			array(
				'title'   => __('Team Content', 'consulting'), 
				'id'      => 'thinkup_team_contentcheck',
				'type'    => 'checkbox',
				'options' => array(
					'option1' => 'Hide name.',
					'option2' => 'Hide position.',
					'option3' => 'Hide excerpt.',
					'option4' => 'Hide social links.',
				),
			),

			array(
				'title'   => __('Team Redirect', 'consulting'), 
				'desc'    => __('Check to disable individual team pages.', 'consulting'),
				'id'      => 'thinkup_team_redirect',
				'type'    => 'checkbox',
				'default' => '0',
			),

            array(
                'id'       => 'thinkup_section_special_testimonial',
                'type'     => $thinkup_section_field,
                'title'    => __( ' ', 'consulting' ),
                'subtitle' => __( '<span class="redux-title">Testimonials</span>', 'consulting' ),
                'indent'   => false,
            ),

			array(
				'title'                      => __('Testimonal Style', 'consulting'), 
				$thinkup_subtitle_panel      => __('Choose a style for the testimonals page.', 'consulting'),
				$thinkup_subtitle_customizer => __('Choose a style for the testimonals page.', 'consulting'),
				'id'                         => 'thinkup_testimonal_styleswitch',
				'type'                       => 'radio',
				'options'                    => array( 
					'option1' => 'Style 1',
					'option2' => 'Style 2',
				),
			),

			array(
				'title'                      => __('Testimonal Page Links', 'consulting'), 
				$thinkup_subtitle_panel      => __('Control the links on the individual testimonials.', 'consulting'),
				$thinkup_subtitle_customizer => __('Control the links on the individual testimonials.', 'consulting'),
				'desc'                       => __('Check to disable links to individual testimonial pages.', 'consulting'),
				'id'                         => 'thinkup_testimonial_links',
				'type'                       => 'checkbox',
				'default'                    => '0',
			),

			array(
				'title'   => __('Testimonal Redirect', 'consulting'), 
				'desc'    => __('Check to disable individual testimonial pages.', 'consulting'),
				'id'      => 'thinkup_testimonial_redirect',
				'type'    => 'checkbox',
				'default' => '0',
			),

			array(
				'title'                      => __('Testimonial Categories.', 'consulting'),
				$thinkup_subtitle_panel      => __('Display testimonials in specified categories number only, comma separated. (e.g. 21,37,41&hellip;)', 'consulting'),
				$thinkup_subtitle_customizer => __('Display testimonials in specified categories number only, comma separated. (e.g. 21,37,41&hellip;)', 'consulting'),
				'id'                         => 'thinkup_testimonial_category',
				'type'                       => 'text',
				'validate'                   => 'html',
			),

            array(
                'id'       => 'thinkup_section_special_404',
                'type'     => $thinkup_section_field,
                'title'    => __( ' ', 'consulting' ),
                'subtitle' => __( '<span class="redux-title">404 Error Pages</span>', 'consulting' ),
                'indent'   => false,
            ),

			array(
				'title'                      => __('Custom Content', 'consulting'), 
				$thinkup_subtitle_panel      => __('Overwrite the theme standard 404 error page message by adding your own HTML content.', 'consulting'),
				$thinkup_subtitle_customizer => __('Overwrite the theme standard 404 error page message by adding your own HTML content.', 'consulting'),
				'id'                         => 'thinkup_404_content',
				'type'                       => 'editor',
			),

			array(
				'desc'    => __('Check to disable autoparagraph.', 'consulting'),
				'id'      => 'thinkup_404_contentparagraph',
				'type'    => 'checkbox',
				'default' => '0',
			),
		)
	) );


	// -----------------------------------------------------------------------------------
	//	9.	Notification Bar
	// -----------------------------------------------------------------------------------

	Redux::setSection( $opt_name, array(
		'title'      => __('Notification Bar', 'consulting'),
		'desc'       => __('<span class="redux-title">Control Notification Bar</span>', 'consulting'),
		'icon'       => 'el el-bullhorn',
		'icon_class' => '',
        'subsection' => $thinkup_customizer_subsection,
        'customizer' => false,
		'fields'     => array(

			array(
				'title'   => __('Enable Notification Bar', 'consulting'), 
				'desc'    => __('Check to show notification bar on site.', 'consulting'),
				'id'      => 'thinkup_notification_switch',
				'type'    => 'checkbox',
				'default' => '0',
			),	

			array(
				'title'                      => __('Notification Bar Message', 'consulting'),
				$thinkup_subtitle_panel      => __('Enter a message for your notification bar.<br /><br />This will be one of the first things that visitors see on your site. Make it interesting to make as many visitors as possible convert.', 'consulting'),
				$thinkup_subtitle_customizer => __('Enter a message for your notification bar.<br /><br />This will be one of the first things that visitors see on your site. Make it interesting to make as many visitors as possible convert.', 'consulting'),
				'id'                         => 'thinkup_notification_text',
				'type'                       => 'textarea',
				'validate'                   => 'html',
			),			

			array(
				'title'                      => __('Button Text', 'consulting'),
				$thinkup_subtitle_panel      => __('This is some sample user description text.', 'consulting'),
				$thinkup_subtitle_customizer => __('This is some sample user description text.', 'consulting'),
				'id'                         => 'thinkup_notification_button',
				'type'                       => 'text',
				'validate'                   => 'html',
			),

			array(
				'title'                      => __('Add Button Link', 'consulting'), 
				$thinkup_subtitle_panel      => __('Specify whether the notification bar should link to a page on your site, out to external webpage disable the link altogether.', 'consulting'),
				$thinkup_subtitle_customizer => __('Specify whether the notification bar should link to a page on your site, out to external webpage disable the link altogether.', 'consulting'),
				'id'                         => 'thinkup_notification_link',
				'type'                       => 'radio',
				'options'                    => array( 
					'option1' => 'Link to a Page',
					'option2' => 'Specify Custom link',
					'option3' => 'Disable Link',
				),
			),

			array(
				'title'                      => __('Link to a page', 'consulting'), 
				$thinkup_subtitle_panel      => __('Select a target page for action button link.', 'consulting'),
				$thinkup_subtitle_customizer => __('Select a target page for action button link.', 'consulting'),
				'id'                         => 'thinkup_notification_linkpage',
				'type'                       => 'select',
				'data'                       => 'pages',
				'required'                   => array( 
					array( 'thinkup_notification_link', '=', 
						array( 'option1' ),
					), 
				)
			),

			array(
				'title'                      => __('Custom Link', 'consulting'),
				$thinkup_subtitle_panel      => __('Input a custom url for the action button link.<br />Add http:// if linking to an external webpage.', 'consulting'),
				$thinkup_subtitle_customizer => __('Input a custom url for the action button link.<br />Add http:// if linking to an external webpage.', 'consulting'),
				'id'                         => 'thinkup_notification_linkcustom',
				'type'                       => 'text',
				'validate'                   => 'html',
				'required'                   => array( 
					array( 'thinkup_notification_link', '=', 
						array( 'option2' ),
					), 
				)
			),

            array(
                'id'       => 'thinkup_section_notification_positioning',
                'type'     => $thinkup_section_field,
                'title'    => __( ' ', 'consulting' ),
                'subtitle' => __( '<span class="redux-title">Positioning</span>', 'consulting' ),
                'indent'   => false,
            ),

			array(
				'title'   => __('Only show on homepage?', 'consulting'), 
				'desc'    => __('Check to only show on homepage.', 'consulting'),
				'id'      => 'thinkup_notification_homeswitch',
				'type'    => 'checkbox',
				'default' => '0',
			),

			array(
				'title'   => __('Fix Bar Position', 'consulting'), 
				'desc'    => __('Check to stick bar to the top of the page.', 'consulting'),
				'id'      => 'thinkup_notification_fixtop',
				'type'    => 'checkbox',
				'default' => '0',
			),

            array(
                'id'       => 'thinkup_section_notification_styling',
                'type'     => $thinkup_section_field,
                'title'    => __( ' ', 'consulting' ),
                'subtitle' => __( '<span class="redux-title">Styling</span>', 'consulting' ),
                'indent'   => false,
            ),

			array(
				'title'   => __('Notification Bar', 'consulting'), 
				'desc'    => __('Use custom color scheme.', 'consulting'),
				'id'      => 'thinkup_notification_backgroundcolourswitch',
				'type'    => 'checkbox',
				'default' => '0',
			),

			array(
				'id'       => 'thinkup_notification_backgroundcolour',
				'type'     => 'color',
				'validate' => 'color',
				'default'  => '#FFFFFF',
			),

			array(
				'title'   => __('Main Message', 'consulting'), 
				'desc'    => __('Use custom color scheme.', 'consulting'),
				'id'      => 'thinkup_notification_maintextcolourswitch',
				'type'    => 'checkbox',
				'default' => '0',
			),

			array(
				'id'       => 'thinkup_notification_maintextcolour',
				'type'     => 'color',
				'validate' => 'color',
				'default'  => '#FFFFFF',
			),

			array(
				'title'   => __('Button', 'consulting'), 
				'desc'    => __('Use custom color scheme.', 'consulting'),
				'id'      => 'thinkup_notification_buttoncolourswitch',
				'type'    => 'checkbox',
				'default' => '0',
			),

			array(
				'id'       => 'thinkup_notification_buttoncolour',
				'type'     => 'color',
				'validate' => 'color',
				'default'  => '#FFFFFF',
			),

			array(
				'title'   => __('Button Text', 'consulting'), 
				'desc'    => __('Use custom color scheme.', 'consulting'),
				'id'      => 'thinkup_notification_buttontextcolourswitch',
				'type'    => 'checkbox',
				'default' => '0',
			),

			array(
				'id'       => 'thinkup_notification_buttontextcolour',
				'type'     => 'color',
				'validate' => 'color',
				'default'  => '#FFFFFF',
			),
		)
	) );


	// -----------------------------------------------------------------------------------
	//	11.	Search Engine Optimisation
	// -----------------------------------------------------------------------------------

	Redux::setSection( $opt_name, array(
		'title'      => __('SEO', 'consulting'),
		'desc'       => __('<span class="redux-title">Control Search Engine Optimization</span>', 'consulting'),
		'icon'       => 'el el-search',
		'icon_class' => '',
        'subsection' => $thinkup_customizer_subsection,
        'customizer' => false,
		'fields'     => array(

			array(
				'title'                      => __('Enable SEO?', 'consulting'), 
				$thinkup_subtitle_panel      => __('Check to enable SEO features.', 'consulting'),
				$thinkup_subtitle_customizer => __('Check to enable SEO features.', 'consulting'),
				'id'                         => 'thinkup_seo_switch',
				'type'                       => 'switch',
				'default'                    => '0',
			),

			array(
				'title'                      => __('Home Page Title', 'consulting'), 
				$thinkup_subtitle_panel      => __('This title will only be shown on the homepage.<br />Note: Add titles to inner pages individually.', 'consulting'),
				$thinkup_subtitle_customizer => __('This title will only be shown on the homepage.<br />Note: Add titles to inner pages individually.', 'consulting'),
				'id'                         => 'thinkup_seo_sitetitle',
				'type'                       => 'text',
				'validate'                   => 'no_html',
			),

			array(
				'title'                      => __('Homepage Description', 'consulting'), 
				$thinkup_subtitle_panel      => __('Write a short and snappy description about what your site offers. This helps search engines learn more about your site.<br /><br />By default this is displayed on all pages. The description can be overwritten on individual pages.', 'consulting'),
				$thinkup_subtitle_customizer => __('Write a short and snappy description about what your site offers. This helps search engines learn more about your site.<br /><br />By default this is displayed on all pages. The description can be overwritten on individual pages.', 'consulting'),
				'id'                         => 'thinkup_seo_homedescription',
				'type'                       => 'textarea',
				'validate'                   => 'no_html',
			),

			array(
				'title'                      => __('Keywords (Comma Separated)', 'consulting'), 
				$thinkup_subtitle_panel      => __('Add keywords that are relevant for your site. This helps search engines learn more about your site.<br /><br />By default this is displayed on all pages. The keywords can be overwritten on individual pages.', 'consulting'),
				$thinkup_subtitle_customizer => __('Add keywords that are relevant for your site. This helps search engines learn more about your site.<br /><br />By default this is displayed on all pages. The keywords can be overwritten on individual pages.', 'consulting'),
				'id'                         => 'thinkup_seo_sitekeywords',
				'type'                       => 'textarea',
				'validate'                   => 'no_html',
			),

			array(
				'title'   => __('Meta Robot Tags', 'consulting'), 
				'id'      => 'thinkup_seo_metarobots',
				'type'    => 'checkbox',
				'options' => array(
					'option1' => 'Enable sitewide &#39;noodp&#39; meta tag.',
					'option2' => 'Enable sitewide &#39;noydir&#39; meta tag.',
				),
			),

            array(
                'id'       => 'thinkup_section_seo_metainfo',
                'type'     => $thinkup_section_field,
                'title'    => __( ' ', 'consulting' ),
                'subtitle' => __( 'Learn more about how <strong><u>noodp</u></strong> and <strong><u>noydir</u></strong> tags can influence your SEO and SERP results on <a href="http://en.wikipedia.org/wiki/Meta_element">Wikipedia</a>', 'consulting' ),
                'indent'   => false,
            ),
		)
	) );	


	// -----------------------------------------------------------------------------------
	//	12.	Typography
	// -----------------------------------------------------------------------------------

	Redux::setSection( $opt_name, array(
		'title'      => __('Typography', 'consulting'),
		'desc'       => __('<span class="redux-title">Control Font Family</span>', 'consulting'),
		'icon'       => 'el el-font',
		'icon_class' => '',
        'subsection' => $thinkup_customizer_subsection,
        'customizer' => false,
		'fields'     => array(

			array(
				'title'   => __('Body Font', 'consulting'), 
				'desc'    => __('Check to use Google fonts.', 'consulting'),
				'id'      => 'thinkup_font_bodyswitch',
				'type'    => 'checkbox',
				'default' => '0',
			),

			array(
				$thinkup_subtitle_panel      => __('Select a "Standard Font" for body text.<br />This will <strong>NOT</strong> affect text in header or footer areas.', 'consulting'),
				$thinkup_subtitle_customizer => __('Select a "Standard Font" for body text.<br />This will <strong>NOT</strong> affect text in header or footer areas.', 'consulting'),
				'id'                         => 'thinkup_font_bodystandard',
				'type'                       => 'select',
				'data'                       => 'standardfont',
				'required'                   => array( 
					array( 'thinkup_font_bodyswitch', '!=', 
						array( '1' ),
					), 
				)
			),

			array(
				$thinkup_subtitle_panel      => __('Select a "Google Font" for body text.<br />This will <strong>NOT</strong> affect text in header or footer areas.', 'consulting'),
				$thinkup_subtitle_customizer => __('Select a "Google Font" for body text.<br />This will <strong>NOT</strong> affect text in header or footer areas.', 'consulting'),
				'id'                         => 'thinkup_font_bodygoogle',
				'type'                       => 'select',
				'data'                       => 'googlefont',
				'required'                   => array( 
					array( 'thinkup_font_bodyswitch', '=', 
						array( '1' ),
					), 
				)
			),

			array(
				'title'   => __('Body Headings', 'consulting'), 
				'desc'    => __('Check to use Google fonts.', 'consulting'),
				'id'      => 'thinkup_font_bodyheadingswitch',
				'type'    => 'checkbox',
				'default' => '0',
			),

			array(
				$thinkup_subtitle_panel      => __('Select a "Standard Font" for header text.<br />This will <strong>NOT</strong> affect text in header or footer areas.', 'consulting'),
				$thinkup_subtitle_customizer => __('Select a "Standard Font" for header text.<br />This will <strong>NOT</strong> affect text in header or footer areas.', 'consulting'),
				'id'                         => 'thinkup_font_bodyheadingstandard',
				'type'                       => 'select',
				'data'                       => 'standardfont',
				'required'                   => array( 
					array( 'thinkup_font_bodyheadingswitch', '!=', 
						array( '1' ),
					), 
				)
			),

			array(
				$thinkup_subtitle_panel      => __('Select a "Google Font" for header text.<br />This will <strong>NOT</strong> affect text in header or footer areas.', 'consulting'),
				$thinkup_subtitle_customizer => __('Select a "Google Font" for header text.<br />This will <strong>NOT</strong> affect text in header or footer areas.', 'consulting'),
				'id'                         => 'thinkup_font_bodyheadinggoogle',
				'type'                       => 'select',
				'data'                       => 'googlefont',
				'required'                   => array( 
					array( 'thinkup_font_bodyheadingswitch', '=', 
						array( '1' ),
					), 
				)
			),

			array(
				'title'   => __('Pre Header Menu', 'consulting'), 
				'desc'    => __('Check to use Google fonts.', 'consulting'),
				'id'      => 'thinkup_font_preheaderswitch',
				'type'    => 'checkbox',
				'default' => '0',
			),

			array(
				$thinkup_subtitle_panel      => __('Select a "Standard Font" for pre header text.', 'consulting'),
				$thinkup_subtitle_customizer => __('Select a "Standard Font" for pre header text.', 'consulting'),
				'id'                         => 'thinkup_font_preheaderstandard',
				'type'                       => 'select',
				'data'                       => 'standardfont',
				'required'                   => array( 
					array( 'thinkup_font_preheaderswitch', '!=', 
						array( '1' ),
					), 
				)
			),

			array(
				$thinkup_subtitle_panel      => __('Select a "Google Font" for pre header text.', 'consulting'),
				$thinkup_subtitle_customizer => __('Select a "Google Font" for pre header text.', 'consulting'),
				'id'                         => 'thinkup_font_preheadergoogle',
				'type'                       => 'select',
				'data'                       => 'googlefont',
				'required'                   => array( 
					array( 'thinkup_font_preheaderswitch', '=', 
						array( '1' ),
					), 
				)
			),

			array(
				'title'   => __('Main Header Menu', 'consulting'), 
				'desc'    => __('Check to use Google fonts.', 'consulting'),
				'id'      => 'thinkup_font_mainheaderswitch',
				'type'    => 'checkbox',
				'default' => '0',
			),

			array(
				$thinkup_subtitle_panel      => __('Select a "Standard Font" for main header text.', 'consulting'),
				$thinkup_subtitle_customizer => __('Select a "Standard Font" for main header text.', 'consulting'),
				'id'                         => 'thinkup_font_mainheaderstandard',
				'type'                       => 'select',
				'data'                       => 'standardfont',
				'required'                   => array( 
					array( 'thinkup_font_mainheaderswitch', '!=', 
						array( '1' ),
					), 
				)
			),

			array(
				$thinkup_subtitle_panel      => __('Select a "Google Font" for main header text.', 'consulting'),
				$thinkup_subtitle_customizer => __('Select a "Google Font" for main header text.', 'consulting'),
				'id'                         => 'thinkup_font_mainheadergoogle',
				'type'                       => 'select',
				'data'                       => 'googlefont',
				'required'                   => array( 
					array( 'thinkup_font_mainheaderswitch', '=', 
						array( '1' ),
					), 
				)
			),

			array(
				'title'   => __('Footer Headings', 'consulting'), 
				'desc'    => __('Check to use Google fonts.', 'consulting'),
				'id'      => 'thinkup_font_footerheadingswitch',
				'type'    => 'checkbox',
				'default' => '0',
			),

			array(
				$thinkup_subtitle_panel      => __('Select a "Standard Font" for body text.', 'consulting'),
				$thinkup_subtitle_customizer => __('Select a "Standard Font" for body text.', 'consulting'),
				'id'                         => 'thinkup_font_footerheadingstandard',
				'type'                       => 'select',
				'data'                       => 'standardfont',
				'required'                   => array( 
					array( 'thinkup_font_footerheadingswitch', '!=', 
						array( '1' ),
					), 
				)
			),

			array(
				$thinkup_subtitle_panel      => __('Select a "Google Font" for body text.', 'consulting'),
				$thinkup_subtitle_customizer => __('Select a "Google Font" for body text.', 'consulting'),
				'id'                         => 'thinkup_font_footerheadinggoogle',
				'type'                       => 'select',
				'data'                       => 'googlefont',
				'required'                   => array( 
					array( 'thinkup_font_footerheadingswitch', '=', 
						array( '1' ),
					), 
				)
			),

			array(
				'title'   => __('Main Footer Menu', 'consulting'), 
				'desc'    => __('Check to use Google fonts.', 'consulting'),
				'id'      => 'thinkup_font_mainfooterswitch',
				'type'    => 'checkbox',
				'default' => '0',
			),

			array(
				$thinkup_subtitle_panel      => __('Select a "Standard Font" for footer menu text.', 'consulting'),
				$thinkup_subtitle_customizer => __('Select a "Standard Font" for footer menu text.', 'consulting'),
				'id'                         => 'thinkup_font_mainfooterstandard',
				'type'                       => 'select',
				'data'                       => 'standardfont',
				'required'                   => array( 
					array( 'thinkup_font_mainfooterswitch', '!=', 
						array( '1' ),
					), 
				)
			),

			array(
				$thinkup_subtitle_panel      => __('Select a "Google Font" for footer menu text.', 'consulting'),
				$thinkup_subtitle_customizer => __('Select a "Google Font" for footer menu text.', 'consulting'),
				'id'                         => 'thinkup_font_mainfootergoogle',
				'type'                       => 'select',
				'data'                       => 'googlefont',
				'required'                   => array( 
					array( 'thinkup_font_mainfooterswitch', '=', 
						array( '1' ),
					), 
				)
			),

			array(
				'title'   => __('Post Footer Menu', 'consulting'), 
				'desc'    => __('Check to use Google fonts.', 'consulting'),
				'id'      => 'thinkup_font_postfooterswitch',
				'type'    => 'checkbox',
				'default' => '0',
			),

			array(
				$thinkup_subtitle_panel      => __('Select a "Standard Font" for post footer text.', 'consulting'),
				$thinkup_subtitle_customizer => __('Select a "Standard Font" for post footer text.', 'consulting'),
				'id'                         => 'thinkup_font_postfooterstandard',
				'type'                       => 'select',
				'data'                       => 'standardfont',
				'required'                   => array( 
					array( 'thinkup_font_postfooterswitch', '!=', 
						array( '1' ),
					), 
				)
			),

			array(
				$thinkup_subtitle_panel      => __('Select a "Google Font" for post footer text.', 'consulting'),
				$thinkup_subtitle_customizer => __('Select a "Google Font" for post footer text.', 'consulting'),
				'id'                         => 'thinkup_font_postfootergoogle',
				'type'                       => 'select',
				'data'                       => 'googlefont',
				'required'                   => array( 
					array( 'thinkup_font_postfooterswitch', '=', 
						array( '1' ),
					), 
				)
			),

			array(
				'title'   => __('Slider Title', 'consulting'), 
				'desc'    => __('Check to use Google fonts.', 'consulting'),
				'id'      => 'thinkup_font_slidertitleswitch',
				'type'    => 'checkbox',
				'default' => '0',
			),

			array(
				$thinkup_subtitle_panel      => __('Select a "Standard Font" for the slider title.', 'consulting'),
				$thinkup_subtitle_customizer => __('Select a "Standard Font" for the slider title.', 'consulting'),
				'id'                         => 'thinkup_font_slidertitlestandard',
				'type'                       => 'select',
				'data'                       => 'standardfont',
				'required'                   => array( 
					array( 'thinkup_font_slidertitleswitch', '!=', 
						array( '1' ),
					), 
				)
			),

			array(
				$thinkup_subtitle_panel      => __('Select a "Google Font" for the slider title.', 'consulting'),
				$thinkup_subtitle_customizer => __('Select a "Google Font" for the slider title.', 'consulting'),
				'id'                         => 'thinkup_font_slidertitlegoogle',
				'type'                       => 'select',
				'data'                       => 'googlefont',
				'required'                   => array( 
					array( 'thinkup_font_slidertitleswitch', '=', 
						array( '1' ),
					), 
				)
			),

			array(
				'title'   => __('Slider Description', 'consulting'), 
				'desc'    => __('Check to use Google fonts.', 'consulting'),
				'id'      => 'thinkup_font_slidertextswitch',
				'type'    => 'checkbox',
				'default' => '0',
			),

			array(
				$thinkup_subtitle_panel      => __('Select a "Standard Font" for the slider description.', 'consulting'),
				$thinkup_subtitle_customizer => __('Select a "Standard Font" for the slider description.', 'consulting'),
				'id'                         => 'thinkup_font_slidertextstandard',
				'type'                       => 'select',
				'data'                       => 'standardfont',
				'required'                   => array( 
					array( 'thinkup_font_slidertextswitch', '!=', 
						array( '1' ),
					), 
				)
			),

			array(
				$thinkup_subtitle_panel      => __('Select a "Google Font" for the slider description.', 'consulting'),
				$thinkup_subtitle_customizer => __('Select a "Google Font" for the slider description.', 'consulting'),
				'id'                         => 'thinkup_font_slidertextgoogle',
				'type'                       => 'select',
				'data'                       => 'googlefont',
				'required'                   => array( 
					array( 'thinkup_font_slidertextswitch', '=', 
						array( '1' ),
					), 
				)
			),

            array(
                'id'       => 'thinkup_section_font_size',
                'type'     => $thinkup_section_field,
                'title'    => __( ' ', 'consulting' ),
                'subtitle' => __( '<span class="redux-title">Control Font Size</span>', 'consulting' ),
                'indent'   => false,
            ),

			array(
				'title'                      => __('Body Font', 'consulting'), 
				$thinkup_subtitle_panel      => __('Specify the body font size.', 'consulting'),
				$thinkup_subtitle_customizer => __('Specify the body font size.', 'consulting'),
				'id'                         => 'thinkup_font_bodysize',
				'type'                       => 'select',
				'data'                       => 'fontsize',
			),

			array(
				'title'                      => __('H1 Heading', 'consulting'), 
				$thinkup_subtitle_panel      => __('Specify the h1 heading font size.', 'consulting'),
				$thinkup_subtitle_customizer => __('Specify the h1 heading font size.', 'consulting'),
				'id'                         => 'thinkup_font_h1size',
				'type'                       => 'select',
				'data'                       => 'fontsize',
			),

			array(
				'title'                      => __('H2 Heading', 'consulting'), 
				$thinkup_subtitle_panel      => __('Specify the h2 heading font size.', 'consulting'),
				$thinkup_subtitle_customizer => __('Specify the h2 heading font size.', 'consulting'),
				'id'                         => 'thinkup_font_h2size',
				'type'                       => 'select',
				'data'                       => 'fontsize',
			),

			array(
				'title'                      => __('H3 Heading', 'consulting'), 
				$thinkup_subtitle_panel      => __('Specify the h3 heading font size.', 'consulting'),
				$thinkup_subtitle_customizer => __('Specify the h3 heading font size.', 'consulting'),
				'id'                         => 'thinkup_font_h3size',
				'type'                       => 'select',
				'data'                       => 'fontsize',
			),

			array(
				'title'                      => __('H4 Heading', 'consulting'), 
				$thinkup_subtitle_panel      => __('Specify the h4 heading font size.', 'consulting'),
				$thinkup_subtitle_customizer => __('Specify the h4 heading font size.', 'consulting'),
				'id'                         => 'thinkup_font_h4size',
				'type'                       => 'select',
				'data'                       => 'fontsize',
			),

			array(
				'title'                      => __('H5 Heading', 'consulting'), 
				$thinkup_subtitle_panel      => __('Specify the h5 heading font size.', 'consulting'),
				$thinkup_subtitle_customizer => __('Specify the h5 heading font size.', 'consulting'),
				'id'                         => 'thinkup_font_h5size',
				'type'                       => 'select',
				'data'                       => 'fontsize',
			),

			array(
				'title'                      => __('H6 Heading', 'consulting'), 
				$thinkup_subtitle_panel      => __('Specify the h6 heading font size.', 'consulting'),
				$thinkup_subtitle_customizer => __('Specify the h6 heading font size.', 'consulting'),
				'id'                         => 'thinkup_font_h6size',
				'type'                       => 'select',
				'data'                       => 'fontsize',
			),				

			array(
				'title'                      => __('Sidebar Widget Heading', 'consulting'), 
				$thinkup_subtitle_panel      => __('Specify the sidebar widget heading font size.', 'consulting'),
				$thinkup_subtitle_customizer => __('Specify the sidebar widget heading font size.', 'consulting'),
				'id'                         => 'thinkup_font_sidebarsize',
				'type'                       => 'select',
				'data'                       => 'fontsize',
			),

			array(
				'title'                      => __('Pre Header Menu', 'consulting'), 
				$thinkup_subtitle_panel      => __('Specify the pre header font size.', 'consulting'),
				$thinkup_subtitle_customizer => __('Specify the pre header font size.', 'consulting'),
				'id'                         => 'thinkup_font_preheadersize',
				'type'                       => 'select',
				'data'                       => 'fontsize',
			),				

			array(
				'title'                      => __('Pre Header Menu (Dropdown)', 'consulting'), 
				$thinkup_subtitle_panel      => __('Specify the pre header dropdown font size.', 'consulting'),
				$thinkup_subtitle_customizer => __('Specify the pre header dropdown font size.', 'consulting'),
				'id'                         => 'thinkup_font_preheadersubsize',
				'type'                       => 'select',
				'data'                       => 'fontsize',
			),				

			array(
				'title'                      => __('Main Header Menu', 'consulting'), 
				$thinkup_subtitle_panel      => __('Specify the main header font size.', 'consulting'),
				$thinkup_subtitle_customizer => __('Specify the main header font size.', 'consulting'),
				'id'                         => 'thinkup_font_mainheadersize',
				'type'                       => 'select',
				'data'                       => 'fontsize',
			),				

			array(
				'title'                      => __('Main Header Menu (Dropdown)', 'consulting'), 
				$thinkup_subtitle_panel      => __('Specify the main header dropdown font size.', 'consulting'),
				$thinkup_subtitle_customizer => __('Specify the main header dropdown font size.', 'consulting'),
				'id'                         => 'thinkup_font_mainheadersubsize',
				'type'                       => 'select',
				'data'                       => 'fontsize',
			),				

			array(
				'title'                      => __('Footer Headings', 'consulting'), 
				$thinkup_subtitle_panel      => __('Specify the footer heading font size.', 'consulting'),
				$thinkup_subtitle_customizer => __('Specify the footer heading font size.', 'consulting'),
				'id'                         => 'thinkup_font_footerheadingsize',
				'type'                       => 'select',
				'data'                       => 'fontsize',
			),				

			array(
				'title'                      => __('Main Footer Menu', 'consulting'), 
				$thinkup_subtitle_panel      => __('Specify the main footer font size.', 'consulting'),
				$thinkup_subtitle_customizer => __('Specify the main footer font size.', 'consulting'),
				'id'                         => 'thinkup_font_mainfootersize',
				'type'                       => 'select',
				'data'                       => 'fontsize',
			),				

			array(
				'title'                      => __('Post Footer Menu', 'consulting'), 
				$thinkup_subtitle_panel      => __('Specify the post footer font size.', 'consulting'),
				$thinkup_subtitle_customizer => __('Specify the post footer font size.', 'consulting'),
				'id'                         => 'thinkup_font_postfootersize',
				'type'                       => 'select',
				'data'                       => 'fontsize',
			),

			array(
				'title'                      => __('Slider Title', 'consulting'), 
				$thinkup_subtitle_panel      => __('Specify the slider title font size.', 'consulting'),
				$thinkup_subtitle_customizer => __('Specify the slider title font size.', 'consulting'),
				'id'                         => 'thinkup_font_slidertitlesize',
				'type'                       => 'select',
				'data'                       => 'fontsize',
			),

			array(
				'title'                      => __('Slider Description', 'consulting'), 
				$thinkup_subtitle_panel      => __('Specify the slider description font size.', 'consulting'),
				$thinkup_subtitle_customizer => __('Specify the slider description font size.', 'consulting'),
				'id'                         => 'thinkup_font_slidertextsize',
				'type'                       => 'select',
				'data'                       => 'fontsize',
			),
		)
	) );	


	// -----------------------------------------------------------------------------------
	//	13.	Custom Styling
	// -----------------------------------------------------------------------------------

	Redux::setSection( $opt_name, array(
		'title'      => __('Custom Styling', 'consulting'),
		'desc'       => __('<span class="redux-title">1 Click Color Change</span>', 'consulting'),
		'icon'       => 'el el-eye-open',
		'icon_class' => '',
        'subsection' => $thinkup_customizer_subsection,
        'customizer' => false,
		'fields'     => array(

			array(
				'title'   => __('Custom Color Scheme', 'consulting'), 
				'desc'    => __('Check to use custom theme color.', 'consulting'),
				'id'      => 'thinkup_styles_colorswitch',
				'type'    => 'checkbox',
				'default' => '0',
			),

			array(
				$thinkup_subtitle_panel      => __('Specify a custom theme color.', 'consulting'),
				$thinkup_subtitle_customizer => __('Specify a custom theme color.', 'consulting'),
				'id'                         => 'thinkup_styles_colorcustom',
				'type'                       => 'color',
				'validate'                   => 'color',
				'default'                    => '#FFFFFF',
			),

            array(
                'id'       => 'thinkup_section_styles_advanced',
                'type'     => $thinkup_section_field,
                'title'    => __( ' ', 'consulting' ),
                'subtitle' => __( '<span class="redux-title">Advanced Custom Styling</span>', 'consulting' ),
                'indent'   => false,
            ),

			// Main Content
			array(
				'title'                      => __('Main Content', 'consulting'), 
				$thinkup_subtitle_panel      => __('Switch on to enable main content area styling.', 'consulting'),
				$thinkup_subtitle_customizer => __('Switch on to enable main content area styling.', 'consulting'),
				'id'                         => 'thinkup_styles_mainswitch',
				'type'                       => 'switch',
				'default'                    => '0',
			),

			array(
				$thinkup_subtitle_panel      => __('Upload an image to use as background.<br />Leave blank to use custom color.', 'consulting'),
				$thinkup_subtitle_customizer => __('Upload an image to use as background.<br />Leave blank to use custom color.', 'consulting'),
				'id'                         => 'thinkup_styles_mainimage',
				'type'                       => 'media',
				'url'                        => true,
				'required'                   => array( 
					array( 'thinkup_styles_mainswitch', '=', 
						array( '1' ),
					), 
				)
			),

			array(
				$thinkup_subtitle_panel      => __('Background Position. Find out more <a href="http://www.w3schools.com/cssref/pr_background-position.asp">here</a>.', 'consulting'),
				$thinkup_subtitle_customizer => __('Background Position. Find out more <a href="http://www.w3schools.com/cssref/pr_background-position.asp">here</a>.', 'consulting'),
				'id'                         => 'thinkup_styles_mainposition',
				'type'                       => 'select',
				'options'                    => array( 
					'left top'      => 'left top',
					'left center'   => 'left center',
					'left bottom'   => 'left bottom',
					'right top'     => 'right top',
					'right center'  => 'right center',
					'right bottom'  => 'right bottom',
					'center top'    => 'center top',
					'center center' => 'center center',
					'center bottom' => 'center bottom'
				),
				'required' => array( 
					array( 'thinkup_styles_mainswitch', '=', 
						array( '1' ),
					), 
				)
			),

			array(
				$thinkup_subtitle_panel      => __('Background Repeat. Find out more <a href="http://www.w3schools.com/cssref/pr_background-repeat.asp">here</a>.', 'consulting'),
				$thinkup_subtitle_customizer => __('Background Repeat. Find out more <a href="http://www.w3schools.com/cssref/pr_background-repeat.asp">here</a>.', 'consulting'),
				'id'                         => 'thinkup_styles_mainrepeat',
				'type'                       => 'select',
				'options'                    => array( 
					"repeat"    => "repeat",
					"repeat-x"  => "repeat-x",
					"repeat-y"  => "repeat-y",
					"no-repeat" => "no-repeat"
				),
				'required' => array( 
					array( 'thinkup_styles_mainswitch', '=', 
						array( '1' ),
					), 
				)
			),

			array(
				$thinkup_subtitle_panel      => __('Background Size? Find out more <a href="http://www.w3schools.com/cssref/css3_pr_background-size.asp">here</a>.', 'consulting'),
				$thinkup_subtitle_customizer => __('Background Size? Find out more <a href="http://www.w3schools.com/cssref/css3_pr_background-size.asp">here</a>.', 'consulting'),
				'id'                         => 'thinkup_styles_mainsize',
				'type'                       => 'select',
				'options'                    => array( 
					"auto"      => "auto",
					"cover"     => "cover",
					"constrain" => "constrain"
				),
				'required' => array( 
					array( 'thinkup_styles_mainswitch', '=', 
						array( '1' ),
					), 
				)
			),

			array(
				$thinkup_subtitle_panel      => __('Fix background or scroll? Find out more <a href="http://www.w3schools.com/cssref/pr_background-attachment.asp">here</a>.', 'consulting'),
				$thinkup_subtitle_customizer => __('Fix background or scroll? Find out more <a href="http://www.w3schools.com/cssref/pr_background-attachment.asp">here</a>.', 'consulting'),
				'id'                         => 'thinkup_styles_mainattachment',
				'type'                       => 'select',
				'options'                    => array( 
					"scroll" => "scroll",
					"fixed"  => "fixed"
				),
				'required' => array( 
					array( 'thinkup_styles_mainswitch', '=', 
						array( '1' ),
					), 
				)
			),

			array(
				$thinkup_subtitle_panel      => __('Background color.', 'consulting'),
				$thinkup_subtitle_customizer => __('Background color.', 'consulting'),
				'id'                         => 'thinkup_styles_mainbg',
				'type'                       => 'color',
				'validate'                   => 'color',
				'default'                    => '#FFFFFF',
				'required'                   => array( 
					array( 'thinkup_styles_mainswitch', '=', 
						array( '1' ),
					), 
				)
			),

			array(
				$thinkup_subtitle_panel      => __('Headings (h1, h2, h3, etc&hellip;)', 'consulting'),
				$thinkup_subtitle_customizer => __('Headings (h1, h2, h3, etc&hellip;)', 'consulting'),
				'id'                         => 'thinkup_styles_mainheading',
				'type'                       => 'color',
				'validate'                   => 'color',
				'default'                    => '#FFFFFF',
				'required'                   => array( 
					array( 'thinkup_styles_mainswitch', '=', 
						array( '1' ),
					), 
				)
			),

			array(
				$thinkup_subtitle_panel      => __('Body text.', 'consulting'),
				$thinkup_subtitle_customizer => __('Body text.', 'consulting'),
				'id'                         => 'thinkup_styles_maintext',
				'type'                       => 'color',
				'validate'                   => 'color',
				'default'                    => '#FFFFFF',
				'required'                   => array( 
					array( 'thinkup_styles_mainswitch', '=', 
						array( '1' ),
					), 
				)
			),

			array(
				$thinkup_subtitle_panel      => __('Body links.', 'consulting'),
				$thinkup_subtitle_customizer => __('Body links.', 'consulting'),
				'id'                         => 'thinkup_styles_mainlink',
				'type'                       => 'color',
				'validate'                   => 'color',
				'default'                    => '#FFFFFF',
				'required'                   => array( 
					array( 'thinkup_styles_mainswitch', '=', 
						array( '1' ),
					), 
				)
			),

			array(
				$thinkup_subtitle_panel      => __('Body links - Hover.', 'consulting'),
				$thinkup_subtitle_customizer => __('Body links - Hover.', 'consulting'),
				'id'                         => 'thinkup_styles_mainlinkhover',
				'type'                       => 'color',
				'validate'                   => 'color',
				'default'                    => '#FFFFFF',
				'required'                   => array( 
					array( 'thinkup_styles_mainswitch', '=', 
						array( '1' ),
					), 
				)
			),

			// Pre Header Styling
			array(
				'title'                      => __('Pre Header', 'consulting'), 
				$thinkup_subtitle_panel      => __('Switch on to enable custom pre-header styling.', 'consulting'),
				$thinkup_subtitle_customizer => __('Switch on to enable custom pre-header styling.', 'consulting'),
				'id'                         => 'thinkup_styles_preheaderswitch',
				'type'                       => 'switch',
				'default'                    => '0',
			),

			array(
				$thinkup_subtitle_panel      => __('Upload an image to use as background.<br />Leave blank to use custom color.', 'consulting'),
				$thinkup_subtitle_customizer => __('Upload an image to use as background.<br />Leave blank to use custom color.', 'consulting'),
				'id'                         => 'thinkup_styles_preheaderimage',
				'type'                       => 'media',
				'url'                        => true,
				'required'                   => array( 
					array( 'thinkup_styles_preheaderswitch', '=', 
						array( '1' ),
					), 
				)
			),

			array(
				$thinkup_subtitle_panel      => __('Background Position. Find out more <a href="http://www.w3schools.com/cssref/pr_background-position.asp">here</a>.', 'consulting'),
				$thinkup_subtitle_customizer => __('Background Position. Find out more <a href="http://www.w3schools.com/cssref/pr_background-position.asp">here</a>.', 'consulting'),
				'id'                         => 'thinkup_styles_preheaderposition',
				'type'                       => 'select',
				'options'                    => array( 
					'left top'      => 'left top',
					'left center'   => 'left center',
					'left bottom'   => 'left bottom',
					'right top'     => 'right top',
					'right center'  => 'right center',
					'right bottom'  => 'right bottom',
					'center top'    => 'center top',
					'center center' => 'center center',
					'center bottom' => 'center bottom'
				),
				'required' => array( 
					array( 'thinkup_styles_preheaderswitch', '=', 
						array( '1' ),
					), 
				)
			),

			array(
				$thinkup_subtitle_panel      => __('Background Repeat. Find out more <a href="http://www.w3schools.com/cssref/pr_background-repeat.asp">here</a>.', 'consulting'),
				$thinkup_subtitle_customizer => __('Background Repeat. Find out more <a href="http://www.w3schools.com/cssref/pr_background-repeat.asp">here</a>.', 'consulting'),
				'id'                         => 'thinkup_styles_preheaderrepeat',
				'type'                       => 'select',
				'options'                    => array( 
					"repeat"    => "repeat",
					"repeat-x"  => "repeat-x",
					"repeat-y"  => "repeat-y",
					"no-repeat" => "no-repeat"
				),
				'required' => array( 
					array( 'thinkup_styles_preheaderswitch', '=', 
						array( '1' ),
					), 
				)
			),

			array(
				$thinkup_subtitle_panel      => __('Background Size? Find out more <a href="http://www.w3schools.com/cssref/css3_pr_background-size.asp">here</a>.', 'consulting'),
				$thinkup_subtitle_customizer => __('Background Size? Find out more <a href="http://www.w3schools.com/cssref/css3_pr_background-size.asp">here</a>.', 'consulting'),
				'id'                         => 'thinkup_styles_preheadersize',
				'type'                       => 'select',
				'options'                    => array( 
					"auto"      => "auto",
					"cover"     => "cover",
					"constrain" => "constrain"
				),
				'required' => array( 
					array( 'thinkup_styles_preheaderswitch', '=', 
						array( '1' ),
					), 
				)
			),

			array(
				$thinkup_subtitle_panel      => __('Fix background or scroll? Find out more <a href="http://www.w3schools.com/cssref/pr_background-attachment.asp">here</a>.', 'consulting'),
				$thinkup_subtitle_customizer => __('Fix background or scroll? Find out more <a href="http://www.w3schools.com/cssref/pr_background-attachment.asp">here</a>.', 'consulting'),
				'id'                         => 'thinkup_styles_preheaderattachment',
				'type'                       => 'select',
				'options'                    => array( 
					"scroll" => "scroll",
					"fixed" => "fixed"
				),
				'required'                   => array( 
					array( 'thinkup_styles_preheaderswitch', '=', 
						array( '1' ),
					), 
				)
			),

			array(
				$thinkup_subtitle_panel      => __('Top tier menu - Background color.', 'consulting'),
				$thinkup_subtitle_customizer => __('Top tier menu - Background color.', 'consulting'),
				'id'                         => 'thinkup_styles_preheaderbg',
				'type'                       => 'color',
				'validate'                   => 'color',
				'default'                    => '#FFFFFF',
				'required'                   => array( 
					array( 'thinkup_styles_preheaderswitch', '=', 
						array( '1' ),
					), 
				)
			),

			array(
				$thinkup_subtitle_panel      => __('Top tier menu - Background color on hover.', 'consulting'),
				$thinkup_subtitle_customizer => __('Top tier menu - Background color on hover.', 'consulting'),
				'id'                         => 'thinkup_styles_preheaderbghover',
				'type'                       => 'color',
				'validate'                   => 'color',
				'default'                    => '#FFFFFF',
				'required'                   => array( 
					array( 'thinkup_styles_preheaderswitch', '=', 
						array( '1' ),
					), 
				)
			),

			array(
				$thinkup_subtitle_panel      => __('Top tier menu - Text color.', 'consulting'),
				$thinkup_subtitle_customizer => __('Top tier menu - Text color.', 'consulting'),
				'id'                         => 'thinkup_styles_preheadertext',
				'type'                       => 'color',
				'validate'                   => 'color',
				'default'                    => '#FFFFFF',
				'required'                   => array( 
					array( 'thinkup_styles_preheaderswitch', '=', 
						array( '1' ),
					), 
				)
			),

			array(
				$thinkup_subtitle_panel      => __('Top tier menu - Text color on hover.', 'consulting'),
				$thinkup_subtitle_customizer => __('Top tier menu - Text color on hover.', 'consulting'),
				'id'                         => 'thinkup_styles_preheadertexthover',
				'type'                       => 'color',
				'validate'                   => 'color',
				'default'                    => '#FFFFFF',
				'required'                   => array( 
					array( 'thinkup_styles_preheaderswitch', '=', 
						array( '1' ),
					), 
				)
			),

			array(
				$thinkup_subtitle_panel      => __('Dropdown menu - Background color.', 'consulting'),
				$thinkup_subtitle_customizer => __('Dropdown menu - Background color.', 'consulting'),
				'id'                         => 'thinkup_styles_preheaderdropbg',
				'type'                       => 'color',
				'validate'                   => 'color',
				'default'                    => '#FFFFFF',
				'required'                   => array( 
					array( 'thinkup_styles_preheaderswitch', '=', 
						array( '1' ),
					), 
				)
			),

			array(
				$thinkup_subtitle_panel      => __('Dropdown menu - Background color on hover.', 'consulting'),
				$thinkup_subtitle_customizer => __('Dropdown menu - Background color on hover.', 'consulting'),
				'id'                         => 'thinkup_styles_preheaderdropbghover',
				'type'                       => 'color',
				'validate'                   => 'color',
				'default'                    => '#FFFFFF',
				'required'                   => array( 
					array( 'thinkup_styles_preheaderswitch', '=', 
						array( '1' ),
					), 
				)
			),

			array(
				$thinkup_subtitle_panel      => __('Dropdown menu - Text color.', 'consulting'),
				$thinkup_subtitle_customizer => __('Dropdown menu - Text color.', 'consulting'),
				'id'                         => 'thinkup_styles_preheaderdroptext',
				'type'                       => 'color',
				'validate'                   => 'color',
				'default'                    => '#FFFFFF',
				'required'                   => array( 
					array( 'thinkup_styles_preheaderswitch', '=', 
						array( '1' ),
					), 
				)
			),

			array(
				$thinkup_subtitle_panel      => __('Dropdown menu - Text color on hover.', 'consulting'),
				$thinkup_subtitle_customizer => __('Dropdown menu - Text color on hover.', 'consulting'),
				'id'                         => 'thinkup_styles_preheaderdroptexthover',
				'type'                       => 'color',
				'validate'                   => 'color',
				'default'                    => '#FFFFFF',
				'required'                   => array( 
					array( 'thinkup_styles_preheaderswitch', '=', 
						array( '1' ),
					), 
				)
			),				

			array(
				$thinkup_subtitle_panel      => __('Dropdown menu - Border color.', 'consulting'),
				$thinkup_subtitle_customizer => __('Dropdown menu - Border color.', 'consulting'),
				'id'                         => 'thinkup_styles_preheaderdropborder',
				'type'                       => 'color',
				'validate'                   => 'color',
				'default'                    => '#FFFFFF',
				'required'                   => array( 
					array( 'thinkup_styles_preheaderswitch', '=', 
						array( '1' ),
					), 
				)
			),

			// Main Header Styling
			array(
				'title'                      => __('Header', 'consulting'), 
				$thinkup_subtitle_panel      => __('Switch on to enable custom header styling.', 'consulting'),
				$thinkup_subtitle_customizer => __('Switch on to enable custom header styling.', 'consulting'),
				'id'                         => 'thinkup_styles_headerswitch',
				'type'                       => 'switch',
				'default'                    => '0',
			),

			array(
				$thinkup_subtitle_panel      => __('Upload an image to use as background.<br />Leave blank to use custom color.', 'consulting'),
				$thinkup_subtitle_customizer => __('Upload an image to use as background.<br />Leave blank to use custom color.', 'consulting'),
				'id'                         => 'thinkup_styles_headerimage',
				'type'                       => 'media',
				'url'                        => true,
				'required'                   => array( 
					array( 'thinkup_styles_headerswitch', '=', 
						array( '1' ),
					), 
				)
			),

			array(
				$thinkup_subtitle_panel      => __('Background Position. Find out more <a href="http://www.w3schools.com/cssref/pr_background-position.asp">here</a>.', 'consulting'),
				$thinkup_subtitle_customizer => __('Background Position. Find out more <a href="http://www.w3schools.com/cssref/pr_background-position.asp">here</a>.', 'consulting'),
				'id'                         => 'thinkup_styles_headerposition',
				'type'                       => 'select',
				'options'                    => array( 
					'left top'      => 'left top',
					'left center'   => 'left center',
					'left bottom'   => 'left bottom',
					'right top'     => 'right top',
					'right center'  => 'right center',
					'right bottom'  => 'right bottom',
					'center top'    => 'center top',
					'center center' => 'center center',
					'center bottom' => 'center bottom'
				),
				'required' => array( 
					array( 'thinkup_styles_headerswitch', '=', 
						array( '1' ),
					), 
				)
			),

			array(
				$thinkup_subtitle_panel      => __('Background Repeat. Find out more <a href="http://www.w3schools.com/cssref/pr_background-repeat.asp">here</a>.', 'consulting'),
				$thinkup_subtitle_customizer => __('Background Repeat. Find out more <a href="http://www.w3schools.com/cssref/pr_background-repeat.asp">here</a>.', 'consulting'),
				'id'                         => 'thinkup_styles_headerrepeat',
				'type'                       => 'select',
				'options'                    => array( 
					"repeat"    => "repeat",
					"repeat-x"  => "repeat-x",
					"repeat-y"  => "repeat-y",
					"no-repeat" => "no-repeat"
				),
				'required' => array( 
					array( 'thinkup_styles_headerswitch', '=', 
						array( '1' ),
					), 
				)
			),

			array(
				$thinkup_subtitle_panel      => __('Background Size? Find out more <a href="http://www.w3schools.com/cssref/css3_pr_background-size.asp">here</a>.', 'consulting'),
				$thinkup_subtitle_customizer => __('Background Size? Find out more <a href="http://www.w3schools.com/cssref/css3_pr_background-size.asp">here</a>.', 'consulting'),
				'id'                         => 'thinkup_styles_headersize',
				'type'                       => 'select',
				'options'                    => array( 
					"auto"      => "auto",
					"cover"     => "cover",
					"constrain" => "constrain"
				),
				'required' => array( 
					array( 'thinkup_styles_headerswitch', '=', 
						array( '1' ),
					), 
				)
			),

			array(
				$thinkup_subtitle_panel      => __('Fix background or scroll? Find out more <a href="http://www.w3schools.com/cssref/pr_background-attachment.asp">here</a>.', 'consulting'),
				$thinkup_subtitle_customizer => __('Fix background or scroll? Find out more <a href="http://www.w3schools.com/cssref/pr_background-attachment.asp">here</a>.', 'consulting'),
				'id'                         => 'thinkup_styles_headerattachment',
				'type'                       => 'select',
				'options'                    => array( 
					"scroll" => "scroll",
					"fixed"  => "fixed"
				),
				'required'                   => array( 
					array( 'thinkup_styles_headerswitch', '=', 
						array( '1' ),
					), 
				)
			),

			array(
				$thinkup_subtitle_panel      => __('Top tier menu - Background color.', 'consulting'),
				$thinkup_subtitle_customizer => __('Top tier menu - Background color.', 'consulting'),
				'id'                         => 'thinkup_styles_headerbg',
				'type'                       => 'color',
				'validate'                   => 'color',
				'default'                    => '#FFFFFF',
				'required'                   => array( 
					array( 'thinkup_styles_headerswitch', '=', 
						array( '1' ),
					), 
				)
			),

			array(
				$thinkup_subtitle_panel      => __('Top tier menu - Background color on hover.', 'consulting'),
				$thinkup_subtitle_customizer => __('Top tier menu - Background color on hover.', 'consulting'),
				'id'                         => 'thinkup_styles_headerbghover',
				'type'                       => 'color',
				'validate'                   => 'color',
				'default'                    => '#FFFFFF',
				'required'                   => array( 
					array( 'thinkup_styles_headerswitch', '=', 
						array( '1' ),
					), 
				)
			),

			array(
				$thinkup_subtitle_panel      => __('Top tier menu - Site Title.', 'consulting'),
				$thinkup_subtitle_customizer => __('Top tier menu - Site Title.', 'consulting'),
				'id'                         => 'thinkup_styles_headersitetitle',
				'type'                       => 'color',
				'validate'                   => 'color',
				'default'                    => '#FFFFFF',
				'required'                   => array( 
					array( 'thinkup_styles_headerswitch', '=', 
						array( '1' ),
					), 
				)
			),

			array(
				$thinkup_subtitle_panel      => __('Top tier menu - Site Description.', 'consulting'),
				$thinkup_subtitle_customizer => __('Top tier menu - Site Description.', 'consulting'),
				'id'                         => 'thinkup_styles_headersitedescription',
				'type'                       => 'color',
				'validate'                   => 'color',
				'default'                    => '#FFFFFF',
				'required'                   => array( 
					array( 'thinkup_styles_headerswitch', '=', 
						array( '1' ),
					), 
				)
			),

			array(
				$thinkup_subtitle_panel      => __('Top tier menu - Text color.', 'consulting'),
				$thinkup_subtitle_customizer => __('Top tier menu - Text color.', 'consulting'),
				'id'                         => 'thinkup_styles_headertext',
				'type'                       => 'color',
				'validate'                   => 'color',
				'default'                    => '#FFFFFF',
				'required'                   => array( 
					array( 'thinkup_styles_headerswitch', '=', 
						array( '1' ),
					), 
				)
			),

			array(
				$thinkup_subtitle_panel      => __('Top tier menu - Text color on hover.', 'consulting'),
				$thinkup_subtitle_customizer => __('Top tier menu - Text color on hover.', 'consulting'),
				'id'                         => 'thinkup_styles_headertexthover',
				'type'                       => 'color',
				'validate'                   => 'color',
				'default'                    => '#FFFFFF',
				'required'                   => array( 
					array( 'thinkup_styles_headerswitch', '=', 
						array( '1' ),
					), 
				)
			),

			array(
				$thinkup_subtitle_panel      => __('Dropdown menu - Background color.', 'consulting'),
				$thinkup_subtitle_customizer => __('Dropdown menu - Background color.', 'consulting'),
				'id'                         => 'thinkup_styles_headerdropbg',
				'type'                       => 'color',
				'validate'                   => 'color',
				'default'                    => '#FFFFFF',
				'required'                   => array( 
					array( 'thinkup_styles_headerswitch', '=', 
						array( '1' ),
					), 
				)
			),

			array(
				$thinkup_subtitle_panel      => __('Dropdown menu - Background color on hover.', 'consulting'),
				$thinkup_subtitle_customizer => __('Dropdown menu - Background color on hover.', 'consulting'),
				'id'                         => 'thinkup_styles_headerdropbghover',
				'type'                       => 'color',
				'validate'                   => 'color',
				'default'                    => '#FFFFFF',
				'required'                   => array( 
					array( 'thinkup_styles_headerswitch', '=', 
						array( '1' ),
					), 
				)
			),

			array(
				$thinkup_subtitle_panel      => __('Dropdown menu - Text color.', 'consulting'),
				$thinkup_subtitle_customizer => __('Dropdown menu - Text color.', 'consulting'),
				'id'                         => 'thinkup_styles_headerdroptext',
				'type'                       => 'color',
				'validate'                   => 'color',
				'default'                    => '#FFFFFF',
				'required'                   => array( 
					array( 'thinkup_styles_headerswitch', '=', 
						array( '1' ),
					), 
				)
			),

			array(
				$thinkup_subtitle_panel      => __('Dropdown menu - Text color on hover.', 'consulting'),
				$thinkup_subtitle_customizer => __('Dropdown menu - Text color on hover.', 'consulting'),
				'id'                         => 'thinkup_styles_headerdroptexthover',
				'type'                       => 'color',
				'validate'                   => 'color',
				'default'                    => '#FFFFFF',
				'required'                   => array( 
					array( 'thinkup_styles_headerswitch', '=', 
						array( '1' ),
					), 
				)
			),				

			array(
				$thinkup_subtitle_panel      => __('Dropdown menu - Border color.', 'consulting'),
				$thinkup_subtitle_customizer => __('Dropdown menu - Border color.', 'consulting'),
				'id'                         => 'thinkup_styles_headerdropborder',
				'type'                       => 'color',
				'validate'                   => 'color',
				'default'                    => '#FFFFFF',
				'required'                   => array( 
					array( 'thinkup_styles_headerswitch', '=', 
						array( '1' ),
					), 
				)
			),

			// Header (Responsive) Styling
			array(
				'title'                      => __('Header (Responsive)', 'minamaze'), 
				$thinkup_subtitle_panel      => __('Switch on to enable custom responsive header styling.', 'minamaze'),
				$thinkup_subtitle_customizer => __('Switch on to enable custom responsive header styling.', 'minamaze'),
				'id'                         => 'thinkup_styles_headerresswitch',
				'type'                       => 'switch',
				'default'                    => '0',
			),

			array(
				$thinkup_subtitle_panel      => __('Top tier menu - Background color.', 'minamaze'),
				$thinkup_subtitle_customizer => __('Top tier menu - Background color.', 'minamaze'),
				'id'                         => 'thinkup_styles_headerresbg',
				'type'                       => 'color',
				'validate'                   => 'color',
				'default'                    => '#FFFFFF',
				'required'                   => array( 
					array( 'thinkup_styles_headerresswitch', '=', 
						array( '1' ),
					), 
				)
			),

			array(
				$thinkup_subtitle_panel      => __('Top tier menu - Background color on hover.', 'minamaze'),
				$thinkup_subtitle_customizer => __('Top tier menu - Background color on hover.', 'minamaze'),
				'id'                         => 'thinkup_styles_headerresbghover',
				'type'                       => 'color',
				'validate'                   => 'color',
				'default'                    => '#FFFFFF',
				'required'                   => array( 
					array( 'thinkup_styles_headerresswitch', '=', 
						array( '1' ),
					), 
				)
			),

			array(
				$thinkup_subtitle_panel      => __('Top tier menu - Icon color.', 'alante'),
				$thinkup_subtitle_customizer => __('Top tier menu - Icon color.', 'alante'),
				'id'                         => 'thinkup_styles_headerresbgicon',
				'type'                       => 'color',
				'validate'                   => 'color',
				'default'                    => '#FFFFFF',
				'required'                   => array( 
					array( 'thinkup_styles_headerresswitch', '=', 
						array( '1' ),
					), 
				)
			),

			array(
				$thinkup_subtitle_panel      => __('Top tier menu - Icon color on hover.', 'alante'),
				$thinkup_subtitle_customizer => __('Top tier menu - Icon color on hover.', 'alante'),
				'id'                         => 'thinkup_styles_headerresbgiconhover',
				'type'                       => 'color',
				'validate'                   => 'color',
				'default'                    => '#FFFFFF',
				'required'                   => array( 
					array( 'thinkup_styles_headerresswitch', '=', 
						array( '1' ),
					), 
				)
			),

			array(
				$thinkup_subtitle_panel      => __('Dropdown menu - Background color.', 'minamaze'),
				$thinkup_subtitle_customizer => __('Dropdown menu - Background color.', 'minamaze'),
				'id'                         => 'thinkup_styles_headerresdropbg',
				'type'                       => 'color',
				'validate'                   => 'color',
				'default'                    => '#FFFFFF',
				'required'                   => array( 
					array( 'thinkup_styles_headerresswitch', '=', 
						array( '1' ),
					), 
				)
			),

			array(
				$thinkup_subtitle_panel      => __('Dropdown menu - Background color on hover.', 'minamaze'),
				$thinkup_subtitle_customizer => __('Dropdown menu - Background color on hover.', 'minamaze'),
				'id'                         => 'thinkup_styles_headerresdropbghover',
				'type'                       => 'color',
				'validate'                   => 'color',
				'default'                    => '#FFFFFF',
				'required'                   => array( 
					array( 'thinkup_styles_headerresswitch', '=', 
						array( '1' ),
					), 
				)
			),

			array(
				$thinkup_subtitle_panel      => __('Dropdown menu - Text color.', 'minamaze'),
				$thinkup_subtitle_customizer => __('Dropdown menu - Text color.', 'minamaze'),
				'id'                         => 'thinkup_styles_headerresdroptext',
				'type'                       => 'color',
				'validate'                   => 'color',
				'default'                    => '#FFFFFF',
				'required'                   => array( 
					array( 'thinkup_styles_headerresswitch', '=', 
						array( '1' ),
					), 
				)
			),

			array(
				$thinkup_subtitle_panel      => __('Dropdown menu - Text color on hover.', 'minamaze'),
				$thinkup_subtitle_customizer => __('Dropdown menu - Text color on hover.', 'minamaze'),
				'id'                         => 'thinkup_styles_headerresdroptexthover',
				'type'                       => 'color',
				'validate'                   => 'color',
				'default'                    => '#FFFFFF',
				'required'                   => array( 
					array( 'thinkup_styles_headerresswitch', '=', 
						array( '1' ),
					), 
				)
			),				

			array(
				$thinkup_subtitle_panel      => __('Dropdown menu - Border color.', 'minamaze'),
				$thinkup_subtitle_customizer => __('Dropdown menu - Border color.', 'minamaze'),
				'id'                         => 'thinkup_styles_headerresdropborder',
				'type'                       => 'color',
				'validate'                   => 'color',
				'default'                    => '#FFFFFF',
				'required'                   => array( 
					array( 'thinkup_styles_headerresswitch', '=', 
						array( '1' ),
					), 
				)
			),

			// Page Intro Styling
			array(
				'title'                      => __('Page Intro', 'consulting'), 
				$thinkup_subtitle_panel      => __('Switch on to enable page intro custom styling.', 'consulting'),
				$thinkup_subtitle_customizer => __('Switch on to enable page intro custom styling.', 'consulting'),
				'id'                         => 'thinkup_styles_pageintroswitch',
				'type'                       => 'switch',
				'default'                    => '0',
			),

			array(
				$thinkup_subtitle_panel      => __('Upload an image to use as background.<br />Leave blank to use custom color.', 'consulting'),
				$thinkup_subtitle_customizer => __('Upload an image to use as background.<br />Leave blank to use custom color.', 'consulting'),
				'id'                         => 'thinkup_styles_pageintroimage',
				'type'                       => 'media',
				'url'                        => true,
				'required'                   => array( 
					array( 'thinkup_styles_pageintroswitch', '=', 
						array( '1' ),
					), 
				)
			),

			array(
				$thinkup_subtitle_panel      => __('Background Position. Find out more <a href="http://www.w3schools.com/cssref/pr_background-position.asp">here</a>.', 'consulting'),
				$thinkup_subtitle_customizer => __('Background Position. Find out more <a href="http://www.w3schools.com/cssref/pr_background-position.asp">here</a>.', 'consulting'),
				'id'                         => 'thinkup_styles_pageintroposition',
				'type'                       => 'select',
				'options'                    => array( 
					'left top'      => 'left top',
					'left center'   => 'left center',
					'left bottom'   => 'left bottom',
					'right top'     => 'right top',
					'right center'  => 'right center',
					'right bottom'  => 'right bottom',
					'center top'    => 'center top',
					'center center' => 'center center',
					'center bottom' => 'center bottom'
				),
				'required' => array( 
					array( 'thinkup_styles_pageintroswitch', '=', 
						array( '1' ),
					), 
				)
			),

			array(
				$thinkup_subtitle_panel      => __('Background Repeat. Find out more <a href="http://www.w3schools.com/cssref/pr_background-repeat.asp">here</a>.', 'consulting'),
				$thinkup_subtitle_customizer => __('Background Repeat. Find out more <a href="http://www.w3schools.com/cssref/pr_background-repeat.asp">here</a>.', 'consulting'),
				'id'                         => 'thinkup_styles_pageintrorepeat',
				'type'                       => 'select',
				'options'                    => array( 
					"repeat"    => "repeat",
					"repeat-x"  => "repeat-x",
					"repeat-y"  => "repeat-y",
					"no-repeat" => "no-repeat"
				),
				'required' => array( 
					array( 'thinkup_styles_pageintroswitch', '=', 
						array( '1' ),
					), 
				)
			),

			array(
				$thinkup_subtitle_panel      => __('Background Size? Find out more <a href="http://www.w3schools.com/cssref/css3_pr_background-size.asp">here</a>.', 'consulting'),
				$thinkup_subtitle_customizer => __('Background Size? Find out more <a href="http://www.w3schools.com/cssref/css3_pr_background-size.asp">here</a>.', 'consulting'),
				'id'                         => 'thinkup_styles_pageintrosize',
				'type'                       => 'select',
				'options'                    => array( 
					"auto"      => "auto",
					"cover"     => "cover",
					"constrain" => "constrain"
				),
				'required' => array( 
					array( 'thinkup_styles_pageintroswitch', '=', 
						array( '1' ),
					), 
				)
			),

			array(
				$thinkup_subtitle_panel      => __('Fix background or scroll? Find out more <a href="http://www.w3schools.com/cssref/pr_background-attachment.asp">here</a>.', 'consulting'),
				$thinkup_subtitle_customizer => __('Fix background or scroll? Find out more <a href="http://www.w3schools.com/cssref/pr_background-attachment.asp">here</a>.', 'consulting'),
				'id'                         => 'thinkup_styles_pageintroattachment',
				'type'                       => 'select',
				'options'                    => array( 
					"scroll" => "scroll",
					"fixed"  => "fixed"
				),
				'required'                   => array( 
					array( 'thinkup_styles_pageintroswitch', '=', 
						array( '1' ),
					), 
				)
			),

			array(
				$thinkup_subtitle_panel      => __('Background color.', 'consulting'),
				$thinkup_subtitle_customizer => __('Background color.', 'consulting'),
				'id'                         => 'thinkup_styles_pageintrobg',
				'type'                       => 'color',
				'validate'                   => 'color',
				'default'                    => '#FFFFFF',
				'required'                   => array( 
					array( 'thinkup_styles_pageintroswitch', '=', 
						array( '1' ),
					), 
				)
			),

			array(
				$thinkup_subtitle_panel      => __('Page Title - Text color.', 'consulting'),
				$thinkup_subtitle_customizer => __('Page Title - Text color.', 'consulting'),
				'id'                         => 'thinkup_styles_pageintrotext',
				'type'                       => 'color',
				'validate'                   => 'color',
				'default'                    => '#FFFFFF',
				'required'                   => array( 
					array( 'thinkup_styles_pageintroswitch', '=', 
						array( '1' ),
					), 
				)
			),

			array(
				$thinkup_subtitle_panel      => __('Breadcrumbs - Text color.', 'consulting'),
				$thinkup_subtitle_customizer => __('Breadcrumbs - Text color.', 'consulting'),
				'id'                         => 'thinkup_styles_pageintrobreadcrumbtext',
				'type'                       => 'color',
				'validate'                   => 'color',
				'default'                    => '#FFFFFF',
				'required'                   => array( 
					array( 'thinkup_styles_pageintroswitch', '=', 
						array( '1' ),
					), 
				)
			),

			array(
				$thinkup_subtitle_panel      => __('Breadcrumbs - Link color.', 'consulting'),
				$thinkup_subtitle_customizer => __('Breadcrumbs - Link color.', 'consulting'),
				'id'                         => 'thinkup_styles_pageintrobreadcrumblink',
				'type'                       => 'color',
				'validate'                   => 'color',
				'default'                    => '#FFFFFF',
				'required'                   => array( 
					array( 'thinkup_styles_pageintroswitch', '=', 
						array( '1' ),
					), 
				)
			),

			// Main Footer Styling
			array(
				'title'                      => __('Footer', 'consulting'), 
				$thinkup_subtitle_panel      => __('Switch on to enable custom footer styling.', 'consulting'),
				$thinkup_subtitle_customizer => __('Switch on to enable custom footer styling.', 'consulting'),
				'id'                         => 'thinkup_styles_footerswitch',
				'type'                       => 'switch',
				'default'                    => '0',
			),

			array(
				$thinkup_subtitle_panel      => __('Upload an image to use as background.<br />Leave blank to use custom color.', 'consulting'),
				$thinkup_subtitle_customizer => __('Upload an image to use as background.<br />Leave blank to use custom color.', 'consulting'),
				'id'                         => 'thinkup_styles_footerimage',
				'type'                       => 'media',
				'url'                        => true,
				'required'                   => array( 
					array( 'thinkup_styles_footerswitch', '=', 
						array( '1' ),
					), 
				)
			),

			array(
				$thinkup_subtitle_panel      => __('Background Position. Find out more <a href="http://www.w3schools.com/cssref/pr_background-position.asp">here</a>.', 'consulting'),
				$thinkup_subtitle_customizer => __('Background Position. Find out more <a href="http://www.w3schools.com/cssref/pr_background-position.asp">here</a>.', 'consulting'),
				'id'                         => 'thinkup_styles_footerposition',
				'type'                       => 'select',
				'options'                    => array( 
					'left top'      => 'left top',
					'left center'   => 'left center',
					'left bottom'   => 'left bottom',
					'right top'     => 'right top',
					'right center'  => 'right center',
					'right bottom'  => 'right bottom',
					'center top'    => 'center top',
					'center center' => 'center center',
					'center bottom' => 'center bottom'
				),
				'required' => array( 
					array( 'thinkup_styles_footerswitch', '=', 
						array( '1' ),
					), 
				)
			),

			array(
				$thinkup_subtitle_panel      => __('Background Repeat. Find out more <a href="http://www.w3schools.com/cssref/pr_background-repeat.asp">here</a>.', 'consulting'),
				$thinkup_subtitle_customizer => __('Background Repeat. Find out more <a href="http://www.w3schools.com/cssref/pr_background-repeat.asp">here</a>.', 'consulting'),
				'id'                         => 'thinkup_styles_footerrepeat',
				'type'                       => 'select',
				'options'                    => array( 
					"repeat"    => "repeat",
					"repeat-x"  => "repeat-x",
					"repeat-y"  => "repeat-y",
					"no-repeat" => "no-repeat"
				),
				'required' => array( 
					array( 'thinkup_styles_footerswitch', '=', 
						array( '1' ),
					), 
				)
			),

			array(
				$thinkup_subtitle_panel      => __('Background Size? Find out more <a href="http://www.w3schools.com/cssref/css3_pr_background-size.asp">here</a>.', 'consulting'),
				$thinkup_subtitle_customizer => __('Background Size? Find out more <a href="http://www.w3schools.com/cssref/css3_pr_background-size.asp">here</a>.', 'consulting'),
				'id'                         => 'thinkup_styles_footersize',
				'type'                       => 'select',
				'options'                    => array( 
					"auto"      => "auto",
					"cover"     => "cover",
					"constrain" => "constrain"
				),
				'required'                   => array( 
					array( 'thinkup_styles_footerswitch', '=', 
						array( '1' ),
					), 
				)
			),

			array(
				$thinkup_subtitle_panel      => __('Fix background or scroll? Find out more <a href="http://www.w3schools.com/cssref/pr_background-attachment.asp">here</a>.', 'consulting'),
				$thinkup_subtitle_customizer => __('Fix background or scroll? Find out more <a href="http://www.w3schools.com/cssref/pr_background-attachment.asp">here</a>.', 'consulting'),
				'id'                         => 'thinkup_styles_footerattachment',
				'type'                       => 'select',
				'options'                    => array( 
					"scroll" => "scroll",
					"fixed"  => "fixed"
				),
				'required'                   => array( 
					array( 'thinkup_styles_footerswitch', '=', 
						array( '1' ),
					), 
				)
			),

			array(
				$thinkup_subtitle_panel      => __('Background color.', 'consulting'),
				$thinkup_subtitle_customizer => __('Background color.', 'consulting'),
				'id'                         => 'thinkup_styles_footerbg',
				'type'                       => 'color',
				'validate'                   => 'color',
				'default'                    => '#FFFFFF',
				'required'                   => array( 
					array( 'thinkup_styles_footerswitch', '=', 
						array( '1' ),
					), 
				)
			),

			array(
				$thinkup_subtitle_panel      => __('Title color.', 'consulting'),
				$thinkup_subtitle_customizer => __('Title color.', 'consulting'),
				'id'                         => 'thinkup_styles_footertitle',
				'type'                       => 'color',
				'validate'                   => 'color',
				'default'                    => '#FFFFFF',
				'required'                   => array( 
					array( 'thinkup_styles_footerswitch', '=', 
						array( '1' ),
					), 
				)
			),

			array(
				$thinkup_subtitle_panel      => __('Text color.', 'consulting'),
				$thinkup_subtitle_customizer => __('Text color.', 'consulting'),
				'id'                         => 'thinkup_styles_footertext',
				'type'                       => 'color',
				'validate'                   => 'color',
				'default'                    => '#FFFFFF',
				'required'                   => array( 
					array( 'thinkup_styles_footerswitch', '=', 
						array( '1' ),
					), 
				)
			),

			array(
				$thinkup_subtitle_panel      => __('Link color.', 'consulting'),
				$thinkup_subtitle_customizer => __('Link color.', 'consulting'),
				'id'                         => 'thinkup_styles_footerlink',
				'type'                       => 'color',
				'validate'                   => 'color',
				'default'                    => '#FFFFFF',
				'required'                   => array( 
					array( 'thinkup_styles_footerswitch', '=', 
						array( '1' ),
					), 
				)
			),

			array(
				$thinkup_subtitle_panel      => __('Link color on hover.', 'consulting'),
				$thinkup_subtitle_customizer => __('Link color on hover.', 'consulting'),
				'id'                         => 'thinkup_styles_footerlinkhover',
				'type'                       => 'color',
				'validate'                   => 'color',
				'default'                    => '#FFFFFF',
				'required'                   => array( 
					array( 'thinkup_styles_footerswitch', '=', 
						array( '1' ),
					), 
				)
			),

			// Post Footer Styling
			array(
				'title'                      => __('Post-Footer', 'consulting'), 
				$thinkup_subtitle_panel      => __('Switch on to enable custom post-footer styling.', 'consulting'),
				$thinkup_subtitle_customizer => __('Switch on to enable custom post-footer styling.', 'consulting'),
				'id'                         => 'thinkup_styles_postfooterswitch',
				'type'                       => 'switch',
				'default'                    => '0',
			),

			array(
				$thinkup_subtitle_panel      => __('Upload an image to use as background.<br />Leave blank to use custom color.', 'consulting'),
				$thinkup_subtitle_customizer => __('Upload an image to use as background.<br />Leave blank to use custom color.', 'consulting'),
				'id'                         => 'thinkup_styles_postfooterimage',
				'type'                       => 'media',
				'url'                        => true,
				'required'                   => array( 
					array( 'thinkup_styles_postfooterswitch', '=', 
						array( '1' ),
					), 
				)
			),

			array(
				$thinkup_subtitle_panel      => __('Background Position. Find out more <a href="http://www.w3schools.com/cssref/pr_background-position.asp">here</a>.', 'consulting'),
				$thinkup_subtitle_customizer => __('Background Position. Find out more <a href="http://www.w3schools.com/cssref/pr_background-position.asp">here</a>.', 'consulting'),
				'id'                         => 'thinkup_styles_postfooterposition',
				'type'                       => 'select',
				'options'                    => array( 
					'left top'      => 'left top',
					'left center'   => 'left center',
					'left bottom'   => 'left bottom',
					'right top'     => 'right top',
					'right center'  => 'right center',
					'right bottom'  => 'right bottom',
					'center top'    => 'center top',
					'center center' => 'center center',
					'center bottom' => 'center bottom'
				),
				'required' => array( 
					array( 'thinkup_styles_postfooterswitch', '=', 
						array( '1' ),
					), 
				)
			),

			array(
				$thinkup_subtitle_panel      => __('Background Repeat. Find out more <a href="http://www.w3schools.com/cssref/pr_background-repeat.asp">here</a>.', 'consulting'),
				$thinkup_subtitle_customizer => __('Background Repeat. Find out more <a href="http://www.w3schools.com/cssref/pr_background-repeat.asp">here</a>.', 'consulting'),
				'id'                         => 'thinkup_styles_postfooterrepeat',
				'type'                       => 'select',
				'options'                    => array( 
					"repeat"    => "repeat",
					"repeat-x"  => "repeat-x",
					"repeat-y"  => "repeat-y",
					"no-repeat" => "no-repeat"
				),
				'required' => array( 
					array( 'thinkup_styles_postfooterswitch', '=', 
						array( '1' ),
					), 
				)
			),

			array(
				$thinkup_subtitle_panel      => __('Background Size? Find out more <a href="http://www.w3schools.com/cssref/css3_pr_background-size.asp">here</a>.', 'consulting'),
				$thinkup_subtitle_customizer => __('Background Size? Find out more <a href="http://www.w3schools.com/cssref/css3_pr_background-size.asp">here</a>.', 'consulting'),
				'id'                         => 'thinkup_styles_postfootersize',
				'type'                       => 'select',
				'options'                    => array( 
					"auto"      => "auto",
					"cover"     => "cover",
					"constrain" => "constrain"
				),
				'required'                   => array( 
					array( 'thinkup_styles_postfooterswitch', '=', 
						array( '1' ),
					), 
				)
			),

			array(
				$thinkup_subtitle_panel      => __('Fix background or scroll? Find out more <a href="http://www.w3schools.com/cssref/pr_background-attachment.asp">here</a>.', 'consulting'),
				$thinkup_subtitle_customizer => __('Fix background or scroll? Find out more <a href="http://www.w3schools.com/cssref/pr_background-attachment.asp">here</a>.', 'consulting'),
				'id'                         => 'thinkup_styles_postfooterattachment',
				'type'                       => 'select',
				'options'                    => array( 
					"scroll" => "scroll",
					"fixed"  => "fixed"
				),
				'required'                   => array( 
					array( 'thinkup_styles_postfooterswitch', '=', 
						array( '1' ),
					), 
				)
			),

			array(
				$thinkup_subtitle_panel      => __('Background color.', 'consulting'),
				$thinkup_subtitle_customizer => __('Background color.', 'consulting'),
				'id'                         => 'thinkup_styles_postfooterbg',
				'type'                       => 'color',
				'validate'                   => 'color',
				'default'                    => '#FFFFFF',
				'required'                   => array( 
					array( 'thinkup_styles_postfooterswitch', '=', 
						array( '1' ),
					), 
				)
			),

			array(
				$thinkup_subtitle_panel      => __('Text color.', 'consulting'),
				$thinkup_subtitle_customizer => __('Text color.', 'consulting'),
				'id'                         => 'thinkup_styles_postfootertext',
				'type'                       => 'color',
				'validate'                   => 'color',
				'default'                    => '#FFFFFF',
				'required'                   => array( 
					array( 'thinkup_styles_postfooterswitch', '=', 
						array( '1' ),
					), 
				)
			),

			array(
				$thinkup_subtitle_panel      => __('Link color.', 'consulting'),
				$thinkup_subtitle_customizer => __('Link color.', 'consulting'),
				'id'                         => 'thinkup_styles_postfooterlink',
				'type'                       => 'color',
				'validate'                   => 'color',
				'default'                    => '#FFFFFF',
				'required'                   => array( 
					array( 'thinkup_styles_postfooterswitch', '=', 
						array( '1' ),
					), 
				)
			),

			array(
				$thinkup_subtitle_panel      => __('Link color on hover.', 'consulting'),
				$thinkup_subtitle_customizer => __('Link color on hover.', 'consulting'),
				'id'                         => 'thinkup_styles_postfooterlinkhover',
				'type'                       => 'color',
				'validate'                   => 'color',
				'default'                    => '#FFFFFF',
				'required'                   => array( 
					array( 'thinkup_styles_postfooterswitch', '=', 
						array( '1' ),
					), 
				)
			),
		)
	) );


	//-----------------------------------------------------------------------------------
	//	14.	Translation
	// -----------------------------------------------------------------------------------

	Redux::setSection( $opt_name, array(
		'title'      => __('Translation', 'consulting'),
		'desc'       => __('<span class="redux-title">Blog Page</span>', 'consulting'),
		'icon'       => 'el el-quotes',
		'icon_class' => '',
        'subsection' => $thinkup_customizer_subsection,
        'customizer' => false,
		'fields'     => array(

			array(
				'title'                      => __('Read More Button', 'consulting'), 
				$thinkup_subtitle_panel      => __('Leave blank to display default: "Read More".', 'consulting'),
				$thinkup_subtitle_customizer => __('Leave blank to display default: "Read More".', 'consulting'),
				'id'                         => 'thinkup_translate_blogreadmore',
				'type'                       => 'text',
				'validate'                   => 'no_html',
			),

            array(
                'id'       => 'thinkup_section_translate_contact',
                'type'     => $thinkup_section_field,
                'title'    => __( ' ', 'consulting' ),
                'subtitle' => __( '<span class="redux-title">Template - Contact</span>', 'consulting' ),
                'indent'   => false,
            ),

			array(
				'title'                      => __('Contact Form Title', 'consulting'), 
				$thinkup_subtitle_panel      => __('Leave blank to display default: "Send a message".', 'consulting'),
				$thinkup_subtitle_customizer => __('Leave blank to display default: "Send a message".', 'consulting'),
				'id'                         => 'thinkup_translate_contactformtitle',
				'type'                       => 'text',
				'validate'                   => 'no_html',
			),

//			array(
//				'title'                      => __('Company Information Title', 'consulting'), 
//				$thinkup_subtitle_panel      => __('Leave blank to display default: "About Us".', 'consulting'),
//				$thinkup_subtitle_customizer => __('Leave blank to display default: "About Us".', 'consulting'),
//				'id'                         => 'thinkup_translate_contactabouttitle',
//				'type'                       => 'text',
//				'validate'                   => 'no_html',
//			),
		)
	) );


	// -----------------------------------------------------------------------------------
	//	14.	WooCommerce
	// -----------------------------------------------------------------------------------

	Redux::setSection( $opt_name, array(
		'title'      => __('WooCommerce', 'consulting'),
		'desc'       => __('<span class="redux-title">WooCommerce Settings</span>', 'consulting'),
		'icon'       => 'el el-shopping-cart',
		'icon_class' => '',
        'subsection' => $thinkup_customizer_subsection,
        'customizer' => false,
		'fields'     => array(

			array(
				'title'                      => __('Enable Theme Specific Style', 'consulting'), 
				$thinkup_subtitle_panel      => __('Check to enable theme specific WooCommerce style.', 'consulting'),
				$thinkup_subtitle_customizer => __('Check to enable theme specific WooCommerce style.', 'consulting'),
				'id'                         => 'thinkup_woocommerce_styleswitch',
				'type'                       => 'switch',
				'default'                    => '1',
			),

			array(
				'title'                      => __('Shop Layout', 'consulting'), 
				$thinkup_subtitle_panel      => __('Select shop page layout. This will only be applied to the main shop page and not individual products.', 'consulting'),
				$thinkup_subtitle_customizer => __('Select shop page layout. This will only be applied to the main shop page and not individual products.', 'consulting'),
				'id'                         => 'thinkup_woocommerce_layout',
				'type'                       => 'image_select',
				'compiler'                   => true,
				'options'                    => array(
					'option1' => trailingslashit( get_template_directory_uri() ) . 'admin/main/assets/img/layout/portfolio/option01.png',
					'option2' => trailingslashit( get_template_directory_uri() ) . 'admin/main/assets/img/layout/portfolio/option02.png',
					'option3' => trailingslashit( get_template_directory_uri() ) . 'admin/main/assets/img/layout/portfolio/option03.png',
					'option4' => trailingslashit( get_template_directory_uri() ) . 'admin/main/assets/img/layout/portfolio/option04.png',
					'option5' => trailingslashit( get_template_directory_uri() ) . 'admin/main/assets/img/layout/portfolio/option05.png',
					'option6' => trailingslashit( get_template_directory_uri() ) . 'admin/main/assets/img/layout/portfolio/option06.png',
					'option7' => trailingslashit( get_template_directory_uri() ) . 'admin/main/assets/img/layout/portfolio/option07.png',
					'option8' => trailingslashit( get_template_directory_uri() ) . 'admin/main/assets/img/layout/portfolio/option08.png',
				),
			),

			array(
				'title'                      => __('Select a Sidebar', 'consulting'), 
				$thinkup_subtitle_panel      => __('Choose a sidebar to use with the layout.', 'consulting'),
				$thinkup_subtitle_customizer => __('Choose a sidebar to use with the layout.', 'consulting'),
				'id'                         => 'thinkup_woocommerce_sidebars',
				'type'                       => 'select',
				'data'                       => 'sidebars',
				'required'                   => array( 
					array( 'thinkup_woocommerce_layout', '=', 
						array( 'option5', 'option6', 'option7', 'option8' ),
					), 
				)
			),

			array(
				'title'                      => __('Products Per Page', 'consulting'), 
				$thinkup_subtitle_panel      => __('Specify the number of products per page on the shop page.', 'consulting'),
				$thinkup_subtitle_customizer => __('Specify the number of products per page on the shop page.', 'consulting'),
				'id'                         => 'thinkup_woocommerce_countshop',
				'type'                       => 'select',
				'options'                    => array(
					'2'  => '2',
					'3'  => '3',
					'4'  => '4',
					'5'  => '5',
					'6'  => '6',
					'7'  => '7',
					'8'  => '8',
					'9'  => '9',
					'10' => '10',
					'11' => '11',
					'12' => '12',
					'13' => '13',
					'14' => '14',
					'15' => '15',
					'16' => '16',
					'17' => '17',
					'18' => '18',
					'19' => '19',
					'20' => '20',
				),
			),

			array(
				'title'                      => __('Product Meta Content', 'consulting'), 
				$thinkup_subtitle_panel      => __('Choose which meta content to display on the shop page.', 'consulting'),
				$thinkup_subtitle_customizer => __('Choose which meta content to display on the shop page.', 'consulting'),
				'id'                         => 'thinkup_woocommerce_contentcheck',
				'type'                       => 'checkbox',
				'options'                    => array(
//					'option1' => 'Enable "Quick View".',
					'option2' => 'Enable lightbox.',
					'option3' => 'Enable likes.',
//					'option4' => 'Enable social sharing.',
				),
			),

			array(
				'title'                      => __('Product Excerpt', 'consulting'), 
				$thinkup_subtitle_panel      => __('Check to enable product excerpt.', 'consulting'),
				$thinkup_subtitle_customizer => __('Check to enable product excerpt.', 'consulting'),
				'id'                         => 'thinkup_woocommerce_excerptshop',
				'type'                       => 'switch',
				'default'                    => '0',
			),

			array(
				'title'                      => __('Excerpt Length', 'consulting'), 
				$thinkup_subtitle_panel      => __('Specify number of words in product excerpt.<br />Default = Full excerpt.', 'consulting'),
				$thinkup_subtitle_customizer => __('Specify number of words in product excerpt.<br />Default = Full excerpt.', 'consulting'),
				'id'                         => 'thinkup_woocommerce_excerptlength',
				'type'                       => 'select',
				'data'                       => 'excerpt',
				'required'                   => array( 
					array( 'thinkup_woocommerce_excerptshop', '=', 
						array( '1' ),
					), 
				)
			),

            array(
                'id'       => 'thinkup_section_woo_products',
                'type'     => $thinkup_section_field,
                'title'    => __( ' ', 'consulting' ),
                'subtitle' => __( '<span class="redux-title">WooCommerce Product Page</span>', 'consulting' ),
                'indent'   => false,
            ),

			array(
				'title'                      => __('Product Page Layout', 'consulting'), 
				$thinkup_subtitle_panel      => __('Select page layout. This will only be applied to published Pages (I.e. Not posts, blog or home).', 'consulting'),
				$thinkup_subtitle_customizer => __('Select page layout. This will only be applied to published Pages (I.e. Not posts, blog or home).', 'consulting'),
				'id'                         => 'thinkup_woocommerce_layoutproduct',
				'type'                       => 'image_select',
				'compiler'                   => true,
				'default'                    => '0',
				'options'                    => array(
					'option1' => trailingslashit( get_template_directory_uri() ) . 'admin/main/assets/img/layout/blog/option01.png',
					'option2' => trailingslashit( get_template_directory_uri() ) . 'admin/main/assets/img/layout/blog/option02.png',
					'option3' => trailingslashit( get_template_directory_uri() ) . 'admin/main/assets/img/layout/blog/option03.png',
				),
			),

			array(
				'title'                      => __('Select a Sidebar', 'consulting'), 
				$thinkup_subtitle_panel      => __('Choose a sidebar to use with the page layout.', 'consulting'),
				$thinkup_subtitle_customizer => __('Choose a sidebar to use with the page layout.', 'consulting'),
				'id'                         => 'thinkup_woocommerce_sidebarsproduct',
				'type'                       => 'select',
				'data'                       => 'sidebars',
				'required'                   => array( 
					array( 'thinkup_woocommerce_layoutproduct', '=', 
						array( 'option2', 'option3' ),
					), 
				)
			),

			array(
				'title'                      => __('Meta Content', 'consulting'), 
				$thinkup_subtitle_panel      => __('Choose which meta content to display on the product page.', 'consulting'),
				$thinkup_subtitle_customizer => __('Choose which meta content to display on the product page.', 'consulting'),
				'id'                         => 'thinkup_woocommerce_contentcheckproduct',
				'type'                       => 'checkbox',
				'options'                    => array(
					'option1' => 'Enable likes.',
//					'option2' => 'Enable social sharing.',
				),
			),

			array(
				'title'                      => __('Variation Style', 'consulting'), 
				$thinkup_subtitle_panel      => __('Choose a variation style.', 'consulting'),
				$thinkup_subtitle_customizer => __('Choose a variation style.', 'consulting'),
				'id'                         => 'thinkup_woocommerce_variation',
				'type'                       => 'radio',
				'options'                    => array( 
					'option1' => 'Dropdown', 
					'option2' => 'Buttons',
				),
			),

			array(
				'title'   => __('Hide Variation Title', 'consulting'), 
				'desc'    => __('Check to hide variation titles.', 'consulting'),
				'id'      => 'thinkup_woocommerce_variationtitle',
				'type'    => 'checkbox',
				'default' => '0',
			),

			array(
				'title'   => __('Hide SKU ID', 'consulting'), 
				'desc'    => __('Check to hide SKU ID.', 'consulting'),
				'id'      => 'thinkup_woocommerce_skuswitch',
				'type'    => 'checkbox',
				'default' => '0',
			),

            array(
                'id'       => 'thinkup_section_woo_related',
                'type'     => $thinkup_section_field,
                'title'    => __( ' ', 'consulting' ),
                'subtitle' => __( '<span class="redux-title">WooCommerce Product Page - Related Products</span>', 'consulting' ),
                'indent'   => false,
            ),

			array(
				'title'                      => __('Related Products Layout', 'consulting'), 
				$thinkup_subtitle_panel      => __('Select related products layout.', 'consulting'),
				$thinkup_subtitle_customizer => __('Select related products layout.', 'consulting'),
				'id'                         => 'thinkup_woocommerce_layoutrelated',
				'type'                       => 'image_select',
				'compiler'                   => true,
				'options'                    => array(
					'option1' => trailingslashit( get_template_directory_uri() ) . 'admin/main/assets/img/layout/portfolio/option02.png',
					'option2' => trailingslashit( get_template_directory_uri() ) . 'admin/main/assets/img/layout/portfolio/option03.png',
					'option3' => trailingslashit( get_template_directory_uri() ) . 'admin/main/assets/img/layout/portfolio/option04.png',
				),
			),

			array(
				'title'                      => __('Number of Related Products', 'consulting'), 
				$thinkup_subtitle_panel      => __('Specify the number of related products to be shown on the products layout.', 'consulting'),
				$thinkup_subtitle_customizer => __('Specify the number of related products to be shown on the products layout.', 'consulting'),
				'id'                         => 'thinkup_woocommerce_countrelated',
				'type'                       => 'select',
				'options'                    => array(
					'2'  => '2',
					'3'  => '3',
					'4'  => '4',
					'5'  => '5',
					'6'  => '6',
					'7'  => '7',
					'8'  => '8',
					'9'  => '9',
					'10' => '10',
					'11' => '11',
					'12' => '12',
				),
			),

			array(
				'title'                      => __('Product Meta Content', 'consulting'), 
				$thinkup_subtitle_panel      => __('Choose which meta content to display for the related products.', 'consulting'),
				$thinkup_subtitle_customizer => __('Choose which meta content to display for the related products.', 'consulting'),
				'id'                         => 'thinkup_woocommerce_contentcheckrelated',
				'type'                       => 'checkbox',
				'options'                    => array(
//					'option1' => 'Enable "Quick View".',
//					'option2' => 'Enable lightbox.',
					'option3' => 'Enable likes.',
//					'option4' => 'Enable social sharing.',
				),
			),

			array(
				'title'                      => __('Product Excerpt', 'consulting'), 
				$thinkup_subtitle_panel      => __('Check to enable product excerpt.', 'consulting'),
				$thinkup_subtitle_customizer => __('Check to enable product excerpt.', 'consulting'),
				'id'                         => 'thinkup_woocommerce_excerptrelated',
				'type'                       => 'switch',
				'default'                    => '0',
			),
		)
	) );


	// -----------------------------------------------------------------------------------
	//	15.	Support
	// -----------------------------------------------------------------------------------

    Redux::setSection( $opt_name, array(
		'title'      => __('Support', 'consulting'),
		'desc'       => __('<span class="redux-title">Documentation</span><p>We&#39;ve produced a detailed demo of each theme where most of the common questions can be found such as how to use shortcodes and setup basic page layouts. To find out more visit us at <a href="http://www.thinkupthemes.com/" target="_blank">www.thinkupthemes.com</a> and check the information pages of the demo theme your using.</p><p>This theme also comes with a detailed user manual which should help answer all your common questions.</p>', 'consulting'),
		'icon'       => 'el el-user',
		'icon_class' => '',
        'id'         => 'thinkup_section_support',
        'subsection' => $thinkup_customizer_subsection,
        'customizer' => false,
		'fields'     => array(

            array(
                'id'                         => 'thinkup_section_support_info',
                'type'                       => $thinkup_section_field,
				$thinkup_subtitle_panel      => __('<span class="redux-title">Ticket Support</span><p>Don&#39;t panic! If you can&#39;t find the answer in the theme documentation then please submit a support ticket. These tickets are dealt with by the guys that built the theme so will definitely be able to help!</p><p>Just submit a support ticket at <a href="http://www.thinkupthemes.com/support/" target="_blank">www.thinkupthemes.com/support</a></p>', 'consulting'),
				$thinkup_subtitle_customizer => __('<span class="redux-title">Ticket Support</span><p>Don&#39;t panic! If you can&#39;t find the answer in the theme documentation then please submit a support ticket. These tickets are dealt with by the guys that built the theme so will definitely be able to help!</p><p>Just submit a support ticket at <a href="http://www.thinkupthemes.com/support/" target="_blank">www.thinkupthemes.com/support</a></p>', 'consulting'),
                'indent'                     => false,
            ),
		)
	) );


    Redux::setSection( $opt_name, array(
		'type' => 'divide',
	) );


    /*
     * <--- END SECTIONS
     */

    /**
     * This is a test function that will let you see when the compiler hook occurs.
     * It only runs if a field    set with compiler=> true is changed.
     * */
    if ( ! function_exists( 'compiler_action' ) ) {
        function compiler_action( $options, $css, $changed_values ) {
            echo '<h1>The compiler hook has run!</h1>';
            echo "<pre>";
            print_r( $changed_values ); // Values that have changed since the last save
            echo "</pre>";
            //print_r($options); //Option values
            //print_r($css); // Compiler selector CSS values  compiler => array( CSS SELECTORS )
        }
    }

    /**
     * Custom function for the callback validation referenced above
     * */
    if ( ! function_exists( 'redux_validate_callback_function' ) ) {
        function redux_validate_callback_function( $field, $value, $existing_value ) {
            $error   = false;
            $warning = false;

            //do your validation
            if ( $value == 1 ) {
                $error = true;
                $value = $existing_value;
            } elseif ( $value == 2 ) {
                $warning = true;
                $value   = $existing_value;
            }

            $return['value'] = $value;

            if ( $error == true ) {
                $return['error'] = $field;
                $field['msg']    = 'your custom error message';
            }

            if ( $warning == true ) {
                $return['warning'] = $field;
                $field['msg']      = 'your custom warning message';
            }

            return $return;
        }
    }

    /**
     * Filter hook for filtering the args. Good for child themes to override or add to the args array. Can also be used in other functions.
     * */
    if ( ! function_exists( 'change_arguments' ) ) {
        function change_arguments( $args ) {
            //$args['dev_mode'] = true;

            return $args;
        }
    }

    /**
     * Filter hook for filtering the default value of any given field. Very useful in development mode.
     * */
    if ( ! function_exists( 'change_defaults' ) ) {
        function change_defaults( $defaults ) {
            $defaults['str_replace'] = 'Testing filter hook!';

            return $defaults;
        }
    }

    /**
     * Removes the demo link and the notice of integrated demo from the redux-framework plugin
     */
    if ( ! function_exists( 'remove_demo' ) ) {
        function remove_demo() {
            // Used to hide the demo mode link from the plugin page. Only used when Redux is a plugin.
            if ( class_exists( 'ReduxFrameworkPlugin' ) ) {
                remove_filter( 'plugin_row_meta', array(
                    ReduxFrameworkPlugin::instance(),
                    'plugin_metalinks'
                ), null, 2 );

                // Used to hide the activation notice informing users of the demo panel. Only used when Redux is a plugin.
                remove_action( 'admin_notices', array( ReduxFrameworkPlugin::instance(), 'admin_notices' ) );
            }
        }
    }

