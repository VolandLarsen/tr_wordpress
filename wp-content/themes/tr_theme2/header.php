<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package tr_theme2
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="profile" href="https://gmpg.org/xfn/11">

    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
    <header id="masthead" class="site-header">
        <div class="site-branding">
            <div class="slider-banner">
                <nav id="site-navigation" class="navbar navbar-expand-lg header-navigation">
                    <div class="container">
                        <div class="mr-auto col">
                            <h1><?php the_custom_logo(); ?></h1>
                        </div>
                        <button class="navbar-toggler ml-auto mobile-button" type="button" data-toggle="collapse"
                                data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                                aria-expanded="false" aria-label="Toggle navigation">
                            <i class="fas fa-bars"></i>
                        </button>
                        <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
                            <?php
                            wp_nav_menu(array(
                                'theme_location' => 'menu-1',
                                'menu_class' => 'navbar-nav mr-auto',
                            ));
                            ?>
                            <div class="shop"><i class="fas fa-shopping-cart"></i></div>

                            <div class="search" hidden="hidden"><?php get_search_form(); ?></div>
                        </div>
                    </div>
                </nav><!-- #site-navigation -->
                <div class="banner-slider">
                    <?php
                    $loop = new WP_Query(array(
                        'post_type' => 'slider_post',
                        'posts_per_page' => '4'
                    ));
                    while ($loop->have_posts()) : $loop->the_post(); ?>
                            <div>
                                <div class="banner-container" style="background-image: url('<?php the_post_thumbnail_url() ?>'); background-size: cover">
                                    <div class="banner-background-overlay">
                                        <div class="container">
                                            <p><?php echo get_theme_mod('slider_text'); ?></p>
                                            <h2><?php the_content(); ?></h2>
                                        </div>
                                        <div class="link-container">
                                            <a class="header-link" href="<?php the_field('link_url'); ?>"><?php the_field('link_text'); ?></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    <?php endwhile; // End of the loop.
                    wp_reset_postdata();
                    ?>
                </div>
                <div class="slider-overlay"></div>
            </div>
        </div>
    </header><!-- #masthead -->

    <div id="content" class="site-content">
