<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package tr_theme
 */

get_header();
?>

    <div id="primary" class="content-area">
        <main id="main" class="site-main">
            <section class="features">
                <div class="container">
                    <ul class="features-list">
                        <?php
                        $loop = new WP_Query(array(
                            'post_type' => 'movie_reviews',
                            'posts_per_page' => '6'
                        ));
                        while ($loop->have_posts()) : $loop->the_post(); ?>
                            <li class="feature-item">

                                <?php get_template_part('template-parts/content', 'home-feature');?>

                            </li>
                        <?php endwhile; // End of the loop.

                        wp_reset_postdata();

                        ?>
                    </ul>
                </div>
            </section>
            <section class="features">
                    <ul class="features-list">
                        <?php
                        $loop = new WP_Query(array(
                            'post_type' => 'post',
                            'posts_per_page' => '8'
                        ));
                        while ($loop->have_posts()) : $loop->the_post(); ?>
                            <li class="feature-item">
                                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                                    <div class="feature-img">
                                        <?php the_post_thumbnail() ?>
                                    </div>
                                    <div class="feature-title">
                                        <h3><?php the_title(); ?></h3>
                                    </div>
                                    <div class="feature-entry-content">
                                        <p><?php the_excerpt(); ?></p>
                                    </div>
                                </article>
                            </li>
                        <?php endwhile; // End of the loop.

                        wp_reset_postdata();

                        ?>
                    </ul>
            </section>

        </main><!-- #main -->
    </div><!-- #primary -->

<?php
get_sidebar();
get_footer();
