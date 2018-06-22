<?php
/**
 * tr_theme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package tr_theme
 */

if ( ! function_exists( 'tr_theme_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function tr_theme_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on tr_theme, use a find and replace
		 * to change 'tr_theme' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'tr_theme', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'menu-1' => esc_html__( 'Primary', 'tr_theme' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'tr_theme_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );
	}
endif;
add_action( 'after_setup_theme', 'tr_theme_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function tr_theme_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'tr_theme_content_width', 640 );
}
add_action( 'after_setup_theme', 'tr_theme_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function tr_theme_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'tr_theme' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'tr_theme' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'tr_theme_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function tr_theme_scripts() {

    wp_enqueue_style('main-css', get_template_directory_uri() . '/css/main.css');

    wp_enqueue_style('font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css');

    wp_enqueue_style('font-awesome-5', '//use.fontawesome.com/releases/v5.1.0/css/all.css');

    wp_enqueue_style('slick-css', get_template_directory_uri() . '/slick/slick/slick.css');

    wp_enqueue_style('slick-theme-css', get_template_directory_uri() . '/slick/slick/slick-theme.css');

    wp_enqueue_script("jquery");

    wp_enqueue_script('main-js', get_template_directory_uri() . '/js/main.js');

    wp_enqueue_script('slick-js', get_template_directory_uri() . '/slick/slick/slick.min.js');

	wp_enqueue_style( 'tr_theme-style', get_stylesheet_uri() );

	wp_enqueue_script( 'tr_theme-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );

	wp_enqueue_script( 'tr_theme-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'tr_theme_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

function kulyk_wordpress_customize_register($wp_customize)
{
    // header section

    $wp_customize->add_section('header_settings', array(
        'title' => __('Header settings', 'kulyk_wordpress')
    ));

    $wp_customize->add_setting('header_background');

    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'header_background', array(
        'label' => __('Insert header background image', 'kulyk_wordpress'),
        'section' => 'header_settings',
        'settings' => 'header_background',
    )));

    $wp_customize->add_setting('header_text', array(
        'default' => __('', 'kulyk_wordpress'),
        'transport' => 'refresh',
    ));

    $wp_customize->add_control(
        'header_text', array(
        'label' => __('Enter header text', 'kulyk_wordpress'),
        'section' => 'header_settings',
        'settings' => 'header_text',
        'type' => 'text',
    ));
    $wp_customize->add_setting('subheader_text', array(
        'default' => __('', 'kulyk_wordpress'),
        'transport' => 'refresh',
    ));

    $wp_customize->add_control(
        'subheader_text', array(
        'label' => __('Enter subheader text', 'kulyk_wordpress'),
        'section' => 'header_settings',
        'settings' => 'subheader_text',
        'type' => 'textarea',
    ));
    $wp_customize->add_setting('link_text', array(
        'default' => __('Read more', 'kulyk_wordpress'),
        'transport' => 'refresh',
    ));

    $wp_customize->add_control(
        'link_text', array(
        'label' => __('Enter link text', 'kulyk_wordpress'),
        'section' => 'header_settings',
        'settings' => 'link_text',
        'type' => 'text',
    ));

    $wp_customize->add_setting('link_url', array(
        'default' => __('#', 'kulyk_wordpress'),
        'transport' => 'refresh',
    ));

    $wp_customize->add_control(
        'link_url', array(
        'label' => __('Enter link url', 'kulyk_wordpress'),
        'section' => 'header_settings',
        'settings' => 'link_url',
        'type' => 'text',
    ));

    // download section

    $wp_customize->add_section('download_settings', array(
        'title' => __('Download settings', 'kulyk_wordpress')
    ));

    $wp_customize->add_setting('download_head_text', array(
        'default' => __('#', 'kulyk_wordpress'),
        'transport' => 'refresh',
    ));

    $wp_customize->add_control(
        'download_head_text', array(
        'label' => __('Enter download head info', 'kulyk_wordpress'),
        'section' => 'download_settings',
        'settings' => 'download_head_text',
        'type' => 'text',
    ));

    $wp_customize->add_setting('download_subhead_text', array(
        'default' => __('#', 'kulyk_wordpress'),
        'transport' => 'refresh',
    ));

    $wp_customize->add_control(
        'download_subhead_text', array(
        'label' => __('Enter download subhead info', 'kulyk_wordpress'),
        'section' => 'download_settings',
        'settings' => 'download_subhead_text',
        'type' => 'text',
    ));

    $wp_customize->add_setting('download_link_text', array(
        'default' => __('#', 'kulyk_wordpress'),
        'transport' => 'refresh',
    ));

    $wp_customize->add_control(
        'download_link_text', array(
        'label' => __('Enter download link text', 'kulyk_wordpress'),
        'section' => 'download_settings',
        'settings' => 'download_link_text',
        'type' => 'text',
    ));

    $wp_customize->add_setting('download_link_url', array(
        'default' => __('#', 'kulyk_wordpress'),
        'transport' => 'refresh',
    ));

    $wp_customize->add_control(
        'download_link_url', array(
        'label' => __('Enter download link url', 'kulyk_wordpress'),
        'section' => 'download_settings',
        'settings' => 'download_link_url',
        'type' => 'text',
    ));
    //footer

    $wp_customize->add_section('footer_settings', array(
        'title' => __('Footer settings', 'kulyk_wordpress')
    ));

    $wp_customize->add_setting('footer_address_head', array(
        'default' => __('#', 'kulyk_wordpress'),
        'transport' => 'refresh',
    ));

    $wp_customize->add_control(
        'footer_adress_head', array(
        'label' => __('Enter footer address head text', 'kulyk_wordpress'),
        'section' => 'footer_settings',
        'settings' => 'footer_address_head',
        'type' => 'textarea',
    ));

    $wp_customize->add_setting('footer_address', array(
        'default' => __('#', 'kulyk_wordpress'),
        'transport' => 'refresh',
    ));

    $wp_customize->add_control(
        'footer_address', array(
        'label' => __('Enter footer address', 'kulyk_wordpress'),
        'section' => 'footer_settings',
        'settings' => 'footer_address',
        'type' => 'text',
    ));

    $wp_customize->add_setting('footer_about_head', array(
        'default' => __('#', 'kulyk_wordpress'),
        'transport' => 'refresh',
    ));

    $wp_customize->add_control(
        'footer_about_head', array(
        'label' => __('Enter footer about head text', 'kulyk_wordpress'),
        'section' => 'footer_settings',
        'settings' => 'footer_about_head',
        'type' => 'textarea',
    ));

    $wp_customize->add_setting('footer_about_text', array(
        'default' => __('#', 'kulyk_wordpress'),
        'transport' => 'refresh',
    ));

    $wp_customize->add_control(
        'footer_about_text', array(
        'label' => __('Enter footer about text', 'kulyk_wordpress'),
        'section' => 'footer_settings',
        'settings' => 'footer_about_text',
        'type' => 'textarea',
    ));

    $wp_customize->add_setting('footer_social_text', array(
        'default' => __('#', 'kulyk_wordpress'),
        'transport' => 'refresh',
    ));

    $wp_customize->add_control(
        'footer_social_text', array(
        'label' => __('Enter footer about text', 'kulyk_wordpress'),
        'section' => 'footer_settings',
        'settings' => 'footer_about_text',
        'type' => 'textarea',
    ));

    //footer

    $wp_customize->add_setting('footer_facebook_link', array(
        'default' => __('#', 'kulyk_wordpress'),
        'transport' => 'refresh',
    ));

    $wp_customize->add_control(
        'footer_facebook_link', array(
        'label' => __('Enter footer facebook link', 'kulyk_wordpress'),
        'section' => 'footer_settings',
        'settings' => 'footer_facebook_link',
        'type' => 'text',
    ));

    $wp_customize->add_setting('footer_facebook_icon', array(
        'default' => __('<i class="fab fa-facebook-f"></i>', 'kulyk_wordpress'),
        'transport' => 'refresh',
    ));

    $wp_customize->add_control(
        'footer_facebook_icon', array(
        'label' => __('Enter footer facebook icon (Font awesome)', 'kulyk_wordpress'),
        'section' => 'footer_settings',
        'settings' => 'footer_facebook_icon',
        'type' => 'text',
    ));

    $wp_customize->add_setting('footer_twitter_link', array(
        'default' => __('#', 'kulyk_wordpress'),
        'transport' => 'refresh',
    ));

    $wp_customize->add_control(
        'footer_twitter_link', array(
        'label' => __('Enter twitter facebook link', 'kulyk_wordpress'),
        'section' => 'footer_settings',
        'settings' => 'footer_twitter_link',
        'type' => 'text',
    ));

    $wp_customize->add_setting('footer_twitter_icon', array(
        'default' => __('<i class="fab fa-twitter"></i>', 'kulyk_wordpress'),
        'transport' => 'refresh',
    ));

    $wp_customize->add_control(
        'footer_twitter_icon', array(
        'label' => __('Enter footer twitter icon (Font awesome)', 'kulyk_wordpress'),
        'section' => 'footer_settings',
        'settings' => 'footer_twitter_icon',
        'type' => 'text',
    ));

    $wp_customize->add_setting('footer_linkedin_link', array(
        'default' => __('#', 'kulyk_wordpress'),
        'transport' => 'refresh',
    ));

    $wp_customize->add_control(
        'footer_linkedin_link', array(
        'label' => __('Enter linkedin link', 'kulyk_wordpress'),
        'section' => 'footer_settings',
        'settings' => 'footer_linkedin_link',
        'type' => 'text',
    ));

    $wp_customize->add_setting('footer_linkedin_icon', array(
        'default' => __('<i class="fab fa-linkedin"></i>', 'kulyk_wordpress'),
        'transport' => 'refresh',
    ));

    $wp_customize->add_control(
        'footer_linkedin_icon', array(
        'label' => __('Enter footer linkedin icon (Font awesome)', 'kulyk_wordpress'),
        'section' => 'footer_settings',
        'settings' => 'footer_linkedin_icon',
        'type' => 'text',
    ));
}

add_action('customize_register', 'kulyk_wordpress_customize_register');

add_action( 'init', 'create_movie_review' );

function create_movie_review() {
    register_post_type( 'movie_reviews',
        array(
            'labels' => array(
                'name' => 'Features',
                'singular_name' => 'Feature',
                'add_new' => 'Add New',
                'add_new_item' => 'Add New Feature',
                'edit' => 'Edit',
                'edit_item' => 'Edit Feature',
                'new_item' => 'New Feature',
                'view' => 'View',
                'view_item' => 'View Feature',
                'search_items' => 'Search Feature',
                'not_found' => 'No Features found',
                'not_found_in_trash' => 'No Features found in Trash',
                'parent' => 'Parent Feature'
            ),

            'public' => true,
            'menu_position' => 15,
            'supports' => array( 'title', 'editor', 'comments', 'thumbnail', 'custom-fields' ),
            'has_archive' => true
        )
    );
}

add_action( 'add_meta_boxes', 'my_admin' );

function my_admin() {
    add_meta_box( 'feature_meta_box',
        'Feature Details',
        'display_feature_meta_box',
        'features',
        'normal',
        'high'
    );
}


add_action( 'init', 'create_team_post' );

function create_team_post() {
    register_post_type( 'team_members',
        array(
            'labels' => array(
                'name' => 'Team',
                'singular_name' => 'Member',
                'add_new' => 'Add New',
                'add_new_item' => 'Add New Member',
                'edit' => 'Edit',
                'edit_item' => 'Edit Member',
                'new_item' => 'New Member',
                'view' => 'View',
                'view_item' => 'View Member',
                'search_items' => 'Search Member',
                'not_found' => 'No Members found',
                'not_found_in_trash' => 'No Members found in Trash',
                'parent' => 'Parent Member'
            ),

            'public' => true,
            'menu_position' => 15,
            'supports' => array( 'title', 'editor', 'comments', 'thumbnail', 'custom-fields' ),
            'has_archive' => true
        )
    );
}

add_action( 'add_meta_boxes', 'my_admin_team' );

function my_admin_team() {
    add_meta_box( 'feature_meta_box',
        'Member Details',
        'display_member_meta_box',
        'team_members',
        'normal',
        'high'
    );
}

add_action( 'init', 'create_testemonial_post' );

function create_testemonial_post() {
    register_post_type( 'testemonial',
        array(
            'labels' => array(
                'name' => 'Testemonials',
                'singular_name' => 'Testemonial',
                'add_new' => 'Add New',
                'add_new_item' => 'Add New Testemonial',
                'edit' => 'Edit',
                'edit_item' => 'Edit Testemonial',
                'new_item' => 'New Testemonial',
                'view' => 'View',
                'view_item' => 'View Testemonial',
                'search_items' => 'Search Testemonial',
                'not_found' => 'No Testemonials found',
                'not_found_in_trash' => 'No Testemonials found in Trash',
                'parent' => 'Parent Testemonial'
            ),

            'public' => true,
            'menu_position' => 15,
            'supports' => array( 'title', 'editor', 'comments', 'thumbnail', 'custom-fields' ),
            'has_archive' => true
        )
    );
}

add_action( 'add_meta_boxes', 'my_admin_testemonial' );

function my_admin_testemonial() {
    add_meta_box( 'testemonial_meta_box',
        'Testemonial Details',
        'display_testemonial_meta_box',
        'testemonial',
        'normal',
        'high'
    );
}



























