<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package tr_theme
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">

    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
    <header id="masthead" class="site-header"
            style="background-image: url('<?php echo get_theme_mod("header_background") ?>'); background-size: cover; ">
        <div class="container">
                <nav id="site-navigation" class="main-navigation">
                    <div class="navigation-container">
                        <div class="logo-container"><?php the_custom_logo(); ?></div>
                        <div>
                            <input type="checkbox" class="burger" id="burger" name="burger">
                            <label for="burger" class="burger-label"><i class="fas fa-bars"></i></label>
                            <?php
                            wp_nav_menu(array(
                                'theme_location' => 'menu-1',
                                'menu_class' => 'primary-menu'
                            ));
                            ?>
                        </div>
                    </div>
                </nav><!-- #site-navigation -->
            <div class="header-text">
                <h1 class="header-heading"><?php echo get_theme_mod('header_text') ?></h1>
                <p class="header-subheading"><?php echo get_theme_mod('subheader_text') ?></p>
                <div class="button-container">
                <a class="main-button" href="<?php echo get_theme_mod('link_url') ?>"><?php echo get_theme_mod('link_text') ?></a>
                </div>
            </div>
        </div>
    </header><!-- #masthead -->

    <div id="content" class="site-content">
