<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package tr_theme
 */

?>


    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <div class="feature-img">
            <?php the_post_thumbnail() ?>
        </div>
        <div class="feature-title">
            <h3><?php the_title(); ?></h3>
        </div>
        <div class="feature-entry-content">
            <p><?php the_content(); ?></p>
        </div>
    </article><!-- #post-<?php the_ID(); ?> -->


