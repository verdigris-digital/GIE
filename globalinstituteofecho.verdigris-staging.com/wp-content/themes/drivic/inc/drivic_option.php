<?php
    /**
     * ReduxFramework Sample Config File
     * For full documentation, please visit: http://docs.reduxframework.com/
     */

    if ( ! class_exists( 'Redux' ) ) {
        return;
    }


    // This is your option name where all the Redux data is stored.
    $opt_name = "drivic_option";

    // This line is only for altering the demo. Can be easily removed.
    $opt_name = apply_filters( 'redux_demo/opt_name', $opt_name );

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
        'allow_sub_menu'       => true,
        // Show the sections below the admin menu item or not
        'menu_title'           => __( 'Drivic Options', 'drivic' ),
        'page_title'           => __( 'Drivic Options', 'drivic' ),
        // You will need to generate a Google API key to use this feature.
        // Please visit: https://developers.google.com/fonts/docs/developer_api#Auth
        'google_api_key'       => '',
        // Set it you want google fonts to update weekly. A google_api_key value is required.
        'google_update_weekly' => false,
        // Must be defined to add google fonts to the typography module
        'async_typography'     => true,
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
        'update_notice'        => true,
        // If dev_mode is enabled, will notify developer of updated versions available in the GitHub Repo
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
        'save_defaults'        => true,
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
    $args['admin_bar_links'][] = array(
        'id'    => 'redux-docs',
        'href'  => 'http://docs.reduxframework.com/',
        'title' => __( 'Documentation', 'drivic' ),
    );

    $args['admin_bar_links'][] = array(
        //'id'    => 'redux-support',
        'href'  => 'https://github.com/ReduxFramework/redux-framework/issues',
        'title' => __( 'Support', 'drivic' ),
    );

    $args['admin_bar_links'][] = array(
        'id'    => 'redux-extensions',
        'href'  => 'reduxframework.com/extensions',
        'title' => __( 'Extensions', 'drivic' ),
    );


    Redux::setArgs( $opt_name, $args );

    /*
     * ---> END ARGUMENTS
     */


    /*
     * ---> START HELP TABS
     */

    $tabs = array(
        array(
            'id'      => 'redux-help-tab-1',
            'title'   => __( 'Theme Information 1', 'drivic' ),
            'content' => __( '<p>This is the tab content, HTML is allowed.</p>', 'drivic' )
        ),
        array(
            'id'      => 'redux-help-tab-2',
            'title'   => __( 'Theme Information 2', 'drivic' ),
            'content' => __( '<p>This is the tab content, HTML is allowed.</p>', 'drivic' )
        )
    );
    Redux::setHelpTab( $opt_name, $tabs );

    // Set the help sidebar
    $content = __( '<p>This is the sidebar content, HTML is allowed.</p>', 'drivic' );
    Redux::setHelpSidebar( $opt_name, $content );


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

    // -> Start General Option
    Redux::setSection( $opt_name, array(
        'title'            => __( 'General Option', 'drivic' ),
        'id'               => 'general',
        'desc'             => __( 'Please Add Your General Option', 'drivic' ),
        'customizer_width' => '400px',
        'icon'             => 'el el-idea-alt',
        'fields'           => array(
            array(
                'id'       => 'preloader-show',
                'type'     => 'checkbox',
                'title'    => __( 'Preloader Show', 'drivic' ),
                'desc'     => __( 'Please Check and show Preloader', 'drivic' ),
            ),
            array(
                'id'       => 'page-title-bg',
                'type'     => 'media',
                'title'    => esc_html__( 'Page Title Background', 'drivic' ),
                'desc'     => esc_html__( 'Page Title Background Image', 'drivic' ),
            ),
            array(
                'id'       => 'page-title-hide',
                'type'     => 'checkbox',
                'title'    => __( 'Page Title Hide', 'drivic' ),
                'desc'     => __( 'Please Check and Page Title Hide', 'drivic' ),
            ),
        ),
    ) );

    // -> START Header Top Fields
    Redux::setSection( $opt_name, array(
        'title'            => esc_html__( 'Header Top', 'drivic' ),
        'id'               => 'header-top',
        'desc'             => esc_html__( 'Please Add Your Header Top Option', 'drivic' ),
        'customizer_width' => '400px',
        'icon'             => 'el el-align-center ',
        'fields'           => array(
            array(
                'id'       => 'header-phone',
                'type'     => 'text',
                'title'    => __( 'Phone Number', 'drivic' ),
                'desc'     => __( 'Please Add Your Phone Number', 'drivic' ),
            ),
            array(
                'id'       => 'header-email',
                'type'     => 'text',
                'title'    => __( 'Email', 'drivic' ),
                'desc'     => __( 'Please Add Your Email Address', 'drivic' ),
            ),
            array(
                'id'       => 'header-location',
                'type'     => 'text',
                'title'    => __( 'Location', 'drivic' ),
                'desc'     => __( 'Please Add Your location', 'drivic' ),
            ),
        )
    ) );

    // -> START Social Fields
    Redux::setSection( $opt_name, array(
        'title'            => esc_html__( 'Drivic Social', 'drivic' ),
        'id'               => 'drivic-social',
        'desc'             => esc_html__( 'Please Add Your Social Option', 'drivic' ),
        'customizer_width' => '400px',
        'icon'             => 'el el-address-book-alt',
        'fields'           => array(
            array(
                'id'       => 'facebook',
                'type'     => 'text',
                'title'    => __( 'Facebook URL', 'drivic' ),
                'desc'     => __( 'Please Add Your Facebook URL', 'drivic' ),
            ),
            array(
                'id'       => 'twitter',
                'type'     => 'text',
                'title'    => __( 'Twitter URL', 'drivic' ),
                'desc'     => __( 'Please Add Your Twitter URL', 'drivic' ),
            ),
            array(
                'id'       => 'instagram',
                'type'     => 'text',
                'title'    => __( 'Instagram URL', 'drivic' ),
                'desc'     => __( 'Please Add Your Instagram URL', 'drivic' ),
            ),
            array(
                'id'       => 'linkedin',
                'type'     => 'text',
                'title'    => __( 'Linkedin URL', 'drivic' ),
                'desc'     => __( 'Please Add Your Linkedin URL', 'drivic' ),
            ),
            array(
                'id'       => 'pinterest',
                'type'     => 'text',
                'title'    => __( 'Pinterest URL', 'drivic' ),
                'desc'     => __( 'Please Add Your Pinterest URL', 'drivic' ),
            ),
            array(
                'id'       => 'youtube',
                'type'     => 'text',
                'title'    => __( 'Youtube URL', 'drivic' ),
                'desc'     => __( 'Please Add Your Youtube URL', 'drivic' ),
            ),
            array(
                'id'       => 'skype',
                'type'     => 'text',
                'title'    => __( 'Skype URL', 'drivic' ),
                'desc'     => __( 'Please Add Your Skype URL', 'drivic' ),
            ),
            array(
                'id'       => 'dribble',
                'type'     => 'text',
                'title'    => __( 'Dribble URL', 'drivic' ),
                'desc'     => __( 'Please Add Your Dribble URL', 'drivic' ),
            ),
        )
    ) );

    // -> START Header Main Menu Fields
    Redux::setSection( $opt_name, array(
        'title'            => esc_html__( 'Header Option', 'drivic' ),
        'id'               => 'header',
        'desc'             => esc_html__( 'Please Add Your Header Option', 'drivic' ),
        'customizer_width' => '400px',
        'icon'             => 'el el-home',
        'fields'           => array(
            array(
                'id'       => 'main-logo',
                'type'     => 'media',
                'title'    => esc_html__( 'Main Menu Logo', 'drivic' ),
                'desc'     => esc_html__( 'Upload Your Main Menu Logo', 'drivic' ),
                'default'  => array( 'url' => get_template_directory_uri() . '/assets/img/logo.svg'),
            ),
            array(
                'id'       => 'search-icon-show',
                'type'     => 'checkbox',
                'title'    => __( 'Search Icon Show', 'drivic' ),
                'desc'     => __( 'Please Check and show header Search Icon', 'drivic' ),
            ),
            array(
                'id'       => 'hamberger-menu-show',
                'type'     => 'checkbox',
                'title'    => __( 'Hamberger Menu Show', 'drivic' ),
                'desc'     => __( 'Please Check and Hamberger Menu Show', 'drivic' ),
            ),
			array(
                'id'       => 'btn_text',
                'type'     => 'text',
                'title'    => __( 'btn text', 'drivic' ),
                'desc'     => __( 'Please Add Your Subscribe Shortcode', 'drivic' ),
            ),
            array(
                'id'       => 'btn_url',
                'type'     => 'text',
                'title'    => __( 'btn url', 'drivic' ),
                'desc'     => __( 'Please Add Your Subscribe Shortcode', 'drivic' ),
            ),
        )
    ) );

	// -> START Header Right Side Fields
    Redux::setSection( $opt_name, array(
        'title'            => esc_html__( 'Header Right Side', 'drivic' ),
        'id'               => 'header-right',
        'desc'             => esc_html__( 'Please Add Your Header Right Side', 'drivic' ),
        'customizer_width' => '400px',
        'icon'             => 'el el-align-justify',
        'fields'           => array(
            array(
                'id'       => 'right-content',
                'type'     => 'textarea',
                'title'    => __( 'Content', 'drivic' ),
                'desc'     => __( 'Please Add Your Right Bar Content', 'drivic' ),
            ),
            array(
                'id'       => 'right-content-2',
                'type'     => 'textarea',
                'title'    => __( 'Content Two', 'drivic' ),
                'desc'     => __( 'Please Add Your Right Bar Content Two', 'drivic' ),
            ),
            array(
                'id'       => 'right-subscribe',
                'type'     => 'text',
                'title'    => __( 'Subscribe Shortcode', 'drivic' ),
                'desc'     => __( 'Please Add Your Subscribe Shortcode', 'drivic' ),
            ),
        )
    ) );
	// -> END Header Right Side Fields

    // -> Start Footer Option
    Redux::setSection( $opt_name, array(
        'title'            => esc_html__( 'Footer Option', 'drivic' ),
        'id'               => 'footer',
        'desc'             => esc_html__( 'Please Add Your Footer Option', 'drivic' ),
        'customizer_width' => '400px',
        'icon'             => 'el el-indent-left',
        'fields'           => array(
            array(
                'id'       => 'subscribe-title',
                'type'     => 'text',
                'title'    => esc_html__( 'Call to Action Title', 'drivic' ),
                'desc'     => esc_html__( 'Add Call to Action Title', 'drivic' ),
            ),
            array(
                'id'       => 'subscribe-content',
                'type'     => 'textarea',
                'title'    => esc_html__( 'Call to Action Content', 'drivic' ),
                'desc'     => esc_html__( 'Add Call to Action Content', 'drivic' ),
            ),
            array(
                'id'       => 'subscribe-shortcode',
                'type'     => 'text',
                'title'    => esc_html__( 'Subscribe to Action Shortcode', 'drivic' ),
                'desc'     => esc_html__( 'Add Subscribe to Action Shortcode', 'drivic' ),
            ),
            array(
                'id'       => 'footer-bg',
                'type'     => 'media',
                'title'    => esc_html__( 'Footer bg', 'drivic' ),
                'desc'     => esc_html__( 'Upload Your Footer bg', 'drivic' ),
            ),
            array(
                'id'       => 'copyright',
                'type'     => 'textarea',
                'title'    => esc_html__( 'Copyright', 'drivic' ),
                'desc'     => esc_html__( 'Add Copyright Text', 'drivic' ),
                'default'  => 'Copyright © 2022 Drivic. All Right reserved.',
            ),
        )
    ) );
    
    
    /*
     * <--- END SECTIONS
     */


    /*
     *
     * YOU MUST PREFIX THE FUNCTIONS BELOW AND ACTION FUNCTION CALLS OR ANY OTHER CONFIG MAY OVERRIDE YOUR CODE.
     *
     */

    /*
    *
    * --> Action hook examples
    *
    */

    // If Redux is running as a plugin, this will remove the demo notice and links
    //add_action( 'redux/loaded', 'remove_demo' );

    // Function to test the compiler hook and demo CSS output.
    // Above 10 is a priority, but 2 in necessary to include the dynamically generated CSS to be sent to the function.
    //add_filter('redux/options/' . $opt_name . '/compiler', 'compiler_action', 10, 3);

    // Change the arguments after they've been declared, but before the panel is created
    //add_filter('redux/options/' . $opt_name . '/args', 'change_arguments' );

    // Change the default value of a field after it's been set, but before it's been useds
    //add_filter('redux/options/' . $opt_name . '/defaults', 'change_defaults' );

    // Dynamically add a section. Can be also used to modify sections/fields
    //add_filter('redux/options/' . $opt_name . '/sections', 'dynamic_section');

    /**
     * This is a test function that will let you see when the compiler hook occurs.
     * It only runs if a field    set with compiler=>true is changed.
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
                $field['msg']    = 'your custom error message';
                $return['error'] = $field;
            }

            if ( $warning == true ) {
                $field['msg']      = 'your custom warning message';
                $return['warning'] = $field;
            }

            return $return;
        }
    }

    /**
     * Custom function for the callback referenced above
     */
    if ( ! function_exists( 'redux_my_custom_field' ) ) {
        function redux_my_custom_field( $field, $value ) {
            print_r( $field );
            echo '<br/>';
            print_r( $value );
        }
    }

    /**
     * Custom function for filtering the sections array. Good for child themes to override or add to the sections.
     * Simply include this function in the child themes functions.php file.
     * NOTE: the defined constants for URLs, and directories will NOT be available at this point in a child theme,
     * so you must use get_template_directory_uri() if you want to use any of the built in icons
     * */
    if ( ! function_exists( 'dynamic_section' ) ) {
        function dynamic_section( $sections ) {
            //$sections = array();
            $sections[] = array(
                'title'  => __( 'Section via hook', 'drivic' ),
                'desc'   => __( '<p class="description">This is a section created by adding a filter to the sections array. Can be used by child themes to add/remove sections from the options.</p>', 'drivic' ),
                'icon'   => 'el el-paper-clip',
                // Leave this as a blank section, no options just some intro text set above.
                'fields' => array()
            );

            return $sections;
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

   
