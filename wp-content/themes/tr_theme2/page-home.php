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
 * @package tr_theme2
 */

get_header();
?>

    <div id="primary" class="content-area">
        <main id="main" class="site-main">
            <section class="about">
                <div class="container">
                    <p class="section-text"><?php echo get_theme_mod('about_head_text'); ?></p>
                    <h2 class="section-heading"><?php echo get_theme_mod('about_heading'); ?></h2>
                    <p class="main-text"><?php echo get_theme_mod('about_main_text'); ?></p>
                    <div class="about-list d-flex .flex-row">
                        <?php
                        $loop = new WP_Query(array(
                            'post_type' => 'about_post',
                            'posts_per_page' => '3'
                        ));
                        while ($loop->have_posts()) : $loop->the_post(); ?>
                            <div class="about-item col-4">
                                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                                    <div class="about-img">
                                        <?php the_post_thumbnail() ?>
                                        <div class="absolute-text">
                                            <a href="<?php the_permalink() ?>" class="text-container">
                                                <div class="center-text">
                                                    <?php the_field('icon_field') ?>
                                                    <p><?php echo the_title(); ?></p>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </article>
                            </div>
                        <?php endwhile; // End of the loop.
                        wp_reset_postdata();
                        ?>
                    </div>
                </div>
            </section>
            <section class="achievements">
                <div class="container">
                    <div class="achievements-list d-flex .flex-row">
                        <?php
                        $loop = new WP_Query(array(
                            'post_type' => 'achievement_post',
                            'posts_per_page' => '5'
                        ));
                        while ($loop->have_posts()) : $loop->the_post(); ?>

                            <div class="achievements-item col">
                                <span class="achievement-content"><?php the_content(); ?></span>
                                <p class="achievement-title"><?php the_title(); ?></p>
                            </div>

                        <?php endwhile; // End of the loop.

                        wp_reset_postdata();

                        ?>
                    </div>
                </div>
            </section>
            <section class="services">
                <div class="container">
                    <p class="section-text"><?php echo get_theme_mod('services_head_text'); ?></p>
                    <h2 class="section-heading"><?php echo get_theme_mod('services_heading'); ?></h2>
                    <div class="service-list d-flex .flex-row flex-wrap">
                        <?php
                        $loop = new WP_Query(array(
                            'post_type' => 'service_post',
                            'posts_per_page' => '6'
                        ));
                        while ($loop->have_posts()) : $loop->the_post(); ?>
                            <div class="service-item col-4 d-flex .flex-row">
                                <div class="icon"><?php the_post_thumbnail() ?></div>
                                <div class="service-text">
                                    <span><?php the_title(); ?></span>
                                    <?php the_content(); ?>
                                </div>
                            </div>
                        <?php endwhile; // End of the loop.

                        wp_reset_postdata();

                        ?>
                    </div>
                </div>
            </section>
            <section class="design"
                     style="background-image: url('<?php echo get_theme_mod("design_background"); ?>'); background-size: cover;">
                <div class="container">
                    <div class="design-container">
                        <p class="section-text"><?php echo get_theme_mod('design_head_text'); ?></p>
                        <h2 class="section-heading"><?php echo get_theme_mod('design_heading'); ?></h2>
                    </div>
                    <div class="image-design-container">
                        <img class="tablet rounded mx-auto d-block sticky-bottom"
                             src="<?php echo get_theme_mod('design_tablet') ?>">
                        <img class="mobile" src="<?php echo get_theme_mod('design_mobile') ?>">
                    </div>
                </div>
            </section>
            <section class="about">
                <div class="container">
                    <p class="section-text"><?php echo get_theme_mod('we_do_head_text'); ?></p>
                    <h2 class="section-heading"><?php echo get_theme_mod('we_do_heading'); ?></h2>
                    <p class="main-text"><?php echo get_theme_mod('we_do_main_text'); ?></p>

                    <div id="tab" class="d-flex flex-row">
                        <div class="tab-content col">
                            <?php
                            $counter = 0;
                            $loop = new WP_Query(array('post_type' => 'we_do_post', 'posts_per_page' => 3));
                            while ($loop->have_posts()) : $loop->the_post();
                                $counter++;
                                ?>
                                <div role="tabpanel" class="tab-pane <?= ($counter == 1) ? 'active' : '' ?>"
                                     id="post-<?php the_ID(); ?>"><?php the_post_thumbnail(); ?>

                                </div>
                            <?php endwhile;

                            wp_reset_query();

                            ?>
                        </div>
                        <ul class="nav nav-tabs flex-column col" role="tablist">
                            <?php $loop = new WP_Query(array('post_type' => 'we_do_post', 'posts_per_page' => 3)); ?>
                            <?php
                            $counter = 0;
                            while ($loop->have_posts()) : $loop->the_post();
                                $counter++;
                                ?>
                                <li role="presentation"
                                    class="show-text post-<?php the_ID(); ?> <?= ($counter == 1) ? 'active' : '' ?>">
                                    <a class="tab-link" href="#post-<?php the_ID(); ?>" aria-controls="home" role="tab"
                                       data-toggle="tab">
                                        <?php the_title(); ?>
                                    </a>
                                    <div class="tab-content">
                                        <div role="tabpanel" class="tab-pane <?= ($counter == 1) ? 'active' : '' ?>"
                                             id="post-<?php the_ID(); ?>">
                                            <div class="ex"><?php the_content() ?></div>
                                        </div>
                                    </div>
                                </li>
                            <?php endwhile;
                            wp_reset_query(); ?>
                        </ul>
                    </div>
                </div>
            </section>
            <section class="testemonials">
                <div class="container">
                    <div class="testemonials-slider">
                        <?php
                        $loop = new WP_Query(array(
                            'post_type' => 'testemonial_post',
                            'posts_per_page' => '6'
                        ));
                        while ($loop->have_posts()) : $loop->the_post(); ?>
                            <div class="d-flex flex-row justify-content-center align-items-center">
                                <div class="col-2">
                                    <div class="testemonial-icon">
                                        <div>
                                            <?php the_post_thumbnail(); ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="testemonial-text col-7">
                                    <?php the_content(); ?>
                                    <span class="testemonial-head"><?php the_title(); ?></span>
                                </div>
                            </div>
                        <?php endwhile; // End of the loop.

                        wp_reset_postdata();

                        ?>
                    </div>
                </div>
            </section>

            <section class="members">
                <div class="container">
                    <p class="section-text"><?php echo get_theme_mod('members_head_text'); ?></p>
                    <h2 class="section-heading"><?php echo get_theme_mod('members_heading'); ?></h2>
                    <p class="main-text"><?php echo get_theme_mod('members_main_text'); ?></p>
                    <div class="service-list d-flex .flex-row flex-wrap">
                        <?php
                        $loop = new WP_Query(array(
                            'post_type' => 'our_team_post',
                            'posts_per_page' => '3'
                        ));
                        while ($loop->have_posts()) : $loop->the_post(); ?>
                            <div class="about-item col-4">
                                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                                    <div class="about-img">
                                        <?php the_post_thumbnail() ?>
                                        <div class="absolute-text">
                                            <div class="text-container">
                                                <div class="center-text">
                                                    <div class="d-flex flex-row justify-content-center align-items-center">
                                                        <a class="social-member-link" href="<?php the_field('facebook_link') ?>"><?php the_field('facebook_icon') ?></a>
                                                        <a class="social-member-link" href="<?php the_field('twitter_link') ?>"><?php the_field('twitter_icon') ?></a>
                                                        <a class="social-member-link" href="<?php the_field('pinterest_link') ?>"><?php the_field('pinterest_icon') ?></a>
                                                        <a class="social-member-link" href="<?php the_field('instagram_link') ?>"><?php the_field('instagram_icon') ?></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </article>
                                <div class="member-text-container">
                                    <p class="member-name"><?php the_title(); ?></p>
                                    <p class="member-position"><?php the_field('member_position'); ?></p>
                                </div>
                            </div>
                        <?php endwhile; // End of the loop.
                        wp_reset_postdata();
                        ?>
                    </div>
                </div>
            </section>
            <section class="blog">
                <div class="container">
                    <p class="section-text"><?php echo get_theme_mod('blog_head_text'); ?></p>
                    <h2 class="section-heading"><?php echo get_theme_mod('blog_heading'); ?></h2>
                    <p class="main-text"><?php echo get_theme_mod('blog_main_text'); ?></p>
                    <div class="service-list d-flex .flex-row flex-wrap">
                        <?php
                        $loop = new WP_Query(array(
                            'post_type' => 'post',
                            'posts_per_page' => '7'
                        ));
                        while ($loop->have_posts()) : $loop->the_post(); ?>
                            <div class="about-item col-4">
                                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                                    <div class="about-img">
                                        <?php the_post_thumbnail() ?>
                                        <div class="absolute-text">
                                            <a href="<?php the_permalink() ?>" class="text-container">
                                                <div class="center-text">
                                                    <?php the_field('icon_field') ?>
                                                    <p><?php echo the_title(); ?></p>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </article>
                            </div>
                        <?php endwhile; // End of the loop.
                        wp_reset_postdata();
                        ?>
                    </div>
                </div>
            </section>
        </main><!-- #main -->
    </div><!-- #primary -->

<?php
get_footer();
