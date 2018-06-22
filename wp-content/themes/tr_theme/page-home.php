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
            <section class="works">
                    <ul class="works-list">
                        <?php
                        $loop = new WP_Query(array(
                            'post_type' => 'post',
                            'posts_per_page' => '8'
                        ));
                        while ($loop->have_posts()) : $loop->the_post(); ?>
                            <li class="work-item">
                                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                                    <div class="work-img">
                                        <?php the_post_thumbnail() ?>
                                        <div class="absolute-text">
                                            <a href="<?php the_permalink() ?>" class="text-container">
                                                <div class="center-text">
                                                    <h3 class="work-head"><?php the_title(); ?></h3>
                                                    <span class="work-subtext"><?php the_excerpt(); ?></span>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </article>
                            </li>
                        <?php endwhile; // End of the loop.

                        wp_reset_postdata();

                        ?>
                    </ul>
            </section>
            <section class="team">
                <div class="container">
                    <ul class="members-list">
                        <?php
                        $loop = new WP_Query(array(
                            'post_type' => 'team_members',
                            'posts_per_page' => '4'
                        ));
                        while ($loop->have_posts()) : $loop->the_post(); ?>
                            <li class="member-item">

                                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                                    <div class="member-img">
                                        <?php the_post_thumbnail() ?>
                                    </div>
                                    <div class="member-title">
                                        <h4><?php the_title(); ?></h4>
                                        <p class="member-position"><?php the_field('position'); ?></p>
                                    </div>
                                    <div class="member-entry-content">
                                        <span><?php the_content(); ?></span>
                                    </div>
                                    <ul  class="member-social-list">
                                        <li class="member-social-item">
                                            <a class="member-social-link" href="<?php the_field('facebook_link') ?>"><?php the_field('facebook_icon') ?></a>
                                        </li>
                                        <li>
                                            <a class="member-social-link" href="<?php the_field('twitter_link') ?>"><?php the_field('twitter_link_icon') ?></a>
                                        </li>
                                        <li>
                                            <a class="member-social-link" href="<?php the_field('linkedin_link') ?>"><?php the_field('linkedin_link_icon') ?></a>
                                        </li>
                                    </ul>
                                </article><!-- #post-<?php the_ID(); ?> -->

                            </li>
                        <?php endwhile; // End of the loop.

                        wp_reset_postdata();

                        ?>
                    </ul>
                </div>
            </section>
            <section class="testemonials">
                <div class="testemonial-slider">
                    <?php
                    $loop = new WP_Query(array(
                        'post_type' => 'testemonial',
                        'posts_per_page' => '5'
                    ));
                    while ($loop->have_posts()) : $loop->the_post(); ?>
                        <div>
                            <ul class="testemonial-list">
                                <li><?php the_post_thumbnail() ?></li>
                                <li>
                                    <div>
                                        <blockquote><?php the_content(); ?></blockquote>
                                        <p class="span-text"><?php the_title(); ?></p>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    <?php endwhile; // End of the loop.
                    wp_reset_postdata();
                    ?>
                </div>
            </section>
            <section class="download-section">
                <div class="container">
                    <div class="download-container">
                        <h3><?php echo get_theme_mod('download_head_text'); ?></h3>
                        <p><?php echo get_theme_mod('download_subhead_text'); ?></p>
                        <div class="button-container">
                        <a class="main-button" href="<?php echo get_theme_mod('download_link_url'); ?>"><?php echo get_theme_mod('download_link_text'); ?></a>
                        </div>
                    </div>
                </div>
            </section>
        </main><!-- #main -->
    </div><!-- #primary -->

<?php
get_footer();
