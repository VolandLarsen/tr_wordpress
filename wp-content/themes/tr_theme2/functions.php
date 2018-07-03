<?php
/**
 * tr_theme2 functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package tr_theme2
 */

if ( ! function_exists( 'tr_theme2_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function tr_theme2_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on tr_theme2, use a find and replace
		 * to change 'tr_theme2' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'tr_theme2', get_template_directory() . '/languages' );

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
			'menu-1' => esc_html__( 'Primary', 'tr_theme2' ),
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
		add_theme_support( 'custom-background', apply_filters( 'tr_theme2_custom_background_args', array(
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
add_action( 'after_setup_theme', 'tr_theme2_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function tr_theme2_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'tr_theme2_content_width', 640 );
}
add_action( 'after_setup_theme', 'tr_theme2_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function tr_theme2_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'tr_theme2' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'tr_theme2' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'tr_theme2_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function tr_theme2_scripts() {
    wp_enqueue_style('main-css', get_template_directory_uri() . '/css/main.css');

    wp_enqueue_style('font-awesome-5', '//use.fontawesome.com/releases/v5.1.0/css/all.css');

    wp_enqueue_style('slick-css', get_template_directory_uri() . '/slick/slick/slick.css');

    wp_enqueue_style('slick-theme', get_template_directory_uri() . '/slick/slick/slick-theme.css');

    wp_enqueue_style( 'tr_theme2-boot', 'https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css' );

    wp_enqueue_script("jQuery");

    wp_enqueue_script('boot-jq', 'https://code.jquery.com/jquery-3.3.1.slim.min.js');

    wp_enqueue_script('boot-popper', 'https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js');

    wp_enqueue_script('boot-js', 'https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js');

    wp_enqueue_script('main-js', get_template_directory_uri() . '/js/main.js');

    wp_enqueue_script('slick-js', get_template_directory_uri() . '/slick/slick/slick.min.js');

	wp_enqueue_script( 'tr_theme2-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );

	wp_enqueue_script( 'tr_theme2-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'tr_theme2_scripts' );

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

    $wp_customize->add_section('slider_text', array(
        'title' => __('Slider settings', 'kulyk_wordpress')
    ));

    $wp_customize->add_setting('slider_text', array(
        'default' => __('', 'kulyk_wordpress'),
        'transport' => 'refresh',
    ));

    $wp_customize->add_control(
        'slider_text', array(
        'label' => __('Enter slider text', 'kulyk_wordpress'),
        'section' => 'slider_text',
        'settings' => 'slider_text',
        'type' => 'text',
    ));

    // about

    $wp_customize->add_section('about_settings', array(
        'title' => __('About settings', 'kulyk_wordpress')
    ));

    $wp_customize->add_setting('about_heading', array(
        'default' => __('', 'kulyk_wordpress'),
        'transport' => 'refresh',
    ));

    $wp_customize->add_control(
        'about_heading', array(
        'label' => __('Enter Section heading text', 'kulyk_wordpress'),
        'section' => 'about_settings',
        'settings' => 'about_heading',
        'type' => 'text',
    ));

    $wp_customize->add_setting('about_head_text', array(
        'default' => __('', 'kulyk_wordpress'),
        'transport' => 'refresh',
    ));

    $wp_customize->add_control(
        'about_head_text', array(
        'label' => __('Enter Section head text', 'kulyk_wordpress'),
        'section' => 'about_settings',
        'settings' => 'about_head_text',
        'type' => 'text',
    ));

    $wp_customize->add_setting('about_main_text', array(
        'default' => __('', 'kulyk_wordpress'),
        'transport' => 'refresh',
    ));

    $wp_customize->add_control(
        'about_main_text', array(
        'label' => __('Enter Section main text', 'kulyk_wordpress'),
        'section' => 'about_settings',
        'settings' => 'about_main_text',
        'type' => 'text',
    ));

    // services

    $wp_customize->add_section('services_settings', array(
        'title' => __('Services settings', 'kulyk_wordpress')
    ));

    $wp_customize->add_setting('services_heading', array(
        'default' => __('', 'kulyk_wordpress'),
        'transport' => 'refresh',
    ));

    $wp_customize->add_control(
        'services_heading', array(
        'label' => __('Enter Section heading text', 'kulyk_wordpress'),
        'section' => 'services_settings',
        'settings' => 'services_heading',
        'type' => 'text',
    ));

    $wp_customize->add_setting('services_head_text', array(
        'default' => __('', 'kulyk_wordpress'),
        'transport' => 'refresh',
    ));

    $wp_customize->add_control(
        'services_head_text', array(
        'label' => __('Enter Section head text', 'kulyk_wordpress'),
        'section' => 'services_settings',
        'settings' => 'services_head_text',
        'type' => 'text',
    ));

    // design

    $wp_customize->add_section('design_settings', array(
        'title' => __('Design settings', 'kulyk_wordpress')
    ));

    $wp_customize->add_setting('design_heading', array(
        'default' => __('', 'kulyk_wordpress'),
        'transport' => 'refresh',
    ));

    $wp_customize->add_control(
        'design_heading', array(
        'label' => __('Enter design heading text', 'kulyk_wordpress'),
        'section' => 'design_settings',
        'settings' => 'design_heading',
        'type' => 'text',
    ));

    $wp_customize->add_setting('design_head_text', array(
        'default' => __('', 'kulyk_wordpress'),
        'transport' => 'refresh',
    ));

    $wp_customize->add_control(
        'design_head_text', array(
        'label' => __('Enter design head text', 'kulyk_wordpress'),
        'section' => 'design_settings',
        'settings' => 'design_head_text',
        'type' => 'text',
    ));

    $wp_customize->add_setting('design_tablet');

    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'design_tablet', array(
        'label' => __('Insert tablet design image', 'kulyk_wordpress'),
        'section' => 'design_settings',
        'settings' => 'design_tablet',
    )));

    $wp_customize->add_setting('design_mobile');

    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'design_mobile', array(
        'label' => __('Insert mobile design image', 'kulyk_wordpress'),
        'section' => 'design_settings',
        'settings' => 'design_mobile',
    )));

    $wp_customize->add_setting('design_background');

    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'design_background', array(
        'label' => __('Insert background design image', 'kulyk_wordpress'),
        'section' => 'design_settings',
        'settings' => 'design_background',
    )));

    // what we do

    $wp_customize->add_section('we_do_settings', array(
    'title' => __('We do settings', 'kulyk_wordpress')
));

    $wp_customize->add_setting('we_do_heading', array(
        'default' => __('', 'kulyk_wordpress'),
        'transport' => 'refresh',
    ));

    $wp_customize->add_control(
        'we_do_heading', array(
        'label' => __('Enter We do heading text', 'kulyk_wordpress'),
        'section' => 'we_do_settings',
        'settings' => 'we_do_heading',
        'type' => 'text',
    ));

    $wp_customize->add_setting('we_do_head_text', array(
        'default' => __('', 'kulyk_wordpress'),
        'transport' => 'refresh',
    ));

    $wp_customize->add_control(
        'we_do_head_text', array(
        'label' => __('Enter we do head text', 'kulyk_wordpress'),
        'section' => 'we_do_settings',
        'settings' => 'we_do_head_text',
        'type' => 'text',
    ));

    $wp_customize->add_setting('we_do_main_text', array(
        'default' => __('', 'kulyk_wordpress'),
        'transport' => 'refresh',
    ));

    $wp_customize->add_control(
        'we_do_main_text', array(
        'label' => __('Enter we do main text', 'kulyk_wordpress'),
        'section' => 'we_do_settings',
        'settings' => 'we_do_main_text',
        'type' => 'text',
    ));

    // members

    $wp_customize->add_section('members_settings', array(
        'title' => __('Members settings', 'kulyk_wordpress')
    ));

    $wp_customize->add_setting('members_heading', array(
        'default' => __('', 'kulyk_wordpress'),
        'transport' => 'refresh',
    ));

    $wp_customize->add_control(
        'members_heading', array(
        'label' => __('Enter members heading text', 'kulyk_wordpress'),
        'section' => 'members_settings',
        'settings' => 'members_heading',
        'type' => 'text',
    ));

    $wp_customize->add_setting('members_head_text', array(
        'default' => __('', 'kulyk_wordpress'),
        'transport' => 'refresh',
    ));

    $wp_customize->add_control(
        'members_head_text', array(
        'label' => __('Enter members head text', 'kulyk_wordpress'),
        'section' => 'members_settings',
        'settings' => 'members_head_text',
        'type' => 'text',
    ));

    $wp_customize->add_setting('members_main_text', array(
        'default' => __('', 'kulyk_wordpress'),
        'transport' => 'refresh',
    ));

    $wp_customize->add_control(
        'members_main_text', array(
        'label' => __('Enter members main text', 'kulyk_wordpress'),
        'section' => 'members_settings',
        'settings' => 'members_main_text',
        'type' => 'text',
    ));

    // blog

    $wp_customize->add_section('blog_settings', array(
        'title' => __('Blog settings', 'kulyk_wordpress')
    ));

    $wp_customize->add_setting('blog_heading', array(
        'default' => __('', 'kulyk_wordpress'),
        'transport' => 'refresh',
    ));

    $wp_customize->add_control(
        'blog_heading', array(
        'label' => __('Enter blog heading text', 'kulyk_wordpress'),
        'section' => 'blog_settings',
        'settings' => 'blog_heading',
        'type' => 'text',
    ));

    $wp_customize->add_setting('blog_head_text', array(
        'default' => __('', 'kulyk_wordpress'),
        'transport' => 'refresh',
    ));

    $wp_customize->add_control(
        'blog_head_text', array(
        'label' => __('Enter blog head text', 'kulyk_wordpress'),
        'section' => 'blog_settings',
        'settings' => 'blog_head_text',
        'type' => 'text',
    ));

    $wp_customize->add_setting('blog_main_text', array(
        'default' => __('', 'kulyk_wordpress'),
        'transport' => 'refresh',
    ));

    $wp_customize->add_control(
        'blog_main_text', array(
        'label' => __('Enter blog main text', 'kulyk_wordpress'),
        'section' => 'blog_settings',
        'settings' => 'blog_main_text',
        'type' => 'text',
    ));

    // testemonials heading

    $wp_customize->add_section('testemonials_settings', array(
        'title' => __('Testemonials settings', 'kulyk_wordpress')
    ));

    $wp_customize->add_setting('testemonials_heading', array(
        'default' => __('', 'kulyk_wordpress'),
        'transport' => 'refresh',
    ));

    $wp_customize->add_control(
        'testemonials_heading', array(
        'label' => __('Enter testemonials heading text', 'kulyk_wordpress'),
        'section' => 'testemonials_settings',
        'settings' => 'testemonials_heading',
        'type' => 'text',
    ));

    $wp_customize->add_setting('testemonials_head_text', array(
        'default' => __('', 'kulyk_wordpress'),
        'transport' => 'refresh',
    ));

    $wp_customize->add_control(
        'testemonials_head_text', array(
        'label' => __('Enter testemonials head text', 'kulyk_wordpress'),
        'section' => 'testemonials_settings',
        'settings' => 'testemonials_head_text',
        'type' => 'text',
    ));

    $wp_customize->add_setting('testemonials_background');

    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'testemonials_background', array(
        'label' => __('Insert background design image', 'kulyk_wordpress'),
        'section' => 'testemonials_settings',
        'settings' => 'testemonials_background',
    )));

    // footer settings

    $wp_customize->add_section('footer_settings', array(
        'title' => __('Footer settings', 'kulyk_wordpress')
    ));

    $wp_customize->add_setting('footer_logo');

    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'footer_logo', array(
        'label' => __('Insert background design image', 'kulyk_wordpress'),
        'section' => 'footer_settings',
        'settings' => 'footer_logo',
    )));

}

add_action('customize_register', 'kulyk_wordpress_customize_register');

add_action( 'init', 'create_slider_posts' );

function create_slider_posts() {
    register_post_type( 'slider_post',
        array(
            'labels' => array(
                'name' => 'Slider Posts',
                'singular_name' => 'Slider Post',
                'add_new' => 'Add New',
                'add_new_item' => 'Add New Slider Post',
                'edit' => 'Edit',
                'edit_item' => 'Edit Image',
                'new_item' => 'New Slider Post',
                'view' => 'View',
                'view_item' => 'View Slider Post',
                'search_items' => 'Search Slider Post',
                'not_found' => 'No Slider Posts found',
                'not_found_in_trash' => 'No Slider Posts found in Trash',
                'parent' => 'Parent Slider Post'
            ),

            'public' => true,
            'menu_position' => 15,
            'supports' => array( 'title', 'editor', 'thumbnail', 'custom-fields' ),
            'has_archive' => true
        )
    );
}

add_action( 'add_meta_boxes', 'my_admin' );

function my_admin() {
    add_meta_box( 'slider_post_meta_box',
        'Slider post Details',
        'display_slider_post_meta_box',
        'slides',
        'normal',
        'high'
    );
}

add_action( 'init', 'create_about_us_posts' );

function create_about_us_posts() {
    register_post_type( 'about_post',
        array(
            'labels' => array(
                'name' => 'About Posts',
                'singular_name' => 'About Post',
                'add_new' => 'Add New',
                'add_new_item' => 'Add New About Us Post',
                'edit' => 'Edit',
                'edit_item' => 'Edit Image',
                'new_item' => 'New About Us Post',
                'view' => 'View',
                'view_item' => 'View About Post',
                'search_items' => 'Search About Us Post',
                'not_found' => 'No About Us Posts found',
                'not_found_in_trash' => 'No About Us Posts found in Trash',
                'parent' => 'Parent About Us Post'
            ),

            'public' => true,
            'menu_position' => 15,
            'supports' => array( 'title', 'editor', 'thumbnail', 'custom-fields' ),
            'has_archive' => true
        )
    );
}

add_action( 'init', 'create_achievement_posts' );

function create_achievement_posts() {
    register_post_type( 'achievement_post',
        array(
            'labels' => array(
                'name' => 'Achievement Posts',
                'singular_name' => 'Achievement Post',
                'add_new' => 'Add New',
                'add_new_item' => 'Add New Achievement Post',
                'edit' => 'Edit',
                'edit_item' => 'Edit Image',
                'new_item' => 'New Achievement Post',
                'view' => 'View',
                'view_item' => 'View Achievement Post',
                'search_items' => 'Search Achievement Post',
                'not_found' => 'No Achievement Posts found',
                'not_found_in_trash' => 'No Achievement Posts found in Trash',
                'parent' => 'Parent Achievement Post'
            ),

            'public' => true,
            'menu_position' => 15,
            'supports' => array( 'title', 'editor', 'thumbnail', 'custom-fields' ),
            'has_archive' => true
        )
    );
}

add_action( 'init', 'create_service_posts' );

function create_service_posts() {
    register_post_type( 'service_post',
        array(
            'labels' => array(
                'name' => 'Services Posts',
                'singular_name' => 'Service Post',
                'add_new' => 'Add New',
                'add_new_item' => 'Add New Service Post',
                'edit' => 'Edit',
                'edit_item' => 'Edit Service',
                'new_item' => 'New Service Post',
                'view' => 'View',
                'view_item' => 'View Service Post',
                'search_items' => 'Search Services Posts',
                'not_found' => 'No Services Posts found',
                'not_found_in_trash' => 'No Services Posts found in Trash',
                'parent' => 'Parent Service Post'
            ),

            'public' => true,
            'menu_position' => 15,
            'supports' => array( 'title', 'editor', 'thumbnail', 'custom-fields' ),
            'has_archive' => true
        )
    );
}

add_action( 'init', 'create_we_do_posts' );

function create_we_do_posts() {
    register_post_type( 'we_do_post',
        array(
            'labels' => array(
                'name' => 'We do Posts',
                'singular_name' => 'We do Post',
                'add_new' => 'Add New',
                'add_new_item' => 'Add New We do Post',
                'edit' => 'Edit',
                'edit_item' => 'Edit We do',
                'new_item' => 'New We do Post',
                'view' => 'View',
                'view_item' => 'View We do Post',
                'search_items' => 'Search We do Posts',
                'not_found' => 'No We do Posts found',
                'not_found_in_trash' => 'No We do Posts found in Trash',
                'parent' => 'Parent We do Post'
            ),

            'public' => true,
            'menu_position' => 15,
            'supports' => array( 'title', 'editor', 'thumbnail', 'custom-fields' ),
            'has_archive' => true
        )
    );
}

add_action( 'init', 'create_testemonial_posts' );

function create_testemonial_posts() {
    register_post_type( 'testemonial_post',
        array(
            'labels' => array(
                'name' => 'Testemonials',
                'singular_name' => 'Testemonial Post',
                'add_new' => 'Add New',
                'add_new_item' => 'Add New Testemonial Post',
                'edit' => 'Edit',
                'edit_item' => 'Edit testemonial',
                'new_item' => 'New Testemonial Post',
                'view' => 'View',
                'view_item' => 'View Testemonial Post',
                'search_items' => 'Search testemonials',
                'not_found' => 'No We testemonials found',
                'not_found_in_trash' => 'No testemonials found in Trash',
                'parent' => 'Parent Testemonial Post'
            ),

            'public' => true,
            'menu_position' => 15,
            'supports' => array( 'title', 'editor', 'thumbnail', 'custom-fields' ),
            'has_archive' => true
        )
    );
}

add_action( 'init', 'create_our_team_post' );

function create_our_team_post() {
    register_post_type( 'our_team_post',
        array(
            'labels' => array(
                'name' => 'Team',
                'singular_name' => 'Teammate',
                'add_new' => 'Add New',
                'add_new_item' => 'Add New Teammate Post',
                'edit' => 'Edit',
                'edit_item' => 'Edit Teammate',
                'new_item' => 'New Teammate',
                'view' => 'View',
                'view_item' => 'View Teammate Post',
                'search_items' => 'Search teammates',
                'not_found' => 'No teammates found',
                'not_found_in_trash' => 'No teammates found in Trash',
                'parent' => 'Parent teammate Post'
            ),
            'public' => true,
            'menu_position' => 15,
            'supports' => array( 'title', 'editor', 'thumbnail', 'custom-fields' ),
            'has_archive' => true
        )
    );
}

add_action( 'init', 'create_works_post' );

function create_works_post() {
    register_post_type( 'works_post',
        array(
            'labels' => array(
                'name' => 'Works',
                'singular_name' => 'Work',
                'add_new' => 'Add New',
                'add_new_item' => 'Add New Work Post',
                'edit' => 'Edit',
                'edit_item' => 'Edit Work',
                'new_item' => 'New Work',
                'view' => 'View',
                'view_item' => 'View Work Post',
                'search_items' => 'Search works',
                'not_found' => 'No works found',
                'not_found_in_trash' => 'No works found in Trash',
                'parent' => 'Parent work Post'
            ),
            'public' => true,
            'menu_position' => 15,
            'supports' => array( 'title', 'editor', 'thumbnail', 'custom-fields' ),
            'has_archive' => true
        )
    );
}

function register_my_widgets(){
    register_sidebar( array(
        'name' => "Footer 1-st column sidebar",
        'id' => 'first-column-sidebar',
        'description' => '1 column sidebar',
        'before_title' => '<h4>',
        'after_title' => '</h4>'
    ) );
    register_sidebar( array(
        'name' => "Footer 2-st column sidebar",
        'id' => 'second-column-sidebar',
        'description' => '2 column sidebar',
        'before_title' => '<h4>',
        'after_title' => '</h4>'
    ) );
    register_sidebar( array(
        'name' => "Footer 3-st column sidebar",
        'id' => 'third-column-sidebar',
        'description' => '3 column sidebar',
        'before_title' => '<h4>',
        'after_title' => '</h4>'
    ) );
}
add_action( 'widgets_init', 'register_my_widgets' );

class truePostsWidget extends WP_Widget {

    /*
     * создание виджета
     */
    function __construct() {
        parent::__construct(
            'true_widget',
            'Custom recent posts', // заголовок виджета
            array( 'description' => 'Output recent posts' ) // описание
        );
    }

    /*
     * фронтэнд виджета
     */
    public function widget( $args, $instance ) {
        $title = apply_filters( 'widget_title', $instance['title'] ); // к заголовку применяем фильтр (необязательно)
        $posts_per_page = $instance['posts_per_page'];

        echo $args['before_widget'];

        if ( ! empty( $title ) )
            echo $args['before_title'] . $title . $args['after_title'];

        $q = new WP_Query("posts_per_page=$posts_per_page&orderby=date");
        if( $q->have_posts() ):
            ?><ul class="recent-posts-list"><?php
            while( $q->have_posts() ): $q->the_post();
                ?>
                <li class="recent-post-area d-flex justify-content-start align-items-start">
                    <div class="widget-post-img">
                        <?php the_post_thumbnail(); ?>
                    </div>
                    <div class="widget-post-content">
                        <a class="widget-post-head" href="<?php the_permalink() ?>"><?php the_title() ?></a>
                        <div><?php the_time('j M Y'); ?></div>
                    </div>
                </li>
            <?php
            endwhile;
            ?></ul><?php
        endif;
        wp_reset_postdata();

        echo $args['after_widget'];
    }

    /*
     * бэкэнд виджета
     */
    public function form( $instance ) {
        if ( isset( $instance[ 'title' ] ) ) {
            $title = $instance[ 'title' ];
        }
        if ( isset( $instance[ 'posts_per_page' ] ) ) {
            $posts_per_page = $instance[ 'posts_per_page' ];
        }
        ?>
        <p>
            <label for="<?php echo $this->get_field_id( 'title' ); ?>">Header</label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id( 'posts_per_page' ); ?>">Amount of posts:</label>
            <input id="<?php echo $this->get_field_id( 'posts_per_page' ); ?>" name="<?php echo $this->get_field_name( 'posts_per_page' ); ?>" type="text" value="<?php echo ($posts_per_page) ? esc_attr( $posts_per_page ) : '4'; ?>" size="3" />
        </p>
        <?php
    }

    /*
     * сохранение настроек виджета
     */
    public function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
        $instance['posts_per_page'] = ( is_numeric( $new_instance['posts_per_page'] ) ) ? $new_instance['posts_per_page'] : '4'; // по умолчанию выводятся 5 постов
        return $instance;
    }
}

/*
 * регистрация виджета
 */
function true_top_posts_widget_load() {
    register_widget( 'truePostsWidget' );
}
add_action( 'widgets_init', 'true_top_posts_widget_load' );

function do_excerpt($string, $word_limit) {
    $words = explode(' ', $string, ($word_limit + 1));
    if (count($words) > $word_limit)
        array_pop($words);
    echo implode(' ', $words).'';
}