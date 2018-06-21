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

    wp_enqueue_script("jquery");

    wp_enqueue_script('main-js', get_template_directory_uri() . '/js/main.js');

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

    // features section

    $wp_customize->add_section('features_settings', array(
        'title' => __('Features settings', 'kulyk_wordpress')
    ));

    $wp_customize->add_setting('features_text', array(
        'default' => __('', 'kulyk_wordpress'),
        'transport' => 'refresh',
    ));

    $wp_customize->add_control(
        'features_text', array(
        'label' => __('Enter features text', 'kulyk_wordpress'),
        'section' => 'features_settings',
        'settings' => 'features_text',
        'type' => 'textarea',
    ));

    // Works section

    $wp_customize->add_section('works_settings', array(
        'title' => __('Works section settings', 'kulyk_wordpress')
    ));

    $wp_customize->add_setting('works_heading', array(
        'default' => __('', 'kulyk_wordpress'),
        'transport' => 'refresh',
    ));

    $wp_customize->add_control(
        'works_heading', array(
        'label' => __('Enter features head text', 'kulyk_wordpress'),
        'section' => 'works_settings',
        'settings' => 'works_heading',
        'type' => 'text',
    ));

    $wp_customize->add_setting('works_text', array(
        'default' => __('', 'kulyk_wordpress'),
        'transport' => 'refresh',
    ));

    $wp_customize->add_control(
        'works_text', array(
        'label' => __('Enter works text', 'kulyk_wordpress'),
        'section' => 'works_settings',
        'settings' => 'works_text',
        'type' => 'text',
    ));

    // reviews

    $wp_customize->add_section('reviews_settings', array(
        'title' => __('Reviews section settings', 'kulyk_wordpress')
    ));

    $wp_customize->add_setting('reviews_heading', array(
        'default' => __('', 'kulyk_wordpress'),
        'transport' => 'refresh',
    ));

    $wp_customize->add_control(
        'reviews_heading', array(
        'label' => __('Enter reviews head text', 'kulyk_wordpress'),
        'section' => 'reviews_settings',
        'settings' => 'reviews_heading',
        'type' => 'text',
    ));

    $wp_customize->add_setting('review_img');

    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'secondary_header_img', array(
        'label' => __('Insert background image', 'kulyk_wordpress'),
        'section' => 'reviews_settings',
        'settings' => 'review_img',
    )));

    // prices section

    $wp_customize->add_section('prices_settings', array(
        'title' => __('Prices section settings', 'kulyk_wordpress')
    ));

    $wp_customize->add_setting('prices_heading', array(
        'default' => __('', 'kulyk_wordpress'),
        'transport' => 'refresh',
    ));

    $wp_customize->add_control(
        'prices_heading', array(
        'label' => __('Enter features head text', 'kulyk_wordpress'),
        'section' => 'prices_settings',
        'settings' => 'prices_heading',
        'type' => 'text',
    ));

    $wp_customize->add_setting('prices_text', array(
        'default' => __('', 'kulyk_wordpress'),
        'transport' => 'refresh',
    ));

    $wp_customize->add_control(
        'prices_text', array(
        'label' => __('Enter prices text', 'kulyk_wordpress'),
        'section' => 'prices_settings',
        'settings' => 'prices_text',
        'type' => 'text',
    ));

    // faq section

    $wp_customize->add_section('faq_settings', array(
        'title' => __('FAQ section settings', 'kulyk_wordpress')
    ));

    $wp_customize->add_setting('faq_heading', array(
        'default' => __('', 'kulyk_wordpress'),
        'transport' => 'refresh',
    ));

    $wp_customize->add_control(
        'faq_heading', array(
        'label' => __('Enter faq head text', 'kulyk_wordpress'),
        'section' => 'faq_settings',
        'settings' => 'faq_heading',
        'type' => 'text',
    ));

    $wp_customize->add_setting('faq_text', array(
        'default' => __('', 'kulyk_wordpress'),
        'transport' => 'refresh',
    ));

    $wp_customize->add_control(
        'faq_text', array(
        'label' => __('Enter prices text', 'kulyk_wordpress'),
        'section' => 'faq_settings',
        'settings' => 'faq_text',
        'type' => 'text',
    ));

    // blog section

    $wp_customize->add_section('blog_settings', array(
        'title' => __('Blog section settings', 'kulyk_wordpress')
    ));

    $wp_customize->add_setting('blog_heading', array(
        'default' => __('', 'kulyk_wordpress'),
        'transport' => 'refresh',
    ));

    $wp_customize->add_control(
        'blog_heading', array(
        'label' => __('Enter blog head text', 'kulyk_wordpress'),
        'section' => 'blog_settings',
        'settings' => 'blog_heading',
        'type' => 'text',
    ));

    $wp_customize->add_setting('blog_text', array(
        'default' => __('', 'kulyk_wordpress'),
        'transport' => 'refresh',
    ));

    $wp_customize->add_control(
        'faq_text', array(
        'label' => __('Enter blog text', 'kulyk_wordpress'),
        'section' => 'blog_settings',
        'settings' => 'blog_text',
        'type' => 'text',
    ));

    $wp_customize->add_setting('blog_link_text', array(
        'default' => __('Read more', 'kulyk_wordpress'),
        'transport' => 'refresh',
    ));

    $wp_customize->add_control(
        'blog_link_text', array(
        'label' => __('Enter link text', 'kulyk_wordpress'),
        'section' => 'blog_settings',
        'settings' => 'blog_link_text',
        'type' => 'text',
    ));

    $wp_customize->add_setting('blog_read_button', array(
        'default' => __('', 'kulyk_wordpress'),
        'transport' => 'refresh',
    ));

    $wp_customize->add_control(
        'blog_read_button', array(
        'label' => __('Enter blog read more button text', 'kulyk_wordpress'),
        'section' => 'blog_settings',
        'settings' => 'blog_read_button',
        'type' => 'text',
    ));

    $wp_customize->add_setting('blog_link_url', array(
        'default' => __('#', 'kulyk_wordpress'),
        'transport' => 'refresh',
    ));

    $wp_customize->add_control(
        'blog_link_url', array(
        'label' => __('Enter link url', 'kulyk_wordpress'),
        'section' => 'blog_settings',
        'settings' => 'blog_link_url',
        'type' => 'text',
    ));

    //footer

    $wp_customize->add_section('footer_settings', array(
        'title' => __('Footer settings', 'kulyk_wordpress')
    ));

    $wp_customize->add_setting('footer_logo');

    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'footer_logo', array(
        'label' => __('Insert logo for footer', 'kulyk_wordpress'),
        'section' => 'footer_settings',
        'settings' => 'footer_logo',
    )));
    $wp_customize->add_setting('footer_info_text', array(
        'default' => __('#', 'kulyk_wordpress'),
        'transport' => 'refresh',
    ));

    $wp_customize->add_control(
        'footer_info_text', array(
        'label' => __('Enter footer info', 'kulyk_wordpress'),
        'section' => 'footer_settings',
        'settings' => 'footer_info_text',
        'type' => 'textarea',
    ));

    $wp_customize->add_setting('footer_phone_head', array(
        'default' => __('#', 'kulyk_wordpress'),
        'transport' => 'refresh',
    ));

    $wp_customize->add_control(
        'footer_phone_head', array(
        'label' => __('Enter footer info', 'kulyk_wordpress'),
        'section' => 'footer_settings',
        'settings' => 'footer_phone_head',
        'type' => 'text',
    ));
    $wp_customize->add_setting('footer_phone_mobile', array(
        'default' => __('#', 'kulyk_wordpress'),
        'transport' => 'refresh',
    ));

    $wp_customize->add_control(
        'footer_phone_mobile', array(
        'label' => __('Enter footer mobile phone', 'kulyk_wordpress'),
        'section' => 'footer_settings',
        'settings' => 'footer_phone_mobile',
        'type' => 'text',
    ));
    $wp_customize->add_setting('footer_phone_work', array(
        'default' => __('#', 'kulyk_wordpress'),
        'transport' => 'refresh',
    ));

    $wp_customize->add_control(
        'footer_phone_work', array(
        'label' => __('Enter footer work phone', 'kulyk_wordpress'),
        'section' => 'footer_settings',
        'settings' => 'footer_phone_work',
        'type' => 'text',
    ));

    $wp_customize->add_setting('footer_address_head', array(
        'default' => __('#', 'kulyk_wordpress'),
        'transport' => 'refresh',
    ));

    $wp_customize->add_control(
        'footer_address_head', array(
        'label' => __('Enter footer address head', 'kulyk_wordpress'),
        'section' => 'footer_settings',
        'settings' => 'footer_address_head',
        'type' => 'text',
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
        'type' => 'textarea',
    ));


    $wp_customize->add_setting('footer_address_link_text', array(
        'default' => __('#', 'kulyk_wordpress'),
        'transport' => 'refresh',
    ));

    $wp_customize->add_control(
        'footer_address_link_text', array(
        'label' => __('Enter footer address map text', 'kulyk_wordpress'),
        'section' => 'footer_settings',
        'settings' => 'footer_address_link_text',
        'type' => 'text',
    ));
    $wp_customize->add_setting('footer_address_link_url', array(
        'default' => __('#', 'kulyk_wordpress'),
        'transport' => 'refresh',
    ));

    $wp_customize->add_control(
        'footer_address_link_url', array(
        'label' => __('Enter footer address map url', 'kulyk_wordpress'),
        'section' => 'footer_settings',
        'settings' => 'footer_address_link_url',
        'type' => 'text',
    ));

    $wp_customize->add_setting('footer_copyright', array(
        'default' => __('#', 'kulyk_wordpress'),
        'transport' => 'refresh',
    ));

    $wp_customize->add_control(
        'footer_copyright', array(
        'label' => __('Enter footer copyright', 'kulyk_wordpress'),
        'section' => 'footer_settings',
        'settings' => 'footer_copyright',
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






























